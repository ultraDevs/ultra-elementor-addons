<?php
/**
 * Trait: Singleton
 *
 * @package UltraElementorAddons
 */

namespace UltraElementorAddons\Traits;

/**
 * Singleton Trait.
 */
trait Singleton {

	/**
	 * Instance - Singleton Pattern
	 *
	 * @var self
	 */
	protected static $instance = null;

	/**
	 * Get singleton instance.
	 *
	 * @return self
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {}

	/**
	 * Magic method to prevent cloning.
	 */
	public function __clone() {}

	/**
	 * Magic method to prevent unserializing.
	 */
	public function __wakeup() {}
}
