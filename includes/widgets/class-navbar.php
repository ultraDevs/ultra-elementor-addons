<?php

namespace UltraElementorAddons\Widgets;

use Elementor\Repeater;
use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || exit;

class Navbar extends Widgets_Base {

	public function get_name() {
		return 'ua_navigation';
	}

	public function get_title() {
		return __( 'Navigation', 'ultra-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-menu-bar';
	}

	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	public function get_script_depends() {
		return [];
	}

	public function get_style_depends() {
		return [ 'ua-style-navigation' ];
	}

	protected function ua_register_controls() {

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
					'layout-1' => __( 'Layout 1: Left Underline + Left Mobile', 'ultra-elementor-addons' ),
					'layout-2' => __( 'Layout 2: Right Underline + Right Mobile', 'ultra-elementor-addons' ),
					'layout-3' => __( 'Layout 3: Center Underline + Fullscreen Mobile', 'ultra-elementor-addons' ),
				],
			]
		);

		$repeater = new Repeater();

		// Basic Info
		$repeater->add_control(
			'nav_text',
			[
				'label'   => __( 'Menu Text', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Home', 'ultra-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'nav_link',
			[
				'label'       => __( 'Link', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ultra-elementor-addons' ),
				'default'     => [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);

		$repeater->add_control(
			'nav_is_active',
			[
				'label'        => __( 'Active', 'ultra-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$repeater->add_control(
			'nav_disable',
			[
				'label'        => __( 'Disable Link', 'ultra-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description'   => __( 'Disable the link for this menu item', 'ultra-elementor-addons' ),
			]
		);

		// Icon Section
		$repeater->add_control(
			'nav_icon_heading',
			[
				'label'     => __( 'Icon', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'nav_icon',
			[
				'label'            => __( 'Select Icon', 'ultra-elementor-addons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'nav_icon_old',
				'default'          => [
					'value'   => '',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'nav_icon_size',
			[
				'label'      => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 10, 'max' => 50 ],
					'em' => [ 'min' => 0.5, 'max' => 3 ],
				],
				'default'    => [
					'size' => 14,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'nav_icon_color',
			[
				'label'     => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__icon' => 'color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'nav_icon_bg',
			[
				'label'     => __( 'Icon Background', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__icon' => 'background-color: {{VALUE}}; padding: 5px; border-radius: 4px;',
				],
			]
		);

		$repeater->add_control(
			'nav_icon_spacing',
			[
				'label'      => __( 'Icon Spacing', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 30 ],
					'em' => [ 'min' => 0, 'max' => 2 ],
				],
				'default'    => [
					'size' => 6,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Badge Section
		$repeater->add_control(
			'nav_badge_heading',
			[
				'label'     => __( 'Badge', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'nav_badge',
			[
				'label'   => __( 'Badge Text', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$repeater->add_control(
			'nav_badge_position',
			[
				'label'   => __( 'Badge Position', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'after',
				'options' => [
					'after'  => __( 'After Text', 'ultra-elementor-addons' ),
					'before' => __( 'Before Text', 'ultra-elementor-addons' ),
				],
			]
		);

		$repeater->add_control(
			'nav_badge_bg',
			[
				'label'   => __( 'Badge Background', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#667eea',
			]
		);

		$repeater->add_control(
			'nav_badge_color',
			[
				'label'   => __( 'Badge Text Color', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ffffff',
			]
		);

		$repeater->add_control(
			'nav_badge_padding',
			[
				'label'      => __( 'Badge Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'      => 2,
					'right'    => 8,
					'bottom'   => 2,
					'left'     => 8,
					'unit'     => 'px',
					'isLinked' => false,
				],
			]
		);

		$repeater->add_control(
			'nav_badge_radius',
			[
				'label'      => __( 'Badge Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 30 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [
					'size' => 12,
					'unit' => 'px',
				],
			]
		);

		// Custom Style Section
		$repeater->add_control(
			'nav_custom_style',
			[
				'label'        => __( 'Enable Custom Style', 'ultra-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description'   => __( 'Enable custom colors and typography for this item', 'ultra-elementor-addons' ),
				'separator'    => 'before',
			]
		);

		$repeater->add_control(
			'nav_color',
			[
				'label'     => __( 'Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [ 'nav_custom_style' => 'yes' ],
			]
		);

		$repeater->add_control(
			'nav_bg_color',
			[
				'label'     => __( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [ 'nav_custom_style' => 'yes' ],
			]
		);

		$repeater->add_control(
			'nav_font_size',
			[
				'label'      => __( 'Font Size', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px'  => [ 'min' => 10, 'max' => 40 ],
					'em'  => [ 'min' => 0.5, 'max' => 3 ],
					'rem' => [ 'min' => 0.5, 'max' => 3 ],
				],
				'default'    => [
					'size' => 15,
					'unit' => 'px',
				],
				'condition'   => [ 'nav_custom_style' => 'yes' ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__link' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'nav_font_weight',
			[
				'label'     => __( 'Font Weight', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'    => '',
				'options'    => [
					''        => __( 'Default', 'ultra-elementor-addons' ),
					'300'    => __( 'Light (300)', 'ultra-elementor-addons' ),
					'400'    => __( 'Normal (400)', 'ultra-elementor-addons' ),
					'500'    => __( 'Medium (500)', 'ultra-elementor-addons' ),
					'600'    => __( 'Semi Bold (600)', 'ultra-elementor-addons' ),
					'700'    => __( 'Bold (700)', 'ultra-elementor-addons' ),
				],
				'condition' => [ 'nav_custom_style' => 'yes' ],
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__link' => 'font-weight: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'nav_padding',
			[
				'label'      => __( 'Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'      => 2,
					'right'    => 0,
					'bottom'   => 2,
					'left'     => 0,
					'unit'     => 'px',
					'isLinked' => false,
				],
				'condition'   => [ 'nav_custom_style' => 'yes' ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Advanced Options
		$repeater->add_control(
			'nav_custom_id',
			[
				'label'       => __( 'Custom ID', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'Add a custom ID attribute to this menu item', 'ultra-elementor-addons' ),
				'separator'    => 'before',
			]
		);

		$repeater->add_control(
			'nav_custom_class',
			[
				'label'       => __( 'Custom CSS Class', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'Add custom CSS class(es) to this menu item', 'ultra-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'nav_hide_desktop',
			[
				'label'        => __( 'Hide on Desktop', 'ultra-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description'   => __( 'Hide this menu item on desktop screens', 'ultra-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'nav_hide_mobile',
			[
				'label'        => __( 'Hide on Mobile', 'ultra-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description'   => __( 'Hide this menu item on mobile devices', 'ultra-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'nav_tooltip',
			[
				'label'       => __( 'Tooltip', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'Add tooltip text that appears on hover', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'menu_items',
			[
				'label'       => __( 'Menu Items', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ nav_text }}}',
				'default'     => [
					[
						'nav_text'      => __( 'Home', 'ultra-elementor-addons' ),
						'nav_link'      => [ 'url' => '#' ],
						'nav_is_active' => 'yes',
					],
					[
						'nav_text' => __( 'About', 'ultra-elementor-addons' ),
						'nav_link' => [ 'url' => '#' ],
					],
					[
						'nav_text' => __( 'Services', 'ultra-elementor-addons' ),
						'nav_link' => [ 'url' => '#' ],
					],
					[
						'nav_text' => __( 'Contact', 'ultra-elementor-addons' ),
						'nav_link' => [ 'url' => '#' ],
					],
				],
			]
		);

		$this->end_controls_section();

		// STYLE SECTION - Container
		$this->start_controls_section(
			'section_container_style',
			[
				'label' => __( 'Container Style', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'container_height',
			[
				'label'      => __( 'Container Height', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 40, 'max' => 150 ],
					'em' => [ 'min' => 3, 'max' => 10 ],
				],
				'default'    => [
					'size' => 70,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__container' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_padding',
			[
				'label'      => __( 'Container Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => 0,
					'right'    => 24,
					'bottom'   => 0,
					'left'     => 24,
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'container_bg',
				'selector' => '{{WRAPPER}} .orivo-navbar-blocks__container',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [
					'size' => 16,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__container' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'z_index',
			[
				'label'     => __( 'Z Index', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 100,
				'min'       => 1,
				'max'       => 9999,
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__container' => 'z-index: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// MENU ITEMS STYLE
		$this->start_controls_section(
			'section_menu_style',
			[
				'label' => __( 'Menu Items', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'em' => [ 'min' => 0, 'max' => 5 ],
				],
				'default'    => [
					'size' => 40,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__menu' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography',
				'selector' => '{{WRAPPER}} .orivo-navbar-blocks__link',
			]
		);

		$this->add_control(
			'menu_color',
			[
				'label'     => __( 'Menu Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__link' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .orivo-navbar-blocks__link:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'active_color',
			[
				'label'     => __( 'Active Menu Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#667eea',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__link.ua-nav-active' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .orivo-navbar-blocks__link::after' => 'background: linear-gradient(90deg, {{VALUE}}, {{VALUE}});',
				],
			]
		);

		$this->end_controls_section();

		// BADGE STYLE
		$this->start_controls_section(
			'section_badge_style',
			[
				'label' => __( 'Badge', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'badge_typography',
				'selector' => '{{WRAPPER}} .orivo-navbar-blocks__badge',
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label'     => __( 'Badge Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'badge_bg',
			[
				'label'     => __( 'Badge Background', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#667eea',
				'selectors' => [
					'{{WRAPPER}} .orivo-navbar-blocks__badge' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label'      => __( 'Badge Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'      => 2,
					'right'    => 8,
					'bottom'   => 2,
					'left'     => 8,
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'badge_radius',
			[
				'label'      => __( 'Badge Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 30 ],
					'%'  => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [
					'size' => 12,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-navbar-blocks__badge' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$layout     = $settings['layout'] ?? 'layout-3';
		$menu_items = $settings['menu_items'] ?? [];

		$toggle_id = 'ua-nav-toggle-' . $this->get_id();

		// Wrapper/container/menu attributes
		$this->add_render_attribute( 'nav_wrapper', 'class', [ 'orivo-navbar-blocks', 'orivo-navbar-blocks--' . $layout ] );
		$this->add_render_attribute( 'nav_container', 'class', 'orivo-navbar-blocks__container' );

		$this->add_render_attribute( 'nav_toggle', 'type', 'checkbox' );
		$this->add_render_attribute( 'nav_toggle', 'id', $toggle_id );
		$this->add_render_attribute( 'nav_toggle', 'class', 'orivo-navbar-blocks__toggle' );

		$this->add_render_attribute( 'toggle_label', 'for', $toggle_id );
		$this->add_render_attribute( 'toggle_label', 'class', 'orivo-navbar-blocks__toggle-btn' );

		$this->add_render_attribute( 'nav_menu', 'class', 'orivo-navbar-blocks__menu' );
		?>
		<nav <?php $this->print_render_attribute_string( 'nav_wrapper' ); ?>>
			<div <?php $this->print_render_attribute_string( 'nav_container' ); ?>>

				<input <?php $this->print_render_attribute_string( 'nav_toggle' ); ?> />
				<label <?php $this->print_render_attribute_string( 'toggle_label' ); ?> aria-label="<?php echo esc_attr__( 'Toggle navigation', 'ultra-elementor-addons' ); ?>">
					<span></span><span></span><span></span>
				</label>

				<ul <?php $this->print_render_attribute_string( 'nav_menu' ); ?>>
					<?php if ( ! empty( $menu_items ) ) : ?>
						<?php foreach ( $menu_items as $index => $item ) :

							$text           = $item['nav_text'] ?? '';
							$link           = $item['nav_link'] ?? [];
							$is_active      = ( $item['nav_is_active'] ?? '' ) === 'yes';
							$is_disabled    = ( $item['nav_disable'] ?? '' ) === 'yes';
							$icon           = $item['nav_icon'] ?? [];
							$badge          = $item['nav_badge'] ?? '';

							// Custom style options
							$custom_style   = ( $item['nav_custom_style'] ?? '' ) === 'yes';
							$nav_color      = $item['nav_color'] ?? '';
							$nav_bg         = $item['nav_bg_color'] ?? '';
							$nav_font_size   = $item['nav_font_size'] ?? '';
							$nav_font_weight = $item['nav_font_weight'] ?? '';
							$nav_padding    = $item['nav_padding'] ?? '';

							// Icon options
							$icon_size      = $item['nav_icon_size'] ?? '';
							$icon_color     = $item['nav_icon_color'] ?? '';
							$icon_bg        = $item['nav_icon_bg'] ?? '';
							$icon_spacing   = $item['nav_icon_spacing'] ?? '';

							// Badge options
							$badge_bg       = $item['nav_badge_bg'] ?? '';
							$badge_color    = $item['nav_badge_color'] ?? '';
							$badge_padding  = $item['nav_badge_padding'] ?? '';
							$badge_radius   = $item['nav_badge_radius'] ?? '';
							$badge_position = $item['nav_badge_position'] ?? 'after';

							// Advanced options
							$custom_id      = $item['nav_custom_id'] ?? '';
							$custom_class   = $item['nav_custom_class'] ?? '';
							$hide_desktop   = ( $item['nav_hide_desktop'] ?? '' ) === 'yes';
							$hide_mobile    = ( $item['nav_hide_mobile'] ?? '' ) === 'yes';
							$tooltip        = $item['nav_tooltip'] ?? '';

							$active_class = $is_active ? ' ua-nav-active' : '';

							// Build item classes
							$item_classes = [ 'orivo-navbar-blocks__item' ];
							if ( $hide_desktop ) {
								$item_classes[] = 'ua-hide-desktop';
							}
							if ( $hide_mobile ) {
								$item_classes[] = 'ua-hide-mobile';
							}
							if ( $is_disabled ) {
								$item_classes[] = 'ua-disabled';
							}

							// Build link attributes using Elementor helper
							$link_key = 'nav_link_' . $index;
							$this->add_link_attributes( $link_key, $link );

							// Add custom ID if provided
							if ( $custom_id ) {
								$this->add_render_attribute( 'link_item_' . $index, 'id', $custom_id );
							}

							// Add custom classes if provided
							if ( $custom_class ) {
								$this->add_render_attribute( 'link_item_' . $index, 'class', explode( ' ', $custom_class ), true );
							}

							// Add tooltip if provided
							if ( $tooltip ) {
								$this->add_render_attribute( 'link_item_' . $index, 'title', $tooltip );
							}

							// Disable link if needed
							if ( $is_disabled ) {
								$this->add_render_attribute( 'link_item_' . $index, 'tabindex', '-1' );
							}

							// Build inline styles
							$item_style = '';
							if ( $custom_style ) {
								if ( $nav_color ) {
									$item_style .= 'color:' . $nav_color . ';';
								}
								if ( $nav_bg ) {
									$item_style .= 'background-color:' . $nav_bg . ';';
								}
								if ( $nav_font_size ) {
									$item_style .= 'font-size:' . $nav_font_size['size'] . $nav_font_size['unit'] . ';';
								}
								if ( $nav_font_weight ) {
									$item_style .= 'font-weight:' . $nav_font_weight . ';';
								}
								if ( $nav_padding && isset( $nav_padding['top'] ) ) {
									$item_style .= 'padding:' . $nav_padding['top'] . $nav_padding['unit'] . ' ' . $nav_padding['right'] . $nav_padding['unit'] . ' ' . $nav_padding['bottom'] . $nav_padding['unit'] . ' ' . $nav_padding['left'] . $nav_padding['unit'] . ';';
								}
							}

							// Icon styles
							$icon_style = '';
							if ( $icon_color ) {
								$icon_style .= 'color:' . $icon_color . ';';
							}
							if ( $icon_bg ) {
								$icon_style .= 'background-color:' . $icon_bg . '; padding: 5px; border-radius: 4px;';
							}
							if ( $icon_spacing ) {
								$icon_style .= 'margin-right:' . $icon_spacing['size'] . $icon_spacing['unit'] . ';';
							}

							// Badge styles
							$badge_style = '';
							if ( $badge_bg ) {
								$badge_style .= 'background-color:' . $badge_bg . ';';
							}
							if ( $badge_color ) {
								$badge_style .= 'color:' . $badge_color . ';';
							}
							if ( $badge_padding && isset( $badge_padding['top'] ) ) {
								$badge_style .= 'padding:' . $badge_padding['top'] . $badge_padding['unit'] . ' ' . $badge_padding['right'] . $badge_padding['unit'] . ' ' . $badge_padding['bottom'] . $badge_padding['unit'] . ' ' . $badge_padding['left'] . $badge_padding['unit'] . ';';
							}
							if ( $badge_radius ) {
								$badge_style .= 'border-radius:' . $badge_radius['size'] . $badge_radius['unit'] . ';';
							}

							$migrated = isset( $item['__fa4_migrated']['nav_icon'] );
							$is_new   = empty( $item['nav_icon_old'] );
							?>
							<li class="<?php echo esc_attr( implode( ' ', $item_classes ) ); ?>">
								<?php if ( $is_disabled ) : ?>
									<span class="orivo-navbar-blocks__link-wrapper">
								<?php endif; ?>

								<a <?php $this->print_render_attribute_string( 'link_item_' . $index ); ?>
									class="orivo-navbar-blocks__link<?php echo esc_attr( $active_class ); ?>"
									<?php echo $item_style ? ' style="' . esc_attr( $item_style ) . '"' : ''; ?>>

									<?php if ( ! empty( $icon['value'] ) ) : ?>
										<span class="orivo-navbar-blocks__icon" aria-hidden="true"<?php echo $icon_style ? ' style="' . esc_attr( $icon_style ) . '"' : ''; ?>>
											<?php
											if ( $is_new || $migrated ) {
												Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );
											} else {
												echo '<i class="' . esc_attr( $item['nav_icon_old'] ) . '" aria-hidden="true"></i>';
											}
											?>
										</span>
									<?php endif; ?>

									<span class="orivo-navbar-blocks__text"><?php echo esc_html( $text ); ?></span>

									<?php if ( $badge !== '' && $badge_position === 'before' ) : ?>
										<span class="orivo-navbar-blocks__badge"<?php echo $badge_style ? ' style="' . esc_attr( $badge_style ) . '"' : ''; ?>>
											<?php echo esc_html( $badge ); ?>
										</span>
									<?php endif; ?>
								</a>

								<?php if ( $badge !== '' && $badge_position === 'after' ) : ?>
									<span class="orivo-navbar-blocks__badge"<?php echo $badge_style ? ' style="' . esc_attr( $badge_style ) . '"' : ''; ?>>
										<?php echo esc_html( $badge ); ?>
									</span>
								<?php endif; ?>

								<?php if ( $is_disabled ) : ?>
									</span>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>

			</div>
		</nav>
		<?php
	}
}
