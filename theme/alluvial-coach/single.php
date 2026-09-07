<?php
/**
 * Single blog post ("Insights" article).
 */
get_header();

while ( have_posts() ) :
	the_post();
	$cats = get_the_category();
	?>

	<section class="tight">
		<div class="wrap article-head">
			<p class="eyebrow">
				<?php if ( ! empty( $cats ) ) : ?><?php echo esc_html( $cats[0]->name ); ?> &middot; <?php endif; ?>
				<?php echo esc_html( get_the_date() ); ?> &middot; <?php echo esc_html( alluvial_reading_time() ); ?>
			</p>
			<h1><?php the_title(); ?></h1>
		</div>
	</section>

	<div class="wrap">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="hero-media" style="aspect-ratio:21/9; max-width:900px; margin:0 auto 48px;">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
		<?php endif; ?>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<div class="author-box">
			<div class="avatar" style="width:56px; height:56px;">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 56 ); ?>
			</div>
			<div>
				<p style="font-weight:600; margin:0;"><?php the_author(); ?></p>
				<p style="color:var(--ink-tint); margin:0; font-size:0.9rem;"><?php esc_html_e( 'Executive coach, Alluvial', 'alluvial' ); ?></p>
			</div>
		</div>
	</div>

	<?php
	$related = new WP_Query( array(
		'posts_per_page' => 3,
		'post__not_in'   => array( get_the_ID() ),
		'category__in'   => wp_list_pluck( $cats, 'term_id' ),
		'no_found_rows'  => true,
	) );
	if ( $related->have_posts() ) :
	?>
	<section class="on-tint">
		<div class="wrap">
			<div class="section-head">
				<p class="eyebrow"><?php esc_html_e( 'More from Insights', 'alluvial' ); ?></p>
				<h2><?php esc_html_e( 'Related reading', 'alluvial' ); ?></h2>
			</div>
			<div class="post-grid">
				<?php while ( $related->have_posts() ) : $related->the_post(); ?>
					<a href="<?php the_permalink(); ?>" class="post-card">
						<div class="thumb"><?php if ( has_post_thumbnail() ) the_post_thumbnail( 'medium_large' ); ?></div>
						<div class="body">
							<h3><?php the_title(); ?></h3>
							<p class="meta"><?php echo esc_html( get_the_date() ); ?></p>
						</div>
					</a>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
