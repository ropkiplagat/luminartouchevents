<?php
/**
 * Template Name: Gallery Page
 *
 * @package Luminar Touch Events
 */

get_header();

$services = luminar_get_services();
?>

<div class="page-hero">
	<div class="container page-hero__content">
		<span class="page-hero__eyebrow"><?php esc_html_e( 'Our Portfolio', 'luminar' ); ?></span>
		<h1 class="page-hero__title"><?php esc_html_e( 'Event Gallery', 'luminar' ); ?></h1>
		<nav class="page-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'luminar' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luminar' ); ?></a>
			<span aria-hidden="true"> / </span>
			<span><?php esc_html_e( 'Gallery', 'luminar' ); ?></span>
		</nav>
	</div>
</div>

<section class="section section--cream">
	<div class="container">

		<!-- Filter Buttons -->
		<div class="gallery-filter reveal" role="group" aria-label="<?php esc_attr_e( 'Filter gallery by event type', 'luminar' ); ?>">
			<button class="filter-btn is-active" data-filter="all" aria-pressed="true">
				<?php esc_html_e( 'All Events', 'luminar' ); ?>
			</button>
			<?php foreach ( $services as $service ) : ?>
			<button class="filter-btn" data-filter="<?php echo esc_attr( $service['slug'] ); ?>" aria-pressed="false">
				<?php echo esc_html( $service['title'] ); ?>
			</button>
			<?php endforeach; ?>
		</div>

		<!-- Gallery Grid -->
		<?php
		$gallery_query = new WP_Query( [
			'post_type'      => 'gallery_item',
			'posts_per_page' => 24,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		] );
		?>

		<div class="gallery-grid reveal" id="gallery-grid" aria-label="<?php esc_attr_e( 'Event photo gallery', 'luminar' ); ?>">

			<?php if ( $gallery_query->have_posts() ) : ?>

				<?php
				while ( $gallery_query->have_posts() ) :
					$gallery_query->the_post();
					$cats    = wp_get_post_terms( get_the_ID(), 'gallery_category', [ 'fields' => 'slugs' ] );
					$cat_str = implode( ' ', (array) $cats );
					$img_url = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'avideas-square' ) : luminar_placeholder_img( 600, 600, get_the_title() );
					?>
					<div class="gallery-grid__item" data-category="<?php echo esc_attr( $cat_str ); ?>" data-lightbox data-src="<?php echo esc_url( $img_url ); ?>">
						<img
							src="<?php echo esc_url( $img_url ); ?>"
							alt="<?php the_title_attribute(); ?>"
							loading="lazy"
							width="600"
							height="600"
						>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>

			<?php else : ?>

				<?php
				// Fallback demo gallery
				$base = get_template_directory_uri() . '/assets/images/';
				$demo_items = [
					[ 'Wedding Decoration by Luminar Touch Events',   'wedding',      $base . 'Wedding deco.png' ],
					[ 'Birthday Party Styling Brisbane',              'baby-shower',  $base . 'birthday party deco.png' ],
					[ 'Graduation Celebration Party',                 'graduation',   $base . 'Graduation party.png' ],
					[ 'Citizenship Ceremony Styling',                 'citizenship',  $base . 'citizenship.jpg' ],
					[ 'Gender Reveal Party Decor',                    'gender-reveal',$base . 'gender reveal.jpg' ],
					[ 'Engagement Celebration Styling',               'bridal-shower',$base . 'engagement.jpg' ],
					[ 'Graduation Ceremony Decor',                    'graduation',   $base . 'Graduation ceremoby.jfif' ],
					[ 'Event Gallery — Luminar Touch Events',         'wedding',      $base . 'gallery1.jfif' ],
					[ 'Elegant Event Styling Brisbane',               'dinner-party', $base . 'gallery2.jfif' ],
					[ 'Beautiful Event Decor',                        'baby-shower',  $base . 'gallery 3.jfif' ],
					[ 'Brisbane Event Styling Portfolio',             'bridal-shower',$base . 'gallery4.jfif' ],
					[ 'Gender Reveal Party Setup',                    'gender-reveal',$base . 'gallery45.jfif' ],
				];
				foreach ( $demo_items as $item ) :
				?>
				<div class="gallery-grid__item" data-category="<?php echo esc_attr( $item[1] ); ?>" data-lightbox data-src="<?php echo esc_url( $item[2] ); ?>">
					<img
						src="<?php echo esc_url( $item[2] ); ?>"
						alt="<?php echo esc_attr( $item[0] ); ?>"
						loading="lazy"
						width="600"
						height="600"
					>
				</div>
				<?php endforeach; ?>

			<?php endif; ?>

		</div><!-- #gallery-grid -->

		<!-- CTA -->
		<div class="text-center mt-lg reveal">
			<p style="color:var(--clr-muted); margin-bottom:1.5rem;">
				<?php esc_html_e( 'Love what you see? Let us create something extraordinary for your event.', 'luminar' ); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary btn--lg">
				<?php esc_html_e( 'Book Your Event', 'luminar' ); ?>
			</a>
		</div>

	</div>
</section>

<?php get_footer(); ?>
