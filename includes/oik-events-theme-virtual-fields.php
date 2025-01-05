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
	$html=oik_events_theme_field( '_start_date', $id );
	if ( oik_events_is_all_day( $start_time, $end_time )) {
		$html .= '<span class="sep"> </span>';
		$html .= '<span class="all-day">all-day</span>';
	} else {
		if ( $start_time !== '') {
			$html.='<span class="sep"> @ </span>';
			$html.=oik_events_theme_field( '_start_time', $id );
		}
		if ( $end_time !== '' ) {
			$html.='<span class="sep"> - </span>';
			$html.=oik_events_theme_field( '_end_time', $id );
		}
	}
	return $html;
}

/**
 * Determines if the event is all-day.
 *
 * $start_time | $end_time | all-day? | text
 * ----------- | --------- | -------- | --------
 * 00:00       | 23:59     | Y        | all-day
 * 00:00       | 00:00     | Y        | all-day
 * 00:00       | -         | ?        |
 * -           | -         | Y        | all-day
 * x           | y         | N        | @ x to y
 * x           | -         | N        | @ x
 * -           | y         | N        | to y
 *
 * @param $start_time
 * @param $end_time
 * @return bool
 */
function oik_events_is_all_day( $start_time, $end_time ) {
	$all_day = false;
	$stset = ( $start_time !== '' );
	$etset = ( $end_time !== '');
	if ( $start_time === '00:00' ) {
		switch ( $end_time ) {
			case '23:59':
			case '00:00':
			case '':
				$all_day = true;
				break;
			default:
				// $all_day is already false
		}
	} else {
		$stset = ( $start_time !== '' );
		$etset = ( $end_time !== '');
		$all_day = !$stset && !$etset ;
	}
	bw_trace2();
	return $all_day;

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

/*
 * <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="https://example.com/tickets" target="_blank" rel="noreferrer noopener">Tickets</a></div>
 */

function oik_events_event_tickets( $ticket_url, $date, $id ) {
	bw_trace2();
	bw_backtrace();
	$html = '';
	if ( empty($ticket_url ) ) {
		return $html;
	}
	//$html = '<div class="wp-block-button">';
	$html .= '<a class="p-block-button__link wp_element_button" href="';
	$html .= $ticket_url;
	$html .= '" target="_blank" rel="noreferrer noopener">';
	$html .= 'Tickets';
	$html .= '</a>';
	//$html .= '</div>';

	return $html;
}