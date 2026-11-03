<?php
/**
 * "Leadership" team members: a post type with a profile page each.
 *
 * Title = name, featured image = photo, excerpt = short bio, content = the
 * full profile (milestones). Role, introduction, focus tags and expertise
 * are edited in the "Profile details" box.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'init',
	static function () {
		register_post_type(
			'acpl_team',
			array(
				'labels'        => array(
					'name'               => __( 'Leadership', 'angelus' ),
					'singular_name'      => __( 'Team member', 'angelus' ),
					'add_new_item'       => __( 'Add team member', 'angelus' ),
					'edit_item'          => __( 'Edit team member', 'angelus' ),
					'new_item'           => __( 'New team member', 'angelus' ),
					'view_item'          => __( 'View profile', 'angelus' ),
					'all_items'          => __( 'All team members', 'angelus' ),
					'featured_image'     => __( 'Photo', 'angelus' ),
					'set_featured_image' => __( 'Set photo', 'angelus' ),
				),
				'public'        => true,
				'has_archive'   => 'leadership',
				'rewrite'       => array(
					'slug'       => 'leadership',
					'with_front' => false,
				),
				'menu_icon'     => 'dashicons-groups',
				'menu_position' => 5,
				'show_in_rest'  => true,
				'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			)
		);
	}
);

/**
 * Profile fields: meta key => label, type and help text.
 *
 * @return array<string, array{label: string, type: string, help?: string}>
 */
function acpl_team_fields() {
	return array(
		'acpl_role'      => array(
			'label' => __( 'Role / title', 'angelus' ),
			'type'  => 'text',
		),
		'acpl_intro'     => array(
			'label' => __( 'Profile introduction', 'angelus' ),
			'type'  => 'textarea',
			'help'  => __( 'Shown at the top of the profile page. The short bio on the team page comes from the Excerpt.', 'angelus' ),
		),
		'acpl_focus'     => array(
			'label' => __( 'Focus tags', 'angelus' ),
			'type'  => 'text',
			'help'  => __( 'Comma separated, e.g. Private Equity, Capital Raising.', 'angelus' ),
		),
		'acpl_expertise' => array(
			'label' => __( 'Key areas of expertise', 'angelus' ),
			'type'  => 'textarea',
			'help'  => __( 'One per line.', 'angelus' ),
		),
	);
}

add_action(
	'add_meta_boxes_acpl_team',
	static function () {
		add_meta_box(
			'acpl-team-details',
			__( 'Profile details', 'angelus' ),
			static function ( $post ) {
				wp_nonce_field( 'acpl_team_details', 'acpl_team_nonce' );
				echo '<p>' . esc_html__( 'Order on the page is set by "Order" under Page Attributes (lowest first).', 'angelus' ) . '</p>';
				foreach ( acpl_team_fields() as $key => $field ) {
					$value = get_post_meta( $post->ID, $key, true );
					echo '<p><label for="' . esc_attr( $key ) . '"><strong>' . esc_html( $field['label'] ) . '</strong></label><br>';
					if ( 'textarea' === $field['type'] ) {
						echo '<textarea class="widefat" rows="5" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '">' . esc_textarea( $value ) . '</textarea>';
					} else {
						echo '<input class="widefat" type="text" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '">';
					}
					if ( ! empty( $field['help'] ) ) {
						echo '<br><span class="description">' . esc_html( $field['help'] ) . '</span>';
					}
					echo '</p>';
				}
			},
			'acpl_team',
			'normal',
			'high'
		);
	}
);

add_action(
	'save_post_acpl_team',
	static function ( $post_id ) {
		if ( ! isset( $_POST['acpl_team_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['acpl_team_nonce'] ) ), 'acpl_team_details' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		foreach ( acpl_team_fields() as $key => $field ) {
			if ( isset( $_POST[ $key ] ) ) {
				$value = wp_unslash( $_POST[ $key ] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitized below.
				update_post_meta( $post_id, $key, 'textarea' === $field['type'] ? sanitize_textarea_field( $value ) : sanitize_text_field( $value ) );
			}
		}
	}
);

// Show the role in the admin list.
add_filter(
	'manage_acpl_team_posts_columns',
	static function ( $columns ) {
		return array_slice( $columns, 0, 2, true ) + array( 'acpl_role' => __( 'Role', 'angelus' ) ) + array_slice( $columns, 2, null, true );
	}
);

add_action(
	'manage_acpl_team_posts_custom_column',
	static function ( $column, $post_id ) {
		if ( 'acpl_role' === $column ) {
			echo esc_html( get_post_meta( $post_id, 'acpl_role', true ) );
		}
	},
	10,
	2
);

// The leadership page lists everyone on one page, in their set order.
add_action(
	'pre_get_posts',
	static function ( $query ) {
		if ( ! is_admin() && $query->is_main_query() && $query->is_post_type_archive( 'acpl_team' ) ) {
			$query->set( 'posts_per_page', -1 );
			$query->set( 'orderby', array( 'menu_order' => 'ASC', 'date' => 'ASC' ) );
		}
	}
);
