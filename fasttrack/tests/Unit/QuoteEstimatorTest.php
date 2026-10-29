<?php

namespace Tests\Unit;

use App\Services\QuoteEstimator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class QuoteEstimatorTest extends TestCase
{
    private function estimate(array $input): array
    {
        return app(QuoteEstimator::class)->estimate($input);
    }

    public function test_local_weekday_move_is_crew_rate_times_hours(): void
    {
        $result = $this->estimate(['service' => 'home-removals', 'property_size' => '2-bed', 'miles' => 5]);

        $this->assertSame(92 * 5, (int) $result['total']); // 3 movers, 1 van, 5 hours
        $this->assertCount(1, $result['lines']);
        $this->assertSame((int) (round(460 * 0.9 / 5) * 5), $result['low']);
        $this->assertSame((int) (round(460 * 1.15 / 5) * 5), $result['high']);
    }

    public function test_mileage_extras_and_weekend_surcharge_are_added(): void
    {
        Carbon::setTestNow('2026-11-02'); // a Monday

        $result = $this->estimate([
            'service' => 'home-removals', 'property_size' => '2-bed', 'miles' => 38,
            'extras' => ['dismantling', 'materials'], 'move_date' => '2026-11-14', // a Saturday
        ]);

        $labels = array_column($result['lines'], 'label');
        $this->assertContains('Saturday move (+15%)', $labels);
        $this->assertEqualsWithDelta(701.27, $result['total'], 0.01);
        $this->assertSame(630, $result['low']);
        $this->assertSame(805, $result['high']);
    }

    public function test_short_notice_surcharge(): void
    {
        Carbon::setTestNow('2026-11-02');

        $result = $this->estimate(['property_size' => 'studio', 'miles' => 0, 'move_date' => '2026-11-03']);

        $this->assertContains('Short notice (+10%)', array_column($result['lines'], 'label'));
    }

    public function test_pallet_delivery_pricing(): void
    {
        $result = $this->estimate(['service' => 'pallet-delivery', 'pallets' => 3, 'miles' => 40]);

        $this->assertEqualsWithDelta(45 + 3 * 38 + 0.85 * 40, $result['total'], 0.01);
    }

    public function test_unknown_postcodes_quote_without_mileage(): void
    {
        $this->fakePostcodes();

        $result = $this->estimate(['property_size' => '1-bed', 'from_postcode' => 'SE1 7PB', 'to_postcode' => 'XX9 9XX']);

        $this->assertNull($result['miles']);
        $this->assertCount(1, $result['lines']);
    }

    public function test_invalid_postcodes_are_not_looked_up(): void
    {
        Http::fake();

        $this->assertNull($this->estimate(['from_postcode' => 'not a postcode', 'to_postcode' => '123'])['miles']);
        Http::assertNothingSent();
    }
}
