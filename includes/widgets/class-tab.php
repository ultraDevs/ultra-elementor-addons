<?php

namespace UltraElementorAddons\Widgets;

use Elementor\Repeater;
use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || die();

class Tab extends Widgets_Base {

	public function get_name() {
		return 'ua_tab';
	}

	public function get_title() {
		return __( 'Tab Blocks', 'ultra-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-tabs';
	}

	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	public function get_keywords() {
		return [ 'tab', 'tabs', 'toggle', 'accordion' ];
	}

	public function get_style_depends() {
		return [ 'ua-style-tab-blocks' ];
	}

	public function get_script_depends() {
		return [ 'ua-script-tab-blocks' ];
	}

	protected function ua_register_controls() {

		/* =======================
		 * Content
		 * ======================= */
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Tab Blocks', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'tabs_direction',
			[
				'label'   => __( 'Direction', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => __( 'Horizontal', 'ultra-elementor-addons' ),
					'vertical'   => __( 'Vertical', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label'     => __( 'Icon Position', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'    => [
					'left'  => __( 'Left', 'ultra-elementor-addons' ),
					'right' => __( 'Right', 'ultra-elementor-addons' ),
					'none'  => __( 'None', 'ultra-elementor-addons' ),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_icon',
			[
				'label' => __( 'Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-home',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Tab Title', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Tab Title', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => __( 'Tab Content', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Tab content goes here.', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => __( 'Tabs', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_icon' => [
							'value' => 'fas fa-home',
							'library' => 'fa-solid',
						],
						'tab_title' => 'Overview',
						'tab_content' => 'Modern glass UI with smooth animation, perfect for SaaS dashboards and premium landing pages.',
					],
					[
						'tab_icon' => [
							'value' => 'fas fa-star',
							'library' => 'fa-solid',
						],
						'tab_title' => 'Features',
						'tab_content' => 'Fully responsive, animated indicator, layout variants, and easy integration with builders.',
					],
					[
						'tab_icon' => [
							'value' => 'fas fa-dollar-sign',
							'library' => 'fa-solid',
						],
						'tab_title' => 'Pricing',
						'tab_content' => 'Clean content areas designed for readability and conversion-focused layouts.',
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Container
		 * ======================= */
		$this->start_controls_section(
			'section_style_container',
			[
				'label' => __( 'Container', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'container_background',
				'label' => __( 'Background', 'ultra-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .orivo-tabs--blocks',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'container_border',
				'selector' => '{{WRAPPER}} .orivo-tabs--blocks',
			]
		);

		$this->add_control(
			'container_border_radius',
			[
				'label' => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 22,
					'right' => 22,
					'bottom' => 22,
					'left' => 22,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'container_overflow',
			[
				'label' => __( 'Overflow', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'hidden',
				'options' => [
					'hidden' => __( 'Hidden', 'ultra-elementor-addons' ),
					'visible' => __( 'Visible', 'ultra-elementor-addons' ),
					'auto' => __( 'Auto', 'ultra-elementor-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks' => 'overflow: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'container_box_shadow',
				'label' => __( 'Box Shadow', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-tabs--blocks',
			]
		);

		$this->add_responsive_control(
			'container_max_width',
			[
				'label' => __( 'Max Width', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [ 'min' => 100, 'max' => 1400 ],
					'%' => [ 'min' => 10, 'max' => 100 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 1100 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_margin',
			[
				'label' => __( 'Margin', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 0,
					'right' => 'auto',
					'bottom' => 80,
					'left' => 'auto',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Navigation
		 * ======================= */
		$this->start_controls_section(
			'section_style_nav',
			[
				'label' => __( 'Navigation', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_background',
				'label' => __( 'Background', 'ultra-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .orivo-tabs--blocks__nav',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nav_border',
				'selector' => '{{WRAPPER}} .orivo-tabs--blocks__nav',
			]
		);

		$this->add_responsive_control(
			'nav_padding',
			[
				'label' => __( 'Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 10,
					'right' => 10,
					'bottom' => 10,
					'left' => 10,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'nav_gap',
			[
				'label' => __( 'Gap', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 6 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__nav' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'vertical_nav_width',
			[
				'label' => __( 'Vertical Nav Width', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [ 'min' => 150, 'max' => 500 ],
					'%' => [ 'min' => 15, 'max' => 50 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 260 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks--vertical .orivo-tabs--blocks__nav' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'tabs_direction' => 'vertical',
				],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Tabs
		 * ======================= */
		$this->start_controls_section(
			'section_style_tabs',
			[
				'label' => __( 'Tabs', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tab_color',
			[
				'label' => __( 'Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#94a3b8',
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__tab' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_hover_color',
			[
				'label' => __( 'Hover Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__tab:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_active_color',
			[
				'label' => __( 'Active Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__tab.is-active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'label' => __( 'Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-tabs--blocks__tab',
			]
		);

		$this->add_responsive_control(
			'tab_padding',
			[
				'label' => __( 'Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 14,
					'right' => 22,
					'bottom' => 14,
					'left' => 22,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tab_border_radius',
			[
				'label' => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 14,
					'right' => 14,
					'bottom' => 14,
					'left' => 14,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tab_transition',
			[
				'label' => __( 'Transition Duration', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 's', 'ms' ],
				'range' => [
					's' => [ 'min' => 0, 'max' => 3, 'step' => 0.1 ],
					'ms' => [ 'min' => 100, 'max' => 3000, 'step' => 100 ],
				],
				'default' => [ 'unit' => 's', 'size' => 0.35 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__tab' => 'transition: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tab_icon_heading',
			[
				'label' => __( 'Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tab_icon_color',
			[
				'label' => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .orivo-tabs--blocks__icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_icon_size',
			[
				'label' => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 12, 'max' => 64 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 20 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tab_icon_gap',
			[
				'label' => __( 'Icon Gap', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 30 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 8 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__tab--icon-left' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Indicator
		 * ======================= */
		$this->start_controls_section(
			'section_style_indicator',
			[
				'label' => __( 'Indicator', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'indicator_background',
				'label' => __( 'Background', 'ultra-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .orivo-tabs--blocks__indicator',
				'fields_options' => [
					'background' => [
						'default' => 'gradient',
					],
					'color' => [
						'default' => '#6366f1',
					],
					'color_b' => [
						'default' => '#22d3ee',
					],
				],
			]
		);

		$this->add_control(
			'indicator_border_radius',
			[
				'label' => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 14,
					'right' => 14,
					'bottom' => 14,
					'left' => 14,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__indicator' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'indicator_transition',
			[
				'label' => __( 'Transition Duration', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 's', 'ms' ],
				'range' => [
					's' => [ 'min' => 0, 'max' => 3, 'step' => 0.1 ],
				],
				'default' => [ 'unit' => 's', 'size' => 0.35 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__indicator' => 'transition: transform {{SIZE}}{{UNIT}}, width {{SIZE}}{{UNIT}}, height {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Content
		 * ======================= */
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 48,
					'right' => 48,
					'bottom' => 48,
					'left' => 48,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_title_heading',
			[
				'label' => __( 'Title', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_title_color',
			[
				'label' => __( 'Title Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__panel h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_title_typography',
				'label' => __( 'Title Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-tabs--blocks__panel h3',
			]
		);

		$this->add_responsive_control(
			'content_title_spacing',
			[
				'label' => __( 'Title Bottom Spacing', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 14 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__panel h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_text_heading',
			[
				'label' => __( 'Text', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_text_color',
			[
				'label' => __( 'Text Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'default' => '#94a3b8',
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__panel p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Content Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-tabs--blocks__panel p',
			]
		);

		$this->add_responsive_control(
			'content_max_width',
			[
				'label' => __( 'Max Width', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [ 'min' => 100, 'max' => 1000 ],
					'%' => [ 'min' => 10, 'max' => 100 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 680 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__panel p' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_line_height',
			[
				'label' => __( 'Line Height', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'em' ],
				'range' => [
					'em' => [ 'min' => 1, 'max' => 3, 'step' => 0.1 ],
				],
				'default' => [ 'unit' => 'em', 'size' => 1.8 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__panel p' => 'line-height: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'content_animation_heading',
			[
				'label' => __( 'Animation', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_animation_duration',
			[
				'label' => __( 'Animation Duration', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 's', 'ms' ],
				'range' => [
					's' => [ 'min' => 0.1, 'max' => 2, 'step' => 0.1 ],
				],
				'default' => [ 'unit' => 's', 'size' => 0.45 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-tabs--blocks__panel.is-active' => 'animation-duration: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_animation_distance',
			[
				'label' => __( 'Slide Distance', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 18 ],
				'selectors' => [
					'{{WRAPPER}} @keyframes content' => 'from { opacity: 0; transform: translateY({{SIZE}}{{UNIT}}); } to { opacity: 1; transform: none; }',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$direction = ! empty( $settings['tabs_direction'] ) ? $settings['tabs_direction'] : 'horizontal';
		$icon_position = ! empty( $settings['icon_position'] ) ? $settings['icon_position'] : 'left';
		$tabs = ! empty( $settings['tabs'] ) ? $settings['tabs'] : [];

		$is_vertical = $direction === 'vertical';
		$show_icons = $icon_position !== 'none';

		$container_classes = [ 'orivo-tabs--blocks' ];

		if ( $is_vertical ) {
			$container_classes[] = 'orivo-tabs--blocks--vertical';
		}

		echo '<div class="' . esc_attr( implode( ' ', $container_classes ) ) . '" data-tabs--blocks>';

		echo '<div class="orivo-tabs--blocks__nav" role="tablist">';
		echo '<span class="orivo-tabs--blocks__indicator"></span>';

		foreach ( $tabs as $index => $tab ) {
			$is_active = $index === 0 ? 'is-active' : '';
			$aria_selected = $index === 0 ? 'true' : 'false';
			$tab_id = 'tab-' . $this->get_id() . '-' . $index;

			$tab_classes = [ 'orivo-tabs--blocks__tab', $is_active ];
			if ( $show_icons && $icon_position !== 'none' ) {
				$tab_classes[] = 'orivo-tabs--blocks__tab--icon-' . $icon_position;
			}

			echo '<button class="' . esc_attr( implode( ' ', $tab_classes ) ) . '" data-tab="' . esc_attr( $tab_id ) . '" role="tab" aria-selected="' . esc_attr( $aria_selected ) . '" aria-controls="' . esc_attr( $tab_id ) . '">';

			if ( $show_icons && ! empty( $tab['tab_icon']['value'] ) ) {
				echo '<span class="orivo-tabs--blocks__icon">';
				Icons_Manager::render_icon( $tab['tab_icon'], [ 'aria-hidden' => 'true' ] );
				echo '</span>';
			}

			echo '<span class="orivo-tabs--blocks__title">' . esc_html( $tab['tab_title'] ) . '</span>';
			echo '</button>';
		}

		echo '</div>';

		echo '<div class="orivo-tabs--blocks__content">';

		foreach ( $tabs as $index => $tab ) {
			$is_active = $index === 0 ? 'is-active' : '';
			$tab_id = 'tab-' . $this->get_id() . '-' . $index;

			echo '<div class="orivo-tabs--blocks__panel ' . esc_attr( $is_active ) . '" id="' . esc_attr( $tab_id ) . '" role="tabpanel">';
			echo '<h3>' . esc_html( $tab['tab_title'] ) . '</h3>';
			echo '<p>' . $this->parse_text_editor( $tab['tab_content'] ) . '</p>';
			echo '</div>';
		}

		echo '</div>';
		echo '</div>';
	}
}
