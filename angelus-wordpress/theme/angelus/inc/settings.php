<?php
/**
 * "ACPL Settings" admin screen: lets the team edit the site's key texts,
 * contact details, tracking IDs and enquiry routing without touching code.
 *
 * Each field writes to a dot path in the content array (inc/content.php).
 * Required texts fall back to the theme default when left empty; optional
 * ones (marked 'optional') can be cleared.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

/**
 * Field definitions, grouped into sections.
 *
 * @return array<string, array{title: string, intro?: string, fields: array<string, array>}>
 */
function acpl_settings_schema() {
	$sections = array(
		'company'   => array(
			'title'  => __( 'Company & contact details', 'angelus' ),
			'fields' => array(
				'company.phone'         => array( 'label' => 'Phone number', 'type' => 'text' ),
				'company.email'         => array( 'label' => 'Email address', 'type' => 'email' ),
				'company.whatsapp'      => array( 'label' => 'WhatsApp number', 'type' => 'text', 'help' => 'International format, digits only, e.g. 2348023261918.' ),
				'company.address'       => array( 'label' => 'Head office address', 'type' => 'lines', 'help' => 'One line per row.' ),
				'company.annex_label'   => array( 'label' => 'Second office label', 'type' => 'text', 'optional' => true ),
				'company.annex_address' => array( 'label' => 'Second office address', 'type' => 'lines', 'optional' => true, 'help' => 'One line per row. Leave empty to hide.' ),
				'company.linkedin'      => array( 'label' => 'LinkedIn page URL', 'type' => 'url', 'optional' => true ),
				'company.rc_number'     => array( 'label' => 'RC number', 'type' => 'text', 'optional' => true, 'help' => 'e.g. RC 1234567. Shown in the footer.' ),
			),
		),
		'brand'     => array(
			'title'  => __( 'Brand & home page', 'angelus' ),
			'intro'  => 'Wrap words in [square brackets] to show them in gold.',
			'fields' => array(
				'company.tagline'   => array( 'label' => 'Tagline', 'type' => 'text' ),
				'company.strapline' => array( 'label' => 'Corporate statement', 'type' => 'text' ),
				'home.headline'     => array( 'label' => 'Home page headline', 'type' => 'text' ),
				'company.summary'   => array( 'label' => 'Value proposition', 'type' => 'textarea' ),
				'ticker.label'      => array( 'label' => 'Ticker label', 'type' => 'text' ),
				'ticker.items'      => array( 'label' => 'Ticker announcements', 'type' => 'ticker', 'help' => 'One per line. Add a link after a | sign, e.g. "New e-invoicing service | /what-we-do/#einvoice".' ),
			),
		),
		'about'     => array(
			'title'  => __( 'About page', 'angelus' ),
			'fields' => array(
				'about.intro'          => array( 'label' => 'Introduction', 'type' => 'textarea' ),
				'vision'               => array( 'label' => 'Vision', 'type' => 'textarea' ),
				'mission'              => array( 'label' => 'Mission', 'type' => 'textarea' ),
				'chairman.headline'    => array( 'label' => 'Chairman’s message headline', 'type' => 'text' ),
				'chairman.message'     => array( 'label' => 'Chairman’s message', 'type' => 'paragraphs', 'help' => 'Leave a blank line between paragraphs.' ),
				'chairman.pull_quote'  => array( 'label' => 'Chairman’s quote', 'type' => 'textarea' ),
			),
		),
		'landing'   => array(
			'title'  => __( 'Advertising landing page (/partner)', 'angelus' ),
			'intro'  => 'Wrap words in [square brackets] to show them in gold.',
			'fields' => array(
				'landing.title'       => array( 'label' => 'Headline', 'type' => 'text' ),
				'landing.lead'        => array( 'label' => 'Introduction', 'type' => 'textarea' ),
				'landing.points'      => array( 'label' => 'Bullet points', 'type' => 'lines', 'help' => 'One per line, in platform order. Text before a colon is shown in bold.' ),
				'landing.final.title' => array( 'label' => 'Closing headline', 'type' => 'text' ),
				'landing.final.lead'  => array( 'label' => 'Closing text', 'type' => 'textarea' ),
			),
		),
		'ctas'      => array(
			'title'  => __( '“Partner with ACPL” boxes', 'angelus' ),
			'intro'  => 'The call to action at the foot of each page.',
			'fields' => array(),
		),
		'tracking'  => array(
			'title'  => __( 'Analytics & advertising', 'angelus' ),
			'fields' => array(
				'tracking.google_tag'            => array( 'label' => 'Google Analytics ID', 'type' => 'text', 'optional' => true, 'help' => 'Starts with G-, e.g. G-ABC123XYZ9.' ),
				'tracking.google_ads_conversion' => array( 'label' => 'Google Ads conversion', 'type' => 'text', 'optional' => true, 'help' => 'Only when running Google Ads, e.g. AW-123456789/AbCdEf.' ),
				'tracking.meta_pixel'            => array( 'label' => 'Meta (Facebook) Pixel ID', 'type' => 'text', 'optional' => true ),
			),
		),
		'enquiries' => array(
			'title'  => __( 'Enquiries', 'angelus' ),
			'intro'  => 'Every enquiry is saved under “Enquiries”, emailed to the mailbox below (or the company email if empty) and added to DoubleScale CRM when that plugin is active.',
			'fields' => array(),
		),
	);

	foreach ( array( 'home' => 'Home', 'about' => 'About', 'services' => 'What We Do', 'sectors' => 'Sectors & Transactions', 'leadership' => 'Leadership', 'insights' => 'Insights' ) as $page => $label ) {
		$sections['ctas']['fields'][ "ctas.{$page}.title" ]  = array( 'label' => "{$label}: headline", 'type' => 'text' );
		$sections['ctas']['fields'][ "ctas.{$page}.lead" ]   = array( 'label' => "{$label}: text", 'type' => 'textarea' );
		$sections['ctas']['fields'][ "ctas.{$page}.points" ] = array( 'label' => "{$label}: highlights", 'type' => 'lines', 'optional' => true, 'help' => 'One per line (optional).' );
		$sections['ctas']['fields'][ "ctas.{$page}.action" ] = array( 'label' => "{$label}: button", 'type' => 'text' );
	}

	$defaults = require get_theme_file_path( 'inc/content.php' );
	foreach ( $defaults['enquiry_types'] as $type => $label ) {
		$sections['enquiries']['fields'][ "enquiry_routing.{$type}.email" ] = array( 'label' => $label, 'type' => 'email', 'optional' => true );
	}
	$sections['enquiries']['fields']['crm.webhook_url'] = array( 'label' => 'Extra CRM webhook URL', 'type' => 'url', 'optional' => true, 'help' => 'Optional. Only needed for a CRM other than DoubleScale.' );
	$sections['enquiries']['fields']['crm.token']       = array( 'label' => 'Webhook token', 'type' => 'text', 'optional' => true );

	return $sections;
}

