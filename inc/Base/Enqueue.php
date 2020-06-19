<?php 
/**
 * @package ultraCodeSnippetInserter
 */

namespace Inc\Base;

/**
 * Enqueue Scripts
 */

namespace UA_Inc\Base;
use UA_Inc\Base\Widgets_Manager;

defined('ABSPATH') || die();


class Enqueue
{

    /** 
     * Elementor 
     * 
     */
    function elementor_editor() {
        wp_enqueue_style( UA_TD . '-style-' . $widget_key, UA_ASSETS . 'admin/css/el-editor.css', '', UA_VERSION, 'all' );
    }
    /**
     * Enqueue public styles
     */
    public function enqueue_addons_styles_scripts()  {
        /**
         * Vendor
         */
        wp_register_style( 'ua-owl-css', UA_ASSETS . 'public/vendor/owl-carousel/css/owl.carousel.min.css', '', UA_VERSION, 'all' );
        wp_register_style( 'ua-owl-default-css', UA_ASSETS . 'public/vendor/owl-carousel/css/owl.theme.default.css', '', UA_VERSION, 'all' );
        wp_register_script( 'ua-owl-js', UA_ASSETS . 'public/vendor/owl-carousel/js/owl.carousel.min.js', [ 'jquery' ], UA_VERSION, true);
        
        wp_register_style( 'ua-slick-css', UA_ASSETS . 'public/vendor/slick/slick.css', '', UA_VERSION, 'all' );
        wp_register_style( 'ua-slick-css', UA_ASSETS . 'public/vendor/slick/slick-theme.css', '', UA_VERSION, 'all' );
        wp_register_script( 'ua-slick-js', UA_ASSETS . 'public/vendor/slick/slick.min.js', [ 'jquery' ], UA_VERSION, true);
        
        $inactive_widgets = Widgets_Manager::get_inactive_widgets();
        foreach ( Widgets_Manager::get_free_widgets_map() as $widget_key => $data) {

            if ( ! in_array( $widget_key, $inactive_widgets )) {
                
                $widget_key = str_replace( '_', '-', $widget_key );
                
                $is_css = in_array( 'css', $data['enqueue']);
                $is_js = in_array( 'js', $data['enqueue']);

                $vendor_js = get_widget_vendor_js( $widget_key );
                $vendor_css = get_widget_vendor_css( $widget_key );
                
                if ( $is_css ) {
                    wp_enqueue_style( UA_TD . '-style-' . $widget_key, UA_ASSETS . 'public/css/' . $widget_key .'.css', $vendor_css , UA_VERSION, 'all' );
                }
                if ( $is_js  ) {
                    wp_enqueue_script( UA_TD . '-script-' . $widget_key, UA_ASSETS . 'public/js/' . $widget_key .'.js', $vendor_js, UA_VERSION, true);
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