<?php
/**
 * 404 Template
 *
 * @package Luminar Touch Events
 */

get_header();
?>

<section class="error-404">
	<div class="text-center">
		<div class="error-404__num" aria-hidden="true">404</div>
		<h1><?php esc_html_e( 'Page Not Found', 'luminar' ); ?></h1>
		<p style="color:var(--clr-muted); max-width:480px; margin:1rem auto 2rem;">
			<?php esc_html_e( "The page you're looking for has moved or doesn't exist. Let us help you find what you need.", 'luminar' ); ?>
		</p>
		<div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
				<?php esc_html_e( 'Back to Home', 'luminar' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'Our Services', 'luminar' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'Contact Us', 'luminar' ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
