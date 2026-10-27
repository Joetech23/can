<?php

namespace App\Http\Controllers;

use App\Mail\EnquiryReceived;
use App\Services\CrmWebhook;
use App\Services\EnquiryHandler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

/**
 * A private pre-launch page that reports whether email, CRM and tracking are
 * configured on the live server, and sends test messages through each.
 */
class LaunchCheckController extends Controller
{
    public function show(Request $request): View
    {
        $this->authorizeKey($request);

        return view('pages.launch-check', [
            'checks' => $this->checks($request),
            'routes' => collect(config('acpl.enquiry_types'))
                ->map(fn (string $label, string $type) => ['label' => $label, ...app(EnquiryHandler::class)->routeFor($type)]),
            'key' => (string) $request->input('key'),
        ]);
    }

    public function sendTestEmail(Request $request): RedirectResponse
    {
        $this->authorizeKey($request);

        $validated = $request->validate(['to' => ['required', 'email', 'max:180']]);

        $enquiry = [
            'name' => 'Website launch test',
            'email' => config('acpl.company.email'),
            'phone' => config('acpl.company.phone'),
            'organization' => config('acpl.company.name'),
            'enquiry_type' => 'other',
            'message' => 'This is a test message sent from the launch check page to confirm that website enquiries reach your inbox. No action is needed.',
        ];

        try {
            Mail::to($validated['to'])->send(new EnquiryReceived($enquiry, 'Launch test'));
            $result = ['ok' => true, 'message' => 'Test email handed to the mail server ('.config('mail.default').'). Check '.$validated['to'].' — including the spam folder.'];
        } catch (Throwable $exception) {
            Log::error('Launch check email failed', ['message' => $exception->getMessage()]);
            $result = ['ok' => false, 'message' => 'Email could not be sent: '.$exception->getMessage()];
        }

        return $this->back($request, $result);
    }

    public function sendTestCrm(Request $request, CrmWebhook $crm): RedirectResponse
    {
        $this->authorizeKey($request);

        if (! $crm->isConfigured()) {
            return $this->back($request, ['ok' => false, 'message' => 'No CRM webhook is set. Add CRM_WEBHOOK_URL to .env first.']);
        }

        $sent = $crm->send([
            'test' => true,
            'source' => 'website',
            'submitted_at' => now()->toIso8601String(),
            'contact' => ['name' => 'Website launch test', 'email' => config('acpl.company.email')],
            'enquiry' => ['type' => 'other', 'label' => 'Launch test', 'message' => 'Test lead from the website launch check. Safe to delete.'],
        ]);

        return $this->back($request, $sent
            ? ['ok' => true, 'message' => 'Test lead accepted by '.config('acpl.crm.name').'. Check that it appears in the CRM.']
            : ['ok' => false, 'message' => config('acpl.crm.name').' did not accept the test lead. See storage/logs/laravel.log for the response.']);
    }

    /**
     * @return list<array{label: string, status: 'ok'|'warn'|'fail', detail: string}>
     */
    private function checks(Request $request): array
    {
        $tracking = config('acpl.tracking');
        $mailer = (string) config('mail.default');
        $appHost = parse_url((string) config('app.url'), PHP_URL_HOST);

        return [
            $this->check('Secure connection (HTTPS)', $request->isSecure() ? 'ok' : 'fail', $request->isSecure() ? 'The site is being served over HTTPS.' : 'This page was loaded over plain HTTP. Install/enable the SSL certificate in cPanel (SSL/TLS Status → Run AutoSSL).'),
            $this->check('Production mode', app()->isProduction() && ! config('app.debug') ? 'ok' : 'fail', 'APP_ENV='.app()->environment().', APP_DEBUG='.(config('app.debug') ? 'true' : 'false').' (should be production / false).'),
            $this->check('Site address (APP_URL)', $appHost === $request->getHost() ? 'ok' : 'warn', 'APP_URL is '.config('app.url').'; this page is on '.$request->getSchemeAndHttpHost().'.'),
            $this->check('Enquiry emails', in_array($mailer, ['log', 'array'], true) ? 'fail' : 'ok', in_array($mailer, ['log', 'array'], true)
                ? 'MAIL_MAILER='.$mailer.': enquiries are only written to the log, not emailed. Set MAIL_MAILER to sendmail or smtp.'
                : 'Sending with "'.$mailer.'" from '.config('mail.from.address').'. Use the test button below to confirm delivery.'),
            $this->check('Google Analytics / Google tag', filled($tracking['google_tag']) ? 'ok' : 'warn', filled($tracking['google_tag']) ? 'GOOGLE_TAG_ID='.$tracking['google_tag'].'. Open the site in another tab and watch GA4 → Reports → Realtime.' : 'Not set. Add GOOGLE_TAG_ID=G-XXXXXXXXXX to .env.'),
            $this->check('Google Ads conversion', filled($tracking['google_ads_conversion']) ? 'ok' : 'warn', filled($tracking['google_ads_conversion']) ? 'GOOGLE_ADS_CONVERSION='.$tracking['google_ads_conversion'] : 'Not set (only needed when running Google Ads): GOOGLE_ADS_CONVERSION=AW-XXXXXXXXX/label.'),
            $this->check('Meta (Facebook/Instagram) Pixel', filled($tracking['meta_pixel']) ? 'ok' : 'warn', filled($tracking['meta_pixel']) ? 'META_PIXEL_ID='.$tracking['meta_pixel'].'. Verify in Meta Events Manager → Test events.' : 'Not set (only needed when running Meta ads): META_PIXEL_ID=...'),
            $this->check('CRM ('.config('acpl.crm.name').')', filled(config('acpl.crm.webhook_url')) ? 'ok' : 'warn', filled(config('acpl.crm.webhook_url')) ? 'Webhook set. Use the test button below.' : 'Not connected. Add CRM_WEBHOOK_URL (and CRM_WEBHOOK_TOKEN if required) to .env.'),
            $this->check('Storage folder writable', is_writable(storage_path('framework/sessions')) && is_writable(storage_path('logs')) ? 'ok' : 'fail', 'angelus-app/storage must be writable (permissions 755 on folders).'),
            $this->check('Company details', filled(config('acpl.company.rc_number')) && filled(config('acpl.company.linkedin')) ? 'ok' : 'warn', 'RC number: '.(config('acpl.company.rc_number') ?: 'not set').'. LinkedIn: '.(config('acpl.company.linkedin') ?: 'not set').'.'),
        ];
    }

    /**
     * @param  'ok'|'warn'|'fail'  $status
     * @return array{label: string, status: 'ok'|'warn'|'fail', detail: string}
     */
    private function check(string $label, string $status, string $detail): array
    {
        return ['label' => $label, 'status' => $status, 'detail' => $detail];
    }

    /**
     * @param  array{ok: bool, message: string}  $result
     */
    private function back(Request $request, array $result): RedirectResponse
    {
        return to_route('launch-check', ['key' => $request->input('key')])->with('launch_result', $result);
    }

    private function authorizeKey(Request $request): void
    {
        $key = (string) config('acpl.launch_check_key');

        abort_unless($key !== '' && hash_equals($key, (string) $request->input('key')), 404);
    }
}
