<?php
/**
 * Component: portrait.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

extract( acpl_props( $args ?? array(), ['leader', 'eager' => false] ) );
?>
<div <?php echo acpl_attrs( $attrs, 'relative rounded-[1.75rem] bg-gradient-to-br from-gold-300 via-gold-500 to-ember p-[3px] shadow-[0_30px_60px_-25px_rgba(7,24,52,0.55)]' ); ?>>
    <div class="relative overflow-hidden rounded-[calc(1.75rem-3px)] bg-navy-900">
        <img src="<?php echo esc_url( $leader['photo'] ); ?>" alt="Portrait of <?php echo esc_html( $leader['name'] ); ?>, <?php echo esc_html( $leader['role'] ); ?>" width="450" height="563" <?php if ( ! $eager ) : ?> loading="lazy" <?php endif; ?> class="aspect-[4/5] w-full object-cover object-top transition duration-700 ease-out-expo group-hover:scale-[1.04]">
        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-navy-950/70 to-transparent"></div>
    </div>
</div>
