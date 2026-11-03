<?php
/**
 * Template: front-page.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;
?>
<?php acpl_start( 'layouts.app', array() ); ?>
    <?php
        $company = acpl('company');
        // Words inside [brackets] in the headline setting are shown in gold.
        $headline = array();
        $inGold = false;
        foreach ( preg_split( '/\s+/', trim( (string) acpl('home.headline') ) ) as $word ) {
            $starts = 0 === strpos( $word, '[' );
            $ends = false !== strpos( $word, ']' );
            $headline[] = array( 'word' => str_replace( array( '[', ']' ), '', $word ), 'gold' => $inGold || $starts );
            $inGold = ( $inGold || $starts ) && ! $ends;
        }
        $platformIcons = ['advisory' => 'compass', 'capital' => 'coins', 'investments' => 'chart'];
    ?>

    <?php /* Hero */ ?>
    <section class="relative isolate flex min-h-[100svh] items-center overflow-hidden bg-white pt-32 pb-28" data-tilt-area>
        <div class="brand-lines absolute inset-0 -z-10"></div>
        <div class="absolute top-[-20%] right-[-10%] -z-10 size-[44rem] rounded-full bg-gold-200/45 blur-[140px]"></div>
        <canvas data-ribbons="12" data-tone="light" class="absolute inset-0 -z-10 h-full w-full"></canvas>

        <div class="container-x grid grid-cols-1 items-center gap-14 lg:grid-cols-[1fr_1fr]">
            <div>
                <span class="eyebrow !text-sm !tracking-[0.2em]" data-reveal><?php echo esc_html( $company['tagline'] ); ?></span>

                <h1 class="mt-7 max-w-xl font-display text-[2.1rem] leading-[1.15] text-navy-900 sm:text-[2.6rem] xl:text-[2.85rem]">
                    <?php foreach ( acpl_loop( $headline ) as [ $loop1, , $word ] ) : ?>
                        <span class="split-word"><span style="--i: <?php echo esc_attr( $loop1->index ); ?>" class="<?php echo esc_attr( acpl_class( ['text-gold-gradient' => $word['gold']] ) ); ?>"><?php echo esc_html( $word['word'] ); ?></span></span>
                    <?php endforeach; ?>
                </h1>

                <span class="mt-8 flex w-56 items-center gap-2" aria-hidden="true" data-reveal style="--reveal-delay: 500ms">
                    <span class="h-px flex-1 bg-gold-500/70"></span><span class="size-1.5 rotate-45 bg-gold-500"></span><span class="h-px flex-1 bg-gold-500/70"></span>
                </span>

                <p class="mt-8 max-w-xl text-lg leading-relaxed text-mist" data-reveal style="--reveal-delay: 600ms"><?php echo esc_html( $company['summary'] ); ?></p>

                <div class="mt-10 flex flex-wrap gap-4" data-reveal style="--reveal-delay: 750ms">
                    <a href="<?php echo esc_url( acpl_url('services') ); ?>" class="btn-gold">Explore what we do <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></a>
                    <a href="<?php echo esc_url( acpl_url('contact') ); ?>" class="btn-ghost">Talk to our team</a>
                </div>
            </div>

            <?php /* The three integrated platforms orbiting the mark */ ?>
            <div class="relative mx-auto aspect-square w-full max-w-[36rem] lg:max-w-[40rem]" data-reveal="zoom" style="--reveal-delay: 300ms">
                <div class="absolute inset-0 rounded-full border border-navy-900/10"></div>
                <div class="absolute inset-[9%] rounded-full border border-dashed border-gold-500/40 motion-safe:animate-[spin_80s_linear_infinite]"></div>
                <div class="absolute inset-[22%] rounded-full bg-gold-300/25 blur-3xl"></div>

                <div class="absolute inset-[20%] grid place-items-center" data-tilt="16">
                    <img src="<?php echo esc_url( acpl_asset('assets/images/acpl-logo.webp') ); ?>" alt="The Angelus Capital Partners mark" width="600" height="566" class="w-full animate-float drop-shadow-[0_30px_50px_rgba(239,125,16,0.3)]" fetchpriority="high">
                </div>

                <?php foreach ( acpl_loop( acpl('platforms') ) as [ $loop1, , $platform ] ) : ?>
                    <?php $positions = ['top-[2%] left-1/2 -translate-x-1/2', 'right-0 bottom-[24%] sm:right-[-4%] sm:bottom-[16%]', 'bottom-[2%] left-0 sm:left-[-4%] sm:bottom-[16%]']; ?>
                    <a href="<?php echo esc_url( acpl_url('services') ); ?>#<?php echo esc_html( $platform['key'] ); ?>" class="absolute <?php echo esc_html( $positions[$loop1->index] ); ?> flex items-center gap-3 rounded-full border border-navy-900/10 bg-white py-2 pr-5 pl-2 font-display text-base whitespace-nowrap sm:py-3 sm:pr-6 sm:pl-3 text-navy-900 shadow-[0_20px_40px_-20px_rgba(0,20,64,0.45)] transition hover:border-gold-500 sm:text-lg">
                        <span class="grid size-9 place-items-center rounded-full bg-navy-900 text-gold-300 sm:size-10">
                            <?php acpl_c( 'icon', ['name' => $platformIcons[$platform['key']], 'class' => 'size-5', 'stroke' => '1.8'] ); ?>
                        </span>
                        <span><span class="block text-[0.6rem] font-sans font-semibold tracking-[0.2em] text-gold-600 uppercase">Platform 0<?php echo esc_html( $loop1->iteration ); ?></span><?php echo esc_html( $platform['title'] ); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php acpl_c( 'brand-wave', ['class' => 'absolute inset-x-0 bottom-0 h-12 sm:h-16'] ); ?>
    </section>

    <?php /* Ticker: announcements or partner logos (config: acpl.ticker) */ ?>
    <div class="flex items-stretch overflow-hidden bg-navy-900" aria-label="<?php echo esc_attr( acpl('ticker.label') ); ?>">
        <p class="relative z-10 hidden shrink-0 items-center bg-gradient-to-r from-gold-400 to-ember px-6 text-xs font-bold tracking-[0.2em] text-navy-950 uppercase sm:flex"><?php echo esc_html( acpl('ticker.label') ); ?></p>
        <div class="flex-1 overflow-hidden py-5">
            <div class="flex w-max animate-marquee gap-12 whitespace-nowrap hover:[animation-play-state:paused]" style="animation-duration: 60s">
                <?php foreach ( acpl_loop( [0, 1] ) as [ $loop1, , $copy ] ) : ?>
                    <?php foreach ( acpl_loop( acpl('ticker.items') ) as [ $loop2, , $item ] ) : ?>
                        <span class="flex items-center gap-12" <?php if ( $copy ) : ?> aria-hidden="true" <?php endif; ?>>
                            <?php if ( ! empty( $item['url'] ) ) : ?>
                                <a href="<?php echo esc_url( acpl_link( $item['url'] ) ); ?>" class="flex items-center text-white/80 transition hover:text-gold-300" <?php if ( $copy ) : ?> tabindex="-1" <?php endif; ?>>
                            <?php else : ?>
                                <span class="flex items-center text-white/80">
                            <?php endif; ?>
                                <?php if ( ! empty( $item['logo'] ) ) : ?>
                                    <img src="<?php echo esc_url( acpl_asset($item['logo']) ); ?>" alt="<?php echo esc_attr( $item['text'] ?? '' ); ?>" loading="lazy" class="h-8 w-auto opacity-80 brightness-0 invert">
                                <?php else : ?>
                                    <span class="text-[0.95rem]"><?php echo esc_html( $item['text'] ); ?></span>
                                <?php endif; ?>
                            <?php if ( ! empty( $item['url'] ) ) : ?>
                                </a>
                            <?php else : ?>
                                </span>
                            <?php endif; ?>
                            <?php acpl_c( 'icon', ['name' => 'sparkle', 'class' => 'size-3.5 text-gold-400'] ); ?>
                        </span>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php /* At a glance */ ?>
    <section id="glance" class="bg-ivory py-24 sm:py-32">
        <div class="container-x">
            <div class="grid grid-cols-1 gap-16 lg:grid-cols-[0.9fr_1.1fr] lg:items-end">
                <?php acpl_c( 'section-heading', ['eyebrow' => 'ACPL at a glance', 'title' => 'Connecting capital with <em class=\'font-serif text-gold-600\'>opportunity</em>.'] ); ?>
                <p class="max-w-xl text-lg leading-relaxed text-mist lg:justify-self-end" data-reveal><?php echo esc_html( acpl('about.intro') ); ?></p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-px overflow-hidden rounded-3xl border border-navy-900/8 bg-navy-900/8 sm:grid-cols-2 lg:grid-cols-4">
                <?php foreach ( acpl_loop( acpl('metrics') ) as [ $loop1, , $metric ] ) : ?>
                    <div class="group relative bg-white p-8 transition duration-500 hover:bg-navy-900 sm:p-10" data-reveal style="--reveal-delay: <?php echo esc_html( $loop1->index * 90 ); ?>ms">
                        <p class="font-display text-5xl text-navy-900 transition duration-500 group-hover:text-gold-300 xl:text-6xl">
                            <span data-count="<?php echo esc_attr( $metric['value'] ); ?>" data-prefix="<?php echo esc_attr( $metric['prefix'] ); ?>" data-suffix="<?php echo esc_attr( $metric['suffix'] ); ?>"><?php echo esc_html( $metric['prefix'] ); ?><?php echo esc_html( $metric['value'] ); ?><?php echo esc_html( $metric['suffix'] ); ?></span>
                        </p>
                        <p class="mt-5 font-semibold text-navy-900 transition duration-500 group-hover:text-white"><?php echo esc_html( $metric['label'] ); ?></p>
                        <p class="mt-2 text-sm leading-relaxed text-mist transition duration-500 group-hover:text-white/60"><?php echo esc_html( $metric['note'] ); ?></p>
                        <span class="absolute top-8 right-8 h-px w-8 bg-gold-500 transition-all duration-500 group-hover:w-14"></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* Who we are */ ?>
    <section class="bg-white py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-16 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <div class="lg:sticky lg:top-32">
                    <?php acpl_c( 'section-heading', ['eyebrow' => 'Who we are', 'title' => 'An alternative asset partner across the entire capital lifecycle.', 'lead' => 'We provide advisory, capital and investment solutions — from business strategy and project development to capital raising, transaction execution and investment management.'] ); ?>
                    <a href="<?php echo esc_url( acpl_url('about') ); ?>" class="link-arrow mt-10" data-reveal>Discover our story <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></a>
                    <img src="<?php echo esc_url( acpl_asset('assets/images/skyline.webp') ); ?>" alt="Glass office towers reflecting the morning light" width="653" height="980" loading="lazy" class="mt-10 hidden w-full max-w-sm lg:block" data-reveal="fade">
                </div>
            </div>

            <div class="flex flex-col gap-6 lg:col-span-7">
                <?php foreach ( acpl_loop( acpl('about.pillars') ) as [ $loop1, , $pillar ] ) : ?>
                    <article class="card-light group flex gap-8 p-8 transition duration-500 hover:-translate-y-1 sm:p-10" data-reveal style="--reveal-delay: <?php echo esc_html( $loop1->index * 100 ); ?>ms">
                        <span class="font-display text-5xl text-gold-500/40 transition group-hover:text-gold-500">0<?php echo esc_html( $loop1->iteration ); ?></span>
                        <div>
                            <h3 class="font-display text-2xl text-navy-900"><?php echo esc_html( $pillar['title'] ); ?></h3>
                            <p class="mt-3 leading-relaxed text-mist"><?php echo esc_html( $pillar['text'] ); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* Three integrated platforms */ ?>
    <section class="on-dark grain relative isolate overflow-hidden bg-navy-950 py-24 text-white sm:py-32">
        <div class="grid-lines absolute inset-0 -z-10"></div>
        <div class="absolute top-1/3 left-1/2 -z-10 size-[44rem] -translate-x-1/2 rounded-full bg-navy-600/35 blur-[140px]"></div>

        <div class="container-x">
            <?php acpl_c( 'section-heading', ['eyebrow' => 'What we do', 'title' => 'Three integrated platforms. <span class=\'text-gold-gradient\'>One partner.</span>', 'lead' => 'Advisory, capital solutions and investments work together, so every engagement benefits from the full strength of the company.', 'align' => 'center', 'dark' => true] ); ?>

            <div class="mt-20 grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
                <?php /* Ecosystem diagram */ ?>
                <?php acpl_c( 'platform-venn', ['class' => 'mx-auto w-full max-w-lg', 'data-reveal' => 'zoom'] ); ?>

                <div class="flex flex-col gap-5">
                    <?php foreach ( acpl_loop( acpl('platforms') ) as [ $loop1, , $platform ] ) : ?>
                        <a href="<?php echo esc_url( acpl_url('services') ); ?>#<?php echo esc_html( $platform['key'] ); ?>" class="card-dark group block p-7 transition duration-500 hover:border-gold-400/40 hover:bg-white/[0.06] sm:p-8" data-reveal="right" style="--reveal-delay: <?php echo esc_html( $loop1->index * 110 ); ?>ms">
                            <div class="flex items-start gap-5">
                                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-gold-300 to-ember text-navy-950">
                                    <?php acpl_c( 'icon', ['name' => $platformIcons[$platform['key']], 'class' => 'size-6'] ); ?>
                                </span>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between gap-4">
                                        <h3 class="font-display text-2xl"><?php echo esc_html( $platform['title'] ); ?></h3>
                                        <?php acpl_c( 'icon', ['name' => 'arrow-up-right', 'class' => 'size-5 text-gold-400 transition duration-500 group-hover:translate-x-1 group-hover:-translate-y-1'] ); ?>
                                    </div>
                                    <p class="mt-2 text-white/60"><?php echo esc_html( $platform['summary'] ); ?></p>
                                    <div class="mt-5 flex flex-wrap gap-2">
                                        <?php foreach ( acpl_loop( $platform['items'] ) as [ $loop2, , $item ] ) : ?>
                                            <span class="rounded-full border border-white/10 px-3 py-1 text-xs text-white/70"><?php echo esc_html( $item ); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <?php /* Value proposition */ ?>
    <section class="relative overflow-hidden bg-sand py-24 sm:py-32">
        <div class="container-x">
            <span class="eyebrow" data-reveal>Our value proposition</span>
            <p class="mt-8 max-w-5xl font-display text-3xl leading-snug text-navy-900 sm:text-4xl lg:text-[2.6rem]" data-reveal style="--reveal-delay: 80ms"><?php echo esc_html( acpl('value_proposition.statement') ); ?></p>

            <div class="mt-16 grid grid-cols-1 gap-6 md:grid-cols-3">
                <?php foreach ( acpl_loop( acpl('value_proposition.promises') ) as [ $loop1, , $promise ] ) : ?>
                    <article class="card-light group relative overflow-hidden p-8 sm:p-10" data-reveal style="--reveal-delay: <?php echo esc_html( $loop1->index * 110 ); ?>ms">
                        <span class="absolute top-0 left-8 h-1 w-16 rounded-b-full bg-gradient-to-r from-gold-400 to-ember"></span>
                        <div class="flex items-center justify-between">
                            <span class="grid size-12 place-items-center rounded-2xl bg-navy-900 text-gold-300 transition duration-500 group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950"><?php acpl_c( 'icon', ['name' => $promise['icon'], 'class' => 'size-6'] ); ?></span>
                            <span class="text-xs font-semibold tracking-[0.2em] text-gold-600 uppercase"><?php echo esc_html( $promise['platform'] ); ?></span>
                        </div>
                        <h3 class="mt-8 font-display text-2xl text-navy-900"><?php echo esc_html( $promise['title'] ); ?></h3>
                        <p class="mt-3 leading-relaxed text-mist"><?php echo esc_html( $promise['text'] ); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* How we create value */ ?>
    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x">
            <div class="flex flex-col justify-between gap-8 lg:flex-row lg:items-end">
                <?php acpl_c( 'section-heading', ['eyebrow' => 'How we create value', 'title' => 'From concept to completion.'] ); ?>
                <p class="max-w-md leading-relaxed text-mist" data-reveal><?php echo esc_html( acpl('value_proposition.outcome') ); ?></p>
            </div>

            <ol class="mt-16 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-6 lg:gap-0">
                <?php foreach ( acpl_loop( acpl('process') ) as [ $loop1, , $step ] ) : ?>
                    <li class="group relative" data-reveal style="--reveal-delay: <?php echo esc_html( $loop1->index * 90 ); ?>ms">
                        <div class="<?php echo esc_attr( acpl_class( [
                            'flex h-full flex-col justify-between gap-10 p-7 transition duration-500 lg:min-h-72 lg:pr-9 lg:pl-10',
                            'rounded-3xl lg:rounded-none',
                            $loop1->first ? 'lg:chevron-first lg:pl-7' : 'lg:chevron',
                            $loop1->even ? 'bg-navy-900 text-white' : 'bg-navy-800 text-white',
                            'group-hover:bg-gradient-to-br group-hover:from-gold-400 group-hover:to-ember group-hover:text-navy-950',
                        ] ) ); ?>">
                            <span class="font-display text-4xl text-gold-400 transition group-hover:text-navy-950">0<?php echo esc_html( $loop1->iteration ); ?></span>
                            <div>
                                <h3 class="font-display text-2xl"><?php echo esc_html( $step['title'] ); ?></h3>
                                <p class="mt-3 text-sm leading-relaxed opacity-70"><?php echo esc_html( $step['text'] ); ?></p>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>

    <?php /* Sectors */ ?>
    <section class="bg-white py-24 sm:py-32">
        <div class="container-x">
            <div class="flex flex-col justify-between gap-8 lg:flex-row lg:items-end">
                <?php acpl_c( 'section-heading', ['eyebrow' => 'Sectors of focus', 'title' => 'Deep knowledge across Africa’s key growth sectors.'] ); ?>
                <a href="<?php echo esc_url( acpl_url('sectors') ); ?>" class="link-arrow shrink-0" data-reveal>All sectors <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></a>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ( acpl_loop( acpl('sectors') ) as [ $loop1, , $sector ] ) : ?>
                    <article class="group relative overflow-hidden rounded-3xl border border-navy-900/8 bg-ivory p-8 transition duration-500 hover:-translate-y-1.5 hover:border-transparent hover:bg-navy-900 hover:shadow-[0_30px_60px_-30px_rgba(7,24,52,0.6)]" data-reveal style="--reveal-delay: <?php echo esc_html( ($loop1->index % 3) * 80 ); ?>ms">
                        <span class="grid size-14 place-items-center rounded-2xl bg-white text-gold-600 shadow-sm transition duration-500 group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950">
                            <?php acpl_c( 'icon', ['name' => $sector['icon'], 'class' => 'size-7'] ); ?>
                        </span>
                        <h3 class="mt-8 font-display text-xl text-navy-900 transition group-hover:text-white"><?php echo esc_html( $sector['title'] ); ?></h3>
                        <p class="mt-3 text-sm leading-relaxed text-mist transition group-hover:text-white/65"><?php echo esc_html( $sector['text'] ); ?></p>
                        <span class="pointer-events-none absolute -right-4 -bottom-6 font-display text-8xl text-navy-900/[0.04] transition group-hover:text-white/[0.06]">0<?php echo esc_html( $loop1->iteration ); ?></span>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* Transaction credentials preview */ ?>
    <section class="on-dark relative overflow-hidden bg-navy-900 py-24 text-white sm:py-32">
        <div class="container-x">
            <div class="flex flex-col justify-between gap-8 lg:flex-row lg:items-end">
                <?php acpl_c( 'section-heading', ['eyebrow' => 'Transaction experience', 'title' => 'Selected credentials across sectors and geographies.', 'lead' => acpl('transactions.intro'), 'dark' => true] ); ?>
                <a href="<?php echo esc_url( acpl_url('sectors') ); ?>#transactions" class="btn-outline shrink-0" data-reveal>View all credentials <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></a>
            </div>
        </div>

        <div class="relative mt-16 overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_8%,black_92%,transparent)]">
            <div class="flex w-max animate-marquee gap-5 hover:[animation-play-state:paused]" style="animation-duration: 70s">
                <?php foreach ( acpl_loop( [0, 1] ) as [ $loop1, , $copy ] ) : ?>
                    <?php foreach ( acpl_loop( acpl('transactions.groups') ) as [ $loop2, , $group ] ) : ?>
                        <?php foreach ( acpl_loop( $group['deals'] ) as [ $loop3, , $deal ] ) : ?>
                            <div class="flex h-56 w-72 shrink-0 flex-col justify-between rounded-3xl border border-gold-400/20 bg-gradient-to-b from-white/[0.06] to-transparent p-7" <?php if ( $copy ) : ?> aria-hidden="true" <?php endif; ?>>
                                <div class="flex items-start justify-between gap-6">
                                    <?php acpl_c( 'icon', ['name' => $group['icon'], 'class' => 'size-6 text-gold-400'] ); ?>
                                    <span class="max-w-36 text-right text-[0.62rem] leading-relaxed tracking-[0.18em] text-white/40 uppercase"><?php echo esc_html( $group['sector'] ); ?></span>
                                </div>
                                <div>
                                    <p class="font-display text-2xl leading-tight"><?php echo esc_html( $deal['name'] ); ?></p>
                                    <p class="mt-2 text-sm text-gold-300/80"><?php echo esc_html( $deal['type'] ); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* Chairman */ ?>
    <section class="bg-sand py-24 sm:py-32">
        <div class="container-x">
            <figure class="mx-auto max-w-5xl text-center" data-reveal>
                <?php acpl_c( 'icon', ['name' => 'quote', 'class' => 'mx-auto size-12 text-gold-500', 'stroke' => '1'] ); ?>
                <blockquote class="mt-8 font-serif text-3xl leading-snug text-navy-900 italic sm:text-5xl">
                    “<?php echo esc_html( acpl('chairman.pull_quote') ); ?>”
                </blockquote>
                <figcaption class="mt-10 flex items-center justify-center gap-4">
                    <img src="<?php echo esc_url( acpl_chairman()['photo'] ); ?>" alt="<?php echo esc_attr( acpl('chairman.name') ); ?>" width="56" height="56" loading="lazy" class="size-14 rounded-full object-cover object-top ring-2 ring-gold-400 ring-offset-2 ring-offset-sand">
                    <span class="text-left">
                        <span class="block font-semibold text-navy-900"><?php echo esc_html( acpl('chairman.name') ); ?></span>
                        <span class="block text-sm text-mist"><?php echo esc_html( acpl('chairman.title') ); ?></span>
                    </span>
                </figcaption>
                <a href="<?php echo esc_url( acpl_url('about') ); ?>#chairman" class="link-arrow mt-10">Read the Chairman’s message <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></a>
            </figure>
        </div>
    </section>

    <?php /* Leadership */ ?>
    <section class="bg-white py-24 sm:py-32">
        <div class="container-x">
            <div class="flex flex-col justify-between gap-8 lg:flex-row lg:items-end">
                <?php acpl_c( 'section-heading', ['eyebrow' => 'Leadership', 'title' => 'Led by people who have built institutions.', 'lead' => 'Decades of combined experience across venture capital, private equity, banking, audit, pensions and corporate governance.'] ); ?>
                <a href="<?php echo esc_url( acpl_url('leadership') ); ?>" class="link-arrow shrink-0" data-reveal>Meet the team <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></a>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-3">
                <?php foreach ( acpl_loop( acpl_leaders() ) as [ $loop1, , $leader ] ) : ?>
                    <a href="<?php echo esc_url( acpl_url('leadership.show', $leader['slug']) ); ?>" class="group block" data-reveal style="--reveal-delay: <?php echo esc_html( $loop1->index * 120 ); ?>ms">
                        <?php acpl_c( 'portrait', ['leader' => $leader, 'class' => 'mx-auto w-full max-w-60'] ); ?>
                        <div class="mt-6 text-center">
                            <p class="font-display text-2xl text-navy-900 transition group-hover:text-gold-600"><?php echo esc_html( $leader['name'] ); ?></p>
                            <p class="mt-1 text-xs font-semibold tracking-[0.22em] text-gold-600 uppercase"><?php echo esc_html( $leader['role'] ); ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* Why partner */ ?>
    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-16 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <?php acpl_c( 'section-heading', ['eyebrow' => 'Why partner with ACPL', 'title' => 'Six reasons clients choose us.', 'lead' => 'Experience, networks and the discipline to move transactions from concept to completion.'] ); ?>
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:col-span-8 lg:grid-cols-3">
                <?php foreach ( acpl_loop( acpl('differentiators') ) as [ $loop1, , $item ] ) : ?>
                    <?php $icons = ['users', 'network', 'target', 'layers', 'scale', 'handshake']; ?>
                    <div class="group" data-reveal style="--reveal-delay: <?php echo esc_html( ($loop1->index % 3) * 90 ); ?>ms">
                        <div class="hex grid size-20 place-items-center bg-navy-900 text-gold-300 transition duration-500 group-hover:rotate-[30deg] group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950">
                            <?php acpl_c( 'icon', ['name' => $icons[$loop1->index], 'class' => 'size-8 transition duration-500 group-hover:-rotate-[30deg]'] ); ?>
                        </div>
                        <h3 class="mt-6 font-display text-xl text-navy-900"><?php echo esc_html( $item['title'] ); ?></h3>
                        <p class="mt-2 text-sm leading-relaxed text-mist"><?php echo esc_html( $item['text'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* Looking ahead */ ?>
    <section class="on-dark grain relative isolate overflow-hidden bg-navy-950 py-24 text-white sm:py-32">
        <div class="absolute inset-y-0 right-0 -z-10 w-1/2 bg-gradient-to-l from-navy-700/50 to-transparent"></div>
        <div class="container-x grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
            <div>
                <?php acpl_c( 'section-heading', ['eyebrow' => 'Looking ahead', 'title' => acpl('outlook.headline'), 'dark' => true] ); ?>
                <div class="mt-8 space-y-5 text-lg leading-relaxed text-white/65">
                    <?php foreach ( acpl_loop( acpl('outlook.paragraphs') ) as [ $loop1, , $paragraph ] ) : ?>
                        <p data-reveal style="--reveal-delay: <?php echo esc_html( $loop1->index * 90 ); ?>ms"><?php echo esc_html( $paragraph ); ?></p>
                    <?php endforeach; ?>
                </div>
                <p class="mt-10 font-serif text-3xl text-gold-300 italic" data-reveal><?php echo esc_html( acpl('outlook.closing') ); ?></p>
            </div>
            <ul class="flex flex-col gap-3">
                <?php foreach ( acpl_loop( acpl('outlook.drivers') ) as [ $loop1, , $driver ] ) : ?>
                    <li class="card-dark flex items-center justify-between px-7 py-6 transition duration-500 hover:border-gold-400/40" data-reveal="right" style="--reveal-delay: <?php echo esc_html( $loop1->index * 90 ); ?>ms">
                        <span class="font-display text-xl sm:text-2xl"><?php echo esc_html( $driver ); ?></span>
                        <span class="text-sm text-gold-400">0<?php echo esc_html( $loop1->iteration ); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <?php acpl_c( 'cta-band', ['page' => 'home'] ); ?>
<?php acpl_end( 'layouts.app' ); ?>
