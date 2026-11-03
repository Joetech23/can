<?php
/**
 * Template helpers: content access, URLs, loops and small utilities.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

/**
 * Site content: the theme defaults with any saved "ACPL Settings" applied.
 * Pass a dot path (e.g. 'company.phone') to read a single value.
 *
 * @param string|null $path    Dot path into the content array.
 * @param mixed       $default Returned when the path does not exist.
 * @return mixed
 */
function acpl( $path = null, $default = null ) {
	static $content = null;

	if ( null === $content ) {
		$content = acpl_apply_settings( require get_theme_file_path( 'inc/content.php' ) );
	}

	if ( null === $path ) {
		return $content;
	}

	$value = $content;
	foreach ( explode( '.', $path ) as $segment ) {
		if ( ! is_array( $value ) || ! array_key_exists( $segment, $value ) ) {
			return $default;
		}
		$value = $value[ $segment ];
	}

	return $value;
}

/**
 * Write a value into a nested array using a dot path.
 *
 * @param array  $array Target array.
 * @param string $path  Dot path.
 * @param mixed  $value Value to set.
 */
function acpl_array_set( array &$array, $path, $value ) {
	$keys = explode( '.', $path );
	$last = array_pop( $keys );
	$ref  = &$array;
	foreach ( $keys as $key ) {
		if ( ! isset( $ref[ $key ] ) || ! is_array( $ref[ $key ] ) ) {
			$ref[ $key ] = array();
		}
		$ref = &$ref[ $key ];
	}
	$ref[ $last ] = $value;
}

/**
 * URL of a theme file, e.g. acpl_asset( 'assets/images/acpl-logo.webp' ).
 *
 * @param string $path Path relative to the theme folder.
 * @return string
 */
function acpl_asset( $path ) {
	return get_theme_file_uri( ltrim( $path, '/' ) );
}

/**
 * Public URL for a named page of the site.
 *
 * @param string            $name Page name (home, about, services, ...).
 * @param string|array|null $arg  Slug for detail pages, or query args.
 * @return string
 */
function acpl_url( $name, $arg = null ) {
	$paths = array(
		'home'          => '/',
		'about'         => '/about/',
		'services'      => '/what-we-do/',
		'sectors'       => '/sectors-and-transactions/',
		'leadership'    => '/leadership/',
		'landing'       => '/partner/',
		'contact'       => '/contact/',
		'contact.thanks' => '/contact/thank-you/',
		'privacy'       => '/privacy-policy/',
		'disclaimer'    => '/disclaimer/',
	);

	if ( 'insights' === $name ) {
		$posts_page = (int) get_option( 'page_for_posts' );
		$url        = $posts_page ? get_permalink( $posts_page ) : home_url( '/insights/' );
	} elseif ( 'insights.show' === $name ) {
		$post = get_page_by_path( (string) $arg, OBJECT, 'post' );
		return $post ? get_permalink( $post ) : home_url( '/' . $arg . '/' );
	} elseif ( 'leadership.show' === $name ) {
		$post = get_page_by_path( (string) $arg, OBJECT, 'acpl_team' );
		return $post ? get_permalink( $post ) : home_url( '/leadership/' . $arg . '/' );
	} else {
		$url = home_url( $paths[ $name ] ?? '/' );
	}

	if ( is_array( $arg ) && array() !== array_filter( $arg ) ) {
		$url = add_query_arg( array_map( 'rawurlencode', array_filter( $arg ) ), $url );
	}

	return $url;
}

/**
 * Whether the current request is the given named page (for navigation).
 *
 * @param string $name Page name.
 * @return bool
 */
function acpl_is_current( $name ) {
	switch ( $name ) {
		case 'about':
			return is_page( 'about' );
		case 'services':
			return is_page( 'what-we-do' );
		case 'sectors':
			return is_page( 'sectors-and-transactions' );
		case 'leadership':
			return is_post_type_archive( 'acpl_team' ) || is_singular( 'acpl_team' );
		case 'insights':
			return is_home() || is_singular( 'post' ) || is_category();
		case 'contact':
			return is_page( 'contact' );
	}

	return false;
}

