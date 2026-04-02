<?php
/**
 * Luminar Touch Events Demo Content Installer
 *
 * Runs on theme activation. Creates all 7 service posts, 4 testimonials,
 * and static pages if they don't already exist.
 *
 * @package Luminar Touch Events
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Hook: fires once when the theme is activated.
 */
function luminar_install_demo_content() {
	if ( get_option( 'luminar_demo_installed' ) ) {
		return;
	}

	luminar_create_service_posts();
	luminar_create_testimonial_posts();
	luminar_create_static_pages();

	update_option( 'luminar_demo_installed', '1' );
}
add_action( 'after_switch_theme', 'luminar_install_demo_content' );

/* ============================================================
   SERVICE POSTS
   ============================================================ */
function luminar_create_service_posts() {
	$services = [

		/* 1 — Baby Shower */
		[
			'slug'     => 'baby-shower',
			'title'    => 'Baby Shower Styling',
			'excerpt'  => 'Dreamy, pastel-soft setups that celebrate the arrival of a new little one — balloon arches, floral installations, and styled dessert tables.',
			'content'  => '<p>Welcoming a new baby is one of life\'s most magical milestones, and every detail of your baby shower should reflect that pure joy. At Luminar Touch Events, we specialise in creating dreamy, ethereal settings that take your guests\' breath away from the moment they step through the door.</p>

<p>Whether you\'re dreaming of a classic blush-and-gold theme, a whimsical woodland forest, a luxe all-white setup, or something bold and colourful — our team listens, designs, and delivers a space that is entirely and uniquely <em>yours</em>.</p>

<h2>What Makes Our Baby Shower Styling Special</h2>

<p>We don\'t do cookie-cutter. Every baby shower we style is a bespoke creation built around your vision, your colour palette, and your story. From the centrepiece balloon arch to the tiniest personalised place card, no detail is left to chance.</p>

<p>Our signature setups include:</p>
<ul>
<li>Luxury balloon installations — organic arches, columns, and clusters in custom colour palettes</li>
<li>Statement floral arrangements using fresh or premium faux blooms</li>
<li>Styled dessert and grazing tables with full tablescaping</li>
<li>Custom neon signs, backdrop walls, and signage</li>
<li>Personalised welcome signs and name boards</li>
<li>Chair sashes, table runners, and linen coordination</li>
<li>Centrepiece arrangements and table flowers</li>
</ul>

<h2>Our Most Popular Themes</h2>

<p><strong>Cloud &amp; Rainbow</strong> — Soft whites, pastel arches, and floating cloud balloons. Timeless and endlessly photogenic.</p>

<p><strong>Garden Party</strong> — Lush greenery, soft blush tones, hanging florals, and an elegant outdoor-inspired aesthetic.</p>

<p><strong>Neutral Luxe</strong> — Ivory, sage, and champagne tones with textured linens and sculptural elements. Understated elegance at its finest.</p>

<p><strong>Wildflower Boho</strong> — Terracotta, peach, and dried pampas grass for a warm, earthy, free-spirited celebration.</p>

<p><strong>Classic Pink or Blue</strong> — Traditional gender-specific palettes done with a modern, elevated twist.</p>

<h2>Full-Service Styling — Stress-Free for You</h2>

<p>We handle absolutely everything. You arrive to a fully styled venue, ready for guests. After the last slice of cake is eaten, we return to pack down completely — leaving the venue spotless and you with nothing but beautiful memories (and photographs).</p>

<p>Our baby shower packages are available Brisbane-wide, including all suburbs from the Northside to the Southside, the Bayside, and Ipswich.</p>',
			'includes' => "Custom consultation & bespoke concept development\nFull setup on the day (we arrive 2–3 hours early)\nLuxury balloon arch or installation\nFloral centrepieces and styling elements\nStyled dessert table setup (client provides food)\nPersonalised signage and welcome board\nFull pack-down service after the event\nPhotography coordination support",
			'order'    => 1,
		],

		/* 2 — Bridal Shower */
		[
			'slug'     => 'bridal-shower',
			'title'    => 'Bridal Shower Styling',
			'excerpt'  => 'Romantic, sophisticated styling for the bride-to-be — luxe florals, elegantly set tables, and whimsical decor that photographs beautifully.',
			'content'  => '<p>The bridal shower is one of the last intimate celebrations before the wedding — a moment to honour the bride with the people who love her most. At Luminar Touch Events, we create bridal shower experiences that are romantic, sophisticated, and absolutely unforgettable.</p>

<p>From a relaxed garden high tea to an opulent champagne brunch, we design every element with intention and elegance. Your styling will look like it belongs on the pages of a glossy magazine — and your guests won\'t stop talking about it for weeks.</p>

<h2>Our Approach to Bridal Shower Styling</h2>

<p>We meet with you (or the host) for a consultation to understand the bride\'s personality, the venue, the guest count, and the aesthetic vision. We then create a bespoke styling proposal — a full mood board complete with colour palette, decor elements, and layout plan — before sourcing and curating every single piece.</p>

<p>On the day, our team transforms the space into something extraordinary. You sip champagne. We do the work.</p>

<h2>Popular Bridal Shower Themes</h2>

<p><strong>Hamptons White</strong> — All-white florals, linen tablecloths, gold cutlery, and soft candlelight. Effortlessly chic.</p>

<p><strong>Garden Romantica</strong> — Cascading garden blooms, vintage china, pastel tones, and trailing greenery for a soft, romantic feel.</p>

<p><strong>Modern Luxe</strong> — Deep jewel tones, marble textures, velvet linens, and statement arrangements. Bold and beautiful.</p>

<p><strong>French Patisserie</strong> — Blush, cream, and gold. Macaroon towers, tiered cake stands, and Parisian-inspired elegance.</p>

<p><strong>Tropical Garden</strong> — Lush tropical leaves, bird of paradise blooms, rattan accents, and warm golden tones.</p>

<h2>Bridal Shower Packages</h2>

<p>We offer flexible packages to suit intimate gatherings of 10 as well as larger celebrations for 80+ guests. All packages include our signature setup and pack-down service, so neither you nor the host lifts a finger.</p>

<p>Add-on options include:</p>
<ul>
<li>Custom neon signs ("She Said Yes", "Future Mrs [Name]")</li>
<li>Wishing well or envelope box styling</li>
<li>Bridal games station styling</li>
<li>Chair flower arrangements for the bride</li>
<li>Welcome cocktail styling station</li>
</ul>',
			'includes' => "Personalised consultation & mood board\nFull venue setup (2–3 hours prior)\nFloral centrepieces and table arrangements\nTablescape — linens, runners, napkins\nBallon arch or floral installation\nWelcome sign and personalised signage\nFull pack-down service\nPhotography coordination support",
			'order'    => 2,
		],

		/* 3 — Gender Reveal */
		[
			'slug'     => 'gender-reveal',
			'title'    => 'Gender Reveal Parties',
			'excerpt'  => 'The big reveal, styled to perfection — pink or blue, we create an unforgettable moment your family will treasure forever.',
			'content'  => '<p>The gender reveal is one of the most exciting, joyful, and emotional moments a family can share together. At Luminar Touch Events, we understand the weight of that moment — and we make sure the styling does full justice to the occasion.</p>

<p>We create gender reveal party setups that build anticipation, maximise the reveal moment, and look absolutely stunning from every angle. Whether you want a classic pink-vs-blue theme, a neutral surprise palette with the big colour drop saved for the reveal, or something entirely unique — we make it happen.</p>

<h2>The Reveal Moment — We Style It to Perfection</h2>

<p>The centrepiece of every gender reveal is, of course, the moment itself. We work with you to design and style the reveal element so it lands with maximum impact. Our popular reveal setups include:</p>

<ul>
<li><strong>Giant balloon pops</strong> — Oversized black or gold balloons filled with pink or blue confetti, ready for the big pop</li>
<li><strong>Balloon box releases</strong> — A large decorated box bursts open to release a cascade of coloured balloons</li>
<li><strong>Confetti cannon stations</strong> — Styled stations with confetti cannons in your reveal colour</li>
<li><strong>Smoke bomb moments</strong> — For outdoor celebrations, coloured smoke creates a dramatic and photogenic reveal</li>
<li><strong>Piñata reveals</strong> — Fun, playful reveal method that the whole family can participate in</li>
</ul>

<h2>Full Party Styling</h2>

<p>Beyond the reveal moment, we style the entire party space — creating an atmosphere that builds excitement from the minute guests arrive. The pre-reveal space typically uses a neutral palette (gold, white, black) or a "Team Pink vs Team Blue" divided aesthetic, before the colour floods in at the big moment.</p>

<p>Our gender reveal packages include:</p>
<ul>
<li>Full venue setup and styling</li>
<li>Balloon installations and arch</li>
<li>Floral and decor elements</li>
<li>Custom "Team Pink / Team Blue" props and signage</li>
<li>Styled snack and drinks table</li>
<li>Personalised welcome sign</li>
</ul>

<h2>Photography &amp; Video Ready</h2>

<p>We style every gender reveal with photography and video in mind. Every backdrop, every element placement, every colour choice is considered for how it will look in photographs and video recordings. This is a moment you will watch back for years — we make sure it looks spectacular.</p>',
			'includes' => "Full venue or space styling\nBalloon arch or installation\nReveal moment setup (balloon pop, box, or confetti)\nTeam Pink / Team Blue props and signage\nStyled snack or dessert table\nWelcome sign and personalised details\nFull pack-down service\nPhotography-ready staging",
			'order'    => 3,
		],

		/* 4 — Graduation */
		[
			'slug'     => 'graduation',
			'title'    => 'Graduation Celebrations',
			'excerpt'  => 'Honour your graduate in style — personalised decor, photo walls, and elegant table settings that reflect their achievement.',
			'content'  => '<p>Years of hard work, late nights, and dedication — and now it\'s time to celebrate. Your graduate deserves a party that truly honours everything they\'ve accomplished. At Luminar Touch Events, we create graduation celebration styling that is personalised, meaningful, and genuinely spectacular.</p>

<p>From high school to university, trade school to postgraduate achievement — every milestone matters. We design setups that reflect the graduate\'s personality, course, and future aspirations while creating a space that the whole family will love.</p>

<h2>Personalised to the Graduate</h2>

<p>The best graduation parties feel deeply personal. We incorporate:</p>
<ul>
<li>The graduate\'s name in custom neon or illuminated letters</li>
<li>Photo displays celebrating their journey from first day to graduation</li>
<li>Colour schemes inspired by their school, university, or faculty colours</li>
<li>Custom signage celebrating their achievement and future path</li>
<li>Personalised place settings and favour styling</li>
</ul>

<h2>Popular Graduation Styling Themes</h2>

<p><strong>Class of [Year] Gold &amp; Black</strong> — A timeless, sophisticated palette that photographs beautifully and never dates. Gold balloon installations, black tablecloths, gold cutlery.</p>

<p><strong>University Colours</strong> — We work with your graduate\'s university colours to create a setup that celebrates their specific institution and achievement.</p>

<p><strong>Future So Bright</strong> — Bright, joyful colours, sunburst elements, and motivational styling that looks forward as much as it celebrates what\'s been achieved.</p>

<p><strong>Garden Elegance</strong> — For outdoor venues, lush greenery, soft florals, and an elegant garden party aesthetic that feels grown-up and celebratory.</p>

<h2>What We Set Up</h2>

<p>Our graduation styling packages are fully customisable but typically include:</p>
<ul>
<li>Statement balloon installation or arch</li>
<li>Graduate photo backdrop or memory wall</li>
<li>Styled dessert or grazing table</li>
<li>Table centrepieces and florals</li>
<li>Custom neon or letter signage</li>
<li>Welcome board with graduate\'s name and achievement</li>
</ul>

<p>Whether your venue is a backyard, a hired hall, a restaurant function room, or a community centre — we style any space beautifully.</p>',
			'includes' => "Personalised consultation and concept development\nCustom graduate name signage\nBalloon installation or arch\nPhoto backdrop or memory wall\nTable centrepieces and floral elements\nStyled dessert or grazing table setup\nWelcome sign personalised to the graduate\nFull setup and pack-down service",
			'order'    => 4,
		],

		/* 5 — Citizenship */
		[
			'slug'     => 'citizenship',
			'title'    => 'Citizenship Ceremonies',
			'excerpt'  => 'A landmark moment deserves landmark styling — dignified, warm, and joyful decor that marks a new chapter in life.',
			'content'  => '<p>Becoming an Australian citizen is one of the most profound and meaningful milestones in a person\'s life. It\'s the beginning of a new chapter — a moment of belonging, pride, and deep emotion. At Luminar Touch Events, we consider it an honour to help families celebrate this landmark occasion in the way it truly deserves.</p>

<p>Our citizenship ceremony styling is warm, dignified, joyful, and deeply personal. We create spaces that honour both the Australian identity being embraced and the unique cultural heritage the new citizen brings to this country.</p>

<h2>Celebrating Both Identities</h2>

<p>Australia\'s citizenship ceremonies are moments of cultural richness — and we love celebrating that. Many of our clients choose to incorporate elements from their home country\'s cultural palette alongside Australian colours and imagery. We work sensitively and joyfully to blend both, creating setups that feel truly reflective of who you are.</p>

<p>Australian national colours — green and gold — are naturally central, but we always find ways to make the styling feel personal and unique to your family\'s story.</p>

<h2>Styling Elements We Create</h2>

<ul>
<li>Australian-themed balloon installations in green, gold, and white</li>
<li>Welcome banners and personalised signage celebrating the new citizen(s)</li>
<li>Table centrepieces with Australian native florals — kangaroo paw, wattle, and banksia</li>
<li>Flag displays and patriotic styling elements</li>
<li>Styled dessert tables with themed treats</li>
<li>Family photo backdrop</li>
<li>Cultural fusion elements by request</li>
</ul>

<h2>Intimate or Grand</h2>

<p>Citizenship celebrations range from intimate family gatherings of 10 to larger community celebrations of 100+. We cater to all sizes with the same level of care and attention to detail. Whether you\'re celebrating in your backyard, a local park, a community hall, or a restaurant — we create something beautiful wherever you are in Brisbane.</p>

<h2>A Note From Us</h2>

<p>We\'ve had the privilege of styling citizenship celebrations for families from across the globe — the Philippines, India, the UK, China, Sri Lanka, South Africa, and many more. Every single one has been a moment of joy and tears. We love what we do, and we especially love these events.</p>

<p>Welcome to Australia. Let\'s celebrate properly.</p>',
			'includes' => "Personalised consultation and bespoke concept\nAustralian-themed balloon installation\nNative floral centrepieces (kangaroo paw, wattle, banksia)\nPersonalised welcome or celebration sign\nFlag and patriotic styling elements\nStyled dessert or food table\nFamily photo backdrop\nFull setup and pack-down service",
			'order'    => 5,
		],

		/* 6 — Wedding */
		[
			'slug'     => 'wedding',
			'title'    => 'Wedding Styling',
			'excerpt'  => 'Your dream wedding, brought to life — from intimate ceremonies to grand receptions, we craft your vision down to the last bloom.',
			'content'  => '<p>Your wedding day is unlike any other — a once-in-a-lifetime celebration of love, commitment, and everything your relationship stands for. At Luminar Touch Events, we approach every wedding with the reverence, creativity, and meticulous attention it deserves.</p>

<p>We are not a one-size-fits-all wedding stylist. We are a bespoke studio — meaning every element of your wedding styling is designed specifically for you, your love story, your venue, and your vision. We start with a blank canvas and build something extraordinary.</p>

<h2>Full Wedding Styling Services</h2>

<p>We offer comprehensive wedding styling from ceremony through to reception, including:</p>

<h3>Ceremony Styling</h3>
<ul>
<li>Custom ceremony arches and arbours — floral, greenery, pampas, or draped fabric</li>
<li>Aisle styling — petal runners, floral posies, chair arrangements</li>
<li>Signing table florals and styling</li>
<li>Ring bearer cushion and flower girl accessories</li>
<li>Ceremony backdrop walls and installations</li>
</ul>

<h3>Reception Styling</h3>
<ul>
<li>Full tablescaping — linens, runners, napkins, crockery coordination</li>
<li>Centrepiece arrangements for all guest tables</li>
<li>Bridal table styling — statement florals and elevated design</li>
<li>Candle and lighting coordination</li>
<li>Seating chart and escort card displays</li>
<li>Dessert and cake table styling</li>
<li>Wishing well and gift table styling</li>
<li>Welcome sign and stationery coordination</li>
</ul>

<h3>Statement Installations</h3>
<ul>
<li>Ceiling installations — floral clouds, draping, hanging greenery</li>
<li>Neon sign hire ("Mr &amp; Mrs [Name]", custom messages)</li>
<li>Balloon and pampas feature walls</li>
<li>Floral chandeliers</li>
</ul>

<h2>Our Wedding Process</h2>

<p>We begin with an in-depth consultation — ideally at your venue — where we walk the space together and understand your complete vision. We then create a full styling proposal including mood board, layout plan, item list, and investment breakdown. Once confirmed, we handle all sourcing, preparation, and delivery.</p>

<p>On your wedding day, our team arrives hours before your first guests to set up every single detail. We are present throughout setup to ensure perfection. After your last dance, we return to pack everything down quietly and completely — leaving your venue as we found it.</p>

<h2>Brisbane Venues We Love</h2>

<p>We have styled weddings at venues across Brisbane and South East Queensland including Elope Brisbane, Victoria Park, Customs House, The Tivoli, The Calile Hotel, Sirromet Winery, and countless private properties, farms, and garden spaces.</p>

<p>Whatever your venue, we know how to make it sing.</p>',
			'includes' => "In-depth venue consultation and bespoke proposal\nCeremony arch or arbour styling\nAisle and ceremony decor\nFull tablescaping for all guest tables\nBridal table statement florals\nCentrepiece arrangements\nCandle and lighting coordination\nDessert and cake table styling\nWelcome sign and stationery coordination\nFull setup and complete pack-down",
			'order'    => 6,
		],

		/* 7 — Dinner Party */
		[
			'slug'     => 'dinner-party',
			'title'    => 'Dinner Party Styling',
			'excerpt'  => 'Impress every guest from the moment they walk in — luxurious table settings, candles, and florals that set the perfect ambience.',
			'content'  => '<p>A truly remarkable dinner party is one where every element — from the moment guests walk through the door to the final coffee cup — has been considered with care. At Luminar Touch Events, we turn dinner parties into immersive experiences. Styled environments that make your guests feel like they\'ve stepped into something extraordinary.</p>

<p>Whether you\'re hosting a milestone birthday dinner, an anniversary celebration, a corporate dining event, a festive Christmas feast, or simply a gathering of people you want to wow — we create the ambience that food alone cannot achieve.</p>

<h2>The Art of Tablescaping</h2>

<p>The dinner table is our canvas. We specialise in elevated tablescaping — the art of creating a cohesive, beautiful table that is as much a visual centrepiece as any artwork.</p>

<p>Our tablescaping services include:</p>
<ul>
<li>Premium linen tablecloths and napkins in coordinating colours</li>
<li>Centrepiece floral arrangements — low for intimate conversation or tall and dramatic</li>
<li>Candle arrangements — pillar candles, taper candles, tealights, and lanterns</li>
<li>Crockery, glassware, and cutlery coordination (we can source or work with yours)</li>
<li>Place card design and setting</li>
<li>Menu card displays</li>
<li>Personalised napkin folds and napkin rings</li>
<li>Charger plates and decorative elements</li>
</ul>

<h2>Beyond the Table</h2>

<p>Great dinner party styling extends beyond the table itself:</p>
<ul>
<li>Entrance and welcome table styling</li>
<li>Cocktail hour styling — drinks stations, grazing boards</li>
<li>Ambient lighting recommendations and setup</li>
<li>Floral arrangements throughout the space</li>
<li>Custom signage and welcome boards</li>
<li>Gift table or wishing well styling (for milestone events)</li>
</ul>

<h2>Perfect For</h2>

<p><strong>Milestone Birthdays</strong> — 30th, 40th, 50th, 60th — a birthday dinner that feels like the occasion it truly is.</p>
<p><strong>Anniversary Dinners</strong> — Celebrate your relationship with a styled dinner that reflects your journey together.</p>
<p><strong>Corporate Dining</strong> — Impress clients, celebrate team achievements, or host end-of-year events in style.</p>
<p><strong>Festive Seasons</strong> — Christmas, New Year\'s Eve, and other festive occasions styled with seasonal elegance.</p>
<p><strong>Engagement Dinners</strong> — The intimate gathering after the proposal. We set the scene beautifully.</p>

<h2>In-Home or Venue</h2>

<p>We style dinner parties in your home, hired function venues, restaurants, or outdoor spaces. We arrive, set up completely, and return after the event to pack down — leaving you to simply host and enjoy every moment with your guests.</p>',
			'includes' => "Personalised consultation and theme development\nFull tablescaping — linens, runners, napkins\nFloral centrepieces and candle arrangements\nPlace cards and menu displays\nEntrance and welcome table styling\nAmbient element coordination\nCocktail or pre-dinner styling (where applicable)\nFull setup and post-event pack-down",
			'order'    => 7,
		],
	];

	foreach ( $services as $service ) {
		// Skip if a post with this slug already exists
		$existing = get_page_by_path( $service['slug'], OBJECT, 'service' );
		if ( $existing ) {
			continue;
		}

		$post_id = wp_insert_post( [
			'post_title'   => $service['title'],
			'post_name'    => $service['slug'],
			'post_content' => $service['content'],
			'post_excerpt' => $service['excerpt'],
			'post_type'    => 'service',
			'post_status'  => 'publish',
			'menu_order'   => $service['order'],
		] );

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, '_service_includes', $service['includes'] );
		}
	}
}

