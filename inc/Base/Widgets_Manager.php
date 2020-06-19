<?php

/**
 * Widgets Manager Class
 * 
 * @package Ultra_Addons
 */

namespace UA_Inc\Base;

defined('ABSPATH') || die();

class Widgets_Manager {
    const W_DB_KEY = 'ultra_addons_inactive_addons';
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
                'title' => __( 'Animated Headlines', UA_TD ),
                'icon'  => 'eicon-animated-headline',
                'demo'  => ua_get_addons_demo_link( 'animated-headlines'),
                'enqueue' => [ 'css', 'js' ],
            ],
            'accordion' => [
                'title' => __( 'Accordion', UA_TD),
                'icon'  => 'eicon-accordion',
                'demo'  => ua_get_addons_demo_link( 'accordion'),
                'enqueue' => [ 'css', 'js' ],
            ],
            'box' => [
                'title' => __( 'Box', UA_TD),
                'icon'  => 'eicon-info-box',
                'demo'  => ua_get_addons_demo_link( 'box'),
                'enqueue' => [ 'css'],
            ],
            'testimonial' => [
                'title' => __( 'Testimonial', UA_TD),
                'icon'  => 'eicon-testimonial',
                'demo'  => ua_get_addons_demo_link( 'testimonial'),
                'enqueue' => [ 'css' ],
            ],
            'testimonial_carousel' => [
                'title' => __( 'Testimonial Carousel', UA_TD),
                'icon'  => 'eicon-testimonial-carousel',
                'demo'  => ua_get_addons_demo_link( 'testimonial-carousel'),
                'enqueue' => [ 'css', 'js' ],
                'is_pro' => true,
            ],
            'team_members_carousel' => [
                'title' => __( 'Team Members Carousel', UA_TD),
                'icon'  => 'ua-icon eicon-person',
                'demo'  => ua_get_addons_demo_link( 'team-members-carousel'),
                'enqueue' => [ 'css', 'js' ],
                'is_pro' => true,
            ],
            'team_member' => [
                'title' => __( 'Team Member', UA_TD),
                'icon'  => 'eicon-lock-user',
                'demo'  => ua_get_addons_demo_link( 'team-member'),
                'enqueue' => [ 'css' ],
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
            if ( ua_fs()->is_not_paying() ) {
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
        $widget_file = UA_DIR_PATH . 'inc/Widgets/' . $widget_key .'.php';
        if ( file_exists( $widget_file ) ) {
            $widget_class = 'UA_Inc\Widgets\\' . ucwords( str_replace( '-', '_', $widget_key ));
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $widget_class );
        }
    }
}
