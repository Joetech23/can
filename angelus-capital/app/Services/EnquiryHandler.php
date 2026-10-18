<?php

namespace App\Services;

use App\Http\Middleware\CaptureCampaignParameters;
use App\Mail\EnquiryReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

/**
 * Processes a validated website enquiry: records it, routes it to the
 * responsible business unit by email and pushes it into the HubSpot CRM.
 */
class EnquiryHandler
{
    public function __construct(public HubSpotForms $hubSpot) {}

    /**
     * @param  array<string, mixed>  $enquiry  Validated form data
     * @return array{unit: string, email: string}
     */
    public function handle(array $enquiry, Request $request): array
    {
        $route = $this->routeFor((string) $enquiry['enquiry_type']);
        $campaign = $this->campaignFrom($enquiry, $request);

        Log::info('Website enquiry received', array_filter([
            ...collect($enquiry)->except(array_keys($campaign))->all(),
            'routed_to' => $route['unit'].' <'.$route['email'].'>',
            'campaign' => $campaign,
        ]));

        try {
            Mail::to($route['email'])->send(new EnquiryReceived($enquiry, $route['unit'], $campaign));
        } catch (Throwable $exception) {
            Log::error('Enquiry email could not be sent', ['message' => $exception->getMessage()]);
        }

        $this->hubSpot->submit($this->hubSpotFields($enquiry, $route['unit'], $campaign), [
            'hutk' => $request->cookie('hubspotutk'),
            'pageUri' => $request->headers->get('referer') ?? route('contact'),
            'pageName' => 'Contact — '.config('acpl.company.short_name'),
            'ipAddress' => $request->ip(),
        ]);

        return $route;
    }

    /**
     * @return array{unit: string, email: string}
     */
    public function routeFor(string $enquiryType): array
    {
        $route = config("acpl.enquiry_routing.{$enquiryType}") ?? config('acpl.enquiry_routing.other');

        return [
            'unit' => $route['unit'],
            'email' => filled($route['email']) ? $route['email'] : config('acpl.company.email'),
        ];
    }

    /**
     * Campaign details from the form's hidden fields, falling back to what the
     * visitor's session captured earlier in their visit.
     *
     * @param  array<string, mixed>  $enquiry
     * @return array<string, string>
     */
    private function campaignFrom(array $enquiry, Request $request): array
    {
        $fromForm = array_filter(
            collect($enquiry)->only([...CaptureCampaignParameters::PARAMETERS, 'landing_page', 'referrer'])->all(),
            fn ($value) => filled($value),
        );

        $fromSession = array_filter([
            ...(array) $request->session()->get('campaign', []),
            'landing_page' => $request->session()->get('campaign_landing_page'),
            'referrer' => $request->session()->get('campaign_referrer'),
        ], fn ($value) => filled($value));

        return array_map('strval', [...$fromSession, ...$fromForm]);
    }

    /**
     * @param  array<string, mixed>  $enquiry
     * @param  array<string, string>  $campaign
     * @return array<string, string|null>
     */
    private function hubSpotFields(array $enquiry, string $unit, array $campaign): array
    {
        $name = trim((string) $enquiry['name']);
        $enquiryLabel = config('acpl.enquiry_types.'.$enquiry['enquiry_type']);

        $message = collect([
            'Enquiry: '.$enquiryLabel.' (routed to '.$unit.')',
            filled($enquiry['message'] ?? null) ? "\n".$enquiry['message'] : null,
            $campaign !== [] ? "\nSource: ".collect($campaign)->map(fn ($value, $key) => $key.'='.$value)->implode(', ') : null,
        ])->filter()->implode("\n");

        return [
            'email' => $enquiry['email'] ?? null,
            'firstname' => Str::before($name, ' '),
            'lastname' => Str::contains($name, ' ') ? Str::after($name, ' ') : null,
            'phone' => $enquiry['phone'] ?? null,
            'company' => $enquiry['organization'] ?? null,
            'message' => $message,
        ];
    }
}
