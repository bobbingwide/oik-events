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

