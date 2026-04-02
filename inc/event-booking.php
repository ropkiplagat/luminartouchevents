<?php
/**
 * Luminar Touch Events — Event Booking System
 *
 * CPTs:  luminar_event  (Event Types: Wedding, Birthday, etc.)
 *        luminar_item   (Items per event: Cake, Backdrop, Chairs, etc.)
 * AJAX:  luminar_get_events, luminar_get_event_items, luminar_submit_booking
 * Admin: Meta boxes on both CPTs; items menu under Event Types
 * Seed:  Dummy birthday + wedding data on first admin_init
 *
 * @package Luminar Touch Events
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ============================================================
   1. REGISTER CPTs
   ============================================================ */

function luminar_register_booking_cpts() {

	register_post_type( 'luminar_event', [
		'labels' => [
			'name'               => 'Event Types',
			'singular_name'      => 'Event Type',
			'add_new'            => 'Add Event Type',
			'add_new_item'       => 'Add New Event Type',
			'edit_item'          => 'Edit Event Type',
			'new_item'           => 'New Event Type',
			'view_item'          => 'View Event Type',
			'search_items'       => 'Search Event Types',
			'not_found'          => 'No event types found',
			'not_found_in_trash' => 'No event types in trash',
			'menu_name'          => 'Event Booking',
		],
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_icon'     => 'dashicons-calendar-alt',
		'menu_position' => 28,
		'supports'      => [ 'title', 'editor', 'thumbnail' ],
		'has_archive'   => false,
		'rewrite'       => false,
	] );

	register_post_type( 'luminar_item', [
		'labels' => [
			'name'               => 'Event Items',
			'singular_name'      => 'Event Item',
			'add_new'            => 'Add Item',
			'add_new_item'       => 'Add New Item',
			'edit_item'          => 'Edit Item',
			'search_items'       => 'Search Items',
			'not_found'          => 'No items found',
			'not_found_in_trash' => 'No items in trash',
			'menu_name'          => 'Event Items',
		],
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => 'edit.php?post_type=luminar_event',
		'supports'      => [ 'title', 'thumbnail' ],
		'has_archive'   => false,
		'rewrite'       => false,
	] );
}
add_action( 'init', 'luminar_register_booking_cpts' );

/* ============================================================
   2. META BOX — Event Type details
   ============================================================ */

