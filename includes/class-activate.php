<?php

/**
 * Activate Class
 *
 * @package Ultra_Elementor_Addons
 */

namespace UltraElementorAddons;

defined( 'ABSPATH' ) || die();

/**
 * Activate
 */
class Activate {

	/**
	 * Activation
	 */
	public function activate() {
		flush_rewrite_rules();
	}
}
