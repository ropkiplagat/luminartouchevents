<?php
/**
 * Template Name: About Page
 *
 * @package Luminar Touch Events
 */

get_header();
?>

<div class="page-hero">
	<div class="container page-hero__content">
		<span class="page-hero__eyebrow"><?php esc_html_e( 'Our Story', 'luminar' ); ?></span>
		<h1 class="page-hero__title"><?php esc_html_e( 'The Luminar Touch Events Story', 'luminar' ); ?></h1>
		<nav class="page-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'luminar' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luminar' ); ?></a>
			<span aria-hidden="true"> / </span>
			<span><?php esc_html_e( 'About', 'luminar' ); ?></span>
		</nav>
	</div>
</div>

<!-- Story Section -->
<section class="section section--cream">
	<div class="container">
		<div class="grid-2" style="align-items:center; gap:var(--sp-xl);">
			<div class="reveal">
				<img
					src="<?php echo esc_url( luminar_placeholder_img( 800, 1000, 'Event Stylist Brisbane' ) ); ?>"
					alt="<?php esc_attr_e( 'Luminar Touch Events team — Brisbane event stylists', 'luminar' ); ?>"
					style="width:100%; border-radius:var(--radius-lg); box-shadow:var(--shadow-lg);"
					loading="eager"
					width="800"
					height="1000"
				>
			</div>
			<div class="reveal">
				<span class="section-header__eyebrow" style="display:block; margin-bottom:0.75rem;"><?php esc_html_e( 'Who We Are', 'luminar' ); ?></span>
				<h2><?php esc_html_e( "Brisbane's Trusted Event Styling Studio", 'luminar' ); ?></h2>
				<div class="divider" style="justify-content:flex-start;"><div class="divider__line"></div><span class="divider__icon">&#x2665;</span></div>
				<p style="color:var(--clr-muted); line-height:1.9; margin-bottom:1rem;">
					<?php esc_html_e( "Luminar Touch Events was founded with one simple belief: every celebration deserves to be extraordinary. Based in Brisbane and serving clients across South East Queensland, we are passionate event stylists who transform spaces into unforgettable experiences.", 'luminar' ); ?>
				</p>
				<p style="color:var(--clr-muted); line-height:1.9; margin-bottom:1rem;">
					<?php esc_html_e( "We specialise in baby showers, bridal showers, gender reveals, graduation parties, citizenship ceremonies, weddings, and intimate dinner parties. Each event is treated with the same level of care, creativity, and passion — whether it's an intimate gathering of ten or a grand celebration of two hundred.", 'luminar' ); ?>
				</p>
				<p style="color:var(--clr-muted); line-height:1.9;">
					<?php esc_html_e( "Our styling philosophy centres on creating moments that feel personal and timeless. We work collaboratively with each client, listening closely to their vision and infusing our own creativity to deliver something truly spectacular.", 'luminar' ); ?>
				</p>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary mt-md">
					<?php esc_html_e( 'Work With Us', 'luminar' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>

<!-- Values -->
<section class="section section--blush">
	<div class="container">
		<div class="section-header reveal">
			<span class="section-header__eyebrow"><?php esc_html_e( 'Our Values', 'luminar' ); ?></span>
			<h2 class="section-header__title"><?php esc_html_e( 'What We Stand For', 'luminar' ); ?></h2>
		</div>
		<div class="grid-3 reveal-stagger" style="margin-top:var(--sp-lg);">
			<?php
			$values = [
				[ '&#x2728;', 'Creativity',     "Every event is a blank canvas. We bring bold, original ideas that reflect your personality and make your event truly one-of-a-kind." ],
				[ '&#x1F90D;', 'Care',           "We treat every event as if it were our own. The smallest details matter to us because we know they matter to you." ],
				[ '&#x1F4CD;', 'Craftsmanship',  "From florals to furniture placement, we execute with precision and pride. Quality is never an afterthought." ],
			];
			foreach ( $values as $v ) :
			?>
			<div style="text-align:center; padding:var(--sp-md); background:var(--clr-white); border-radius:var(--radius-lg); box-shadow:var(--shadow-sm);">
				<div style="font-size:2.5rem; margin-bottom:1rem;" aria-hidden="true"><?php echo $v[0]; ?></div>
				<h3 style="margin-bottom:0.75rem;"><?php echo esc_html( $v[1] ); ?></h3>
				<p style="font-size:0.9rem; color:var(--clr-muted); line-height:1.7;"><?php echo esc_html( $v[2] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Stats -->
<section class="section section--dark">
	<div class="container">
		<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:var(--sp-md); text-align:center;" class="reveal-stagger">
			<?php
			$stats = [
				[ '500+', 'Events Styled' ],
				[ '8+',   'Years in Brisbane' ],
				[ '100%', '5-Star Reviews' ],
				[ '7',    'Event Types' ],
			];
			foreach ( $stats as $stat ) :
			?>
			<div>
				<div style="font-family:var(--font-display); font-size:3rem; font-weight:700; color:var(--clr-rose); line-height:1;"><?php echo esc_html( $stat[0] ); ?></div>
				<div style="font-size:0.8rem; letter-spacing:0.12em; text-transform:uppercase; color:rgba(255,255,255,0.6); margin-top:0.5rem; font-weight:700;"><?php echo esc_html( $stat[1] ); ?></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