/**
 * @return array<string, array> Flat path => field map.
 */
function acpl_settings_fields() {
	$fields = array();
	foreach ( acpl_settings_schema() as $section ) {
		$fields += $section['fields'];
	}

	return $fields;
}

/**
 * Convert a stored setting string into its content value.
 *
 * @param string $raw  Stored text.
 * @param string $type Field type.
 * @return mixed
 */
function acpl_setting_value( $raw, $type ) {
	$raw = (string) $raw;

	switch ( $type ) {
		case 'lines':
			return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $raw ) ), 'strlen' ) );
		case 'paragraphs':
			return array_values( array_filter( array_map( 'trim', preg_split( '/(\r\n|\r|\n)\s*(\r\n|\r|\n)/', $raw ) ), 'strlen' ) );
		case 'ticker':
			$items = array();
			foreach ( acpl_setting_value( $raw, 'lines' ) as $line ) {
				$parts   = array_map( 'trim', explode( '|', $line, 2 ) );
				$items[] = array_filter(
					array(
						'text' => $parts[0],
						'url'  => $parts[1] ?? null,
					)
				);
			}
			return $items;
		default:
			return trim( $raw );
	}
}

/**
 * Convert a content value back into editable text.
 *
 * @param mixed  $value Content value.
 * @param string $type  Field type.
 * @return string
 */
function acpl_setting_text( $value, $type ) {
	switch ( $type ) {
		case 'lines':
			return implode( "\n", (array) $value );
		case 'paragraphs':
			return implode( "\n\n", (array) $value );
		case 'ticker':
			return implode(
				"\n",
				array_map(
					static function ( $item ) {
						return trim( ( $item['text'] ?? '' ) . ( empty( $item['url'] ) ? '' : ' | ' . $item['url'] ) );
					},
					(array) $value
				)
			);
		default:
			return (string) $value;
	}
}

/**
 * Overlay saved settings on the default content.
 *
 * @param array $content Default content.
 * @return array
 */
