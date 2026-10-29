<?php

namespace Database\Seeders;

use App\Models\Enquiry;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with a staff login and demo CRM data.
     * Model events stay on so quote references are generated.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Team FastTrack',
            'email' => 'admin@fasttrack.test',
            'password' => 'password',
        ]);

        // Unguarded so the demo activity log keeps realistic timestamps.
        Model::unguarded(fn () => Quote::factory(42)->create()->each(function (Quote $quote) use ($admin) {
            $quote->activities()->create(['type' => 'created', 'body' => 'Quote request received from the website.', 'created_at' => $quote->created_at]);
            if ($quote->status !== 'new') {
                $quote->activities()->create([
                    'type' => 'status',
                    'body' => 'Status changed to '.$quote->statusLabel().'.',
                    'user_id' => $admin->id,
                    'created_at' => $quote->created_at->copy()->addHours(3),
                ]);
            }
        }));

        Enquiry::insert([
            ['name' => 'Priya Shah', 'email' => 'priya@example.com', 'phone' => null, 'topic' => 'Storage', 'message' => "Hi, do you offer storage for around 3 months? We complete on our sale before our purchase.\nThanks!", 'read_at' => null, 'created_at' => now()->subHours(2), 'updated_at' => now()],
            ['name' => 'Tom Fletcher', 'email' => 'tom@example.com', 'phone' => '07700 900123', 'topic' => 'Office move', 'message' => 'We are moving a 20-desk office from Canary Wharf to Stratford next month. Could someone call me to arrange a survey?', 'read_at' => null, 'created_at' => now()->subDay(), 'updated_at' => now()],
            ['name' => 'Grace Okafor', 'email' => 'grace@example.com', 'phone' => null, 'topic' => 'Existing booking', 'message' => 'Can we move our booking from the 14th to the 15th?', 'read_at' => now()->subDays(2), 'created_at' => now()->subDays(3), 'updated_at' => now()],
        ]);
    }
}
