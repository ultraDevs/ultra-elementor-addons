<?php
use UltraElementorAddons\Assets_Manager;
use UltraElementorAddons\Dashboard;
use UltraElementorAddons\Updater;
/**
 * @package Ultra_Elementor_Addons
 *
 * Plugin Name:     Ultra Elementor Addons
 * Plugin URI:      https://ultradevs.com/ultra-elementor-addons
 * Description:     <a href="https://ultradevs.com/ultra-elementor-addons">Ultra Elementor Addons</a> is a collection of helpful widget for Elementor.
 * Version: 2.0.2
 * Author:          ultraDevs
 * Author URI:      https://ultradevs.com
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     ultra-elementor-addons
 * Domain Path:     /languages
 */

defined( 'ABSPATH' ) || die();

use Pablo_Pacheco\WP_Namespace_Autoloader\WP_Namespace_Autoloader;

use Elementor\Elements_Manager;
use UltraElementorAddons\Widgets_Manager;

define( 'ULTRA_ADDONS_TD', 'ultra-elementor-addons' );
define( 'ULTRA_ADDONS_VERSION', '2.0.2' );
define( 'ULTRA_ADDONS_PATH', plugin_dir_path( __FILE__ ) );
define( 'ULTRA_ADDONS_URL', plugin_dir_url( __FILE__ ) );
define( 'ULTRA_ADDONS_ASSETS', ULTRA_ADDONS_URL . 'assets/' );

define( 'ULTRA_ADDONS_MIN_ELEMENTOR_VER', '2.5.0' );
define( 'ULTRA_ADDONS_MIN_PHP_VER', '5.4' );

/**
 * Require Composer Autoload
 */
if ( file_exists( ULTRA_ADDONS_PATH . '/vendor/autoload.php' ) ) {
	require_once ULTRA_ADDONS_PATH . '/vendor/autoload.php';
}

/**
 * Freemius Setup
 */
if ( ! function_exists( 'ultra_addons_fs' ) ) {
	/**
	 * Create a helper function for easy SDK access.
	 *
	 * @return Freemius
	 */
	function ultra_addons_fs() {
		global $ultra_addons_fs;

		if ( ! isset( $ultra_addons_fs ) ) {
			// Include Freemius SDK.
			require_once ULTRA_ADDONS_PATH . '/vendor/freemius/wordpress-sdk/start.php';
			$ultra_addons_fs = fs_dynamic_init(
				array(
					'id'             => '18147',
					'slug'           => 'ultra-elementor-addons',
					'type'           => 'plugin',
					'public_key'     => 'pk_63d55ac7407020b4c2e55164637d9',
					'is_premium'     => false,
					'has_addons'     => false,
					'has_paid_plans' => false,
					'menu'           => array(
						'slug' => 'ultra-elementor-addons',
					),
				)
			);
		}

		return $ultra_addons_fs;
	}

	// Init Freemius.
	ultra_addons_fs();
	// Signal that SDK was initiated.
	do_action( 'ultra_addons_fs_loaded' );
}

/**
 * The main class of the plugin
 */
final class Ultra_Elementor_Addons {

	/**
	 * Instance
	 *
	 * @access private
	 *
	 * @static
	 *
	 * @var self
	 */
	private static $_instance = NULL;

	/**
	 * Constructor
	 */
	public function __construct() {

		$autoloader = new WP_Namespace_Autoloader(
			[
				'directory'            => __DIR__,
				'namespace_prefix'     => 'UltraElementorAddons',
				'classes_dir'          => 'includes',
				'lowercase'            => [ 'file', 'folders' ],
				'underscore_to_hyphen' => [ 'file', 'folders' ],
				'prepend_class'        => true,
				'prepend_interface'    => true,
				'prepend_trait'        => true,
				'debug'                => false,
			]
		);

		$autoloader->init();
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugin_loaded', [ $this, 'init' ] );
	}

	/**
	 * Get Instance
	 *
	 * @return self
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Load Textdomain
	 */
	public function i18n() {
		load_plugin_textdomain( 'ultra-elementor-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Initialize the plugin
	 */
	public function init() {
		// Check if Elementor installed and activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elememtor Version.
		if ( ! version_compare( ELEMENTOR_VERSION, ULTRA_ADDONS_MIN_ELEMENTOR_VER, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP Version.
		if ( version_compare( PHP_VERSION, ULTRA_ADDONS_MIN_PHP_VER, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Register custom categories.
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

		// Assets Manager.
		Assets_Manager::get_instance()->register();

		// Dashboard.
		Dashboard::get_instance()->register();

		// Updater.
		Updater::get_instance()->register();

		// Widget Manager.
		Widgets_Manager::get_instance()->init();
	}

	/**
	 * Missing main plugin admin notice
	 */
	public function admin_notice_missing_main_plugin() {

		if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor */
				esc_html__( '%1$s requires %2$s to be installed and activated. Please activate %2$s to continue.', 'ultra-elementor-addons' ),
				'<strong>' . esc_html__( 'Ultra Addons', 'ultra-elementor-addons' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'ultra-elementor-addons' ) .'</strong>'
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
		}
	}

	/**
	 *  Min Elementor version admin notice
	 */
	public function admin_notice_minimum_elementor_version() {
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( ' %1$s requires %2$s version %3$s or greater.', 'ultra-elementor-addons' ),
			'<strong>' . esc_html__( 'Ultra Elementor Addons', 'ultra-elementor-addons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ultra-elementor-addons' ) . '</strong>',
			ULTRA_ADDONS_MIN_ELEMENTOR_VER
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}

	/**
	 *  Min PHP version admin notice
	 */
	public function admin_notice_minimum_php_version() {

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( ' %1$s requires %2$s version %3$s or greater.', 'ultra-elementor-addons' ),
			'<strong>' . esc_html__( 'Ultra Elementor Addons', 'ultra-elementor-addons') . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'ultra-elementor-addons' ) . '</strong>',
			ULTRA_ADDONS_MIN_PHP_VER
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>',  wp_kses_post( $message ) );
	}

	/**
	 * Register category
	 *
	 * @param Elements_Manager $elements_manager Elementor Manager.
	 */
	public function add_category( $elements_manager ) {
		$elements_manager->add_category(
			'ultra_addons_category',
			[
				'title' => __( 'Ultra Elementor Addons', 'ultra-elementor-addons' ),
				'icon'  => 'fa fa-home',
			]
		);

		$elements_manager->add_category(
			'ultra_addons_pro_category',
			[
				'title' => __( 'Ultra Addons Pro', 'ultra-elementor-addons' ),
				'icon'  => 'fa fa-home',
			]
		);
	}
}

Ultra_Elementor_Addons::instance();
