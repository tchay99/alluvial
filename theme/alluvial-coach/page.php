<?php
/**
 * Default template for static pages (My Profile, My Philosophy, and any
 * other plain content page). Title + excerpt as a page-header banner,
 * optional featured image, then the block-editor content.
 *
 * Practice, Testimonials and Contact use their own templates in /templates.
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<div class="page-header">
		<div class="wrap">
			<h1><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p class="lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="wrap">
			<div class="hero-media" style="aspect-ratio:21/9; max-width:960px; margin:0 auto 8px;">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
		</div>
	<?php endif; ?>

	<section>
		<div class="wrap entry-content">
			<?php the_content(); ?>
		</div>
	</section>

<?php endwhile; ?>

<?php get_footer(); ?>
