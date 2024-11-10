<?php
/*
Plugin Name: oik-events
Plugin URI: https://github.com/bobbingwide/oik-events
Description: Events
Version: 0.0.0
Author: bobbingwide
Author URI: https://bobbingwide.com/about/bobbingwide
License: GPL2

    Copyright 2024 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/

/**
 * Implement "oik_admin_menu" action
 */
function oik_events_admin_menu() {
	oik_register_plugin_server( __FILE__ );
	oik_require( "admin/oik_events.php", "oik-events" );
	oik_events_lazy_admin_menu();
}

/**
 * Function to run when oik_events loaded
 */
function oik_events_loaded() {
	add_action( "oik_admin_menu", "oik_events_admin_menu" );
	add_action( "oik_fields_loaded", "oik_events_oik_fields_loaded" );
	add_filter( 'register_post_type_args', 'oik_events_register_post_type_args', 100 );
}


/**
 * Implement "oik_fields_loaded" for oik_events
 */
function oik_events_oik_fields_loaded() {

	oik_events_register_categories();
	oik_events_register_post_types();
}

/**
 * Register custom taxonomies for WP-Pompey
 *
 */
function oik_events_register_categories() {
	//bw_register_custom_category( "clinktype", null, "Clink type" );
}

/**
 * Register the custom post types for WP-Pompey
 */
function oik_events_register_post_types() {
	oik_events_register_event();
}

function oik_events_register_google_maps_fields( $post_type ) {

	bw_register_field( "_address", "textarea", "Address" );
	bw_register_field( "_post_code", "text", "Post Code" );
	bw_register_field( "_lat", "numeric", "Latitude", array( '#theme_null' => false, '#optional' => true ) );
	bw_register_field( "_long", "numeric", "Longitude", array( '#theme_null' => false, '#optional' => true ) );

	// Don't display this by default since the content may be nested
	//bw_register_field_for_object_type( "featured", $post_type );

	bw_register_field_for_object_type( "googlemap", $post_type );

	bw_register_field_for_object_type( "_address", $post_type );
	bw_register_field_for_object_type( "_post_code", $post_type );
	bw_register_field_for_object_type( "_lat", $post_type );
	bw_register_field_for_object_type( "_long", $post_type );

}

/**
 * Register a event
 *
 */
function oik_events_register_event() {
	$post_type = "event";
	$post_type_args = array();
	$post_type_args['label'] = 'Events';
	$post_type_args['description'] = 'Events';
	$post_type_args['supports'] = array( 'title', 'editor', 'thumbnail', 'excerpt', 'home', 'publicize', 'author', 'revisions' );
	$post_type_args['has_archive'] = true;
	$post_type_args['menu_icon'] = 'dashicons-flag';
	$post_type_args['show_in_rest'] = true;
	bw_register_post_type( $post_type, $post_type_args );

	bw_register_field( "_date", "date", "Date" );
	bw_register_field( "_start_time", "time", "Start time", array( '#theme_null' => false ) );
	bw_register_field( "_end_time", "time", "End time", array( '#theme_null' => false ) );
	bw_register_field( '_contact_name', 'text', 'Contact name');
	bw_register_field( '_contact_phone', 'text', 'Contact phone');
	bw_register_field( '_contact_email', 'email', 'Contact email');
	bw_register_field( '_contact_url', 'url', 'Contact URL');
	bw_register_field( '_ticket_url', 'url', 'Ticket URL');
	bw_register_field( '_cost', 'text', 'Cost');

	//
	// Attendees? Expected and actual
	//

	bw_register_field_for_object_type( "_date", $post_type );
	bw_register_field_for_object_type( "_start_time", $post_type );
	bw_register_field_for_object_type( "_end_time", $post_type );
	bw_register_field_for_object_type( "_contact_name", $post_type );
	bw_register_field_for_object_type( "_contact_phone", $post_type );
	bw_register_field_for_object_type( "_contact_email", $post_type );
	bw_register_field_for_object_type( "_contact_url", $post_type );
	bw_register_field_for_object_type( "_ticket_url", $post_type );
	bw_register_field_for_object_type( "_cost", $post_type );


	oik_events_register_google_maps_fields( $post_type );

}

function oik_events_register_post_type_args( $args ) {
	//gob();
	return $args;
}

oik_events_loaded();