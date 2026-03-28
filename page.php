<?php
/**
 * Default Page Template
 *
 * @package Avideas
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
	<div class="container page-hero__content">
		<span class="page-hero__eyebrow"><?php esc_html_e( 'Avideas Event Styling', 'avideas' ); ?></span>
		<h1 class="page-hero__title"><?php the_title(); ?></h1>
		<nav class="page-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'avideas' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'avideas' ); ?></a>
			<span aria-hidden="true"> / </span>
			<span><?php the_title(); ?></span>
		</nav>
	</div>
</div>

<!-- Page Content -->
<section class="section section--cream">
	<div class="container--sm">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<div class="post-content">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	</div>
</section>

<?php get_footer(); ?>
