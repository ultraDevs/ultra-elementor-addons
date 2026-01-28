<?php

namespace UltraElementorAddons\Widgets;

use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

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
				'default' => 'icon',
				'options' => [
					'none' => __( 'None', 'ultra-elementor-addons' ),
					'icon' => __( 'Icon', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'dropdown_icon',
			[
				'label'     => __( 'Dropdown Icon', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-chevron-down',
					'library' => 'fa-solid',
				],
				'condition' => [
					'dropdown_indicator' => 'icon',
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
			'mobile_submenu_behavior',
			[
				'label'     => __( 'Mobile Submenu Behavior', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'always-open',
				'options'   => [
					'always-open' => __( 'Always Open', 'ultra-elementor-addons' ),
					'collapsed'   => __( 'Collapsed (Hidden)', 'ultra-elementor-addons' ),
				],
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

		$this->add_control(
			'toggle_menu_top_position_content',
			[
				'label'      => __( 'Toggle Menu Position', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 300 ] ],
				'default'    => [ 'unit' => 'px', 'size' => 80 ],
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
		 * Menu Style Section
		 * ======================== */
		$this->start_controls_section(
			'section_menu_style',
			[
				'label' => __( 'Menu', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_menu_style' );

		// Normal Tab
		$this->start_controls_tab(
			'tab_menu_normal',
			[
				'label' => __( 'Normal', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'menu_color',
			[
				'label'     => __( 'Menu Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li > a' => 'color: {{VALUE}} !important;',
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

		$this->add_control(
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
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'underline_heading',
			[
				'label'     => __( 'Underline', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
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

		$this->add_control(
			'underline_animation',
			[
				'label'     => __( 'Underline Animation', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grow-from-center',
				'options'   => [
					'none'              => __( 'None', 'ultra-elementor-addons' ),
					'grow-from-center'  => __( 'Grow from Center', 'ultra-elementor-addons' ),
					'grow-from-left'    => __( 'Grow from Left', 'ultra-elementor-addons' ),
					'grow-from-right'   => __( 'Grow from Right', 'ultra-elementor-addons' ),
					'slide-from-top'    => __( 'Slide from Top', 'ultra-elementor-addons' ),
					'slide-from-bottom' => __( 'Slide from Bottom', 'ultra-elementor-addons' ),
					'fade-in'           => __( 'Fade In', 'ultra-elementor-addons' ),
					'scale-in'          => __( 'Scale In', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'underline_position',
			[
				'label'     => __( 'Underline Position', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bottom',
				'options'   => [
					'top'    => __( 'Top', 'ultra-elementor-addons' ),
					'bottom' => __( 'Bottom', 'ultra-elementor-addons' ),
				],
				'condition' => [
					'underline_animation!' => [ 'slide-from-top', 'slide-from-bottom' ],
				],
			]
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'tab_menu_hover',
			[
				'label' => __( 'Hover', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => __( 'Menu Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#667eea',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li > a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		// Active Tab
		$this->start_controls_tab(
			'tab_menu_active',
			[
				'label' => __( 'Active', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'active_color',
			[
				'label'     => __( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#667eea',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu .current-menu-item > a,
					{{WRAPPER}} .orivo-navbar-blocks__menu .current-menu-ancestor > a' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'mobile_menu_bg_toggle',
			[
				'label'     => __( 'Mobile Menu Background (on Toggle Open)', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__toggle:checked ~ .orivo-navbar-blocks__menu' => 'background: {{VALUE}} !important;',
				],
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

		$this->start_controls_tabs( 'tabs_submenu_style' );

		// Normal Tab
		$this->start_controls_tab(
			'tab_submenu_normal',
			[
				'label' => __( 'Normal', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'submenu_bg_color',
			[
				'label'     => __( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul' => 'background: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'submenu_item_color',
			[
				'label'     => __( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'submenu_item_bg',
			[
				'label'     => __( 'Item Background', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul li a' => 'background: {{VALUE}} !important;',
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
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
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
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'tab_submenu_hover',
			[
				'label' => __( 'Hover', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'submenu_item_hover_color',
			[
				'label'     => __( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#667eea',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu ul li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/* ========================
		 * Dropdown Icon Style Section
		 * ======================== */
		$this->start_controls_section(
			'section_dropdown_icon_style',
			[
				'label'     => __( 'Dropdown Icon', 'ultra-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'dropdown_indicator' => 'icon',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_dropdown_icon_style' );

		$this->start_controls_tab(
			'tab_dropdown_icon_normal',
			[
				'label' => __( 'Normal', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'dropdown_icon_color',
			[
				'label'     => __( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li.menu-item-has-children > a .orivo-dropdown-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li.menu-item-has-children > a .orivo-dropdown-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_icon_size',
			[
				'label'      => __( 'Size', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 8, 'max' => 32 ],
					'em' => [ 'min' => 0.5, 'max' => 2 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 14 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li.menu-item-has-children > a .orivo-dropdown-icon' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important; font-size: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'dropdown_icon_spacing',
			[
				'label'      => __( 'Spacing', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 30 ],
					'em' => [ 'min' => 0, 'max' => 2 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 6 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li.menu-item-has-children > a .orivo-dropdown-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_icon_hover',
			[
				'label' => __( 'Hover', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'dropdown_icon_hover_color',
			[
				'label'     => __( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li.menu-item-has-children:hover > a .orivo-dropdown-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li.menu-item-has-children:hover > a .orivo-dropdown-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_icon_hover_rotate',
			[
				'label'      => __( 'Rotation', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range'      => [
					'deg' => [ 'min' => 0, 'max' => 360, 'step' => 15 ],
				],
				'default'    => [ 'unit' => 'deg', 'size' => 180 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu > li.menu-item-has-children:hover > a .orivo-dropdown-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/* ========================
		 * Mobile Menu Style Section
		 * ======================== */
		$this->start_controls_section(
			'section_mobile_menu_style',
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
				'label'     => __( 'Mobile Menu Background (on Toggle Open)', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__toggle:checked ~ .orivo-navbar-blocks__menu' => 'background: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'container_bg_on_toggle_open',
			[
				'label'     => __( 'Container Background on Menu Open', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__toggle:checked ~ .orivo-navbar-blocks__container' => 'background: {{VALUE}};',
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

		$this->add_control(
			'mobile_menu_top_position',
			[
				'label'      => __( 'Menu Top Position', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 300 ] ],
				'default'    => [ 'unit' => 'px', 'size' => 80 ],
			]
		);

		$this->add_control(
			'mobile_submenu_spacing_heading',
			[
				'label'     => __( 'Mobile Submenu Spacing', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'mobile_submenu_padding',
			[
				'label'      => __( 'Submenu Padding', 'ultra-elementor-addons' ),
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
			]
		);

		$this->add_control(
			'mobile_submenu_margin',
			[
				'label'      => __( 'Submenu Margin', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
					'top'      => '6',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
			]
		);

		$this->add_control(
			'mobile_submenu_item_radius',
			[
				'label'      => __( 'Submenu Item Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 8 ],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();

		$layout                = $s['layout'] ?? 'layout-3';
		$source                = $s['source_type'] ?? 'menu';
		$menu_id               = $s['nav_menu'] ?? '';
		$location              = $s['nav_location'] ?? '';
		$breakpoint            = (int) ( $s['mobile_breakpoint'] ?? 768 );
		$close_outside         = ( $s['close_on_outside'] ?? 'yes' );
		$dropdown_indicator    = $s['dropdown_indicator'] ?? 'arrow';
		$mobile_position       = $s['mobile_menu_position'] ?? 'top';
		$mobile_full_width     = ( $s['mobile_full_width'] ?? 'no' ) === 'yes';
		$mobile_submenu_behavior = $s['mobile_submenu_behavior'] ?? 'always-open';
		$dropdown_animation    = $s['dropdown_animation'] ?? 'fade';
		$underline_animation   = $s['underline_animation'] ?? 'grow-from-center';
		$underline_position    = $s['underline_position'] ?? 'bottom';
		$enable_menu_icons     = ( $s['menu_item_enable_icon'] ?? 'no' ) === 'yes';
		$dropdown_icon         = $s['dropdown_icon'] ?? '';

		// Handle underline width - slider returns array with 'size' and 'unit' keys
		$underline_width_setting = $s['underline_width'] ?? [];
		if ( is_array( $underline_width_setting ) && isset( $underline_width_setting['size'] ) ) {
			$underline_width = $underline_width_setting['size'];
		} else {
			$underline_width = 80;
		}

		// Mobile menu top position - check Content section first, then Style section
		$toggle_menu_top_position_content = $s['toggle_menu_top_position_content'] ?? [];
		$mobile_menu_top_position_style = $s['mobile_menu_top_position'] ?? [];

		// Use Content section value if set, otherwise use Style section value
		if ( isset( $toggle_menu_top_position_content['size'] ) && $toggle_menu_top_position_content['size'] !== '' ) {
			$mobile_menu_top_position = (int) $toggle_menu_top_position_content['size'];
		} elseif ( isset( $mobile_menu_top_position_style['size'] ) ) {
			$mobile_menu_top_position = (int) $mobile_menu_top_position_style['size'];
		} else {
			$mobile_menu_top_position = 80;
		}

		// Mobile submenu padding - for submenu container (not items)
		$mobile_submenu_padding = $s['mobile_submenu_padding'] ?? [];
		$pp_unit = isset( $mobile_submenu_padding['unit'] ) ? $mobile_submenu_padding['unit'] : 'px';
		$mobile_submenu_padding_top = isset( $mobile_submenu_padding['top'] ) ? $mobile_submenu_padding['top'] . $pp_unit : '8px';
		$mobile_submenu_padding_right = isset( $mobile_submenu_padding['right'] ) ? $mobile_submenu_padding['right'] . $pp_unit : '0';
		$mobile_submenu_padding_bottom = isset( $mobile_submenu_padding['bottom'] ) ? $mobile_submenu_padding['bottom'] . $pp_unit : '8px';
		$mobile_submenu_padding_left = isset( $mobile_submenu_padding['left'] ) ? $mobile_submenu_padding['left'] . $pp_unit : '0';

		// Mobile submenu margin - for submenu container (not items)
		$mobile_submenu_margin = $s['mobile_submenu_margin'] ?? [];
		$pm_unit = isset( $mobile_submenu_margin['unit'] ) ? $mobile_submenu_margin['unit'] : 'px';
		$mobile_submenu_margin_top = isset( $mobile_submenu_margin['top'] ) ? $mobile_submenu_margin['top'] . $pm_unit : '6px';
		$mobile_submenu_margin_right = isset( $mobile_submenu_margin['right'] ) ? $mobile_submenu_margin['right'] . $pm_unit : '0';
		$mobile_submenu_margin_bottom = isset( $mobile_submenu_margin['bottom'] ) ? $mobile_submenu_margin['bottom'] . $pm_unit : '0';
		$mobile_submenu_margin_left = isset( $mobile_submenu_margin['left'] ) ? $mobile_submenu_margin['left'] . $pm_unit : '0';

		// Submenu background (used for both desktop and mobile)
		$submenu_bg_color = $s['submenu_bg_color'] ?? '#ffffff';

		// Mobile submenu item border radius - for mobile submenu items
		$mobile_submenu_item_radius_setting = $s['mobile_submenu_item_radius'] ?? [];
		$radius_unit = isset( $mobile_submenu_item_radius_setting['unit'] ) ? $mobile_submenu_item_radius_setting['unit'] : 'px';
		$mobile_submenu_item_radius = isset( $mobile_submenu_item_radius_setting['size'] ) ? $mobile_submenu_item_radius_setting['size'] . $radius_unit : '8px';

		// Mobile menu background - check both controls
		$mobile_menu_bg_toggle = $s['mobile_menu_bg_toggle'] ?? '';
		$mobile_menu_bg_from_setting = $s['mobile_menu_bg'] ?? '#ffffff';

		// Use mobile_menu_bg_toggle if it's set, otherwise use mobile_menu_bg
		$mobile_menu_bg = ! empty( $mobile_menu_bg_toggle ) ? $mobile_menu_bg_toggle : $mobile_menu_bg_from_setting;

		// Container background on toggle open
		$container_bg_on_toggle_open = $s['container_bg_on_toggle_open'] ?? '';

		// Desktop menu background (separate from mobile)
		$menu_background = $s['menu_background'] ?? 'transparent';

		$wrap_id   = 'orivo-nav-' . $this->get_id();
		$toggle_id = 'orivo-toggle-' . $this->get_id();

		// Build class array
		$nav_classes   = [ 'orivo-navbar-blocks', 'orivo-navbar-blocks--' . $layout ];
		$nav_classes[] = 'dropdown-animation-' . $dropdown_animation;
		$nav_classes[] = 'dropdown-indicator-' . $dropdown_indicator;
		$nav_classes[] = 'mobile-position-' . $mobile_position;
		$nav_classes[] = 'mobile-submenu-' . $mobile_submenu_behavior;
		$nav_classes[] = 'underline-animation-' . $underline_animation;
		$nav_classes[] = 'underline-position-' . $underline_position;
		if ( $mobile_full_width ) {
			$nav_classes[] = 'mobile-full-width';
		}
		if ( $enable_menu_icons ) {
			$nav_classes[] = 'orivo-nav-icons-yes';
		}
		$nav_class_string = implode( ' ', $nav_classes );

		// Menu args
		$args = [
			'container'      => false,
			'fallback_cb'    => false,
			'menu_class'     => 'orivo-navbar-blocks__menu',
			'depth'          => 3,
			'echo'           => true,
			'walker'         => new Orivo_Nav_Menu_Icon_Walker(),
			'dropdown_indicator' => $dropdown_indicator,
			'dropdown_icon'     => $dropdown_icon,
		];

		if ( $source === 'location' && ! empty( $location ) ) {
			$args['theme_location'] = $location;
		} elseif ( ! empty( $menu_id ) ) {
			$args['menu'] = (int) $menu_id;
		}

		$has_menu = ( ! empty( $args['menu'] ) || ! empty( $args['theme_location'] ) );

		// Store widget instance for walker (for menu icons)
		global $orivo_nav_widget_instance;
		$orivo_nav_widget_instance = $this;

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

			/* Desktop menu background - always visible on desktop */
			@media (min-width: <?php echo (int) $breakpoint + 1; ?>px) {
				#<?php echo esc_attr( $wrap_id ); ?> .orivo-navbar-blocks__menu {
					background: <?php echo esc_attr( $menu_background ); ?> !important;
				}
			}

			/* Mobile breakpoint - dynamic based on user setting */
			@media (max-width: <?php echo (int) $breakpoint; ?>px) {
				/* Container */
				#<?php echo esc_attr( $wrap_id ); ?> .orivo-navbar-blocks__container {
					justify-content: flex-start;
				}
				#<?php echo esc_attr( $wrap_id ); ?> .orivo-navbar-blocks__toggle-btn {
					display: block;
				}
				/* Container background when toggle is open */
				<?php if ( ! empty( $container_bg_on_toggle_open ) ): ?>
				#<?php echo esc_attr( $wrap_id ); ?> .orivo-navbar-blocks__toggle:checked ~ .orivo-navbar-blocks__container {
					background: <?php echo esc_attr( $container_bg_on_toggle_open ); ?> !important;
				}
				<?php endif; ?>
				#<?php echo esc_attr( $wrap_id ); ?> .orivo-navbar-blocks__menu {
					position: fixed;
					top: <?php echo (int) $mobile_menu_top_position; ?>px;
					left: 20px;
					right: 20px;
					width: calc(100% - 40px);
					flex-direction: column;
					row-gap: 16px;
					background: transparent !important;
					-webkit-backdrop-filter: blur(20px);
					backdrop-filter: blur(20px);
					box-shadow: 0 8px 32px rgba(0,0,0,.20);
					border-radius: 16px;
					opacity: 0;
					visibility: hidden;
					transform: translateY(-20px);
					transition: all .3s ease;
					z-index: 10001;
				}
				#<?php echo esc_attr( $wrap_id ); ?> .orivo-navbar-blocks__toggle:checked ~ .orivo-navbar-blocks__menu {
					opacity: 1 !important;
					visibility: visible !important;
					transform: translateY(0) !important;
					background: <?php echo esc_attr( $mobile_menu_bg ); ?> !important;
					-webkit-backdrop-filter: none !important;
					backdrop-filter: none !important;
				}
				#<?php echo esc_attr( $wrap_id ); ?> .orivo-navbar-blocks__menu > li > a {
					display: block;
					width: 100%;
					font-size: 18px;
					border-radius: 12px;
					text-align: center;
				}
				#<?php echo esc_attr( $wrap_id ); ?> .orivo-navbar-blocks__menu > li > a::after {
					display: none !important;
				}

				/* Mobile Submenu - Always Open (default) */
				#<?php echo esc_attr( $wrap_id ); ?>.mobile-submenu-always-open .orivo-navbar-blocks__menu ul {
					position: static;
					opacity: 1;
					visibility: visible;
					transform: none;
					box-shadow: 0 2px 8px rgba(0,0,0,.10);
					padding: <?php echo esc_attr( $mobile_submenu_padding_top ); ?> <?php echo esc_attr( $mobile_submenu_padding_right ); ?> <?php echo esc_attr( $mobile_submenu_padding_bottom ); ?> <?php echo esc_attr( $mobile_submenu_padding_left ); ?>;
					margin: <?php echo esc_attr( $mobile_submenu_margin_top ); ?> <?php echo esc_attr( $mobile_submenu_margin_right ); ?> <?php echo esc_attr( $mobile_submenu_margin_bottom ); ?> <?php echo esc_attr( $mobile_submenu_margin_left ); ?>;
					background: <?php echo esc_attr( $submenu_bg_color ); ?> !important;
				}
				#<?php echo esc_attr( $wrap_id ); ?>.mobile-submenu-always-open .orivo-navbar-blocks__menu ul li a {
					font-size: 16px;
					border-radius: <?php echo esc_attr( $mobile_submenu_item_radius ); ?> !important;
				}

				/* Mobile Submenu - Collapsed (Hidden by default) */
				#<?php echo esc_attr( $wrap_id ); ?>.mobile-submenu-collapsed .orivo-navbar-blocks__menu ul {
					position: static;
					opacity: 0;
					visibility: hidden;
					transform: translateY(-10px);
					box-shadow: 0 2px 8px rgba(0,0,0,.10);
					max-height: 0;
					overflow: hidden;
					margin: 0;
					padding: 0;
					transition: all .3s ease;
					background: <?php echo esc_attr( $submenu_bg_color ); ?> !important;
				}
				#<?php echo esc_attr( $wrap_id ); ?>.mobile-submenu-collapsed .orivo-navbar-blocks__menu li:hover > ul,
				#<?php echo esc_attr( $wrap_id ); ?>.mobile-submenu-collapsed .orivo-navbar-blocks__menu li > a:focus + ul {
					opacity: 1;
					visibility: visible;
					transform: translateY(0);
					max-height: 500px;
					padding: <?php echo esc_attr( $mobile_submenu_padding_top ); ?> <?php echo esc_attr( $mobile_submenu_padding_right ); ?> <?php echo esc_attr( $mobile_submenu_padding_bottom ); ?> <?php echo esc_attr( $mobile_submenu_padding_left ); ?>;
					margin: <?php echo esc_attr( $mobile_submenu_margin_top ); ?> <?php echo esc_attr( $mobile_submenu_margin_right ); ?> <?php echo esc_attr( $mobile_submenu_margin_bottom ); ?> <?php echo esc_attr( $mobile_submenu_margin_left ); ?>;
				}
				#<?php echo esc_attr( $wrap_id ); ?>.mobile-submenu-collapsed .orivo-navbar-blocks__menu ul li a {
					font-size: 16px;
					border-radius: <?php echo esc_attr( $mobile_submenu_item_radius ); ?> !important;
				}

				/* Mobile Position Bottom */
				#<?php echo esc_attr( $wrap_id ); ?>.mobile-position-bottom .orivo-navbar-blocks__menu {
					top: auto;
					bottom: <?php echo (int) $mobile_menu_top_position; ?>px;
					transform: translateY(20px);
				}
				#<?php echo esc_attr( $wrap_id ); ?>.mobile-position-bottom .orivo-navbar-blocks__toggle:checked ~ .orivo-navbar-blocks__menu {
					transform: translateY(0) !important;
				}

				/* Mobile Full Width */
				#<?php echo esc_attr( $wrap_id ); ?>.mobile-full-width .orivo-navbar-blocks__menu {
					left: 0;
					right: 0;
					width: 100%;
				}
			}
		</style>

		<?php
	}
}

/**
 * Custom Nav Menu Walker for Icons
 */
class Orivo_Nav_Menu_Icon_Walker extends \Walker_Nav_Menu {

	/**
	 * Start the element output.
	 *
	 * @param string  $output Used to append additional content (passed by reference).
	 * @param WP_Post $item   Menu item data object.
	 * @param int     $depth  Depth of menu item. Used for padding.
	 * @param array   $args   An array of wp_nav_menu() arguments.
	 * @param int     $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes   = empty( $item->classes ) ? [] : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		if ( '_blank' === $item->target && empty( $item->xfn ) ) {
			$atts['rel'] = 'noopener noreferrer';
		} else {
			$atts['rel'] = $item->xfn;
		}
		$atts['href']         = ! empty( $item->url ) ? $item->url : '';
		$atts['aria-current'] = $item->current ? 'page' : '';

		// Add icon before title if exists
		$icon_output = '';
		$icon_class = get_post_meta( $item->ID, '_menu_item_icon', true );

		// Check description for icon format: icon:fas fa-home
		$description = $item->description ?? '';
		if ( empty( $icon_class ) && ! empty( $description ) && strpos( $description, 'icon:' ) === 0 ) {
			$icon_class = str_replace( 'icon:', '', $description );
		}

		if ( ! empty( $icon_class ) ) {
			$icon_output = '<span class="orivo-menu-icon ' . esc_attr( $icon_class ) . '"></span>';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = isset( $args->before ) ? $args->before : '';
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $icon_output . ( isset( $args->link_before ) ? $args->link_before : '' );
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= apply_filters( 'the_title', $item->title, $item->ID );

		// Add dropdown icon for items with children
		if ( in_array( 'menu-item-has-children', $item->classes ) && $depth === 0 ) {
			$dropdown_indicator = isset( $args->dropdown_indicator ) ? $args->dropdown_indicator : 'icon';
			$dropdown_icon = isset( $args->dropdown_icon ) ? $args->dropdown_icon : '';

			if ( 'icon' === $dropdown_indicator && ! empty( $dropdown_icon ) && isset( $dropdown_icon['value'] ) && ! empty( $dropdown_icon['value'] ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $dropdown_icon, [ 'aria-hidden' => 'true' ] );
				$icon_html = ob_get_clean();
				if ( ! empty( $icon_html ) ) {
					$item_output .= '<span class="orivo-dropdown-icon">' . $icon_html . '</span>';
				}
			}
		}

		$item_output .= ( isset( $args->link_after ) ? $args->link_after : '' );
		$item_output .= '</a>';
		$item_output .= ( isset( $args->after ) ? $args->after : '' );

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
