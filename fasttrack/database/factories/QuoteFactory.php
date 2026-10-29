<?php

namespace Database\Factories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Demo quotes with UK-style data for the CRM.
 *
 * @extends Factory<Quote>
 */
class QuoteFactory extends Factory
{
    public function definition(): array
    {
        $uk = fake('en_GB');
        $status = fake()->randomElement(['new', 'new', 'contacted', 'surveyed', 'quoted', 'quoted', 'booked', 'booked', 'completed', 'completed', 'lost']);
        $size = fake()->randomElement(array_keys(collect(config('fasttrack.property_sizes'))->except('pallet')->all()));
        $created = fake()->dateTimeBetween('-10 weeks', 'now');
        $base = ['items' => 120, 'studio' => 280, '1-bed' => 340, '2-bed' => 620, '3-bed' => 890, '4-bed' => 1250, 'office' => 1800][$size];

        return [
            'name' => $uk->name(),
            'email' => $uk->unique()->safeEmail(),
            'phone' => '07'.fake()->numerify('### ######'),
            'service' => $size === 'office' ? 'office-moves' : fake()->randomElement(['home-removals', 'home-removals', 'home-removals', 'man-and-van', 'packing', 'storage']),
            'from_postcode' => strtoupper($uk->postcode()),
            'to_postcode' => strtoupper($uk->postcode()),
            'property_size' => $size,
            'move_date' => match ($status) {
                'completed' => fake()->dateTimeBetween($created, 'now'),
                'lost' => null,
                default => fake()->dateTimeBetween('+1 day', '+6 weeks'),
            },
            'flexible_date' => fake()->boolean(30),
            'extras' => fake()->randomElements(array_keys(config('fasttrack.extras')), fake()->numberBetween(0, 3)),
            'notes' => fake()->optional(0.5)->randomElement([
                'Third floor flat, no lift.', 'Parking permit needed outside both properties.',
                'Upright piano in the living room.', 'Large American fridge freezer.',
                'Need to be out by 11am for the cleaners.', 'Some antique furniture that needs extra care.',
            ]),
            'status' => $status,
            'source' => fake()->randomElement(['website', 'website', 'website', 'website', 'phone', 'phone', 'whatsapp', 'referral', 'repeat', 'social']),
            'estimate' => $status === 'new' || $status === 'contacted' ? null : round($base * fake()->randomFloat(2, 0.85, 1.35) / 5) * 5,
            'created_at' => $created,
            'updated_at' => $created,
        ];
    }
}
