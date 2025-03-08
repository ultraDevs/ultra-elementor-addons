<?php
/**
 * Activate Class
 *
 * @package Ultra_Elementor_Addons
 */

namespace UltraElementorAddons;

use UltraElementorAddons\Traits\Singleton;

defined( 'ABSPATH' ) || die();

/**
 * Updater.
 *
 * @since 2.0.0
 */
class Updater {
	use Singleton;

	const VERSION_DB_KEY = 'ultra_addons_version';

	/**
	 * Icon Update.
	 */
	public static function icon_update() {
		add_option( 'elementor_icon_manager_needs_update', 'yes' );
		add_option( 'elementor_load_fa4_shim', 'yes' );
	}

	/**
	 * Should Update
	 *
	 * @return bool
	 */
	public static function should_update() {
		if ( ! get_option( self::VERSION_DB_KEY, '' ) ) {
			return true;
		}

		return version_compare( ULTRA_ADDONS_VERSION, self::VERSION_DB_KEY, '>' );
	}


	/**
	 * Register Method
	 */
	public function register() {
		if ( self::should_update() ) {

			if ( ! get_option( self::VERSION_DB_KEY, '' ) ) {

				self::icon_update();

			}
			update_option( self::VERSION_DB_KEY, ULTRA_ADDONS_VERSION );
		}
	}
}
