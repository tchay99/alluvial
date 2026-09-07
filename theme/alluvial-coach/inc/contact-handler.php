<?php
/**
 * Handles POSTs from templates/template-contact.php.
 *
 * A minimal, dependency-free contact form: sanitised input, a nonce, and a
 * honeypot field against basic bots. Good enough to ship with, but deliverability
 * depends on the host actually being able to send mail — see the build guide's
 * note on SMTP. For anything beyond a simple message (file uploads, more
 * robust anti-spam, conditional routing) use a plugin like Fluent Forms
 * instead and skip this file.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function alluvial_handle_contact_form() {
	if ( empty( $_POST['alluvial_contact_submit'] ) ) {
		return;
	}

	if ( ! isset( $_POST['alluvial_contact_nonce'] ) ||
		! wp_verify_nonce( $_POST['alluvial_contact_nonce'], 'alluvial_contact' ) ) {
		wp_safe_redirect( add_query_arg( 'sent', 'error', wp_get_referer() ?: home_url( '/' ) ) );
		exit;
	}

	// Honeypot: real visitors never fill this hidden field in.
	if ( ! empty( $_POST['alluvial_hp'] ) ) {
		wp_safe_redirect( add_query_arg( 'sent', '1', wp_get_referer() ?: home_url( '/' ) ) );
		exit;
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( ! $name || ! $email || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'sent', 'error', wp_get_referer() ?: home_url( '/' ) ) );
		exit;
	}

	$to      = get_option( 'admin_email' );
	$subject = sprintf( '[%s] New enquiry from %s', get_bloginfo( 'name' ), $name );
	$body    = "Name: {$name}\nEmail: {$email}\n\nMessage:\n{$message}";
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'sent', $sent ? '1' : 'error', wp_get_referer() ?: home_url( '/' ) ) );
	exit;
}
add_action( 'template_redirect', 'alluvial_handle_contact_form' );
