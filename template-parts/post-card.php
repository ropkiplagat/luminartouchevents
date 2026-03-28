<?php
/**
 * Template Part: Post Card
 * Used in archive, index, and search results
 *
 * @package Avideas
 */

$cats = get_the_category();
$cat_name = $cats ? $cats[0]->name : esc_html__( 'Event Inspiration', 'avideas' );
$img_src  = has_post_thumbnail()
	? get_the_post_thumbnail_url( get_the_ID(), 'avideas-thumb' )
	: avideas_placeholder_img( 600, 450, get_the_title() );
?>
<article <?php post_class( 'post-card' ); ?> id="post-<?php the_ID(); ?>">
	<a href="<?php the_permalink(); ?>" class="post-card__img-wrap" tabindex="-1" aria-hidden="true">
		<img
			src="<?php echo esc_url( $img_src ); ?>"
			alt="<?php the_title_attribute(); ?>"
			class="post-card__img"
			loading="lazy"
			width="600"
			height="450"
		>
	</a>
	<div class="post-card__body">
		<span class="post-card__category"><?php echo esc_html( $cat_name ); ?></span>
		<h3 class="post-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<p class="post-card__excerpt"><?php the_excerpt(); ?></p>
		<div class="post-card__meta">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
			<span aria-hidden="true">·</span>
			<span>
				<?php
				/* translators: %s: reading time */
				printf( esc_html__( '%s min read', 'avideas' ), esc_html( max( 1, ceil( str_word_count( get_the_content() ) / 200 ) ) ) );
				?>
			</span>
		</div>
	</div>
</article>
