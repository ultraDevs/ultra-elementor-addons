<?php

/**
 * Widgets Manager Class
 * 
 * @package Ultra_Addons
 */

namespace UltraAddons_Inc\Base;

defined('ABSPATH') || die();

class Widgets_Manager {
    const W_DB_KEY = 'ultra_addons_inactive_widgets';
    /**
     * Initialize
     */
    public static function init() {
        // Register custom widgets
        add_action( 'elementor/widgets/widgets_registered', [ __CLASS__, 'register' ] );
    }

    /**
     * Inactive Widgets
     */
    public static function get_inactive_widgets() {
        return get_option( self::W_DB_KEY, [] );
    }
    /**
     * Save Inactive Widgets
     */
    public static function save_inactive_widgets( $widgets = [] ) {
        update_option( Self::W_DB_KEY , $widgets );
    }
    /**
     * Get all free widgets map
     * 
     * @return array Widgets info
     */
    public static function get_free_widgets_map() {
        $widgets = [
            'animated_headlines' => [
                'title' => __( 'Animated Headlines', 'ultra-addons' ),
                'icon'  => 'eicon-animated-headline',
                'demo'  => ultra_addons_get_addons_demo_link( 'animated-headlines'),
                'enqueue' => [ 'css', 'js' ],
                'is_pro' => false,
            ],
            'accordion' => [
                'title' => __( 'Accordion', 'ultra-addons'),
                'icon'  => 'eicon-accordion',
                'demo'  => ultra_addons_get_addons_demo_link( 'accordion'),
                'enqueue' => [ 'css', 'js' ],
                'is_pro' => false,
            ],
            'box' => [
                'title' => __( 'Box', 'ultra-addons'),
                'icon'  => 'eicon-info-box',
                'demo'  => ultra_addons_get_addons_demo_link( 'box'),
                'enqueue' => [ 'css'],
                'is_pro' => false,
            ],
            'testimonial' => [
                'title' => __( 'Testimonial', 'ultra-addons'),
                'icon'  => 'eicon-testimonial',
                'demo'  => ultra_addons_get_addons_demo_link( 'testimonial'),
                'enqueue' => [ 'css' ],
                'is_pro' => false,
            ],
            'testimonial_carousel' => [
                'title' => __( 'Testimonial Carousel', 'ultra-addons'),
                'icon'  => 'eicon-testimonial-carousel',
                'demo'  => ultra_addons_get_addons_demo_link( 'testimonial-carousel'),
                'enqueue' => [ 'css', 'js' ],
                'is_pro' => true,
            ],
            'team_members_carousel' => [
                'title' => __( 'Team Members Carousel', 'ultra-addons'),
                'icon'  => 'ua-icon eicon-person',
                'demo'  => ultra_addons_get_addons_demo_link( 'team-members-carousel'),
                'enqueue' => [ 'css', 'js' ],
                'is_pro' => true,
            ],
            'team_member' => [
                'title' => __( 'Team Member', 'ultra-addons'),
                'icon'  => 'eicon-lock-user',
                'demo'  => ultra_addons_get_addons_demo_link( 'team-member'),
                'enqueue' => [ 'css' ],
                'is_pro' => false,
            ],
            'image_comparison' => [
                'title' => __( 'Image Comparison', 'ultra-addons'),
                'icon'  => 'eicon-image',
                'demo'  => ultra_addons_get_addons_demo_link( 'image-comparison'),
                'enqueue' => [ 'css', 'js' ],
                'is_pro' => false,
            ],
        ];
        uksort( $widgets, [ __CLASS__, 'ua_custom_sort'] );
        return $widgets;
    }
    public static function ua_custom_sort( $a, $b) {
            return strcasecmp( $a, $b);
        }
    /**
     * Register
     */
    public static function register() {
        $inactive_widgets = self::get_inactive_widgets();
        foreach ( self::get_free_widgets_map() as $widget_key => $data) {
            if ( ultra_addons_fs()->is_not_paying() ) {
                if ( $data['is_pro'] == true ) {
                    continue;
                }
            }
            if ( ! in_array( $widget_key, $inactive_widgets )) {
                self::register_widget( ucfirst( $widget_key ) );
            }
        }
    }

    public static function register_widget( $widget_key) {
        $key = preg_replace_callback('/_([a-z]?)/', function($match) {
            return strtoupper($match[1]);
        }, ucfirst( $widget_key ) );

        $widget_file = ULTRA_ADDONS_PATH . 'inc/Widgets/' . $key .'.php';

        if ( file_exists( $widget_file ) ) {
            $widget_class = 'UltraAddons_Inc\Widgets\\' . $key;
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $widget_class );
        }
    }
}