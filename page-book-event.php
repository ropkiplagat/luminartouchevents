<?php
/**
 * Template Name: Book an Event
 *
 * Multi-step event booking planner.
 * Step 1: Choose event type
 * Step 2: Guest count + venue + your details
 * Step 3: Select items (priced per-person / per-table / flat)
 * Step 4: Review estimate + book Calendly consultation
 *
 * @package Luminar Touch Events
 */

get_header();
?>

<div class="page-hero page-hero--short">
	<div class="container page-hero__content">
		<span class="page-hero__eyebrow"><?php esc_html_e( 'Let\'s Plan Together', 'luminar' ); ?></span>
		<h1 class="page-hero__title"><?php esc_html_e( 'Book Your Event', 'luminar' ); ?></h1>
		<nav class="page-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'luminar' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luminar' ); ?></a>
			<span aria-hidden="true"> / </span>
			<span><?php esc_html_e( 'Book an Event', 'luminar' ); ?></span>
		</nav>
	</div>
</div>

<section class="section section--cream">
	<div class="container">

		<!-- PROGRESS BAR -->
		<div class="lb-progress" id="lbProgress" aria-label="<?php esc_attr_e( 'Booking steps', 'luminar' ); ?>">
			<div class="lb-progress__track">
				<div class="lb-progress__fill" id="lbProgressFill" style="width:25%"></div>
			</div>
			<div class="lb-progress__steps">
				<button class="lb-step-btn lb-step-btn--active" data-step="1" aria-label="Step 1: Choose event">
					<span class="lb-step-btn__num">1</span>
					<span class="lb-step-btn__label">Event</span>
				</button>
				<button class="lb-step-btn" data-step="2" aria-label="Step 2: Your details">
					<span class="lb-step-btn__num">2</span>
					<span class="lb-step-btn__label">Details</span>
				</button>
				<button class="lb-step-btn" data-step="3" aria-label="Step 3: Choose items">
					<span class="lb-step-btn__num">3</span>
					<span class="lb-step-btn__label">Items</span>
				</button>
				<button class="lb-step-btn" data-step="4" aria-label="Step 4: Review and book">
					<span class="lb-step-btn__num">4</span>
					<span class="lb-step-btn__label">Book</span>
				</button>
			</div>
		</div>

		<!-- STEP WRAPPER -->
		<div class="lb-steps">

			<!-- ====== STEP 1: CHOOSE EVENT TYPE ====== -->
			<div class="lb-step" id="lbStep1" data-step="1">
				<div class="lb-step__header">
					<h2>What are you celebrating?</h2>
					<p>Choose your event type and we'll show you everything we can do to make it extraordinary.</p>
				</div>

				<div class="lb-event-grid" id="lbEventGrid">
					<div class="lb-loading">
						<span class="lb-spinner"></span>
						<span>Loading events…</span>
					</div>
				</div>

				<div class="lb-step__footer">
					<button class="btn btn--primary btn--lg" id="lbStep1Next" disabled>
						Continue <span aria-hidden="true">→</span>
					</button>
				</div>
			</div>

			<!-- ====== STEP 2: EVENT DETAILS ====== -->
			<div class="lb-step lb-step--hidden" id="lbStep2" data-step="2">
				<div class="lb-step__header">
					<h2>Tell us about your event</h2>
					<p>We use this to calculate accurate pricing and personalise your package.</p>
				</div>

				<form class="lb-form" id="lbDetailsForm" novalidate>

					<div class="lb-form__row lb-form__row--2">
						<div class="lb-field">
							<label class="lb-label" for="lbGuests">
								Number of Guests <span class="lb-required">*</span>
							</label>
							<input class="lb-input" type="number" id="lbGuests" name="guests"
								min="1" max="5000" placeholder="e.g. 80" required />
						</div>
						<div class="lb-field">
							<label class="lb-label" for="lbVenue">
								Venue Type <span class="lb-required">*</span>
							</label>
							<select class="lb-input" id="lbVenue" name="venue" required>
								<option value="">— Select venue —</option>
								<option value="Hotel ballroom">Hotel Ballroom</option>
								<option value="Garden / outdoor">Garden / Outdoor</option>
								<option value="Church">Church</option>
								<option value="Home / backyard">Home / Backyard</option>
								<option value="Function centre">Function Centre</option>
								<option value="Restaurant / cafe">Restaurant / Café</option>
								<option value="Other">Other</option>
							</select>
						</div>
					</div>

					<div class="lb-form__row lb-form__row--2">
						<div class="lb-field">
							<label class="lb-label" for="lbEventDate">
								Event Date <span class="lb-required">*</span>
							</label>
							<input class="lb-input" type="date" id="lbEventDate" name="event_date" required />
						</div>
						<div class="lb-field">
							<label class="lb-label" for="lbName">
								Your Name <span class="lb-required">*</span>
							</label>
							<input class="lb-input" type="text" id="lbName" name="name"
								placeholder="First &amp; last name" required />
						</div>
					</div>

					<div class="lb-form__row lb-form__row--2">
						<div class="lb-field">
							<label class="lb-label" for="lbEmail">
								Email Address <span class="lb-required">*</span>
							</label>
							<input class="lb-input" type="email" id="lbEmail" name="email"
								placeholder="you@example.com" required />
						</div>
						<div class="lb-field">
							<label class="lb-label" for="lbPhone">Phone Number</label>
							<input class="lb-input" type="tel" id="lbPhone" name="phone"
								placeholder="04xx xxx xxx" />
						</div>
					</div>

					<div class="lb-step__footer">
						<button type="button" class="btn btn--ghost" id="lbStep2Back">
							<span aria-hidden="true">←</span> Back
						</button>
						<button type="submit" class="btn btn--primary btn--lg" id="lbStep2Next">
							Choose Items <span aria-hidden="true">→</span>
						</button>
					</div>
				</form>
			</div>

			<!-- ====== STEP 3: SELECT ITEMS ====== -->
			<div class="lb-step lb-step--hidden" id="lbStep3" data-step="3">
				<div class="lb-step__header">
					<h2 id="lbStep3Title">Build your package</h2>
					<p id="lbStep3Subtitle">Tick the items you'd like. Prices are calculated automatically based on your guest count.</p>
				</div>

				<div id="lbItemsWrap">
					<div class="lb-loading">
						<span class="lb-spinner"></span>
						<span>Loading items…</span>
					</div>
				</div>

				<!-- Sticky total bar -->
				<div class="lb-total-bar" id="lbTotalBar" aria-live="polite">
					<div class="lb-total-bar__inner">
						<span class="lb-total-bar__label">Estimated Total</span>
						<span class="lb-total-bar__amount" id="lbTotalAmount">$0.00</span>
						<span class="lb-total-bar__note">*Estimate only. Final quote confirmed at consultation.</span>
					</div>
				</div>

				<div class="lb-step__footer">
					<button type="button" class="btn btn--ghost" id="lbStep3Back">
						<span aria-hidden="true">←</span> Back
					</button>
					<button type="button" class="btn btn--primary btn--lg" id="lbStep3Next">
						Review &amp; Book <span aria-hidden="true">→</span>
					</button>
				</div>
			</div>

			<!-- ====== STEP 4: REVIEW + CALENDLY ====== -->
			<div class="lb-step lb-step--hidden" id="lbStep4" data-step="4">
				<div class="lb-step__header">
					<h2>Review Your Package</h2>
					<p>Here's your event summary. Send your enquiry, then book a free consultation with our team.</p>
				</div>

				<div class="lb-review" id="lbReview">
					<!-- Populated by JS -->
				</div>

				<div class="lb-submit-wrap" id="lbSubmitWrap">
					<button type="button" class="btn btn--primary btn--lg btn--full" id="lbSubmitBtn">
						Send Enquiry &amp; Book Consultation
					</button>
					<p class="lb-submit-note">We'll send you a confirmation email and you can then book a free Calendly consultation below.</p>
					<div id="lbSubmitMsg" class="lb-msg" aria-live="polite" hidden></div>
				</div>

				<!-- Calendly embed — shown after submit -->
				<div class="lb-calendly-wrap" id="lbCalendlyWrap" hidden>
					<div class="lb-calendly-header">
						<span class="lb-divider-icon">📅</span>
						<h3>Book Your Free Consultation</h3>
						<p>Pick a time that suits you and we'll walk through your package together.</p>
					</div>
					<div id="lbCalendlyWidget" class="lb-calendly-widget"></div>
				</div>

				<div class="lb-step__footer" id="lbStep4Footer">
					<button type="button" class="btn btn--ghost" id="lbStep4Back">
						<span aria-hidden="true">←</span> Back
					</button>
				</div>
			</div>

		</div><!-- /.lb-steps -->

	</div><!-- /.container -->
</section>

<?php get_footer(); ?>
