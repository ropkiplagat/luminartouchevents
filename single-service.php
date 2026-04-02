<?php
/**
 * Single Service CPT Template
 *
 * @package Luminar Touch Events
 */

get_header();
?>

<div class="page-hero">
	<div class="container page-hero__content">
		<span class="page-hero__eyebrow"><?php esc_html_e( 'Event Styling Service', 'luminar' ); ?></span>
		<h1 class="page-hero__title"><?php the_title(); ?></h1>
		<nav class="page-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'luminar' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luminar' ); ?></a>
			<span aria-hidden="true"> / </span>
			<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'luminar' ); ?></a>
			<span aria-hidden="true"> / </span>
			<span><?php the_title(); ?></span>
		</nav>
	</div>
</div>

<section class="section section--cream service-single">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			$slug = get_post_field( 'post_name', get_the_ID() );
		?>
		<div class="service-single__grid">

			<!-- Image -->
			<?php if ( has_post_thumbnail() ) : ?>
			<figure>
				<?php the_post_thumbnail( 'avideas-portrait', [ 'class' => 'service-single__img', 'loading' => 'eager' ] ); ?>
			</figure>
			<?php else : ?>
			<figure>
				<img
					src="<?php echo esc_url( luminar_placeholder_img( 400, 600, get_the_title() ) ); ?>"
					alt="<?php the_title_attribute(); ?>"
					class="service-single__img"
					loading="eager"
					width="400"
					height="600"
				>
			</figure>
			<?php endif; ?>

			<!-- Content -->
			<div>
				<span class="section-header__eyebrow" style="display:block; margin-bottom:0.75rem;">
					<?php esc_html_e( 'Brisbane Event Styling', 'luminar' ); ?>
				</span>
				<h2 style="margin-bottom:1rem;"><?php the_title(); ?></h2>
				<div class="divider" style="justify-content:flex-start; margin-bottom:1.5rem;">
					<div class="divider__line"></div>
					<span class="divider__icon">&#x2665;</span>
				</div>

				<div class="post-content" style="margin-bottom:var(--sp-md);">
					<?php the_content(); ?>
				</div>

				<!-- What's Included -->
				<div class="service-includes" style="margin-bottom:var(--sp-md);">
					<h3 style="font-size:1rem; margin-bottom:1rem;"><?php esc_html_e( "What's Included", 'luminar' ); ?></h3>
					<ul class="service-includes__list">
						<?php
						$includes_meta = get_post_meta( get_the_ID(), '_service_includes', true );
						$includes = $includes_meta
							? explode( "\n", $includes_meta )
							: [
								esc_html__( 'Personalised consultation & concept development', 'luminar' ),
								esc_html__( 'Full setup and professional styling on the day', 'luminar' ),
								esc_html__( 'Floral & decorative elements', 'luminar' ),
								esc_html__( 'Balloon installations (where applicable)', 'luminar' ),
								esc_html__( 'Complete pack-down after your event', 'luminar' ),
								esc_html__( 'Professional photography coordination support', 'luminar' ),
							];

						foreach ( $includes as $include ) :
							if ( trim( $include ) ) :
						?>
						<li class="service-includes__item"><?php echo esc_html( trim( $include ) ); ?></li>
						<?php
							endif;
						endforeach;
						?>
					</ul>
				</div>

				<!-- CTA -->
				<a href="<?php echo esc_url( home_url( '/contact/?service=' . urlencode( $slug ) ) ); ?>" class="btn btn--primary btn--lg">
					<?php esc_html_e( 'Book This Service', 'luminar' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn--outline btn--lg" style="margin-left:1rem;">
					<?php esc_html_e( 'View Gallery', 'luminar' ); ?>
				</a>
			</div>

		</div>
		<?php endwhile; ?>
	</div>
</section>

<!-- Related Services -->
<section class="section section--blush">
	<div class="container">
		<h2 class="text-center" style="margin-bottom:var(--sp-lg);"><?php esc_html_e( 'Other Services You May Love', 'luminar' ); ?></h2>
		<div class="services-grid reveal-stagger">
			<?php
			$related = new WP_Query( [
				'post_type'      => 'service',
				'post__not_in'   => [ get_the_ID() ],
				'posts_per_page' => 3,
				'orderby'        => 'rand',
			] );
			while ( $related->have_posts() ) :
				$related->the_post();
				$img = has_post_thumbnail()
					? get_the_post_thumbnail_url( get_the_ID(), 'avideas-service' )
					: luminar_placeholder_img( 800, 600, get_the_title() );
			?>
			<a href="<?php the_permalink(); ?>" class="service-card">
				<div class="service-card__img-wrap">
					<img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" class="service-card__img" loading="lazy" width="800" height="600">
					<div class="service-card__overlay"></div>
				</div>
				<div class="service-card__body">
					<h3 class="service-card__title"><?php the_title(); ?></h3>
					<p class="service-card__desc"><?php the_excerpt(); ?></p>
					<span class="service-card__link"><?php esc_html_e( 'Learn More', 'luminar' ); ?> &rarr;</span>
				</div>
			</a>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
