<?php

namespace UltraElementorAddons\Widgets;

use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || die();

class Counter extends Widgets_Base {

	public function get_name() {
		return 'ua_counter';
	}

	public function get_title() {
		return __( 'Counter', 'ultra-elementor-addons' );
	}

	public function get_icon() {
		return 'ua-icon eicon-counter';
	}

	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	public function get_keywords() {
		return [ 'counter', 'count', 'number', 'stats', 'statistics' ];
	}

	public function get_style_depends() {
		return [ 'ua-style-counter' ];
	}

	public function get_script_depends() {
		return [ 'ua-script-counter' ];
	}

	protected function ua_register_controls() {

		/* =======================
		 * Content
		 * ======================= */
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Counter Content', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Preset Layout', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Layout 1: Icon + Number + Title', 'ultra-elementor-addons' ),
					'layout-2' => __( 'Layout 2: Circular Progress', 'ultra-elementor-addons' ),
					'layout-3' => __( 'Layout 3: Number + Bar Progress', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'counter_icon',
			[
				'label' => __( 'Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-trophy',
					'library' => 'fa-solid',
				],
				'condition' => [
					'layout' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'counter_icon_heading',
			[
				'label'     => __( 'Icon Styling', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout' => 'layout-1',
				],
			]
		);

		/* ========================
		 * Icon Tabs
		 * ======================== */
		$this->start_controls_tabs( 'icon_style_tabs', [ 'condition' => [ 'layout' => 'layout-1' ] ] );

		/* Style Tab */
		$this->start_controls_tab(
			'icon_tab_style',
			[
				'label' => __( 'Style', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'counter_icon_color',
			[
				'label'     => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1F2937',
				'selectors' => [
					'{{WRAPPER}} .orivo-counter-blocks__icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-counter-blocks__icon svg' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
				],
				'global'    => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'counter_icon_background',
			[
				'label'     => __( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-counter-blocks__icon' => 'background-color: {{VALUE}};',
				],
				'global'    => [
					'active' => true,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'counter_icon_border',
				'label'    => __( 'Border', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-counter-blocks__icon',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'counter_icon_box_shadow',
				'selector' => '{{WRAPPER}} .orivo-counter-blocks__icon',
			]
		);

		$this->end_controls_tab();

		/* Size Tab */
		$this->start_controls_tab(
			'icon_tab_size',
			[
				'label' => __( 'Size', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'counter_icon_size',
			[
				'label'      => __( 'Icon Size', 'ultra-elementor-addons' ),
				'description' => __( 'Size of the icon itself', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 10, 'max' => 100 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 48 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .orivo-counter-blocks__icon i, {{WRAPPER}} .orivo-counter-blocks__icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'counter_icon_box_size',
			[
				'label'      => __( 'Box Size', 'ultra-elementor-addons' ),
				'description' => __( 'Size of the icon container', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 40, 'max' => 200 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 80 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		/* Box Tab */
		$this->start_controls_tab(
			'icon_tab_box',
			[
				'label' => __( 'Box', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'counter_icon_border_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'counter_icon_padding',
			[
				'label'      => __( 'Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'counter_content_heading',
			[
				'label' => __( 'Counter Content', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'counter_number',
			[
				'label'       => __( 'Number', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 1250,
				'min'         => 0,
				'max'         => 1000000,
				'step'        => 1,
				'description' => __( 'The number to count up to', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'counter_prefix',
			[
				'label'       => __( 'Prefix', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => __( 'Text before number (e.g., $, +, #)', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'counter_suffix',
			[
				'label'       => __( 'Suffix', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => __( 'Text after number (e.g., %, +, k)', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'counter_title',
			[
				'label'       => __( 'Title', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Projects Completed', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'counter_percent',
			[
				'label'       => __( 'Progress Percentage', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 85,
				],
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'condition'   => [
					'layout!' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'counter_link',
			[
				'label'         => __( 'Link', 'ultra-elementor-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => 'https://example.com',
				'show_external' => true,
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

		/* ========================
		 * Container Tabs
		 * ======================== */
		$this->start_controls_tabs( 'container_style_tabs' );

		/* Box Tab */
		$this->start_controls_tab(
			'container_tab_box',
			[
				'label' => __( 'Box', 'ultra-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'container_padding',
			[
				'label'      => __( 'Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'      => '30',
					'right'    => '30',
					'bottom'   => '30',
					'left'     => '30',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		/* Style Tab */
		$this->start_controls_tab(
			'container_tab_style',
			[
				'label' => __( 'Style', 'ultra-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'item_background',
				'label'    => __( 'Background', 'ultra-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .orivo-counter-blocks__item',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'item_border',
				'selector' => '{{WRAPPER}} .orivo-counter-blocks__item',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .orivo-counter-blocks__item',
			]
		);

		$this->end_controls_tab();

		/* Alignment Tab */
		$this->start_controls_tab(
			'container_tab_alignment',
			[
				'label' => __( 'Alignment', 'ultra-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'item_alignment',
			[
				'label'     => __( 'Alignment', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/* =======================
		 * Style - Number
		 * ======================= */
		$this->start_controls_section(
			'section_style_number',
			[
				'label' => __( 'Number', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		/* ========================
		 * Number Tabs
		 * ======================== */
		$this->start_controls_tabs( 'number_style_tabs' );

		/* Typography Tab */
		$this->start_controls_tab(
			'number_tab_typography',
			[
				'label' => __( 'Typography', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'number_color',
			[
				'label'     => __( 'Number Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1F2937',
				'selectors' => [
					'{{WRAPPER}} .orivo-counter-blocks__number' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typography',
				'label'    => __( 'Number Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-counter-blocks__number',
			]
		);

		$this->end_controls_tab();

		/* Spacing Tab */
		$this->start_controls_tab(
			'number_tab_spacing',
			[
				'label' => __( 'Spacing', 'ultra-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'number_spacing',
			[
				'label'      => __( 'Top Spacing', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 0 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__number' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/* =======================
		 * Style - Title
		 * ======================= */
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		/* ========================
		 * Title Tabs
		 * ======================== */
		$this->start_controls_tabs( 'title_style_tabs' );

		/* Typography Tab */
		$this->start_controls_tab(
			'title_tab_typography',
			[
				'label' => __( 'Typography', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#6B7280',
				'selectors' => [
					'{{WRAPPER}} .orivo-counter-blocks__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-counter-blocks__title',
			]
		);

		$this->end_controls_tab();

		/* Spacing Tab */
		$this->start_controls_tab(
			'title_tab_spacing',
			[
				'label' => __( 'Spacing', 'ultra-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Top Spacing', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 10 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/* =======================
		 * Style - Progress (Layout 2 & 3)
		 * ======================= */
		$this->start_controls_section(
			'section_style_progress',
			[
				'label'     => __( 'Progress', 'ultra-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'layout-1',
				],
			]
		);

		/* ========================
		 * Colors Tab
		 * ======================== */
		$this->start_controls_tabs( 'progress_style_tabs' );

		$this->start_controls_tab(
			'progress_tab_colors',
			[
				'label' => __( 'Colors', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'progress_color',
			[
				'label'     => __( 'Progress Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#6366F1',
				'selectors' => [
					'{{WRAPPER}} .orivo-counter-blocks__circle-progress' => 'stroke: {{VALUE}};',
					'{{WRAPPER}} .orivo-counter-blocks__progress-bar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'progress_bg_color',
			[
				'label'     => __( 'Progress Background', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#E5E7EB',
				'selectors' => [
					'{{WRAPPER}} .orivo-counter-blocks__circle-bg' => 'stroke: {{VALUE}};',
					'{{WRAPPER}} .orivo-counter-blocks--layout-3 .orivo-counter-blocks__progress' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'progress_number_color',
			[
				'label'     => __( 'Number Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1F2937',
				'selectors' => [
					'{{WRAPPER}} .orivo-counter-blocks__progress-number' => 'color: {{VALUE}};',
				],
				'condition' => [
					'layout' => 'layout-2',
				],
			]
		);

		$this->end_controls_tab();

		/* ========================
		 * Typography Tab (Layout 2)
		 * ======================== */
		$this->start_controls_tab(
			'progress_tab_typography',
			[
				'label'     => __( 'Typography', 'ultra-elementor-addons' ),
				'condition' => [
					'layout' => 'layout-2',
				],
			]
		);

		$this->add_responsive_control(
			'progress_number_font_size',
			[
				'label'      => __( 'Number Font Size', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 12, 'max' => 48 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 24 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__progress-number' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		/* ========================
		 * Size Tab (Layout 2)
		 * ======================== */
		$this->start_controls_tab(
			'progress_tab_size',
			[
				'label'     => __( 'Size', 'ultra-elementor-addons' ),
				'condition' => [
					'layout' => 'layout-2',
				],
			]
		);

		$this->add_responsive_control(
			'progress_size',
			[
				'label'      => __( 'Progress Size', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 80, 'max' => 200 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 120 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__progress svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'progress_stroke_width',
			[
				'label'      => __( 'Stroke Width', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 2, 'max' => 20 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 8 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__circle-progress' => 'stroke-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .orivo-counter-blocks__circle-bg' => 'stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		/* ========================
		 * Bar Tab (Layout 3)
		 * ======================== */
		$this->start_controls_tab(
			'progress_tab_bar',
			[
				'label'     => __( 'Bar', 'ultra-elementor-addons' ),
				'condition' => [
					'layout' => 'layout-3',
				],
			]
		);

		$this->add_responsive_control(
			'progress_height',
			[
				'label'      => __( 'Progress Height', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 2, 'max' => 20 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 14 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks--layout-3 .orivo-counter-blocks__progress' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'progress_width',
			[
				'label'      => __( 'Progress Width', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 50, 'max' => 500 ],
					'%' => [ 'min' => 10, 'max' => 100 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 220 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks--layout-3 .orivo-counter-blocks__progress' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		/* ========================
		 * Spacing Tab
		 * ======================== */
		$this->start_controls_tab(
			'progress_tab_spacing',
			[
				'label' => __( 'Spacing', 'ultra-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'progress_spacing',
			[
				'label'      => __( 'Progress Top Spacing', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 15 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__progress' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$layout = ! empty( $settings['layout'] ) ? $settings['layout'] : 'layout-1';

		// Get alignment for responsive devices
		$alignment = $settings['item_alignment'];
		if ( is_array( $alignment ) ) {
			$alignment = $alignment['size'] ?? 'center';
		}

		$container_classes = [
			'orivo-counter-blocks',
			'orivo-counter-blocks--' . $layout,
			'orivo-counter-blocks__item',
			'orivo-counter-blocks--align-' . $alignment,
		];

		echo '<div class="' . esc_attr( implode( ' ', $container_classes ) ) . '">';

		// Link wrapper
		if ( ! empty( $settings['counter_link']['url'] ) ) {
			$this->add_link_attributes( 'counter_link', $settings['counter_link'] );
			echo '<a ' . $this->get_render_attribute_string( 'counter_link' ) . ' class="orivo-counter-blocks--align-' . esc_attr( $alignment ) . '">';
		}

		// Layout 1: Icon + Number + Title
		if ( 'layout-1' === $layout ) {
			// Icon - always render if layout is 1, use default if not set
			$icon_value = isset( $settings['counter_icon']['value'] ) ? $settings['counter_icon']['value'] : '';
			if ( ! empty( $icon_value ) ) {
				echo '<div class="orivo-counter-blocks__icon">';
				Icons_Manager::render_icon( $settings['counter_icon'], [ 'aria-hidden' => 'true' ] );
				echo '</div>';
			}

			// Number
			$prefix = ! empty( $settings['counter_prefix'] ) ? '<span class="orivo-counter-blocks__prefix">' . esc_html( $settings['counter_prefix'] ) . '</span>' : '';
			$suffix = ! empty( $settings['counter_suffix'] ) ? '<span class="orivo-counter-blocks__suffix">' . esc_html( $settings['counter_suffix'] ) . '</span>' : '';
			$number = ! empty( $settings['counter_number'] ) ? $settings['counter_number'] : 0;

			echo '<div class="orivo-counter-blocks__number" data-target="' . esc_attr( $number ) . '">';
			echo $prefix . '<span class="orivo-counter-blocks__count">0</span>' . $suffix;
			echo '</div>';

			// Title
			if ( ! empty( $settings['counter_title'] ) ) {
				echo '<div class="orivo-counter-blocks__title">' . esc_html( $settings['counter_title'] ) . '</div>';
			}
		}

		// Layout 2: Circular Progress
		elseif ( 'layout-2' === $layout ) {
			$percent = isset( $settings['counter_percent']['size'] ) ? $settings['counter_percent']['size'] : 85;
			$number = ! empty( $settings['counter_number'] ) ? $settings['counter_number'] : 0;

			echo '<div class="orivo-counter-blocks__progress" data-percent="' . esc_attr( $percent ) . '">';
			echo '<svg viewBox="0 0 160 160">';
			echo '<circle class="orivo-counter-blocks__circle-bg" cx="80" cy="80" r="70"></circle>';
			echo '<circle class="orivo-counter-blocks__circle-progress" cx="80" cy="80" r="70"></circle>';
			echo '</svg>';
			echo '<span class="orivo-counter-blocks__progress-number">';
			echo '<span class="orivo-counter-blocks__count">0</span>';
			if ( ! empty( $settings['counter_suffix'] ) ) {
				echo '<span class="orivo-counter-blocks__suffix">' . esc_html( $settings['counter_suffix'] ) . '</span>';
			}
			echo '</span>';
			echo '</div>';

			if ( ! empty( $settings['counter_title'] ) ) {
				echo '<div class="orivo-counter-blocks__title">' . esc_html( $settings['counter_title'] ) . '</div>';
			}
		}

		// Layout 3: Number + Bar Progress
		elseif ( 'layout-3' === $layout ) {
			$number = ! empty( $settings['counter_number'] ) ? $settings['counter_number'] : 0;
			$percent = isset( $settings['counter_percent']['size'] ) ? $settings['counter_percent']['size'] : 85;

			// Number
			$prefix = ! empty( $settings['counter_prefix'] ) ? '<span class="orivo-counter-blocks__prefix">' . esc_html( $settings['counter_prefix'] ) . '</span>' : '';
			$suffix = ! empty( $settings['counter_suffix'] ) ? '<span class="orivo-counter-blocks__suffix">' . esc_html( $settings['counter_suffix'] ) . '</span>' : '';

			echo '<div class="orivo-counter-blocks__number" data-target="' . esc_attr( $number ) . '">';
			echo $prefix . '<span class="orivo-counter-blocks__count">0</span>' . $suffix;
			echo '</div>';

			// Progress Bar
			echo '<div class="orivo-counter-blocks__progress" data-percent="' . esc_attr( $percent ) . '">';
			echo '<div class="orivo-counter-blocks__progress-bar"></div>';
			echo '</div>';

			// Title
			if ( ! empty( $settings['counter_title'] ) ) {
				echo '<div class="orivo-counter-blocks__title">' . esc_html( $settings['counter_title'] ) . '</div>';
			}
		}

		if ( ! empty( $settings['counter_link']['url'] ) ) {
			echo '</a>';
		}

		echo '</div>';
	}
}
