<?php

/**
 * @package Ultra_Addons
 * 
 * Plugin Name:     Ultra Elementor Addons
 * Plugin URI:      https://ultradevs.com/shop/wp/plugins/ultra-lementor-addons
 * Description:     Ultra Elementor Addons
 * Version: 1.0.0
 * Author:          ultraDevs
 * Author URI:      https://ultradevs.com
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     ua
 * Domain Path:     /languages
 */

defined('ABSPATH') || die();

define( 'UA_TD', 'ua' );
define( 'UA_VERSION', '1.0.0');
define( 'UA_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'UA_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'UA_ASSETS', UA_DIR_URL . 'assets/');

define( 'UA_MIN_ELEMENTOR_VER', '2.5.0');
define('UA_MIN_PHP_VER', '5.4');

/**
 * Require Composer Autoload
 */
if ( file_exists( dirname(__FILE__) . '/vendor/autoload.php') ) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use Elementor\Elements_Manager;
use UA_Inc\Base\Widgets_Manager;

final class Ultra_Elementor_Addons
{
    /**
     * Constructor
     */

    public function __construct() {
        add_action( 'init', [ $this, 'i18n'] );
        add_action( 'plugin_loaded', [ $this, 'init'] );
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
        load_plugin_textdomain( UA_TD );
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
        if( ! version_compare( ELEMENTOR_VERSION, UA_MIN_ELEMENTOR_VER, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }
        // Check for required PHP Version
        if( version_compare( PHP_VERSION, UA_MIN_PHP_VER, '<' ) ) {
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
                esc_html__(' %1$s requires %2$s to be installed and activated. Please activate %2$s to continue.', UA_TD ),
                '<strong>' . esc_html__( 'Ultra Addons', UA_TD ) . '</strong>',
                '<strong>' . esc_html__( 'Elementor', UA_TD ) .'</strong>'
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
            esc_html__(' %1$s requires %2$s version %3$s or greater.', UA_TD),
            '<strong>' . esc_html__('Ultra Addons', UA_TD) . '</strong>',
            '<strong>' . esc_html__('Elementor', UA_TD) . '</strong>',
            UA_MIN_ELEMENTOR_VER
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     *  Min PHP version admin notice
     */
    public function admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__(' %1$s requires %2$s version %3$s or greater.', UA_TD),
            '<strong>' . esc_html__('Ultra Addons', UA_TD) . '</strong>',
            '<strong>' . esc_html__('PHP', UA_TD) . '</strong>',
            UA_MIN_PHP_VER
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
                'title' => __( 'Ultra Addons', UA_TD ),
                'icon'  => 'fa fa-home',
            ]
        );

        $elements_Manager->add_category(
            'ultra_addons_pro_category',
            [
                'title' => __( 'Ultra Addons Pro', UA_TD ),
                'icon'  => 'fa fa-home',
            ]
        );
    }
}

if ( function_exists( 'ua_fs' ) ) {
    ua_fs()->set_basename( true, __FILE__ );
} 
else {
    if ( ! function_exists( 'ua_fs' ) ) {
        // Create a helper function for easy SDK access.
        function ua_fs() {
            global $ua_fs;

            if ( ! isset( $ua_fs ) ) {
                // Include Freemius SDK.
                require_once dirname(__FILE__) . '/vendor/freemius/start.php';

                $ua_fs = fs_dynamic_init( array(
                    'id'                  => '5782',
                    'slug'                => 'ultra-addons',
                    'premium_slug'        => 'ua-pro',
                    'type'                => 'plugin',
                    'public_key'          => 'pk_b9b12399691068dc7e8c18ac718ab',
                    'is_premium'          => false,
                    // If your plugin is a serviceware, set this option to false.
                    'has_addons'          => false,
                    'has_paid_plans'      => true,
                    'trial'               => array(
                        'days'               => 14,
                        'is_require_payment' => true,
                    ),
                    'menu'                => array(
                        'slug'           => 'ultra-addons',
                        'account' => true,
                    ),
                    // Set the SDK to work in a sandbox mode (for development & testing).
                    // IMPORTANT: MAKE SURE TO REMOVE SECRET KEY BEFORE DEPLOYMENT.
                    'secret_key'          => 'sk_^e(Jd^Xy+!$:8M[2q_0qbwa5pQ$y;',
                ) );
            }

            return $ua_fs;
        }

        // Init Freemius.
        ua_fs();
        // Signal that SDK was initiated.
        do_action( 'ua_fs_loaded' );
    }
}

if ( class_exists( 'UA_Inc\\Init' ) ) {
    UA_Inc\Init::register_services();
}

Ultra_Elementor_Addons::instance();