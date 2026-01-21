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

class Flip_Box extends Widgets_Base {

	public function get_name() {
		return 'ua_flipbox';
	}

	public function get_title() {
		return __( 'Flip Box', 'ultra-elementor-addons' );
	}

	public function get_icon() {
		return 'ua-icon eicon-flip-box';
	}

	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	public function get_keywords() {
		return [ 'flip', 'flip box', 'card', '3d', 'hover', 'blocks' ];
	}

	public function get_style_depends() {
		return [ 'ua-style-flip-blocks' ];
	}

	protected function ua_register_controls() {

		/* =======================
		 * Content
		 * ======================= */
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Flip Blocks', 'ultra-elementor-addons' ),
			]
		);

		// Layout Selection for Single Card
		$this->add_control(
			'layout',
			[
				'label'   => __( 'Layout', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Layout 1: 3D Cube Rotate Y', 'ultra-elementor-addons' ),
					'layout-2' => __( 'Layout 2: 3D Cube Rotate X', 'ultra-elementor-addons' ),
					'layout-3' => __( 'Layout 3: Neon Glow Flip Y', 'ultra-elementor-addons' ),
					'layout-4' => __( 'Layout 4: Neon Glow Flip X', 'ultra-elementor-addons' ),
					'layout-5' => __( 'Layout 5: Split Reveal Horizontal', 'ultra-elementor-addons' ),
					'layout-6' => __( 'Layout 6: Split Reveal Vertical', 'ultra-elementor-addons' ),
					'layout-7' => __( 'Layout 7: Zoom & Rotate Y', 'ultra-elementor-addons' ),
					'layout-8' => __( 'Layout 8: Zoom & Rotate X', 'ultra-elementor-addons' ),
				],
			]
		);

		// Animation Direction for Single Card
		$this->add_control(
			'animation_direction',
			[
				'label'   => __( 'Animation Direction', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'positive',
				'options' => [
					'positive' => __( 'Positive', 'ultra-elementor-addons' ),
					'negative' => __( 'Negative', 'ultra-elementor-addons' ),
				],
			]
		);

		// Scale Animation Toggle
		$this->add_control(
			'scale_animation',
			[
				'label'   => __( 'Scale Animation', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'return_value' => 'yes',
				'label_on' => __( 'Yes', 'ultra-elementor-addons' ),
				'label_off' => __( 'No', 'ultra-elementor-addons' ),
			]
		);

		/* ================= FRONT CONTENT ================= */
		$this->add_control(
			'front_icon',
			[
				'label' => __( 'Front Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-palette',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'front_title',
			[
				'label' => __( 'Front Title', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'UI/UX Design', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'front_desc',
			[
				'label' => __( 'Front Description', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'আকর্ষণীয় এবং ব্যবহারবান্ধব ইন্টারফেস তৈরি করি', 'ultra-elementor-addons' ),
			]
		);

		/* ================= BACK CONTENT ================= */
		$this->add_control(
			'back_icon_heading',
			[
				'label'     => __( 'Back Content', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'back_icon_same',
			[
				'label' => __( 'Use Same Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'back_icon',
			[
				'label' => __( 'Back Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-palette',
					'library' => 'fa-solid',
				],
				'condition' => [
					'back_icon_same!' => 'yes',
				],
			]
		);

		$this->add_control(
			'back_title',
			[
				'label' => __( 'Back Title', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'UI/UX Design', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'back_desc',
			[
				'label' => __( 'Back Description', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'ব্যবহারকারীদের অভিজ্ঞতা উন্নত করতে আকর্ষণীয় এবং কার্যকরী ইন্টারফেস ডিজাইন করি।', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'options' => [ 'url', 'is_external', 'nofollow' ],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Front
		 * ======================= */
		$this->start_controls_section(
			'section_style_front',
			[
				'label' => __( 'Front Style', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'front_title_color',
			[
				'label' => __( 'Title Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'front_desc_color',
			[
				'label' => __( 'Description Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'front_title_typography',
				'label' => __( 'Title Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__title, {{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__title, {{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'front_description_typography',
				'label' => __( 'Description Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__desc, {{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__desc, {{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__front.orivo-flip-blocks__content .orivo-flip-blocks__desc',
			]
		);

		// Front Icon
		$this->add_control(
			'front_icon_color',
			[
				'label' => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__icon svg' => 'fill: {{VALUE}} !important; stroke: {{VALUE}} !important;',
					'{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__icon i' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'front_icon_size',
			[
				'label' => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 20, 'max' => 150 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 70 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'front_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 0 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Front Content Spacing
		$this->add_control(
			'front_content_heading',
			[
				'label' => __( 'Content Spacing', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'front_title_spacing',
			[
				'label' => __( 'Title Spacing', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 0 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__front .orivo-flip-blocks__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Front Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'front_border',
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__front',
			]
		);

		// Front Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'front_background',
				'label' => __( 'Background', 'ultra-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__front',
			]
		);

		// Split Layout Background (Layout 5 & 6)
		$this->add_control(
			'split_bg_heading',
			[
				'label' => __( 'Split Layout Backgrounds', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'description' => __( 'For Layout 5 & 6 only', 'ultra-elementor-addons' ),
				'condition' => [
					'layout' => [ 'layout-5', 'layout-6' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'split_left_background',
				'label' => __( 'Left/Top Background', 'ultra-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__left, {{WRAPPER}} .orivo-flip-blocks__top',
				'condition' => [
					'layout' => [ 'layout-5', 'layout-6' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'split_right_background',
				'label' => __( 'Right/Bottom Background', 'ultra-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__right, {{WRAPPER}} .orivo-flip-blocks__bottom',
				'condition' => [
					'layout' => [ 'layout-5', 'layout-6' ],
				],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Back
		 * ======================= */
		$this->start_controls_section(
			'section_style_back',
			[
				'label' => __( 'Back Style', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'back_title_color',
			[
				'label' => __( 'Title Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'back_desc_color',
			[
				'label' => __( 'Description Color', 'ultra-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'back_title_typography',
				'label' => __( 'Title Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__title, {{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__title, {{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'back_description_typography',
				'label' => __( 'Description Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__desc, {{WRAPPER}} .orivo-flip-blocks--layout-5 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__desc, {{WRAPPER}} .orivo-flip-blocks--layout-6 .orivo-flip-blocks__back.orivo-flip-blocks__content .orivo-flip-blocks__desc',
			]
		);

		// Back Icon
		$this->add_control(
			'back_icon_heading',
			[
				'label' => __( 'Icon Style', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'back_icon_color',
			[
				'label' => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__icon svg' => 'fill: {{VALUE}} !important; stroke: {{VALUE}} !important;',
					'{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__icon i' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'back_icon_size',
			[
				'label' => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 20, 'max' => 150 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 70 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'back_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 0 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Back Content Spacing
		$this->add_control(
			'back_content_heading',
			[
				'label' => __( 'Content Spacing', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'back_title_spacing',
			[
				'label' => __( 'Title Spacing', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 0 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__back .orivo-flip-blocks__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Back Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'back_border',
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__back',
			]
		);

		// Back Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'back_background',
				'label' => __( 'Background', 'ultra-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__back',
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Card
		 * ======================= */
		$this->start_controls_section(
			'section_style_card',
			[
				'label' => __( 'Card Style', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_height',
			[
				'label' => __( 'Card Height', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 180, 'max' => 520 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 350 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'default' => [
					'top' => 40,
					'right' => 40,
					'bottom' => 40,
					'left' => 40,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'card_spacing_heading',
			[
				'label' => __( 'Card Spacing', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'grid_gap',
			[
				'label' => __( 'Grid Gap', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 20 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-flip-blocks-grid' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_box_shadow',
				'selector' => '{{WRAPPER}} .orivo-flip-blocks__front, {{WRAPPER}} .orivo-flip-blocks__back, {{WRAPPER}} .orivo-flip-blocks--layout-5, {{WRAPPER}} .orivo-flip-blocks--layout-6',
			]
		);

		// Border Radius for all layouts
		$this->add_responsive_control(
			'card_border_radius',
			[
				'label' => __( 'Card Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'default' => [
					'top' => 25,
					'right' => 25,
					'bottom' => 25,
					'left' => 25,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					// For layouts 1-4, 7-8: apply to front and back faces
					'{{WRAPPER}} .orivo-flip-blocks__front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .orivo-flip-blocks__back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					// For layouts 5-6: apply to main container and split panels
					'{{WRAPPER}} .orivo-flip-blocks--layout-5' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .orivo-flip-blocks--layout-6' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .orivo-flip-blocks__left' => 'border-radius: {{TOP}}{{UNIT}} 0 0 {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .orivo-flip-blocks__right' => 'border-radius: 0 {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 0;',
					'{{WRAPPER}} .orivo-flip-blocks__top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .orivo-flip-blocks__bottom' => 'border-radius: 0 0 {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Get layout from widget settings
		$layout = ! empty( $settings['layout'] ) ? $settings['layout'] : 'layout-1';

		// Get animation direction from widget settings
		$animation_dir = ! empty( $settings['animation_direction'] ) ? $settings['animation_direction'] : 'positive';

		// Get scale animation setting
		$scale_enabled = ! empty( $settings['scale_animation'] ) && 'yes' === $settings['scale_animation'];

		$wrap_classes = [
			'orivo-flip-blocks-wrapper',
		];

		echo '<div class="' . esc_attr( implode( ' ', $wrap_classes ) ) . '">';
		echo '<div class="orivo-flip-blocks-grid">';

		$card_key = 'card_link_0';

		// Combine layout and direction into single class for CSS targeting
		$card_classes = [
			'orivo-flip-blocks',
			'orivo-flip-blocks--' . esc_attr( $layout ),
			'orivo-flip-blocks--' . esc_attr( $layout ) . '--' . esc_attr( $animation_dir ),
		];

		// Add scale animation class (only for layouts 1, 2, 7, 8 that use scale)
		if ( $scale_enabled && in_array( $layout, [ 'layout-1', 'layout-2', 'layout-7', 'layout-8' ] ) ) {
			$card_classes[] = 'orivo-flip-blocks--scale-enabled';
		}

		$open_tag  = '<div class="' . esc_attr( implode( ' ', $card_classes ) ) . '">';
		$close_tag = '</div>';

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( $card_key, $settings['link'] );
			$open_tag  = '<a class="' . esc_attr( implode( ' ', $card_classes ) ) . '" ' . $this->get_render_attribute_string( $card_key ) . '>';
			$close_tag = '</a>';
		}

		$back_icon = ( ! empty( $settings['back_icon_same'] ) && 'yes' === $settings['back_icon_same'] )
			? ( $settings['front_icon'] ?? [] )
			: ( $settings['back_icon'] ?? [] );

		echo $open_tag;

		if ( 'layout-5' === $layout ) {
			$front_icon_class = empty( $settings['front_icon']['value'] ) ? 'orivo-flip-blocks__icon no-icon' : 'orivo-flip-blocks__icon';
			$back_icon_class = empty( $back_icon['value'] ) ? 'orivo-flip-blocks__icon no-icon' : 'orivo-flip-blocks__icon';
			?>
			<div class="orivo-flip-blocks__left"></div>
			<div class="orivo-flip-blocks__right"></div>

			<div class="orivo-flip-blocks__back orivo-flip-blocks__content">
				<div class="<?php echo esc_attr( $back_icon_class ); ?>">
					<?php if ( ! empty( $back_icon['value'] ) ) { Icons_Manager::render_icon( $back_icon, [ 'aria-hidden' => 'true' ] ); } ?>
				</div>
				<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $settings['back_title'] ?? '' ); ?></h3>
				<p class="orivo-flip-blocks__desc"><?php echo esc_html( $settings['back_desc'] ?? '' ); ?></p>
			</div>

			<div class="orivo-flip-blocks__front orivo-flip-blocks__content">
				<div class="<?php echo esc_attr( $front_icon_class ); ?>">
					<?php if ( ! empty( $settings['front_icon']['value'] ) ) { Icons_Manager::render_icon( $settings['front_icon'], [ 'aria-hidden' => 'true' ] ); } ?>
				</div>
				<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $settings['front_title'] ?? '' ); ?></h3>
				<p class="orivo-flip-blocks__desc"><?php echo esc_html( $settings['front_desc'] ?? '' ); ?></p>
			</div>
			<?php
		} elseif ( 'layout-6' === $layout ) {
			$front_icon_class = empty( $settings['front_icon']['value'] ) ? 'orivo-flip-blocks__icon no-icon' : 'orivo-flip-blocks__icon';
			$back_icon_class = empty( $back_icon['value'] ) ? 'orivo-flip-blocks__icon no-icon' : 'orivo-flip-blocks__icon';
			?>
			<div class="orivo-flip-blocks__top"></div>
			<div class="orivo-flip-blocks__bottom"></div>

			<div class="orivo-flip-blocks__back orivo-flip-blocks__content">
				<div class="<?php echo esc_attr( $back_icon_class ); ?>">
					<?php if ( ! empty( $back_icon['value'] ) ) { Icons_Manager::render_icon( $back_icon, [ 'aria-hidden' => 'true' ] ); } ?>
				</div>
				<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $settings['back_title'] ?? '' ); ?></h3>
				<p class="orivo-flip-blocks__desc"><?php echo esc_html( $settings['back_desc'] ?? '' ); ?></p>
			</div>

			<div class="orivo-flip-blocks__front orivo-flip-blocks__content">
				<div class="<?php echo esc_attr( $front_icon_class ); ?>">
					<?php if ( ! empty( $settings['front_icon']['value'] ) ) { Icons_Manager::render_icon( $settings['front_icon'], [ 'aria-hidden' => 'true' ] ); } ?>
				</div>
				<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $settings['front_title'] ?? '' ); ?></h3>
				<p class="orivo-flip-blocks__desc"><?php echo esc_html( $settings['front_desc'] ?? '' ); ?></p>
			</div>
			<?php
		} else {
			$front_icon_class = empty( $settings['front_icon']['value'] ) ? 'orivo-flip-blocks__icon no-icon' : 'orivo-flip-blocks__icon';
			$back_icon_class = empty( $back_icon['value'] ) ? 'orivo-flip-blocks__icon no-icon' : 'orivo-flip-blocks__icon';
			?>
			<div class="orivo-flip-blocks__inner">
				<div class="orivo-flip-blocks__front">
					<div class="orivo-flip-blocks__content">
						<div class="<?php echo esc_attr( $front_icon_class ); ?>">
							<?php if ( ! empty( $settings['front_icon']['value'] ) ) { Icons_Manager::render_icon( $settings['front_icon'], [ 'aria-hidden' => 'true' ] ); } ?>
						</div>
						<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $settings['front_title'] ?? '' ); ?></h3>
						<p class="orivo-flip-blocks__desc"><?php echo esc_html( $settings['front_desc'] ?? '' ); ?></p>
					</div>
				</div>

				<div class="orivo-flip-blocks__back">
					<div class="orivo-flip-blocks__content">
						<div class="<?php echo esc_attr( $back_icon_class ); ?>">
							<?php if ( ! empty( $back_icon['value'] ) ) { Icons_Manager::render_icon( $back_icon, [ 'aria-hidden' => 'true' ] ); } ?>
						</div>
						<h3 class="orivo-flip-blocks__title"><?php echo esc_html( $settings['back_title'] ?? '' ); ?></h3>
						<p class="orivo-flip-blocks__desc"><?php echo esc_html( $settings['back_desc'] ?? '' ); ?></p>
					</div>
				</div>
			</div>
			<?php
		}

		echo $close_tag;

		echo '</div></div>';
	}
}