function acpl_apply_settings( array $content ) {
	$saved = get_option( 'acpl_settings', array() );
	$saved = is_array( $saved ) ? $saved : array();

	foreach ( acpl_settings_fields() as $path => $field ) {
		if ( ! array_key_exists( $path, $saved ) ) {
			continue;
		}
		$raw = (string) $saved[ $path ];
		if ( '' === trim( $raw ) && empty( $field['optional'] ) ) {
			continue;
		}
		acpl_array_set( $content, $path, acpl_setting_value( $raw, $field['type'] ) );
	}

	$content['company']['phone_href'] = '+' . preg_replace( '/\D+/', '', (string) $content['company']['phone'] );
	$content['company']['whatsapp']   = preg_replace( '/\D+/', '', (string) $content['company']['whatsapp'] );

	return $content;
}

/**
 * @param mixed $input Submitted values.
 * @return array<string, string>
 */
function acpl_sanitize_settings( $input ) {
	$clean = array();
	$input = is_array( $input ) ? $input : array();

	foreach ( acpl_settings_fields() as $path => $field ) {
		$key = str_replace( '.', '__', $path );
		if ( ! isset( $input[ $key ] ) ) {
			continue;
		}
		$value = wp_unslash( $input[ $key ] );

		switch ( $field['type'] ) {
			case 'email':
				$value = sanitize_email( $value );
				break;
			case 'url':
				$value = esc_url_raw( trim( $value ) );
				break;
			case 'text':
				$value = sanitize_text_field( $value );
				break;
			default:
				$value = sanitize_textarea_field( $value );
		}

		$clean[ $path ] = $value;
	}

	return $clean;
}

add_action(
	'admin_init',
	static function () {
		register_setting(
			'acpl_settings',
			'acpl_settings',
			array(
				'type'              => 'array',
				'sanitize_callback' => 'acpl_sanitize_settings',
				'default'           => array(),
			)
		);
	}
);

add_action(
	'admin_menu',
	static function () {
		add_menu_page(
			__( 'ACPL Settings', 'angelus' ),
			__( 'ACPL Settings', 'angelus' ),
			'manage_options',
			'acpl-settings',
			'acpl_render_settings_page',
			'dashicons-building',
			3
		);
	}
);

/**
 * Render the settings screen.
 */
function acpl_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$content = acpl();
	?>
	<div class="wrap acpl-settings">
		<h1><?php esc_html_e( 'ACPL Settings', 'angelus' ); ?></h1>
		<p><?php esc_html_e( 'Edit the main website texts and details. Leave a required field empty to restore its original text.', 'angelus' ); ?></p>
		<style>
			.acpl-settings .acpl-section{background:#fff;border:1px solid #dcdcde;border-radius:8px;padding:8px 24px 16px;margin:20px 0;max-width:960px}
			.acpl-settings textarea{width:100%;max-width:640px}
			.acpl-settings input.regular-text{width:100%;max-width:640px}
		</style>
		<form method="post" action="options.php">
			<?php settings_fields( 'acpl_settings' ); ?>
			<?php foreach ( acpl_settings_schema() as $section_id => $section ) : ?>
				<div class="acpl-section" id="acpl-<?php echo esc_attr( $section_id ); ?>">
					<h2><?php echo esc_html( $section['title'] ); ?></h2>
					<?php if ( ! empty( $section['intro'] ) ) : ?>
						<p class="description"><?php echo esc_html( $section['intro'] ); ?></p>
					<?php endif; ?>
					<table class="form-table" role="presentation">
						<?php foreach ( $section['fields'] as $path => $field ) : ?>
							<?php
							$name  = 'acpl_settings[' . str_replace( '.', '__', $path ) . ']';
							$id    = 'acpl-' . str_replace( '.', '-', $path );
							$value = acpl_setting_text( acpl( $path ), $field['type'] );
							?>
							<tr>
								<th scope="row"><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $field['label'] ); ?></label></th>
								<td>
									<?php if ( in_array( $field['type'], array( 'textarea', 'lines', 'paragraphs', 'ticker' ), true ) ) : ?>
										<textarea id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" rows="<?php echo 'paragraphs' === $field['type'] ? 10 : 4; ?>"><?php echo esc_textarea( $value ); ?></textarea>
									<?php else : ?>
										<input class="regular-text" type="<?php echo esc_attr( in_array( $field['type'], array( 'email', 'url' ), true ) ? $field['type'] : 'text' ); ?>" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>">
									<?php endif; ?>
									<?php if ( ! empty( $field['help'] ) ) : ?>
										<p class="description"><?php echo esc_html( $field['help'] ); ?></p>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
			<?php endforeach; ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
