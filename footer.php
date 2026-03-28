</main><!-- #main-content -->

<!-- ============================================================
     SITE FOOTER
     ============================================================ -->
<footer id="site-footer" class="site-footer" role="contentinfo">
	<div class="container">

		<!-- Footer Top -->
		<div class="footer-top">

			<!-- Brand Column -->
			<div class="footer-brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-brand__logo">
					<?php bloginfo( 'name' ); ?>
				</a>
				<p class="footer-brand__tagline"><?php esc_html_e( 'Event Styling · Brisbane', 'avideas' ); ?></p>
				<p class="footer-brand__desc">
					<?php esc_html_e( "Brisbane's most trusted event styling studio. We transform ordinary spaces into extraordinary memories — one celebration at a time.", 'avideas' ); ?>
				</p>
				<div class="footer-social">
					<?php
					$instagram = get_theme_mod( 'avideas_instagram', '#' );
					$facebook  = get_theme_mod( 'avideas_facebook', '#' );
					?>
					<a href="<?php echo esc_url( $instagram ); ?>" class="footer-social__link" aria-label="<?php esc_attr_e( 'Instagram', 'avideas' ); ?>" <?php echo ( $instagram !== '#' ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
					</a>
					<a href="<?php echo esc_url( $facebook ); ?>" class="footer-social__link" aria-label="<?php esc_attr_e( 'Facebook', 'avideas' ); ?>" <?php echo ( $facebook !== '#' ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
					</a>
					<a href="mailto:<?php echo esc_attr( get_theme_mod( 'avideas_email', 'hello@avideas.com.au' ) ); ?>" class="footer-social__link" aria-label="<?php esc_attr_e( 'Email us', 'avideas' ); ?>">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
					</a>
				</div>
			</div>

			<!-- Services Column -->
			<div class="footer-col">
				<h4 class="footer-col__title"><?php esc_html_e( 'Our Services', 'avideas' ); ?></h4>
				<ul class="footer-col__list">
					<li><a href="<?php echo esc_url( home_url( '/services/baby-shower/' ) ); ?>"><?php esc_html_e( 'Baby Shower Styling', 'avideas' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/bridal-shower/' ) ); ?>"><?php esc_html_e( 'Bridal Shower Styling', 'avideas' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/gender-reveal/' ) ); ?>"><?php esc_html_e( 'Gender Reveal Parties', 'avideas' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/graduation/' ) ); ?>"><?php esc_html_e( 'Graduation Celebrations', 'avideas' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/citizenship/' ) ); ?>"><?php esc_html_e( 'Citizenship Ceremonies', 'avideas' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/wedding/' ) ); ?>"><?php esc_html_e( 'Wedding Styling', 'avideas' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/dinner-party/' ) ); ?>"><?php esc_html_e( 'Dinner Party Styling', 'avideas' ); ?></a></li>
				</ul>
			</div>

			<!-- Company Column -->
			<div class="footer-col">
				<h4 class="footer-col__title"><?php esc_html_e( 'Company', 'avideas' ); ?></h4>
				<ul class="footer-col__list">
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'avideas' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>"><?php esc_html_e( 'Gallery', 'avideas' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog & Inspiration', 'avideas' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'FAQ', 'avideas' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'avideas' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'avideas' ); ?></a></li>
				</ul>
			</div>

			<!-- Contact Column -->
			<div class="footer-col">
				<h4 class="footer-col__title"><?php esc_html_e( 'Get In Touch', 'avideas' ); ?></h4>

				<div class="footer-contact__item">
					<span class="footer-contact__icon" aria-hidden="true">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
					</span>
					<div>
						<div class="footer-contact__label"><?php esc_html_e( 'Phone', 'avideas' ); ?></div>
						<a href="tel:<?php echo esc_attr( get_theme_mod( 'avideas_phone', '+61400000000' ) ); ?>" class="footer-contact__value">
							<?php echo esc_html( get_theme_mod( 'avideas_phone', '+61 400 000 000' ) ); ?>
						</a>
					</div>
				</div>

				<div class="footer-contact__item">
					<span class="footer-contact__icon" aria-hidden="true">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
					</span>
					<div>
						<div class="footer-contact__label"><?php esc_html_e( 'Email', 'avideas' ); ?></div>
						<a href="mailto:<?php echo esc_attr( get_theme_mod( 'avideas_email', 'hello@avideas.com.au' ) ); ?>" class="footer-contact__value">
							<?php echo esc_html( get_theme_mod( 'avideas_email', 'hello@avideas.com.au' ) ); ?>
						</a>
					</div>
				</div>

				<div class="footer-contact__item">
					<span class="footer-contact__icon" aria-hidden="true">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
					</span>
					<div>
						<div class="footer-contact__label"><?php esc_html_e( 'Location', 'avideas' ); ?></div>
						<div class="footer-contact__value"><?php echo esc_html( get_theme_mod( 'avideas_address', 'Brisbane, QLD, Australia' ) ); ?></div>
					</div>
				</div>

			</div><!-- .footer-col -->

		</div><!-- .footer-top -->

		<!-- Footer Bottom -->
		<div class="footer-bottom">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'avideas' ); ?></p>
			<p>
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'avideas' ); ?></a>
				&nbsp;&bull;&nbsp;
				<a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms', 'avideas' ); ?></a>
				&nbsp;&bull;&nbsp;
				<span><?php esc_html_e( 'Proudly based in Brisbane, Australia', 'avideas' ); ?></span>
			</p>
		</div>

	</div><!-- .container -->
</footer><!-- #site-footer -->

<!-- Lightbox Overlay -->
<div id="lightbox-overlay" class="lightbox-overlay" aria-modal="true" role="dialog" aria-label="<?php esc_attr_e( 'Image viewer', 'avideas' ); ?>" aria-hidden="true">
	<button class="lightbox-close" aria-label="<?php esc_attr_e( 'Close image viewer', 'avideas' ); ?>">&times;</button>
	<img id="lightbox-img" class="lightbox-img" src="" alt="" loading="lazy">
</div>

<?php wp_footer(); ?>
</body>
</html>
