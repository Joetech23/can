<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Postcode lookups must never hit the real API from tests.
        Http::preventStrayRequests();
    }

    /** Fake postcodes.io with fixed coordinates for the given postcodes. */
    protected function fakePostcodes(array $coordinates = []): void
    {
        $coordinates += [
            'SE17PB' => [51.4986, -0.1037],
            'ME156JQ' => [51.2526, 0.5169],
        ];

        Http::fake(function ($request) use ($coordinates) {
            $postcode = strtoupper(basename(parse_url($request->url(), PHP_URL_PATH)));

            return isset($coordinates[$postcode])
                ? Http::response(['status' => 200, 'result' => ['latitude' => $coordinates[$postcode][0], 'longitude' => $coordinates[$postcode][1]]])
                : Http::response(['status' => 404, 'error' => 'Postcode not found'], 404);
        });
    }
}