/**
 * Iterate with Blade-style loop information.
 *
 * @param iterable $items Items.
 * @return Generator<array{0: object, 1: mixed, 2: mixed}>
 */
function acpl_loop( $items ) {
	$items = is_array( $items ) ? $items : iterator_to_array( $items );
	$count = count( $items );
	$index = 0;

	foreach ( $items as $key => $value ) {
		$loop = (object) array(
			'index'     => $index,
			'iteration' => $index + 1,
			'first'     => 0 === $index,
			'last'      => $index === $count - 1,
			'even'      => 0 === ( $index + 1 ) % 2,
			'odd'       => 1 === ( $index + 1 ) % 2,
			'count'     => $count,
		);

		yield array( $loop, $key, $value );
		++$index;
	}
}

/**
 * Build a class list: plain entries always apply, 'class' => condition only when true.
 *
 * @param array $classes Class map.
 * @return string
 */
function acpl_class( array $classes ) {
	$list = array();
	foreach ( $classes as $key => $value ) {
		if ( is_int( $key ) ) {
			if ( $value ) {
				$list[] = $value;
			}
		} elseif ( $value ) {
			$list[] = $key;
		}
	}

	return implode( ' ', $list );
}

/**
 * Render extra HTML attributes passed to a component, merging the class.
 *
 * @param array  $attrs         Attributes.
 * @param string $default_class Class always applied.
 * @return string
 */
function acpl_attrs( array $attrs, $default_class = '' ) {
	$class = trim( $default_class . ' ' . ( $attrs['class'] ?? '' ) );
	unset( $attrs['class'] );

	$html = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	foreach ( $attrs as $name => $value ) {
		if ( false === $value || null === $value ) {
			continue;
		}
		$html .= true === $value ? ' ' . esc_attr( $name ) : ' ' . esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
	}

	return $html;
}

/**
 * Text before / after the first occurrence of a search string.
 *
 * @param string $subject Text.
 * @param string $search  Separator.
 * @return string
 */
function acpl_str_before( $subject, $search ) {
	$pos = strpos( (string) $subject, $search );

	return false === $pos ? (string) $subject : substr( $subject, 0, $pos );
}

/**
 * @param string $subject Text.
 * @param string $search  Separator.
 * @return string
 */
function acpl_str_after( $subject, $search ) {
	$pos = strpos( (string) $subject, $search );

	return false === $pos ? (string) $subject : substr( $subject, $pos + strlen( $search ) );
}

/**
 * Form state (errors and previous input) for the enquiry form, set by the
 * submission handler and read back on the contact page.
 *
 * @return array{errors: array<string, string>, old: array<string, mixed>}
 */
