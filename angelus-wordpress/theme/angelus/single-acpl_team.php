<?php
/**
 * Template: single-acpl_team.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;
?>
<?php
the_post();
$leader     = acpl_leader( get_post() );
$colleagues = array_values( array_filter( acpl_leaders(), static fn ( $colleague ) => $colleague['id'] !== $leader['id'] ) );

// The profile text is split into chapters at each heading, one card per chapter.
$chapters = array_values( array_filter( array_map( 'trim', preg_split( '/(?=<h[23][\s>])/', apply_filters( 'the_content', get_the_content() ) ) ) ) );
?>
<?php acpl_start( 'layouts.app', ['title' => $leader['name'].' — '.$leader['role'], 'description' => $leader['intro'] ? $leader['intro'] : $leader['bio']] ); ?>
    <?php /* Profile hero */ ?>
    <section class="relative isolate overflow-hidden bg-white pt-36 pb-20 sm:pt-44 sm:pb-28">
        <div class="brand-lines absolute inset-0 -z-10"></div>
        <div class="absolute -top-32 -right-32 -z-10 size-[36rem] rounded-full bg-gold-200/40 blur-[120px]"></div>
        <canvas data-ribbons="10" data-tone="light" class="absolute inset-0 -z-10 h-full w-full"></canvas>

        <div class="container-x">
            <a href="<?php echo esc_url( acpl_url('leadership') ); ?>" class="inline-flex items-center gap-2 text-sm text-mist transition hover:text-gold-700" data-reveal>
                <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4 rotate-180', 'stroke' => '2'] ); ?> All leadership
            </a>

            <div class="mt-10 grid grid-cols-1 items-center gap-12 lg:grid-cols-[18rem_1fr] lg:gap-16">
                <?php acpl_c( 'portrait', ['leader' => $leader, 'eager' => true, 'class' => 'w-full max-w-72', 'data-reveal' => 'zoom'] ); ?>

                <div>
                    <span class="eyebrow" data-reveal><?php echo esc_html( $leader['role'] ); ?></span>
                    <h1 class="mt-6 font-display text-5xl leading-[1.05] text-navy-900 sm:text-6xl" data-reveal style="--reveal-delay: 100ms"><?php echo esc_html( $leader['name'] ); ?></h1>
                    <p class="mt-8 max-w-3xl text-lg leading-relaxed text-mist" data-reveal style="--reveal-delay: 200ms"><?php echo esc_html( $leader['intro'] ); ?></p>
                </div>
            </div>
        </div>
        <?php acpl_c( 'brand-wave', ['class' => 'absolute inset-x-0 bottom-0 h-10 opacity-90 sm:h-14'] ); ?>
    </section>

    <?php if ( $leader['expertise'] ) : ?>
    <?php /* Key areas of expertise */ ?>
    <section class="bg-ivory py-20 sm:py-24">
        <div class="container-x grid grid-cols-1 gap-12 lg:grid-cols-[0.8fr_1.2fr]">
            <?php acpl_c( 'section-heading', ['eyebrow' => 'Key areas of expertise', 'title' => 'Where experience runs deepest.'] ); ?>
            <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <?php foreach ( acpl_loop( $leader['expertise'] ) as [ $loop1, , $area ] ) : ?>
                    <li class="card-light flex items-start gap-4 p-6" data-reveal style="--reveal-delay: <?php echo esc_html( $loop1->index * 80 ); ?>ms">
                        <span class="hex grid size-11 shrink-0 place-items-center bg-navy-900 font-display text-sm text-gold-300">0<?php echo esc_html( $loop1->iteration ); ?></span>
                        <span class="pt-2 font-medium leading-snug text-navy-900"><?php echo esc_html( $area ); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <?php endif; ?>

    <?php if ( $chapters ) : ?>
    <?php /* Professional milestone highlights */ ?>
    <section class="bg-white py-20 sm:py-28">
        <div class="container-x">
            <?php acpl_c( 'section-heading', ['eyebrow' => 'Professional milestone highlights', 'title' => 'A career in three chapters.'] ); ?>

            <div class="mt-14 grid grid-cols-1 gap-6 <?php echo esc_attr( array( 1 => 'lg:grid-cols-1', 2 => 'lg:grid-cols-2' )[ count( $chapters ) ] ?? 'lg:grid-cols-3' ); ?>">
                <?php foreach ( acpl_loop( $chapters ) as [ $loop1, , $chapter ] ) : ?>
                    <article class="relative flex flex-col overflow-hidden rounded-3xl border border-navy-900/8 bg-ivory p-8 [&_h2]:mt-4 [&_h2]:font-display [&_h2]:text-2xl [&_h2]:leading-snug [&_h2]:text-navy-900 [&_h3]:mt-4 [&_h3]:font-display [&_h3]:text-2xl [&_h3]:leading-snug [&_h3]:text-navy-900 [&_h3+p]:mt-4 [&_h3+p]:font-serif [&_h3+p]:text-lg [&_h3+p]:leading-snug [&_h3+p]:text-navy-800 [&_h3+p]:italic [&_p]:mt-4 [&_p]:text-sm [&_p]:leading-relaxed [&_p]:text-mist [&_ul]:mt-6 [&_ul]:space-y-5 [&_ul]:border-t [&_ul]:border-navy-900/10 [&_ul]:pt-6 [&_li]:text-sm [&_li]:leading-relaxed [&_li]:text-mist [&_li_strong]:block [&_li_strong]:font-semibold [&_li_strong]:text-navy-900 [&_a]:text-gold-700 [&_a]:underline" data-reveal style="--reveal-delay: <?php echo esc_attr( $loop1->index * 110 ); ?>ms">
                        <span class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-gold-400 to-ember"></span>
                        <span class="font-display text-5xl text-gold-500/40">0<?php echo esc_html( $loop1->iteration ); ?></span>
                        <?php echo wp_kses_post( preg_replace( '#(<strong>[^<]*</strong>)\s*[—–-]\s*#u', '$1', $chapter ) ); ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if ( $colleagues ) : ?>
    <?php /* Colleagues */ ?>
    <section class="bg-sand py-20 sm:py-24">
        <div class="container-x">
            <?php acpl_c( 'section-heading', ['eyebrow' => 'The leadership team', 'title' => 'Meet the rest of the team.'] ); ?>
            <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2">
                <?php foreach ( acpl_loop( $colleagues ) as [ $loop1, , $colleague ] ) : ?>
                    <a href="<?php echo esc_url( acpl_url('leadership.show', $colleague['slug']) ); ?>" class="card-light group flex items-center gap-6 p-5 transition duration-500 hover:-translate-y-1" data-reveal style="--reveal-delay: <?php echo esc_html( $loop1->index * 100 ); ?>ms">
                        <?php acpl_c( 'portrait', ['leader' => $colleague, 'class' => 'w-24 shrink-0 !rounded-2xl sm:w-28'] ); ?>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold tracking-[0.2em] text-gold-600 uppercase"><?php echo esc_html( $colleague['role'] ); ?></p>
                            <p class="mt-1 font-display text-2xl text-navy-900"><?php echo esc_html( $colleague['name'] ); ?></p>
                            <span class="link-arrow mt-3">View profile <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php acpl_c( 'cta-band', ['page' => 'leadership'] ); ?>
<?php acpl_end( 'layouts.app' ); ?>
