<?php
/**
 * Luminar Touch Events — functions.php
 *
 * @package Luminar Touch Events
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AVIDEAS_VERSION', '1.0.0' );

/* ============================================================
   SMTP CONFIGURATION — SiteGround hosted email
   ============================================================ */
add_action( 'phpmailer_init', 'luminar_smtp_config' );
function luminar_smtp_config( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host       = defined( 'LUMINAR_SMTP_HOST' ) ? LUMINAR_SMTP_HOST : 'mail.luminartouchevents.com';
	$phpmailer->SMTPAuth   = true;
	$phpmailer->Port       = 465;
	$phpmailer->SMTPSecure = 'ssl';
	$phpmailer->Username   = defined( 'LUMINAR_SMTP_USER' ) ? LUMINAR_SMTP_USER : 'enquiries@luminartouchevents.com';
	$phpmailer->Password   = defined( 'LUMINAR_SMTP_PASS' ) ? LUMINAR_SMTP_PASS : '';
	$phpmailer->From       = 'enquiries@luminartouchevents.com';
	$phpmailer->FromName   = 'Luminar Touch Events';
}
define( 'LUMINAR_DIR', get_template_directory() );
define( 'LUMINAR_URI', get_template_directory_uri() );

/* ============================================================
   THEME SETUP
   ============================================================ */
function luminar_setup() {
	load_theme_textdomain( 'luminar', LUMINAR_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [
		'search-form', 'comment-form', 'comment-list',
		'gallery', 'caption', 'style', 'script',
	] );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	// Custom logo
	add_theme_support( 'custom-logo', [
		'height'      => 80,
		'width'       => 220,
		'flex-height' => true,
		'flex-width'  => true,
	] );

	// Image sizes
	add_image_size( 'avideas-hero',    1920, 1080, true );
	add_image_size( 'avideas-service', 800,  600,  true );
	add_image_size( 'avideas-thumb',   600,  450,  true );
	add_image_size( 'avideas-square',  600,  600,  true );
	add_image_size( 'avideas-portrait',400,  600,  true );

	// Navigation menus
	register_nav_menus( [
		'primary'  => esc_html__( 'Primary Menu', 'luminar' ),
		'footer-1' => esc_html__( 'Footer Services', 'luminar' ),
		'footer-2' => esc_html__( 'Footer Company', 'luminar' ),
	] );
}
add_action( 'after_setup_theme', 'luminar_setup' );

/* ============================================================
   SCRIPTS & STYLES
   ============================================================ */
function luminar_enqueue_assets() {
	// Google Fonts
	wp_enqueue_style(
		'avideas-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap',
		[],
		null
	);

	// Main stylesheet
	wp_enqueue_style(
		'avideas-style',
		get_stylesheet_uri(),
		[ 'avideas-fonts' ],
		AVIDEAS_VERSION
	);

	// Main JS
	wp_enqueue_script(
		'avideas-main',
		LUMINAR_URI . '/assets/js/main.js',
		[],
		AVIDEAS_VERSION,
		true
	);

	// Localise script
	wp_localize_script( 'avideas-main', 'luminarData', [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'luminar_nonce' ),
		'homeUrl' => esc_url( home_url( '/' ) ),
	] );

	// Comment reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'luminar_enqueue_assets' );

/* ============================================================
   WIDGETS & SIDEBARS
   ============================================================ */
