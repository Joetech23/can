<?php
/**
 * First-run setup: creates the site's pages, the Insights articles and the
 * leadership profiles, and sets the home page and permalinks. Runs when the
 * theme is activated; existing content is never overwritten.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_switch_theme', 'acpl_install' );

/**
 * Create anything that is missing.
 */
function acpl_install() {
	if ( '/insights/%postname%/' !== get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/insights/%postname%/' );
	}

	$pages = array(
		'home'                     => array( 'Home', '' ),
		'about'                    => array( 'About Us', '' ),
		'what-we-do'               => array( 'What We Do', '' ),
		'sectors-and-transactions' => array( 'Sectors & Transactions', '' ),
		'insights'                 => array( 'News & Insights', '' ),
		'contact'                  => array( 'Contact', '' ),
		'partner'                  => array( 'Partner with ACPL', '' ),
		'privacy-policy'           => array( 'Privacy Policy', acpl_seed_html( 'privacy' ) ),
		'disclaimer'               => array( 'Disclaimer', acpl_seed_html( 'disclaimer' ) ),
	);

	$ids = array();
	foreach ( $pages as $slug => list( $title, $content ) ) {
		$ids[ $slug ] = acpl_ensure_post( 'page', $slug, $title, $content );
	}
	acpl_ensure_post( 'page', 'thank-you', 'Thank You', '', array( 'post_parent' => $ids['contact'] ) );

	// WordPress ships an unpublished "Privacy Policy" draft and a "Sample Page":
	// replace the draft with ACPL's policy and remove the untouched sample.
	if ( 'publish' !== get_post_status( $ids['privacy-policy'] ) ) {
		wp_update_post(
			array(
				'ID'           => $ids['privacy-policy'],
				'post_title'   => 'Privacy Policy',
				'post_content' => $pages['privacy-policy'][1],
				'post_status'  => 'publish',
			)
		);
	}
	$sample = get_page_by_path( 'sample-page' );
	if ( $sample && $sample->post_modified === $sample->post_date ) {
		wp_delete_post( $sample->ID, true );
	}

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $ids['home'] );
	update_option( 'page_for_posts', $ids['insights'] );

	// WordPress creates a "Privacy Policy" draft of its own; point it at ours.
	update_option( 'wp_page_for_privacy_policy', $ids['privacy-policy'] );

	acpl_install_insights();
	acpl_install_team();

	flush_rewrite_rules();
}

/**
 * Find a post by slug or create it.
 *
 * @param string $type    Post type.
 * @param string $slug    Slug.
 * @param string $title   Title.
 * @param string $content Content.
 * @param array  $extra   Extra wp_insert_post fields.
 * @return int Post ID.
 */
