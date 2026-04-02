<?php
/**
 * Front Page Template
 *
 * @package Luminar Touch Events
 */

get_header();

$uri      = get_template_directory_uri();
$services = luminar_get_services();
?>

<!-- ============================================================
     HERO SECTION
     ============================================================ -->
<section class="hero" id="hero" aria-label="<?php esc_attr_e( 'Hero banner', 'luminar' ); ?>">
	<div class="hero__bg" id="hero-bg" style="background-image: url('<?php echo esc_url( $uri ); ?>/assets/images/Wedding deco.png');"></div>

	<div class="hero__content">
		<span class="hero__eyebrow">
			<?php echo esc_html( get_theme_mod( 'luminar_hero_eyebrow', "Brisbane's Premier Event Stylists" ) ); ?>
		</span>

		<h1 class="hero__title">
			<?php esc_html_e( 'Brisbane Event Stylist', 'luminar' ); ?><br>
			<em><?php esc_html_e( 'Creating Moments Worth Remembering', 'luminar' ); ?></em>
		</h1>

		<p class="hero__subtitle">
			<?php echo esc_html( get_theme_mod( 'luminar_hero_subtitle', "Luminar Touch Events — bespoke event styling in Brisbane for baby showers, weddings, graduations, gender reveals and more. Free quote in 24 hours." ) ); ?>
		</p>

		<div class="hero__actions">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary btn--lg">
				<?php esc_html_e( 'Book Your Event', 'luminar' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn--ghost btn--lg">
				<?php esc_html_e( 'View Gallery', 'luminar' ); ?>
			</a>
		</div>
	</div>

	<div class="hero__scroll" aria-hidden="true">
		<div class="hero__scroll-arrow"></div>
		<span><?php esc_html_e( 'Scroll', 'luminar' ); ?></span>
	</div>
</section>

<!-- Marquee Bar -->
<div class="marquee-bar" aria-hidden="true">
	<div class="marquee-track" id="marquee-track">
		<span class="marquee-item"><?php esc_html_e( 'Baby Showers', 'luminar' ); ?></span>
		<span class="marquee-item"><?php esc_html_e( 'Bridal Showers', 'luminar' ); ?></span>
		<span class="marquee-item"><?php esc_html_e( 'Gender Reveals', 'luminar' ); ?></span>
		<span class="marquee-item"><?php esc_html_e( 'Graduations', 'luminar' ); ?></span>
		<span class="marquee-item"><?php esc_html_e( 'Citizenship Ceremonies', 'luminar' ); ?></span>
		<span class="marquee-item"><?php esc_html_e( 'Weddings', 'luminar' ); ?></span>
		<span class="marquee-item"><?php esc_html_e( 'Dinner Parties', 'luminar' ); ?></span>
		<!-- Duplicate for seamless loop -->
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Baby Showers', 'luminar' ); ?></span>
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Bridal Showers', 'luminar' ); ?></span>
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Gender Reveals', 'luminar' ); ?></span>
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Graduations', 'luminar' ); ?></span>
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Citizenship Ceremonies', 'luminar' ); ?></span>
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Weddings', 'luminar' ); ?></span>
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Dinner Parties', 'luminar' ); ?></span>
	</div>
</div>

<!-- ============================================================
     COLLECTIONS — 4-col image overlay cards (luminartouch.com.au style)
     ============================================================ -->
<section id="collections" aria-label="<?php esc_attr_e( 'Event collections', 'luminar' ); ?>">

	<?php
	$collections = [
		[
			'title'  => 'Baby Showers',
			'sub'    => 'Celebrate New Life',
			'slug'   => 'baby-shower',
			'image'  => $uri . '/assets/images/birthday party deco.png',
		],
		[
			'title'  => 'Weddings',
			'sub'    => 'Your Perfect Day',
			'slug'   => 'wedding',
			'image'  => $uri . '/assets/images/Wedding deco.png',
		],
		[
			'title'  => 'Graduations',
			'sub'    => 'Mark the Milestone',
			'slug'   => 'graduation',
			'image'  => $uri . '/assets/images/Graduation party.png',
		],
		[
			'title'  => 'Gender Reveals',
			'sub'    => 'Big Announcement Magic',
			'slug'   => 'gender-reveal',
			'image'  => $uri . '/assets/images/gender reveal.jfif',
		],
	];
	?>

	<div class="collections-grid">
		<?php foreach ( $collections as $col ) : ?>
		<a href="<?php echo esc_url( home_url( '/services/' . $col['slug'] . '/' ) ); ?>" class="collection-card" aria-label="<?php echo esc_attr( $col['title'] ); ?>">
			<img
				src="<?php echo esc_url( $col['image'] ); ?>"
				alt="<?php echo esc_attr( $col['title'] . ' — Luminar Touch Events Brisbane' ); ?>"
				class="collection-card__img"
				loading="lazy"
				width="480"
				height="640"
			>
			<div class="collection-card__overlay"></div>
			<div class="collection-card__label">
				<div class="collection-card__title"><?php echo esc_html( $col['title'] ); ?></div>
				<div class="collection-card__sub"><?php echo esc_html( $col['sub'] ); ?></div>
				<div class="collection-card__arrow" aria-hidden="true">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
				</div>
			</div>
		</a>
		<?php endforeach; ?>
	</div>

	<div style="text-align:center; padding: var(--sp-md) 0 var(--sp-lg);">
		<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn--outline">
			<?php esc_html_e( 'See All Services', 'luminar' ); ?>
		</a>
	</div>

</section>

<!-- ============================================================
     ABOUT / STORY SECTION
     ============================================================ -->
<section class="section section--blush about-section" id="about" aria-label="<?php esc_attr_e( 'About Luminar Touch Events', 'luminar' ); ?>">
	<div class="container">
		<div class="grid-2">

			<!-- Image Stack -->
			<div class="about-img-stack reveal">
				<img
					src="<?php echo esc_url( $uri . '/assets/images/engagement.jpg' ); ?>"
					alt="<?php esc_attr_e( 'Luminar Touch Events — elegant event styling Brisbane', 'luminar' ); ?>"
					class="about-img-stack__main"
					loading="lazy"
					width="600"
					height="800"
				>
				<img
					src="<?php echo esc_url( $uri . '/assets/images/gallery2.jfif' ); ?>"
					alt="<?php esc_attr_e( 'Beautiful floral arrangement and event decor', 'luminar' ); ?>"
					class="about-img-stack__accent"
					loading="lazy"
					width="400"
					height="400"
				>
			</div>

			<!-- Content -->
			<div class="about-content reveal">
				<span class="about-content__eyebrow section-header__eyebrow"><?php esc_html_e( 'Our Story', 'luminar' ); ?></span>
				<h2 class="about-content__title"><?php esc_html_e( "Brisbane's Most Loved Event Styling Studio", 'luminar' ); ?></h2>
				<div class="divider" style="justify-content:flex-start; margin-bottom:1.5rem;">
					<div class="divider__line"></div>
					<span class="divider__icon">&#x2665;</span>
				</div>
				<p class="about-content__text">
					<?php esc_html_e( "We believe every milestone deserves to be celebrated in style. Luminar Touch Events was born from a passion for creating beautiful, meaningful spaces that tell your unique story.", 'luminar' ); ?>
				</p>
				<p class="about-content__text">
					<?php esc_html_e( "Our team of dedicated stylists works closely with you to understand your vision, then brings it to life with exquisite florals, custom installations, and perfectly curated decor.", 'luminar' ); ?>
				</p>

				<div class="stat-row">
					<div class="stat-item">
						<span class="stat-item__num">500+</span>
						<span class="stat-item__label"><?php esc_html_e( 'Events Styled', 'luminar' ); ?></span>
					</div>
					<div class="stat-item">
						<span class="stat-item__num">8+</span>
						<span class="stat-item__label"><?php esc_html_e( "Years' Experience", 'luminar' ); ?></span>
					</div>
					<div class="stat-item">
						<span class="stat-item__num">100%</span>
						<span class="stat-item__label"><?php esc_html_e( '5-Star Reviews', 'luminar' ); ?></span>
					</div>
				</div>

				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn--primary mt-md">
					<?php esc_html_e( 'Meet the Team', 'luminar' ); ?>
				</a>
			</div>

		</div>
	</div>
</section>

<!-- ============================================================
     INSTAGRAM / SOCIAL FOLLOW SECTION
     ============================================================ -->
<section class="section section--cream" id="social-follow" style="padding-bottom: 0;" aria-label="<?php esc_attr_e( 'Follow us on Instagram', 'luminar' ); ?>">
	<div class="container text-center" style="padding-bottom: var(--sp-md);">
		<p style="font-size:0.72rem; letter-spacing:0.22em; text-transform:uppercase; color:var(--clr-rose); font-weight:700; margin-bottom:0.4rem;">
			<?php esc_html_e( 'Follow Our Work', 'luminar' ); ?>
		</p>
		<h2 style="font-family:var(--font-display); font-size:clamp(1.5rem,3vw,2.2rem); color:var(--clr-dark); margin-bottom:0.3rem;">
			<?php esc_html_e( '@luminartouchevents', 'luminar' ); ?>
		</h2>
		<p style="color:var(--clr-muted); font-size:0.9rem; margin-bottom:var(--sp-md);">
			<?php esc_html_e( 'Tag us in your photos and be featured here.', 'luminar' ); ?>
		</p>
	</div>

	<!-- Tight Instagram-style gallery grid -->
	<div class="gallery-grid" aria-label="<?php esc_attr_e( 'Instagram gallery', 'luminar' ); ?>">
		<?php
		$grid_images = [
			[ $uri . '/assets/images/gallery1.jfif',             'Baby shower styling Brisbane' ],
			[ $uri . '/assets/images/gallery2.jfif',             'Bridal shower decor Brisbane' ],
			[ $uri . '/assets/images/gallery 3.jfif',            'Elegant event styling Brisbane' ],
			[ $uri . '/assets/images/gallery4.jfif',             'Wedding reception styling Brisbane' ],
			[ $uri . '/assets/images/gallery45.jfif',            'Gender reveal party Brisbane' ],
			[ $uri . '/assets/images/engagement.jpg',            'Engagement party decor Brisbane' ],
			[ $uri . '/assets/images/citizenship.jpg',           'Citizenship ceremony styling Brisbane' ],
			[ $uri . '/assets/images/gender reveal.jpg',         'Gender reveal setup Brisbane' ],
			[ $uri . '/assets/images/Graduation ceremoby.jfif',  'Graduation ceremony styling Brisbane' ],
		];
		foreach ( $grid_images as $gi ) :
		?>
		<div class="gallery-grid__item" data-lightbox>
			<img
				src="<?php echo esc_url( $gi[0] ); ?>"
				alt="<?php echo esc_attr( $gi[1] ); ?>"
				loading="lazy"
				width="400"
				height="400"
			>
			<div class="gallery-grid__item__overlay" aria-hidden="true">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
					<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
				</svg>
			</div>
		</div>
		<?php endforeach; ?>
	</div>

	<div style="text-align:center; padding: var(--sp-md) 0 var(--sp-lg);">
		<a
			href="<?php echo esc_url( get_theme_mod( 'luminar_instagram', 'https://www.instagram.com/' ) ); ?>"
			class="btn btn--outline"
			target="_blank"
			rel="noopener noreferrer"
		>
			<?php esc_html_e( 'Follow on Instagram', 'luminar' ); ?>
		</a>
		&nbsp;
		<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn--ghost" style="color:var(--clr-rose); border-color:var(--clr-rose);">
			<?php esc_html_e( 'View Full Gallery', 'luminar' ); ?>
		</a>
	</div>
</section>

<!-- ============================================================
     PROCESS / HOW IT WORKS
     ============================================================ -->
<section class="section section--linen" id="process" aria-label="<?php esc_attr_e( 'Our process', 'luminar' ); ?>">
	<div class="container">
		<div class="section-header reveal">
			<span class="section-header__eyebrow"><?php esc_html_e( 'How It Works', 'luminar' ); ?></span>
			<h2 class="section-header__title"><?php esc_html_e( 'Your Event, Our Expertise', 'luminar' ); ?></h2>
			<div class="divider"><div class="divider__line"></div><span class="divider__icon">&#x2665;</span><div class="divider__line"></div></div>
		</div>

		<div class="grid-4 reveal-stagger" style="margin-top: var(--sp-lg);">

			<?php
			$steps = [
				[ '01', 'Consultation',  'Tell us about your event, vision, and budget. We listen, ask the right questions, and get excited with you.' ],
				[ '02', 'Custom Design', 'We create a bespoke styling concept just for you — mood boards, colour palettes, and decor curation.' ],
				[ '03', 'Setup Day',     'Our team arrives early to set everything up perfectly. You arrive to a stunning styled space, stress-free.' ],
				[ '04', 'Celebrate!',    'Enjoy every moment knowing every detail has been handled. After your event, we pack down — you relax.' ],
			];
			foreach ( $steps as $step ) :
			?>
			<div class="process-step" style="text-align:center; padding: var(--sp-md);">
				<div style="width:64px; height:64px; border-radius:50%; background:var(--clr-blush); display:flex; align-items:center; justify-content:center; margin:0 auto var(--sp-sm); font-family:var(--font-display); font-size:1.4rem; font-weight:700; color:var(--clr-rose);">
					<?php echo esc_html( $step[0] ); ?>
				</div>
				<h3 style="font-size:1rem; margin-bottom:0.5rem;"><?php echo esc_html( $step[1] ); ?></h3>
				<p style="font-size:0.88rem; color:var(--clr-muted);"><?php echo esc_html( $step[2] ); ?></p>
			</div>
			<?php endforeach; ?>

		</div>
	</div>
</section>

<!-- ============================================================
     TESTIMONIALS
     ============================================================ -->
<section class="section testimonials" id="testimonials" aria-label="<?php esc_attr_e( 'Client testimonials', 'luminar' ); ?>">
	<div class="container">
		<div class="section-header reveal">
			<span class="section-header__eyebrow"><?php esc_html_e( 'Happy Clients', 'luminar' ); ?></span>
			<h2 class="section-header__title"><?php esc_html_e( 'What Our Clients Say', 'luminar' ); ?></h2>
			<div class="divider"><div class="divider__line" style="background:rgba(255,255,255,0.3);"></div><span class="divider__icon">&#x2665;</span><div class="divider__line" style="background:rgba(255,255,255,0.3);"></div></div>
		</div>

		<div class="testimonial-slider" id="testimonial-slider">
			<div class="testimonial-track" id="testimonial-track">

				<?php
				$testimonials_db = new WP_Query([
					'post_type'      => 'testimonial',
					'posts_per_page' => 6,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				]);

				$fallback = [
					[
						'quote'  => '"Luminar Touch Events transformed our baby shower into an absolute fairytale. Every single detail was perfect — the florals, the balloon arch, the dessert table. Our guests could not stop talking about it!"',
						'name'   => 'Sarah M.',
						'event'  => 'Baby Shower — Brisbane',
					],
					[
						'quote'  => '"I cannot recommend Luminar Touch Events enough. They took my bridal shower vision and exceeded every expectation. The styling was elegant, romantic, and utterly breathtaking."',
						'name'   => 'Jessica K.',
						'event'  => 'Bridal Shower — Brisbane Southside',
					],
					[
						'quote'  => '"From our first consultation to the final pack-down, the team were professional, creative, and just lovely to work with. Our wedding looked like a magazine shoot!"',
						'name'   => 'Emma & David',
						'event'  => 'Wedding Styling — Brisbane',
					],
					[
						'quote'  => '"The gender reveal setup was beyond anything I could have imagined. So many of our guests asked who did the styling — I was so proud to share the Luminar Touch Events name."',
						'name'   => 'Priya T.',
						'event'  => 'Gender Reveal Party — Brisbane North',
					],
				];

				if ( $testimonials_db->have_posts() ) :
					while ( $testimonials_db->have_posts() ) :
						$testimonials_db->the_post();
						$quote = get_post_meta( get_the_ID(), '_testimonial_quote', true ) ?: get_the_content();
						$event = get_post_meta( get_the_ID(), '_testimonial_event', true );
						?>
						<div class="testimonial-card">
							<div class="testimonial-card__inner">
								<div class="testimonial-card__stars" aria-label="<?php esc_attr_e( '5 stars', 'luminar' ); ?>">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
								<blockquote class="testimonial-card__quote"><?php echo wp_kses_post( $quote ); ?></blockquote>
								<div class="testimonial-card__author">
									<?php if ( has_post_thumbnail() ) : ?>
									<img src="<?php the_post_thumbnail_url( [ 96, 96 ] ); ?>" alt="<?php the_title_attribute(); ?>" class="testimonial-card__avatar" loading="lazy" width="48" height="48">
									<?php endif; ?>
									<div>
										<div class="testimonial-card__name"><?php the_title(); ?></div>
										<?php if ( $event ) : ?>
										<div class="testimonial-card__event"><?php echo esc_html( $event ); ?></div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					<?php
					endwhile;
					wp_reset_postdata();
				else :
					foreach ( $fallback as $t ) : ?>
					<div class="testimonial-card">
						<div class="testimonial-card__inner">
							<div class="testimonial-card__stars" aria-label="<?php esc_attr_e( '5 stars', 'luminar' ); ?>">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
							<blockquote class="testimonial-card__quote"><?php echo esc_html( $t['quote'] ); ?></blockquote>
							<div class="testimonial-card__author">
								<div class="testimonial-card__avatar" style="background:var(--clr-blush); width:48px;height:48px;border-radius:50%;"></div>
								<div>
									<div class="testimonial-card__name"><?php echo esc_html( $t['name'] ); ?></div>
									<div class="testimonial-card__event"><?php echo esc_html( $t['event'] ); ?></div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach;
				endif; ?>

			</div><!-- .testimonial-track -->
		</div>

		<div class="testimonial-nav" id="testimonial-nav" role="tablist" aria-label="<?php esc_attr_e( 'Testimonial navigation', 'luminar' ); ?>"></div>

	</div>
</section>

<!-- ============================================================
     ENQUIRY — "Tell Us About Your Event"
     ============================================================ -->
<section class="section enquiry-section" id="enquiry" aria-label="<?php esc_attr_e( 'Event enquiry form', 'luminar' ); ?>">
	<div class="container">
		<div class="section-header reveal">
			<span class="section-header__eyebrow"><?php esc_html_e( 'Free Quote', 'luminar' ); ?></span>
			<h2 class="section-header__title"><?php esc_html_e( 'Tell Us About Your Event', 'luminar' ); ?></h2>
			<div class="divider"><div class="divider__line"></div><span class="divider__icon">&#x2665;</span><div class="divider__line"></div></div>
			<p class="section-header__desc">
				<?php esc_html_e( "Share your vision and we'll get back to you within 24 hours with availability and ideas.", 'luminar' ); ?>
			</p>
		</div>

		<div class="enquiry-form reveal" id="enquiry-form-wrap">
			<form id="enquiry-form" novalidate aria-label="<?php esc_attr_e( 'Event enquiry form', 'luminar' ); ?>">
				<?php wp_nonce_field( 'luminar_nonce', 'nonce' ); ?>

				<div class="form-grid">
					<div class="form-group">
						<label class="form-label" for="enquiry-name"><?php esc_html_e( 'Your Name *', 'luminar' ); ?></label>
						<input type="text" id="enquiry-name" name="name" class="form-input" placeholder="<?php esc_attr_e( 'e.g. Sarah Johnson', 'luminar' ); ?>" required autocomplete="name">
					</div>

					<div class="form-group">
						<label class="form-label" for="enquiry-email"><?php esc_html_e( 'Email Address *', 'luminar' ); ?></label>
						<input type="email" id="enquiry-email" name="email" class="form-input" placeholder="<?php esc_attr_e( 'hello@example.com', 'luminar' ); ?>" required autocomplete="email">
					</div>

					<div class="form-group">
						<label class="form-label" for="enquiry-phone"><?php esc_html_e( 'Phone Number *', 'luminar' ); ?></label>
						<input type="tel" id="enquiry-phone" name="phone" class="form-input" placeholder="<?php esc_attr_e( '0400 000 000', 'luminar' ); ?>" required autocomplete="tel">
					</div>

					<div class="form-group">
						<label class="form-label" for="enquiry-service"><?php esc_html_e( 'Type of Event *', 'luminar' ); ?></label>
						<select id="enquiry-service" name="service" class="form-select" required>
							<option value=""><?php esc_html_e( '— Select event type —', 'luminar' ); ?></option>
							<?php foreach ( $services as $service ) : ?>
							<option value="<?php echo esc_attr( $service['slug'] ); ?>"><?php echo esc_html( $service['title'] ); ?></option>
							<?php endforeach; ?>
							<option value="other"><?php esc_html_e( 'Other', 'luminar' ); ?></option>
						</select>
					</div>

					<div class="form-group">
						<label class="form-label" for="enquiry-date"><?php esc_html_e( 'Event Date *', 'luminar' ); ?></label>
						<input type="date" id="enquiry-date" name="event_date" class="form-input" required>
					</div>

					<div class="form-group">
						<label class="form-label" for="enquiry-guests"><?php esc_html_e( 'Estimated Guests', 'luminar' ); ?></label>
						<select id="enquiry-guests" name="guests" class="form-select">
							<option value=""><?php esc_html_e( '— Guest count —', 'luminar' ); ?></option>
							<option value="10">1–10</option>
							<option value="25">11–25</option>
							<option value="50">26–50</option>
							<option value="100">51–100</option>
							<option value="200">100+</option>
						</select>
					</div>

					<div class="form-group">
						<label class="form-label" for="enquiry-venue"><?php esc_html_e( 'Venue Type', 'luminar' ); ?></label>
						<select id="enquiry-venue" name="venue" class="form-select">
							<option value=""><?php esc_html_e( '— Select venue type —', 'luminar' ); ?></option>
							<option value="Beach"><?php esc_html_e( 'Beach', 'luminar' ); ?></option>
							<option value="Church"><?php esc_html_e( 'Church', 'luminar' ); ?></option>
							<option value="Hall"><?php esc_html_e( 'Hall', 'luminar' ); ?></option>
							<option value="Garden"><?php esc_html_e( 'Garden', 'luminar' ); ?></option>
							<option value="Other"><?php esc_html_e( 'Other', 'luminar' ); ?></option>
						</select>
					</div>

					<div class="form-group">
						<label class="form-label" for="enquiry-budget"><?php esc_html_e( 'Budget Range', 'luminar' ); ?></label>
						<select id="enquiry-budget" name="budget" class="form-select">
							<option value=""><?php esc_html_e( '— Select budget —', 'luminar' ); ?></option>
							<option value="under500"><?php esc_html_e( 'Under $500', 'luminar' ); ?></option>
							<option value="500-1500"><?php esc_html_e( '$500 – $1,500', 'luminar' ); ?></option>
							<option value="1500-3000"><?php esc_html_e( '$1,500 – $3,000', 'luminar' ); ?></option>
							<option value="3000-5000"><?php esc_html_e( '$3,000 – $5,000', 'luminar' ); ?></option>
							<option value="5000plus"><?php esc_html_e( '$5,000+', 'luminar' ); ?></option>
						</select>
					</div>

					<div class="form-group form-group--full">
						<label class="form-label" for="enquiry-message"><?php esc_html_e( 'Your Vision & Special Requests', 'luminar' ); ?></label>
						<textarea id="enquiry-message" name="message" class="form-textarea" rows="4" placeholder="<?php esc_attr_e( "Describe your theme, colour palette, inspiration, or any special details you have in mind...", 'luminar' ); ?>"></textarea>
					</div>

					<div class="form-group form-group--full text-center">
						<button type="submit" class="btn btn--primary btn--lg" id="enquiry-submit">
							<span class="btn-text"><?php esc_html_e( 'Send My Enquiry', 'luminar' ); ?></span>
							<span class="btn-loading" style="display:none;">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;" aria-hidden="true"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
								<?php esc_html_e( 'Sending...', 'luminar' ); ?>
							</span>
						</button>
						<p style="font-size:0.75rem; color:var(--clr-muted); margin-top:0.75rem;">
							<?php esc_html_e( 'We respond within 24 hours. Your details are kept private.', 'luminar' ); ?>
						</p>
					</div>

				</div><!-- .form-grid -->

				<div id="form-response" style="display:none;" role="alert" aria-live="polite"></div>

			</form>
		</div><!-- .enquiry-form -->
	</div>
</section>

<?php get_footer(); ?>