function luminar_widgets_init() {
	register_sidebar( [
		'name'          => esc_html__( 'Blog Sidebar', 'luminar' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Widgets in this area will be shown on blog posts.', 'luminar' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	] );

	register_sidebar( [
		'name'          => esc_html__( 'Footer Widget Area', 'luminar' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Footer widget area.', 'luminar' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-widget__title">',
		'after_title'   => '</h4>',
	] );
}
add_action( 'widgets_init', 'luminar_widgets_init' );

/* ============================================================
   CUSTOM POST TYPES
   ============================================================ */
function luminar_register_post_types() {
	// Services CPT
	register_post_type( 'service', [
		'labels' => [
			'name'               => esc_html__( 'Services', 'luminar' ),
			'singular_name'      => esc_html__( 'Service', 'luminar' ),
			'add_new_item'       => esc_html__( 'Add New Service', 'luminar' ),
			'edit_item'          => esc_html__( 'Edit Service', 'luminar' ),
			'view_item'          => esc_html__( 'View Service', 'luminar' ),
			'search_items'       => esc_html__( 'Search Services', 'luminar' ),
			'not_found'          => esc_html__( 'No services found.', 'luminar' ),
		],
		'public'        => true,
		'has_archive'   => true,
		'menu_icon'     => 'dashicons-star-filled',
		'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
		'rewrite'       => [ 'slug' => 'services' ],
		'show_in_rest'  => true,
	] );

	// Gallery CPT
	register_post_type( 'gallery_item', [
		'labels' => [
			'name'          => esc_html__( 'Gallery', 'luminar' ),
			'singular_name' => esc_html__( 'Gallery Item', 'luminar' ),
			'add_new_item'  => esc_html__( 'Add Gallery Item', 'luminar' ),
		],
		'public'       => true,
		'has_archive'  => false,
		'menu_icon'    => 'dashicons-format-gallery',
		'supports'     => [ 'title', 'thumbnail', 'custom-fields' ],
		'show_in_rest' => true,
	] );

	// Testimonials CPT
	register_post_type( 'testimonial', [
		'labels' => [
			'name'          => esc_html__( 'Testimonials', 'luminar' ),
			'singular_name' => esc_html__( 'Testimonial', 'luminar' ),
			'add_new_item'  => esc_html__( 'Add Testimonial', 'luminar' ),
		],
		'public'       => false,
		'show_ui'      => true,
		'menu_icon'    => 'dashicons-format-quote',
		'supports'     => [ 'title', 'editor', 'custom-fields' ],
		'show_in_rest' => true,
	] );
}
add_action( 'init', 'luminar_register_post_types' );

/* ============================================================
   TAXONOMIES
   ============================================================ */
function luminar_register_taxonomies() {
	register_taxonomy( 'service_category', [ 'service' ], [
		'labels' => [
			'name'          => esc_html__( 'Service Categories', 'luminar' ),
			'singular_name' => esc_html__( 'Service Category', 'luminar' ),
		],
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite'      => [ 'slug' => 'service-category' ],
	] );

	register_taxonomy( 'gallery_category', [ 'gallery_item' ], [
		'labels' => [
			'name'          => esc_html__( 'Gallery Categories', 'luminar' ),
			'singular_name' => esc_html__( 'Gallery Category', 'luminar' ),
		],
		'hierarchical' => false,
		'show_in_rest' => true,
		'rewrite'      => [ 'slug' => 'gallery-category' ],
	] );
}
add_action( 'init', 'luminar_register_taxonomies' );

/* ============================================================
   SEO & META TAGS
   ============================================================ */
function luminar_seo_meta() {
	global $post;

	$site_name    = get_bloginfo( 'name' );
	$description  = get_bloginfo( 'description' );
	$canonical    = get_permalink();
	$og_image     = '';

	if ( is_singular() && has_post_thumbnail() ) {
		$og_image = get_the_post_thumbnail_url( $post->ID, 'avideas-hero' );
	} elseif ( is_front_page() ) {
		$og_image  = LUMINAR_URI . '/assets/images/Luminar Touch Ebvents Logo.jpeg';
		$canonical = home_url( '/' );
		$description = 'Luminar Touch Events — Brisbane event stylist for baby showers, weddings, gender reveals, graduations &amp; more. Bespoke styling. Free quote within 24 hours.';
	}

	if ( is_singular() ) {
		$description = has_excerpt() ? get_the_excerpt() : $description;
		if ( ! $og_image ) {
			$og_image = LUMINAR_URI . '/assets/images/og-default.jpg';
		}
	}

	$description = wp_strip_all_tags( $description );
	$description = esc_attr( mb_substr( $description, 0, 155 ) );
	?>
	<meta name="description" content="<?php echo $description; ?>">
	<meta name="author" content="Luminar Touch Events">
	<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large">
	<link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">

	<!-- Open Graph -->
	<meta property="og:type"        content="website">
	<meta property="og:site_name"   content="<?php echo esc_attr( $site_name ); ?>">
	<meta property="og:title"       content="<?php wp_title( '|', true, 'right' ); echo esc_attr( $site_name ); ?>">
	<meta property="og:description" content="<?php echo $description; ?>">
	<meta property="og:url"         content="<?php echo esc_url( $canonical ); ?>">
	<?php if ( $og_image ) : ?>
	<meta property="og:image"       content="<?php echo esc_url( $og_image ); ?>">
	<meta property="og:image:width"  content="1200">
	<meta property="og:image:height" content="630">
	<?php endif; ?>

	<!-- Twitter Card -->
	<meta name="twitter:card"        content="summary_large_image">
	<meta name="twitter:title"       content="<?php the_title(); ?>">
	<meta name="twitter:description" content="<?php echo $description; ?>">
	<?php if ( $og_image ) : ?>
	<meta name="twitter:image"       content="<?php echo esc_url( $og_image ); ?>">
	<?php endif; ?>
	<?php
}
add_action( 'wp_head', 'luminar_seo_meta', 1 );

/* ============================================================
   STRUCTURED DATA / SCHEMA
   ============================================================ */
function luminar_schema_markup() {
	if ( is_front_page() || is_home() ) {
		$schema = [
			'@context'        => 'https://schema.org',
			'@type'           => 'EventPlanningService',
			'name'            => 'Luminar Touch Events',
			'url'             => home_url( '/' ),
			'logo'            => LUMINAR_URI . '/assets/images/Luminar Touch Ebvents Logo.jpeg',
			'image'           => LUMINAR_URI . '/assets/images/Wedding deco.png',
			'description'     => 'Luminar Touch Events — Brisbane event stylist specialising in baby showers, bridal showers, gender reveals, graduation parties, citizenship ceremonies, weddings and dinner parties.',
			'telephone'       => get_theme_mod( 'luminar_phone', '+61400000000' ),
			'email'           => get_theme_mod( 'luminar_email', 'hello@luminartouchevents.com.au' ),
			'priceRange'      => '$$',
			'currenciesAccepted' => 'AUD',
			'paymentAccepted' => 'Cash, Credit Card, Bank Transfer',
			'address'         => [
				'@type'           => 'PostalAddress',
				'streetAddress'   => get_theme_mod( 'luminar_address', 'Brisbane' ),
				'addressLocality' => 'Brisbane',
				'addressRegion'   => 'QLD',
				'postalCode'      => '4000',
				'addressCountry'  => 'AU',
			],
			'geo' => [
				'@type'     => 'GeoCoordinates',
				'latitude'  => '-27.4698',
				'longitude' => '153.0251',
			],
			'areaServed' => [
				'@type' => 'City',
				'name'  => 'Brisbane',
			],
			'openingHoursSpecification' => [
				[
					'@type'     => 'OpeningHoursSpecification',
					'dayOfWeek' => [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ],
					'opens'     => '09:00',
					'closes'    => '17:00',
				],
				[
					'@type'     => 'OpeningHoursSpecification',
					'dayOfWeek' => 'Saturday',
					'opens'     => '10:00',
					'closes'    => '14:00',
				],
			],
			'sameAs' => [
				get_theme_mod( 'luminar_instagram', 'https://www.instagram.com/luminartouchevents' ),
				get_theme_mod( 'luminar_facebook',  'https://www.facebook.com/luminartouchevents' ),
			],
			'hasOfferCatalog' => [
				'@type' => 'OfferCatalog',
				'name'  => 'Event Styling Services',
				'itemListElement' => [
					[ '@type' => 'Offer', 'itemOffered' => [ '@type' => 'Service', 'name' => 'Baby Shower Styling', 'areaServed' => 'Brisbane' ] ],
					[ '@type' => 'Offer', 'itemOffered' => [ '@type' => 'Service', 'name' => 'Bridal Shower Styling', 'areaServed' => 'Brisbane' ] ],
					[ '@type' => 'Offer', 'itemOffered' => [ '@type' => 'Service', 'name' => 'Gender Reveal Party Styling', 'areaServed' => 'Brisbane' ] ],
					[ '@type' => 'Offer', 'itemOffered' => [ '@type' => 'Service', 'name' => 'Graduation Party Styling', 'areaServed' => 'Brisbane' ] ],
					[ '@type' => 'Offer', 'itemOffered' => [ '@type' => 'Service', 'name' => 'Citizenship Ceremony Styling', 'areaServed' => 'Brisbane' ] ],
					[ '@type' => 'Offer', 'itemOffered' => [ '@type' => 'Service', 'name' => 'Wedding Styling', 'areaServed' => 'Brisbane' ] ],
					[ '@type' => 'Offer', 'itemOffered' => [ '@type' => 'Service', 'name' => 'Dinner Party Styling', 'areaServed' => 'Brisbane' ] ],
				],
			],
		];
		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";

		// FAQ Schema — eligible for Google rich results
		$faq_schema = [
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => [
				[
					'@type'          => 'Question',
					'name'           => 'What event styling services does Luminar Touch Events offer in Brisbane?',
					'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Luminar Touch Events offers baby shower styling, bridal shower styling, gender reveal parties, graduation celebrations, citizenship ceremony styling, wedding styling, and dinner party styling across Brisbane and the Gold Coast.' ],
				],
				[
					'@type'          => 'Question',
					'name'           => 'How far in advance should I book my event stylist?',
					'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'We recommend booking at least 4–6 weeks in advance for most events. For weddings, 3–6 months is ideal to secure your preferred date and allow time for custom design work.' ],
				],
				[
					'@type'          => 'Question',
					'name'           => 'How much does event styling cost in Brisbane?',
					'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Styling packages start from $350 depending on the event type, guest count, and design complexity. We provide a free personalised quote within 24 hours — simply fill out our quote form.' ],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Does Luminar Touch Events travel outside Brisbane?',
					'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Yes! We style events across Greater Brisbane, the Gold Coast, and the Sunshine Coast. Travel fees may apply for locations outside the Brisbane metro area.' ],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Can I see examples of your event styling work?',
					'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Absolutely. Visit our Gallery page to see photos from real events we have styled across Brisbane — including baby showers, weddings, graduations, and gender reveals.' ],
				],
			],
		];
		echo '<script type="application/ld+json">' . wp_json_encode( $faq_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
	}

	if ( is_singular( 'service' ) ) {
		$schema = [
			'@context'    => 'https://schema.org',
			'@type'       => 'Service',
			'name'        => get_the_title(),
			'description' => wp_strip_all_tags( get_the_excerpt() ),
			'provider'    => [
				'@type' => 'LocalBusiness',
				'name'  => 'Luminar Touch Events',
				'url'   => home_url( '/' ),
			],
			'areaServed'  => 'Brisbane, QLD, Australia',
			'url'         => get_permalink(),
		];
		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'luminar_schema_markup' );

/* ============================================================
   BREADCRUMBS
   ============================================================ */
function luminar_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumbs', 'luminar' ) . '">';
	echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'luminar' ) . '</a>';
	echo '<span class="breadcrumbs__sep"> / </span>';
	if ( is_singular() ) {
		$terms = get_the_terms( get_the_ID(), 'service_category' );
		if ( $terms && ! is_wp_error( $terms ) ) {
			$term = $terms[0];
			echo '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
			echo '<span class="breadcrumbs__sep"> / </span>';
		}
		echo '<span class="breadcrumbs__current">' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_archive() ) {
		echo '<span class="breadcrumbs__current">' . esc_html( get_the_archive_title() ) . '</span>';
	} elseif ( is_search() ) {
		echo '<span class="breadcrumbs__current">' . esc_html__( 'Search Results', 'luminar' ) . '</span>';
	} elseif ( is_404() ) {
		echo '<span class="breadcrumbs__current">' . esc_html__( 'Page Not Found', 'luminar' ) . '</span>';
	}
	echo '</nav>';
}

