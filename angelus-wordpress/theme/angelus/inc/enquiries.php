<?php
/**
 * Website enquiries: validation, a saved copy under "Enquiries", an email to
 * the responsible team, DoubleScale CRM and (optionally) a webhook.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

const ACPL_CAMPAIGN_PARAMETERS = array( 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'gclid', 'fbclid' );

/*
 * Saved enquiries: a private list in the admin so nothing is ever lost,
 * even if an email lands in spam.
 */
add_action(
	'init',
	static function () {
		register_post_type(
			'acpl_enquiry',
			array(
				'labels'          => array(
					'name'          => __( 'Enquiries', 'angelus' ),
					'singular_name' => __( 'Enquiry', 'angelus' ),
					'edit_item'     => __( 'Enquiry', 'angelus' ),
					'all_items'     => __( 'All enquiries', 'angelus' ),
				),
				'public'          => false,
				'show_ui'         => true,
				'menu_icon'       => 'dashicons-email-alt',
				'menu_position'   => 4,
				'supports'        => array( 'title', 'editor' ),
				'capability_type' => 'post',
				'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
				'map_meta_cap'    => true,
			)
		);
	}
);

add_filter(
	'manage_acpl_enquiry_posts_columns',
	static function () {
		return array(
			'cb'           => '<input type="checkbox">',
			'title'        => __( 'Name', 'angelus' ),
			'acpl_email'   => __( 'Email', 'angelus' ),
			'acpl_type'    => __( 'Enquiry', 'angelus' ),
			'acpl_source'  => __( 'Source', 'angelus' ),
			'date'         => __( 'Received', 'angelus' ),
		);
	}
);

add_action(
	'manage_acpl_enquiry_posts_custom_column',
	static function ( $column, $post_id ) {
		if ( 'acpl_email' === $column ) {
			$email = get_post_meta( $post_id, 'acpl_email', true );
			printf( '<a href="mailto:%1$s">%2$s</a>', esc_attr( $email ), esc_html( $email ) );
		} elseif ( 'acpl_type' === $column ) {
			echo esc_html( get_post_meta( $post_id, 'acpl_type_label', true ) );
		} elseif ( 'acpl_source' === $column ) {
			$campaign = (array) get_post_meta( $post_id, 'acpl_campaign', true );
			echo esc_html( $campaign['utm_source'] ?? ( isset( $campaign['gclid'] ) ? 'Google Ads' : ( isset( $campaign['fbclid'] ) ? 'Facebook/Instagram' : '—' ) ) );
		}
	},
	10,
	2
);

/*
 * Remember how the visitor arrived (ad campaign, landing page, referrer) so
 * the enquiry can be credited to the right source.
 */
