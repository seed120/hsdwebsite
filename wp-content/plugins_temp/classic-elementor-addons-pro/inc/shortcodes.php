<?php
class CEAShortcodes {
	
	public function __construct(){
		add_shortcode( 'videoframe', array( $this, 'ceaVideoIframe' ) );
		add_shortcode( 'video', array( $this, 'ceaVideo' ) );
		add_shortcode( 'videoframenon', array( $this, 'ceaVideoIframeNonParam' ) );
		
		//Event Schortcode
		add_shortcode( 'cea_tab_events', array( $this, 'ceaTabEvents' ) );
		add_shortcode( 'cea_tab_day_events', array( $this, 'ceaTabDailyEvents' ) );
		add_shortcode( 'cea_tab_event', array( $this, 'ceaTabEvent' ) );
    }
		
	public function ceaVideoIframe( $atts ) {
		$atts = shortcode_atts( array(
			'url' => '',
			'height' => '',
			'width' => '',
			'params' => ''
		), $atts );
		return '<iframe width="'. esc_attr( $atts['width'] ) .'" height="'. esc_attr( $atts['height'] ) .'" src="'. esc_url( $atts['url'] ) .'?'. esc_attr( $atts['params'] ) .'" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	}
	
	
	public function ceaVideoIframeNonParam( $atts ) {
		$atts = shortcode_atts( array(
			'url' => '',
			'height' => '',
			'width' => '',
			'params' => '',
			'allowfullscreen' => ''
		), $atts );
		return '<iframe width="'. esc_attr( $atts['width'] ) .'" height="'. esc_attr( $atts['height'] ) .'" src="'. esc_url( $atts['url'] ) .'?'. esc_attr( $atts['params'] ) .'" '. esc_attr( $atts['allowfullscreen'] ) .'></iframe>';
	}
	
	public function ceaVideo( $atts ) {
		$atts = shortcode_atts( array(
			'url' => '',
			'height' => '',
			'width' => '',
		), $atts );
		
		return '<video class="cea-custom-video" width="'. esc_attr( $atts['width'] ) .'" height="'. esc_attr( $atts['height'] ) .'" preload="true" style="max-width:100%;">
                    <source src="'. esc_url( $atts['url'] ) .'" type="video/mp4">
                </video>';
	}
	
} // Shortcode class end
$ceasc = new CEAShortcodes;