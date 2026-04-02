<?php
/**
 * Archive Template — Categories, Tags, CPT archives
 *
 * @package Luminar Touch Events
 */

get_header();
?>

<div class="page-hero">
	<div class="container page-hero__content">
		<span class="page-hero__eyebrow"><?php esc_html_e( 'Luminar Touch Events', 'luminar' ); ?></span>
		<h1 class="page-hero__title"><?php the_archive_title(); ?></h1>
		<?php if ( get_the_archive_description() ) : ?>
		<p style="color:rgba(255,255,255,0.75); max-width:560px; margin:1rem auto 0; font-size:1rem;">
			<?php the_archive_description(); ?>
		</p>
		<?php endif; ?>
	</div>
</div>

<section class="section section--cream">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="archive-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/post-card' );
				endwhile;
				?>
			</div>
			<div class="pagination">
				<?php the_posts_pagination( [ 'mid_size' => 2, 'prev_text' => '&larr;', 'next_text' => '&rarr;' ] ); ?>
			</div>
		<?php else : ?>
			<p class="text-center"><?php esc_html_e( 'No posts found.', 'luminar' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
