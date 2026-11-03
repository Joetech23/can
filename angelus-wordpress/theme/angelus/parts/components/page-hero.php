<?php
/**
 * Component: page-hero.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

extract( acpl_props( $args ?? array(), ['eyebrow', 'title', 'lead' => null, 'index' => null, 'slot' => ''] ) );
?>
<section class="relative isolate overflow-hidden bg-white pt-40 pb-24 sm:pt-48 sm:pb-32" data-tilt-area>
    <div class="brand-lines absolute inset-0 -z-10"></div>
    <div class="absolute -top-40 -right-40 -z-10 size-[34rem] rounded-full bg-gold-200/40 blur-[120px]"></div>
    <canvas data-ribbons="10" data-tone="light" class="absolute inset-0 -z-10 h-full w-full"></canvas>

    <img src="<?php echo esc_url( acpl_asset('assets/images/acpl-logo.webp') ); ?>" alt="" width="600" height="566" data-tilt="14" class="pointer-events-none absolute top-1/2 right-[-4rem] -z-10 hidden w-[26rem] -translate-y-1/2 opacity-[0.12] lg:block">

    <div class="container-x">
        <div class="max-w-4xl">
            <div class="flex items-center gap-4" data-reveal>
                <?php if ( $index ) : ?>
                    <span class="font-display text-sm text-gold-600"><?php echo esc_html( $index ); ?></span>
                <?php endif; ?>
                <span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
            </div>
            <h1 class="mt-7 font-display text-5xl leading-[1.04] text-balance text-navy-900 sm:text-6xl lg:text-7xl" data-reveal style="--reveal-delay: 100ms"><?php echo $title; ?></h1>
            <?php if ( $lead ) : ?>
                <p class="mt-8 max-w-2xl text-lg leading-relaxed text-mist sm:text-xl" data-reveal style="--reveal-delay: 200ms"><?php echo esc_html( $lead ); ?></p>
            <?php endif; ?>
            <?php echo $slot; // phpcs:ignore -- pre-rendered HTML ?>
        </div>
    </div>

    <?php acpl_c( 'brand-wave', ['class' => 'absolute inset-x-0 bottom-0 h-10 opacity-90 sm:h-14'] ); ?>
</section>
