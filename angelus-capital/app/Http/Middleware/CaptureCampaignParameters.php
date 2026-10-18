<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Remembers where a visitor came from (UTM tags, ad click IDs, referrer and
 * the first page they landed on) so the enquiry form can report it, even when
 * the visitor arrives on the landing page and submits on the contact page.
 */
class CaptureCampaignParameters
{
    /**
     * @var list<string>
     */
    public const PARAMETERS = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'gclid', 'fbclid'];

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('GET') && $request->hasSession()) {
            $session = $request->session();
            $campaign = array_filter($request->only(self::PARAMETERS), fn ($value) => is_string($value) && $value !== '');

            if ($campaign !== []) {
                $session->put('campaign', array_map(fn (string $value) => mb_substr($value, 0, 160), $campaign));
            }

            if (! $session->has('campaign_landing_page')) {
                $session->put('campaign_landing_page', mb_substr($request->fullUrl(), 0, 255));

                $referrer = (string) $request->headers->get('referer', '');

                if ($referrer !== '' && parse_url($referrer, PHP_URL_HOST) !== $request->getHost()) {
                    $session->put('campaign_referrer', mb_substr($referrer, 0, 255));
                }
            }
        }

        return $next($request);
    }
}
