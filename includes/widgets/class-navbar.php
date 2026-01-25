<?php

namespace UltraElementorAddons\Widgets;

use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

defined( 'ABSPATH' ) || die();

class Navbar extends Widgets_Base {

	public function get_name() {
		return 'orivo_navigation';
	}

	public function get_title() {
		return __( 'Orivo Navigation', 'ultra-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-menu-bar';
	}

	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	public function get_keywords() {
		return [ 'nav', 'menu', 'navigation', 'navbar' ];
	}

	public function get_script_depends() {
		return [ 'ua-script-navigation' ];
	}

	public function get_style_depends() {
		return [ 'ua-style-navigation' ];
	}

	private function get_available_menus() {
		$menus = wp_get_nav_menus();
		$options = [];
		if ( ! empty( $menus ) ) {
			foreach ( $menus as $menu ) {
				$options[ (string) $menu->term_id ] = $menu->name;
			}
		}
		return $options;
	}

	private function get_menu_locations() {
		$locations = get_registered_nav_menus();
		return is_array( $locations ) ? $locations : [];
	}

	protected function ua_register_controls() {

		/* ========================
		 * Content Section
		 * ======================== */
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Layout', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-3',
				'options' => [
					'layout-1' => __( 'Left', 'ultra-elementor-addons' ),
					'layout-2' => __( 'Right', 'ultra-elementor-addons' ),
					'layout-3' => __( 'Center', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'source_type',
			[
				'label'   => __( 'Menu Source', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'menu',
				'options' => [
					'menu'     => __( 'Select by Menu', 'ultra-elementor-addons' ),
					'location' => __( 'Select by Location', 'ultra-elementor-addons' ),
				],
			]
		);

		$menus = $this->get_available_menus();
		$this->add_control(
			'nav_menu',
			[
				'label'     => __( 'Select Menu', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $menus,
				'default'   => ! empty( $menus ) ? array_key_first( $menus ) : '',
				'condition' => [ 'source_type' => 'menu' ],
			]
		);

		$locations = $this->get_menu_locations();
		$this->add_control(
			'nav_location',
			[
				'label'     => __( 'Select Location', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $locations,
				'default'   => ! empty( $locations ) ? array_key_first( $locations ) : '',
				'condition' => [ 'source_type' => 'location' ],
			]
		);

		$this->add_control(
			'mobile_breakpoint',
			[
				'label'   => __( 'Mobile Breakpoint (px)', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 768,
				'min'     => 320,
				'max'     => 1920,
			]
		);

		$this->add_control(
			'close_on_outside',
			[
				'label'        => __( 'Close on Outside Click', 'ultra-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'dropdown_indicator',
			[
				'label'   => __( 'Dropdown Indicator', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'arrow',
				'options' => [
					'none'  => __( 'None', 'ultra-elementor-addons' ),
					'arrow' => __( 'Arrow', 'ultra-elementor-addons' ),
					'plus'  => __( 'Plus', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'mobile_menu_position',
			[
				'label'   => __( 'Mobile Menu Position', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top'    => __( 'Top', 'ultra-elementor-addons' ),
					'bottom' => __( 'Bottom', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'mobile_full_width',
			[
				'label'        => __( 'Mobile Full Width', 'ultra-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'dropdown_animation',
			[
				'label'   => __( 'Dropdown Animation', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'none'       => __( 'None', 'ultra-elementor-addons' ),
					'fade'       => __( 'Fade', 'ultra-elementor-addons' ),
					'slide'      => __( 'Slide', 'ultra-elementor-addons' ),
					'fade-slide' => __( 'Fade + Slide', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->end_controls_section();

		/* ========================
		 * Container Style Section
		 * ======================== */
		$this->start_controls_section(
			'section_container_style',
			[
				'label' => __( 'Container', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'container_bg_color',
			[
				'label'     => __( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,.95)',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__container' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_padding',
			[
				'label'      => __( 'Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'      => '0',
					'right'    => '24',
					'bottom'   => '0',
					'left'     => '24',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_margin',
			[
				'label'      => __( 'Margin', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '60',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'container_border_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 100 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 16 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__container' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'container_box_shadow',
				'selector' => '{{WRAPPER}} .orivo-navbar-blocks__container',
			]
		);

		$this->add_control(
			'container_height',
			[
				'label'      => __( 'Container Height', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 'px' => [ 'min' => 40, 'max' => 150 ] ],
				'default'    => [ 'unit' => 'px', 'size' => 70 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__container' => 'min-height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'container_max_width',
			[
				'label'      => __( 'Container Max Width', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 300, 'max' => 1920 ],
					'%'  => [ 'min' => 10, 'max' => 100 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 1200 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/* ========================
		 * Menu Items Style Section
		 * ======================== */
		$this->start_controls_section(
			'section_menu_items_style',
			[
				'label' => __( 'Menu Items', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography',
				'selector' => '{{WRAPPER}} .orivo-navbar-blocks__menu > li > a',
			]
		);

		$this->add_control(
			'menu_color',
			[
				'label'     => __( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li > a' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => __( 'Hover Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#667eea',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li > a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'active_color',
			[
				'label'     => __( 'Active Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#667eea',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu .current-menu-item > a,
					{{WRAPPER}} .orivo-navbar-blocks__menu .current-menu-ancestor > a' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'menu_gap',
			[
				'label'      => __( 'Menu Gap', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 100 ],
					'em' => [ 'min' => 0, 'max' => 10 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 40 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'menu_item_padding',
			[
				'label'      => __( 'Item Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
					'top'      => '2',
					'right'    => '0',
					'bottom'   => '2',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'underline_color',
			[
				'label'     => __( 'Underline Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#667eea',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li > a::after' => 'background: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'underline_height',
			[
				'label'      => __( 'Underline Height', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 'px' => [ 'min' => 1, 'max' => 10 ] ],
				'default'    => [ 'unit' => 'px', 'size' => 2 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li > a::after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'underline_width',
			[
				'label'   => __( 'Underline Width on Hover', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => [ '%' => [ 'min' => 10, 'max' => 100 ] ],
				'default' => [ 'unit' => '%', 'size' => 80 ],
			]
		);

		$this->end_controls_section();

		/* ========================
		 * Submenu Style Section
		 * ======================== */
		$this->start_controls_section(
			'section_submenu_style',
			[
				'label' => __( 'Submenu', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'submenu_bg_color',
			[
				'label'     => __( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'submenu_typography',
				'selector' => '{{WRAPPER}} .orivo-navbar-blocks__menu ul li a',
			]
		);

		$this->add_control(
			'submenu_item_color',
			[
				'label'     => __( 'Item Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'submenu_item_hover_color',
			[
				'label'     => __( 'Hover Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#667eea',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'submenu_item_hover_bg',
			[
				'label'     => __( 'Hover Background', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(102,126,234,.10)',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul li a:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'submenu_padding',
			[
				'label'      => __( 'Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
					'top'      => '8',
					'right'    => '0',
					'bottom'   => '8',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'submenu_border_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 12 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'submenu_box_shadow',
				'selector' => '{{WRAPPER}} .orivo-navbar-blocks__menu ul',
			]
		);

		$this->add_control(
			'submenu_min_width',
			[
				'label'      => __( 'Minimum Width', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 'px' => [ 'min' => 100, 'max' => 400 ] ],
				'default'    => [ 'unit' => 'px', 'size' => 200 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'submenu_item_padding',
			[
				'label'      => __( 'Item Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
					'top'      => '10',
					'right'    => '16',
					'bottom'   => '10',
					'left'     => '16',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/* ========================
		 * Mobile Menu Style Section
		 * ======================== */
		$this->start_controls_section(
			'section_mobile_style',
			[
				'label' => __( 'Mobile Menu', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'toggle_button_color',
			[
				'label'     => __( 'Toggle Button Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__toggle-btn span' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'mobile_menu_bg',
			[
				'label'     => __( 'Mobile Menu Background', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'mobile_menu_padding',
			[
				'label'      => __( 'Mobile Menu Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
					'top'      => '32',
					'right'    => '24',
					'bottom'   => '32',
					'left'     => '24',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'mobile_menu_typography',
				'selector' => '{{WRAPPER}} .orivo-navbar-blocks__menu > li > a',
			]
		);

		$this->add_control(
			'mobile_menu_item_color',
			[
				'label'     => __( 'Mobile Item Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'mobile_menu_item_bg',
			[
				'label'     => __( 'Mobile Item Background', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li > a' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'mobile_menu_item_radius',
			[
				'label'      => __( 'Mobile Item Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 12 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li > a' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'mobile_menu_box_shadow',
				'selector' => '{{WRAPPER}} .orivo-navbar-blocks__menu',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$layout              = $s['layout'] ?? 'layout-3';
		$source              = $s['source_type'] ?? 'menu';
		$menu_id             = $s['nav_menu'] ?? '';
		$location            = $s['nav_location'] ?? '';
		$breakpoint          = (int) ( $s['mobile_breakpoint'] ?? 768 );
		$close_outside       = ( $s['close_on_outside'] ?? 'yes' );
		$dropdown_indicator  = $s['dropdown_indicator'] ?? 'arrow';
		$mobile_position     = $s['mobile_menu_position'] ?? 'top';
		$mobile_full_width   = ( $s['mobile_full_width'] ?? 'no' ) === 'yes';
		$dropdown_animation  = $s['dropdown_animation'] ?? 'fade';

		// Handle underline width - slider returns array with 'size' and 'unit' keys
		$underline_width_setting = $s['underline_width'] ?? [];
		if ( is_array( $underline_width_setting ) && isset( $underline_width_setting['size'] ) ) {
			$underline_width = $underline_width_setting['size'];
		} else {
			$underline_width = 80;
		}

		$wrap_id   = 'orivo-nav-' . $this->get_id();
		$toggle_id = 'orivo-toggle-' . $this->get_id();

		// Build class array
		$nav_classes   = [ 'orivo-navbar-blocks', 'orivo-navbar-blocks--' . $layout ];
		$nav_classes[] = 'dropdown-animation-' . $dropdown_animation;
		$nav_classes[] = 'dropdown-indicator-' . $dropdown_indicator;
		$nav_classes[] = 'mobile-position-' . $mobile_position;
		if ( $mobile_full_width ) {
			$nav_classes[] = 'mobile-full-width';
		}
		$nav_class_string = implode( ' ', $nav_classes );

		// Menu args
		$args = [
			'container'      => false,
			'fallback_cb'    => false,
			'menu_class'     => 'orivo-navbar-blocks__menu',
			'depth'          => 3,
		];

		if ( $source === 'location' && ! empty( $location ) ) {
			$args['theme_location'] = $location;
		} elseif ( ! empty( $menu_id ) ) {
			$args['menu'] = (int) $menu_id;
		}

		$has_menu = ( ! empty( $args['menu'] ) || ! empty( $args['theme_location'] ) );

		// Dynamic CSS for underline width
		$width_css = '';
		if ( 'layout-1' === $layout ) {
			$width_css = 'width: 100%;';
		} elseif ( 'layout-2' === $layout ) {
			$width_css = 'width: 100%;';
		} elseif ( 'layout-3' === $layout ) {
			$width_css = 'width: ' . $underline_width . '%;';
		}
		?>

		<nav
			id="<?php echo esc_attr( $wrap_id ); ?>"
			class="<?php echo esc_attr( $nav_class_string ); ?>"
			data-breakpoint="<?php echo esc_attr( (string) $breakpoint ); ?>"
			data-close-outside="<?php echo esc_attr( $close_outside ); ?>"
		>
			<div class="orivo-navbar-blocks__container">
				<input type="checkbox" id="<?php echo esc_attr( $toggle_id ); ?>" class="orivo-navbar-blocks__toggle">
				<label for="<?php echo esc_attr( $toggle_id ); ?>" class="orivo-navbar-blocks__toggle-btn" aria-label="<?php echo esc_attr__( 'Toggle Menu', 'ultra-elementor-addons' ); ?>">
					<span></span><span></span><span></span>
				</label>

				<?php
				if ( $has_menu ) {
					wp_nav_menu( $args );
				} else {
					echo '<ul class="orivo-navbar-blocks__menu">
						<li><a href="#" class="orivo-navbar-blocks__link">' . esc_html__( 'Select a menu first', 'ultra-elementor-addons' ) . '</a></li>
					</ul>';
				}
				?>
			</div>
		</nav>

		<style>
			/* Underline width override */
			#<?php echo esc_attr( $wrap_id ); ?> .orivo-navbar-blocks__menu > li > a:hover::after {
				<?php echo esc_attr( $width_css ); ?>
			}
		</style>

		<?php
	}
}
