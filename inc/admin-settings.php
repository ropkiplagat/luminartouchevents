<?php
/**
 * Luminar Touch Events — Admin Settings Page
 * Allows the owner to manage event types and venue types from the WP admin.
 *
 * @package Luminar Touch Events
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ============================================================
   REGISTER ADMIN MENU
   ============================================================ */
add_action( 'admin_menu', 'luminar_admin_menu' );
function luminar_admin_menu() {
	add_menu_page(
		'Luminar Settings',
		'Luminar Settings',
		'manage_options',
		'luminar-settings',
		'luminar_settings_page',
		'dashicons-star-filled',
		30
	);
}

/* ============================================================
   SAVE SETTINGS
   ============================================================ */
add_action( 'admin_init', 'luminar_save_settings' );
function luminar_save_settings() {
	if (
		! isset( $_POST['luminar_settings_nonce'] ) ||
		! wp_verify_nonce( $_POST['luminar_settings_nonce'], 'luminar_save_settings' ) ||
		! current_user_can( 'manage_options' )
	) {
		return;
	}

	// Save venue types
	if ( isset( $_POST['luminar_venue_types'] ) ) {
		$venues = array_filter( array_map( 'sanitize_text_field', explode( "\n", wp_unslash( $_POST['luminar_venue_types'] ) ) ) );
		update_option( 'luminar_venue_types', implode( ',', $venues ) );
	}

	// Save event types
	if ( isset( $_POST['luminar_event_types'] ) ) {
		$events = array_filter( array_map( 'sanitize_text_field', explode( "\n", wp_unslash( $_POST['luminar_event_types'] ) ) ) );
		update_option( 'luminar_event_types', implode( ',', $events ) );
	}

	add_settings_error( 'luminar_settings', 'saved', 'Settings saved successfully!', 'updated' );
}

/* ============================================================
   SETTINGS PAGE HTML
   ============================================================ */
function luminar_settings_page() {
	$venue_types = implode( "\n", explode( ',', get_option( 'luminar_venue_types', 'Beach,Church,Hall,Garden,Other' ) ) );
	$event_types = implode( "\n", explode( ',', get_option( 'luminar_event_types', 'Baby Shower Styling,Bridal Shower Styling,Gender Reveal Party,Graduation Celebration,Citizenship Ceremony,Wedding Styling,Dinner Party Styling,Birthday Party Styling,Other' ) ) );
	settings_errors( 'luminar_settings' );
	?>
	<div class="wrap">
		<h1 style="display:flex;align-items:center;gap:10px;">
			<span style="color:#C9898A;">&#9733;</span> Luminar Touch Events — Settings
		</h1>
		<p style="color:#666;">Manage the dropdown options that appear on your booking form. One item per line.</p>

		<form method="post" action="">
			<?php wp_nonce_field( 'luminar_save_settings', 'luminar_settings_nonce' ); ?>

			<div style="display:grid;grid-template-columns:1fr 1fr;gap:30px;margin-top:20px;">

				<!-- VENUE TYPES -->
				<div style="background:#fff;padding:24px;border:1px solid #e0e0e0;border-radius:8px;border-top:4px solid #C9898A;">
					<h2 style="margin-top:0;color:#C9898A;">&#128205; Venue Types</h2>
					<p style="color:#666;font-size:13px;">These appear in the "Venue Type" dropdown on the enquiry form. One venue per line.</p>
					<textarea
						name="luminar_venue_types"
						rows="10"
						style="width:100%;font-size:14px;padding:10px;border:1px solid #ddd;border-radius:4px;resize:vertical;"
					><?php echo esc_textarea( $venue_types ); ?></textarea>
					<p style="color:#999;font-size:12px;margin-top:6px;">Example: Beach</p>
				</div>

				<!-- EVENT TYPES -->
				<div style="background:#fff;padding:24px;border:1px solid #e0e0e0;border-radius:8px;border-top:4px solid #C9898A;">
					<h2 style="margin-top:0;color:#C9898A;">&#127881; Event Types</h2>
					<p style="color:#666;font-size:13px;">These appear in the "Type of Event" dropdown on the enquiry form. One event per line.</p>
					<textarea
						name="luminar_event_types"
						rows="10"
						style="width:100%;font-size:14px;padding:10px;border:1px solid #ddd;border-radius:4px;resize:vertical;"
					><?php echo esc_textarea( $event_types ); ?></textarea>
					<p style="color:#999;font-size:12px;margin-top:6px;">Example: Birthday Party Styling</p>
				</div>

			</div>

			<div style="margin-top:24px;">
				<button type="submit" class="button button-primary" style="background:#C9898A;border-color:#b07070;font-size:14px;padding:8px 24px;height:auto;">
					&#10003; Save Settings
				</button>
			</div>

		</form>

		<div style="margin-top:40px;background:#fff8f8;border:1px solid #f0d0d0;border-radius:8px;padding:20px;">
			<h3 style="margin-top:0;color:#C9898A;">&#9432; How it works</h3>
			<ul style="color:#555;line-height:1.8;">
				<li><strong>Add</strong> a new option by typing it on a new line</li>
				<li><strong>Remove</strong> an option by deleting its line</li>
				<li><strong>Reorder</strong> by moving lines up or down</li>
				<li>Changes appear on the website <strong>immediately</strong> after saving</li>
			</ul>
		</div>
	</div>
	<?php
}
