<?php

function oik_events_lazy_bindings_callback( $source_args, $block_instance, $attribute_name ) {

	bw_trace2( $source_args, "source_args", false );
	bw_trace2( $attribute_name, "attribute_name", false );
	bw_trace2( $block_instance->context, "context", false );
	/*
	if ( isset( $source_args['label'] ) ) {
		return "Event date";
	}
	*/
	$id  =$block_instance->context['postId'];

	switch ( $source_args['key'] ) {
		case 'event_when':
			$html=oik_events_theme_field( '_date', $id );
			$html.=' @ ';
			$html.=oik_events_theme_field( '_start_time', $id );
			$html .= ' - ';
			$html.=oik_events_theme_field( '_end_time', $id );
			return $html;

		case 'event_where':
			$html = oik_events_theme_field( '_address', $id );
			return $html;

		case 'event_cost':
			$html = oik_events_theme_field( '_cost', $id );
			return $html;

		case 'event_contact':
			$html = oik_events_theme_field( '_contact_name', $id );
			$html .= '<br />';
			$html .= oik_events_theme_field( '_contact_phone', $id );
			$html .= '<br />';
			$html .= oik_events_theme_field( '_contact_email', $id );
			$html .= '<br />';
			$html .= oik_events_theme_field( '_contact_url', $id );
			return $html;
		/*
		$date=get_post_meta( $id, '_date', true );
		if ( $date ) {
			$format=get_option( 'date_format' );
			$date  =strtotime( $date );
			$date  =date_i18n( $format, $date );
		}
		*/
		default:
			$field = oik_events_theme_field( $source_args['key'], $id );
			return $field;
	}
	return null;



}

function oik_events_theme_field( $key, $id ) {
	bw_trace2();
	//gob();
	$value = get_post_meta( $id, $key, true );
	bw_push();
	bw_format_field( [ $key => $value] );
	$html = bw_ret();
	bw_pop();
	return $html;
}
