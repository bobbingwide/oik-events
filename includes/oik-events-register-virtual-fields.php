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
 * event_dom | _date | 1 - 31   = dom = day of month?
 */

function oik_events_lazy_register_virtual_fields() {

	$field_args=array( 	"#callback"=>"oik_events_event_day",
		"#parms"   =>"_date",
		"#plugin"  =>"oik-events",
		"#file"    =>"includes/oik-events-theme-virtual-fields.php",
		"#form"    =>false,
		"hint"     =>__( "virtual field", "oik-events" )
		);
	bw_register_field( "event_day", "virtual", "Event day", $field_args );

	$field_args=array( 	"#callback"=>"oik_events_event_mon",
	                      "#parms"   =>"_date",
	                      "#plugin"  =>"oik-events",
	                      "#file"    =>"includes/oik-events-theme-virtual-fields.php",
	                      "#form"    =>false,
	                      "hint"     =>__( "virtual field", "oik-events" )
	);
	bw_register_field( "event_mon", "virtual", "Event mon", $field_args );

	$field_args=array( 	"#callback"=>"oik_events_event_dd",
	                      "#parms"   =>"_date",
	                      "#plugin"  =>"oik-events",
	                      "#file"    =>"includes/oik-events-theme-virtual-fields.php",
	                      "#form"    =>false,
	                      "hint"     =>__( "virtual field", "oik-events" )
	);
	bw_register_field( "event_dd", "virtual", "Event day of month", $field_args );


}