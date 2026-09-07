<?php
/**
 * Template Name: Testimonials
 *
 * Lists every published Testimonial entry. Assign this template to a page
 * (e.g. /testimonials/) from Page Attributes in the block editor.
 */
get_header();

$testimonials = new WP_Query( array(
	'post_type'      => 'testimonial',
	'posts_per_page' => -1,
	'no_found_rows'  => true,
) );
?>

<div class="page-header">
	<div class="wrap">
		<h1><?php the_title(); ?></h1>
		<?php if ( has_excerpt() ) : ?>
			<p class="lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
		<?php endif; ?>
	</div>
</div>

<section>
	<div class="wrap">
		<?php if ( $testimonials->have_posts() ) : ?>
			<div class="grid-3">
				<?php while ( $testimonials->have_posts() ) : $testimonials->the_post(); ?>
					<div class="testimonial-card">
						<div class="quote"><?php the_content(); ?></div>
						<div class="testimonial-person">
							<div class="avatar"><?php if ( has_post_thumbnail() ) the_post_thumbnail( 'thumbnail' ); ?></div>
							<div>
								<p class="name"><?php the_title(); ?></p>
								<?php $role = get_post_meta( get_the_ID(), '_alluvial_role', true ); ?>
								<?php if ( $role ) : ?><p class="role"><?php echo esc_html( $role ); ?></p><?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p class="lede"><?php esc_html_e( 'Testimonials will appear here once added from Testimonials in the admin menu.', 'alluvial' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<svg class="wave-divider on-paper-to-tint" viewBox="0 0 1440 64" preserveAspectRatio="none" aria-hidden="true"><path d="M0,32 C240,64 480,0 720,32 C960,64 1200,0 1440,32 L1440,64 L0,64 Z"></path></svg>

<section class="on-tint cta-band">
	<div class="wrap">
		<p class="eyebrow"><?php esc_html_e( 'Get started', 'alluvial' ); ?></p>
		<h2><?php esc_html_e( 'See if it&#8217;s a fit for your situation.', 'alluvial' ); ?></h2>
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary" style="margin-top:20px;"><?php esc_html_e( 'Book a consultation', 'alluvial' ); ?></a>
	</div>
</section>

<?php get_footer(); ?>
