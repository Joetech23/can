<?php

/*
|--------------------------------------------------------------------------
| FastTrack Team Logistics: business content
|--------------------------------------------------------------------------
|
| Everything customer-facing that is specific to the business lives here so
| it can be updated without touching templates. Values marked PLACEHOLDER
| are waiting on the items listed in section 03 of the project proposal
| ("Kick-off and what we need") and must be replaced before launch.
|
*/

return [

    'name' => 'FastTrack',
    'legal_name' => 'FastTrack Team Logistics',
    'tagline' => 'Removals and logistics, on the fast track.',

    'phone' => env('FASTTRACK_PHONE', '020 0000 0000'),          // PLACEHOLDER
    'whatsapp' => env('FASTTRACK_WHATSAPP', '440000000000'),     // PLACEHOLDER, digits only
    'email' => env('FASTTRACK_EMAIL', 'info@fstremoval.co.uk'),
    // Where new quote and enquiry alerts are sent.
    'notify_email' => env('FASTTRACK_NOTIFY_EMAIL', env('FASTTRACK_EMAIL', 'info@fstremoval.co.uk')),
    'address' => 'United Kingdom',                               // PLACEHOLDER: registered or trading address
    'company_number' => null,                                    // PLACEHOLDER: Companies House number, shown in the footer and legal pages
    'hours' => 'Mon–Sat 7am–8pm · Sun 9am–5pm',                  // PLACEHOLDER
    'response_time' => 'within 2 working hours',                 // PLACEHOLDER
    'google_reviews_url' => null,                                // Set once the Google Business Profile is live

    'socials' => [                                               // Set once FastTrack creates the accounts (proposal section 08)
        'facebook' => null,
        'instagram' => null,
        'tiktok' => null,
    ],

    'trust' => [
        ['icon' => 'shield-check', 'label' => 'Fully insured'],
        ['icon' => 'pound-sterling', 'label' => 'Fixed-price quotes'],
        ['icon' => 'clock', 'label' => '7 days a week'],
        ['icon' => 'route', 'label' => 'Live move tracking'],
    ],

    /*
    | Area pages: one per town served. PLACEHOLDER towns until FastTrack
    | confirms the ten areas to feature at launch.
    */
    'areas' => [
        'london' => ['name' => 'London', 'region' => 'Greater London', 'postcodes' => 'E, EC, N, NW, SE, SW, W, WC', 'note' => 'Flats with no lift, permit parking and tight streets are everyday jobs for our London crews.'],
        'croydon' => ['name' => 'Croydon', 'region' => 'South London', 'postcodes' => 'CR0–CR9', 'note' => 'From high-rise flats near East Croydon to family homes in Purley and Coulsdon.'],
        'bromley' => ['name' => 'Bromley', 'region' => 'South East London', 'postcodes' => 'BR1–BR8', 'note' => 'Regular moves across Bromley, Beckenham, Orpington and Chislehurst.'],
        'dartford' => ['name' => 'Dartford', 'region' => 'Kent', 'postcodes' => 'DA1–DA4', 'note' => 'Quick access to the M25 and A2 keeps Dartford moves on schedule.'],
        'maidstone' => ['name' => 'Maidstone', 'region' => 'Kent', 'postcodes' => 'ME14–ME18', 'note' => 'Town-centre flats, village cottages and everything in between across mid Kent.'],
        'tonbridge' => ['name' => 'Tonbridge', 'region' => 'Kent', 'postcodes' => 'TN9–TN12', 'note' => 'Covering Tonbridge, Tunbridge Wells and the surrounding villages.'],
        'sevenoaks' => ['name' => 'Sevenoaks', 'region' => 'Kent', 'postcodes' => 'TN13–TN15', 'note' => 'Careful handling for larger homes, antiques and long driveways.'],
        'romford' => ['name' => 'Romford', 'region' => 'East London & Essex', 'postcodes' => 'RM1–RM7', 'note' => 'Moves across Romford, Hornchurch and Upminster, plus office relocations.'],
        'chelmsford' => ['name' => 'Chelmsford', 'region' => 'Essex', 'postcodes' => 'CM1–CM3', 'note' => 'Home and student moves across Chelmsford and mid Essex.'],
        'guildford' => ['name' => 'Guildford', 'region' => 'Surrey', 'postcodes' => 'GU1–GU5', 'note' => 'Covering Guildford and the Surrey Hills, including long-distance moves out of the area.'],
    ],

    'property_sizes' => [
        'items' => 'A few items',
        'studio' => 'Studio flat',
        '1-bed' => '1 bedroom',
        '2-bed' => '2 bedrooms',
        '3-bed' => '3 bedrooms',
        '4-bed' => '4+ bedrooms',
        'office' => 'Office / commercial',
        'pallet' => 'Pallets',
    ],

    'extras' => [
        'packing' => 'Full packing service',
        'materials' => 'Boxes & materials',
        'dismantling' => 'Furniture dismantle & rebuild',
        'storage' => 'Storage (per week)',
        'cleaning' => 'End-of-tenancy clean',
        'clearance' => 'Clearance of unwanted items',
    ],

    /*
    | The six service pages from the proposal (section 04).
    */
    'services' => [
        'home-removals' => [
            'name' => 'Home removals',
            'icon' => 'truck',
            'summary' => 'Studio flats to five-bed family homes, planned to the hour and handled with care.',
            'intro' => 'Moving home is one of the biggest days of the year. We plan it properly, protect your home and belongings, and keep you updated from the moment the van leaves the yard until the last box is in.',
            'from' => 'From £190',
            'ideal' => ['Flats and houses of any size', 'Local and long-distance moves', 'Chain completions on a tight day'],
            'points' => [
                'Free video or in-person survey',
                'Floor, door-frame and banister protection',
                'Furniture wrapped and blanketed in the van',
                'Two to six-person crews depending on size',
                'Dismantle and rebuild of beds and wardrobes',
                'Text updates and live tracking on the day',
            ],
            'faqs' => [
                ['q' => 'How long does a house move take?', 'a' => 'A one-bed flat usually takes four to five hours door to door; a three-bed house is normally a full day. We confirm timings after your survey.'],
                ['q' => 'Can you move us on completion day?', 'a' => 'Yes. Completion-day moves are most of our work. We plan around key release and can hold your belongings overnight if the chain is delayed.'],
            ],
        ],
        'office-moves' => [
            'name' => 'Office moves',
            'icon' => 'building-2',
            'summary' => 'Evening and weekend relocations so your team logs in on Monday like nothing happened.',
            'intro' => 'We relocate offices, shops and studios with minimal downtime: one coordinator, a labelled plan for every desk, and crews who work out of hours so you do not lose a trading day.',
            'from' => 'Custom quote',
            'ideal' => ['Offices of 2 to 200 desks', 'Retail and showroom moves', 'Phased or out-of-hours relocations'],
            'points' => [
                'Out-of-hours and phased moves',
                'IT crating and labelled desk packs',
                'Dedicated move coordinator',
                'Furniture dismantle and rebuild',
                'Secure disposal of old furniture',
                'Certificates of insurance for building managers',
            ],
            'faqs' => [
                ['q' => 'Can you move us over a weekend?', 'a' => 'Yes. Most office moves happen Friday evening to Sunday so your team is working again on Monday morning.'],
                ['q' => 'Do you handle IT equipment?', 'a' => 'We pack, label and transport screens, PCs and servers in protective crates. Your IT team or supplier reconnects them at the new site.'],
            ],
        ],
        'packing' => [
            'name' => 'Packing',
            'icon' => 'package',
            'summary' => 'Full, partial or fragile-only packing, plus boxes and materials delivered to your door.',
            'intro' => 'Packing is the part of moving people dread. Our packers bring everything needed, work room by room and label every box so unpacking is fast at the other end.',
            'from' => 'From £120',
            'ideal' => ['Busy households', 'Fragile and valuable items', 'Short-notice moves'],
            'points' => [
                'Full, partial or fragile-only packing',
                'Double-walled boxes and wardrobe cartons',
                'Every box labelled by room',
                'Specialist wrapping for art and glass',
                'Boxes and tape delivered ahead of time',
                'Unpacking available on arrival',
            ],
            'faqs' => [
                ['q' => 'When do you pack?', 'a' => 'Usually the day before your move, so moving day itself is just loading and unloading. Large homes may need two days.'],
                ['q' => 'Can I just buy boxes?', 'a' => 'Yes. We deliver box bundles, tape, paper and wardrobe cartons on their own.'],
            ],
        ],
        'storage' => [
            'name' => 'Storage',
            'icon' => 'warehouse',
            'summary' => 'Clean, secure, containerised storage for the gap between moves, or for longer.',
            'intro' => 'When completion dates do not line up, or you need space during a renovation, we collect your belongings, store them in sealed containers and bring them back when you are ready.',
            'from' => 'From £25/week',
            'ideal' => ['Gaps between completion dates', 'Renovations and extensions', 'Business stock and archives'],
            'points' => [
                'Sealed, individual containers',
                '24/7 CCTV and alarmed facility',
                'Collection and redelivery by our crew',
                'Inventory of everything stored',
                'Flexible weekly terms, no long contracts',
                'Monthly billing',
            ],
            'faqs' => [
                ['q' => 'How much storage will I need?', 'a' => 'A one-bed flat typically fits one container; a three-bed house two to three. Your surveyor will confirm.'],
                ['q' => 'Can I access my things while they are stored?', 'a' => 'Yes, by appointment. Let us know a day in advance and we will have your container ready.'],
            ],
        ],
        'man-and-van' => [
            'name' => 'Man and van',
            'icon' => 'route',
            'summary' => 'Quick, flexible help for single items, marketplace pick-ups and small flat moves.',
            'intro' => 'For smaller jobs you do not need a full removal crew. Book a van with one or two helpers by the hour: furniture deliveries, marketplace collections, student moves and small flats.',
            'from' => 'From £55/hour',
            'ideal' => ['Single items and collections', 'Student and studio moves', 'Same-day and next-day jobs'],
            'points' => [
                'Same-day and next-day slots',
                'One or two helpers',
                'Blankets, straps and trolley included',
                'Charged in 30-minute steps after the first hour',
                'Clean, modern vans',
                'Fully insured',
            ],
            'faqs' => [
                ['q' => 'Is there a minimum booking?', 'a' => 'One hour, then charged in 30-minute steps. Travel time to the first address is included within your area.'],
                ['q' => 'Will the driver help carry?', 'a' => 'Yes. Every man-and-van booking includes the driver helping to load and unload. Add a second helper for heavy items.'],
            ],
        ],
        'pallet-delivery' => [
            'name' => 'Pallet delivery',
            'icon' => 'boxes',
            'summary' => 'Palletised freight collected and delivered across the UK, from one pallet to a full load.',
            'intro' => 'Our logistics side moves palletised goods for businesses and individuals: stock, equipment and building materials, collected on time and delivered with proof of delivery.',
            'from' => 'From £85',
            'ideal' => ['Business stock and supplies', 'Equipment and machinery', 'Building materials'],
            'points' => [
                'Single pallets to full loads',
                'Tail-lift vans for sites without forklifts',
                'Timed and next-day options',
                'Proof of delivery with photos',
                'Goods-in-transit insurance',
                'Regular contract runs available',
            ],
            'faqs' => [
                ['q' => 'What size pallets do you take?', 'a' => 'Standard UK (1200 × 1000 mm) and Euro (1200 × 800 mm) pallets up to 1,000 kg. Tell us about anything oversized when you book.'],
                ['q' => 'Do I need a forklift?', 'a' => 'No. Our vans have tail-lifts and pallet trucks, so we can deliver to sites without a forklift.'],
            ],
        ],
    ],

    'steps' => [
        ['title' => 'Get an instant price', 'body' => 'Two minutes online: where from, where to and how much. You see a price range straight away.'],
        ['title' => 'Confirm your fixed quote', 'body' => 'A quick video survey or call, then a fixed price in writing. Accept online with a small deposit.'],
        ['title' => 'Track your move', 'body' => 'Your crew arrives on time and you follow every step with your reference, from booked to delivered.'],
    ],

    /*
    | Instant quote rates. PLACEHOLDER figures until FastTrack supplies its
    | rate card (proposal section 03: van sizes, hourly and crew rates,
    | mileage, packing, storage, surcharges, deposit %).
    */
    'rates' => [
        'crew_hourly' => [2 => 70, 3 => 92, 4 => 115, 5 => 138, 6 => 160], // £ per hour for the crew and one van
        'extra_van_hourly' => 25,
        'jobs' => [ // crew size, vans and loading hours by property size
            'items' => ['crew' => 2, 'vans' => 1, 'hours' => 2],
            'studio' => ['crew' => 2, 'vans' => 1, 'hours' => 3],
            '1-bed' => ['crew' => 2, 'vans' => 1, 'hours' => 4],
            '2-bed' => ['crew' => 3, 'vans' => 1, 'hours' => 5],
            '3-bed' => ['crew' => 3, 'vans' => 2, 'hours' => 7],
            '4-bed' => ['crew' => 4, 'vans' => 2, 'hours' => 8],
            'office' => ['crew' => 4, 'vans' => 2, 'hours' => 8],
        ],
        'man_and_van_hourly' => 55,
        'included_miles' => 10,
        'per_mile' => 1.6,
        'average_mph' => 28,
        'pallet' => ['base' => 45, 'per_pallet' => 38, 'per_mile' => 0.85],
        'extras' => ['packing' => 0.35, 'materials' => 45, 'dismantling' => 60, 'storage' => 25, 'cleaning' => 180, 'clearance' => 120], // packing is a share of the move price
        'surcharges' => ['weekend' => 0.15, 'short_notice_days' => 3, 'short_notice' => 0.10],
        'range' => [0.9, 1.15],
        'deposit_percent' => 20,
    ],

    // PLACEHOLDER: layout examples only. Replace with genuine, attributable
    // reviews (or the Google Business Profile feed) before launch.
    'reviews' => [
        ['name' => 'Sample review', 'area' => 'London', 'service' => 'Home removals', 'rating' => 5, 'body' => 'Replace this with a genuine customer review. Short, specific quotes about punctuality and care work best.'],
        ['name' => 'Sample review', 'area' => 'Kent', 'service' => 'Office moves', 'rating' => 5, 'body' => 'Replace this with a genuine customer review, ideally one that mentions the business moving with no downtime.'],
        ['name' => 'Sample review', 'area' => 'Essex', 'service' => 'Packing', 'rating' => 5, 'body' => 'Replace this with a genuine customer review about packing, care with fragile items or value for money.'],
        ['name' => 'Sample review', 'area' => 'Surrey', 'service' => 'Storage', 'rating' => 5, 'body' => 'Replace this with a genuine customer review about storage between moves and redelivery.'],
        ['name' => 'Sample review', 'area' => 'Croydon', 'service' => 'Man and van', 'rating' => 5, 'body' => 'Replace this with a genuine customer review about a quick, flexible man-and-van job.'],
        ['name' => 'Sample review', 'area' => 'Dartford', 'service' => 'Pallet delivery', 'rating' => 5, 'body' => 'Replace this with a genuine customer review from a business that uses the pallet delivery service.'],
    ],

    'faqs' => [
        'Booking' => [
            ['q' => 'How far in advance should I book?', 'a' => 'Two to four weeks is ideal, especially for Fridays and month-ends. We often have short-notice slots, so ask even if your date is close.'],
            ['q' => 'How does the instant quote work?', 'a' => 'It uses our standard rates for crew, vans, travel and extras to give you a price range straight away. We confirm a fixed price after a quick survey.'],
            ['q' => 'Do I need to pay a deposit?', 'a' => 'A small deposit secures your date once you accept your fixed quote. The balance is due when the job is complete.'],
        ],
        'Prices' => [
            ['q' => 'Is my quote really fixed?', 'a' => 'Yes. Once we have surveyed your inventory the price is fixed. It only changes if the job changes, for example extra items or a new address, and we agree that with you first.'],
            ['q' => 'Are there extra charges for stairs or weekends?', 'a' => 'Weekend and short-notice moves carry a small surcharge, shown in your instant quote. Stairs and access are included once we know about them.'],
        ],
        'On the day' => [
            ['q' => 'How do I track my move?', 'a' => 'Use the Track my move page with your reference and postcode. You will see each stage, from booked to delivered.'],
            ['q' => 'Do you dismantle and reassemble furniture?', 'a' => 'Yes. Beds, wardrobes and tables are taken apart, fixings bagged and labelled, and everything rebuilt at your new home.'],
            ['q' => 'What should I do on moving day?', 'a' => 'Keep essentials, documents and valuables with you, and make sure parking is available. Your crew lead will walk through the plan when they arrive.'],
        ],
        'Insurance & storage' => [
            ['q' => 'Are my belongings insured?', 'a' => 'Every move includes goods-in-transit and public liability cover. Higher-value cover is available for antiques, artwork and pianos.'],
            ['q' => 'Can you store my things between moves?', 'a' => 'Yes. We collect, store in sealed containers and redeliver when you are ready, billed monthly with no long contracts.'],
        ],
    ],

    /*
    | Moving guides. Each has a matching view in resources/views/guides/.
    */
    'guides' => [
        'moving-house-checklist' => ['title' => 'The moving house checklist: 8 weeks to moving day', 'summary' => 'What to sort and when, from booking your removal to the last meter reading.', 'minutes' => 6, 'icon' => 'check-circle'],
        'how-much-does-a-removal-cost' => ['title' => 'How much does a removal cost in the UK?', 'summary' => 'What drives the price of a move, typical ranges, and how to avoid surprises.', 'minutes' => 5, 'icon' => 'pound-sterling'],
        'packing-tips' => ['title' => '12 packing tips from professional movers', 'summary' => 'How our crews pack kitchens, wardrobes and fragile items so nothing breaks.', 'minutes' => 5, 'icon' => 'package'],
        'moving-office-guide' => ['title' => 'Moving office without losing a working day', 'summary' => 'A planning timeline for office relocations, from lease to first Monday.', 'minutes' => 6, 'icon' => 'building-2'],
    ],

];
