<?php
/**
 * Component: cta-band.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

extract( acpl_props( $args ?? array(), ['page' => 'home'] ) );
?>
<?php $cta = acpl("ctas.{$page}") ?? acpl('ctas.home'); ?>

<section class="bg-white py-24 sm:py-32">
    <div class="container-x">
        <div class="on-dark grain relative isolate overflow-hidden rounded-[2.5rem] bg-navy-900 px-8 py-16 sm:px-16 sm:py-20" data-reveal="zoom" data-tilt-area>
            <div class="absolute -top-24 -left-24 -z-10 size-96 rounded-full bg-gold-500/20 blur-[100px]"></div>
            <div class="absolute -right-10 -bottom-32 -z-10 size-96 rounded-full bg-navy-500/50 blur-[100px]"></div>
            <canvas data-ribbons="5" class="absolute inset-0 -z-10 h-full w-full opacity-60"></canvas>

            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-[1fr_auto]">
                <div class="max-w-2xl">
                    <span class="eyebrow">Partner with ACPL</span>
                    <h2 class="mt-6 font-display text-4xl leading-tight text-white text-balance sm:text-5xl"><?php echo esc_html( $cta['title'] ); ?></h2>
                    <p class="mt-6 text-lg leading-relaxed text-white/70"><?php echo esc_html( $cta['lead'] ); ?></p>
                    <?php if ( $cta['points'] !== [] ) : ?>
                        <ul class="mt-8 flex flex-wrap gap-2.5">
                            <?php foreach ( acpl_loop( $cta['points'] ) as [ $loop1, , $point ] ) : ?>
                                <li class="flex items-center gap-2 rounded-full border border-gold-400/30 bg-white/[0.04] px-4 py-2 text-sm text-white/85">
                                    <span class="size-1.5 rounded-full bg-gold-400"></span><?php echo esc_html( $point ); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="<?php echo esc_url( acpl_url('contact', array_filter(['enquiry' => $cta['enquiry']])) ); ?>#enquire" class="btn-gold"><?php echo esc_html( $cta['action'] ); ?> <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></a>
                        <a href="tel:<?php echo esc_attr( acpl('company.phone_href') ); ?>" class="btn-outline"><?php acpl_c( 'icon', ['name' => 'phone', 'class' => 'size-4'] ); ?> <?php echo esc_html( acpl('company.phone') ); ?></a>
                    </div>
                </div>
                <img src="<?php echo esc_url( acpl_asset('assets/images/acpl-logo-dark.webp') ); ?>" alt="" width="600" height="566" data-tilt="18" class="mx-auto hidden w-60 drop-shadow-[0_30px_60px_rgba(239,125,16,0.3)] lg:block">
            </div>
        </div>
    </div>
</section>
