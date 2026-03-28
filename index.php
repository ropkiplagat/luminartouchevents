<?php
/**
 * Main Index Template — Fallback for all unmatched templates.
 * Also serves as the Blog page when no posts page is set.
 *
 * @package Avideas
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
	<div class="container page-hero__content">
		<span class="page-hero__eyebrow"><?php esc_html_e( 'Avideas Event Styling', 'avideas' ); ?></span>
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<h1 class="page-hero__title"><?php esc_html_e( 'Blog & Inspiration', 'avideas' ); ?></h1>
		<?php elseif ( is_search() ) : ?>
			<h1 class="page-hero__title">
				<?php
				/* translators: %s: search query */
				printf( esc_html__( 'Search Results: %s', 'avideas' ), '<em>' . get_search_query() . '</em>' );
				?>
			</h1>
		<?php elseif ( is_archive() ) : ?>
			<h1 class="page-hero__title"><?php the_archive_title(); ?></h1>
		<?php else : ?>
			<h1 class="page-hero__title"><?php esc_html_e( 'Latest Posts', 'avideas' ); ?></h1>
		<?php endif; ?>
	</div>
</div>

<section class="section section--cream">
	<div class="container">
		<div style="display:grid; grid-template-columns: 1fr 300px; gap: var(--sp-lg); align-items:start;">

			<!-- Posts -->
			<div>
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
						<?php
						the_posts_pagination( [
							'mid_size'  => 2,
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
						] );
						?>
					</div>
				<?php else : ?>
					<div class="text-center" style="padding: var(--sp-xl) 0;">
						<h2><?php esc_html_e( 'Nothing Found', 'avideas' ); ?></h2>
						<p><?php esc_html_e( 'Try a different search or browse our services.', 'avideas' ); ?></p>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary mt-md">
							<?php esc_html_e( 'Back Home', 'avideas' ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>

			<!-- Sidebar -->
			<aside class="sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Blog sidebar', 'avideas' ); ?>">
				<?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-blog' ); ?>
				<?php else : ?>
					<!-- Default sidebar content -->
					<div class="widget" style="background:var(--clr-blush); padding:var(--sp-md); border-radius:var(--radius-lg);">
						<h3 class="widget-title" style="font-size:1rem; margin-bottom:1rem;"><?php esc_html_e( 'Book Your Event', 'avideas' ); ?></h3>
						<p style="font-size:0.88rem; color:var(--clr-muted); margin-bottom:1rem;">
							<?php esc_html_e( 'Ready to start planning? Get in touch for a free consultation.', 'avideas' ); ?>
						</p>
						<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary btn--sm">
							<?php esc_html_e( 'Get a Quote', 'avideas' ); ?>
						</a>
					</div>

					<div class="widget" style="margin-top:var(--sp-md);">
						<h3 class="widget-title" style="font-size:1rem; margin-bottom:1rem;"><?php esc_html_e( 'Our Services', 'avideas' ); ?></h3>
						<ul style="list-style:none; padding:0;">
							<?php foreach ( avideas_get_services() as $service ) : ?>
							<li style="margin-bottom:0.5rem;">
								<a href="<?php echo esc_url( home_url( '/services/' . $service['slug'] . '/' ) ); ?>" style="font-size:0.9rem; color:var(--clr-text);">
									<?php echo $service['icon']; ?> <?php echo esc_html( $service['title'] ); ?>
								</a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</aside>

		</div>
	</div>
</section>

<?php get_footer(); ?>
