<?php
/**
 * The homepage. Hero and stat copy come from the Customizer
 * (Appearance > Customize > Homepage Hero); testimonials pull the three
 * most recent Testimonial entries. Everything else is deliberately
 * hardcoded — this layout doesn't change often, only its copy does.
 */
get_header();
?>

<section class="hero">
	<div class="wrap hero" style="padding:0;">
		<div>
			<p class="eyebrow"><?php echo esc_html( get_theme_mod( 'alluvial_hero_eyebrow', 'Executive coaching for complexity' ) ); ?></p>
			<h1><?php echo esc_html( get_theme_mod( 'alluvial_hero_heading', "The complexity you're facing isn't the obstacle. It's the raw material." ) ); ?></h1>
			<p class="lede"><?php echo esc_html( get_theme_mod( 'alluvial_hero_subheading', '' ) ); ?></p>
			<div class="hero-actions">
				<a href="<?php echo esc_url( get_theme_mod( 'alluvial_hero_cta_url', '/contact/' ) ); ?>" class="btn btn-primary"><?php echo esc_html( get_theme_mod( 'alluvial_hero_cta_label', 'Book a consultation' ) ); ?></a>
				<a href="<?php echo esc_url( home_url( '/philosophy/' ) ); ?>" class="btn btn-outline"><?php esc_html_e( 'Read my philosophy', 'alluvial' ); ?></a>
			</div>
			<?php if ( $note = get_theme_mod( 'alluvial_hero_note', '' ) ) : ?>
				<p class="hero-note"><?php echo esc_html( $note ); ?></p>
			<?php endif; ?>
		</div>
		<div class="hero-media">
			<?php
			$hero_image = get_theme_mod( 'alluvial_hero_image', '' );
			if ( $hero_image ) {
				echo '<img src="' . esc_url( $hero_image ) . '" alt="" />';
			}
			?>
		</div>
	</div>
</section>

<div class="trust-strip">
	<div class="wrap">
		<span class="label"><?php esc_html_e( 'Coached leaders at', 'alluvial' ); ?></span>
		<div class="logo-row">
			<span class="logo-chip">Northgate&nbsp;&amp;&nbsp;Co</span>
			<span class="logo-chip">Merrow Group</span>
			<span class="logo-chip">Falken Partners</span>
			<span class="logo-chip">Ostrand</span>
			<span class="logo-chip">Colbrix</span>
		</div>
	</div>
	<!-- Placeholder wordmarks — swap for real client logos, with permission. -->
</div>

