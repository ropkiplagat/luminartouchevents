<?php
/**
 * Front Page Template
 *
 * @package Avideas
 */

get_header();

$services = avideas_get_services();
?>

<!-- ============================================================
     HERO SECTION
     ============================================================ -->
<section class="hero" id="hero" aria-label="<?php esc_attr_e( 'Hero banner', 'avideas' ); ?>">
	<div class="hero__bg" id="hero-bg"></div>

	<div class="hero__content">
		<span class="hero__eyebrow">
			<?php echo esc_html( get_theme_mod( 'avideas_hero_eyebrow', "Brisbane's Premier Event Stylists" ) ); ?>
		</span>

		<h1 class="hero__title">
			<?php esc_html_e( 'Creating Moments', 'avideas' ); ?><br>
			<em><?php esc_html_e( 'Worth Remembering', 'avideas' ); ?></em>
		</h1>

		<p class="hero__subtitle">
			<?php echo esc_html( get_theme_mod( 'avideas_hero_subtitle', "Bespoke event styling for life's most meaningful celebrations — from intimate gatherings to grand affairs." ) ); ?>
		</p>

		<div class="hero__actions">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary btn--lg">
				<?php esc_html_e( 'Book Your Event', 'avideas' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn--ghost btn--lg">
				<?php esc_html_e( 'View Gallery', 'avideas' ); ?>
			</a>
		</div>
	</div>

	<div class="hero__scroll" aria-hidden="true">
		<div class="hero__scroll-arrow"></div>
		<span><?php esc_html_e( 'Scroll', 'avideas' ); ?></span>
	</div>
</section>

<!-- Marquee Bar -->
<div class="marquee-bar" aria-hidden="true">
	<div class="marquee-track" id="marquee-track">
		<span class="marquee-item"><?php esc_html_e( 'Baby Showers', 'avideas' ); ?></span>
		<span class="marquee-item"><?php esc_html_e( 'Bridal Showers', 'avideas' ); ?></span>
		<span class="marquee-item"><?php esc_html_e( 'Gender Reveals', 'avideas' ); ?></span>
		<span class="marquee-item"><?php esc_html_e( 'Graduations', 'avideas' ); ?></span>
		<span class="marquee-item"><?php esc_html_e( 'Citizenship Ceremonies', 'avideas' ); ?></span>
		<span class="marquee-item"><?php esc_html_e( 'Weddings', 'avideas' ); ?></span>
		<span class="marquee-item"><?php esc_html_e( 'Dinner Parties', 'avideas' ); ?></span>
		<!-- Duplicate for seamless loop -->
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Baby Showers', 'avideas' ); ?></span>
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Bridal Showers', 'avideas' ); ?></span>
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Gender Reveals', 'avideas' ); ?></span>
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Graduations', 'avideas' ); ?></span>
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Citizenship Ceremonies', 'avideas' ); ?></span>
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Weddings', 'avideas' ); ?></span>
		<span class="marquee-item" aria-hidden="true"><?php esc_html_e( 'Dinner Parties', 'avideas' ); ?></span>
	</div>
</div>

<!-- ============================================================
     SERVICES SECTION
     ============================================================ -->
<section class="section section--cream" id="services" aria-label="<?php esc_attr_e( 'Our services', 'avideas' ); ?>">
	<div class="container">

		<div class="section-header reveal">
			<span class="section-header__eyebrow"><?php esc_html_e( 'What We Do', 'avideas' ); ?></span>
			<h2 class="section-header__title"><?php esc_html_e( 'Every Celebration, Beautifully Styled', 'avideas' ); ?></h2>
			<div class="divider"><div class="divider__line"></div><span class="divider__icon">&#x2665;</span><div class="divider__line"></div></div>
			<p class="section-header__desc">
				<?php esc_html_e( "From the softest baby showers to grand wedding receptions, we bring your vision to life with elegance and warmth.", 'avideas' ); ?>
			</p>
		</div>

		<div class="services-grid reveal-stagger">
			<?php foreach ( $services as $service ) : ?>
			<a href="<?php echo esc_url( home_url( '/services/' . $service['slug'] . '/' ) ); ?>" class="service-card" aria-label="<?php echo esc_attr( $service['title'] ); ?>">
				<div class="service-card__img-wrap">
					<?php
					$img_src = avideas_placeholder_img( 800, 600, $service['title'] );
					$args = [
						'post_type'      => 'service',
						'name'           => $service['slug'],
						'posts_per_page' => 1,
					];
					$service_query = new WP_Query( $args );
					if ( $service_query->have_posts() ) {
						$service_query->the_post();
						if ( has_post_thumbnail() ) {
							$img_src = get_the_post_thumbnail_url( get_the_ID(), 'avideas-service' );
						}
						wp_reset_postdata();
					}
					?>
					<img
						src="<?php echo esc_url( $img_src ); ?>"
						alt="<?php echo esc_attr( $service['title'] ); ?>"
						class="service-card__img"
						loading="lazy"
						width="800"
						height="600"
					>
					<div class="service-card__overlay"></div>
					<span class="service-card__badge badge badge--rose"><?php esc_html_e( 'Brisbane', 'avideas' ); ?></span>
				</div>
				<div class="service-card__body">
					<div class="service-card__icon" aria-hidden="true"><?php echo $service['icon']; ?></div>
					<h3 class="service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
					<p class="service-card__desc"><?php echo esc_html( $service['desc'] ); ?></p>
					<span class="service-card__link">
						<?php esc_html_e( 'Learn More', 'avideas' ); ?>
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
					</span>
				</div>
			</a>
			<?php endforeach; ?>
		</div>

		<div class="text-center mt-lg">
			<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'All Services', 'avideas' ); ?>
			</a>
		</div>

	</div>
