<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Posts each website enquiry as JSON to a CRM webhook (e.g. DoubleSpace),
 * so any CRM that accepts inbound webhooks can capture website leads.
 */
class CrmWebhook
{
    public function isConfigured(): bool
    {
        return filled(config('acpl.crm.webhook_url'));
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function send(array $payload): bool
    {
        if (! $this->isConfigured()) {
            return false;
        }

        try {
            $request = Http::timeout(8)->acceptJson();

            if (filled(config('acpl.crm.token'))) {
                $request = $request->withToken((string) config('acpl.crm.token'));
            }

            $response = $request->post((string) config('acpl.crm.webhook_url'), $payload);

            if ($response->failed()) {
                Log::warning('CRM webhook failed', ['crm' => config('acpl.crm.name'), 'status' => $response->status(), 'body' => $response->json() ?? $response->body()]);

                return false;
            }

            return true;
        } catch (Throwable $exception) {
            Log::warning('CRM webhook error', ['crm' => config('acpl.crm.name'), 'message' => $exception->getMessage()]);

            return false;
        }
    }
}
