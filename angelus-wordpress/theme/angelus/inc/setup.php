<?php
/**
 * Theme setup: supports, assets, head tags and tracking.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	static function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
		add_theme_support( 'responsive-embeds' );
		add_post_type_support( 'page', 'excerpt' );
	}
);

add_action(
	'wp_enqueue_scripts',
	static function () {
		$version = wp_get_theme()->get( 'Version' );

		wp_enqueue_style( 'angelus', acpl_asset( 'assets/css/app.css' ), array(), $version );
		wp_enqueue_script( 'angelus', acpl_asset( 'assets/js/app.js' ), array(), $version, array( 'strategy' => 'defer', 'in_footer' => true ) );

		// The theme provides its own styling; WordPress block styles are only needed on articles.
		if ( ! is_singular( 'post' ) ) {
			wp_dequeue_style( 'wp-block-library' );
			wp_dequeue_style( 'global-styles' );
			wp_dequeue_style( 'classic-theme-styles' );
		}
	},
	20
);

// Fonts are preloaded so headings do not flash in a fallback face.
add_action(
	'wp_head',
	static function () {
		foreach ( array( 'marcellus-latin-400-normal.woff2', 'manrope-latin-400-normal.woff2' ) as $font ) {
			if ( is_readable( get_theme_file_path( 'assets/fonts/' . $font ) ) ) {
				printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( acpl_asset( 'assets/fonts/' . $font ) ) );
			}
		}
	},
	1
);

add_filter(
	'pre_get_document_title',
	static function ( $title ) {
		$page    = acpl_page();
		$company = acpl( 'company' );

		if ( $page['title'] ) {
			return $page['title'] . ' — ' . $company['short_name'];
		}

		if ( is_front_page() ) {
			return $company['name'] . ' — ' . $company['tagline'];
		}

		return $title;
	}
);

add_filter(
	'document_title_separator',
	static function () {
		return '—';
	}
);

add_filter(
	'wp_robots',
	static function ( array $robots ) {
		if ( acpl_page()['noindex'] ) {
			$robots['noindex'] = true;
			$robots['follow']  = true;
		}

		return $robots;
	}
);

/**
 * Description, social sharing tags, icons and organisation data.
 */
add_action(
	'wp_head',
	static function () {
		$page        = acpl_page();
		$company     = acpl( 'company' );
		$description = $page['description'] ? $page['description'] : $company['summary'];
		$title       = wp_get_document_title();
		$url         = is_singular() ? get_permalink() : home_url( add_query_arg( array() ) );
		?>
		<meta name="description" content="<?php echo esc_attr( wp_strip_all_tags( $description ) ); ?>">
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="<?php echo esc_attr( $company['name'] ); ?>">
		<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
		<meta property="og:description" content="<?php echo esc_attr( wp_strip_all_tags( $description ) ); ?>">
		<meta property="og:url" content="<?php echo esc_url( $url ); ?>">
		<meta property="og:image" content="<?php echo esc_url( is_singular() && has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'large' ) : acpl_asset( 'assets/images/acpl-logo.png' ) ); ?>">
		<?php if ( ! has_site_icon() ) : ?>
			<link rel="icon" type="image/png" href="<?php echo esc_url( acpl_asset( 'assets/images/favicon.png' ) ); ?>">
			<link rel="apple-touch-icon" href="<?php echo esc_url( acpl_asset( 'assets/images/apple-touch-icon.png' ) ); ?>">
		<?php endif; ?>
		<script type="application/ld+json">
			<?php
			echo wp_json_encode(
				array(
					'@context'      => 'https://schema.org',
					'@type'         => 'FinancialService',
					'name'          => $company['name'],
					'alternateName' => $company['abbr'],
					'slogan'        => $company['tagline'],
					'description'   => $company['summary'],
					'url'           => home_url( '/' ),
					'logo'          => acpl_asset( 'assets/images/acpl-logo.png' ),
					'email'         => $company['email'],
					'telephone'     => $company['phone'],
					'sameAs'        => array_values( array_filter( array( $company['linkedin'] ) ) ),
					'address'       => array(
						'@type'           => 'PostalAddress',
						'streetAddress'   => $company['address'][0] ?? '',
						'addressLocality' => 'Lagos',
						'addressCountry'  => 'NG',
					),
				),
				JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
			);
			?>
		</script>
		<?php
	},
	5
);

/**
 * Google tag (Analytics / Ads) and Meta Pixel. The thank-you page reports a
 * lead only after a real enquiry was submitted.
 */
add_action(
	'wp_head',
	static function () {
		$tracking   = acpl( 'tracking' );
		$conversion = acpl_page()['conversion'];

		if ( $tracking['google_tag'] ) :
			?>
			<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( rawurlencode( $tracking['google_tag'] ) ); ?>"></script>
			<script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());
				gtag('config', <?php echo wp_json_encode( $tracking['google_tag'] ); ?>);
				<?php if ( $conversion ) : ?>
					gtag('event', 'generate_lead');
					<?php if ( $tracking['google_ads_conversion'] ) : ?>
						gtag('event', 'conversion', { send_to: <?php echo wp_json_encode( $tracking['google_ads_conversion'] ); ?> });
					<?php endif; ?>
				<?php endif; ?>
			</script>
			<?php
		endif;

		if ( $tracking['meta_pixel'] ) :
			?>
			<script>
				!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
				fbq('init', <?php echo wp_json_encode( $tracking['meta_pixel'] ); ?>);
				fbq('track', 'PageView');
				<?php if ( $conversion ) : ?>
					fbq('track', 'Lead');
				<?php endif; ?>
			</script>
			<?php
		endif;
	},
	20
);

// Keep the landing and thank-you pages out of the XML sitemap.
add_filter(
	'wp_sitemaps_posts_query_args',
	static function ( $args, $post_type ) {
		if ( 'page' === $post_type ) {
			$excluded = array_filter(
				array_map(
					static function ( $path ) {
						$page = get_page_by_path( $path );
						return $page ? $page->ID : 0;
					},
					array( 'partner', 'contact/thank-you' )
				)
			);
			$args['post__not_in'] = array_merge( $args['post__not_in'] ?? array(), $excluded );
		}

		return $args;
	},
	10,
	2
);

add_filter(
	'wp_sitemaps_add_provider',
	static function ( $provider, $name ) {
		return 'users' === $name ? false : $provider;
	},
	10,
	2
);

// Tidy the head: no emoji scripts or generator tag.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );

/**
 * Highlight [bracketed] words in gold, e.g. "Creating [sustainable value]".
 *
 * @param string $text Plain text.
 * @return string Escaped HTML.
 */
function acpl_highlight( $text ) {
	return preg_replace( '/\[(.+?)\]/', '<span class="text-gold-gradient">$1</span>', esc_html( $text ) );
}
