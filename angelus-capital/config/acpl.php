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
        ['value' => 6, 'prefix' => '', 'suffix' => '', 'label' => 'Sectors of focus', 'note' => 'From financial services to healthcare and fintech'],
        ['value' => 500, 'prefix' => '$', 'suffix' => 'M+', 'label' => 'Fundraising track record', 'note' => 'US$ fundraising participation by our leadership across multiple sectors'],
        ['value' => 30, 'prefix' => '', 'suffix' => '+', 'label' => 'Years of leadership experience', 'note' => 'Consulting, banking, private equity and capital raising'],
    ],

    'chairman' => [
        'name' => 'Dr. Anthony Oboh',
        'photo' => 'images/team/anthony-oboh.webp',
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
            'slug' => 'anthony-oboh',
            'name' => 'Dr. Anthony Oboh',
            'role' => 'Chairman',
            'initials' => 'AO',
            'photo' => 'images/team/anthony-oboh.webp',
            'bio' => 'A respected private equity and venture capital professional with extensive experience in fund management, investment promotion, technology commercialization and enterprise development. Former Managing Director of Unique Venture Capital and Fund Manager of the West Africa Venture Fund.',
            'intro' => 'Dr. Anthony O. Oboh is a distinguished corporate leader, high-finance strategist, and a pioneer of the West African venture capital (VC) and private equity ecosystem. With over two decades of executive experience spanning investment management, joint venture structuring, industrial consultancy, and public-private sector partnerships, he brings a unique blend of technical mastery and alternative investment expertise to the Board.',
            'focus' => ['Venture Capital', 'Private Equity', 'Fund Management'],
            'expertise' => [
                'Corporate Finance & Venture Capital Operations',
                'Technology Commercialization & Joint Venture Structuring',
                'Industrial Consultancy & Investment Promotion',
                'Post-Conflict Economy Risk Mitigation & Fund Management',
            ],
            'milestones' => [
                [
                    'title' => 'Pioneer of West African Venture Capital',
                    'lead' => 'Dr. Oboh is highly regarded for laying the foundational regulatory and conceptual framework for small and medium enterprise (SME) equity financing across West Africa.',
                    'items' => [
                        ['label' => 'Unique Venture Capital (UVC)', 'text' => 'He served for 14 years (2004–2018) as the Managing Director and Chief Executive Officer of UVC, a premier foundational venture firm established by a consortium of major Nigerian banks to engineer early-stage risk-capital funding.'],
                        ['label' => 'West Africa Venture Fund (WAVF)', 'text' => 'Concurrently, he served as the Fund Manager for the WAVF. Backed directly by institutional heavyweights including the International Finance Corporation (IFC), this landmark fund deployed vital growth capital to SMEs across sub-Saharan Africa, specifically targeting the post-conflict economies of Liberia and Sierra Leone.'],
                        ['label' => 'Market Infrastructure Building', 'text' => 'Operating in a business terrain historically resistant to shared ownership, Dr. Oboh successfully led strategic regional campaigns that educated family-owned businesses and local entrepreneurs on utilizing equity financing as an essential tool for institutional scaling.'],
                    ],
                ],
                [
                    'title' => 'The Academic & Engineering Foundation',
                    'lead' => 'What distinguishes Dr. Oboh within the executive asset management space is his transition from advanced STEM research to institutional finance, allowing him to conduct deep technical due diligence that standard investment managers cannot match.',
                    'items' => [
                        ['label' => 'Industrial & Technical Synergy', 'text' => 'He spent several years at Nigeria’s premier University of Ibadan (UI), climbing the academic ladder to earn his BSc, MSc, and a PhD in Food Process Engineering. His technical research in crop processing and storage directly shapes his elite capabilities in auditing manufacturing, agro-processing, and hardware entities before deploying capital.'],
                        ['label' => 'Financial Specialization', 'text' => 'To bridge his technical background with corporate finance, he completed an Action Learning MBA from the Business School Netherlands (BSN), alongside extensive local and international advanced management and project tracking programs.'],
                    ],
                ],
                [
                    'title' => 'Corporate Governance & Transnational Leadership',
                    'lead' => 'Dr. Oboh’s boardroom footprint reflects an established history of steering organizational change, technical commercialization, and cross-border commercial trade.',
                    'items' => [
                        ['label' => 'Boardroom Leadership', 'text' => 'Beyond his investment mandates, he has served as the Chairman of the Board for Beta Computers Limited, where he collaborated with the Federal Government of Nigeria to accelerate domestic IT infrastructure and locally manufactured computing goods. His transnational directorship portfolio includes serving as Chairman for regional maritime, energy, and supply chain enterprises, such as GLS Inc. Liberia.'],
                        ['label' => 'Professional Advocacy', 'text' => 'A sought-after panelist and ecosystem resource person, he actively influences policy conversations at leading professional conferences. He is also deeply embedded in elite networking circles, having served as the Vice-Captain of the historic Ikoyi Club 1938 (Golf Section) in Lagos, where he brokered high-value corporate sponsorships with top-tier commercial financial institutions.'],
                    ],
                ],
            ],
        ],
        [
            'slug' => 'dominic-isunuoya',
            'name' => 'Dominic Oje Isunuoya',
            'role' => 'Managing Director & CEO',
            'initials' => 'DI',
            'photo' => 'images/team/dominic-isunuoya.webp',
            'bio' => 'An accomplished investment professional with over three decades of experience spanning consulting, banking, private equity, investment management and capital raising. Has participated in fundraising efforts exceeding US$500 million across multiple sectors.',
            'intro' => 'Dominic Oje Isunuoya is a highly accomplished alternative investments leader, financial architect, and strategic growth expert. With over three decades of professional experience bridging international audit practices, commercial banking, private equity (PE), and venture capital, he specializes in transaction structuring and corporate turnaround across sub-Saharan Africa. His deep expertise spans critical sectors including financial services, oil and gas, agribusiness, hospitality, ICT, healthcare, and real estate.',
            'focus' => ['Private Equity', 'Capital Raising', 'Turnarounds'],
            'expertise' => [
                'Corporate Buyouts, Growth Investments, & Distressed Asset Turnarounds',
                'Institutional Risk Management & Financial Reporting',
                'Information Systems Audit & Database Governance',
                'Agribusiness Value-Chain Investment Architecture',
            ],
            'milestones' => [
                [
                    'title' => 'Private Equity & Venture Capital Leadership',
                    'lead' => 'Dominic has spent well over a decade deploying capital and designing innovative transaction frameworks to scale mid-market enterprises and distressed assets.',
                    'items' => [
                        ['label' => 'Angelus Capital Partners', 'text' => 'He currently serves as the Chief Executive Officer of Angelus Capital Partners Ltd, where he drives institutional fundraising, structures private investment placements, and manages prime real estate asset portfolios.'],
                        ['label' => 'Keynes Private Equity', 'text' => 'As the former Managing Director and CEO of Keynes Private Equity, he steered targeted growth capital into emerging sectors, transforming local SMEs into highly competitive corporate entities.'],
                        ['label' => 'Assetswise Capital', 'text' => 'Serving as Vice President and later Chief Investment Officer/Executive Director, he led complex, high-value corporate actions, including a foundational venture capital stake in tech firm Eartholeum Networks and the strategic acquisition of Seric Impianti International Limited.'],
                    ],
                ],
                [
                    'title' => 'Institutional Banking & Audit Foundations',
                    'lead' => 'Before transitioning to asset management, Dominic built an airtight 17-year background in financial compliance, risk analysis, and corporate relationship banking across top-tier financial institutions.',
                    'items' => [
                        ['label' => 'PwC Audit Mastery', 'text' => 'He launched his professional career within the Audit and Business Advisory Services division of Price Waterhouse (now PwC) in Lagos, establishing deep expertise in corporate governance and taxation.'],
                        ['label' => 'Operational Risk Supervision', 'text' => 'He specialized in internal control and inspectorate frameworks at Diamond Bank before escalating to Senior Manager at the United Bank for Africa (UBA), where he directed Branch Operational Risk Management Supervision across the North Central Region.'],
                        ['label' => 'Commercial Revenue Generation', 'text' => 'He served as Chief Inspector for Indo-Nigeria Bank and later shifted into core retail banking leadership, managing corporate relationships along Lagos’ primary industrial hubs for Sterling Bank following the historic 2006 banking consolidation.'],
                    ],
                ],
                [
                    'title' => 'Dual-Domain Expertise: Agribusiness & Tech Governance',
                    'lead' => 'Dominic possesses a rare technical profile that blends agricultural science with advanced database auditing, making him a unique asset for multi-sector board oversight.',
                    'items' => [
                        ['label' => 'Agribusiness Synergy', 'text' => 'He holds a Second Class Upper BSc in Agronomy from the University of Calabar alongside an MBA in Banking & Finance. This background allows him to conduct deep, scientific due diligence on complex agribusiness operations that standard financial managers cannot accurately evaluate.'],
                        ['label' => 'Advanced Digital Governance', 'text' => 'He is a Fellow of the Institute of Chartered Accountants of Nigeria (FCA). To secure a digital edge, he also qualified as a Certified Information Systems Auditor (CISA) and a Certified Oracle Database Administrator (OCA), allowing him to audit both a company’s financial ledgers and its digital software infrastructure.'],
                    ],
                ],
            ],
        ],
        [
            'slug' => 'johnny-ojeaga',
            'name' => 'Johnny Ojeaga',
            'role' => 'Deputy Managing Director',
            'initials' => 'JO',
            'photo' => 'images/team/johnny-ojeaga.webp',
            'bio' => 'Experienced finance and governance professional with deep expertise in accounting, pensions administration, financial management and corporate governance.',
            'intro' => 'Johnny Ebosele Ojeaga is a seasoned financial administrator, compliance anchor, and corporate governance specialist. With a distinguished career built on managing heavy capital operations, navigating intense regulatory oversight, and stabilizing high-risk corporate frameworks, he represents the vital structural pillar of fiscal discipline, enterprise risk control, and regulatory shielding. His expansive experience spans the pension, aviation, energy engineering, and public health sectors.',
            'focus' => ['Pensions', 'Corporate Governance', 'Audit & Compliance'],
            'expertise' => [
                'Pension Fund Administration (PFA) & Regulatory Liaison',
                'Heavy Industrial Procurement & Capital Asset Auditing',
                'Corporate Tax Strategy & Statutory Compliance',
                'Internal Audit, Budgetary Control, & Fiscal Shielding',
            ],
            'milestones' => [
                [
                    'title' => 'The Pension Regulatory Anchor (The PenCom Era)',
                    'lead' => 'Johnny’s career is defined by his selection to lead critical financial operations during a period of intense regulatory intervention in Nigeria’s wealth management market.',
                    'items' => [
                        ['label' => 'First Guarantee Pension Limited (FGPL)', 'text' => 'Johnny joined FGPL as Head of Finance and rose to become the Executive Director of Finance, Investments, and Administration, directly overseeing billions in consumer pension assets.'],
                        ['label' => 'The PenCom Intervention Team', 'text' => 'Following shareholder friction that forced the pioneer board to step down, the National Pension Commission (PenCom) handpicked Johnny to serve on its elite Interim Management Committee (IMC). For nearly eight years, he safely anchored and stabilized the firm’s financial operations under active regulatory supervision, ensuring zero loss of consumer capital. This structural recovery successfully paved the way for the company’s ultimate consolidation into what is today Access Pensions.'],
                    ],
                ],
                [
                    'title' => 'Heavy Capital & Industrial Operations',
                    'lead' => 'Before stabilizing pension frameworks, Johnny spent over a decade controlling cash flows and driving financial compliance inside operationally complex, high-turnover industries.',
                    'items' => [
                        ['label' => 'Arik Airlines Limited', 'text' => 'He served as Senior Manager of Audit and ultimately escalated to General Manager of Audit for the aviation giant. Controlling volatile daily cash flows, international fuel procurement, and complex aircraft leasing audits provided him with elite training in enterprise risk management.'],
                        ['label' => 'Negris Limited', 'text' => 'As Finance Manager for this major domestic energy and oilfield servicing company, he managed capital-intensive engineering procurements, heavy machinery asset depreciation, and joint-venture project finances.'],
                        ['label' => 'Public Healthcare Administration', 'text' => 'He began building his financial management foundation within the public health sector, serving as an Accountant I at the prestigious University of Benin Teaching Hospital (UBTH).'],
                    ],
                ],
                [
                    'title' => 'Professional Governance & Academic Leadership',
                    'lead' => 'Johnny is deeply embedded in the formal architecture that regulates and examines financial accounting practices across Nigeria.',
                    'items' => [
                        ['label' => 'ICAN Examination Pillar', 'text' => 'Aside from being a Fellow of the Institute of Chartered Accountants of Nigeria (FCA), he directly shapes the next generation of financial experts by serving on ICAN’s influential ATSWA Examination Committee. He also previously served on ICAN’s Budget and Control Committee, proving his alignment with strict institutional budget management.'],
                        ['label' => 'Taxation & Executive Education', 'text' => 'He is an Associate Member of the Chartered Institute of Taxation of Nigeria (CITN), providing the board with advanced tax-mitigation strategies. He roots his accounting expertise in an HND from Auchi Polytechnic and holds an MBA in Business Administration from Ambrose Alli University, Ekpoma.'],
                    ],
                ],
            ],
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

    /*
    | Advertising tags. Leave blank to disable. Set them in the .env file:
    | GOOGLE_TAG_ID=AW-XXXXXXXXX (or G-XXXXXXX) and META_PIXEL_ID=1234567890.
    | The landing page "thank you" screen reports a lead conversion.
    */
    'tracking' => [
        'google_tag' => env('GOOGLE_TAG_ID'),
        'google_ads_conversion' => env('GOOGLE_ADS_CONVERSION'),
        'meta_pixel' => env('META_PIXEL_ID'),
    ],

    'enquiry_types' => [
        'advisory' => 'Corporate & transaction advisory',
        'capital' => 'Capital raising & project finance',
        'investment' => 'Investment opportunity',
        'partnership' => 'Partnership / co-investment',
        'other' => 'Something else',
    ],

];