/* ============================================================
   TEMPLATE HELPERS
   ============================================================ */
function luminar_service_icon( $service_slug ) {
	$icons = [
		'baby-shower'    => '&#x1F476;',
		'bridal-shower'  => '&#x1F492;',
		'gender-reveal'  => '&#x1F388;',
		'graduation'     => '&#x1F393;',
		'citizenship'    => '&#x1F1E6;&#x1F1FA;',
		'wedding'        => '&#x1F4CD;',
		'dinner-party'   => '&#x1F37D;',
	];
	return $icons[ $service_slug ] ?? '&#x2728;';
}

function luminar_placeholder_img( $width = 800, $height = 600, $text = 'Event Photo' ) {
	$encoded_text = rawurlencode( $text );
	return 'https://placehold.co/' . absint( $width ) . 'x' . absint( $height ) . '/F5E6E8/C9898A?text=' . $encoded_text;
}

function luminar_get_services() {
	$uri = get_template_directory_uri();
	return [
		[
			'slug'  => 'baby-shower',
			'title' => 'Baby Shower Styling',
			'icon'  => '&#x1F476;',
			'desc'  => 'Dreamy, pastel-soft setups that celebrate the arrival of a new little one. Balloon arches, floral installations, and styled dessert tables.',
			'color' => '#F9E4EC',
			'image' => $uri . '/assets/images/birthday party deco.png',
		],
		[
			'slug'  => 'bridal-shower',
			'title' => 'Bridal Shower Styling',
			'icon'  => '&#x1F492;',
			'desc'  => 'Romantic, sophisticated styling for the bride-to-be. Luxe florals, elegantly set tables, and whimsical decor that photographs beautifully.',
			'color' => '#FFF0E8',
			'image' => $uri . '/assets/images/engagement.jpg',
		],
		[
			'slug'  => 'gender-reveal',
			'title' => 'Gender Reveal Parties',
			'icon'  => '&#x1F388;',
			'desc'  => 'The big reveal, styled to perfection. Pink or blue? Either way, we create an unforgettable moment your family will treasure forever.',
			'color' => '#E8F0F9',
			'image' => $uri . '/assets/images/gender reveal.jpg',
		],
		[
			'slug'  => 'graduation',
			'title' => 'Graduation Celebrations',
			'icon'  => '&#x1F393;',
			'desc'  => 'Honour your graduate in style. Personalised decor, photo walls, and elegant table settings that reflect their achievement.',
			'color' => '#F5F0E8',
			'image' => $uri . '/assets/images/Graduation party.png',
		],
		[
			'slug'  => 'citizenship',
			'title' => 'Citizenship Ceremonies',
			'icon'  => '&#x2764;&#xFE0F;',
			'desc'  => 'A landmark moment deserves landmark styling. Dignified, warm and joyful decor that marks a new chapter in life.',
			'color' => '#E8F5EE',
			'image' => $uri . '/assets/images/citizenship.jpg',
		],
		[
			'slug'  => 'wedding',
			'title' => 'Wedding Styling',
			'icon'  => '&#x1F4CD;',
			'desc'  => 'Your dream wedding, brought to life. From intimate ceremonies to grand receptions, we craft your vision down to the last bloom.',
			'color' => '#F9E8F0',
			'image' => $uri . '/assets/images/Wedding deco.png',
		],
		[
			'slug'  => 'dinner-party',
			'title' => 'Dinner Party Styling',
			'icon'  => '&#x1F37D;&#xFE0F;',
			'desc'  => 'Impress every guest from the moment they walk in. Luxurious table settings, candles, and florals that set the perfect ambience.',
			'color' => '#F0E8F5',
			'image' => $uri . '/assets/images/gallery1.jfif',
		],
	];
}

