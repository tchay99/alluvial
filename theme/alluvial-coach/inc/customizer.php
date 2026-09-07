<?php
/**
 * Customizer settings for the handful of homepage strings that aren't
 * tied to a post type: hero headline, subhead, note, and the hero image.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function alluvial_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'alluvial_homepage', array(
		'title'    => __( 'Homepage Hero', 'alluvial' ),
		'priority' => 30,
	) );

	$fields = array(
		'alluvial_hero_eyebrow' => array(
			'default' => 'Executive & leadership coaching',
			'label'   => 'Eyebrow',
			'type'    => 'text',
		),
		'alluvial_hero_heading' => array(
			'default' => 'Coaching for leaders who carry real weight.',
			'label'   => 'Headline',
			'type'    => 'textarea',
		),
		'alluvial_hero_subheading' => array(
			'default' => "Alluvial works with senior executives and leadership teams inside established companies. One-to-one and team engagements, built around your business's actual pressure points.",
			'label'   => 'Subheading',
			'type'    => 'textarea',
		),
		'alluvial_hero_note' => array(
			'default' => 'Currently taking on a limited number of new clients.',
			'label'   => 'Note under the buttons',
			'type'    => 'text',
		),
		'alluvial_hero_cta_label' => array(
			'default' => 'Book a consultation',
			'label'   => 'Primary button label',
			'type'    => 'text',
		),
		'alluvial_hero_cta_url' => array(
			'default' => '/contact/',
			'label'   => 'Primary button URL',
			'type'    => 'text',
		),
	);

	foreach ( $fields as $id => $field ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $field['default'],
			'sanitize_callback' => 'textarea' === $field['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $field['label'],
			'section' => 'alluvial_homepage',
			'type'    => $field['type'],
		) );
	}

	$wp_customize->add_setting( 'alluvial_hero_image', array( 'default' => '' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'alluvial_hero_image', array(
		'label'   => __( 'Hero portrait', 'alluvial' ),
		'section' => 'alluvial_homepage',
	) ) );
}
add_action( 'customize_register', 'alluvial_customize_register' );
