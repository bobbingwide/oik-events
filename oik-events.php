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
	oik_events_register_virtual_fields();
	oik_events_register_block_bindings_source();
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

	bw_register_field_for_object_type( "googlemap", $post_type, true );

	bw_register_field_for_object_type( "_address", $post_type );
	bw_register_field_for_object_type( "_post_code", $post_type );
	bw_register_field_for_object_type( "_lat", $post_type );
	bw_register_field_for_object_type( "_long", $post_type );

}

function oik_events_register_virtual_fields() {
	oik_require( 'includes/oik-events-register-virtual-fields.php', 'oik-events' );
	oik_events_lazy_register_virtual_fields();

}

/**
 * Registers the event post type.
 *
 */
function oik_events_register_event() {
	$post_type = "event";
	$post_type_args = array();
	$post_type_args['label'] = 'Events';
	$post_type_args['description'] = 'Events';
	$post_type_args['supports'] = array( 'title', 'editor', 'thumbnail', 'excerpt', 'home', 'publicize', 'author', 'revisions', 'custom-fields' );
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

	oik_events_register_post_meta( '_date', $post_type, __( 'Date', 'oik-events') );
	oik_events_register_post_meta( '_start_time', $post_type, __( 'Start time', 'oik-events') );
	oik_events_register_post_meta( '_end_time', $post_type, __( 'End time', 'oik-events') );
	oik_events_register_post_meta( '_contact_name', $post_type, __( 'Contact name', 'oik-events') );
	bw_maybe_register_post_meta( '_contact_phone', $post_type, __( 'Contact phone', 'oik-events'));
	oik_events_register_post_meta( '_contact_email', $post_type, __( 'Contact email', 'oik-events') );
	oik_events_register_post_meta( '_contact_url', $post_type, __( 'Contact URL', 'oik-events') );
	oik_events_register_post_meta( '_ticket_url', $post_type, __( 'Ticket URL', 'oik-events') );
	oik_events_register_post_meta( '_cost', $post_type, __( 'Cost', 'oik-events') );
	oik_events_register_post_meta( '_address', $post_type, __( 'Address', 'oik-events'));
	oik_events_register_post_meta( '_post_code', $post_type, __( 'Post code', 'oik-events'));

	oik_events_register_google_maps_fields( $post_type );

}

function oik_events_register_post_type_args( $args ) {
	//gob();
	return $args;
}

/**
 * Registers the post meta to the REST API.
 *
 * register_post_meta() calls register_meta().
 *
 * @param $field
 * @param $post_type
 */
function oik_events_register_post_meta( $field, $post_type, $description ) {
	global $wp_meta_keys;
	bw_trace2( $wp_meta_keys, 'wp_meta_keys before', true, BW_TRACE_DEBUG );
	$registered =  register_post_meta( $post_type, $field,
		array('show_in_rest' => true,
		      'single' => true,
		      'type' => 'string',
		      'auth_callback' => 'oik_events_auth_callback',
		      'description' => $description,
				'default' => '',
			'label' => $description
		)
	);
	bw_trace2( $registered, 'registered?', false, BW_TRACE_VERBOSE );
	bw_trace2( $wp_meta_keys, 'wp_meta_keys after', false, BW_TRACE_VERBOSE );
}

function oik_events_auth_callback() {
	return current_user_can( 'edit_posts');
}

/**
 * Registers block bindings custom source.
 * @link https://developer.wordpress.org/news/2024/03/06/introducing-block-bindings-part-2-working-with-custom-binding-sources/
 *
 * @return void
 */
function oik_events_register_block_bindings_source() {

	register_block_bindings_source( 'oik-events/event-date', array(
		'label'              => __( 'Event date: Mon n Day', 'oik-events' ),
		'get_value_callback' => 'oik_events_bindings_callback',
		'uses_context'       => [ 'postId', 'postType' ]
	) );
	register_block_bindings_source( 'oik-events/event-when', array(
		'label'              => __( 'Event when: Mon n @ hh:mm - hh:mm', 'oik-events' ),
		'get_value_callback' => 'oik_events_bindings_callback',
		'uses_context'       => [ 'postId', 'postType' ]
	) );
	register_block_bindings_source( 'oik-events/event-where', array(
		'label'              => __( 'Event where', 'oik-events' ),
		'get_value_callback' => 'oik_events_bindings_callback',
		'uses_context'       => [ 'postId', 'postType' ]
	) );
	register_block_bindings_source( 'oik-events/event-cost', array(
		'label'              => __( 'Event cost', 'oik-events' ),
		'get_value_callback' => 'oik_events_bindings_callback',
		'uses_context'       => [ 'postId', 'postType' ]
	) );
	register_block_bindings_source( 'oik-events/event-contact', array(
		'label'              => __( 'Event contact', 'oik-events' ),
		'get_value_callback' => 'oik_events_bindings_callback',
		'uses_context'       => [ 'postId', 'postType' ]
	) );
}

/**
 *
 * An alternative to using [bw_field field_name] to display individual post meta fields or virtual fields.
 *
 * ```
 * <!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"oik-events/custom-source","args":{"key":"_date"}}}}} -->
 * <p>oik-events/custom-source</p>
 * <!-- /wp:paragraph -->
 * ```
 * @param $source_args
 * @param $block_instance
 * @param $attribute_name - probably 'content' for paragraphs
 *
 * @return string
 */
function oik_events_bindings_callback( $source_args, $block_instance, $attribute_name ) {
	oik_require( 'includes/oik-events-bindings.php', 'oik-events');
	return oik_events_lazy_bindings_callback( $source_args, $block_instance, $attribute_name );
}



oik_events_loaded();