/* ============================================================
   TESTIMONIALS
   ============================================================ */
function luminar_create_testimonial_posts() {
	$testimonials = [
		[
			'title' => 'Sarah M.',
			'quote' => '"Luminar Touch Events transformed our baby shower into an absolute fairytale. Every single detail was perfect — the florals, the balloon arch, the dessert table. Our guests could not stop talking about it!"',
			'event' => 'Baby Shower — Brisbane',
			'order' => 1,
		],
		[
			'title' => 'Jessica K.',
			'quote' => '"I cannot recommend Luminar Touch Events enough. They took my bridal shower vision and exceeded every expectation. The styling was elegant, romantic, and utterly breathtaking."',
			'event' => 'Bridal Shower — Brisbane Southside',
			'order' => 2,
		],
		[
			'title' => 'Emma & David',
			'quote' => '"From our first consultation to the final pack-down, the Luminar Touch Events team were professional, creative, and just lovely to work with. Our wedding looked like a magazine shoot!"',
			'event' => 'Wedding Styling — Brisbane',
			'order' => 3,
		],
		[
			'title' => 'Priya T.',
			'quote' => '"The gender reveal setup was beyond anything I could have imagined. So many of our guests asked who did the styling — I was so proud to share the Luminar Touch Events name."',
			'event' => 'Gender Reveal Party — Brisbane North',
			'order' => 4,
		],
		[
			'title' => 'Mei & Family',
			'quote' => '"Luminar Touch Events styled our Australian citizenship celebration and it was the most beautiful party I\'ve ever attended. The Australian natives in the florals were a perfect touch."',
			'event' => 'Citizenship Ceremony — Brisbane',
			'order' => 5,
		],
		[
			'title' => 'Rachel H.',
			'quote' => '"Our daughter\'s graduation dinner looked like something out of a lifestyle magazine. Everything was perfect and Luminar Touch Events made the whole process completely stress-free."',
			'event' => 'Graduation Celebration — Brisbane',
			'order' => 6,
		],
	];

	foreach ( $testimonials as $t ) {
		$existing = get_page_by_title( $t['title'], OBJECT, 'testimonial' );
		if ( $existing ) {
			continue;
		}

		$post_id = wp_insert_post( [
			'post_title'  => $t['title'],
			'post_type'   => 'testimonial',
			'post_status' => 'publish',
			'menu_order'  => $t['order'],
		] );

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, '_testimonial_quote', $t['quote'] );
			update_post_meta( $post_id, '_testimonial_event', $t['event'] );
		}
	}
}

