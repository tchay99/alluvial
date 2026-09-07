<?php
/**
 * The footer.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer class="site-footer">
	<div class="wrap">
		<div class="footer-grid">
			<div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" style="color:#fff;">ALLUVI<span>A</span>L</a>
				<p style="margin-top:16px; color:#93a0bd; font-size:0.9rem; max-width:32ch;"><?php bloginfo( 'description' ); ?></p>
			</div>
			<div>
				<h4><?php esc_html_e( 'Site', 'alluvial' ); ?></h4>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => '',
					'fallback_cb'    => false,
					'depth'          => 1,
				) );
				?>
			</div>
			<div>
				<h4><?php esc_html_e( 'Contact', 'alluvial' ); ?></h4>
				<ul>
					<li><a href="mailto:welcome@alluvial.coach">welcome@alluvial.coach</a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Alluvial', 'alluvial' ); ?></a></li>
				</ul>
			</div>
			<div>
				<h4><?php esc_html_e( 'Follow', 'alluvial' ); ?></h4>
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php else : ?>
					<ul><li><a href="#">LinkedIn</a></li></ul>
				<?php endif; ?>
			</div>
		</div>
		<div class="footer-bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'alluvial' ); ?></span>
			<span><?php esc_html_e( 'Privacy policy', 'alluvial' ); ?></span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
