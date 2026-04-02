<?php
/**
 * Template Name: Contact Page
 *
 * @package Luminar Touch Events
 */

get_header();
?>

<div class="page-hero">
	<div class="container page-hero__content">
		<span class="page-hero__eyebrow"><?php esc_html_e( 'Get Your Free Quote', 'luminar' ); ?></span>
		<h1 class="page-hero__title"><?php esc_html_e( "Let's Create Something Beautiful", 'luminar' ); ?></h1>
		<nav class="page-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'luminar' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luminar' ); ?></a>
			<span aria-hidden="true"> / </span>
			<span><?php esc_html_e( 'Contact', 'luminar' ); ?></span>
		</nav>
	</div>
</div>

<section class="section section--cream">
	<div class="container">
		<div class="contact-grid">

			<!-- Contact Info -->
			<div>
				<span class="section-header__eyebrow" style="display:block; margin-bottom:0.75rem;"><?php esc_html_e( 'Contact Details', 'luminar' ); ?></span>
				<h2 style="margin-bottom:var(--sp-md);"><?php esc_html_e( 'We Would Love to Hear From You', 'luminar' ); ?></h2>
				<p style="color:var(--clr-muted); margin-bottom:var(--sp-md); line-height:1.8;">
					<?php esc_html_e( "Whether you're in the early planning stages or ready to book, Luminar Touch Events is here to help make your celebration extraordinary. Fill out the quote form and we'll be in touch within 24 hours.", 'luminar' ); ?>
				</p>

				<div class="contact-info__item">
					<div class="contact-info__icon" aria-hidden="true">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
					</div>
					<div>
						<div class="contact-info__label"><?php esc_html_e( 'Phone', 'luminar' ); ?></div>
						<a href="tel:<?php echo esc_attr( get_theme_mod( 'luminar_phone', '+61400000000' ) ); ?>" class="contact-info__value">
							<?php echo esc_html( get_theme_mod( 'luminar_phone', '+61 400 000 000' ) ); ?>
						</a>
					</div>
				</div>

				<div class="contact-info__item">
					<div class="contact-info__icon" aria-hidden="true">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
					</div>
					<div>
						<div class="contact-info__label"><?php esc_html_e( 'Email', 'luminar' ); ?></div>
						<a href="mailto:<?php echo esc_attr( get_theme_mod( 'luminar_email', 'hello@luminartouch.com.au' ) ); ?>" class="contact-info__value">
							<?php echo esc_html( get_theme_mod( 'luminar_email', 'hello@luminartouch.com.au' ) ); ?>
						</a>
					</div>
				</div>

				<div class="contact-info__item">
					<div class="contact-info__icon" aria-hidden="true">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
					</div>
					<div>
						<div class="contact-info__label"><?php esc_html_e( 'Location', 'luminar' ); ?></div>
						<div class="contact-info__value"><?php echo esc_html( get_theme_mod( 'luminar_address', 'Brisbane, QLD, Australia' ) ); ?></div>
					</div>
				</div>

				<div class="contact-info__item">
					<div class="contact-info__icon" aria-hidden="true">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm4.24 16L12 15.45 7.77 18l1.12-4.81-3.73-3.23 4.92-.42L12 5l1.92 4.53 4.92.42-3.73 3.23L16.23 18z"/></svg>
					</div>
					<div>
						<div class="contact-info__label"><?php esc_html_e( 'Hours', 'luminar' ); ?></div>
						<div class="contact-info__value">
							<?php esc_html_e( 'Mon–Fri: 9am–5pm', 'luminar' ); ?><br>
							<?php esc_html_e( 'Sat: 10am–2pm', 'luminar' ); ?>
						</div>
					</div>
				</div>

				<!-- FAQ Snippet -->
				<div style="background:var(--clr-blush); border-radius:var(--radius-lg); padding:var(--sp-md); margin-top:var(--sp-md);">
					<h3 style="font-size:1rem; margin-bottom:0.75rem;"><?php esc_html_e( 'Frequently Asked', 'luminar' ); ?></h3>
					<details style="margin-bottom:0.75rem;">
						<summary style="font-size:0.88rem; font-weight:700; cursor:pointer; color:var(--clr-dark);"><?php esc_html_e( 'How far in advance should I book?', 'luminar' ); ?></summary>
						<p style="font-size:0.85rem; color:var(--clr-muted); margin-top:0.5rem;"><?php esc_html_e( 'We recommend booking at least 4–6 weeks in advance. For weddings, 3–6 months is ideal.', 'luminar' ); ?></p>
					</details>
					<details style="margin-bottom:0.75rem;">
						<summary style="font-size:0.88rem; font-weight:700; cursor:pointer; color:var(--clr-dark);"><?php esc_html_e( 'Do you travel outside Brisbane?', 'luminar' ); ?></summary>
						<p style="font-size:0.85rem; color:var(--clr-muted); margin-top:0.5rem;"><?php esc_html_e( 'Yes! We style events across Greater Brisbane, the Gold Coast, and the Sunshine Coast. Travel fees may apply.', 'luminar' ); ?></p>
					</details>
					<details>
						<summary style="font-size:0.88rem; font-weight:700; cursor:pointer; color:var(--clr-dark);"><?php esc_html_e( 'What is your minimum spend?', 'luminar' ); ?></summary>
						<p style="font-size:0.85rem; color:var(--clr-muted); margin-top:0.5rem;"><?php esc_html_e( 'Packages start from $350. Contact us for a personalised quote based on your event and vision.', 'luminar' ); ?></p>
					</details>
				</div>

			</div>

			<!-- Enquiry Form -->
			<div>
				<div class="enquiry-form">
					<h3 style="margin-bottom:0.5rem;"><?php esc_html_e( 'Request Your Free Quote', 'luminar' ); ?></h3>
				<p style="font-size:0.88rem; color:var(--clr-muted); margin-bottom:var(--sp-md);"><?php esc_html_e( 'We respond within 24 hours. No obligation.', 'luminar' ); ?></p>

					<form id="contact-form" novalidate aria-label="<?php esc_attr_e( 'Quote request form', 'luminar' ); ?>">
						<?php wp_nonce_field( 'luminar_nonce', 'nonce' ); ?>

						<div class="form-grid">
							<div class="form-group">
								<label class="form-label" for="c-name"><?php esc_html_e( 'Full Name *', 'luminar' ); ?></label>
								<input type="text" id="c-name" name="name" class="form-input" required autocomplete="name" placeholder="Your full name">
							</div>
							<div class="form-group">
								<label class="form-label" for="c-email"><?php esc_html_e( 'Email Address *', 'luminar' ); ?></label>
								<input type="email" id="c-email" name="email" class="form-input" required autocomplete="email" placeholder="you@email.com">
							</div>
							<div class="form-group">
								<label class="form-label" for="c-phone"><?php esc_html_e( 'Phone Number *', 'luminar' ); ?></label>
								<input type="tel" id="c-phone" name="phone" class="form-input" required autocomplete="tel" placeholder="+61 400 000 000">
							</div>
							<div class="form-group">
								<label class="form-label" for="c-service"><?php esc_html_e( 'Event Type *', 'luminar' ); ?></label>
								<select id="c-service" name="service" class="form-select" required>
									<option value=""><?php esc_html_e( '— Select your event —', 'luminar' ); ?></option>
									<?php foreach ( luminar_get_services() as $svc ) : ?>
									<option value="<?php echo esc_attr( $svc['slug'] ); ?>"><?php echo esc_html( $svc['title'] ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label class="form-label" for="c-date"><?php esc_html_e( 'Event Date *', 'luminar' ); ?></label>
								<input type="date" id="c-date" name="event_date" class="form-input" required>
							</div>
							<div class="form-group">
								<label class="form-label" for="c-guests"><?php esc_html_e( 'Expected Guest Count', 'luminar' ); ?></label>
								<select id="c-guests" name="guests" class="form-select">
									<option value="">— Select —</option>
									<option value="1-10">1 – 10 guests</option>
									<option value="11-25">11 – 25 guests</option>
									<option value="26-50">26 – 50 guests</option>
									<option value="51-100">51 – 100 guests</option>
									<option value="100+">100+ guests</option>
								</select>
							</div>
							<div class="form-group form-group--full">
								<label class="form-label" for="c-venue"><?php esc_html_e( 'Venue / Location', 'luminar' ); ?></label>
								<input type="text" id="c-venue" name="venue" class="form-input" placeholder="e.g. The Grand Ballroom, Brisbane CBD or Home — Sunnybank">
							</div>
							<div class="form-group form-group--full">
								<label class="form-label" for="c-budget"><?php esc_html_e( 'Approximate Budget', 'luminar' ); ?></label>
								<select id="c-budget" name="budget" class="form-select">
									<option value="">— Select your budget range —</option>
									<option value="under-500">Under $500</option>
									<option value="500-1500">$500 – $1,500</option>
									<option value="1500-3000">$1,500 – $3,000</option>
									<option value="3000-5000">$3,000 – $5,000</option>
									<option value="5000+">$5,000+</option>
								</select>
							</div>
							<div class="form-group form-group--full">
								<label class="form-label" for="c-message"><?php esc_html_e( 'Describe Your Event Vision', 'luminar' ); ?></label>
								<textarea id="c-message" name="message" class="form-textarea" rows="6" placeholder="<?php esc_attr_e( 'Tell us your theme, colour palette, inspiration, special requests... the more detail the better!', 'luminar' ); ?>"></textarea>
							</div>
							<div class="form-group form-group--full text-center">
								<button type="submit" class="btn btn--primary btn--lg" style="min-width:220px;">
									<?php esc_html_e( 'Request My Free Quote →', 'luminar' ); ?>
								</button>
								<p style="font-size:0.8rem; color:var(--clr-muted); margin-top:0.75rem;">&#x1F512; Your details are safe with us. We never share your information.</p>
							</div>
						</div>
						<div id="contact-response" style="display:none;" role="alert" aria-live="polite"></div>
					</form>
				</div>
			</div>

		</div>
	</div>
</section>

<?php get_footer(); ?>
