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
        'tagline' => 'Advisory. Capital. Investments.',
        'strapline' => 'Creating Sustainable Value Through Strategic Capital Solutions',
        'summary' => 'ACPL is a financial Advisory, Capital Solutions and Investment Management firm dedicated to helping businesses and institutions unlock growth opportunities through strategic advisory services, innovative financing arrangements and disciplined investment execution.',
        'address' => ['173 Ogudu Road', 'Ogudu, Lagos', 'Nigeria'],
        'phone' => '+234 802 326 1918',
        'phone_href' => '+2348023261918',
        'email' => 'info@angeluscapitalpartners.com',
        'website' => 'www.angeluscapitalpartners.com',
        'map_query' => '173 Ogudu Road, Ogudu, Lagos, Nigeria',

        // Corporate Affairs Commission registration number, e.g. 'RC 1234567'.
        // Shown in the footer and legal pages once filled in.
        'rc_number' => null,

        // Second office, shown beside the head office in the footer and on the contact page.
        'annex_label' => 'Head Office Annex',
        'annex_address' => ['19 Bemil Street', 'Ojodu Abiodun, Lagos', 'Nigeria'],

        // WhatsApp number in international format without "+" or spaces.
        'whatsapp' => '2348023261918',
        'whatsapp_message' => 'Hello Angelus Capital Partners, I would like to make an enquiry.',

        // Full LinkedIn company page URL, e.g. 'https://www.linkedin.com/company/angelus-capital-partners'.
        'linkedin' => 'https://www.linkedin.com/company/angelus-capital-partners-ltd',
    ],

    'navigation' => [
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'What We Do', 'route' => 'services'],
        ['label' => 'Sectors & Transactions', 'route' => 'sectors'],
        ['label' => 'Leadership', 'route' => 'leadership'],
        ['label' => 'Insights', 'route' => 'insights'],
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
        'intro' => 'Angelus Capital Partners Limited is an alternative asset firm. Through three integrated platforms — Advisory, Capital Solutions and Investments — we help businesses, projects and institutions access the strategic financing and growth support that conventional channels often cannot provide.',
        'pillars' => [
            ['title' => 'Alternative asset specialists', 'text' => 'Our space within financial services: private equity, venture capital, structured and alternative capital — going beyond conventional banking to fund growth.'],
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
        // Ordered to spell PIRIT.
        ['title' => 'Professionalism', 'icon' => 'shield', 'text' => 'Delivering excellence through expertise and discipline.'],
        ['title' => 'Integrity', 'icon' => 'scale', 'text' => 'Maintaining the highest ethical standards.'],
        ['title' => 'Relationships', 'icon' => 'handshake', 'text' => 'Building long-term partnerships founded on trust.'],
        ['title' => 'Insight', 'icon' => 'target', 'text' => 'Applying deep market knowledge and analytical thinking.'],
        ['title' => 'Team Spirit', 'icon' => 'users', 'text' => 'Collaborating effectively to create exceptional outcomes.'],
    ],

    'platforms' => [
        [
            'key' => 'advisory',
            'title' => 'Advisory',
            'summary' => 'Helping businesses make better strategic and financial decisions.',
            'items' => ['Corporate Finance', 'Mergers & Acquisitions Support', 'Restructuring & Turnaround', 'Business Planning', 'Due Diligence', 'Compliance Advisory – E-Invoicing'],
        ],
        [
            'key' => 'capital',
            'title' => 'Capital Solutions',
            'summary' => 'Connecting enterprises with appropriate funding sources.',
            'items' => ['Equity Capital', 'Debt Financing', 'Mezzanine Capital', 'Structured Finance', 'Alternative Capital Solutions', 'Project Finance'],
        ],
        [
            'key' => 'investments',
            'title' => 'Investments',
            'summary' => 'Creating value through disciplined investment execution.',
            'items' => ['Private Equity', 'Infrastructure Investments', 'Impact Investments', 'Growth Capital', 'Special Situations'],
        ],
    ],

    'value_proposition' => [
        'statement' => 'ACPL is a financial Advisory, Capital Solutions and Investment Management firm dedicated to helping businesses and institutions unlock growth opportunities through strategic advisory services, innovative financing arrangements and disciplined investment execution.',
        // One promise per platform, in platform order.
        'promises' => [
            ['platform' => 'Advisory', 'icon' => 'compass', 'title' => 'Strategic advisory services', 'text' => 'Sound strategic and financial decisions, from corporate finance to compliance.'],
            ['platform' => 'Capital Solutions', 'icon' => 'coins', 'title' => 'Innovative financing arrangements', 'text' => 'The right capital, in the right structure, from the right providers.'],
            ['platform' => 'Investments', 'icon' => 'chart', 'title' => 'Disciplined investment execution', 'text' => 'Capital preservation, risk management and active value creation.'],
        ],
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
        ['title' => 'Equity Capital', 'risk' => 'Highest risk · highest return potential', 'text' => 'Ownership capital from private equity funds, strategic and institutional investors. Investors share both the upside and the risk, so there are no fixed repayments.', 'suits' => 'Growth, expansion and strategic transformation'],
        ['title' => 'Mezzanine Capital', 'risk' => 'Balanced risk / return', 'text' => 'Subordinated debt or preferred instruments that sit between senior debt and equity. Raises more than lenders alone will provide while limiting dilution for owners.', 'suits' => 'Acquisitions, buyouts and late-stage growth'],
        ['title' => 'Structured Finance', 'risk' => 'Tailored risk allocation', 'text' => 'Bespoke instruments built around specific cash flows, contracts or assets — such as receivables, offtake agreements or project revenues.', 'suits' => 'Asset-backed and cash-flow-backed funding'],
        ['title' => 'Debt Financing', 'risk' => 'Lowest cost of capital', 'text' => 'Senior term loans, working capital and trade facilities from commercial banks, development finance institutions and institutional lenders.', 'suits' => 'Established businesses with predictable cash flows'],
    ],
    'alternative_capital' => [
        'title' => 'Alternative Capital Solutions',
        'text' => 'When conventional bank or equity structures do not fit, we arrange non-traditional funding built around the opportunity — the natural home of an alternative asset firm.',
        'items' => ['Private credit & direct lending', 'Asset-backed & receivables financing', 'Supply-chain & trade finance', 'Co-investment & joint ventures', 'Blended & impact finance'],
    ],

    'project_finance' => [
        'headline' => 'Structuring Bankable Projects',
        'intro' => 'We assist clients in developing projects capable of attracting institutional capital.',
        'services' => ['Project structuring', 'Financial modeling', 'Capital strategy development', 'Risk allocation frameworks', 'Funding arrangement support', 'Investor engagement'],
        'sources' => ['Institutional Investors', 'Development Finance Institutions', 'Commercial Banks', 'Private Equity Funds', 'Family Offices', 'Strategic Investors', 'Impact Investors'],
    ],

    'investment' => [
        'headline' => 'Investing for Growth and Long-Term Value',
        'philosophy' => 'Our investment philosophy combines capital preservation, disciplined risk management and active value creation.',
        'criteria' => [
            ['icon' => 'chart', 'title' => 'Growth potential', 'text' => 'Scalable businesses and projects in markets with strong demand.'],
            ['icon' => 'layers', 'title' => 'Room to add value', 'text' => 'Clear scope to strengthen governance and operations.'],
            ['icon' => 'coins', 'title' => 'Sustainable cash flows', 'text' => 'Durable, predictable cash generation.'],
            ['icon' => 'target', 'title' => 'Risk-adjusted returns', 'text' => 'Attractive returns for the risk taken.'],
        ],
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
        ['title' => 'Objective Advice', 'text' => 'Recommendations aligned with client interests.'],
        ['title' => 'Long-Term Relationships', 'text' => 'Commitment to sustainable value creation.'],
    ],

    'outlook' => [
        'headline' => 'Positioning for Africa’s Next Growth Cycle',
        'paragraphs' => [
            'Africa’s growth story will increasingly be driven by entrepreneurship, infrastructure development, technological innovation, financial inclusion and sustainable investment.',
            'ACPL is positioned to support this transformation by providing advisory expertise, capital solutions and investment capabilities that enable businesses and institutions to grow with confidence.',
            'We believe the future belongs to organizations capable of combining capital, innovation and execution.',
        ],
        'closing' => 'That is where ACPL creates value.',
        'drivers' => ['Entrepreneurship', 'Infrastructure', 'Technological innovation', 'Financial inclusion', 'Sustainable investment'],
    ],

    /*
    | The scrolling strip under the home page hero. Use it for announcements
    | ('text', optional 'url') or partner logos ('logo' => 'images/partners/x.webp',
    | 'text' => partner name, used as the alt text).
    */
    'ticker' => [
        'label' => 'Latest from ACPL',
        'items' => [
            ['text' => 'Compliance Advisory – NRS e-invoicing now available under our Advisory platform', 'url' => '/what-we-do#einvoice'],
            ['text' => 'Advisory · Capital Solutions · Investments — three integrated platforms, one partner'],
            ['text' => 'Leadership participation in US$500M+ of fundraising across multiple sectors', 'url' => '/sectors-and-transactions#transactions'],
            ['text' => 'Insight: What makes a project bankable?', 'url' => '/insights/what-makes-a-project-bankable'],
        ],
    ],

    /*
    | "Partner with ACPL" call to action at the foot of each page, written for
    | that page's visitor. 'enquiry' preselects the topic on the contact form.
    */
    'ctas' => [
        'home' => [
            'title' => 'Let’s build what’s next, together.',
            'lead' => 'Whether you are raising capital, structuring a project or seeking quality investment opportunities, our team is ready to partner with you.',
            'points' => [],
            'action' => 'Start a conversation',
            'enquiry' => null,
        ],
        'about' => [
            'title' => 'Is financing holding your growth back?',
            'lead' => 'Capital that is hard to reach, too expensive or poorly structured stalls good businesses. Tell us where you are stuck — we will find the right solution and see it through.',
            'points' => ['Limited access to the right funding', 'High cost of capital', 'Projects that are not yet bankable', 'Debt that needs restructuring'],
            'action' => 'Talk to us about financing',
            'enquiry' => 'capital',
        ],
        'services' => [
            'title' => 'Have a mandate for us?',
            'lead' => 'Advisory, capital raising or investment — tell us about the mandate and we will show you how our three integrated platforms work together to deliver it.',
            'points' => ['Advisory & transaction mandates', 'Compliance advisory – e-invoicing', 'Capital raising & project finance', 'Investment management'],
            'action' => 'Discuss a mandate',
            'enquiry' => null,
        ],
        'sectors' => [
            'title' => 'Growing a business in one of our sectors?',
            'lead' => 'Our leadership has done transactions in your industry. Speak with us about advisory support, capital raising or investment partnership built around your sector.',
            'points' => ['Financial Services', 'Hospitality', 'Agribusiness', 'FMCG', 'Healthcare', 'FinTech'],
            'action' => 'Speak to our sector team',
            'enquiry' => null,
        ],
        'leadership' => [
            'title' => 'Put our experience to work for you.',
            'lead' => 'Every engagement is led by senior people with decades of banking, private equity, audit and governance experience. Meet the team that will work on your transaction.',
            'points' => ['Senior-led engagements', 'US$500M+ fundraising track record', '30+ years of experience'],
            'action' => 'Meet with our team',
            'enquiry' => null,
        ],
        'insights' => [
            'title' => 'Have an idea worth exploring?',
            'lead' => 'If something here sparks a question about capital, growth or a transaction you are considering, our team would welcome the conversation.',
            'points' => ['Market outlook', 'Project bankability', 'Capital strategy'],
            'action' => 'Share your idea with us',
            'enquiry' => null,
        ],
    ],

    // The brand banner shown above the footer on every page.
    'profile_banner' => [
        ['icon' => 'target', 'line' => 'Strategic Advice', 'sub' => 'That Drives Value'],
        ['icon' => 'handshake', 'line' => 'Capital Solutions', 'sub' => 'That Empower Growth'],
        ['icon' => 'chart', 'line' => 'Investments', 'sub' => 'That Create Impact'],
        ['icon' => 'leaf', 'line' => 'Sustainable Value.', 'sub' => 'Enduring Impact.'],
    ],

    /*
    | Advertising landing page (/partner). Edit the copy here.
    */
    'landing' => [
        'title' => 'Raise capital. Structure the deal. <span class="text-gold-gradient">Grow with confidence.</span>',
        'lead' => 'Angelus Capital Partners helps businesses and institutions unlock growth through strategic advisory services, innovative financing arrangements and disciplined investment execution.',
        // In platform order: Advisory, Capital Solutions, Investments.
        'points' => [
            'Advisory: M&A support, due diligence, investor readiness and e-invoicing compliance',
            'Capital Solutions: equity, debt, mezzanine, structured and project finance',
            'Investments: private equity, growth capital, infrastructure and impact',
        ],
        'stats' => [
            ['value' => '$500M+', 'label' => 'Fundraising our MD & CEO has participated in'],
            ['value' => '30+', 'label' => 'Years of leadership experience'],
            ['value' => '3', 'label' => 'Integrated platforms'],
        ],
        'help' => [
            'eyebrow' => 'How we help',
            'title' => 'Three integrated platforms working for you.',
            'lead' => 'Most growth challenges need more than one kind of expertise. Our platforms work together, so you deal with one accountable partner from strategy to funding to long-term value.',
        ],
        'process' => [
            'eyebrow' => 'Our engagement process',
            'title' => 'From conversation to completion.',
            'steps' => [
                ['title' => 'Confidential consultation', 'text' => 'We listen to your objectives, timelines and constraints.'],
                ['title' => 'Assessment & structuring', 'text' => 'Due diligence, financial modeling and the right capital structure.'],
                ['title' => 'Capital mobilisation', 'text' => 'We engage institutional, strategic and impact capital providers.'],
                ['title' => 'Execution & beyond', 'text' => 'We move the transaction to completion and support long-term value creation.'],
            ],
        ],
        'final' => [
            'title' => 'What is standing between you and your next stage of growth?',
            'lead' => 'A funding gap, a project that is not yet bankable, costly debt or compliance pressure — tell us the problem and we will map a clear path to resolve it.',
            'points' => ['Funding gap', 'Unbankable project', 'Costly debt', 'Compliance pressure'],
        ],
    ],

    /*
    | Pre-consultation questionnaire on the landing page. Answers travel to the
    | contact form and are included in the enquiry email and CRM record.
    */
    'questionnaire' => [
        'profile' => [
            'label' => 'Which best describes you?',
            'options' => ['Business or SME', 'Project sponsor', 'Investor or institution', 'Public sector agency', 'Other'],
        ],
        'challenge' => [
            'label' => 'What is your biggest challenge right now?',
            'options' => ['Accessing the right funding', 'High cost of capital', 'Making a project bankable', 'Restructuring existing debt', 'Getting investor-ready', 'Regulatory compliance', 'Finding quality investments'],
        ],
        'size' => [
            'label' => 'Approximate transaction size',
            'options' => ['Under ₦500 million', '₦500 million – ₦5 billion', 'Above ₦5 billion', 'Not sure yet'],
        ],
        'timeline' => [
            'label' => 'When would you like to start?',
            'options' => ['Within 3 months', 'In 3 – 6 months', 'In 6 – 12 months', 'Just exploring'],
        ],
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

    // Listed in platform order: Advisory, Capital Solutions, Investments.
    'enquiry_types' => [
        'advisory' => 'Advisory – corporate & transaction',
        'einvoice' => 'Advisory – e-invoicing compliance',
        'capital' => 'Capital solutions & project finance',
        'investment' => 'Investment opportunity',
        'partnership' => 'Partnership / co-investment',
        'other' => 'Something else',
    ],

    /*
    | Each enquiry type is routed to the business unit that handles it. Set the
    | unit mailboxes in .env (ENQUIRY_EMAIL_ADVISORY=...); any left blank fall
    | back to the main company email address.
    */
    'enquiry_routing' => [
        'advisory' => ['unit' => 'Corporate & Transaction Advisory', 'email' => env('ENQUIRY_EMAIL_ADVISORY')],
        'capital' => ['unit' => 'Capital Raising & Project Finance', 'email' => env('ENQUIRY_EMAIL_CAPITAL')],
        'investment' => ['unit' => 'Investment Management', 'email' => env('ENQUIRY_EMAIL_INVESTMENT')],
        'partnership' => ['unit' => 'Partnerships & Co-investment', 'email' => env('ENQUIRY_EMAIL_PARTNERSHIP')],
        'einvoice' => ['unit' => 'Advisory – E-Invoicing Compliance', 'email' => env('ENQUIRY_EMAIL_EINVOICE')],
        'other' => ['unit' => 'General Enquiries', 'email' => env('ENQUIRY_EMAIL_GENERAL')],
    ],

    /*
    | HubSpot CRM. With a portal ID and form GUID set, every website enquiry is
    | also submitted to that HubSpot form so it appears in the CRM pipeline.
    | The portal ID alone loads HubSpot tracking (and live chat, if enabled).
    */
    'hubspot' => [
        'portal_id' => env('HUBSPOT_PORTAL_ID'),
        'form_guid' => env('HUBSPOT_FORM_GUID'),
    ],

    /*
    | Pre-launch integration check at /launch-check?key=... (email, CRM,
    | tracking). Disabled unless LAUNCH_CHECK_KEY is set; remove the key from
    | .env once the site is live and verified.
    */
    'launch_check_key' => env('LAUNCH_CHECK_KEY'),

    /*
    | Any CRM that accepts a webhook (e.g. DoubleSpace). With a URL set, every
    | enquiry is also posted to it as JSON; the token, if given, is sent as a
    | Bearer authorization header.
    */
    'crm' => [
        'name' => env('CRM_NAME', 'DoubleSpace'),
        'webhook_url' => env('CRM_WEBHOOK_URL'),
        'token' => env('CRM_WEBHOOK_TOKEN'),
    ],

    // E-invoicing is a service of the Advisory platform, not a platform of its own.
    'einvoice' => [
        'title' => 'Compliance Advisory – E-Invoicing',
        'summary' => 'Practical advisory support for businesses preparing for and complying with the Nigeria Revenue Service (NRS) e-invoicing implementation.',
        'points' => [
            'Readiness assessment of your invoicing processes and systems',
            'Implementation planning and coordination with your finance and IT teams',
            'Ongoing compliance advice as requirements evolve',
        ],
    ],

    /*
    | News & Insights. Newest first. Each article is a list of paragraphs;
    | a paragraph starting with "## " is shown as a sub-heading.
    */
    'insights' => [
        [
            'slug' => 'positioning-for-africas-next-growth-cycle',
            'title' => 'Positioning for Africa’s Next Growth Cycle',
            'category' => 'Outlook',
            'date' => '2026-10-18',
            'author' => 'Angelus Capital Partners',
            'excerpt' => 'Entrepreneurship, infrastructure, technological innovation, financial inclusion and sustainable investment will drive the continent’s next chapter. Here is how advisory, capital and execution come together.',
            'body' => [
                'Africa’s growth story will increasingly be driven by entrepreneurship, infrastructure development, technological innovation, financial inclusion and sustainable investment.',
                '## Capital alone is not enough',
                'The ability of businesses and economies to grow sustainably is increasingly dependent on access to the right capital, sound governance, strategic leadership and effective execution. Capital is most impactful when it is combined with deep insight, strong relationships and disciplined execution.',
                '## Where the opportunity lies',
                'We see sustained opportunity across financial services, hospitality, agribusiness, fast moving consumer goods, healthcare and fintech — sectors where well-structured capital can unlock scale, improve governance and create lasting value for investors and communities alike.',
                '## Our role',
                'ACPL is positioned to support this transformation by providing advisory expertise, capital solutions and investment capabilities that enable businesses and institutions to grow with confidence. We believe the future belongs to organizations capable of combining capital, innovation and execution.',
                'That is where ACPL creates value.',
            ],
        ],
        [
            'slug' => 'what-makes-a-project-bankable',
            'title' => 'What Makes a Project Bankable?',
            'category' => 'Project Finance',
            'date' => '2026-10-18',
            'author' => 'Angelus Capital Partners',
            'excerpt' => 'Institutional capital is available for the right projects. The difference between a good idea and a fundable one is structure — here is what investors and lenders look for.',
            'body' => [
                'Institutional investors, development finance institutions, commercial banks, private equity funds, family offices, strategic and impact investors are all actively seeking quality opportunities. Yet many promising projects never reach financial close. The gap is rarely ambition — it is structure.',
                '## What capital providers look for',
                'In our experience, investors focus on businesses and projects that demonstrate scalable growth opportunities, strong market potential, room for governance and operational improvement, sustainable cash flow generation and attractive risk-adjusted returns.',
                '## Building a bankable project',
                'A bankable project is one that has been prepared to meet those expectations. That typically means robust project structuring, a credible financial model, a clear capital strategy, a well-defined risk allocation framework, and the right funding arrangements — supported by early and well-prepared investor engagement.',
                '## Getting investor-ready',
                'Due diligence, feasibility studies and a clear business plan give capital providers the confidence to commit. Preparing these properly, before going to market, shortens transaction timelines and improves terms.',
                'ACPL works with project sponsors and businesses across this journey — from structuring and modeling to capital mobilisation and transaction execution. If you are preparing a project for funding, we would welcome a conversation.',
            ],
        ],
    ],

];
