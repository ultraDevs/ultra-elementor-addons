<?php

/**
 * Functions for Ultra Elementor Addons
 * 
 * @package Ultra_Addons
 */

/**
 * Generate Addons Demo Link
 */
function ua_get_addons_demo_link( $addon) {
    $demo_url = 'https://demo.ultradevs.com/ultra-addons/';
    return $demo_url . $addon;
}

/**
 * Check widget status
 */

function widget_status( $widget ) {
    $inactive_widgets = get_option( 'ultra_addons_inactive_addons', [] );

    if ( in_array( $widget, $inactive_widgets ) ) {
        return 'inactive';
    }
    else {
        return 'active';
    }
}

/**
 * Html Tag list for title
 */
function ua_get_title_tag() {
    return [
        'h1' => esc_html__('H1', UA_TD),
        'h2' => esc_html__('H2', UA_TD),
        'h3' => esc_html__('H3', UA_TD),
        'h4' => esc_html__('H4', UA_TD),
        'h5' => esc_html__('H5', UA_TD),
        'h6' => esc_html__('H6', UA_TD),
        'p' => esc_html__('P', UA_TD),
        'div' => esc_html__('Div', UA_TD),
        'span' => esc_html__('Span', UA_TD),
    ];
}

/**
 * HTML Tag list
 */
function ua_get_c_tags() {
    return [
        'div' => esc_html__( 'Div', UA_TD ),
        'section' => esc_html__( 'Section', UA_TD ),
    ];
}

/**
 * Get Widgets Scripts
 */
function get_widget_vendor_js( $widget ) {
    switch ($widget) {
        case 'testimonial-carousel':
            $vendor = [
                'jquery', 'ua-owl-js'
            ];
            break;
        case 'team-members-carousel':
            $vendor = [
                'jquery', 'ua-slick-js'
            ];
            break;
        default:
            $vendor = [ 'jquery' ];
            break;
    }
    return $vendor;
}

/**
 * Get Widgets Styles
 */
function get_widget_vendor_css( $widget ) {
    switch ($widget) {
        case 'testimonial-carousel':
            $vendor = [
                'ua-owl-css', 'ua-owl-default-css'
            ];
            break;
        case 'team-members-carousel':
            $vendor = [
                'ua-slick-css'
            ];
            break;
        default:
            $vendor = [  ];
            break;
    }
    return $vendor;
}