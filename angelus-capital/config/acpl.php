<?php

/*
|--------------------------------------------------------------------------
| Angelus Capital Partners Limited — Site Content
|--------------------------------------------------------------------------
|
| All copy for the public website lives here so it can be edited in one
| place. The site intentionally has no database; when one is added, this
| file is the natural seed for the content tables.
|
*/

return [

    'company' => [
        'name' => 'Angelus Capital Partners Limited',
        'short_name' => 'Angelus Capital Partners',
        'abbr' => 'ACPL',
        'tagline' => 'Capital. Advisory. Investments.',
        'strapline' => 'Creating Sustainable Value Through Strategic Capital Solutions',
        'summary' => 'ACPL is a financial advisory, investment management and capital solutions firm dedicated to helping businesses, investors and institutions unlock growth opportunities through innovative financing, strategic advisory services and disciplined investment execution.',
        'address' => ['173 Ogudu Road', 'Ogudu, Lagos', 'Nigeria'],
        'phone' => '+234 802 326 1918',
        'phone_href' => '+2348023261918',
        'email' => 'info@angeluscapitalpartners.com',
        'website' => 'www.angeluscapitalpartners.com',
        'map_query' => '173 Ogudu Road, Ogudu, Lagos, Nigeria',
    ],

    'navigation' => [
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'What We Do', 'route' => 'services'],
        ['label' => 'Sectors', 'route' => 'sectors'],
        ['label' => 'Transactions', 'route' => 'transactions'],
        ['label' => 'Leadership', 'route' => 'leadership'],
    ],

    'metrics' => [
        ['value' => 3, 'prefix' => '', 'suffix' => '', 'label' => 'Integrated platforms', 'note' => 'Advisory, Capital Solutions and Investments'],
        ['value' => 8, 'prefix' => '', 'suffix' => '', 'label' => 'Sectors of focus', 'note' => 'From financial services to green energy'],
        ['value' => 500, 'prefix' => '$', 'suffix' => 'M+', 'label' => 'Fundraising track record', 'note' => 'US$ fundraising participation by our leadership across multiple sectors'],
        ['value' => 30, 'prefix' => '', 'suffix' => '+', 'label' => 'Years of leadership experience', 'note' => 'Consulting, banking, private equity and capital raising'],
    ],

    'chairman' => [
        'name' => 'Dr. Anthony Oboh',
        'title' => 'Chairman',
        'headline' => 'Building Institutions. Enabling Growth. Creating Value.',
        'message' => [
            'The ability of businesses and economies to grow sustainably is increasingly dependent on access to the right capital, sound governance, strategic leadership and effective execution.',
            'At Angelus Capital Partners Limited, we believe capital is most impactful when combined with deep insight, strong relationships and disciplined execution. Our mission has always been to connect capital with opportunity while supporting enterprises and institutions in achieving their long-term objectives.',
            'The experiences represented within our leadership team span private equity, venture capital, banking, corporate finance, investment management, project finance and business transformation. These experiences provide us with unique perspectives on how businesses can successfully navigate growth, restructuring, expansion and investment opportunities.',
            'As economies continue to evolve, ACPL remains committed to providing innovative solutions that generate value for investors, businesses, communities and stakeholders.',
            'We look forward to partnering with organizations seeking sustainable growth and transformational outcomes.',
        ],
        'pull_quote' => 'Capital is most impactful when combined with deep insight, strong relationships and disciplined execution.',
    ],

    'about' => [
        'intro' => 'Angelus Capital Partners Limited is an independent financial advisory, investment management and capital solutions firm focused on connecting capital providers with businesses and projects that require strategic financing and growth support.',
        'pillars' => [
            ['title' => 'Independent', 'text' => 'An independent financial advisory, investment management and capital solutions firm, giving objective recommendations aligned with client interests.'],
            ['title' => 'Full capital lifecycle', 'text' => 'From business strategy and project development to capital raising, transaction execution and investment management.'],
            ['title' => 'Decades of experience', 'text' => 'Banking, private equity, venture capital, corporate finance, project finance, investment management, restructuring and business transformation.'],
        ],
        'clients' => [
            'Corporations and SMEs',
            'Institutional Investors',
            'Pension Funds',
            'Family Offices',
            'Development Finance Institutions',
            'Government Agencies',
            'High-Net-Worth Individuals',
            'Project Sponsors',
            'Investment Consortia',
        ],
    ],

    'vision' => 'To transform business institutions and enterprises.',
    'mission' => 'To provide financing and investment solutions to businesses by leveraging people, relationships, technology and capital.',

    'values' => [
        ['title' => 'Professionalism', 'text' => 'Delivering excellence through expertise and discipline.'],
        ['title' => 'Insight', 'text' => 'Applying deep market knowledge and analytical thinking.'],
        ['title' => 'Relationships', 'text' => 'Building long-term partnerships founded on trust.'],
        ['title' => 'Integrity', 'text' => 'Maintaining the highest ethical standards.'],
        ['title' => 'Team Spirit', 'text' => 'Collaborating effectively to create exceptional outcomes.'],
    ],

    'platforms' => [
        [
            'key' => 'advisory',
            'title' => 'Advisory',
            'summary' => 'Helping businesses make better strategic and financial decisions.',
            'items' => ['Corporate Finance', 'Project Finance', 'Mergers & Acquisitions Support', 'Restructuring & Turnaround', 'Business Planning', 'Due Diligence'],
        ],
        [
            'key' => 'capital',
            'title' => 'Capital Solutions',
            'summary' => 'Connecting enterprises with appropriate funding sources.',
            'items' => ['Equity Capital', 'Debt Financing', 'Mezzanine Capital', 'Structured Finance', 'Alternative Capital Solutions'],
        ],
        [
            'key' => 'investments',
            'title' => 'Investments',
            'summary' => 'Creating value through disciplined investment execution.',
            'items' => ['Private Equity', 'Infrastructure Investments', 'Impact Investments', 'Growth Capital', 'Special Situations'],
        ],
    ],

    'value_proposition' => [
        'needs' => [
            ['who' => 'Businesses', 'need' => 'require capital.'],
            ['who' => 'Investors', 'need' => 'require quality opportunities.'],
            ['who' => 'Projects', 'need' => 'require structure and execution.'],
        ],
        'role' => 'Our role is to identify opportunities, structure solutions, mobilize capital and support execution.',
        'outcome' => 'This integrated approach allows us to create sustainable value for both capital providers and capital users.',
    ],

    'process' => [
        ['title' => 'Identify', 'text' => 'Source and qualify opportunities with real growth and market potential.'],
        ['title' => 'Assess', 'text' => 'Due diligence, feasibility studies and financial modeling.'],
        ['title' => 'Structure', 'text' => 'Design the right capital structure and risk allocation framework.'],
        ['title' => 'Mobilize', 'text' => 'Engage institutional, strategic and impact capital providers.'],
        ['title' => 'Execute', 'text' => 'Move the transaction from concept to completion.'],
        ['title' => 'Sustain', 'text' => 'Governance, performance improvement and long-term value creation.'],
    ],

    'advisory' => [
        'headline' => 'Helping Businesses Grow, Transform and Compete',
        'intro' => 'ACPL advises organizations at different stages of growth and development.',
        'groups' => [
            ['title' => 'Corporate Finance Advisory', 'items' => ['Capital raising', 'Debt restructuring', 'Growth financing', 'Financial strategy', 'M&A support', 'Valuation services']],
            ['title' => 'Business Transformation', 'items' => ['Strategic planning', 'Governance enhancement', 'Performance improvement', 'Business model optimization']],
            ['title' => 'Transaction Support', 'items' => ['Due diligence', 'Investor readiness', 'Feasibility studies', 'Business plan development', 'Transaction execution support']],
        ],
    ],

    'capital_stack' => [
        ['title' => 'Equity Capital', 'text' => 'Ownership capital for growth, expansion and strategic transformation.', 'risk' => 'Highest return potential'],
        ['title' => 'Mezzanine Capital', 'text' => 'Hybrid instruments bridging senior debt and equity.', 'risk' => 'Balanced risk / return'],
        ['title' => 'Structured Finance', 'text' => 'Tailored instruments built around specific cash flows and assets.', 'risk' => 'Tailored risk allocation'],
        ['title' => 'Debt Financing', 'text' => 'Senior and term facilities from banks and institutional lenders.', 'risk' => 'Lowest cost of capital'],
    ],
    'alternative_capital' => 'Alternative Capital Solutions — non-traditional funding where conventional structures do not fit.',

    'project_finance' => [
        'headline' => 'Structuring Bankable Projects',
        'intro' => 'We assist clients in developing projects capable of attracting institutional capital.',
        'services' => ['Project structuring', 'Financial modeling', 'Capital strategy development', 'Risk allocation frameworks', 'Funding arrangement support', 'Investor engagement'],
        'sources' => ['Institutional Investors', 'Development Finance Institutions', 'Commercial Banks', 'Private Equity Funds', 'Family Offices', 'Strategic Investors', 'Impact Investors'],
    ],

    'investment' => [
        'headline' => 'Investing for Growth and Long-Term Value',
        'philosophy' => 'Our investment philosophy combines capital preservation, disciplined risk management and active value creation.',
        'criteria' => ['Scalable growth opportunities', 'Strong market potential', 'Governance improvement opportunities', 'Operational enhancement potential', 'Sustainable cash flow generation', 'Attractive risk-adjusted returns'],
        'strategies' => ['Private Equity', 'Growth Capital', 'Infrastructure', 'Impact Investing', 'Special Situations'],
    ],

    'sectors' => [
        ['icon' => 'bank', 'title' => 'Financial Services', 'text' => 'Banking, insurance, pensions and fintech.'],
        ['icon' => 'hotel', 'title' => 'Hospitality', 'text' => 'Hotels, resorts and hospitality infrastructure.'],
        ['icon' => 'leaf', 'title' => 'Agribusiness', 'text' => 'Agricultural production, processing and value-chain investments.'],
        ['icon' => 'basket', 'title' => 'Fast Moving Consumer Goods', 'text' => 'Consumer-focused businesses and processing enterprises.'],
        ['icon' => 'health', 'title' => 'Healthcare', 'text' => 'Healthcare delivery, diagnostics and health technology.'],
        ['icon' => 'chip', 'title' => 'FinTech', 'text' => 'Financial inclusion and technology-enabled financial services.'],
        ['icon' => 'sun', 'title' => 'Green Energy', 'text' => 'Renewable energy and sustainability-driven investments.'],
        ['icon' => 'bridge', 'title' => 'Infrastructure', 'text' => 'Transportation, utilities and economic infrastructure.'],
    ],

    'transactions' => [
        'intro' => 'The ACPL leadership team has participated in transactions and investments across multiple sectors and geographies.',
        'groups' => [
            ['sector' => 'Banking & Financial Services', 'icon' => 'bank', 'deals' => [
                ['name' => 'Unity Bank', 'type' => 'Acquisition transaction'],
                ['name' => 'UnityKapital Assurance', 'type' => 'Acquisition bid'],
                ['name' => 'Mainstreet Bank', 'type' => 'Consortium bid'],
                ['name' => 'Polaris Bank', 'type' => 'Consortium participation'],
            ]],
            ['sector' => 'Hospitality', 'icon' => 'hotel', 'deals' => [
                ['name' => 'Four Points by Sheraton', 'type' => 'Investment project'],
                ['name' => 'Marriott Branded Luxury Hotel', 'type' => 'Hotel project'],
                ['name' => 'Paradise Hotel', 'type' => 'Development'],
                ['name' => 'Amber Residence', 'type' => 'Investment'],
            ]],
            ['sector' => 'Technology & Innovation', 'icon' => 'chip', 'deals' => [
                ['name' => 'Eartholeum Networks', 'type' => 'Venture investment'],
                ['name' => 'Segana HealthTech', 'type' => 'Investment'],
            ]],
            ['sector' => 'Agribusiness & FMCG', 'icon' => 'leaf', 'deals' => [
                ['name' => 'Nembel SA', 'type' => 'Côte d’Ivoire'],
                ['name' => 'GX Foods', 'type' => 'Growth capital investment'],
            ]],
            ['sector' => 'Infrastructure', 'icon' => 'bridge', 'deals' => [
                ['name' => 'Federal Highway', 'type' => 'Concession initiative'],
                ['name' => 'Public Sector Revenue', 'type' => 'Collection project'],
            ]],
        ],
    ],

    'leadership' => [
        [
            'name' => 'Dr. Anthony Oboh',
            'role' => 'Chairman',
            'initials' => 'AO',
            'bio' => 'A respected private equity and venture capital professional with extensive experience in fund management, investment promotion, technology commercialization and enterprise development. Former Managing Director of Unique Venture Capital and Fund Manager of the West Africa Venture Fund.',
            'focus' => ['Private Equity', 'Venture Capital', 'Fund Management'],
        ],
        [
            'name' => 'Dominic Oje Isunuoya',
            'role' => 'Managing Director & CEO',
            'initials' => 'DI',
            'bio' => 'An accomplished investment professional with over three decades of experience spanning consulting, banking, private equity, investment management and capital raising. Has participated in fundraising efforts exceeding US$500 million across multiple sectors.',
            'focus' => ['Capital Raising', 'Investment Management', 'Banking'],
        ],
        [
            'name' => 'Johnny Ojeaga',
            'role' => 'Deputy Managing Director',
            'initials' => 'JO',
            'bio' => 'Experienced finance and governance professional with deep expertise in accounting, pensions administration, financial management and corporate governance.',
            'focus' => ['Corporate Governance', 'Pensions', 'Financial Management'],
        ],
        [
            'name' => 'Peter Afam Emeleugo',
            'role' => 'Director',
            'initials' => 'PE',
            'bio' => 'Business strategist, entrepreneur and innovation leader with extensive experience across technology, consulting, telecommunications and digital transformation.',
            'focus' => ['Strategy', 'Technology', 'Digital Transformation'],
        ],
    ],

    'differentiators' => [
        ['title' => 'Deep Experience', 'text' => 'Combined leadership experience spanning banking, investment management, private equity and advisory.'],
        ['title' => 'Strong Networks', 'text' => 'Access to investors, institutions and strategic partners.'],
        ['title' => 'Execution Capability', 'text' => 'Ability to move transactions from concept to completion.'],
        ['title' => 'Sector Knowledge', 'text' => 'Experience across key growth sectors.'],
        ['title' => 'Independent Advice', 'text' => 'Objective recommendations aligned with client interests.'],
        ['title' => 'Long-Term Relationships', 'text' => 'Commitment to sustainable value creation.'],
    ],

    'outlook' => [
        'headline' => 'Positioning for Africa’s Next Growth Cycle',
        'paragraphs' => [
            'Africa’s growth story will increasingly be driven by entrepreneurship, infrastructure development, technological innovation, financial inclusion and sustainable investment.',
            'ACPL is positioned to support this transformation by providing capital solutions, advisory expertise and investment capabilities that enable businesses and institutions to grow with confidence.',
            'We believe the future belongs to organizations capable of combining capital, innovation and execution.',
        ],
        'closing' => 'That is where ACPL creates value.',
        'drivers' => ['Entrepreneurship', 'Infrastructure', 'Technological innovation', 'Financial inclusion', 'Sustainable investment'],
    ],

    'enquiry_types' => [
        'advisory' => 'Corporate & transaction advisory',
        'capital' => 'Capital raising & project finance',
        'investment' => 'Investment opportunity',
        'partnership' => 'Partnership / co-investment',
        'other' => 'Something else',
    ],

];
