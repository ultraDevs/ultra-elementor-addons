<?php

/**
 * @package Ultra_Addons
 * 
 * Plugin Name:     Ultra Elementor Addons
 * Plugin URI:      https://ultradevs.com/shop/wp/plugins/ultra-elementor-addons
 * Description:     <a href="https://addons.ultradevs.com">Ultra Elementor Addons</a> is a collection of helpful widget for Elementor.
 * Version: 1.0.0
 * Author:          ultraDevs
 * Author URI:      https://ultradevs.com
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     ultra-addons
 * Domain Path:     /languages
 */

defined('ABSPATH') || die();

define( 'ULTRA_ADDONS_TD', 'ultra-addons' );
define( 'ULTRA_ADDONS_VERSION', '1.0.0');
define( 'ULTRA_ADDONS_PATH', plugin_dir_path( __FILE__ ) );
define( 'ULTRA_ADDONS_URL', plugin_dir_url( __FILE__ ) );
define( 'ULTRA_ADDONS_ASSETS', ULTRA_ADDONS_URL . 'assets/');

define( 'ULTRA_ADDONS_MIN_ELEMENTOR_VER', '2.5.0');
define('ULTRA_ADDONS_MIN_PHP_VER', '5.4');

/**
 * Require Composer Autoload
 */
if ( file_exists( dirname(__FILE__) . '/vendor/autoload.php') ) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use Elementor\Elements_Manager;
use UltraAddons_Inc\Base\Widgets_Manager;

final class Ultra_Elementor_Addons
{
    /**
     * Constructor
     */

    public function __construct() {
        add_action( 'init', [ $this, 'i18n'] );
        add_action( 'plugin_loaded', [ $this, 'init'] );
        
        // if ( ! get_option( 'elementor_icon_manager_needs_update' ) ) {
        //     add_option( 'elementor_icon_manager_needs_update', 'yes' );
        //     add_option( 'elementor_load_fa4_shim', 'yes' );
        // }
    }

    /**
     * Instance
     * 
     * @access private
     * 
     * @static
     * 
     */
    private static $_instance = NULL;

    public static function instance() {
        if ( is_null( self::$_instance )) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Load Textdomain
     */
    public function i18n() {
        load_plugin_textdomain( 'ultra-addons' );
    }

    /**
     * Initialize the plugin
     */
    public function init() {
        // Check if Elementor installed and activated
        if ( !did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin'] );
            return;
        }
        // Check for required Elememtor Version
        if( ! version_compare( ELEMENTOR_VERSION, ULTRA_ADDONS_MIN_ELEMENTOR_VER, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }
        // Check for required PHP Version
        if( version_compare( PHP_VERSION, ULTRA_ADDONS_MIN_PHP_VER, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        // Widget Manager
        Widgets_Manager::init();

        // Register custom categories
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

    }
    /**
     * Missing main plugin admin notice
     */
    public function admin_notice_missing_main_plugin() {
        if( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        if( !is_plugin_active( 'elementor/elementor.php' ) )
        {
            $message = sprintf(
                esc_html__(' %1$s requires %2$s to be installed and activated. Please activate %2$s to continue.', 'ultra-addons' ),
                '<strong>' . esc_html__( 'Ultra Addons', 'ultra-addons' ) . '</strong>',
                '<strong>' . esc_html__( 'Elementor', 'ultra-addons' ) .'</strong>'
            );
            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        }
    }

    /**
     *  Min Elementor version admin notice
     */
    public function admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] )) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__(' %1$s requires %2$s version %3$s or greater.', 'ultra-addons'),
            '<strong>' . esc_html__('Ultra Addons', 'ultra-addons') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'ultra-addons') . '</strong>',
            ULTRA_ADDONS_MIN_ELEMENTOR_VER
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     *  Min PHP version admin notice
     */
    public function admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__(' %1$s requires %2$s version %3$s or greater.', 'ultra-addons'),
            '<strong>' . esc_html__('Ultra Addons', 'ultra-addons') . '</strong>',
            '<strong>' . esc_html__('PHP', 'ultra-addons') . '</strong>',
            ULTRA_ADDONS_MIN_PHP_VER
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Register category
     */
    public function add_category( Elements_Manager $elements_Manager ) {
        $elements_Manager->add_category(
            'ultra_addons_category',
            [
                'title' => __( 'Ultra Addons', 'ultra-addons' ),
                'icon'  => 'fa fa-home',
            ]
        );

        $elements_Manager->add_category(
            'ultra_addons_pro_category',
            [
                'title' => __( 'Ultra Addons Pro', 'ultra-addons' ),
                'icon'  => 'fa fa-home',
            ]
        );
    }
}

/**
 * Freemius Setup
 */
if ( function_exists( 'ultra_addons_fs' ) ) {
    ultra_addons_fs()->set_basename( true, __FILE__ );
} else {
    if ( ! function_exists( 'ultra_addons_fs' ) ) {
        // Create a helper function for easy SDK access.
        function ultra_addons_fs() {
            global $ultra_addons_fs;

            if ( ! isset( $ultra_addons_fs ) ) {
                // Include Freemius SDK.
                require_once dirname(__FILE__) . '/vendor/freemius/start.php';

                $ultra_addons_fs = fs_dynamic_init( array(
                    'id'                  => '5782',
                    'slug'                => 'ultra-addons',
                    'premium_slug'        => 'ultra-addons-pro',
                    'type'                => 'plugin',
                    'public_key'          => 'pk_b9b12399691068dc7e8c18ac718ab',
                    'is_premium'          => true,
                    'premium_suffix'      => 'Starter',
                    // If your plugin is a serviceware, set this option to false.
                    'has_premium_version' => true,
                    'has_addons'          => false,
                    'has_paid_plans'      => true,
                    'trial'               => array(
                        'days'               => 14,
                        'is_require_payment' => true,
                    ),
                    'menu'                => array(
                        'slug'           => 'ultra-addons',
                    ),
                    // Set the SDK to work in a sandbox mode (for development & testing).
                    // IMPORTANT: MAKE SURE TO REMOVE SECRET KEY BEFORE DEPLOYMENT.
                    'secret_key'          => 'sk_^e(Jd^Xy+!$:8M[2q_0qbwa5pQ$y;',
                ) );
            }

            return $ultra_addons_fs;
        }

        // Init Freemius.
        ultra_addons_fs();
        // Signal that SDK was initiated.
        do_action( 'ultra_addons_fs_loaded' );
    }
}

if ( class_exists( 'UltraAddons_Inc\\Init' ) ) {
    UltraAddons_Inc\Init::register_services();
}

Ultra_Elementor_Addons::instance();