<?php
/**
 * Avideas Event Styling — functions.php
 *
 * @package Avideas
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AVIDEAS_VERSION', '1.0.0' );
define( 'AVIDEAS_DIR', get_template_directory() );
define( 'AVIDEAS_URI', get_template_directory_uri() );

/* ============================================================
   THEME SETUP
   ============================================================ */
function avideas_setup() {
	load_theme_textdomain( 'avideas', AVIDEAS_DIR . '/languages' );

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
		'primary'  => esc_html__( 'Primary Menu', 'avideas' ),
		'footer-1' => esc_html__( 'Footer Services', 'avideas' ),
		'footer-2' => esc_html__( 'Footer Company', 'avideas' ),
	] );
}
add_action( 'after_setup_theme', 'avideas_setup' );

/* ============================================================
   SCRIPTS & STYLES
   ============================================================ */
function avideas_enqueue_assets() {
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
		AVIDEAS_URI . '/assets/js/main.js',
		[],
		AVIDEAS_VERSION,
		true
	);

	// Localise script
	wp_localize_script( 'avideas-main', 'avideasData', [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'avideas_nonce' ),
		'homeUrl' => esc_url( home_url( '/' ) ),
	] );

	// Comment reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'avideas_enqueue_assets' );

/* ============================================================
   WIDGETS & SIDEBARS
   ============================================================ */