function luminar_booking_meta_boxes() {
	add_meta_box(
		'luminar_event_details',
		'Event Settings',
		'luminar_event_details_cb',
		'luminar_event',
		'normal',
		'high'
	);

	add_meta_box(
		'luminar_item_details',
		'Item Pricing & Assignment',
		'luminar_item_details_cb',
		'luminar_item',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'luminar_booking_meta_boxes' );

function luminar_event_details_cb( $post ) {
	wp_nonce_field( 'luminar_event_save', 'luminar_event_nonce' );
	$icon     = get_post_meta( $post->ID, '_luminar_icon', true );
	$calendly = get_post_meta( $post->ID, '_luminar_calendly_url', true );
	?>
	<style>
		.luminar-meta-table th { width: 160px; vertical-align: top; padding: 12px 0; }
		.luminar-meta-table td { padding: 8px 0; }
		.luminar-meta-table input[type="text"],
		.luminar-meta-table input[type="url"] { width: 100%; max-width: 500px; }
	</style>
	<table class="form-table luminar-meta-table">
		<tr>
			<th><label for="luminar_icon">Icon / Emoji</label></th>
			<td>
				<input type="text" id="luminar_icon" name="luminar_icon"
					value="<?php echo esc_attr( $icon ); ?>"
					class="regular-text"
					placeholder="e.g. 🎂 or 💍" />
				<p class="description">Paste an emoji or icon character shown on the booking page.</p>
			</td>
		</tr>
		<tr>
			<th><label for="luminar_calendly_url">Calendly URL</label></th>
			<td>
				<input type="url" id="luminar_calendly_url" name="luminar_calendly_url"
					value="<?php echo esc_url( $calendly ); ?>"
					class="regular-text"
					placeholder="https://calendly.com/luminartouchevents/consultation" />
				<p class="description">Unique Calendly link for this event type. Leave blank to use the default.</p>
			</td>
		</tr>
	</table>
	<?php
}

function luminar_item_details_cb( $post ) {
	wp_nonce_field( 'luminar_item_save', 'luminar_item_nonce' );

	$event_id   = get_post_meta( $post->ID, '_luminar_item_event', true );
	$price_type = get_post_meta( $post->ID, '_luminar_price_type', true ) ?: 'flat';
	$base_price = get_post_meta( $post->ID, '_luminar_base_price', true );
	$category   = get_post_meta( $post->ID, '_luminar_item_category', true ) ?: 'decor';
	$desc       = get_post_meta( $post->ID, '_luminar_item_desc', true );
	$required   = get_post_meta( $post->ID, '_luminar_item_required', true );
	$guests_per = get_post_meta( $post->ID, '_luminar_guests_per_unit', true ) ?: 10;

	$events = get_posts( [
		'post_type'   => 'luminar_event',
		'numberposts' => -1,
		'post_status' => 'publish',
		'orderby'     => 'title',
		'order'       => 'ASC',
	] );

	$categories = [
		'decor'         => 'Decoration',
		'furniture'     => 'Furniture',
		'catering'      => 'Catering',
		'photography'   => 'Photography',
		'entertainment' => 'Entertainment',
		'transport'     => 'Transport',
		'flowers'       => 'Flowers & Florals',
	];
	?>
	<table class="form-table luminar-meta-table">
		<tr>
			<th><label for="luminar_item_event">Event Type</label></th>
			<td>
				<select id="luminar_item_event" name="luminar_item_event" style="min-width:200px;">
					<option value="">— Select Event Type —</option>
					<?php foreach ( $events as $e ) : ?>
					<option value="<?php echo esc_attr( $e->ID ); ?>" <?php selected( $event_id, $e->ID ); ?>>
						<?php echo esc_html( $e->post_title ); ?>
					</option>
					<?php endforeach; ?>
				</select>
				<p class="description">Which event type does this item belong to?</p>
			</td>
		</tr>
		<tr>
			<th><label for="luminar_item_category">Category</label></th>
			<td>
				<select id="luminar_item_category" name="luminar_item_category" style="min-width:200px;">
					<?php foreach ( $categories as $val => $label ) : ?>
					<option value="<?php echo esc_attr( $val ); ?>" <?php selected( $category, $val ); ?>>
						<?php echo esc_html( $label ); ?>
					</option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<th><label for="luminar_price_type">Pricing Model</label></th>
			<td>
				<select id="luminar_price_type" name="luminar_price_type" style="min-width:200px;">
					<option value="flat"       <?php selected( $price_type, 'flat' ); ?>>Flat rate (one price total)</option>
					<option value="per_person" <?php selected( $price_type, 'per_person' ); ?>>Per person × guest count</option>
					<option value="per_table"  <?php selected( $price_type, 'per_table' ); ?>>Per table (guests ÷ table size)</option>
				</select>
			</td>
		</tr>
		<tr>
			<th><label for="luminar_base_price">Price ($)</label></th>
			<td>
				<input type="number" id="luminar_base_price" name="luminar_base_price"
					value="<?php echo esc_attr( $base_price ); ?>"
					step="0.01" min="0" style="width:120px;" />
				<p class="description">For per-person/per-table: this is the unit price. For flat: total price.</p>
			</td>
		</tr>
		<tr id="luminar-guests-per-row" style="<?php echo $price_type !== 'per_table' ? 'display:none;' : ''; ?>">
			<th><label for="luminar_guests_per_unit">Guests Per Table</label></th>
			<td>
				<input type="number" id="luminar_guests_per_unit" name="luminar_guests_per_unit"
					value="<?php echo esc_attr( $guests_per ); ?>"
					min="1" style="width:80px;" />
				<p class="description">How many guests sit at one table? (Default: 10)</p>
			</td>
		</tr>
		<tr>
			<th><label for="luminar_item_desc">Short Description</label></th>
			<td>
				<textarea id="luminar_item_desc" name="luminar_item_desc"
					rows="2" class="large-text"><?php echo esc_textarea( $desc ); ?></textarea>
			</td>
		</tr>
		<tr>
			<th>Required?</th>
			<td>
				<label>
					<input type="checkbox" name="luminar_item_required" value="1" <?php checked( $required, '1' ); ?> />
					Pre-selected and required for this event (cannot be unchecked)
				</label>
			</td>
		</tr>
	</table>
	<script>
	(function(){
		var pt = document.getElementById('luminar_price_type');
		var row = document.getElementById('luminar-guests-per-row');
		if (!pt || !row) return;
		pt.addEventListener('change', function(){
			row.style.display = (pt.value === 'per_table') ? '' : 'none';
		});
	}());
	</script>
	<?php
}

/* ============================================================
   3. SAVE META
   ============================================================ */

function luminar_save_event_meta( $post_id ) {
	if ( ! isset( $_POST['luminar_event_nonce'] ) ) return;
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['luminar_event_nonce'] ) ), 'luminar_event_save' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	update_post_meta( $post_id, '_luminar_icon',
		sanitize_text_field( wp_unslash( $_POST['luminar_icon'] ?? '' ) ) );
	update_post_meta( $post_id, '_luminar_calendly_url',
		esc_url_raw( wp_unslash( $_POST['luminar_calendly_url'] ?? '' ) ) );
}
add_action( 'save_post_luminar_event', 'luminar_save_event_meta' );

