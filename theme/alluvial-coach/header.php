<?php
/**
 * The header: opening markup through the primary nav.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="wrap">
		<?php if ( has_custom_logo() ) : ?>
			<div class="site-logo"><?php the_custom_logo(); ?></div>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">ALLUVI<span>A</span>L</a>
		<?php endif; ?>

		<nav class="main-nav" aria-label="<?php esc_attr_e( 'Primary', 'alluvial' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => '',
				'fallback_cb'    => false,
				'depth'          => 2,
			) );
			?>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Book a consultation', 'alluvial' ); ?></a>
			<button class="nav-toggle" aria-label="<?php esc_attr_e( 'Menu', 'alluvial' ); ?>">&#9776;</button>
		</nav>
	</div>
</header>