function avideas_widgets_init() {
	register_sidebar( [
		'name'          => esc_html__( 'Blog Sidebar', 'avideas' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Widgets in this area will be shown on blog posts.', 'avideas' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	] );

	register_sidebar( [
		'name'          => esc_html__( 'Footer Widget Area', 'avideas' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Footer widget area.', 'avideas' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-widget__title">',
		'after_title'   => '</h4>',
	] );
}
add_action( 'widgets_init', 'avideas_widgets_init' );

/* ============================================================
   CUSTOM POST TYPES
   ============================================================ */
function avideas_register_post_types() {
	// Services CPT
	register_post_type( 'service', [
		'labels' => [
			'name'               => esc_html__( 'Services', 'avideas' ),
			'singular_name'      => esc_html__( 'Service', 'avideas' ),
			'add_new_item'       => esc_html__( 'Add New Service', 'avideas' ),
			'edit_item'          => esc_html__( 'Edit Service', 'avideas' ),
			'view_item'          => esc_html__( 'View Service', 'avideas' ),
			'search_items'       => esc_html__( 'Search Services', 'avideas' ),
			'not_found'          => esc_html__( 'No services found.', 'avideas' ),
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
			'name'          => esc_html__( 'Gallery', 'avideas' ),
			'singular_name' => esc_html__( 'Gallery Item', 'avideas' ),
			'add_new_item'  => esc_html__( 'Add Gallery Item', 'avideas' ),
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
			'name'          => esc_html__( 'Testimonials', 'avideas' ),
			'singular_name' => esc_html__( 'Testimonial', 'avideas' ),
			'add_new_item'  => esc_html__( 'Add Testimonial', 'avideas' ),
		],
		'public'       => false,
		'show_ui'      => true,
		'menu_icon'    => 'dashicons-format-quote',
		'supports'     => [ 'title', 'editor', 'custom-fields' ],
		'show_in_rest' => true,
	] );
}
add_action( 'init', 'avideas_register_post_types' );

/* ============================================================
   TAXONOMIES
   ============================================================ */
function avideas_register_taxonomies() {
	register_taxonomy( 'service_category', [ 'service' ], [
		'labels' => [
			'name'          => esc_html__( 'Service Categories', 'avideas' ),
			'singular_name' => esc_html__( 'Service Category', 'avideas' ),
		],
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite'      => [ 'slug' => 'service-category' ],
	] );

	register_taxonomy( 'gallery_category', [ 'gallery_item' ], [
		'labels' => [
			'name'          => esc_html__( 'Gallery Categories', 'avideas' ),
			'singular_name' => esc_html__( 'Gallery Category', 'avideas' ),
		],
		'hierarchical' => false,
		'show_in_rest' => true,
		'rewrite'      => [ 'slug' => 'gallery-category' ],
	] );
}
add_action( 'init', 'avideas_register_taxonomies' );

/* ============================================================
   SEO & META TAGS
   ============================================================ */
function avideas_seo_meta() {
	global $post;

	$site_name    = get_bloginfo( 'name' );
	$description  = get_bloginfo( 'description' );
	$canonical    = get_permalink();
	$og_image     = '';

	if ( is_singular() && has_post_thumbnail() ) {
		$og_image = get_the_post_thumbnail_url( $post->ID, 'avideas-hero' );
	} elseif ( is_front_page() ) {
		$logo = get_custom_logo();
		// Use default OG image if set
		$og_image = AVIDEAS_URI . '/assets/images/og-default.jpg';
		$canonical = home_url( '/' );
		$description = esc_html__( 'Avideas Event Styling Brisbane — specialists in baby showers, bridal showers, gender reveals, graduation parties, citizenship ceremonies, weddings and elegant dinner parties.', 'avideas' );
	}

	if ( is_singular() ) {
		$description = has_excerpt() ? get_the_excerpt() : $description;
		if ( ! $og_image ) {
			$og_image = AVIDEAS_URI . '/assets/images/og-default.jpg';
		}
	}

	$description = wp_strip_all_tags( $description );
	$description = esc_attr( wp_trim_words( $description, 25 ) );
	?>
	<meta name="description" content="<?php echo $description; ?>">
	<meta name="author" content="Avideas Event Styling">
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
add_action( 'wp_head', 'avideas_seo_meta', 1 );

/* ============================================================
   STRUCTURED DATA / SCHEMA
   ============================================================ */
function avideas_schema_markup() {
	if ( is_front_page() || is_home() ) {
		$schema = [
			'@context'        => 'https://schema.org',
			'@type'           => 'EventPlanningService',
			'name'            => 'Avideas Event Styling',
			'url'             => home_url( '/' ),
			'logo'            => AVIDEAS_URI . '/assets/images/logo.png',
			'image'           => AVIDEAS_URI . '/assets/images/og-default.jpg',
			'description'     => 'Brisbane\'s premier event styling specialists for baby showers, bridal showers, gender reveals, graduation parties, citizenship ceremonies, weddings and dinner parties.',
			'telephone'       => '+61-7-XXXX-XXXX',
			'email'           => 'hello@avideas.com.au',
			'priceRange'      => '$$',
			'currenciesAccepted' => 'AUD',
			'paymentAccepted' => 'Cash, Credit Card, Bank Transfer',
			'address'         => [
				'@type'           => 'PostalAddress',
				'streetAddress'   => get_theme_mod( 'avideas_address', 'Brisbane' ),
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
				'https://www.instagram.com/avideaseventstyling',
				'https://www.facebook.com/avideaseventstyling',
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
	}

	if ( is_singular( 'service' ) ) {
		$schema = [
			'@context'    => 'https://schema.org',
			'@type'       => 'Service',
			'name'        => get_the_title(),
			'description' => wp_strip_all_tags( get_the_excerpt() ),
			'provider'    => [
				'@type' => 'LocalBusiness',
				'name'  => 'Avideas Event Styling',
				'url'   => home_url( '/' ),
			],
			'areaServed'  => 'Brisbane, QLD, Australia',
			'url'         => get_permalink(),
		];
		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'avideas_schema_markup' );

/* ============================================================
   BREADCRUMBS
   ============================================================ */
function avideas_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumbs', 'avideas' ) . '">';
	echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'avideas' ) . '</a>';
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
		echo '<span class="breadcrumbs__current">' . esc_html__( 'Search Results', 'avideas' ) . '</span>';
	} elseif ( is_404() ) {
		echo '<span class="breadcrumbs__current">' . esc_html__( 'Page Not Found', 'avideas' ) . '</span>';
	}
	echo '</nav>';
}

/* ============================================================
   TEMPLATE HELPERS
   ============================================================ */
function avideas_service_icon( $service_slug ) {
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

function avideas_placeholder_img( $width = 800, $height = 600, $text = 'Event Photo' ) {
	$encoded_text = rawurlencode( $text );
	return 'https://placehold.co/' . absint( $width ) . 'x' . absint( $height ) . '/F5E6E8/C9898A?text=' . $encoded_text;
}

function avideas_get_services() {
	return [
		[
			'slug'  => 'baby-shower',
			'title' => 'Baby Shower Styling',
			'icon'  => '&#x1F476;',
			'desc'  => 'Dreamy, pastel-soft setups that celebrate the arrival of a new little one. Balloon arches, floral installations, and styled dessert tables.',
			'color' => '#F9E4EC',
		],
		[
			'slug'  => 'bridal-shower',
			'title' => 'Bridal Shower Styling',
			'icon'  => '&#x1F492;',
			'desc'  => 'Romantic, sophisticated styling for the bride-to-be. Luxe florals, elegantly set tables, and whimsical decor that photographs beautifully.',
			'color' => '#FFF0E8',
		],
		[
			'slug'  => 'gender-reveal',
			'title' => 'Gender Reveal Parties',
			'icon'  => '&#x1F388;',
			'desc'  => 'The big reveal, styled to perfection. Pink or blue? Either way, we create an unforgettable moment your family will treasure forever.',
			'color' => '#E8F0F9',
		],
		[
			'slug'  => 'graduation',
			'title' => 'Graduation Celebrations',
			'icon'  => '&#x1F393;',
			'desc'  => 'Honour your graduate in style. Personalised decor, photo walls, and elegant table settings that reflect their achievement.',
			'color' => '#F5F0E8',
		],
		[
			'slug'  => 'citizenship',
			'title' => 'Citizenship Ceremonies',
			'icon'  => '&#x2764;&#xFE0F;',
			'desc'  => 'A landmark moment deserves landmark styling. Dignified, warm and joyful decor that marks a new chapter in life.',
			'color' => '#E8F5EE',
		],
		[
			'slug'  => 'wedding',
			'title' => 'Wedding Styling',
			'icon'  => '&#x1F4CD;',
			'desc'  => 'Your dream wedding, brought to life. From intimate ceremonies to grand receptions, we craft your vision down to the last bloom.',
			'color' => '#F9E8F0',
		],
		[
			'slug'  => 'dinner-party',
			'title' => 'Dinner Party Styling',
			'icon'  => '&#x1F37D;&#xFE0F;',
			'desc'  => 'Impress every guest from the moment they walk in. Luxurious table settings, candles, and florals that set the perfect ambience.',
			'color' => '#F0E8F5',
		],
	];
}

/* ============================================================
   ENQUIRY AJAX
   ============================================================ */
function avideas_handle_enquiry() {
	check_ajax_referer( 'avideas_nonce', 'nonce' );

	$name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
	$service = sanitize_text_field( wp_unslash( $_POST['service'] ?? '' ) );
	$date    = sanitize_text_field( wp_unslash( $_POST['event_date'] ?? '' ) );
	$guests  = absint( wp_unslash( $_POST['guests'] ?? 0 ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

	if ( empty( $name ) || ! is_email( $email ) ) {
		wp_send_json_error( [ 'message' => esc_html__( 'Please provide your name and a valid email.', 'avideas' ) ] );
	}

	$to      = get_option( 'admin_email' );
	$subject = sprintf( esc_html__( 'New Enquiry from %s — Avideas', 'avideas' ), $name );
	$body    = sprintf(
		"Name: %s\nEmail: %s\nPhone: %s\nService: %s\nEvent Date: %s\nGuest Count: %d\n\nMessage:\n%s",
		$name, $email, $phone, $service, $date, $guests, $message
	);
	$headers = [
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $name . ' <' . $email . '>',
	];

	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( $sent ) {
		wp_send_json_success( [ 'message' => esc_html__( 'Thank you! We\'ll be in touch soon.', 'avideas' ) ] );
	} else {
		wp_send_json_error( [ 'message' => esc_html__( 'Something went wrong. Please try calling us directly.', 'avideas' ) ] );
	}
}
add_action( 'wp_ajax_avideas_enquiry',        'avideas_handle_enquiry' );
add_action( 'wp_ajax_nopriv_avideas_enquiry', 'avideas_handle_enquiry' );

/* ============================================================
   CUSTOMIZER
   ============================================================ */
function avideas_customize_register( $wp_customize ) {
	// Contact details
	$wp_customize->add_section( 'avideas_contact', [
		'title'    => esc_html__( 'Contact Details', 'avideas' ),
		'priority' => 30,
	] );

	$contact_fields = [
		'phone'   => esc_html__( 'Phone Number', 'avideas' ),
		'email'   => esc_html__( 'Email Address', 'avideas' ),
		'address' => esc_html__( 'Business Address', 'avideas' ),
		'instagram' => esc_html__( 'Instagram URL', 'avideas' ),
		'facebook'  => esc_html__( 'Facebook URL', 'avideas' ),
	];

	foreach ( $contact_fields as $id => $label ) {
		$wp_customize->add_setting( 'avideas_' . $id, [
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'avideas_' . $id, [
			'label'   => $label,
			'section' => 'avideas_contact',
			'type'    => 'text',
		] );
	}

	// Hero section
	$wp_customize->add_section( 'avideas_hero', [
		'title'    => esc_html__( 'Hero Section', 'avideas' ),
		'priority' => 25,
	] );

	$hero_fields = [
		'hero_eyebrow'  => [ 'label' => 'Hero Eyebrow Text', 'default' => 'Brisbane\'s Premier Event Stylists' ],
		'hero_title'    => [ 'label' => 'Hero Heading', 'default' => 'Creating Moments Worth\nRemembering' ],
		'hero_subtitle' => [ 'label' => 'Hero Subtitle', 'default' => 'Bespoke event styling for life\'s most meaningful celebrations — from intimate gatherings to grand affairs.' ],
	];

	foreach ( $hero_fields as $id => $args ) {
		$wp_customize->add_setting( 'avideas_' . $id, [
			'default'           => $args['default'],
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'avideas_' . $id, [
			'label'   => $args['label'],
			'section' => 'avideas_hero',
			'type'    => 'text',
		] );
	}
}
add_action( 'customize_register', 'avideas_customize_register' );

/* ============================================================
   EXCERPT LENGTH
   ============================================================ */
function avideas_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'avideas_excerpt_length', 999 );

function avideas_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'avideas_excerpt_more' );

/* ============================================================
   SECURITY HARDENING
   ============================================================ */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

function avideas_remove_version( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src',  'avideas_remove_version', 9999 );
add_filter( 'script_loader_src', 'avideas_remove_version', 9999 );

/* ============================================================
   SITEMAP PING
   ============================================================ */
function avideas_ping_sitemap( $post_id ) {
	if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
		return;
	}
	$sitemap_url = esc_url_raw( home_url( '/sitemap.xml' ) );
	wp_remote_get( 'https://www.google.com/ping?sitemap=' . rawurlencode( $sitemap_url ) );
}
add_action( 'publish_post',    'avideas_ping_sitemap' );
add_action( 'publish_service', 'avideas_ping_sitemap' );
