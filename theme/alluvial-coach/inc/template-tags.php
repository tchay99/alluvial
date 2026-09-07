<?php
/**
 * Small template helpers shared across index.php and single.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Estimated reading time for the current post, e.g. "6 min read".
 */
function alluvial_reading_time() {
	$content    = get_post_field( 'post_content', get_the_ID() );
	$word_count = str_word_count( wp_strip_all_tags( $content ) );
	$minutes    = max( 1, (int) round( $word_count / 200 ) );

	return sprintf(
		/* translators: %d: number of minutes */
		_n( '%d min read', '%d min read', $minutes, 'alluvial' ),
		$minutes
	);
}

/**
 * Prints a post's featured image, or one of three bundled placeholder
 * tiles (cycled by post ID) when no featured image has been set yet —
 * so a fresh Insights index doesn't show empty boxes before real cover
 * images are uploaded.
 */
function alluvial_post_thumbnail( $post_id, $size = 'medium_large' ) {
	if ( has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail( $post_id, $size );
		return;
	}
	$letter = array( 'a', 'b', 'c' )[ $post_id % 3 ];
	$src    = get_template_directory_uri() . '/assets/img/thumb-' . $letter . '.svg';
	echo '<img src="' . esc_url( $src ) . '" alt="" />';
}
