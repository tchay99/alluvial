<?php
/**
 * Template Name: Contact
 *
 * A minimal Name / Email / Message form, matching the real site's current
 * fields, posted to inc/contact-handler.php. Assign to a page from Page
 * Attributes (e.g. /contact/).
 */
get_header();
?>

<div class="page-header">
	<div class="wrap">
		<p class="eyebrow"><?php esc_html_e( 'Contact Alluvial', 'alluvial' ); ?></p>
		<h1><?php esc_html_e( 'We can be reached at welcome@alluvial.coach.', 'alluvial' ); ?></h1>
		<p class="lede"><?php esc_html_e( 'Or use the form below.', 'alluvial' ); ?></p>
	</div>
</div>

<section>
	<div class="wrap" style="max-width:640px;">
		<?php if ( isset( $_GET['sent'] ) ) : ?>
			<?php if ( '1' === $_GET['sent'] ) : ?>
				<div class="form-notice success"><?php esc_html_e( 'Thanks — your message has been sent. I&#8217;ll reply as soon as I can.', 'alluvial' ); ?></div>
			<?php else : ?>
				<div class="form-notice error"><?php esc_html_e( 'Something went wrong sending that. Please try again, or email welcome@alluvial.coach directly.', 'alluvial' ); ?></div>
			<?php endif; ?>
		<?php endif; ?>

		<form method="post" action="<?php echo esc_url( get_permalink() ); ?>">
			<?php wp_nonce_field( 'alluvial_contact', 'alluvial_contact_nonce' ); ?>
			<input type="text" name="alluvial_hp" class="hp-field" tabindex="-1" autocomplete="off" aria-hidden="true" />

			<div class="field">
				<label for="name"><?php esc_html_e( 'Name', 'alluvial' ); ?> <span style="font-weight:400; color:var(--ink-tint);">(<?php esc_html_e( 'required', 'alluvial' ); ?>)</span></label>
				<input id="name" name="name" type="text" required />
			</div>
			<div class="field">
				<label for="email"><?php esc_html_e( 'Email', 'alluvial' ); ?> <span style="font-weight:400; color:var(--ink-tint);">(<?php esc_html_e( 'required', 'alluvial' ); ?>)</span></label>
				<input id="email" name="email" type="email" required />
			</div>
			<div class="field">
				<label for="message"><?php esc_html_e( 'Message', 'alluvial' ); ?></label>
				<textarea id="message" name="message" rows="6"></textarea>
			</div>
			<button type="submit" name="alluvial_contact_submit" value="1" class="btn btn-primary"><?php esc_html_e( 'Contact us', 'alluvial' ); ?></button>
		</form>
	</div>
</section>

<?php get_footer(); ?>
