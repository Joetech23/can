<?php

/*
|--------------------------------------------------------------------------
| FastTrack business content
|--------------------------------------------------------------------------
|
| Everything customer-facing that is specific to the business lives here so
| it can be updated without touching templates. Values marked PLACEHOLDER
| must be replaced with FastTrack's confirmed details before launch.
|
*/

return [

    'name' => 'FastTrack',
    'legal_name' => 'FastTrack Removals',
    'tagline' => 'Moves that run on time.',

    'phone' => env('FASTTRACK_PHONE', '020 0000 0000'),          // PLACEHOLDER
    'whatsapp' => env('FASTTRACK_WHATSAPP', '440000000000'),     // PLACEHOLDER, digits only
    'email' => env('FASTTRACK_EMAIL', 'info@fstremoval.co.uk'),
    'address' => 'London & the South East, United Kingdom',     // PLACEHOLDER
    'hours' => 'Mon–Sat 7am–8pm · Sun 9am–5pm',                  // PLACEHOLDER
    'response_time' => 'within 2 working hours',                 // PLACEHOLDER

    'trust' => [
        ['icon' => 'shield-check', 'label' => 'Fully insured moves'],
        ['icon' => 'pound-sterling', 'label' => 'Fixed-price quotes'],
        ['icon' => 'clock', 'label' => '7 days a week'],
        ['icon' => 'users', 'label' => 'Trained, uniformed crews'],
    ],

    'areas' => [
        'London', 'Kent', 'Essex', 'Surrey', 'Sussex', 'Hertfordshire',
        'Berkshire', 'Buckinghamshire', 'UK-wide', 'Europe',
    ],

    'property_sizes' => [
        'items' => 'A few items',
        'studio' => 'Studio flat',
        '1-bed' => '1 bedroom',
        '2-bed' => '2 bedrooms',
        '3-bed' => '3 bedrooms',
        '4-bed' => '4+ bedrooms',
        'office' => 'Office / commercial',
    ],

    'extras' => [
        'packing' => 'Full packing service',
        'materials' => 'Boxes & materials',
        'dismantling' => 'Furniture dismantle & rebuild',
        'storage' => 'Short or long-term storage',
        'cleaning' => 'End-of-tenancy clean',
        'clearance' => 'Clearance of unwanted items',
    ],

    'services' => [
        'home-removals' => [
            'name' => 'Home removals',
            'icon' => 'truck',
            'summary' => 'From studio flats to five-bed family homes, planned to the hour and handled with care.',
            'from' => 'From £295',
            'points' => [
                'Free survey (video or in person)',
                'Floor, door-frame and banister protection',
                'Furniture wrapped and blanketed in the van',
                'Two to six-person crews depending on size',
            ],
        ],
        'office-removals' => [
            'name' => 'Office & commercial',
            'icon' => 'building-2',
            'summary' => 'Evening and weekend relocations so your team logs in on Monday like nothing happened.',
            'from' => 'Custom quote',
            'points' => [
                'Out-of-hours and phased moves',
                'IT crating and labelled desk packs',
                'Dedicated move coordinator',
                'Secure disposal of old furniture',
            ],
        ],
        'packing' => [
            'name' => 'Packing & materials',
            'icon' => 'package',
            'summary' => 'Full or fragile-only packing, plus boxes, tape and wardrobe cartons delivered to your door.',
            'from' => 'From £120',
            'points' => [
                'Full, partial or fragile-only packing',
                'Double-walled boxes and wardrobe cartons',
                'Every box labelled by room',
                'Unpacking available on arrival',
            ],
        ],
        'storage' => [
            'name' => 'Storage',
            'icon' => 'warehouse',
            'summary' => 'Clean, secure, containerised storage for the gap between completion dates, or longer.',
            'from' => 'From £25/week',
            'points' => [
                'Sealed, individual containers',
                '24/7 CCTV and alarmed facility',
                'Collection and redelivery included',
                'Flexible weekly terms',
            ],
        ],
        'man-and-van' => [
            'name' => 'Man & van',
            'icon' => 'route',
            'summary' => 'Quick, flexible help for single items, marketplace pick-ups and small flat moves.',
            'from' => 'From £55/hour',
            'points' => [
                'Same-day and next-day slots',
                'One or two helpers',
                'Blankets, straps and trolley included',
                'Charged in 30-minute steps after the first hour',
            ],
        ],
        'student-moves' => [
            'name' => 'Student moves',
            'icon' => 'graduation-cap',
            'summary' => 'Term-time moves between halls, house shares and home without the parent taxi.',
            'from' => 'From £79',
            'points' => [
                'Shared-van options to cut cost',
                'Summer storage between terms',
                'Weekend slots',
                'Student discount on packing materials',
            ],
        ],
        'clearances' => [
            'name' => 'House clearance',
            'icon' => 'sparkles',
            'summary' => 'Full or partial clearances with items donated, recycled or responsibly disposed of.',
            'from' => 'From £150',
            'points' => [
                'Licensed waste carrier',
                'Donation and recycling first',
                'Probate and landlord clearances',
                'Sweep-clean on completion',
            ],
        ],
        'european-moves' => [
            'name' => 'European moves',
            'icon' => 'globe',
            'summary' => 'Door-to-door moves to and from Europe with customs paperwork handled for you.',
            'from' => 'Custom quote',
            'points' => [
                'Dedicated or part-load vans',
                'Customs and inventory paperwork',
                'Fixed delivery windows',
                'Insurance for the whole journey',
            ],
        ],
    ],

    'steps' => [
        ['title' => 'Tell us about your move', 'body' => 'Two minutes online: where from, where to, and roughly how much.'],
        ['title' => 'Get a fixed price', 'body' => 'We confirm by video survey or a quick call and send a price that will not change on the day.'],
        ['title' => 'We move you', 'body' => 'Your crew arrives on time, protects your home and keeps you updated until the last box is in.'],
    ],

    // PLACEHOLDER: sample testimonials for layout only. Replace with real,
    // attributable customer reviews before launch.
    'testimonials' => [
        ['name' => 'Sample review', 'area' => 'Customer, London', 'service' => 'Home removal', 'body' => 'Replace this with a genuine customer review. Short, specific quotes about punctuality and care work best here.'],
        ['name' => 'Sample review', 'area' => 'Customer, Kent', 'service' => 'Office move', 'body' => 'Replace this with a genuine customer review, ideally one that mentions the business moving with no downtime.'],
        ['name' => 'Sample review', 'area' => 'Customer, Essex', 'service' => 'Packing & storage', 'body' => 'Replace this with a genuine customer review that talks about packing, storage or the value for money.'],
    ],

    'faqs' => [
        ['q' => 'How far in advance should I book?', 'a' => 'Two to four weeks is ideal, especially for Fridays and month-ends. We often have short-notice slots, so ask even if your date is close.'],
        ['q' => 'Is my quote really fixed?', 'a' => 'Yes. Once we have surveyed your inventory, the price is fixed. It only changes if the job changes, for example extra items or a new address, and we agree that with you first.'],
        ['q' => 'Are my belongings insured?', 'a' => 'Every move includes goods-in-transit and public liability cover. Higher-value cover is available for antiques, artwork and pianos.'],
        ['q' => 'Do you dismantle and reassemble furniture?', 'a' => 'Yes. Beds, wardrobes and tables are taken apart, fixings bagged and labelled, and everything rebuilt at your new home.'],
        ['q' => 'Can you store my things between moves?', 'a' => 'Yes. We collect, store in sealed containers and redeliver when you are ready, by the week with no long contracts.'],
        ['q' => 'What do I need to do on moving day?', 'a' => 'Keep essentials, documents and valuables with you, and make sure parking is available. Your crew lead will walk through the plan with you when they arrive.'],
    ],

];