function luminar_save_item_meta( $post_id ) {
	if ( ! isset( $_POST['luminar_item_nonce'] ) ) return;
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['luminar_item_nonce'] ) ), 'luminar_item_save' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	update_post_meta( $post_id, '_luminar_item_event',
		absint( wp_unslash( $_POST['luminar_item_event'] ?? 0 ) ) );
	update_post_meta( $post_id, '_luminar_item_category',
		sanitize_text_field( wp_unslash( $_POST['luminar_item_category'] ?? 'decor' ) ) );
	update_post_meta( $post_id, '_luminar_price_type',
		sanitize_text_field( wp_unslash( $_POST['luminar_price_type'] ?? 'flat' ) ) );
	update_post_meta( $post_id, '_luminar_base_price',
		floatval( wp_unslash( $_POST['luminar_base_price'] ?? 0 ) ) );
	update_post_meta( $post_id, '_luminar_guests_per_unit',
		max( 1, absint( wp_unslash( $_POST['luminar_guests_per_unit'] ?? 10 ) ) ) );
	update_post_meta( $post_id, '_luminar_item_desc',
		sanitize_textarea_field( wp_unslash( $_POST['luminar_item_desc'] ?? '' ) ) );
	update_post_meta( $post_id, '_luminar_item_required',
		isset( $_POST['luminar_item_required'] ) ? '1' : '0' );
}
add_action( 'save_post_luminar_item', 'luminar_save_item_meta' );

/* ============================================================
   4. ADMIN COLUMNS — Event Items list
   ============================================================ */

function luminar_item_admin_columns( $cols ) {
	return [
		'cb'         => $cols['cb'],
		'title'      => 'Item Name',
		'event'      => 'Event Type',
		'category'   => 'Category',
		'price'      => 'Price',
		'price_type' => 'Pricing Model',
	];
}
add_filter( 'manage_luminar_item_posts_columns', 'luminar_item_admin_columns' );

function luminar_item_admin_column_data( $col, $post_id ) {
	switch ( $col ) {
		case 'event':
			$eid = get_post_meta( $post_id, '_luminar_item_event', true );
			echo $eid ? esc_html( get_the_title( $eid ) ) : '—';
			break;
		case 'category':
			$map = [
				'decor' => 'Decoration', 'furniture' => 'Furniture',
				'catering' => 'Catering', 'photography' => 'Photography',
				'entertainment' => 'Entertainment', 'transport' => 'Transport',
				'flowers' => 'Flowers & Florals',
			];
			$cat = get_post_meta( $post_id, '_luminar_item_category', true );
			echo esc_html( $map[ $cat ] ?? $cat );
			break;
		case 'price':
			$price = get_post_meta( $post_id, '_luminar_base_price', true );
			echo '$' . number_format( (float) $price, 2 );
			break;
		case 'price_type':
			$map = [ 'flat' => 'Flat rate', 'per_person' => 'Per person', 'per_table' => 'Per table' ];
			$pt  = get_post_meta( $post_id, '_luminar_price_type', true );
			echo esc_html( $map[ $pt ] ?? $pt );
			break;
	}
}
add_action( 'manage_luminar_item_posts_custom_column', 'luminar_item_admin_column_data', 10, 2 );

/* ============================================================
   5. ENQUEUE BOOKING ASSETS (booking page only)
   ============================================================ */