add_action(
	'template_redirect',
	static function () {
		$params = array();
		foreach ( ACPL_CAMPAIGN_PARAMETERS as $key ) {
			if ( isset( $_GET[ $key ] ) && '' !== $_GET[ $key ] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$params[ $key ] = substr( sanitize_text_field( wp_unslash( $_GET[ $key ] ) ), 0, 160 ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			}
		}

		$expires = time() + 30 * DAY_IN_SECONDS;
		$options = array(
			'expires'  => $expires,
			'path'     => COOKIEPATH ? COOKIEPATH : '/',
			'secure'   => is_ssl(),
			'httponly' => true,
			'samesite' => 'Lax',
		);

		if ( $params ) {
			setcookie( 'acpl_campaign', wp_json_encode( $params ), $options );
		}

		if ( empty( $_COOKIE['acpl_landing'] ) ) {
			$landing = array(
				'landing_page' => substr( esc_url_raw( home_url( add_query_arg( array() ) ) ), 0, 255 ),
				'referrer'     => substr( esc_url_raw( wp_get_raw_referer() ? wp_get_raw_referer() : '' ), 0, 255 ),
			);
			setcookie( 'acpl_landing', wp_json_encode( array_filter( $landing ) ), $options );
		}
	}
);

/**
 * Campaign details captured in the visitor's cookies.
 *
 * @return array<string, string>
 */
function acpl_campaign() {
	$campaign = array();
	foreach ( array( 'acpl_landing', 'acpl_campaign' ) as $cookie ) {
		if ( ! empty( $_COOKIE[ $cookie ] ) ) {
			$data = json_decode( wp_unslash( $_COOKIE[ $cookie ] ), true ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitized below.
			if ( is_array( $data ) ) {
				foreach ( $data as $key => $value ) {
					if ( is_string( $value ) && '' !== $value ) {
						$campaign[ sanitize_key( $key ) ] = sanitize_text_field( $value );
					}
				}
			}
		}
	}

	return $campaign;
}

/**
 * Questionnaire answers from the landing page, keeping only known options.
 *
 * @param mixed $submitted Raw answers keyed by question.
 * @return array<string, string>
 */
function acpl_valid_answers( $submitted ) {
	$answers = array();
	if ( ! is_array( $submitted ) ) {
		return $answers;
	}

	foreach ( acpl( 'questionnaire' ) as $key => $question ) {
		$answer = isset( $submitted[ $key ] ) && is_string( $submitted[ $key ] ) ? wp_unslash( $submitted[ $key ] ) : '';
		if ( in_array( $answer, $question['options'], true ) ) {
			$answers[ $key ] = $answer;
		}
	}

	return $answers;
}

/**
 * The business unit and mailbox for an enquiry type.
 *
 * @param string $type Enquiry type key.
 * @return array{unit: string, email: string}
 */
function acpl_route_for( $type ) {
	$route = acpl( "enquiry_routing.{$type}" ) ?? acpl( 'enquiry_routing.other' );

	return array(
		'unit'  => $route['unit'],
		'email' => is_email( $route['email'] ?? '' ) ? $route['email'] : acpl( 'company.email' ),
	);
}

add_action( 'admin_post_nopriv_acpl_enquiry', 'acpl_handle_enquiry' );
add_action( 'admin_post_acpl_enquiry', 'acpl_handle_enquiry' );

/**
 * Handle the contact form submission.
 */
function acpl_handle_enquiry() {
	// phpcs:disable WordPress.Security.NonceVerification.Missing -- public form; protected by honeypot and rate limit (page caching makes nonces unreliable).
	$thanks = acpl_url( 'contact.thanks' );

	if ( ! empty( $_POST['company_website'] ) ) {
		wp_safe_redirect( $thanks );
		exit;
	}

	$ip_key = 'acpl_rl_' . md5( (string) ( $_SERVER['REMOTE_ADDR'] ?? '' ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	$count  = (int) get_transient( $ip_key );
	if ( $count >= 5 ) {
		wp_die( esc_html__( 'Too many enquiries were sent from your connection. Please wait a minute and try again.', 'angelus' ), 429 );
	}
	set_transient( $ip_key, $count + 1, MINUTE_IN_SECONDS );

	$text = static function ( $key, $max ) {
		return isset( $_POST[ $key ] ) ? mb_substr( trim( sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) ), 0, $max ) : '';
	};

	$enquiry = array(
		'name'         => $text( 'name', 120 ),
		'email'        => isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '',
		'phone'        => $text( 'phone', 40 ),
		'organization' => $text( 'organization', 160 ),
		'enquiry_type' => isset( $_POST['enquiry_type'] ) ? sanitize_key( wp_unslash( $_POST['enquiry_type'] ) ) : '',
		'message'      => isset( $_POST['message'] ) ? mb_substr( trim( sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) ), 0, 5000 ) : '',
		'answers'      => acpl_valid_answers( $_POST['answers'] ?? array() ), // phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- validated against the option list.
	);
	// phpcs:enable

	$errors = array();
	if ( '' === $enquiry['name'] ) {
		$errors['name'] = __( 'Please enter your name.', 'angelus' );
	}
	if ( ! is_email( $enquiry['email'] ) ) {
		$errors['email'] = __( 'Please enter a valid email address.', 'angelus' );
	}
	if ( ! array_key_exists( $enquiry['enquiry_type'], acpl( 'enquiry_types' ) ) ) {
		$errors['enquiry_type'] = __( 'Please choose how we can help.', 'angelus' );
	}
	if ( '' !== $enquiry['message'] && mb_strlen( $enquiry['message'] ) < 10 ) {
		$errors['message'] = __( 'Please tell us a little more about your enquiry.', 'angelus' );
	}

	if ( $errors ) {
		$token = wp_generate_password( 20, false );
		set_transient(
			'acpl_form_' . strtolower( $token ),
			array(
				'errors' => $errors,
				'old'    => $enquiry,
			),
			15 * MINUTE_IN_SECONDS
		);
		wp_safe_redirect( add_query_arg( 'form', strtolower( $token ), acpl_url( 'contact' ) ) . '#enquire' );
		exit;
	}

	acpl_process_enquiry( $enquiry, acpl_campaign() );

	$token      = strtolower( wp_generate_password( 20, false ) );
	$first_name = acpl_str_before( $enquiry['name'], ' ' );
	set_transient( 'acpl_lead_' . $token, $first_name, 30 * MINUTE_IN_SECONDS );

	wp_safe_redirect( add_query_arg( 'lead', $token, $thanks ) );
	exit;
}

/**
 * Save, email and forward a validated enquiry.
 *
 * @param array                 $enquiry  Validated enquiry.
 * @param array<string, string> $campaign Campaign details.
 * @return int Saved enquiry post ID.
 */
function acpl_process_enquiry( array $enquiry, array $campaign ) {
	$route   = acpl_route_for( $enquiry['enquiry_type'] );
	$label   = acpl( 'enquiry_types.' . $enquiry['enquiry_type'] );
	$answers = array();
	foreach ( $enquiry['answers'] as $key => $answer ) {
		$answers[ acpl( "questionnaire.{$key}.label" ) ] = $answer;
	}

	$details = acpl_enquiry_email_html( $enquiry, $route['unit'], $campaign, $answers );

	$post_id = wp_insert_post(
		array(
			'post_type'    => 'acpl_enquiry',
			'post_status'  => 'private',
			'post_title'   => $enquiry['name'] . ( $enquiry['organization'] ? ' — ' . $enquiry['organization'] : '' ),
			'post_content' => wp_kses_post( $details ),
		)
	);
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, 'acpl_email', $enquiry['email'] );
		update_post_meta( $post_id, 'acpl_type', $enquiry['enquiry_type'] );
		update_post_meta( $post_id, 'acpl_type_label', $label );
		update_post_meta( $post_id, 'acpl_routed_to', $route['unit'] . ' <' . $route['email'] . '>' );
		update_post_meta( $post_id, 'acpl_campaign', $campaign );
		update_post_meta( $post_id, 'acpl_answers', $answers );
	}

	$sent = wp_mail(
		$route['email'],
		sprintf( 'New website enquiry: %s — %s', $label, $enquiry['name'] ),
		$details,
		array(
			'Content-Type: text/html; charset=UTF-8',
			sprintf( 'Reply-To: %s <%s>', str_replace( array( '<', '>', '"' ), '', $enquiry['name'] ), $enquiry['email'] ),
		)
	);
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, 'acpl_email_sent', $sent ? 'yes' : 'no' );
	}

	acpl_send_to_doublescale( $enquiry, $label, $route['unit'], $answers, $campaign );
	acpl_send_to_webhook( $enquiry, $label, $route['unit'], $answers, $campaign );

	/**
	 * Fires after a website enquiry is processed, for other integrations.
	 *
	 * @param array $enquiry  Validated enquiry.
	 * @param array $campaign Campaign details.
	 */
	do_action( 'acpl_enquiry_received', $enquiry, $campaign );

	return (int) $post_id;
}

