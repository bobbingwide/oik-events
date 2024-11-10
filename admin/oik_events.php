<?php

function oik_events_Lazy_admin_menu() {
	add_action( "save_post_event", "oik_events_save_post_event", 10, 2 );
	add_submenu_page( 'oik_menu', __( 'Events', 'oik-events'), __( 'Events', 'oik-events'), 'manage_options', 'oik_events_menu', 'oik_events_menu');
}

function oik_events_menu() {
	oik_require( 'admin/class-ai1ec-migration.php', 'oik-events');
	$ai1ec_migration = new ai1ec_migration();
	p( "OIK Events");
	$count = $ai1ec_migration->check_status();
	if ( $count ) {
		$ai1ec_migration->process_avents();
	} else {
		$reset = bw_array_get( $_REQUEST, 'reset', 'NO');
		p( "No events to migrate.");
		if ( $reset === 'YES') {
			$ai1ec_migration->reset_events();
		}
	}
	bw_flush();

}

/**
 * Implement "save_post_event" for event
 *
 * Here we attempt to set the _lat and _long fields if they're null and the _address and/or _post_code are set.
 *
 * Example data:
 * `
[_address] => (string) "28, Ballantrae Road,,Liverpool,LAN"
[_post_code] => (string) "L18 6JQ"
[_lat] => (string) null
[_long] => (string) null
`
 *
 * @param ID $post_id The ID of the post being saved
 * @param object $post the post object
 */
function oik_events_save_post_event( $post_id, $post ) {
	bw_trace2( $_POST, "_POST", true, BW_TRACE_DEBUG );
	oik_require( "admin/oik-admin.php" );
	$input['postal-code'] = bw_array_get( $_POST, "_post_code", null );
	$input['extended-address'] = bw_array_get( $_POST, "_address", null );
	if ( $input['postal-code'] || $input['extended-address'] ) {
		$input['lat'] = bw_array_get( $_POST, "_lat", false );
		$input['long'] = bw_array_get( $_POST, "_long", false );
		$input = oik_set_latlng( $input );
		bw_trace2( $input, "input", false, BW_TRACE_VERBOSE );
		$_POST['_lat'] = $input['lat'];
		$_POST['_long'] = $input['long'];
	}
}