<section>
	<div class="wrap">
		<div class="section-head">
			<p class="eyebrow"><?php esc_html_e( 'What makes this different', 'alluvial' ); ?></p>
			<h2><?php esc_html_e( 'Most coaching asks how to make a team more uniform. I ask what the current already wants to do.', 'alluvial' ); ?></h2>
		</div>
		<div class="grid-3">
			<div class="feature">
				<h3><?php esc_html_e( 'Complexity as the resource', 'alluvial' ); ?></h3>
				<p><?php esc_html_e( 'Multicultural teams, transformations that stall on human resistance, star performers stretching into strategic roles: not problems to smooth away, but the raw material of the work.', 'alluvial' ); ?></p>
			</div>
			<div class="feature">
				<h3><?php esc_html_e( 'Flow, not force', 'alluvial' ); ?></h3>
				<p><?php esc_html_e( "I don't ask how to push a change through resistance. I ask what the natural current is, and how to bring people into it.", 'alluvial' ); ?></p>
			</div>
			<div class="feature">
				<h3><?php esc_html_e( 'Read the full philosophy', 'alluvial' ); ?></h3>
				<p><?php esc_html_e( 'The thinking behind this approach, in more depth, including where it comes from and why it matters now.', 'alluvial' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/philosophy/' ) ); ?>" class="cta" style="display:inline-block; margin-top:4px;"><?php esc_html_e( 'My Philosophy →', 'alluvial' ); ?></a>
			</div>
		</div>
	</div>
</section>

<svg class="wave-divider on-paper-to-tint" viewBox="0 0 1440 64" preserveAspectRatio="none" aria-hidden="true"><path d="M0,32 C240,64 480,0 720,32 C960,64 1200,0 1440,32 L1440,64 L0,64 Z"></path></svg>

<section class="on-tint">
	<div class="wrap">
		<div class="section-head">
			<p class="eyebrow"><?php esc_html_e( 'My Practice', 'alluvial' ); ?></p>
			<h2><?php esc_html_e( "Two ways in, depending on where you're starting from.", 'alluvial' ); ?></h2>
		</div>
		<div class="grid-3">
			<div class="service-card">
				<h3>Sample of One<sup style="font-size:0.55em;">&trade;</sup></h3>
				<p class="desc"><?php esc_html_e( "Where you're not yet sure what the real issue is. Builds self-awareness first, so the differences you're navigating stop reading as blockers, or as personal.", 'alluvial' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/practice/' ) ); ?>" class="cta"><?php esc_html_e( 'See the detail →', 'alluvial' ); ?></a>
			</div>
			<div class="service-card">
				<h3>GROW into Solutions<sup style="font-size:0.55em;">&trade;</sup></h3>
				<p class="desc"><?php esc_html_e( "Where the issue is already clear and you've coached before. We start on it directly and work the goal through to a measurable outcome.", 'alluvial' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/practice/' ) ); ?>" class="cta"><?php esc_html_e( 'See the detail →', 'alluvial' ); ?></a>
			</div>
			<div class="service-card">
				<h3><?php esc_html_e( 'How sessions work', 'alluvial' ); ?></h3>
				<p class="desc"><?php esc_html_e( 'Individual sessions run 60–90 minutes, in person or remote. Team sessions are scoped during contracting. Engagements run in six-month intervals, depending on urgency.', 'alluvial' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/practice/' ) ); ?>" class="cta"><?php esc_html_e( 'Full methodology →', 'alluvial' ); ?></a>
			</div>
		</div>
	</div>
</section>

<svg class="wave-divider on-tint-to-paper" viewBox="0 0 1440 64" preserveAspectRatio="none" aria-hidden="true"><path d="M0,32 C240,0 480,64 720,32 C960,0 1200,64 1440,32 L1440,64 L0,64 Z"></path></svg>

<?php
$testimonials = new WP_Query( array(
	'post_type'      => 'testimonial',
	'posts_per_page' => 3,
	'no_found_rows'  => true,
) );
if ( $testimonials->have_posts() ) :
?>
<section>
	<div class="wrap">
		<div class="section-head center">
			<p class="eyebrow"><?php esc_html_e( 'What clients say', 'alluvial' ); ?></p>
			<h2><?php esc_html_e( 'Results, in their words.', 'alluvial' ); ?></h2>
		</div>
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
		<p class="center" style="margin-top:40px;"><a href="<?php echo esc_url( home_url( '/testimonials/' ) ); ?>" class="btn btn-outline"><?php esc_html_e( 'Read more testimonials', 'alluvial' ); ?></a></p>
	</div>
</section>
<svg class="wave-divider on-paper-to-ink" viewBox="0 0 1440 64" preserveAspectRatio="none" aria-hidden="true"><path d="M0,32 C240,64 480,0 720,32 C960,64 1200,0 1440,32 L1440,64 L0,64 Z"></path></svg>
<?php endif; ?>

<section class="on-ink">
	<div class="wrap">
		<div class="stats">
			<div class="stat"><p class="figure">[X]</p><p class="label"><?php esc_html_e( 'Years in senior operating and coaching roles', 'alluvial' ); ?></p></div>
			<div class="stat"><p class="figure">[X]</p><p class="label"><?php esc_html_e( 'Leaders and teams coached', 'alluvial' ); ?></p></div>
			<div class="stat"><p class="figure">[X]</p><p class="label"><?php esc_html_e( 'Countries worked across', 'alluvial' ); ?></p></div>
			<div class="stat"><p class="figure">[X]%</p><p class="label"><?php esc_html_e( 'Clients who renew or refer', 'alluvial' ); ?></p></div>
		</div>
		<!-- Placeholder figures — replace with real, sourced numbers before publishing. -->
	</div>
</section>

<svg class="wave-divider on-ink-to-paper" viewBox="0 0 1440 64" preserveAspectRatio="none" aria-hidden="true"><path d="M0,32 C240,0 480,64 720,32 C960,0 1200,64 1440,32 L1440,64 L0,64 Z"></path></svg>

<section class="cta-band">
	<div class="wrap">
		<p class="eyebrow"><?php esc_html_e( 'Get started', 'alluvial' ); ?></p>
		<h2><?php esc_html_e( "Let's work out if this is the right fit.", 'alluvial' ); ?></h2>
		<p class="lede center" style="margin:0 auto 32px;"><?php esc_html_e( "A short call, no obligation. If it's not a fit for either of us, I'll say so.", 'alluvial' ); ?></p>
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Book a consultation', 'alluvial' ); ?></a>
	</div>
</section>

<?php get_footer(); ?>
