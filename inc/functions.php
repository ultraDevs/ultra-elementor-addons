<?php

/**
 * Functions for Ultra Elementor Addons
 * 
 * @package Ultra_Addons
 */

/**
 * Generate Addons Demo Link
 */
if ( ! function_exists( 'ultra_addons_get_addons_demo_link') ) {
    function ultra_addons_get_addons_demo_link( $addon) {
        $demo_url = 'https://addons.ultradevs.com/';
        return $demo_url . $addon;
    }
}

/**
 * Check widget status
 */

if ( ! function_exists( 'ultra_addons_widget_status') ) {
    function ultra_addons_widget_status( $widget ) {
        $inactive_widgets = get_option( 'ultra_addons_inactive_addons', [] );

        if ( in_array( $widget, $inactive_widgets ) ) {
            return 'inactive';
        }
        else {
            return 'active';
        }
    }
}

/**
 * Html Tag list for title
 */
if ( ! function_exists( 'ultra_addons_get_title_tag') ) {
    function ultra_addons_get_title_tag() {
        return [
            'h1' => esc_html__('H1', 'ultra-addons'),
            'h2' => esc_html__('H2', 'ultra-addons'),
            'h3' => esc_html__('H3', 'ultra-addons'),
            'h4' => esc_html__('H4', 'ultra-addons'),
            'h5' => esc_html__('H5', 'ultra-addons'),
            'h6' => esc_html__('H6', 'ultra-addons'),
            'p' => esc_html__('P', 'ultra-addons'),
            'div' => esc_html__('Div', 'ultra-addons'),
            'span' => esc_html__('Span', 'ultra-addons'),
        ];
    }
}

/**
 * HTML Tag list
 */
if ( ! function_exists( 'ultra_addons_get_c_tags') ) {
    function ultra_addons_get_c_tags() {
        return [
            'div' => esc_html__( 'Div', 'ultra-addons' ),
            'section' => esc_html__( 'Section', 'ultra-addons' ),
        ];
    }
}

/**
 * Get Widgets Scripts
 */
if ( ! function_exists( 'ultra_addons_get_widget_vendor_js') ) {
    function ultra_addons_get_widget_vendor_js( $widget ) {
        switch ($widget) {
            case 'testimonial-carousel':
                $vendor = [
                    'jquery', 'ua-owl'
                ];
                break;
            case 'team-members-carousel':
                $vendor = [
                    'jquery', 'ua-slick'
                ];
                break;
            case 'image-comparison':
                $vendor = [
                    'ua-event-move', 'ua-twentytwenty'
                ];
                break;
            default:
                $vendor = [ 'jquery' ];
                break;
        }
        return $vendor;
    }
}

/**
 * Get Widgets Styles
 */
if ( ! function_exists( 'ultra_addons_get_widget_vendor_css') ) {
    function ultra_addons_get_widget_vendor_css( $widget ) {
        switch ($widget) {
            case 'testimonial-carousel':
                $vendor = [
                    'ua-owl', 'ua-owl-default'
                ];
                break;
            case 'team-members-carousel':
                $vendor = [
                    'ua-slick'
                ];
                break;
            case 'image-comparison':
                $vendor = [
                    'ua-twentytwenty'
                ];
                break;
            default:
                $vendor = [  ];
                break;
        }
        return $vendor;
    }
}