function luminar_enqueue_booking_assets() {
	if ( ! is_page_template( 'page-book-event.php' ) ) return;

	wp_enqueue_style(
		'luminar-booking',
		LUMINAR_URI . '/assets/css/event-booking.css',
		[ 'avideas-style' ],
		AVIDEAS_VERSION
	);

	wp_enqueue_script(
		'luminar-booking',
		LUMINAR_URI . '/assets/js/event-booking.js',
		[],
		AVIDEAS_VERSION,
		true
	);

	wp_localize_script( 'luminar-booking', 'luminarBooking', [
		'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
		'nonce'       => wp_create_nonce( 'luminar_booking_nonce' ),
		'defaultCal'  => 'https://calendly.com/luminartouchevents/consultation',
		'currency'    => '$',
	] );
}
add_action( 'wp_enqueue_scripts', 'luminar_enqueue_booking_assets' );

/* ============================================================
   6. AJAX — Get All Event Types
   ============================================================ */

function luminar_ajax_get_events() {
	$events = get_posts( [
		'post_type'   => 'luminar_event',
		'numberposts' => -1,
		'post_status' => 'publish',
		'orderby'     => 'menu_order',
		'order'       => 'ASC',
	] );

	$data = [];
	foreach ( $events as $event ) {
		$thumb = get_the_post_thumbnail_url( $event->ID, 'avideas-service' );
		$data[] = [
			'id'       => $event->ID,
			'title'    => $event->post_title,
			'icon'     => get_post_meta( $event->ID, '_luminar_icon', true ) ?: '✨',
			'desc'     => wp_strip_all_tags( wp_trim_words( $event->post_content, 18 ) ),
			'image'    => $thumb ?: '',
			'calendly' => get_post_meta( $event->ID, '_luminar_calendly_url', true ),
		];
	}
	wp_send_json_success( $data );
}
add_action( 'wp_ajax_luminar_get_events',        'luminar_ajax_get_events' );
add_action( 'wp_ajax_nopriv_luminar_get_events', 'luminar_ajax_get_events' );

/* ============================================================
   7. AJAX — Get Items for Selected Event
   ============================================================ */

function luminar_ajax_get_event_items() {
	check_ajax_referer( 'luminar_booking_nonce', 'nonce' );

	$event_id = absint( $_POST['event_id'] ?? 0 );
	if ( ! $event_id ) {
		wp_send_json_error( [ 'message' => 'Invalid event.' ] );
	}

	$items = get_posts( [
		'post_type'   => 'luminar_item',
		'numberposts' => -1,
		'post_status' => 'publish',
		'meta_query'  => [
			[ 'key' => '_luminar_item_event', 'value' => $event_id, 'compare' => '=' ],
		],
		'orderby' => 'title',
		'order'   => 'ASC',
	] );

	$data = [];
	foreach ( $items as $item ) {
		$thumb = get_the_post_thumbnail_url( $item->ID, 'avideas-thumb' );
		$data[] = [
			'id'         => $item->ID,
			'title'      => $item->post_title,
			'desc'       => get_post_meta( $item->ID, '_luminar_item_desc', true ),
			'category'   => get_post_meta( $item->ID, '_luminar_item_category', true ),
			'price_type' => get_post_meta( $item->ID, '_luminar_price_type', true ) ?: 'flat',
			'base_price' => (float) get_post_meta( $item->ID, '_luminar_base_price', true ),
			'guests_per' => (int) ( get_post_meta( $item->ID, '_luminar_guests_per_unit', true ) ?: 10 ),
			'required'   => get_post_meta( $item->ID, '_luminar_item_required', true ) === '1',
			'image'      => $thumb ?: '',
		];
	}

	wp_send_json_success( $data );
}
add_action( 'wp_ajax_luminar_get_event_items',        'luminar_ajax_get_event_items' );
add_action( 'wp_ajax_nopriv_luminar_get_event_items', 'luminar_ajax_get_event_items' );

/* ============================================================
   8. AJAX — Submit Booking Enquiry
   ============================================================ */

