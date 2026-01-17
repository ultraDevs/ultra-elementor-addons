<?php

/**
 * Widgets Manager Class
 *
 * @package Ultra_Elementor_Addons
 */

namespace UltraElementorAddons;

use UltraElementorAddons\Traits\Singleton;

defined( 'ABSPATH' ) || die();

/**
 * Widgets Manager
 */
class Widgets_Manager {
	use Singleton;

	/**
	 * Widgets Database Key
	 *
	 * @var string
	 */
	const W_DB_KEY = 'ultra_addons_inactive_widgets';

	/**
	 * Initialize
	 */
	public static function init() {
		// Register custom widgets.
		add_action( 'elementor/widgets/register', [ __CLASS__, 'register' ] );
	}

	/**
	 * Inactive Widgets
	 */
	public static function get_inactive_widgets() {
		return get_option( self::W_DB_KEY, [] );
	}

	/**
	 * Save Inactive Widgets.
	 *
	 * @param array $widgets Widgets.
	 *
	 * @return void
	 */
	public static function save_inactive_widgets( $widgets = [] ) {
		update_option( self::W_DB_KEY, $widgets );
	}

	/**
	 * Get all free widgets map
	 *
	 * @return array Widgets info
	 */
	public static function get_free_widgets_map() {
		$widgets = [
			'animated_headlines'    => [
				'title'   => __( 'Animated Headlines', 'ultra-elementor-addons' ),
				'icon'    => 'eicon-animated-headline',
				'demo'    => \ultra_addons_get_addons_demo_link( 'animated-headlines' ),
				'enqueue' => [ 'css', 'js' ],
				'is_pro'  => false,
				'class'   => 'UltraElementorAddons\Widgets\Animated_Headlines',
			],
			'accordion'             => [
				'title'   => __( 'Accordion', 'ultra-elementor-addons' ),
				'icon'    => 'eicon-accordion',
				'demo'    => ultra_addons_get_addons_demo_link( 'accordion' ),
				'enqueue' => [ 'css', 'js' ],
				'is_pro'  => false,
				'class'   => 'UltraElementorAddons\Widgets\Accordion',
			],
			'box'                   => [
				'title'   => __( 'Box', 'ultra-elementor-addons' ),
				'icon'    => 'eicon-info-box',
				'demo'    => ultra_addons_get_addons_demo_link( 'box' ),
				'enqueue' => [ 'css' ],
				'is_pro'  => false,
				'class'   => 'UltraElementorAddons\Widgets\Box',
			],
			'testimonial'           => [
				'title'   => __( 'Testimonial', 'ultra-elementor-addons' ),
				'icon'    => 'eicon-testimonial',
				'demo'    => ultra_addons_get_addons_demo_link( 'testimonial' ),
				'enqueue' => [ 'css' ],
				'is_pro'  => false,
				'class'   => 'UltraElementorAddons\Widgets\Testimonial',
			],
			// 'testimonial_carousel'  => [
			// 	'title'   => __( 'Testimonial Carousel', 'ultra-elementor-addons' ),
			// 	'icon'    => 'eicon-testimonial-carousel',
			// 	'demo'    => ultra_addons_get_addons_demo_link( 'testimonial-carousel' ),
			// 	'enqueue' => [ 'css', 'js' ],
			// 	'is_pro'  => false,
			// 	'class'   => 'UltraElementorAddons\Widgets\Testimonial_Carousel',
			// ],
			// 'team_members_carousel' => [
			// 	'title'   => __( 'Team Members Carousel', 'ultra-elementor-addons' ),
			// 	'icon'    => 'ua-icon eicon-person',
			// 	'demo'    => ultra_addons_get_addons_demo_link( 'team-members-carousel' ),
			// 	'enqueue' => [ 'css', 'js' ],
			// 	'is_pro'  => false,
			// 	'class'   => 'UltraElementorAddons\Widgets\Team_Members_Carousel',
			// ],
			'team_member'           => [
				'title'   => __( 'Team Member', 'ultra-elementor-addons' ),
				'icon'    => 'eicon-lock-user',
				'demo'    => ultra_addons_get_addons_demo_link( 'team-member' ),
				'enqueue' => [ 'css' ],
				'is_pro'  => false,
				'class'   => 'UltraElementorAddons\Widgets\Team_Member',
			],
			'image_comparison'      => [
				'title'   => __( 'Image Comparison', 'ultra-elementor-addons' ),
				'icon'    => 'eicon-image',
				'demo'    => ultra_addons_get_addons_demo_link( 'image-comparison' ),
				'enqueue' => [ 'css', 'js' ],
				'is_pro'  => false,
				'class'   => 'UltraElementorAddons\Widgets\Image_Comparison',
			],
			'breadcrumb'  => [
				'title'   => __( 'Breadcrumb', 'ultra-elementor-addons' ),
				'icon'    => 'eicon-breadcrumb',
				'demo'    => ultra_addons_get_addons_demo_link( 'breadcrumb' ),
				'enqueue' => [ 'css', 'js' ],
				'is_pro'  => false,
				'class'   => 'UltraElementorAddons\Widgets\Breadcrumb',
			],
			'button'      => [
				'title'   => __( 'Button', 'ultra-elementor-addons' ),
				'icon'    => 'eicon-button',
				'demo'    => ultra_addons_get_addons_demo_link( 'button' ),
				'enqueue' => [ 'css', 'js' ],
				'is_pro'  => false,
				'class'   => 'UltraElementorAddons\Widgets\Button',
			],
			'flipbox'     => [
				'title'   => __( 'Flipbox', 'ultra-elementor-addons' ),
				'icon'    => 'eicon-flip-box',
				'demo'    => ultra_addons_get_addons_demo_link( 'flipbox' ),
				'enqueue' => [ 'css', 'js' ],
				'is_pro'  => false,
				'class'   => 'UltraElementorAddons\Widgets\Flipbox',
			],
			'tab'         => [
				'title'   => __( 'Tab Blocks', 'ultra-elementor-addons' ),
				'icon'    => 'eicon-tabs',
				'demo'    => ultra_addons_get_addons_demo_link( 'tab' ),
				'enqueue' => [ 'css', 'js' ],
				'is_pro'  => false,
				'class'   => 'UltraElementorAddons\Widgets\Tab',
			],
		];
		uksort( $widgets, [ __CLASS__, 'ua_custom_sort' ] );
		return $widgets;
	}

