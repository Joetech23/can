<?php
/**
 * Template: page not found.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;
?>
<?php acpl_start( 'layouts.app', array( 'title' => __( 'Page not found', 'angelus' ), 'noindex' => true ) ); ?>
	<?php acpl_start( 'page-hero', array( 'eyebrow' => '404', 'title' => 'This page could not be <span class=\'text-gold-gradient\'>found.</span>', 'lead' => __( 'The page may have moved. Try one of these instead.', 'angelus' ) ) ); ?>
		<div class="mt-10 flex flex-wrap gap-4">
			<a href="<?php echo esc_url( acpl_url( 'home' ) ); ?>" class="btn-gold"><?php esc_html_e( 'Go to the home page', 'angelus' ); ?></a>
			<a href="<?php echo esc_url( acpl_url( 'contact' ) ); ?>" class="btn-ghost"><?php esc_html_e( 'Contact us', 'angelus' ); ?></a>
		</div>
	<?php acpl_end( 'page-hero' ); ?>
<?php acpl_end( 'layouts.app' ); ?>
