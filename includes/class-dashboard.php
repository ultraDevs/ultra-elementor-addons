<?php
/**
 * Dashboard Class
 *
 * @package Ultra_Elementor_Addons
 */

namespace UltraElementorAddons;

use UltraElementorAddons\Traits\Singleton;
use UltraElementorAddons\Widgets_Manager;

defined( 'ABSPATH' ) || die();

/**
 * Dashboard
 */
class Dashboard {
	use Singleton;

	/**
	 * Menu.
	 *
	 * @var string
	 */
	public static $menu = '';

	/**
	 * Icon.
	 *
	 * @var string
	 */
	public static $icon = ULTRA_ADDONS_ASSETS . 'images/ua_icon.svg';

	/**
	 * Page Slug.
	 *
	 * @var string
	 */
	public const PAGE_SLUG = 'ultra-elementor-addons';

	/**
	 * Register
	 */
	public function register() {
		add_action( 'admin_menu', [ __CLASS__, 'register_menu' ] );
		add_action( 'admin_menu', [ __CLASS__, 'update_menu' ] );
		add_action( 'admin_enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
	}

	/**
	 * Enqueue Styles and scripts.
	 *
	 * @param string $hook Current page hook.
	 *
	 * @return void
	 */
	public static function enqueue_scripts( $hook ) {
		if ( self::$menu !== $hook || ! current_user_can( 'manage_options' ) ) {
			return;
		}

		wp_enqueue_style( 'ua-dashboard', ULTRA_ADDONS_ASSETS . 'admin/css/dashboard.css', '', ULTRA_ADDONS_VERSION );
		wp_enqueue_script( 'ua-dashboard', ULTRA_ADDONS_ASSETS . 'admin/js/dashboard.js', [ 'jquery' ], ULTRA_ADDONS_VERSION, false );
	}

	/**
	 * Register Admin Menu
	 */
	public static function register_menu() {
		self::$menu = add_menu_page(
			__( 'Dashboard - Ultra Elementor Addons', 'ultra-elementor-addons' ),
			__( 'Ultra Addons', 'ultra-elementor-addons' ),
			'manage_options',
			self::PAGE_SLUG,
			[ __CLASS__, 'view_main' ],
			self::$icon,
			56
		);

		$tabs = self::tabs();
		foreach ( $tabs as $key => $value ) {
			if ( empty( $value['view'] ) || ! is_callable( $value['view'] ) ) {
				continue;
			}

			add_submenu_page( self::PAGE_SLUG, sprintf( __( '%s - Ultra Elementor Addons', 'ultra-elementor-addons' ), $value['title'] ), $value['title'], 'manage_options', self::PAGE_SLUG . '#' . $key, [ __CLASS__, 'view_main' ] );
		}
	}

	/**
	 * Update menu.
	 *
	 * @return void
	 */
	public static function update_menu() {
		global $submenu;
		$menu = $submenu[ self::PAGE_SLUG ];
		array_shift( $menu );
		$submenu[ self::PAGE_SLUG ] = $menu;
	}

	/**
	 * UA Dashboard Tabs
	 */
	public static function tabs() {
		$tabs = [
			'home'    => [
				'title' => 'Home',
				'view'  => [ __CLASS__, 'view_home' ],
			],
			'widgets' => [
				'title' => 'Widgets',
				'view'  => [ __CLASS__, 'view_widgets' ],
			],
		];
		return $tabs;
	}

	/**
	 * All Widgets
	 *
	 * @return array
	 */
	public static function all_widgets() {
		$widgets = Widgets_Manager::get_free_widgets_map();
		return $widgets;
	}

	/**
	 * Inactive Widgets
	 *
	 * @return array
	 */
	public static function inactive_widgets() {
		$widgets = Widgets_Manager::get_inactive_widgets();
		return $widgets;
	}

	/**
	 * Save Inactive Widgets
	 *
	 * @param array $widgets Widgets.
	 */
	public static function save_inactive_widgets( $widgets ) {
		Widgets_Manager::save_inactive_widgets( $widgets );
	}

	/**
	 * Main View.
	 *
	 * @return void
	 */
	public static function view_main() {
		self::load_template( 'main' );
	}

	/**
	 * Home View.
	 *
	 * @return void
	 */
	public static function view_home() {
		self::load_template( 'home' );
	}

	/**
	 * Widgets View.
	 *
	 * @return void
	 */
	public static function view_widgets() {
		self::load_template( 'widgets' );
	}

	/**
	 * Template Loading.
	 *
	 * @param string $temp Template name.
	 *
	 * @return void
	 */
	public static function load_template( $temp ) {
		$temp_file = ULTRA_ADDONS_PATH . 'templates/admin/dashboard-' . $temp . '.php';
		if ( is_readable( $temp_file ) ) {
			include $temp_file;
		}
	}
}
