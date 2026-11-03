<?php
/**
 * Document head and site header.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#001440">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class( 'min-h-screen' ); ?>>
		<?php wp_body_open(); ?>
		<a href="#main" class="sr-only z-[100] rounded-full bg-gold-400 px-5 py-3 font-semibold text-navy-950 focus:not-sr-only focus:fixed focus:top-4 focus:left-4"><?php esc_html_e( 'Skip to content', 'angelus' ); ?></a>

		<?php acpl_c( 'site-header' ); ?>

		<main id="main">
