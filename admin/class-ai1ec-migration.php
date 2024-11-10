<?php

class ai1ec_migration {

	private $avents;

	function __construct() {

	}

	function check_status() {
		$this->avents = $this->load_avents();
		e( count( $this->avents ));
		br();
		return count( $this->avents );
	}

	function process_avents() {
		foreach ( $this->avents as $avent ) {
			e( "Processing: " . $avent->ID );
			br();
			$fields = $this->get_event_fields( $avent->ID );
			$this->map_event_fields( $fields );
			$this->update_post( $avent );
			//bw_flush();
			//continue;
			break;
		}

	}

	function load_avents( $post_type='ai1ec_event') {
		oik_require( 'includes/bw_posts.php');
		$args = [ 'post_type' => $post_type
				, 'numberposts' => -1
				, 'orderby' => 'ID'
				, 'order' => 'ASC'
				, 'post_status' => 'any'
				];

		$avents = bw_get_posts( $args );
		return $avents;

	}

	function get_event_fields( $id ) {
		global $wpdb;
		$query = $wpdb->prepare( "SELECT * from {$wpdb->prefix}ai1ec_events where post_id = %d", $id);
		e( $query);
		$vars = $wpdb->get_results( $query);
		if ( $vars && count( $vars )) {
			$fields=$vars[0];
		} else {
			gob();
		}
		return $fields;
	}

	function map_event_fields( $fields ) {
		print_r( $fields);
		$_POST['_address'] = $fields->venue . ' ' . $fields->address;
		$_POST['_post_code'] = $fields->postal_code;
		$_POST['_contact_name'] = $fields->contact_name;
		$_POST['_contact_phone'] = $fields->contact_phone;
		$_POST['_contact_email'] = $fields->contact_email;
		$_POST['_cost'] = $this->get_cost( $fields->cost);
		$_POST['_contact_url'] = $fields->contact_url;
		$_POST['ticket_url'] = $fields->ticket_url;
		$_POST['_date'] = $this->get_date( $fields->start );
		$_POST['_lat'] = $this->get_latorlong( $fields->latitude );
		$_POST['_long'] = $this->get_latorlong( $fields->longitude );
		if ( $fields->allday) {
			$_POST['_start_time'] = '00:00';
			$_POST['_end_time'] = '23:59';
 		}
		else {
			$_POST['_start_time']=$this->get_time( $fields->start );
			$_POST['_end_time']  =$this->get_time( $fields->end );
		}

		//echo "_POST:";
		//print_r( $_POST);
		//gob();
	}

	function get_cost( $cost ) {
		$cost_fields = unserialize( $cost);
		if ( $cost_fields['is_free']) {
			if ( empty( $cost_fields['cost'] ) ) {
				$cost_fields['cost']='Free';
			} else {
				$cost_fields['cost'].=' FREE';
			}
		}

		//print_r( $cost_fields );
		return $cost_fields['cost'];
	}

	function get_date( $starttime ) {
		$date = bw_format_date( $starttime );
		return $date;
	}

	function get_time( $time ) {
		$time = bw_format_date( $time, 'H:i');
		return $time;
	}

	function get_latorlong( $latorlong ) {
		$value = ( $latorlong == 0.0 ) ? '' : $latorlong;
		return $value;
	}

	function update_post( $avent, $post_type='event' ) {
		$post = $avent;
		$post->post_type = $post_type;
		//print_r( $post );
		wp_update_post( $avent );
	}

	function reset_events() {
		$events = $this->load_avents( 'event');
		foreach ( $events as $event ) {
			$this->update_post( $event, 'ai1ec_event');
		}

	}

}