function luminar_ajax_submit_booking() {
	check_ajax_referer( 'luminar_booking_nonce', 'nonce' );

	$name        = sanitize_text_field( wp_unslash( $_POST['name']        ?? '' ) );
	$email       = sanitize_email( wp_unslash( $_POST['email']            ?? '' ) );
	$phone       = sanitize_text_field( wp_unslash( $_POST['phone']       ?? '' ) );
	$event_id    = absint( $_POST['event_id']                             ?? 0 );
	$event_title = sanitize_text_field( wp_unslash( $_POST['event_title'] ?? '' ) );
	$guests      = absint( $_POST['guests']                               ?? 0 );
	$venue       = sanitize_text_field( wp_unslash( $_POST['venue']       ?? '' ) );
	$event_date  = sanitize_text_field( wp_unslash( $_POST['event_date']  ?? '' ) );
	$items_raw   = wp_unslash( $_POST['selected_items']                   ?? '[]' );
	$total       = floatval( $_POST['total']                              ?? 0 );

	if ( empty( $name ) || ! is_email( $email ) ) {
		wp_send_json_error( [ 'message' => 'Please provide your name and a valid email.' ] );
	}

	$items     = json_decode( $items_raw, true ) ?: [];
	$item_lines = '';
	foreach ( $items as $item ) {
		$item_title = sanitize_text_field( $item['title'] ?? '' );
		$item_price = floatval( $item['price'] ?? 0 );
		$item_lines .= sprintf( "  - %s: $%.2f\n", $item_title, $item_price );
	}

	$to      = get_option( 'admin_email' );
	$subject = sprintf( 'New Event Enquiry — %s (%s)', $name, $event_title );
	$body    = sprintf(
		"New booking enquiry from Luminar Touch Events.\n\n" .
		"Name:       %s\n" .
		"Email:      %s\n" .
		"Phone:      %s\n\n" .
		"Event:      %s\n" .
		"Date:       %s\n" .
		"Guests:     %d\n" .
		"Venue:      %s\n\n" .
		"Selected Items:\n%s\n" .
		"ESTIMATE TOTAL:  $%.2f\n\n" .
		"---\nSubmitted via the online event planner.",
		$name, $email, $phone,
		$event_title, $event_date, $guests, $venue,
		$item_lines, $total
	);

	$headers = [
		'Content-Type: text/plain; charset=UTF-8',
		sprintf( 'Reply-To: %s <%s>', $name, $email ),
	];

	$sent = wp_mail( $to, $subject, $body, $headers );

	$calendly = get_post_meta( $event_id, '_luminar_calendly_url', true )
		?: 'https://calendly.com/luminartouchevents/consultation';

	if ( $sent ) {
		wp_send_json_success( [
			'message'  => 'Your enquiry has been received! Now book your free consultation below.',
			'calendly' => esc_url( $calendly ),
		] );
	} else {
		wp_send_json_error( [ 'message' => 'Email failed. Please call us directly.' ] );
	}
}
add_action( 'wp_ajax_luminar_submit_booking',        'luminar_ajax_submit_booking' );
add_action( 'wp_ajax_nopriv_luminar_submit_booking', 'luminar_ajax_submit_booking' );

/* ============================================================
   9. DUMMY DATA SEEDER
   Called once on admin_init — skips if already run
   ============================================================ */

