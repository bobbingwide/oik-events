<?php
/**
 * @copyright (C) Bobbing Wide 2024
 * @package oik-events
 *
 * Implement virtual fields for Events
 *
 * Virtual field  | Uses   | Values
 * -------------  | ----- | ------
 * event_day | _date | Mon - Sun
 * event_mon | _date | Jan - Dec
 * event_dd |  _date | 1 - 31
 * event_dom | _date | 1 - 31   = dom = day of month? - not necessary
 * event_date |
 */

function oik_events_lazy_register_virtual_fields() {

	$field_args=array( 	"#callback"=>"oik_events_event_day",
		"#parms"   =>"_date",
		"#plugin"  =>"oik-events",
		"#file"    =>"includes/oik-events-theme-virtual-fields.php",
		"#form"    =>false,
		"hint"     =>__( "virtual field", "oik-events" ),
		"#theme" => false
		);
	bw_register_field( "event_day", "virtual", "Event day", $field_args );
	bw_register_field_for_object_type( 'event_day', 'event', true );
	//oik_events_register_post_meta( 'event_day', 'event', __( 'Event day', 'oik-events'));

	$field_args=array( 	"#callback"=>"oik_events_event_mon",
	                      "#parms"   =>"_date",
	                      "#plugin"  =>"oik-events",
	                      "#file"    =>"includes/oik-events-theme-virtual-fields.php",
	                      "#form"    =>false,
	                      "hint"     =>__( "virtual field", "oik-events" ),
	                      "#theme" => false
	);
	bw_register_field( "event_mon", "virtual", "Event mon", $field_args );
	bw_register_field_for_object_type( 'event_mon', 'event', true );

	$field_args=array( 	"#callback"=>"oik_events_event_dd",
	                      "#parms"   =>"_date",
	                      "#plugin"  =>"oik-events",
	                      "#file"    =>"includes/oik-events-theme-virtual-fields.php",
	                      "#form"    =>false,
	                      "hint"     =>__( "virtual field", "oik-events" ),
	                      "#theme" => false
	);
	bw_register_field( "event_dd", "virtual", "Event day of month", $field_args );
	bw_register_field_for_object_type( 'event_dd', 'event', true );

	$field_args=array( 	"#callback"=>"oik_events_event_calendar_date",
	                      "#parms"   =>"_date",
	                      "#plugin"  =>"oik-events",
	                      "#file"    =>"includes/oik-events-theme-virtual-fields.php",
	                      "#form"    =>false,
	                      "hint"     =>__( "virtual field", "oik-events" ),
	                      "#theme" => false
	);
	bw_register_field( "event_cal", "virtual", "Event calendar date", $field_args );
	bw_register_field_for_object_type( 'event_cal', 'event', true );

	/*
	 * case 'event_when':
			$html=oik_events_theme_field( '_date', $id );
			$html.=' @ ';
			$html.=oik_events_theme_field( '_start_time', $id );
			$html .= ' - ';
			$html.=oik_events_theme_field( '_end_time', $id );
			return $html;
	 */
	$field_args=array( 	"#callback"=>"oik_events_event_when",
	                      "#parms"   =>"_date,_start_time,_end_time",
	                      "#plugin"  =>"oik-events",
	                      "#file"    =>"includes/oik-events-theme-virtual-fields.php",
	                      "#form"    =>false,
	                      "hint"     =>__( "virtual field", "oik-events" ),
		"#theme" => false
	);
	bw_register_field( "event_when", "virtual", "Event when", $field_args );
	bw_register_field_for_object_type( 'event_when', 'event', true );

	$field_args=array( 	"#callback"=>"oik_events_event_contact",
	                      "#parms"   =>"_contact_name,_contact_phone,_contact_email,_contact_url",
	                      "#plugin"  =>"oik-events",
	                      "#file"    =>"includes/oik-events-theme-virtual-fields.php",
	                      "#form"    =>false,
	                      "hint"     =>__( "virtual field", "oik-events" ),
	                      "#theme" => false
	);
	bw_register_field( "event_contact", "virtual", "Contact", $field_args );
	bw_register_field_for_object_type( 'event_contact', 'event', true );

	$field_args=array( 	"#callback"=>"oik_events_event_tickets",
	                      "#parms"   =>"_ticket_url,_date",
	                      "#plugin"  =>"oik-events",
	                      "#file"    =>"includes/oik-events-theme-virtual-fields.php",
	                      "#form"    =>false,
	                      "hint"     =>__( "virtual field", "oik-events" ),
	                      "#theme" => false,
							"#theme_null" => false
	);
	bw_register_field( "event_tickets", "virtual", "Event tickets", $field_args );
	bw_register_field_for_object_type( 'event_tickets', 'event', true );

}