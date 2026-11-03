<?php
/**
 * Component: logo.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

extract( acpl_props( $args ?? array(), ['onDark' => false, 'compact' => false] ) );
?>
<?php /* Brand lockup: mark, slim gold rule, then the company name. */ ?>
<span <?php echo acpl_attrs( $attrs, 'group inline-flex items-center gap-3' ); ?>>
    <img src="<?php echo esc_url( acpl_asset($onDark ? 'assets/images/acpl-logo-dark.webp' : 'assets/images/acpl-logo.webp') ); ?>" alt="" width="600" height="566" class="h-11 w-auto transition-transform duration-700 ease-out-expo group-hover:rotate-[-6deg] group-hover:scale-105 <?php echo esc_html( $compact ? '' : 'sm:h-12' ); ?>">
    <span class="h-10 w-px <?php echo esc_html( $onDark ? 'bg-gold-400/60' : 'bg-gold-500' ); ?>"></span>
    <span class="flex flex-col leading-none">
        <span class="font-display text-[1.5rem] tracking-wide <?php echo esc_html( $onDark ? 'text-white' : 'text-navy-900' ); ?>">Angelus</span>
        <span class="mt-1 text-[0.58rem] font-semibold tracking-[0.22em] uppercase <?php echo esc_html( $onDark ? 'text-white/70' : 'text-navy-900/80' ); ?>">Capital Partners Limited</span>
    </span>
    <span class="sr-only"><?php echo esc_html( acpl('company.name') ); ?></span>
</span>