function acpl_ensure_post( $type, $slug, $title, $content = '', array $extra = array() ) {
	$parent   = $extra['post_parent'] ?? 0;
	$existing = get_posts(
		array(
			'post_type'      => $type,
			'name'           => $slug,
			'post_parent'    => 'page' === $type ? $parent : '',
			'post_status'    => array( 'publish', 'draft', 'private', 'pending', 'future' ),
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);

	if ( $existing ) {
		return (int) $existing[0];
	}

	return (int) wp_insert_post(
		array_merge(
			array(
				'post_type'    => $type,
				'post_name'    => $slug,
				'post_title'   => $title,
				'post_content' => $content,
				'post_status'  => 'publish',
			),
			$extra
		)
	);
}

/**
 * Render a first-run content file from inc/seed.
 *
 * @param string $name File name without extension.
 * @return string
 */
function acpl_seed_html( $name ) {
	ob_start();
	include get_theme_file_path( 'inc/seed/' . $name . '.php' );

	return trim( (string) ob_get_clean() );
}

/**
 * Convert simple HTML into editor blocks so it opens cleanly in WordPress.
 *
 * @param array<int, array{0: string, 1: mixed}> $items Pairs of [type, value]: h2, h3, p or ul (array of HTML items).
 * @return string
 */
function acpl_blocks( array $items ) {
	$html = '';
	foreach ( $items as list( $type, $value ) ) {
		if ( 'ul' === $type ) {
			$html .= "<!-- wp:list -->\n<ul class=\"wp-block-list\">";
			foreach ( $value as $item ) {
				$html .= "<!-- wp:list-item -->\n<li>" . $item . "</li>\n<!-- /wp:list-item -->";
			}
			$html .= "</ul>\n<!-- /wp:list -->\n\n";
		} elseif ( 'p' === $type ) {
			$html .= "<!-- wp:paragraph -->\n<p>" . $value . "</p>\n<!-- /wp:paragraph -->\n\n";
		} else {
			$level = 'h3' === $type ? 3 : 2;
			$attrs = 3 === $level ? ' {"level":3}' : '';
			$html .= "<!-- wp:heading{$attrs} -->\n<h{$level} class=\"wp-block-heading\">" . $value . "</h{$level}>\n<!-- /wp:heading -->\n\n";
		}
	}

	return trim( $html );
}

/**
 * News & Insights articles from the original site.
 */
function acpl_install_insights() {
	$defaults = require get_theme_file_path( 'inc/content.php' );

	foreach ( array_reverse( $defaults['insights'] ) as $article ) {
		if ( get_page_by_path( $article['slug'], OBJECT, 'post' ) ) {
			continue;
		}

		$items = array();
		foreach ( $article['body'] as $paragraph ) {
			$items[] = 0 === strpos( $paragraph, '## ' ) ? array( 'h2', esc_html( substr( $paragraph, 3 ) ) ) : array( 'p', esc_html( $paragraph ) );
		}

		$category = term_exists( $article['category'], 'category' );
		if ( ! $category ) {
			$category = wp_insert_term( $article['category'], 'category' );
		}

		acpl_ensure_post(
			'post',
			$article['slug'],
			$article['title'],
			acpl_blocks( $items ),
			array(
				'post_excerpt'  => $article['excerpt'],
				'post_date'     => $article['date'] . ' 09:00:00',
				'post_category' => is_wp_error( $category ) ? array() : array( (int) $category['term_id'] ),
			)
		);
	}

	// Remove the default "Hello world!" post on a fresh site.
	$hello = get_page_by_path( 'hello-world', OBJECT, 'post' );
	if ( $hello && $hello->post_modified === $hello->post_date ) {
		wp_delete_post( $hello->ID, true );
	}
}

/**
 * Leadership profiles, with their photos added to the Media Library.
 */
function acpl_install_team() {
	$defaults = require get_theme_file_path( 'inc/content.php' );

	foreach ( $defaults['leadership'] as $order => $leader ) {
		if ( get_page_by_path( $leader['slug'], OBJECT, 'acpl_team' ) ) {
			continue;
		}

		$items = array();
		foreach ( $leader['milestones'] as $milestone ) {
			$items[] = array( 'h3', esc_html( $milestone['title'] ) );
			$items[] = array( 'p', esc_html( $milestone['lead'] ) );
			$items[] = array(
				'ul',
				array_map(
					static function ( $item ) {
						return '<strong>' . esc_html( $item['label'] ) . '</strong> — ' . esc_html( $item['text'] );
					},
					$milestone['items']
				),
			);
		}

		$post_id = acpl_ensure_post(
			'acpl_team',
			$leader['slug'],
			$leader['name'],
			acpl_blocks( $items ),
			array(
				'post_excerpt' => $leader['bio'],
				'menu_order'   => $order,
			)
		);

		update_post_meta( $post_id, 'acpl_role', $leader['role'] );
		update_post_meta( $post_id, 'acpl_intro', $leader['intro'] );
		update_post_meta( $post_id, 'acpl_focus', implode( ', ', $leader['focus'] ) );
		update_post_meta( $post_id, 'acpl_expertise', implode( "\n", $leader['expertise'] ) );
		update_post_meta( $post_id, 'acpl_photo', $leader['photo'] );

		acpl_attach_theme_image( $post_id, $leader['photo'], $leader['name'] );
	}
}

/**
 * Copy a theme image into the Media Library and set it as the featured image.
 *
 * @param int    $post_id Post ID.
 * @param string $path    Theme-relative image path.
 * @param string $title   Image title.
 */
function acpl_attach_theme_image( $post_id, $path, $title ) {
	$source = get_theme_file_path( $path );
	if ( ! is_readable( $source ) || has_post_thumbnail( $post_id ) ) {
		return;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$temp = wp_tempnam( basename( $source ) );
	if ( ! $temp || ! copy( $source, $temp ) ) {
		return;
	}

	$attachment_id = media_handle_sideload(
		array(
			'name'     => basename( $source ),
			'tmp_name' => $temp,
		),
		$post_id,
		$title
	);

	if ( is_wp_error( $attachment_id ) ) {
		wp_delete_file( $temp );
		return;
	}

	set_post_thumbnail( $post_id, $attachment_id );
}
