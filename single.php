<?php
/**
 * Single Post Template
 *
 * @package Luminar Touch Events
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
	<div class="container page-hero__content">
		<span class="page-hero__eyebrow">
			<?php
			$categories = get_the_category();
			echo $categories ? esc_html( $categories[0]->name ) : esc_html__( 'Blog', 'luminar' );
			?>
		</span>
		<h1 class="page-hero__title"><?php the_title(); ?></h1>
		<nav class="page-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'luminar' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luminar' ); ?></a>
			<span aria-hidden="true"> / </span>
			<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'luminar' ); ?></a>
			<span aria-hidden="true"> / </span>
			<span><?php the_title(); ?></span>
		</nav>
	</div>
</div>

<section class="section section--cream">
	<div class="container--sm">
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<!-- Featured Image -->
				<?php if ( has_post_thumbnail() ) : ?>
				<figure style="margin-bottom: var(--sp-lg); border-radius: var(--radius-lg); overflow:hidden;">
					<?php the_post_thumbnail( 'avideas-hero', [ 'loading' => 'eager' ] ); ?>
				</figure>
				<?php endif; ?>

				<!-- Post Meta -->
				<div style="display:flex; align-items:center; gap:1rem; margin-bottom:var(--sp-md); font-size:0.82rem; color:var(--clr-muted);">
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
						<?php echo esc_html( get_the_date() ); ?>
					</time>
					<span aria-hidden="true">·</span>
					<span>
						<?php
						/* translators: %s: reading time */
						printf( esc_html__( '%s min read', 'luminar' ), esc_html( ceil( str_word_count( get_the_content() ) / 200 ) ) );
						?>
					</span>
				</div>

				<!-- Post Content -->
				<div class="post-content">
					<?php the_content(); ?>
				</div>

				<!-- Post Footer -->
				<div style="margin-top:var(--sp-md); padding-top:var(--sp-md); border-top:1px solid var(--clr-border);">
					<?php the_tags( '<div style="font-size:0.82rem; color:var(--clr-muted);">' . esc_html__( 'Tags: ', 'luminar' ), ', ', '</div>' ); ?>
				</div>

			</article>

			<!-- Navigation -->
			<nav class="post-navigation" style="display:flex; justify-content:space-between; margin-top:var(--sp-lg); padding-top:var(--sp-md); border-top:1px solid var(--clr-border);" aria-label="<?php esc_attr_e( 'Post navigation', 'luminar' ); ?>">
				<?php
				$prev = get_previous_post();
				$next = get_next_post();
				if ( $prev ) :
				?>
				<a href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>" style="font-size:0.85rem; font-weight:700; color:var(--clr-rose);">
					&larr; <?php echo esc_html( get_the_title( $prev->ID ) ); ?>
				</a>
				<?php endif; if ( $next ) : ?>
				<a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>" style="font-size:0.85rem; font-weight:700; color:var(--clr-rose); margin-left:auto; text-align:right;">
					<?php echo esc_html( get_the_title( $next->ID ) ); ?> &rarr;
				</a>
				<?php endif; ?>
			</nav>

		<?php endwhile; ?>
	</div>
</section>

<!-- Related Posts -->
<section class="section section--blush" aria-label="<?php esc_attr_e( 'Related posts', 'luminar' ); ?>">
	<div class="container">
		<h2 class="text-center" style="margin-bottom:var(--sp-lg);"><?php esc_html_e( 'More Inspiration', 'luminar' ); ?></h2>
		<div class="archive-grid">
			<?php
			$cats = wp_get_post_categories( get_the_ID() );
			$related = new WP_Query( [
				'category__in'   => $cats,
				'post__not_in'   => [ get_the_ID() ],
				'posts_per_page' => 3,
				'orderby'        => 'rand',
			] );
			while ( $related->have_posts() ) :
				$related->the_post();
				get_template_part( 'template-parts/post-card' );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
