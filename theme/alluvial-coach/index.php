<?php
/**
 * Blog index ("Insights"). Also the fallback template for any query WordPress
 * can't otherwise match.
 */
get_header();
?>

<div class="page-header">
	<div class="wrap">
		<p class="eyebrow"><?php esc_html_e( 'Insights', 'alluvial' ); ?></p>
		<h1><?php esc_html_e( 'Notes on complexity, culture and change.', 'alluvial' ); ?></h1>
		<p class="lede"><?php esc_html_e( 'Short, practical pieces drawn from the coaching work.', 'alluvial' ); ?></p>
	</div>
</div>

<section>
	<div class="wrap">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<a href="<?php the_permalink(); ?>" class="post-card">
						<div class="thumb"><?php alluvial_post_thumbnail( get_the_ID() ); ?></div>
						<div class="body">
							<?php $cats = get_the_category(); ?>
							<?php if ( ! empty( $cats ) ) : ?>
								<p class="tag"><?php echo esc_html( $cats[0]->name ); ?></p>
							<?php endif; ?>
							<h3><?php the_title(); ?></h3>
							<p class="meta"><?php echo esc_html( get_the_date() ); ?> &middot; <?php echo esc_html( alluvial_reading_time() ); ?></p>
						</div>
					</a>
				<?php endwhile; ?>
			</div>

			<div class="pagination">
				<?php
				echo paginate_links( array(
					'prev_text' => __( '&larr; Newer', 'alluvial' ),
					'next_text' => __( 'Older &rarr;', 'alluvial' ),
				) );
				?>
			</div>
		<?php else : ?>
			<p class="lede"><?php esc_html_e( 'Nothing published yet.', 'alluvial' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
