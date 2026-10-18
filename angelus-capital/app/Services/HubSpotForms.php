<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Sends website enquiries to a HubSpot form so they land in the CRM.
 *
 * Uses HubSpot's public Forms submission API, which needs only the portal ID
 * and form GUID (no private access token on the server).
 */
class HubSpotForms
{
    public function isConfigured(): bool
    {
        return filled(config('acpl.hubspot.portal_id')) && filled(config('acpl.hubspot.form_guid'));
    }

    /**
     * @param  array<string, string|null>  $fields  HubSpot property name => value
     * @param  array{hutk?: string|null, pageUri?: string|null, pageName?: string|null, ipAddress?: string|null}  $context
     */
    public function submit(array $fields, array $context = []): bool
    {
        if (! $this->isConfigured()) {
            return false;
        }

        $url = sprintf(
            'https://api.hsforms.com/submissions/v3/integration/submit/%s/%s',
            rawurlencode((string) config('acpl.hubspot.portal_id')),
            rawurlencode((string) config('acpl.hubspot.form_guid')),
        );

        $payload = [
            'fields' => collect($fields)
                ->filter(fn ($value) => filled($value))
                ->map(fn ($value, $name) => ['objectTypeId' => '0-1', 'name' => $name, 'value' => (string) $value])
                ->values()
                ->all(),
            'context' => array_filter($context, fn ($value) => filled($value)),
        ];

        try {
            $response = Http::timeout(8)->acceptJson()->post($url, $payload);

            if ($response->failed()) {
                Log::warning('HubSpot form submission failed', ['status' => $response->status(), 'body' => $response->json() ?? $response->body()]);

                return false;
            }

            return true;
        } catch (Throwable $exception) {
            Log::warning('HubSpot form submission error', ['message' => $exception->getMessage()]);

            return false;
        }
    }
}
