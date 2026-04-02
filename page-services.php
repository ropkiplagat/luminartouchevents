<?php
/**
 * Template Name: Services Page
 *
 * @package Luminar Touch Events
 */

get_header();

$services = luminar_get_services();
?>

<div class="page-hero">
	<div class="container page-hero__content">
		<span class="page-hero__eyebrow"><?php esc_html_e( 'What We Offer', 'luminar' ); ?></span>
		<h1 class="page-hero__title"><?php esc_html_e( 'Our Event Styling Services', 'luminar' ); ?></h1>
		<nav class="page-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'luminar' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luminar' ); ?></a>
			<span aria-hidden="true"> / </span>
			<span><?php esc_html_e( 'Services', 'luminar' ); ?></span>
		</nav>
	</div>
</div>

<section class="section section--cream">
	<div class="container">

		<div class="section-header reveal">
			<span class="section-header__eyebrow"><?php esc_html_e( 'Brisbane Event Styling', 'luminar' ); ?></span>
			<h2 class="section-header__title"><?php esc_html_e( 'Every Celebration, Perfectly Styled', 'luminar' ); ?></h2>
			<p class="section-header__desc">
				<?php esc_html_e( "We style life's most meaningful moments across Brisbane and South East Queensland. Each service is fully bespoke — designed around you.", 'luminar' ); ?>
			</p>
		</div>

		<!-- Service Cards Detail Layout -->
		<?php foreach ( $services as $i => $service ) :
			$is_even = ( $i % 2 !== 0 );
		?>
		<div class="service-detail-row reveal" style="display:grid; grid-template-columns:1fr 1fr; gap:var(--sp-xl); align-items:center; margin-bottom:var(--sp-xl); <?php echo $is_even ? 'direction:rtl;' : ''; ?>">

			<div style="<?php echo $is_even ? 'direction:ltr;' : ''; ?>">
				<img
					src="<?php echo esc_url( luminar_placeholder_img( 800, 600, $service['title'] ) ); ?>"
					alt="<?php echo esc_attr( $service['title'] . ' Brisbane' ); ?>"
					style="width:100%; border-radius:var(--radius-lg); box-shadow:var(--shadow-lg);"
					loading="lazy"
					width="800"
					height="600"
				>
			</div>

			<div style="<?php echo $is_even ? 'direction:ltr;' : ''; ?>">
				<div style="font-size:2.5rem; margin-bottom:1rem;" aria-hidden="true"><?php echo $service['icon']; ?></div>
				<span class="section-header__eyebrow" style="display:block; margin-bottom:0.5rem;"><?php esc_html_e( 'Event Styling', 'luminar' ); ?></span>
				<h2 style="font-size:2rem; margin-bottom:1rem;"><?php echo esc_html( $service['title'] ); ?></h2>
				<div class="divider" style="justify-content:flex-start; margin-bottom:1.5rem;">
					<div class="divider__line"></div>
					<span class="divider__icon">&#x2665;</span>
				</div>
				<p style="color:var(--clr-muted); line-height:1.8; margin-bottom:1.5rem;">
					<?php echo esc_html( $service['desc'] ); ?>
					<?php esc_html_e( ' Our team handles everything from concept to pack-down, so you can be fully present and enjoy every moment of your special day.', 'luminar' ); ?>
				</p>
				<ul style="list-style:none; padding:0; margin-bottom:1.5rem;">
					<?php
					$includes = [
						esc_html__( 'Custom concept & mood board', 'luminar' ),
						esc_html__( 'Full setup and pack-down service', 'luminar' ),
						esc_html__( 'Floral arrangements & styling elements', 'luminar' ),
						esc_html__( 'Balloon installations where applicable', 'luminar' ),
						esc_html__( 'Personalised styling details', 'luminar' ),
					];
					foreach ( $includes as $inc ) :
					?>
					<li style="display:flex; align-items:center; gap:0.75rem; padding:0.5rem 0; border-bottom:1px solid var(--clr-border); font-size:0.9rem;">
						<span style="color:var(--clr-rose); flex-shrink:0;">&#x2665;</span>
						<?php echo $inc; ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<a href="<?php echo esc_url( home_url( '/contact/?service=' . urlencode( $service['slug'] ) ) ); ?>" class="btn btn--primary">
					<?php esc_html_e( 'Enquire Now', 'luminar' ); ?>
				</a>
			</div>

		</div>
		<?php endforeach; ?>

	</div>
</section>

<!-- CTA Section -->
<section class="section section--dark">
	<div class="container text-center">
		<span class="section-header__eyebrow" style="display:block; margin-bottom:0.75rem;"><?php esc_html_e( 'Ready to Book?', 'luminar' ); ?></span>
		<h2 style="color:var(--clr-white); margin-bottom:1.5rem;"><?php esc_html_e( "Let's Create Your Dream Event", 'luminar' ); ?></h2>
		<p style="color:rgba(255,255,255,0.7); max-width:500px; margin:0 auto 2rem;">
			<?php esc_html_e( 'Get in touch today for a free consultation and personalised quote. We respond within 24 hours.', 'luminar' ); ?>
		</p>
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary btn--lg">
			<?php esc_html_e( 'Get a Free Quote', 'luminar' ); ?>
		</a>
	</div>
</section>

<?php get_footer(); ?>