/**
 * Add or update the contact in DoubleScale CRM, tag it and attach the enquiry
 * as a note. Tags let DoubleScale automations react ("Tag added" trigger).
 *
 * @param array                 $enquiry  Validated enquiry.
 * @param string                $label    Enquiry type label.
 * @param string                $unit     Business unit.
 * @param array<string, string> $answers  Questionnaire answers.
 * @param array<string, string> $campaign Campaign details.
 * @return bool Whether the contact was saved.
 */
function acpl_send_to_doublescale( array $enquiry, $label, $unit, array $answers, array $campaign ) {
	$contact_class = '\DoubleScale\Modules\Contacts\Models\ContactModel';
	if ( ! class_exists( $contact_class ) ) {
		return false;
	}

	try {
		$name    = trim( $enquiry['name'] );
		$fields  = array(
			'first_name'   => acpl_str_before( $name, ' ' ),
			'last_name'    => false !== strpos( $name, ' ' ) ? acpl_str_after( $name, ' ' ) : '',
			'phone'        => $enquiry['phone'],
			'company_name' => $enquiry['organization'],
		);
		$contact = $contact_class::get_by_email( $enquiry['email'] );

		if ( ! $contact ) {
			$contact = $contact_class::create( array( 'email' => $enquiry['email'], 'email_status' => 'unverified' ) + $fields );
		} else {
			$changed = false;
			foreach ( $fields as $field => $value ) {
				if ( '' !== $value && '' === (string) $contact->{$field} ) {
					$contact->{$field} = $value;
					$changed           = true;
				}
			}
			if ( $changed ) {
				$contact->save();
			}
		}

		if ( ! $contact || ! $contact->id ) {
			return false;
		}

		$tag_class = '\DoubleScale\Modules\Contacts\Models\TagModel';
		if ( class_exists( $tag_class ) && method_exists( $contact, 'add_tags' ) ) {
			$tag_ids = array();
			foreach ( array( 'Website enquiry', $label ) as $tag_name ) {
				$tag = $tag_class::getOrCreate( $tag_name );
				if ( $tag && $tag->id ) {
					$tag_ids[] = (int) $tag->id;
				}
			}
			$contact->add_tags( $tag_ids );
		}

		$lines = array( '<p><strong>Enquiry:</strong> ' . esc_html( $label ) . ' (routed to ' . esc_html( $unit ) . ')</p>' );
		if ( '' !== $enquiry['message'] ) {
			$lines[] = '<p>' . nl2br( esc_html( $enquiry['message'] ) ) . '</p>';
		}
		foreach ( $answers as $question => $answer ) {
			$lines[] = '<p><strong>' . esc_html( $question ) . '</strong> ' . esc_html( $answer ) . '</p>';
		}
		if ( $campaign ) {
			$lines[] = '<p><strong>Source:</strong> ' . esc_html( implode( ', ', array_map( static fn( $k, $v ) => $k . '=' . $v, array_keys( $campaign ), $campaign ) ) ) . '</p>';
		}

		$note = array(
			'contact_id' => (int) $contact->id,
			'title'      => 'Website enquiry: ' . $label,
			'content'    => implode( "\n", $lines ),
		);
		$manager = '\DoubleScale\Modules\Activities\Services\ActivityManager';
		$model   = '\DoubleScale\Modules\Activities\Models\ActivityModel';
		if ( class_exists( $manager ) ) {
			$manager::instance()->add_note( $note );
		} elseif ( class_exists( $model ) ) {
			$model::add_note( $note );
		}

		return true;
	} catch ( Throwable $exception ) {
		error_log( 'ACPL: DoubleScale contact could not be saved: ' . $exception->getMessage() ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log

		return false;
	}
}

/**
 * Post the enquiry as JSON to an optional CRM webhook.
 *
 * @param array                 $enquiry  Validated enquiry.
 * @param string                $label    Enquiry type label.
 * @param string                $unit     Business unit.
 * @param array<string, string> $answers  Questionnaire answers.
 * @param array<string, string> $campaign Campaign details.
 * @return bool
 */
function acpl_send_to_webhook( array $enquiry, $label, $unit, array $answers, array $campaign ) {
	$url = acpl( 'crm.webhook_url' );
	if ( ! $url ) {
		return false;
	}

	$name    = trim( $enquiry['name'] );
	$headers = array( 'Content-Type' => 'application/json' );
	if ( acpl( 'crm.token' ) ) {
		$headers['Authorization'] = 'Bearer ' . acpl( 'crm.token' );
	}

	$response = wp_remote_post(
		$url,
		array(
			'timeout' => 8,
			'headers' => $headers,
			'body'    => wp_json_encode(
				array(
					'source'        => 'website',
					'submitted_at'  => gmdate( 'c' ),
					'contact'       => array(
						'name'         => $name,
						'first_name'   => acpl_str_before( $name, ' ' ),
						'last_name'    => false !== strpos( $name, ' ' ) ? acpl_str_after( $name, ' ' ) : null,
						'email'        => $enquiry['email'],
						'phone'        => $enquiry['phone'],
						'organization' => $enquiry['organization'],
					),
					'enquiry'       => array(
						'type'      => $enquiry['enquiry_type'],
						'label'     => $label,
						'routed_to' => $unit,
						'message'   => $enquiry['message'],
					),
					'questionnaire' => $answers,
					'campaign'      => $campaign,
				)
			),
		)
	);

	return ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) < 300;
}

/**
 * HTML for the enquiry email (also stored with the saved enquiry).
 *
 * @param array                 $enquiry  Validated enquiry.
 * @param string                $unit     Business unit.
 * @param array<string, string> $campaign Campaign details.
 * @param array<string, string> $answers  Questionnaire answers.
 * @return string
 */
function acpl_enquiry_email_html( array $enquiry, $unit, array $campaign, array $answers ) {
	ob_start();
	include get_theme_file_path( 'parts/email-enquiry.php' );

	return (string) ob_get_clean();
}
