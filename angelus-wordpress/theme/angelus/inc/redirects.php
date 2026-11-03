<?php
/**
 * Keep links from the previous version of the website working.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'template_redirect',
	static function () {
		if ( ! is_404() ) {
			return;
		}

		$path = trim( (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '', PHP_URL_PATH ), '/' );

		$moved = array(
			'sectors'            => acpl_url( 'sectors' ),
			'transactions'       => acpl_url( 'sectors' ) . '#transactions',
			'partner/thank-you'  => acpl_url( 'contact.thanks' ),
		);

		if ( isset( $moved[ $path ] ) ) {
			wp_safe_redirect( $moved[ $path ], 301 );
			exit;
		}
	}
);