</section>

<!-- ============================================================
     ABOUT / STORY SECTION
     ============================================================ -->
<section class="section section--blush about-section" id="about" aria-label="<?php esc_attr_e( 'About Avideas', 'avideas' ); ?>">
	<div class="container">
		<div class="grid-2">

			<!-- Image Stack -->
			<div class="about-img-stack reveal">
				<img
					src="<?php echo esc_url( avideas_placeholder_img( 600, 800, 'Event Styling Brisbane' ) ); ?>"
					alt="<?php esc_attr_e( 'Avideas event styling setup — Brisbane', 'avideas' ); ?>"
					class="about-img-stack__main"
					loading="lazy"
					width="600"
					height="800"
				>
				<img
					src="<?php echo esc_url( avideas_placeholder_img( 400, 400, 'Florals & Decor' ) ); ?>"
					alt="<?php esc_attr_e( 'Elegant floral arrangement and event decor', 'avideas' ); ?>"
					class="about-img-stack__accent"
					loading="lazy"
					width="400"
					height="400"
				>
			</div>

			<!-- Content -->
			<div class="about-content reveal">
				<span class="about-content__eyebrow section-header__eyebrow"><?php esc_html_e( 'Our Story', 'avideas' ); ?></span>
				<h2 class="about-content__title"><?php esc_html_e( "Brisbane's Most Loved Event Stylists", 'avideas' ); ?></h2>
				<div class="divider" style="justify-content:flex-start; margin-bottom:1.5rem;">
					<div class="divider__line"></div>
					<span class="divider__icon">&#x2665;</span>
				</div>
				<p class="about-content__text">
					<?php esc_html_e( "We believe every milestone deserves to be celebrated in style. Avideas was born from a passion for creating beautiful, meaningful spaces that tell your unique story.", 'avideas' ); ?>
				</p>
				<p class="about-content__text">
					<?php esc_html_e( "Our team of dedicated stylists works closely with you to understand your vision, then brings it to life with exquisite florals, custom installations, and perfectly curated decor.", 'avideas' ); ?>
				</p>

				<div class="stat-row">
					<div class="stat-item">
						<span class="stat-item__num">500+</span>
						<span class="stat-item__label"><?php esc_html_e( 'Events Styled', 'avideas' ); ?></span>
					</div>
					<div class="stat-item">
						<span class="stat-item__num">8+</span>
						<span class="stat-item__label"><?php esc_html_e( "Years' Experience", 'avideas' ); ?></span>
					</div>
					<div class="stat-item">
						<span class="stat-item__num">100%</span>
						<span class="stat-item__label"><?php esc_html_e( '5-Star Reviews', 'avideas' ); ?></span>
					</div>
				</div>

				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn--primary mt-md">
					<?php esc_html_e( 'Meet the Team', 'avideas' ); ?>
				</a>
			</div>

		</div>
	</div>
