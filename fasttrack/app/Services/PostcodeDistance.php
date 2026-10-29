<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Approximate road distance between two UK postcodes.
 *
 * Uses postcodes.io (free, no key) for coordinates, then straight-line
 * distance with a road factor. Returns null when a postcode cannot be
 * found or the lookup fails, so callers can quote without mileage.
 */
class PostcodeDistance
{
    private const ROAD_FACTOR = 1.25;

    public function miles(?string $from, ?string $to): ?float
    {
        $a = $this->coordinates($from);
        $b = $this->coordinates($to);

        if (! $a || ! $b) {
            return null;
        }

        return round($this->haversineMiles($a, $b) * self::ROAD_FACTOR, 1);
    }

    /** @return array{0: float, 1: float}|null */
    public function coordinates(?string $postcode): ?array
    {
        $postcode = strtoupper(preg_replace('/\s+/', '', (string) $postcode));

        if (! preg_match('/^[A-Z]{1,2}\d[A-Z\d]?\d[A-Z]{2}$/', $postcode)) {
            return null;
        }

        return Cache::remember("postcode:$postcode", now()->addDays(30), function () use ($postcode) {
            try {
                $result = Http::timeout(4)->get("https://api.postcodes.io/postcodes/$postcode")->json('result');
            } catch (\Throwable $e) {
                report($e);

                return null;
            }

            return isset($result['latitude'], $result['longitude'])
                ? [(float) $result['latitude'], (float) $result['longitude']]
                : null;
        });
    }

    private function haversineMiles(array $a, array $b): float
    {
        [$lat1, $lon1] = array_map('deg2rad', $a);
        [$lat2, $lon2] = array_map('deg2rad', $b);
        $h = sin(($lat2 - $lat1) / 2) ** 2 + cos($lat1) * cos($lat2) * sin(($lon2 - $lon1) / 2) ** 2;

        return 3958.8 * 2 * asin(min(1, sqrt($h)));
    }
}
