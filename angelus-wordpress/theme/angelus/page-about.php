<?php
/**
 * Template: page-about.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;
?>
<?php acpl_start( 'layouts.app', ['title' => 'About Us', 'description' => acpl('about.intro')] ); ?>
    <?php
        $chairman = acpl_chairman();
        $values = acpl('values');
        $segmentCount = count($values);
    ?>

    <?php acpl_c( 'page-hero', ['index' => '01', 'eyebrow' => 'About Angelus Capital Partners', 'title' => 'Building institutions. Enabling growth. <span class=\'text-gold-gradient\'>Creating value.</span>', 'lead' => acpl('about.intro')] ); ?>

    <?php /* Who we are */ ?>
    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-16 lg:grid-cols-2">
            <?php acpl_c( 'section-heading', ['eyebrow' => 'Who we are', 'title' => 'Capital, insight and execution — under one roof.'] ); ?>
            <div class="space-y-6 text-lg leading-relaxed text-mist" data-reveal>
                <p>As an alternative asset company, we work where conventional financing often falls short — providing advisory, capital and investment solutions across the entire capital lifecycle, from business strategy and project development to capital raising, transaction execution and investment management.</p>
                <p>Our professionals bring together decades of experience spanning banking, private equity, venture capital, corporate finance, project finance, investment management, restructuring and business transformation.</p>
            </div>
        </div>

        <div class="container-x mt-20 grid grid-cols-1 gap-6 md:grid-cols-3">
            <?php foreach ( acpl_loop( acpl('about.pillars') ) as [ $loop1, , $pillar ] ) : ?>
                <article class="card-light relative overflow-hidden p-10" data-reveal style="--reveal-delay: <?php echo esc_html( $loop1->index * 100 ); ?>ms">
                    <span class="absolute top-0 left-10 h-1 w-16 rounded-b-full bg-gradient-to-r from-gold-400 to-ember"></span>
                    <span class="font-display text-6xl text-navy-900/10">0<?php echo esc_html( $loop1->iteration ); ?></span>
                    <h3 class="mt-6 font-display text-2xl text-navy-900"><?php echo esc_html( $pillar['title'] ); ?></h3>
                    <p class="mt-3 leading-relaxed text-mist"><?php echo esc_html( $pillar['text'] ); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <?php /* Three integrated platforms */ ?>
    <section class="on-dark grain relative isolate overflow-hidden bg-navy-900 py-24 text-white sm:py-32">
        <div class="grid-lines absolute inset-0 -z-10"></div>
        <div class="absolute top-1/3 left-1/2 -z-10 size-[44rem] -translate-x-1/2 rounded-full bg-navy-600/35 blur-[140px]"></div>

        <div class="container-x">
            <?php acpl_c( 'section-heading', ['eyebrow' => 'Our three integrated platforms', 'title' => 'Advisory. Capital. <span class=\'text-gold-gradient\'>Investments.</span>', 'lead' => 'Three platforms, always working together around one company, so every client benefits from the full strength of ACPL.', 'align' => 'center', 'dark' => true] ); ?>

            <div class="mt-16 grid grid-cols-1 items-center gap-14 lg:grid-cols-2">
                <?php acpl_c( 'platform-venn', ['class' => 'mx-auto w-full max-w-lg', 'data-reveal' => 'zoom'] ); ?>

                <ol class="flex flex-col gap-5">
                    <?php foreach ( acpl_loop( acpl('platforms') ) as [ $loop1, , $platform ] ) : ?>
                        <li class="card-dark flex gap-5 p-7" data-reveal="right" style="--reveal-delay: <?php echo esc_html( $loop1->index * 110 ); ?>ms">
                            <span class="font-display text-4xl text-gold-400">0<?php echo esc_html( $loop1->iteration ); ?></span>
                            <div>
                                <h3 class="font-display text-2xl"><?php echo esc_html( $platform['title'] ); ?></h3>
                                <p class="mt-2 text-white/65"><?php echo esc_html( $platform['summary'] ); ?></p>
                                <a href="<?php echo esc_url( acpl_url('services') ); ?>#<?php echo esc_html( $platform['key'] ); ?>" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-gold-300 transition hover:gap-3">Explore <?php echo esc_html( $platform['title'] ); ?> <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </section>

    <?php /* Who we serve */ ?>
    <section class="relative overflow-hidden bg-ivory py-24 sm:py-32">
        <div class="brand-lines absolute inset-0"></div>
        <div class="container-x relative">
            <?php acpl_c( 'section-heading', ['eyebrow' => 'We serve', 'title' => 'Trusted by those who provide — and need — capital.', 'align' => 'center'] ); ?>
            <ul class="mt-16 flex flex-wrap justify-center gap-4">
                <?php foreach ( acpl_loop( acpl('about.clients') ) as [ $loop1, , $client ] ) : ?>
                    <li class="rounded-full border border-navy-900/10 bg-white px-6 py-3.5 text-navy-900 shadow-sm transition duration-500 hover:-translate-y-1 hover:border-gold-500" data-reveal="zoom" style="--reveal-delay: <?php echo esc_html( $loop1->index * 50 ); ?>ms">
                        <span class="mr-2 text-gold-500">◆</span><?php echo esc_html( $client ); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <?php /* Chairman's message */ ?>
    <section id="chairman" class="scroll-mt-24 bg-white py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-16 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <div class="lg:sticky lg:top-32" data-reveal="left">
                    <div class="on-dark grain relative isolate overflow-hidden rounded-[2rem] bg-navy-950 p-8 sm:p-10">
                        <div class="absolute -top-20 -right-20 -z-10 size-80 rounded-full bg-gold-500/25 blur-3xl"></div>
                        <div class="grid-lines absolute inset-0 -z-10"></div>
                        <img src="<?php echo esc_url( acpl_asset('assets/images/acpl-logo-dark.webp') ); ?>" alt="" width="600" height="566" class="absolute -right-10 -bottom-10 -z-10 w-56 opacity-20">
                        <?php acpl_c( 'portrait', ['leader' => ['photo' => $chairman['photo'], 'name' => $chairman['name'], 'role' => $chairman['title']], 'class' => 'w-full max-w-64'] ); ?>
                        <p class="mt-8 font-display text-3xl text-white"><?php echo esc_html( $chairman['name'] ); ?></p>
                        <p class="mt-1 text-sm tracking-[0.2em] text-gold-400 uppercase"><?php echo esc_html( $chairman['title'] ); ?></p>
                        <a href="<?php echo esc_url( acpl_url('leadership.show', 'anthony-oboh') ); ?>" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-gold-300 transition hover:gap-3">Full profile <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></a>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <span class="eyebrow" data-reveal>Chairman’s message</span>
                <h2 class="mt-6 font-display text-4xl leading-tight text-navy-900 sm:text-5xl" data-reveal><?php echo esc_html( $chairman['headline'] ); ?></h2>
                <div class="mt-10 space-y-6 text-lg leading-relaxed text-mist">
                    <?php foreach ( acpl_loop( $chairman['message'] ) as [ $loop1, , $paragraph ] ) : ?>
                        <p data-reveal class="<?php echo esc_attr( acpl_class( ['first-letter:float-left first-letter:mt-1 first-letter:mr-2 first-letter:font-display first-letter:text-6xl first-letter:leading-[0.8] first-letter:text-gold-600' => $loop1->first] ) ); ?>"><?php echo esc_html( $paragraph ); ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="mt-12 border-t border-navy-900/10 pt-8" data-reveal>
                    <p class="font-serif text-3xl text-navy-900 italic"><?php echo esc_html( $chairman['name'] ); ?></p>
                    <p class="mt-1 text-sm text-mist"><?php echo esc_html( $chairman['title'] ); ?>, <?php echo esc_html( acpl('company.name') ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <?php /* Vision & mission */ ?>
    <section class="bg-sand py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-6 lg:grid-cols-2">
            <?php foreach ( acpl_loop( ['Vision' => acpl('vision'), 'Mission' => acpl('mission')] ) as [ $loop1, $label, $statement ] ) : ?>
                <article class="<?php echo esc_attr( acpl_class( [
                    'relative isolate overflow-hidden rounded-[2rem] p-10 sm:p-14',
                    'on-dark bg-navy-900 text-white' => $loop1->first,
                    'bg-white text-navy-900' => $loop1->last,
                ] ) ); ?>" data-reveal style="--reveal-delay: <?php echo esc_html( $loop1->index * 120 ); ?>ms">
                    <span class="absolute -right-6 -bottom-16 -z-10 font-display text-[11rem] leading-none <?php echo esc_html( $loop1->first ? 'text-white/[0.04]' : 'text-navy-900/[0.04]' ); ?>"><?php echo esc_html( $label ); ?></span>
                    <span class="eyebrow">Our <?php echo esc_html( strtolower($label) ); ?></span>
                    <p class="mt-8 font-display text-3xl leading-snug sm:text-4xl"><?php echo esc_html( $statement ); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <?php /* Values wheel */ ?>
    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x">
            <?php acpl_c( 'section-heading', ['eyebrow' => 'Core values', 'title' => 'Our values spell <span class=\'text-gold-gradient\'>PIRIT</span>.', 'lead' => 'Professionalism, Integrity, Relationships, Insight and Team Spirit — a shield around everything we do. Select a value to explore what it means for the way we work.', 'align' => 'center'] ); ?>

            <p class="mt-10 flex justify-center gap-3 font-display text-4xl text-navy-900 sm:gap-5 sm:text-5xl" aria-hidden="true" data-reveal>
                <?php foreach ( acpl_loop( $values ) as [ $loop1, , $value ] ) : ?>
                    <span class="grid size-14 place-items-center rounded-2xl border border-gold-500/40 bg-white sm:size-16"><?php echo esc_html( $value['title'][0] ); ?></span>
                <?php endforeach; ?>
            </p>

            <div class="mt-16 grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
                <div class="mx-auto w-full max-w-md" data-reveal="zoom">
                    <svg viewBox="0 0 400 400" class="w-full overflow-visible" role="tablist" aria-label="Core values">
                        <?php foreach ( acpl_loop( $values ) as [ $loop1, , $value ] ) : ?>
                            <?php
                                $start = deg2rad(-90 + $loop1->index * (360 / $segmentCount) + 1.5);
                                $end = deg2rad(-90 + ($loop1->index + 1) * (360 / $segmentCount) - 1.5);
                                $mid = ($start + $end) / 2;
                                [$outer, $inner] = [190, 92];
                                $path = sprintf(
                                    'M %.2f %.2f A %d %d 0 0 1 %.2f %.2f L %.2f %.2f A %d %d 0 0 0 %.2f %.2f Z',
                                    200 + $outer * cos($start), 200 + $outer * sin($start), $outer, $outer,
                                    200 + $outer * cos($end), 200 + $outer * sin($end),
                                    200 + $inner * cos($end), 200 + $inner * sin($end), $inner, $inner,
                                    200 + $inner * cos($start), 200 + $inner * sin($start),
                                );
                                $labelX = 200 + 141 * cos($mid);
                                $labelY = 200 + 141 * sin($mid);
                            ?>
                            <g role="tab" tabindex="0" aria-label="<?php echo esc_attr( $value['title'] ); ?>" data-pick="value:<?php echo esc_html( $loop1->index ); ?>" data-pick-hover aria-selected="<?php echo esc_attr( $loop1->first ? 'true' : 'false' ); ?>" class="<?php echo esc_attr( acpl_class( ['wheel-segment group outline-none', 'is-active' => $loop1->first] ) ); ?>">
                                <path d="<?php echo esc_attr( $path ); ?>" class="fill-navy-800 transition-colors duration-500 group-hover:fill-gold-500 group-focus-visible:fill-gold-500 group-[.is-active]:fill-gold-500" />
                                <text x="<?php echo esc_attr( round($labelX, 2) ); ?>" y="<?php echo esc_attr( round($labelY + 12, 2) ); ?>" text-anchor="middle" font-size="34" font-family="var(--font-marcellus)" class="pointer-events-none fill-gold-300 transition-colors group-[.is-active]:fill-navy-950"><?php echo esc_html( $value['title'][0] ); ?></text>
                            </g>
                        <?php endforeach; ?>
                        <circle cx="200" cy="200" r="80" fill="#fff" />
                        <image href="<?php echo esc_url( acpl_asset('assets/images/acpl-logo.webp') ); ?>" x="148" y="151" width="104" height="98" />
                    </svg>
                </div>

                <div>
                    <?php foreach ( acpl_loop( $values ) as [ $loop1, , $value ] ) : ?>
                        <div data-pick-panel="value:<?php echo esc_html( $loop1->index ); ?>" <?php if ( ! $loop1->first ) : ?> hidden <?php endif; ?>>
                            <span class="flex items-center gap-4"><span class="font-display text-7xl text-gold-500/50"><?php echo esc_html( $value['title'][0] ); ?></span><?php acpl_c( 'icon', ['name' => $value['icon'], 'class' => 'size-8 text-gold-600'] ); ?></span>
                            <h3 class="mt-2 font-display text-5xl text-navy-900"><?php echo esc_html( $value['title'] ); ?></h3>
                            <p class="mt-6 max-w-md text-xl leading-relaxed text-mist"><?php echo esc_html( $value['text'] ); ?></p>
                        </div>
                    <?php endforeach; ?>

                    <ul class="mt-12 flex flex-wrap gap-2">
                        <?php foreach ( acpl_loop( $values ) as [ $loop1, , $value ] ) : ?>
                            <li>
                                <button type="button" data-pick="value:<?php echo esc_html( $loop1->index ); ?>" class="<?php echo esc_attr( acpl_class( ['rounded-full border px-4 py-2 text-sm font-medium transition [&.is-active]:border-navy-900 [&.is-active]:bg-navy-900 [&.is-active]:text-white', 'is-active' => $loop1->first, 'border-navy-900/15 text-navy-800 hover:border-navy-900/40'] ) ); ?>"><?php echo esc_html( $value['title'] ); ?></button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php acpl_c( 'cta-band', ['page' => 'about'] ); ?>
<?php acpl_end( 'layouts.app' ); ?>