/* ============================================================
   ENQUIRY AJAX
   ============================================================ */
function luminar_handle_enquiry() {
	check_ajax_referer( 'luminar_nonce', 'nonce' );

	$name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
	$service = sanitize_text_field( wp_unslash( $_POST['service'] ?? '' ) );
	$date    = sanitize_text_field( wp_unslash( $_POST['event_date'] ?? '' ) );
	$guests  = absint( wp_unslash( $_POST['guests'] ?? 0 ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

	if ( empty( $name ) || ! is_email( $email ) ) {
		wp_send_json_error( [ 'message' => esc_html__( 'Please provide your name and a valid email.', 'luminar' ) ] );
	}

	$to      = 'faithc@luminartouchevents.com';
	$subject = sprintf( 'New Enquiry from %s — Luminar Touch Events', $name );
	$body    = "You have a new event enquiry!\n";
	$body   .= str_repeat( '-', 40 ) . "\n";
	$body   .= sprintf( "Name:        %s\n", $name );
	$body   .= sprintf( "Email:       %s\n", $email );
	$body   .= sprintf( "Phone:       %s\n", $phone );
	$body   .= sprintf( "Event Type:  %s\n", $service );
	$body   .= sprintf( "Event Date:  %s\n", $date );
	$body   .= sprintf( "Guests:      %d\n", $guests );
	$body   .= str_repeat( '-', 40 ) . "\n";
	$body   .= sprintf( "Message:\n%s\n", $message );
	$body   .= str_repeat( '-', 40 ) . "\n";
	$body   .= "\nReply directly to this email to respond to the client.";

	$headers  = "Content-Type: text/plain; charset=UTF-8\r\n";
	$headers .= "From: Luminar Touch Events <enquiries@luminartouchevents.com>\r\n";
	$headers .= "Reply-To: {$name} <{$email}>\r\n";
	$headers .= "CC: ropkiplagat@gmail.com, chepkokfaith059@gmail.com\r\n";

	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( $sent ) {
		// Send follow-up email to the customer
		luminar_send_customer_followup( $name, $email, $service, $date );
		wp_send_json_success( [ 'message' => esc_html__( 'Thank you! We\'ll be in touch soon.', 'luminar' ) ] );
	} else {
		wp_send_json_error( [ 'message' => esc_html__( 'Something went wrong. Please try calling us directly.', 'luminar' ) ] );
	}
}
add_action( 'wp_ajax_luminar_enquiry',        'luminar_handle_enquiry' );
add_action( 'wp_ajax_nopriv_luminar_enquiry', 'luminar_handle_enquiry' );

/* ============================================================
   CUSTOMER FOLLOW-UP EMAIL
   Sent to the customer after their enquiry is received.
   Contains gallery of similar events + Calendly booking link.
   ============================================================ */
function luminar_send_customer_followup( $name, $email, $service, $date ) {

	// Google Drive gallery links per service type
	// Replace each URL with your actual Google Drive shared folder link
	$galleries = [
		'baby-shower'   => 'https://drive.google.com/drive/folders/REPLACE_BABY_SHOWER',
		'bridal-shower' => 'https://drive.google.com/drive/folders/REPLACE_BRIDAL_SHOWER',
		'gender-reveal' => 'https://drive.google.com/drive/folders/REPLACE_GENDER_REVEAL',
		'graduation'    => 'https://drive.google.com/drive/folders/REPLACE_GRADUATION',
		'citizenship'   => 'https://drive.google.com/drive/folders/REPLACE_CITIZENSHIP',
		'wedding'       => 'https://drive.google.com/drive/folders/REPLACE_WEDDING',
		'dinner-party'  => 'https://drive.google.com/drive/folders/REPLACE_DINNER_PARTY',
	];

	$service_slug    = strtolower( str_replace( ' ', '-', $service ) );
	$gallery_url     = $galleries[ $service_slug ] ?? 'https://luminartouchevents.com/gallery/';
	$service_label   = ucwords( str_replace( '-', ' ', $service_slug ) );
	$calendly_url    = 'https://calendly.com/luminartouchevents/consultation';
	$first_name      = explode( ' ', $name )[0];

	$subject = 'Your Luminar Touch Events Enquiry — What to Expect Next';

	$body  = "Hi {$first_name},\n\n";
	$body .= "Thank you for reaching out to Luminar Touch Events!\n\n";
	$body .= "We've received your enquiry for your {$service_label} on {$date} and we're so excited to help you create something beautiful.\n\n";
	$body .= str_repeat( '-', 50 ) . "\n";
	$body .= "INSPIRATION GALLERY — {$service_label}\n";
	$body .= str_repeat( '-', 50 ) . "\n";
	$body .= "We've put together a gallery of similar events we've styled to give you an idea of what's possible:\n\n";
	$body .= "  View Gallery: {$gallery_url}\n\n";
	$body .= "Browse through and take note of any looks, colours, or setups that inspire you — it will help us personalise your quote.\n\n";
	$body .= str_repeat( '-', 50 ) . "\n";
	$body .= "WHAT HAPPENS NEXT\n";
	$body .= str_repeat( '-', 50 ) . "\n";
	$body .= "1. Faith from our team will call you within 24 hours to discuss your vision\n";
	$body .= "2. We'll prepare a personalised quote based on your requirements\n";
	$body .= "3. Once you're happy, we lock in your date with a small deposit\n\n";
	$body .= "Prefer to book a time for your consultation right now? Pick a slot here:\n\n";
	$body .= "  Book a Free Consultation: {$calendly_url}\n\n";
	$body .= str_repeat( '-', 50 ) . "\n";
	$body .= "Warm regards,\n";
	$body .= "Faith & The Luminar Touch Events Team\n";
	$body .= "enquiries@luminartouchevents.com\n";
	$body .= "luminartouchevents.com\n";

	$headers  = "Content-Type: text/plain; charset=UTF-8\r\n";
	$headers .= "From: Faith — Luminar Touch Events <enquiries@luminartouchevents.com>\r\n";

	wp_mail( $email, $subject, $body, $headers );
}

/* ============================================================
   CUSTOMIZER
   ============================================================ */
function luminar_customize_register( $wp_customize ) {
	// Contact details
	$wp_customize->add_section( 'luminar_contact', [
		'title'    => esc_html__( 'Contact Details', 'luminar' ),
		'priority' => 30,
	] );

	$contact_fields = [
		'phone'   => esc_html__( 'Phone Number', 'luminar' ),
		'email'   => esc_html__( 'Email Address', 'luminar' ),
		'address' => esc_html__( 'Business Address', 'luminar' ),
		'instagram' => esc_html__( 'Instagram URL', 'luminar' ),
		'facebook'  => esc_html__( 'Facebook URL', 'luminar' ),
	];

	foreach ( $contact_fields as $id => $label ) {
		$wp_customize->add_setting( 'luminar_' . $id, [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'luminar_' . $id, [
			'label'   => $label,
			'section' => 'luminar_contact',
			'type'    => 'text',
		] );
	}

	// Hero section
	$wp_customize->add_section( 'luminar_hero', [
		'title'    => esc_html__( 'Hero Section', 'luminar' ),
		'priority' => 25,
	] );

	$hero_fields = [
		'hero_eyebrow'  => [ 'label' => 'Hero Eyebrow Text', 'default' => 'Brisbane\'s Premier Event Stylists' ],
		'hero_title'    => [ 'label' => 'Hero Heading', 'default' => 'Creating Moments Worth\nRemembering' ],
		'hero_subtitle' => [ 'label' => 'Hero Subtitle', 'default' => 'Bespoke event styling for life\'s most meaningful celebrations — from intimate gatherings to grand affairs.' ],
	];

	foreach ( $hero_fields as $id => $args ) {
		$wp_customize->add_setting( 'luminar_' . $id, [
			'default'           => $args['default'],
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'luminar_' . $id, [
			'label'   => $args['label'],
			'section' => 'luminar_hero',
			'type'    => 'text',
		] );
	}
}
add_action( 'customize_register', 'luminar_customize_register' );

/* ============================================================
   EXCERPT LENGTH
   ============================================================ */
function luminar_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'luminar_excerpt_length', 999 );

function luminar_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'luminar_excerpt_more' );

/* ============================================================
   SECURITY HARDENING
   ============================================================ */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

function luminar_remove_version( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src',  'luminar_remove_version', 9999 );
add_filter( 'script_loader_src', 'luminar_remove_version', 9999 );

/* ============================================================
   DEMO CONTENT INSTALLER
   ============================================================ */
require_once LUMINAR_DIR . '/inc/demo-content.php';
require_once LUMINAR_DIR . '/inc/event-booking.php';

/* ============================================================
   SITEMAP PING
   ============================================================ */
function luminar_ping_sitemap( $post_id ) {
	if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
		return;
	}
	$sitemap_url = esc_url_raw( home_url( '/sitemap.xml' ) );
	wp_remote_get( 'https://www.google.com/ping?sitemap=' . rawurlencode( $sitemap_url ) );
}
add_action( 'publish_post',    'luminar_ping_sitemap' );
add_action( 'publish_service', 'luminar_ping_sitemap' );
