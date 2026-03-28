<?php
/**
 * Template Name: Contact Page
 *
 * @package Avideas
 */

get_header();
?>

<div class="page-hero">
	<div class="container page-hero__content">
		<span class="page-hero__eyebrow"><?php esc_html_e( 'Get In Touch', 'avideas' ); ?></span>
		<h1 class="page-hero__title"><?php esc_html_e( "Let's Plan Your Event", 'avideas' ); ?></h1>
		<nav class="page-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'avideas' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'avideas' ); ?></a>
			<span aria-hidden="true"> / </span>
			<span><?php esc_html_e( 'Contact', 'avideas' ); ?></span>
		</nav>
	</div>
</div>

<section class="section section--cream">
	<div class="container">
		<div class="contact-grid">

			<!-- Contact Info -->
			<div>
				<span class="section-header__eyebrow" style="display:block; margin-bottom:0.75rem;"><?php esc_html_e( 'Contact Details', 'avideas' ); ?></span>
				<h2 style="margin-bottom:var(--sp-md);"><?php esc_html_e( 'We Would Love to Hear From You', 'avideas' ); ?></h2>
				<p style="color:var(--clr-muted); margin-bottom:var(--sp-md); line-height:1.8;">
					<?php esc_html_e( "Whether you're in the early planning stages or ready to book, we're here to help make your event extraordinary. Reach out and let's start creating magic.", 'avideas' ); ?>
				</p>

				<div class="contact-info__item">
					<div class="contact-info__icon" aria-hidden="true">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
					</div>
					<div>
						<div class="contact-info__label"><?php esc_html_e( 'Phone', 'avideas' ); ?></div>
						<a href="tel:<?php echo esc_attr( get_theme_mod( 'avideas_phone', '+61400000000' ) ); ?>" class="contact-info__value">
							<?php echo esc_html( get_theme_mod( 'avideas_phone', '+61 400 000 000' ) ); ?>
						</a>
					</div>
				</div>

				<div class="contact-info__item">
					<div class="contact-info__icon" aria-hidden="true">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
					</div>
					<div>
						<div class="contact-info__label"><?php esc_html_e( 'Email', 'avideas' ); ?></div>
						<a href="mailto:<?php echo esc_attr( get_theme_mod( 'avideas_email', 'hello@avideas.com.au' ) ); ?>" class="contact-info__value">
							<?php echo esc_html( get_theme_mod( 'avideas_email', 'hello@avideas.com.au' ) ); ?>
						</a>
					</div>
				</div>

				<div class="contact-info__item">
					<div class="contact-info__icon" aria-hidden="true">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
					</div>
					<div>
						<div class="contact-info__label"><?php esc_html_e( 'Location', 'avideas' ); ?></div>
						<div class="contact-info__value"><?php echo esc_html( get_theme_mod( 'avideas_address', 'Brisbane, QLD, Australia' ) ); ?></div>
					</div>
				</div>

				<div class="contact-info__item">
					<div class="contact-info__icon" aria-hidden="true">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm4.24 16L12 15.45 7.77 18l1.12-4.81-3.73-3.23 4.92-.42L12 5l1.92 4.53 4.92.42-3.73 3.23L16.23 18z"/></svg>
					</div>
					<div>
						<div class="contact-info__label"><?php esc_html_e( 'Hours', 'avideas' ); ?></div>
						<div class="contact-info__value">
							<?php esc_html_e( 'Mon–Fri: 9am–5pm', 'avideas' ); ?><br>
							<?php esc_html_e( 'Sat: 10am–2pm', 'avideas' ); ?>
						</div>
					</div>
				</div>

				<!-- FAQ Snippet -->
				<div style="background:var(--clr-blush); border-radius:var(--radius-lg); padding:var(--sp-md); margin-top:var(--sp-md);">
					<h3 style="font-size:1rem; margin-bottom:0.75rem;"><?php esc_html_e( 'Frequently Asked', 'avideas' ); ?></h3>
					<details style="margin-bottom:0.75rem;">
						<summary style="font-size:0.88rem; font-weight:700; cursor:pointer; color:var(--clr-dark);"><?php esc_html_e( 'How far in advance should I book?', 'avideas' ); ?></summary>
						<p style="font-size:0.85rem; color:var(--clr-muted); margin-top:0.5rem;"><?php esc_html_e( 'We recommend booking at least 4–6 weeks in advance. For weddings, 3–6 months is ideal.', 'avideas' ); ?></p>
					</details>
					<details style="margin-bottom:0.75rem;">
						<summary style="font-size:0.88rem; font-weight:700; cursor:pointer; color:var(--clr-dark);"><?php esc_html_e( 'Do you travel outside Brisbane?', 'avideas' ); ?></summary>
						<p style="font-size:0.85rem; color:var(--clr-muted); margin-top:0.5rem;"><?php esc_html_e( 'Yes! We style events across Greater Brisbane, the Gold Coast, and the Sunshine Coast. Travel fees may apply.', 'avideas' ); ?></p>
					</details>
					<details>
						<summary style="font-size:0.88rem; font-weight:700; cursor:pointer; color:var(--clr-dark);"><?php esc_html_e( 'What is your minimum spend?', 'avideas' ); ?></summary>
						<p style="font-size:0.85rem; color:var(--clr-muted); margin-top:0.5rem;"><?php esc_html_e( 'Packages start from $350. Contact us for a personalised quote based on your event and vision.', 'avideas' ); ?></p>
					</details>
				</div>

			</div>

			<!-- Enquiry Form -->
			<div>
				<div class="enquiry-form">
					<h3 style="margin-bottom:var(--sp-md);"><?php esc_html_e( 'Send Us a Message', 'avideas' ); ?></h3>

					<form id="contact-form" novalidate aria-label="<?php esc_attr_e( 'Contact form', 'avideas' ); ?>">
						<?php wp_nonce_field( 'avideas_nonce', 'nonce' ); ?>

						<div class="form-grid">
							<div class="form-group">
								<label class="form-label" for="c-name"><?php esc_html_e( 'Full Name *', 'avideas' ); ?></label>
								<input type="text" id="c-name" name="name" class="form-input" required autocomplete="name">
							</div>
							<div class="form-group">
								<label class="form-label" for="c-email"><?php esc_html_e( 'Email *', 'avideas' ); ?></label>
								<input type="email" id="c-email" name="email" class="form-input" required autocomplete="email">
							</div>
							<div class="form-group">
								<label class="form-label" for="c-phone"><?php esc_html_e( 'Phone', 'avideas' ); ?></label>
								<input type="tel" id="c-phone" name="phone" class="form-input" autocomplete="tel">
							</div>
							<div class="form-group">
								<label class="form-label" for="c-service"><?php esc_html_e( 'Event Type', 'avideas' ); ?></label>
								<select id="c-service" name="service" class="form-select">
									<option value=""><?php esc_html_e( '— Select —', 'avideas' ); ?></option>
									<?php foreach ( avideas_get_services() as $service ) : ?>
									<option value="<?php echo esc_attr( $service['slug'] ); ?>"><?php echo esc_html( $service['title'] ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label class="form-label" for="c-date"><?php esc_html_e( 'Event Date', 'avideas' ); ?></label>
								<input type="date" id="c-date" name="event_date" class="form-input">
							</div>
							<div class="form-group">
								<label class="form-label" for="c-guests"><?php esc_html_e( 'Guests', 'avideas' ); ?></label>
								<select id="c-guests" name="guests" class="form-select">
									<option value="">—</option>
									<option value="10">1–10</option>
									<option value="25">11–25</option>
									<option value="50">26–50</option>
									<option value="100">51–100</option>
									<option value="200">100+</option>
								</select>
							</div>
							<div class="form-group form-group--full">
								<label class="form-label" for="c-message"><?php esc_html_e( 'Message', 'avideas' ); ?></label>
								<textarea id="c-message" name="message" class="form-textarea" rows="5" placeholder="<?php esc_attr_e( 'Tell us about your event vision...', 'avideas' ); ?>"></textarea>
							</div>
							<div class="form-group form-group--full text-center">
								<button type="submit" class="btn btn--primary btn--lg">
									<?php esc_html_e( 'Send Message', 'avideas' ); ?>
								</button>
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
