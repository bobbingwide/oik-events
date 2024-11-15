<?php
/**
 * @copyright (C) Copyright Bobbing Wide 2024
 */

function oik_events_event_day( $date, $id ) {
	bw_trace2();
	$day=bw_format_date( $date, 'D' );
	return $day;
}

function oik_events_event_mon( $date, $id ) {
	bw_trace2();
	$timestamp = strtotime( $date );
	$mon=date_i18n( 'M', $timestamp );
	return $mon;
}

function oik_events_event_dd( $date, $id ) {
	bw_trace2();
	$day=bw_format_date( $date, 'j' );
	return $day;
}


function oik_events_event_calendar_date( $date, $id) {
	$calendar_date = oik_events_event_mon( $date,$id  );
	$calendar_date .= '<br />';
	$calendar_date .= oik_events_event_dd( $date, $id );
	$calendar_date .= '<br />';
	$calendar_date .= oik_events_event_day( $date, $id );
	return $calendar_date;
}


/**
 * Displays the When: date and start and end times.
 *
 * @TODO: the oik_events_theme_field logic should be replaced by code that doesn't need to access the metadata
 * if already known.
 *
 * @param $date
 * @param $start_time
 * @param $end_time
 * @param $id
 *
 * @return string
 */
function oik_events_event_when( $date, $start_time, $end_time, $id ) {
	oik_require( 'includes/oik-events-bindings.php', 'oik-events');
	$html=oik_events_theme_field( '_date', $id );
	$html.=' @ ';
	$html.=oik_events_theme_field( '_start_time', $id );
	$html.=' - ';
	$html.=oik_events_theme_field( '_end_time', $id );

	return $html;
}

/**
 * Displays the contact information.
 *
 */
function oik_events_event_contact( $contact_name, $contact_phone, $contact_email, $contact_url, $id ) {
	oik_require( 'includes/oik-events-bindings.php', 'oik-events');
		$html = oik_events_theme_field( '_contact_name', $id );
		$html .= '<br />';
		$html .= oik_events_theme_field( '_contact_phone', $id );
		$html .= '<br />';
		$html .= oik_events_theme_field( '_contact_email', $id );
		$html .= '<br />';
		$html .= oik_events_theme_field( '_contact_url', $id );
		return $html;
}