function acpl_form_state() {
	static $state = null;

	if ( null === $state ) {
		$state = array(
			'errors' => array(),
			'old'    => array(),
		);
		$token = isset( $_GET['form'] ) ? sanitize_key( wp_unslash( $_GET['form'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( $token ) {
			$saved = get_transient( 'acpl_form_' . $token );
			if ( is_array( $saved ) ) {
				$state = array_merge( $state, $saved );
			}
		}
	}

	return $state;
}

/**
 * @param string $key   Field name.
 * @param mixed  $default Default value.
 * @return mixed
 */
function acpl_old( $key, $default = '' ) {
	$old = acpl_form_state()['old'];

	return array_key_exists( $key, $old ) ? $old[ $key ] : $default;
}

/**
 * @param string $key Field name.
 * @return bool
 */
function acpl_has_error( $key ) {
	return isset( acpl_form_state()['errors'][ $key ] );
}

/**
 * @param string|null $key Field name; the first error when omitted.
 * @return string
 */
function acpl_error( $key = null ) {
	$errors = acpl_form_state()['errors'];

	if ( null === $key ) {
		return (string) reset( $errors );
	}

	return $errors[ $key ] ?? '';
}

/**
 * @return bool
 */
function acpl_has_errors() {
	return array() !== acpl_form_state()['errors'];
}

/**
 * Per-page settings collected before the header is printed.
 *
 * @param array|null $set Values to merge in (title, description, bare, noindex, conversion).
 * @return array
 */
function acpl_page( $set = null ) {
	static $page = array(
		'title'       => null,
		'description' => null,
		'bare'        => false,
		'noindex'     => false,
		'conversion'  => false,
	);

	if ( is_array( $set ) ) {
		$page = array_merge( $page, $set );
	}

	return $page;
}

/**
 * A leadership profile as an array, from a "Leadership" post.
 *
 * @param WP_Post $post Team member post.
 * @return array
 */
function acpl_leader( $post ) {
	$photo = get_the_post_thumbnail_url( $post, 'large' );
	if ( ! $photo ) {
		$fallback = get_post_meta( $post->ID, 'acpl_photo', true );
		$photo    = $fallback ? acpl_asset( $fallback ) : acpl_asset( 'assets/images/acpl-logo.webp' );
	}

	$lines = static function ( $value ) {
		return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n|,/', (string) $value ) ) ) );
	};

	return array(
		'id'        => $post->ID,
		'slug'      => $post->post_name,
		'name'      => get_the_title( $post ),
		'role'      => (string) get_post_meta( $post->ID, 'acpl_role', true ),
		'photo'     => $photo,
		'bio'       => has_excerpt( $post ) ? get_the_excerpt( $post ) : '',
		'intro'     => (string) get_post_meta( $post->ID, 'acpl_intro', true ),
		'focus'     => $lines( get_post_meta( $post->ID, 'acpl_focus', true ) ),
		'expertise' => array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) get_post_meta( $post->ID, 'acpl_expertise', true ) ) ) ) ),
		'url'       => get_permalink( $post ),
	);
}

/**
 * All leadership profiles, in their set order.
 *
 * @return array<int, array>
 */
function acpl_leaders() {
	$posts = get_posts(
		array(
			'post_type'      => 'acpl_team',
			'posts_per_page' => -1,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
		)
	);

	return array_map( 'acpl_leader', $posts );
}

/**
 * The chairman's details, using his leadership photo when available.
 *
 * @return array
 */
function acpl_chairman() {
	$chairman = acpl( 'chairman' );
	$post     = get_page_by_path( 'anthony-oboh', OBJECT, 'acpl_team' );

	$chairman['photo'] = $post ? acpl_leader( $post )['photo'] : acpl_asset( $chairman['photo'] );
	$chairman['url']   = $post ? get_permalink( $post ) : acpl_url( 'leadership' );

	return $chairman;
}

/**
 * An Insights article as an array, from a WordPress post.
 *
 * @param WP_Post $post Post.
 * @return array
 */
function acpl_article( $post ) {
	$categories = get_the_category( $post->ID );

	return array(
		'id'       => $post->ID,
		'slug'     => $post->post_name,
		'title'    => get_the_title( $post ),
		'category' => $categories ? $categories[0]->name : __( 'Insight', 'angelus' ),
		'excerpt'  => get_the_excerpt( $post ),
		'date'     => get_the_date( 'Y-m-d', $post ),
		'author'   => acpl( 'company.short_name' ),
		'url'      => get_permalink( $post ),
		'image'    => get_the_post_thumbnail_url( $post, 'large' ),
	);
}

/**
 * Format a Y-m-d date for display, e.g. 18 October 2026.
 *
 * @param string $date   Date.
 * @param string $format PHP date format.
 * @return string
 */
function acpl_date( $date, $format = 'j F Y' ) {
	return date_i18n( $format, strtotime( $date ) );
}

/**
 * A link entered in settings: site paths like /what-we-do/ become full URLs.
 *
 * @param string $link Path or URL.
 * @return string
 */
function acpl_link( $link ) {
	return preg_match( '#^(https?:|mailto:|tel:)#i', (string) $link ) ? $link : home_url( '/' . ltrim( (string) $link, '/' ) );
}
