<?php
/**
 * Component: section-heading.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

extract( acpl_props( $args ?? array(), ['eyebrow' => null, 'title', 'lead' => null, 'align' => 'left', 'dark' => false] ) );
?>
<div <?php echo acpl_attrs( $attrs, ($align === 'center' ? 'mx-auto text-center items-center' : '').' flex max-w-3xl flex-col gap-5' ); ?>>
    <?php if ( $eyebrow ) : ?>
        <span class="eyebrow <?php echo esc_html( $dark ? '!text-gold-400' : '' ); ?>" data-reveal><?php echo esc_html( $eyebrow ); ?></span>
    <?php endif; ?>
    <h2 class="font-display text-4xl leading-[1.08] text-balance sm:text-5xl <?php echo esc_html( $dark ? 'text-white' : 'text-navy-900' ); ?>" data-reveal style="--reveal-delay: 80ms"><?php echo $title; ?></h2>
    <?php if ( $lead ) : ?>
        <p class="max-w-2xl text-lg leading-relaxed text-pretty <?php echo esc_html( $dark ? 'text-white/65' : 'text-mist' ); ?>" data-reveal style="--reveal-delay: 160ms"><?php echo esc_html( $lead ); ?></p>
    <?php endif; ?>
</div>
