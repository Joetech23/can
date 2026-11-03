<?php
/**
 * Document head without the site header (landing and thank-you pages).
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
		<main id="main">
