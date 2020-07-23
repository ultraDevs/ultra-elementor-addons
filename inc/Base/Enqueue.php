<?php 
/**
 * Enqueue Scripts
 */

namespace UltraAddons_Inc\Base;
use UltraAddons_Inc\Base\Widgets_Manager;

defined('ABSPATH') || die();


class Enqueue
{

    /** 
     * Elementor 
     * 
     */
    function elementor_editor() {
        wp_enqueue_style( 'ua-el-editor', ULTRA_ADDONS_ASSETS . 'admin/css/el-editor.css', '', ULTRA_ADDONS_VERSION, 'all' );
    }
    /**
     * Enqueue public styles
     */
    public function enqueue_addons_styles_scripts()  {
        /**
         * Vendor
         */
        wp_register_style( 'ua-owl', ULTRA_ADDONS_ASSETS . 'public/vendor/owl-carousel/css/owl.carousel.min.css', '', ULTRA_ADDONS_VERSION, 'all' );
        wp_register_style( 'ua-owl-default', ULTRA_ADDONS_ASSETS . 'public/vendor/owl-carousel/css/owl.theme.default.css', '', ULTRA_ADDONS_VERSION, 'all' );
        wp_register_script( 'ua-owl', ULTRA_ADDONS_ASSETS . 'public/vendor/owl-carousel/js/owl.carousel.min.js', [ 'jquery' ], ULTRA_ADDONS_VERSION, true);
        
        wp_register_style( 'ua-slick', ULTRA_ADDONS_ASSETS . 'public/vendor/slick/slick.css', '', ULTRA_ADDONS_VERSION, 'all' );
        wp_register_style( 'ua-slick', ULTRA_ADDONS_ASSETS . 'public/vendor/slick/slick-theme.css', '', ULTRA_ADDONS_VERSION, 'all' );
        wp_register_script( 'ua-slick', ULTRA_ADDONS_ASSETS . 'public/vendor/slick/slick.min.js', [ 'jquery' ], ULTRA_ADDONS_VERSION, true);
        
        wp_register_style( 'ua-twentytwenty', ULTRA_ADDONS_ASSETS . 'public/vendor/twentytwenty/css/twentytwenty.css', '', ULTRA_ADDONS_VERSION, 'all' );
        wp_register_script( 'ua-event-move', ULTRA_ADDONS_ASSETS . 'public/vendor/twentytwenty/js/jquery.event.move.js', [ 'jquery' ], ULTRA_ADDONS_VERSION, true);
        wp_register_script( 'ua-twentytwenty', ULTRA_ADDONS_ASSETS . 'public/vendor/twentytwenty/js/jquery.twentytwenty.js', [ 'jquery' ], ULTRA_ADDONS_VERSION, true);


        $inactive_widgets = Widgets_Manager::get_inactive_widgets();
        foreach ( Widgets_Manager::get_free_widgets_map() as $widget_key => $data) {

            if ( ! in_array( $widget_key, $inactive_widgets )) {
                
                $widget_key = str_replace( '_', '-', $widget_key );
                
                $is_css = in_array( 'css', $data['enqueue']);
                $is_js = in_array( 'js', $data['enqueue']);

                $vendor_js = ultra_addons_get_widget_vendor_js( $widget_key );
                $vendor_css = ultra_addons_get_widget_vendor_css( $widget_key );
                
                if ( $is_css ) {
                    wp_enqueue_style( 'ua-style-' . $widget_key, ULTRA_ADDONS_ASSETS . 'public/css/' . $widget_key .'.css', $vendor_css , ULTRA_ADDONS_VERSION, 'all' );
                }
                if ( $is_js  ) {
                    wp_enqueue_script( 'ua-script-' . $widget_key, ULTRA_ADDONS_ASSETS . 'public/js/' . $widget_key .'.js', $vendor_js, ULTRA_ADDONS_VERSION, true);
                }
            }
        }
    }
    
    /**
     * Register Method
     */
    public function register() {
        // Public
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_addons_styles_scripts' ]);
        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'elementor_editor' ] );
    }
}