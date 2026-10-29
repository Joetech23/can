<?php

namespace App\Services;

use Illuminate\Support\Carbon;

/**
 * Instant price estimate built from the rate card in config/fasttrack.php.
 *
 * The result is a range, not a fixed price: the office confirms the fixed
 * quote after a survey.
 */
class QuoteEstimator
{
    public function __construct(private PostcodeDistance $distance)
    {
    }

    /**
     * @param  array{service?: string, property_size?: string, pallets?: int, from_postcode?: string, to_postcode?: string, move_date?: string|null, extras?: array, miles?: float|null}  $input
     * @return array{low: int, high: int, total: float, miles: float|null, lines: array<int, array{label: string, amount: float}>}
     */
    public function estimate(array $input): array
    {
        $rates = config('fasttrack.rates');
        $service = $input['service'] ?? 'home-removals';
        $miles = array_key_exists('miles', $input)
            ? $input['miles']
            : $this->distance->miles($input['from_postcode'] ?? null, $input['to_postcode'] ?? null);
        $chargeable = max(0, (float) $miles - $rates['included_miles']);
        $lines = [];

        if ($service === 'pallet-delivery') {
            $pallets = max(1, min(26, (int) ($input['pallets'] ?? 1)));
            $p = $rates['pallet'];
            $lines[] = ['label' => 'Collection & delivery', 'amount' => $p['base']];
            $lines[] = ['label' => $pallets.' '.str('pallet')->plural($pallets).' × £'.$p['per_pallet'], 'amount' => $p['per_pallet'] * $pallets];
            if ($miles) {
                $lines[] = ['label' => 'Distance · '.round($miles).' miles', 'amount' => round($p['per_mile'] * $miles, 2)];
            }
        } else {
            $size = $input['property_size'] ?? '2-bed';
            $job = $rates['jobs'][$size] ?? $rates['jobs']['2-bed'];

            if ($service === 'man-and-van') {
                $hours = min($job['hours'], 4);
                $lines[] = ['label' => 'Man and van · '.$hours.' hrs', 'amount' => $rates['man_and_van_hourly'] * $hours];
            } else {
                $hourly = $rates['crew_hourly'][$job['crew']] + ($job['vans'] - 1) * $rates['extra_van_hourly'];
                $lines[] = ['label' => $job['crew'].' movers + '.$job['vans'].' '.str('van')->plural($job['vans']).' · '.$job['hours'].' hrs', 'amount' => $hourly * $job['hours']];
            }

            if ($chargeable > 0) {
                $lines[] = ['label' => 'Travel · '.round($miles).' miles ('.round($chargeable).' beyond included)', 'amount' => round($chargeable * $rates['per_mile'], 2)];
            }
        }

        $base = array_sum(array_column($lines, 'amount'));

        foreach ((array) ($input['extras'] ?? []) as $extra) {
            if (! isset($rates['extras'][$extra])) {
                continue;
            }
            $rate = $rates['extras'][$extra];
            $amount = $extra === 'packing' ? round($base * $rate, 2) : $rate;
            $lines[] = ['label' => config("fasttrack.extras.$extra"), 'amount' => $amount];
        }

        $subtotal = array_sum(array_column($lines, 'amount'));

        if (! empty($input['move_date'])) {
            $date = Carbon::parse($input['move_date']);
            if ($date->isWeekend()) {
                $lines[] = ['label' => $date->format('l').' move (+'.($rates['surcharges']['weekend'] * 100).'%)', 'amount' => round($subtotal * $rates['surcharges']['weekend'], 2)];
            }
            $daysAway = today()->diffInDays($date, false);
            if ($daysAway >= 0 && $daysAway < $rates['surcharges']['short_notice_days']) {
                $lines[] = ['label' => 'Short notice (+'.($rates['surcharges']['short_notice'] * 100).'%)', 'amount' => round($subtotal * $rates['surcharges']['short_notice'], 2)];
            }
        }

        $total = round(array_sum(array_column($lines, 'amount')), 2);
        [$lowFactor, $highFactor] = $rates['range'];

        return [
            'low' => (int) (round($total * $lowFactor / 5) * 5),
            'high' => (int) (round($total * $highFactor / 5) * 5),
            'total' => $total,
            'miles' => $miles,
            'lines' => $lines,
        ];
    }
}