</section>

<!-- ============================================================
     GALLERY PREVIEW
     ============================================================ -->
<section class="section section--cream" id="gallery-preview" aria-label="<?php esc_attr_e( 'Gallery preview', 'avideas' ); ?>">
	<div class="container">
		<div class="section-header reveal">
			<span class="section-header__eyebrow"><?php esc_html_e( 'Our Work', 'avideas' ); ?></span>
			<h2 class="section-header__title"><?php esc_html_e( 'A Gallery of Beautiful Moments', 'avideas' ); ?></h2>
			<div class="divider"><div class="divider__line"></div><span class="divider__icon">&#x2665;</span><div class="divider__line"></div></div>
		</div>

		<div class="gallery-masonry reveal">
			<?php
			$gallery_labels = [
				[ 'Baby Shower Styling Brisbane',        3, 4 ],
				[ 'Bridal Shower Decor Brisbane',        4, 3 ],
				[ 'Wedding Reception Styling Brisbane',  3, 3 ],
				[ 'Gender Reveal Party Brisbane',        4, 4 ],
				[ 'Graduation Party Styling Brisbane',   3, 3 ],
				[ 'Elegant Dinner Party Brisbane',       4, 3 ],
			];
			foreach ( $gallery_labels as $i => $item ) :
				list( $label, $w, $h ) = $item;
				$w_px = $w * 100;
				$h_px = $h * 100;
			?>
			<div class="gallery-masonry__item" data-lightbox>
				<img
					src="<?php echo esc_url( avideas_placeholder_img( $w_px, $h_px, $label ) ); ?>"
					alt="<?php echo esc_attr( $label ); ?>"
					loading="lazy"
					width="<?php echo esc_attr( $w_px ); ?>"
					height="<?php echo esc_attr( $h_px ); ?>"
				>
				<div class="gallery-masonry__caption">
					<span><?php echo esc_html( $label ); ?></span>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

		<div class="text-center mt-lg">
			<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn--outline">
				<?php esc_html_e( 'View Full Gallery', 'avideas' ); ?>
			</a>
		</div>

	</div>
</section>

<!-- ============================================================
     PROCESS / HOW IT WORKS
     ============================================================ -->
