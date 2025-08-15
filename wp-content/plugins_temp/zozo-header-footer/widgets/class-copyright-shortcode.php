<?php
/**
 * Calling copyright shortcode.
 *
 * @package Copyright
 * @author zozothemes
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Helper class for the Copyright.
 *
 * @since 1.2.0
 */
class Copyright_Shortcode {

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_shortcode( 'zhf_current_year', [ $this, 'display_current_year' ] );
		add_shortcode( 'zhf_site_title', [ $this, 'display_site_title' ] );
		add_shortcode( 'zhf_site_link', [ $this, 'display_site_link' ] );
	}

	/**
	 * Get the zhf_current_year Details.
	 *
	 * @return array $zhf_current_year Get Current Year Details.
	 */
	public function display_current_year() {

		$zhf_current_year = gmdate( 'Y' );
		$zhf_current_year = do_shortcode( shortcode_unautop( $zhf_current_year ) );
		if ( ! empty( $zhf_current_year ) ) {
			return $zhf_current_year;
		}
	}

	/**
	 * Get site title of Site.
	 *
	 * @return string.
	 */
	public function display_site_title() {

		$zhf_site_title = get_bloginfo( 'name' );

		if ( ! empty( $zhf_site_title ) ) {
			return $zhf_site_title;
		}
	}
	
	/**
	 * Get site link of Site.
	 *
	 * @return string.
	 */
	public function display_site_link() {

		$zhf_site_title = get_bloginfo( 'name' );
		$zhf_site_link = get_site_url();

		if ( ! empty( $zhf_site_title ) ) {
			return '<a class="site-link" href="'. esc_url( $zhf_site_link ) .'">'. $zhf_site_title . '</a>';
		}
	}

}

new Copyright_Shortcode();
