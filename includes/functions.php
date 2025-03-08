<?php
/**
 * Functions for Ultra Elementor Addons
 *
 * @package Ultra_Elementor_Addons
 */

if ( ! function_exists( 'ultra_addons_get_addons_demo_link' ) ) {
	/**
	 * Generate Addons Demo Link
	 *
	 * @param string $addon Addon name.
	 */
	function ultra_addons_get_addons_demo_link( $addon ) {
		$demo_url = 'https://addons.ultradevs.com/';
		return $demo_url . $addon;
	}
}

if ( ! function_exists( 'ultra_addons_widget_status' ) ) {
	/**
	 * Get Widget Status
	 *
	 * @param string $widget Widget name.
	 */
	function ultra_addons_widget_status( $widget ) {
		$inactive_widgets = get_option( 'ultra_addons_inactive_addons', [] );

		if ( in_array( $widget, $inactive_widgets ) ) {
			return 'inactive';
		} else {
			return 'active';
		}
	}
}

if ( ! function_exists( 'ultra_addons_get_title_tag' ) ) {
	/**
	 * Html Tag list for title
	 */
	function ultra_addons_get_title_tag() {
		return [
			'h1'   => esc_html__( 'H1', 'ultra-elementor-addons' ),
			'h2'   => esc_html__( 'H2', 'ultra-elementor-addons' ),
			'h3'   => esc_html__( 'H3', 'ultra-elementor-addons' ),
			'h4'   => esc_html__( 'H4', 'ultra-elementor-addons' ),
			'h5'   => esc_html__( 'H5', 'ultra-elementor-addons' ),
			'h6'   => esc_html__( 'H6', 'ultra-elementor-addons' ),
			'p'    => esc_html__( 'P', 'ultra-elementor-addons' ),
			'div'  => esc_html__( 'Div', 'ultra-elementor-addons' ),
			'span' => esc_html__( 'Span', 'ultra-elementor-addons' ),
		];
	}
}


if ( ! function_exists( 'ultra_addons_get_c_tags' ) ) {
	/**
	 * HTML Tag list
	 */
	function ultra_addons_get_c_tags() {
		return [
			'div'     => esc_html__( 'Div', 'ultra-elementor-addons' ),
			'section' => esc_html__( 'Section', 'ultra-elementor-addons' ),
		];
	}
}

if ( ! function_exists( 'ultra_addons_get_widget_vendor_js' ) ) {
	/**
	 * Get Widgets Scripts.
	 *
	 * @param string $widget Widget name.
	 */
	function ultra_addons_get_widget_vendor_js( $widget ) {
		switch ( $widget ) {
			case 'testimonial-carousel':
				$vendor = [
					'jquery', 'ua-owl',
				];
				break;
			case 'team-members-carousel':
				$vendor = [
					'jquery', 'ua-slick',
				];
				break;
			case 'image-comparison':
				$vendor = [
					'ua-event-move', 'ua-twentytwenty',
				];
				break;
			default:
				$vendor = [ 'jquery' ];
				break;
		}
		return $vendor;
	}
}

if ( ! function_exists( 'ultra_addons_get_widget_vendor_css' ) ) {
	/**
	 * Get Widgets Styles.
	 *
	 * @param string $widget Widget name.
	 */
	function ultra_addons_get_widget_vendor_css( $widget ) {
		switch ( $widget ) {
			case 'testimonial-carousel':
				$vendor = [
					'ua-owl', 'ua-owl-default',
				];
				break;
			case 'team-members-carousel':
				$vendor = [
					'ua-slick',
				];
				break;
			case 'image-comparison':
				$vendor = [
					'ua-twentytwenty',
				];
				break;
			default:
				$vendor = [];
				break;
		}
		return $vendor;
	}
}