<section class="section section--linen" id="process" aria-label="<?php esc_attr_e( 'Our process', 'avideas' ); ?>">
	<div class="container">
		<div class="section-header reveal">
			<span class="section-header__eyebrow"><?php esc_html_e( 'How It Works', 'avideas' ); ?></span>
			<h2 class="section-header__title"><?php esc_html_e( 'Your Event, Our Expertise', 'avideas' ); ?></h2>
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
<section class="section testimonials" id="testimonials" aria-label="<?php esc_attr_e( 'Client testimonials', 'avideas' ); ?>">
	<div class="container">
		<div class="section-header reveal">
			<span class="section-header__eyebrow"><?php esc_html_e( 'Happy Clients', 'avideas' ); ?></span>
			<h2 class="section-header__title"><?php esc_html_e( 'What Our Clients Say', 'avideas' ); ?></h2>
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

				// Fallback testimonials if none in DB
				$fallback = [
					[
						'quote'  => '"Avideas transformed our baby shower into an absolute fairytale. Every single detail was perfect — the florals, the balloon arch, the dessert table. Our guests could not stop talking about it!"',
						'name'   => 'Sarah M.',
						'event'  => 'Baby Shower — Brisbane',
					],
					[
						'quote'  => '"I cannot recommend Avideas enough. They took my bridal shower vision and exceeded every expectation. The styling was elegant, romantic, and utterly breathtaking."',
						'name'   => 'Jessica K.',
						'event'  => 'Bridal Shower — Brisbane Southside',
					],
					[
						'quote'  => '"From our first consultation to the final pack-down, the Avideas team were professional, creative, and just lovely to work with. Our wedding looked like a magazine shoot!"',
						'name'   => 'Emma & David',
						'event'  => 'Wedding Styling — Brisbane',
					],
					[
						'quote'  => '"The gender reveal setup was beyond anything I could have imagined. So many of our guests asked who did the styling — I was so proud to share the Avideas name."',
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
								<div class="testimonial-card__stars" aria-label="<?php esc_attr_e( '5 stars', 'avideas' ); ?>">★★★★★</div>
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
							<div class="testimonial-card__stars" aria-label="<?php esc_attr_e( '5 stars', 'avideas' ); ?>">★★★★★</div>
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

		<div class="testimonial-nav" id="testimonial-nav" role="tablist" aria-label="<?php esc_attr_e( 'Testimonial navigation', 'avideas' ); ?>"></div>

	</div>
</section>

<!-- ============================================================
     ENQUIRY / CTA SECTION
     ============================================================ -->
<section class="section enquiry-section" id="enquiry" aria-label="<?php esc_attr_e( 'Enquiry form', 'avideas' ); ?>">
	<div class="container">
		<div class="section-header reveal">
			<span class="section-header__eyebrow"><?php esc_html_e( 'Book Your Event', 'avideas' ); ?></span>
			<h2 class="section-header__title"><?php esc_html_e( "Let's Create Something Beautiful", 'avideas' ); ?></h2>
			<div class="divider"><div class="divider__line"></div><span class="divider__icon">&#x2665;</span><div class="divider__line"></div></div>
			<p class="section-header__desc">
				<?php esc_html_e( "Tell us about your special occasion and we'll get back to you within 24 hours with ideas and availability.", 'avideas' ); ?>
			</p>
		</div>

		<div class="enquiry-form reveal" id="enquiry-form-wrap">
			<form id="enquiry-form" novalidate aria-label="<?php esc_attr_e( 'Event enquiry form', 'avideas' ); ?>">
				<?php wp_nonce_field( 'avideas_nonce', 'nonce' ); ?>

				<div class="form-grid">
					<div class="form-group">
						<label class="form-label" for="enquiry-name"><?php esc_html_e( 'Your Name *', 'avideas' ); ?></label>
						<input type="text" id="enquiry-name" name="name" class="form-input" placeholder="<?php esc_attr_e( 'e.g. Sarah Johnson', 'avideas' ); ?>" required autocomplete="name">
					</div>

					<div class="form-group">
						<label class="form-label" for="enquiry-email"><?php esc_html_e( 'Email Address *', 'avideas' ); ?></label>
						<input type="email" id="enquiry-email" name="email" class="form-input" placeholder="<?php esc_attr_e( 'hello@example.com', 'avideas' ); ?>" required autocomplete="email">
					</div>

					<div class="form-group">
						<label class="form-label" for="enquiry-phone"><?php esc_html_e( 'Phone Number', 'avideas' ); ?></label>
						<input type="tel" id="enquiry-phone" name="phone" class="form-input" placeholder="<?php esc_attr_e( '0400 000 000', 'avideas' ); ?>" autocomplete="tel">
					</div>

					<div class="form-group">
						<label class="form-label" for="enquiry-service"><?php esc_html_e( 'Type of Event *', 'avideas' ); ?></label>
						<select id="enquiry-service" name="service" class="form-select" required>
							<option value=""><?php esc_html_e( '— Select event type —', 'avideas' ); ?></option>
							<?php foreach ( $services as $service ) : ?>
							<option value="<?php echo esc_attr( $service['slug'] ); ?>"><?php echo esc_html( $service['title'] ); ?></option>
							<?php endforeach; ?>
							<option value="other"><?php esc_html_e( 'Other', 'avideas' ); ?></option>
						</select>
					</div>

					<div class="form-group">
						<label class="form-label" for="enquiry-date"><?php esc_html_e( 'Event Date', 'avideas' ); ?></label>
						<input type="date" id="enquiry-date" name="event_date" class="form-input">
					</div>

					<div class="form-group">
						<label class="form-label" for="enquiry-guests"><?php esc_html_e( 'Estimated Guests', 'avideas' ); ?></label>
						<select id="enquiry-guests" name="guests" class="form-select">
							<option value=""><?php esc_html_e( '— Guest count —', 'avideas' ); ?></option>
							<option value="10">1–10</option>
							<option value="25">11–25</option>
							<option value="50">26–50</option>
							<option value="100">51–100</option>
							<option value="200">100+</option>
						</select>
					</div>

					<div class="form-group form-group--full">
						<label class="form-label" for="enquiry-message"><?php esc_html_e( 'Tell Us About Your Vision', 'avideas' ); ?></label>
						<textarea id="enquiry-message" name="message" class="form-textarea" rows="4" placeholder="<?php esc_attr_e( "Describe the theme, colours, venue, or any special requests you have in mind...", 'avideas' ); ?>"></textarea>
					</div>

					<div class="form-group form-group--full text-center">
						<button type="submit" class="btn btn--primary btn--lg" id="enquiry-submit">
							<span class="btn-text"><?php esc_html_e( 'Send My Enquiry', 'avideas' ); ?></span>
							<span class="btn-loading" style="display:none;">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 1s linear infinite;"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
								<?php esc_html_e( 'Sending...', 'avideas' ); ?>
							</span>
						</button>
						<p style="font-size:0.75rem; color:var(--clr-muted); margin-top:0.75rem;">
							<?php esc_html_e( 'We respond within 24 hours. No spam, ever.', 'avideas' ); ?>
						</p>
					</div>

				</div><!-- .form-grid -->

				<div id="form-response" style="display:none;" role="alert" aria-live="polite"></div>

			</form>
		</div><!-- .enquiry-form -->
	</div>
</section>

<!-- ============================================================
     INSTAGRAM / SOCIAL STRIP
     ============================================================ -->
<section class="section section--dark" style="padding: var(--sp-lg) 0;" aria-label="<?php esc_attr_e( 'Follow us on Instagram', 'avideas' ); ?>">
	<div class="container text-center">
		<p style="font-size:0.75rem; letter-spacing:0.18em; text-transform:uppercase; color:var(--clr-gold); font-weight:700; margin-bottom:0.5rem;">
			<?php esc_html_e( 'Follow Our Story', 'avideas' ); ?>
		</p>
		<h2 style="color:var(--clr-white); font-size:clamp(1.4rem,3vw,2rem); margin-bottom:1.5rem;">
			<?php esc_html_e( '@avideaseventstyling', 'avideas' ); ?>
		</h2>
		<a
			href="<?php echo esc_url( get_theme_mod( 'avideas_instagram', 'https://www.instagram.com/' ) ); ?>"
			class="btn btn--ghost"
			target="_blank"
			rel="noopener noreferrer"
		>
			<?php esc_html_e( 'Follow on Instagram', 'avideas' ); ?>
		</a>
	</div>
</section>

<?php get_footer(); ?>