	/**
	 * Custom Sort.
	 * Sort by title.
	 *
	 * @param string $a First string.
	 * @param string $b Second string.
	 */
	public static function ua_custom_sort( $a, $b ) {
			return strcasecmp( $a, $b );
	}

	/**
	 * Register Widgets.
	 *
	 * @param object $widgets_manager Elementor Widgets Manager.
	 */
	public static function register( $widgets_manager ) {
		$inactive_widgets = self::get_inactive_widgets();
		foreach ( self::get_free_widgets_map() as $widget_key => $data ) {
			if ( ultra_addons_fs()->is_not_paying() ) {
				if ( $data['is_pro'] == true ) {
					continue;
				}
			}
			if ( ! in_array( $widget_key, $inactive_widgets ) ) {
				self::register_widget( $widgets_manager, ucfirst( $widget_key ), $data );
			}
		}
	}

	/**
	 * Register Widget.
	 *
	 * @param object $widgets_manager Elementor Widgets Manager.
	 * @param string $widget_key Widget Key.
	 * @param array  $data Widget Data.
	 *
	 * @return void
	 */
	public static function register_widget( $widgets_manager, $widget_key, $data ) {
		if ( isset( $data['class'] ) ) {
			$widgets_manager->register( new $data['class']() );
		}
	}
}