function luminar_seed_event_data() {
	if ( get_option( 'luminar_events_seeded_v1' ) ) return;

	// --- EVENT TYPE DEFINITIONS ---
	$event_types = [
		[
			'title'    => 'Birthday Party',
			'icon'     => '🎂',
			'content'  => 'Fun, vibrant styling for birthdays of all ages — from intimate milestone celebrations to big backyard bashes.',
			'calendly' => '',
			'items'    => [
				[ 'title' => 'Cake — Small (up to 30 guests)',   'cat' => 'catering',      'type' => 'flat',       'price' => 150,  'per' => 1,  'req' => false, 'desc' => 'Vanilla or chocolate 2-tier cake, serves up to 30.' ],
				[ 'title' => 'Cake — Medium (30–60 guests)',     'cat' => 'catering',      'type' => 'flat',       'price' => 280,  'per' => 1,  'req' => false, 'desc' => '3-tier custom cake, serves 30–60 guests.' ],
				[ 'title' => 'Cake — Large (60–100 guests)',     'cat' => 'catering',      'type' => 'flat',       'price' => 450,  'per' => 1,  'req' => false, 'desc' => '4-tier show-stopping cake, serves 60–100 guests.' ],
				[ 'title' => 'Balloon Arch',                    'cat' => 'decor',         'type' => 'flat',       'price' => 320,  'per' => 1,  'req' => false, 'desc' => 'Full balloon arch in your colour palette, 3m wide.' ],
				[ 'title' => 'Backdrop / Photo Wall',           'cat' => 'decor',         'type' => 'flat',       'price' => 280,  'per' => 1,  'req' => false, 'desc' => 'Sequin or floral wall backdrop, perfect for photos.' ],
				[ 'title' => 'Dessert Table Setup',             'cat' => 'catering',      'type' => 'flat',       'price' => 350,  'per' => 1,  'req' => false, 'desc' => 'Styled dessert table with stand, linens and signage.' ],
				[ 'title' => 'Chairs (Tiffany / Chiavari)',     'cat' => 'furniture',     'type' => 'per_person', 'price' => 8,    'per' => 1,  'req' => true,  'desc' => 'Elegant Tiffany chairs, priced per guest.' ],
				[ 'title' => 'Round Tables (dressed)',          'cat' => 'furniture',     'type' => 'per_table',  'price' => 50,   'per' => 10, 'req' => true,  'desc' => '1.8m round table with linen, 1 per 10 guests.' ],
				[ 'title' => 'Table Centrepieces',              'cat' => 'decor',         'type' => 'per_table',  'price' => 35,   'per' => 10, 'req' => false, 'desc' => 'Floral or balloon centrepiece per table.' ],
				[ 'title' => 'Photography (4 hrs)',             'cat' => 'photography',   'type' => 'flat',       'price' => 750,  'per' => 1,  'req' => false, 'desc' => '4 hours event photography, 200+ edited photos.' ],
				[ 'title' => 'Neon Sign (custom name)',         'cat' => 'decor',         'type' => 'flat',       'price' => 180,  'per' => 1,  'req' => false, 'desc' => 'Custom LED neon sign with your name or message.' ],
				[ 'title' => 'Sequin Tablecloths',              'cat' => 'decor',         'type' => 'per_table',  'price' => 25,   'per' => 10, 'req' => false, 'desc' => 'Glam sequin tablecloths per table.' ],
				[ 'title' => 'Fairy Light Curtain Backdrop',   'cat' => 'decor',         'type' => 'flat',       'price' => 220,  'per' => 1,  'req' => false, 'desc' => '3m fairy light curtain with stand.' ],
			],
		],
		[
			'title'    => 'Wedding',
			'icon'     => '💍',
			'content'  => 'Your dream wedding brought to life. From intimate ceremonies to grand receptions — every detail crafted with love.',
			'calendly' => '',
			'items'    => [
				[ 'title' => 'Floral Ceremony Arch',            'cat' => 'flowers',       'type' => 'flat',       'price' => 1200, 'per' => 1,  'req' => false, 'desc' => 'Lush floral arch for the ceremony backdrop, 2.5m wide.' ],
				[ 'title' => 'Aisle Carpet Runner (10m)',       'cat' => 'decor',         'type' => 'flat',       'price' => 220,  'per' => 1,  'req' => false, 'desc' => '10m aisle runner in white, ivory or blush.' ],
				[ 'title' => 'Chair Covers + Sashes',           'cat' => 'furniture',     'type' => 'per_person', 'price' => 12,   'per' => 1,  'req' => false, 'desc' => 'Chair cover and matching sash per guest seat.' ],
				[ 'title' => 'Ceiling Fabric Draping',          'cat' => 'decor',         'type' => 'flat',       'price' => 800,  'per' => 1,  'req' => false, 'desc' => 'Soft ceiling drape in organza or chiffon.' ],
				[ 'title' => 'Floral Centrepieces (tall)',      'cat' => 'flowers',       'type' => 'per_table',  'price' => 95,   'per' => 10, 'req' => false, 'desc' => 'Tall vase floral centrepiece per table.' ],
				[ 'title' => 'Wedding Cake — 3-tier',           'cat' => 'catering',      'type' => 'flat',       'price' => 850,  'per' => 1,  'req' => false, 'desc' => '3-tier custom wedding cake, serves up to 80.' ],
				[ 'title' => 'Wedding Cake — 4-tier',           'cat' => 'catering',      'type' => 'flat',       'price' => 1400, 'per' => 1,  'req' => false, 'desc' => '4-tier custom wedding cake, serves 80–150.' ],
				[ 'title' => 'Photography + Videography (8 hrs)', 'cat' => 'photography', 'type' => 'flat',       'price' => 2800, 'per' => 1,  'req' => false, 'desc' => 'Full-day coverage, 400+ photos + highlight reel.' ],
				[ 'title' => 'Dressing Table (mirror + flowers)', 'cat' => 'decor',       'type' => 'flat',       'price' => 380,  'per' => 1,  'req' => false, 'desc' => 'Oval mirror dressing table styled with flowers.' ],
				[ 'title' => 'Vintage Car Hire',                'cat' => 'transport',     'type' => 'flat',       'price' => 550,  'per' => 1,  'req' => false, 'desc' => 'Classic vintage car for the bridal party, 4 hrs.' ],
				[ 'title' => 'Chairs (Tiffany / Chiavari)',     'cat' => 'furniture',     'type' => 'per_person', 'price' => 12,   'per' => 1,  'req' => true,  'desc' => 'Elegant Tiffany chairs per guest.' ],
				[ 'title' => 'Round Tables (dressed)',          'cat' => 'furniture',     'type' => 'per_table',  'price' => 65,   'per' => 10, 'req' => true,  'desc' => 'Round banquet table with premium linen, 1 per 10 guests.' ],
				[ 'title' => 'Fairy Light Canopy',              'cat' => 'decor',         'type' => 'flat',       'price' => 900,  'per' => 1,  'req' => false, 'desc' => 'Overhead fairy light canopy, covers up to 100 sqm.' ],
				[ 'title' => 'Bridal Bouquet + 3 Bridesmaids', 'cat' => 'flowers',       'type' => 'flat',       'price' => 320,  'per' => 1,  'req' => false, 'desc' => 'Bridal bouquet and 3 matching bridesmaid bouquets.' ],
				[ 'title' => 'Candelabra Table Displays',       'cat' => 'decor',         'type' => 'per_table',  'price' => 45,   'per' => 10, 'req' => false, 'desc' => 'Gold candelabra centrepiece per table.' ],
			],
		],
		[
			'title'    => 'Baby Shower',
			'icon'     => '🎀',
			'content'  => 'Dreamy pastel setups that celebrate the arrival of your little one. Balloon clouds, floral walls and sweet dessert tables.',
			'calendly' => '',
			'items'    => [
				[ 'title' => 'Balloon Installation',            'cat' => 'decor',         'type' => 'flat',       'price' => 280,  'per' => 1,  'req' => false, 'desc' => 'Organic balloon installation in pastel tones.' ],
				[ 'title' => 'Photo Backdrop / Floral Wall',    'cat' => 'decor',         'type' => 'flat',       'price' => 250,  'per' => 1,  'req' => false, 'desc' => 'Artificial floral wall backdrop, 2m wide.' ],
				[ 'title' => 'Dessert Table Setup',             'cat' => 'catering',      'type' => 'flat',       'price' => 300,  'per' => 1,  'req' => false, 'desc' => 'Styled dessert table with themed signage.' ],
				[ 'title' => 'Nappy Cake (3-tier)',             'cat' => 'decor',         'type' => 'flat',       'price' => 150,  'per' => 1,  'req' => false, 'desc' => 'Decorative nappy cake as gift + centrepiece.' ],
				[ 'title' => 'Floral Arrangements (x3)',        'cat' => 'flowers',       'type' => 'flat',       'price' => 200,  'per' => 1,  'req' => false, 'desc' => '3 fresh floral arrangements in soft pastels.' ],
				[ 'title' => 'Chairs',                         'cat' => 'furniture',     'type' => 'per_person', 'price' => 8,    'per' => 1,  'req' => true,  'desc' => 'White Tiffany chairs per guest.' ],
				[ 'title' => 'Round Tables (dressed)',          'cat' => 'furniture',     'type' => 'per_table',  'price' => 50,   'per' => 10, 'req' => true,  'desc' => 'Dressed round table, 1 per 10 guests.' ],
				[ 'title' => 'Photography (3 hrs)',             'cat' => 'photography',   'type' => 'flat',       'price' => 600,  'per' => 1,  'req' => false, 'desc' => '3-hour photography package.' ],
			],
		],
		[
			'title'    => 'Graduation',
			'icon'     => '🎓',
			'content'  => 'Honour your graduate with personalised decor, photo walls and elegant table settings that reflect their achievement.',
			'calendly' => '',
			'items'    => [
				[ 'title' => 'Personalised Photo Wall',         'cat' => 'decor',         'type' => 'flat',       'price' => 300,  'per' => 1,  'req' => false, 'desc' => 'Custom printed photo wall with graduate\'s photos.' ],
				[ 'title' => 'Balloon Column Pair',             'cat' => 'decor',         'type' => 'flat',       'price' => 180,  'per' => 1,  'req' => false, 'desc' => 'Two matching balloon columns in school/uni colours.' ],
				[ 'title' => 'Table Centrepieces',              'cat' => 'decor',         'type' => 'per_table',  'price' => 30,   'per' => 10, 'req' => false, 'desc' => 'Themed centrepiece per table.' ],
				[ 'title' => 'Chairs',                         'cat' => 'furniture',     'type' => 'per_person', 'price' => 8,    'per' => 1,  'req' => true,  'desc' => 'Tiffany chairs per guest.' ],
				[ 'title' => 'Round Tables (dressed)',          'cat' => 'furniture',     'type' => 'per_table',  'price' => 50,   'per' => 10, 'req' => true,  'desc' => 'Dressed round table, 1 per 10 guests.' ],
				[ 'title' => 'Photography (3 hrs)',             'cat' => 'photography',   'type' => 'flat',       'price' => 650,  'per' => 1,  'req' => false, 'desc' => '3-hour event photography.' ],
				[ 'title' => 'Dessert Table',                   'cat' => 'catering',      'type' => 'flat',       'price' => 280,  'per' => 1,  'req' => false, 'desc' => 'Themed dessert table with cake and sweet treats.' ],
			],
		],
	];

	foreach ( $event_types as $et ) {
		// Create event type post
		$event_post_id = wp_insert_post( [
			'post_title'   => $et['title'],
			'post_content' => $et['content'],
			'post_type'    => 'luminar_event',
			'post_status'  => 'publish',
		] );

		if ( is_wp_error( $event_post_id ) ) continue;

		update_post_meta( $event_post_id, '_luminar_icon', $et['icon'] );
		update_post_meta( $event_post_id, '_luminar_calendly_url', $et['calendly'] );

		// Create items for this event
		foreach ( $et['items'] as $item ) {
			$item_id = wp_insert_post( [
				'post_title'  => $item['title'],
				'post_type'   => 'luminar_item',
				'post_status' => 'publish',
			] );

			if ( is_wp_error( $item_id ) ) continue;

			update_post_meta( $item_id, '_luminar_item_event',    $event_post_id );
			update_post_meta( $item_id, '_luminar_item_category', $item['cat'] );
			update_post_meta( $item_id, '_luminar_price_type',    $item['type'] );
			update_post_meta( $item_id, '_luminar_base_price',    $item['price'] );
			update_post_meta( $item_id, '_luminar_guests_per_unit', $item['per'] );
			update_post_meta( $item_id, '_luminar_item_desc',     $item['desc'] );
			update_post_meta( $item_id, '_luminar_item_required', $item['req'] ? '1' : '0' );
		}
	}

	// Create the Book Event page if it doesn't exist
	$existing = get_page_by_path( 'book-event' );
	if ( ! $existing ) {
		wp_insert_post( [
			'post_title'     => 'Book an Event',
			'post_name'      => 'book-event',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'page_template'  => 'page-book-event.php',
		] );
	}

	update_option( 'luminar_events_seeded_v1', true );
}
add_action( 'admin_init', 'luminar_seed_event_data' );

/* ============================================================
   10. ADMIN NOTICE — reseed button
   ============================================================ */

function luminar_booking_admin_notice() {
	if ( ! current_user_can( 'manage_options' ) ) return;

	// Handle reseed action
	if ( isset( $_GET['luminar_reseed'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ?? '' ) ), 'luminar_reseed' ) ) {
		delete_option( 'luminar_events_seeded_v1' );
		luminar_seed_event_data();
		echo '<div class="notice notice-success"><p>Event dummy data reseeded successfully.</p></div>';
		return;
	}

	$screen = get_current_screen();
	if ( ! $screen || $screen->post_type !== 'luminar_event' ) return;

	$reseed_url = wp_nonce_url( add_query_arg( 'luminar_reseed', '1' ), 'luminar_reseed' );
	echo '<div class="notice notice-info"><p><strong>Luminar Event Booking:</strong> Dummy data is seeded. <a href="' . esc_url( $reseed_url ) . '">Reseed dummy data</a></p></div>';
}
add_action( 'admin_notices', 'luminar_booking_admin_notice' );