/* ============================================================
   STATIC PAGES
   ============================================================ */
function luminar_create_static_pages() {
	$pages = [
		[
			'title'    => 'Home',
			'slug'     => 'home',
			'template' => '',
			'content'  => '',
		],
		[
			'title'    => 'Services',
			'slug'     => 'services',
			'template' => 'page-services.php',
			'content'  => '',
		],
		[
			'title'    => 'Gallery',
			'slug'     => 'gallery',
			'template' => 'page-gallery.php',
			'content'  => '',
		],
		[
			'title'    => 'About',
			'slug'     => 'about',
			'template' => 'page-about.php',
			'content'  => '',
		],
		[
			'title'    => 'Contact',
			'slug'     => 'contact',
			'template' => 'page-contact.php',
			'content'  => '',
		],
	];

	foreach ( $pages as $page ) {
		$existing = get_page_by_path( $page['slug'] );
		if ( $existing ) {
			// Still ensure correct template is assigned
			if ( $page['template'] ) {
				update_post_meta( $existing->ID, '_wp_page_template', $page['template'] );
			}
			continue;
		}

		$post_id = wp_insert_post( [
			'post_title'   => $page['title'],
			'post_name'    => $page['slug'],
			'post_content' => $page['content'],
			'post_type'    => 'page',
			'post_status'  => 'publish',
		] );

		if ( $post_id && ! is_wp_error( $post_id ) && $page['template'] ) {
			update_post_meta( $post_id, '_wp_page_template', $page['template'] );
		}
	}

	// Set front page
	$home = get_page_by_path( 'home' );
	if ( $home ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home->ID );
	}
}

