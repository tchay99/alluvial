<?php
/**
 * Custom post type: Testimonial.
 *
 * Editable from the WP admin like an ordinary post, and looped over by
 * templates/template-testimonials.php and the front page teaser.
 *
 * There's no Service/Programme post type: My Practice describes two fixed,
 * trademarked programmes (Sample of One™, GROW into Solutions™) plus prose
 * methodology, not a repeating list, so that content lives in the Practice
 * page itself rather than in a custom post type.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function alluvial_register_post_types() {

	register_post_type( 'testimonial', array(
		'labels' => array(
			'name'               => __( 'Testimonials', 'alluvial' ),
			'singular_name'      => __( 'Testimonial', 'alluvial' ),
			'add_new_item'       => __( 'Add New Testimonial', 'alluvial' ),
			'edit_item'          => __( 'Edit Testimonial', 'alluvial' ),
			'all_items'          => __( 'Testimonials', 'alluvial' ),
		),
		'public'        => true,
		'has_archive'   => false,
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-format-quote',
		// Title = client name. Editor = the quote itself.
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'rewrite'       => array( 'slug' => 'testimonials' ),
	) );
}
add_action( 'init', 'alluvial_register_post_types' );

/**
 * Meta box for a testimonial's role/company line, e.g. "Chief Executive, Northgate & Co".
 */
function alluvial_testimonial_meta_box() {
	add_meta_box(
		'alluvial_testimonial_role',
		__( 'Role & Company', 'alluvial' ),
		'alluvial_testimonial_role_html',
		'testimonial',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'alluvial_testimonial_meta_box' );

function alluvial_testimonial_role_html( $post ) {
	wp_nonce_field( 'alluvial_save_testimonial_role', 'alluvial_testimonial_role_nonce' );
	$value = get_post_meta( $post->ID, '_alluvial_role', true );
	echo '<label for="alluvial_role" class="screen-reader-text">' . esc_html__( 'Role and company', 'alluvial' ) . '</label>';
	echo '<input type="text" id="alluvial_role" name="alluvial_role" value="' . esc_attr( $value ) . '" style="width:100%;" placeholder="Chief Executive, Company name" />';
}

function alluvial_save_testimonial_role( $post_id ) {
	if ( ! isset( $_POST['alluvial_testimonial_role_nonce'] ) ||
		! wp_verify_nonce( $_POST['alluvial_testimonial_role_nonce'], 'alluvial_save_testimonial_role' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['alluvial_role'] ) ) {
		update_post_meta( $post_id, '_alluvial_role', sanitize_text_field( wp_unslash( $_POST['alluvial_role'] ) ) );
	}
}
add_action( 'save_post_testimonial', 'alluvial_save_testimonial_role' );