/* ============================================================
   ADMIN — RE-RUN INSTALLER BUTTON
   ============================================================ */
function luminar_demo_admin_page() {
	add_theme_page(
		esc_html__( 'Demo Content', 'luminar' ),
		esc_html__( 'Demo Content', 'luminar' ),
		'manage_options',
		'avideas-demo',
		'luminar_demo_admin_render'
	);
}
add_action( 'admin_menu', 'luminar_demo_admin_page' );

function luminar_demo_admin_render() {
	if (
		isset( $_POST['luminar_reinstall_demo'] ) &&
		check_admin_referer( 'luminar_reinstall' )
	) {
		delete_option( 'luminar_demo_installed' );
		luminar_create_service_posts();
		luminar_create_testimonial_posts();
		luminar_create_static_pages();
		update_option( 'luminar_demo_installed', '1' );
		echo '<div class="notice notice-success"><p><strong>' . esc_html__( 'Demo content installed successfully.', 'luminar' ) . '</strong></p></div>';
	}

	$installed = get_option( 'luminar_demo_installed' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Luminar Touch Events Demo Content', 'luminar' ); ?></h1>
		<p><?php esc_html_e( 'This will create all 7 service posts, 6 testimonials, and 5 static pages if they do not already exist.', 'luminar' ); ?></p>
		<?php if ( $installed ) : ?>
		<p><span style="color:green;">&#x2713;</span> <?php esc_html_e( 'Demo content has been installed.', 'luminar' ); ?></p>
		<?php endif; ?>
		<form method="post">
			<?php wp_nonce_field( 'luminar_reinstall' ); ?>
			<p>
				<button type="submit" name="luminar_reinstall_demo" class="button button-primary">
					<?php echo $installed
						? esc_html__( 'Re-install Demo Content', 'luminar' )
						: esc_html__( 'Install Demo Content', 'luminar' ); ?>
				</button>
			</p>
		</form>
	</div>
	<?php
}
