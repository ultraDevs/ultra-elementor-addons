<?php

namespace UltraElementorAddons\Widgets;

use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

defined( 'ABSPATH' ) || die();

class Info_Box extends Widgets_Base {

	public function get_name() {
		return 'ua_info_boxes';
	}

	public function get_title() {
		return __( 'Info Box', 'ultra-elementor-addons' );
	}

	public function get_icon() {
		return 'ua-icon eicon-info-box';
	}

	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	public function get_keywords() {
		return [ 'info', 'box', 'cards', 'preset' ];
	}

	protected function ua_register_controls() {

		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'preset',
			[
				'label'   => __( 'Preset Layout', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout1',
				'options' => [
					'layout1'  => __( 'Info Boxes 1', 'ultra-elementor-addons' ),
					'layout2'  => __( 'Info Boxes 2', 'ultra-elementor-addons' ),
					'layout3'  => __( 'Info Boxes 3', 'ultra-elementor-addons' ),
					'layout4'  => __( 'Info Boxes 4', 'ultra-elementor-addons' ),
					'layout5'  => __( 'Info Boxes 5', 'ultra-elementor-addons' ),
					'layout6'  => __( 'Info Boxes 6', 'ultra-elementor-addons' ),
					'layout7'  => __( 'Info Boxes 7', 'ultra-elementor-addons' ),
					'layout8'  => __( 'Info Boxes 8', 'ultra-elementor-addons' ),
					'layout9'  => __( 'Info Boxes 9', 'ultra-elementor-addons' ),
					'layout10' => __( 'Info Boxes 10', 'ultra-elementor-addons' ),
					'last'     => __( 'Info Boxes Last', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'box_style',
			[
				'label'   => __( 'Box Style', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __( 'Style 1', 'ultra-elementor-addons' ),
					'2' => __( 'Style 2', 'ultra-elementor-addons' ),
					'3' => __( 'Style 3', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'   => __( 'Icon', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __( 'Image (Optional)', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'condition' => [
					'selected_icon[value]' => '',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Easy DropBox Integration', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => __( 'Description', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Easy DropBox Integration - Browse, Upload, and Manage Your Dropbox Files from Your WordPress Website.', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'tag',
			[
				'label'   => __( 'Tag', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'New Plugin', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'   => __( 'Button Text', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'More Details', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_url',
			[
				'label'   => __( 'Button URL', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::URL,
				'default' => [
					'url' => '#',
				],
			]
		);

		// Optional images for specific layouts
		$this->add_control(
			'bottom_image',
			[
				'label'   => __( 'Bottom Image (Layout 3)', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'top_image',
			[
				'label'   => __( 'Top Image (Layout 6)', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'btm_left_image',
			[
				'label'   => __( 'Bottom Left Image (Layout 6)', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::MEDIA,
			]
		);

		$this->end_controls_section();

		// Style Section - Box Container
		$this->start_controls_section(
			'section_style_box',
			[
				'label' => __( 'Box Style', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-blocks-info-box',
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow',
				'label' => __( 'Box Shadow', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-blocks-info-box',
			]
		);

		$this->add_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();

		// Style Section - Icon
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Icon Element Style
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .orivo-blocks-info-box__img svg' => 'fill: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img i' => 'font-size: {{SIZE}}{{UNIT}} !important; width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .orivo-blocks-info-box__img svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .orivo-blocks-info-box__img img' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Icon Background', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img i, {{WRAPPER}} .orivo-blocks-info-box__img svg, {{WRAPPER}} .orivo-blocks-info-box__img img' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Icon Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img i, {{WRAPPER}} .orivo-blocks-info-box__img svg, {{WRAPPER}} .orivo-blocks-info-box__img img' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' => __( 'Icon Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
					'em' => [
						'min' => 0,
						'max' => 3,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img i, {{WRAPPER}} .orivo-blocks-info-box__img svg, {{WRAPPER}} .orivo-blocks-info-box__img img' => 'padding: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => __( 'Icon Border', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-blocks-info-box__img',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'label' => __( 'Icon Box Shadow', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-blocks-info-box__img',
			]
		);

		// Icon Container Style
		$this->add_control(
			'icon_container_width',
			[
				'label' => __( 'Container Width', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'auto' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 500,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'width: {{SIZE}}{{UNIT}} !important; flex: 0 0 auto !important;',
				],
			]
		);

		$this->add_control(
			'icon_container_height',
			[
				'label' => __( 'Container Height', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'auto' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_display',
			[
				'label' => __( 'Display Mode', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'ultra-elementor-addons' ),
					'inline-block' => __( 'Inline Block', 'ultra-elementor-addons' ),
					'block' => __( 'Block', 'ultra-elementor-addons' ),
					'flex' => __( 'Flex', 'ultra-elementor-addons' ),
					'inline-flex' => __( 'Inline Flex', 'ultra-elementor-addons' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'display: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_align_content',
			[
				'label' => __( 'Content Alignment', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Left', 'ultra-elementor-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ultra-elementor-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'ultra-elementor-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'justify-content: {{VALUE}} !important; align-items: {{VALUE}} !important;',
				],
				'condition' => [
					'icon_display' => [ 'flex', 'inline-flex' ],
				],
			]
		);

		$this->add_control(
			'icon_margin',
			[
				'label' => __( 'Margin', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_position_mode',
			[
				'label' => __( 'Position Mode', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'ultra-elementor-addons' ),
					'relative' => __( 'Relative', 'ultra-elementor-addons' ),
					'absolute' => __( 'Absolute', 'ultra-elementor-addons' ),
					'fixed' => __( 'Fixed', 'ultra-elementor-addons' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'position: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_z_index',
			[
				'label' => __( 'Z-Index', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'min' => -999,
				'max' => 9999,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'z-index: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_transform',
			[
				'label' => __( 'Icon Rotation', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'transform: rotate({{SIZE}}deg) !important;',
				],
			]
		);

		// Icon Before/After Pseudo Elements
		$this->add_control(
			'icon_before_after_heading',
			[
				'label' => __( 'Icon Shapes (Before/After)', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_before_content',
			[
				'label' => __( 'Before Content', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter text or symbol', 'ultra-elementor-addons' ),
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'content: "{{VALUE}}" !important;',
				],
			]
		);

		$this->add_control(
			'icon_after_content',
			[
				'label' => __( 'After Content', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter text or symbol', 'ultra-elementor-addons' ),
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'content: "{{VALUE}}" !important;',
				],
			]
		);

		$this->add_control(
			'icon_before_size',
			[
				'label' => __( 'Before Element Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_after_size',
			[
				'label' => __( 'After Element Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_before_bg',
			[
				'label' => __( 'Before Background', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_after_bg',
			[
				'label' => __( 'After Background', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_before_position',
			[
				'label' => __( 'Before Position', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'ultra-elementor-addons' ),
					'absolute' => __( 'Absolute', 'ultra-elementor-addons' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'position: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_after_position',
			[
				'label' => __( 'After Position', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'ultra-elementor-addons' ),
					'absolute' => __( 'Absolute', 'ultra-elementor-addons' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'position: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_before_location',
			[
				'label' => __( 'Before Location', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'ultra-elementor-addons' ),
					'top-left' => __( 'Top Left', 'ultra-elementor-addons' ),
					'top-right' => __( 'Top Right', 'ultra-elementor-addons' ),
					'bottom-left' => __( 'Bottom Left', 'ultra-elementor-addons' ),
					'bottom-right' => __( 'Bottom Right', 'ultra-elementor-addons' ),
					'top-center' => __( 'Top Center', 'ultra-elementor-addons' ),
					'bottom-center' => __( 'Bottom Center', 'ultra-elementor-addons' ),
				],
				'default' => '',
				'selectors' => [
					'top-left' => [
						'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'top: 0 !important; left: 0 !important;',
					],
					'top-right' => [
						'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'top: 0 !important; right: 0 !important;',
					],
					'bottom-left' => [
						'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'bottom: 0 !important; left: 0 !important;',
					],
					'bottom-right' => [
						'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'bottom: 0 !important; right: 0 !important;',
					],
					'top-center' => [
						'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'top: 0 !important; left: 50% !important; transform: translateX(-50%) !important;',
					],
					'bottom-center' => [
						'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'bottom: 0 !important; left: 50% !important; transform: translateX(-50%) !important;',
					],
				],
			]
		);

		$this->add_control(
			'icon_after_location',
			[
				'label' => __( 'After Location', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'ultra-elementor-addons' ),
					'top-left' => __( 'Top Left', 'ultra-elementor-addons' ),
					'top-right' => __( 'Top Right', 'ultra-elementor-addons' ),
					'bottom-left' => __( 'Bottom Left', 'ultra-elementor-addons' ),
					'bottom-right' => __( 'Bottom Right', 'ultra-elementor-addons' ),
					'top-center' => __( 'Top Center', 'ultra-elementor-addons' ),
					'bottom-center' => __( 'Bottom Center', 'ultra-elementor-addons' ),
				],
				'default' => '',
				'selectors' => [
					'top-left' => [
						'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'top: 0 !important; left: 0 !important;',
					],
					'top-right' => [
						'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'top: 0 !important; right: 0 !important;',
					],
					'bottom-left' => [
						'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'bottom: 0 !important; left: 0 !important;',
					],
					'bottom-right' => [
						'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'bottom: 0 !important; right: 0 !important;',
					],
					'top-center' => [
						'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'top: 0 !important; left: 50% !important; transform: translateX(-50%) !important;',
					],
					'bottom-center' => [
						'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'bottom: 0 !important; left: 50% !important; transform: translateX(-50%) !important;',
					],
				],
			]
		);

		$this->add_control(
			'icon_before_border_radius',
			[
				'label' => __( 'Before Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_after_border_radius',
			[
				'label' => __( 'After Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_before_z_index',
			[
				'label' => __( 'Before Z-Index', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'min' => -99,
				'max' => 99,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'z-index: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_after_z_index',
			[
				'label' => __( 'After Z-Index', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'min' => -99,
				'max' => 99,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'z-index: {{VALUE}} !important;',
				],
			]
		);

		// Icon Position Sliders
		$this->add_control(
			'icon_position_sliders_heading',
			[
				'label' => __( 'Icon Position (Sliders)', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_pos_top',
			[
				'label' => __( 'Icon Top', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'top: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_pos_right',
			[
				'label' => __( 'Icon Right', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'right: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_pos_bottom',
			[
				'label' => __( 'Icon Bottom', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_pos_left',
			[
				'label' => __( 'Icon Left', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'left: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		// Before/After Position Sliders
		$this->add_control(
			'icon_before_pos_sliders_heading',
			[
				'label' => __( 'Before Position (Sliders)', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_before_pos_top',
			[
				'label' => __( 'Before Top', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'top: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_before_pos_right',
			[
				'label' => __( 'Before Right', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'right: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_before_pos_bottom',
			[
				'label' => __( 'Before Bottom', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_before_pos_left',
			[
				'label' => __( 'Before Left', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::before' => 'left: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_after_pos_sliders_heading',
			[
				'label' => __( 'After Position (Sliders)', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_after_pos_top',
			[
				'label' => __( 'After Top', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'top: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_after_pos_right',
			[
				'label' => __( 'After Right', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'right: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_after_pos_bottom',
			[
				'label' => __( 'After Bottom', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_after_pos_left',
			[
				'label' => __( 'After Left', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img::after' => 'left: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		// Icon Transform
		$this->add_control(
			'icon_transform_heading',
			[
				'label' => __( 'Icon Transform', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_scale',
			[
				'label' => __( 'Icon Scale', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'transform: scale({{SIZE}}) !important;',
				],
			]
		);

		$this->add_control(
			'icon_rotate_custom',
			[
				'label' => __( 'Icon Rotate', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'transform: rotate({{SIZE}}deg) !important;',
				],
			]
		);

		$this->add_control(
			'icon_skew_x',
			[
				'label' => __( 'Icon Skew X', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -90,
						'max' => 90,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'transform: skewX({{SIZE}}deg) !important;',
				],
			]
		);

		$this->add_control(
			'icon_skew_y',
			[
				'label' => __( 'Icon Skew Y', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -90,
						'max' => 90,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'transform: skewY({{SIZE}}deg) !important;',
				],
			]
		);

		$this->add_control(
			'icon_translate_x',
			[
				'label' => __( 'Icon Translate X', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'transform: translateX({{SIZE}}{{UNIT}}) !important;',
				],
			]
		);

		$this->add_control(
			'icon_translate_y',
			[
				'label' => __( 'Icon Translate Y', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'transform: translateY({{SIZE}}{{UNIT}}) !important;',
				],
			]
		);

		$this->add_control(
			'icon_opacity',
			[
				'label' => __( 'Icon Opacity', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'opacity: {{SIZE}} !important;',
				],
			]
		);

		$this->end_controls_section();

		// Style Section - Layout & Positioning
		$this->start_controls_section(
			'section_style_layout',
			[
				'label' => __( 'Layout & Positioning', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_direction',
			[
				'label' => __( 'Box Direction', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'ultra-elementor-addons' ),
					'row' => __( 'Row - Icon Left', 'ultra-elementor-addons' ),
					'row-reverse' => __( 'Row Reverse - Icon Right', 'ultra-elementor-addons' ),
					'column' => __( 'Column - Icon Top', 'ultra-elementor-addons' ),
					'column-reverse' => __( 'Column Reverse - Icon Bottom', 'ultra-elementor-addons' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box' => 'flex-direction: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'box_alignment',
			[
				'label' => __( 'Box Alignment', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Start', 'ultra-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ultra-elementor-addons' ),
						'icon' => 'eicon-h-align-center',
					],
					'flex-end' => [
						'title' => __( 'End', 'ultra-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box' => 'align-items: {{VALUE}} !important; justify-content: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'box_text_align',
			[
				'label' => __( 'Text Align', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ultra-elementor-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ultra-elementor-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ultra-elementor-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box, {{WRAPPER}} .orivo-blocks-info-box__details' => 'text-align: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_order',
			[
				'label' => __( 'Icon Order', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'min' => -5,
				'max' => 5,
				'step' => 1,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'order: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'content_order',
			[
				'label' => __( 'Content Order', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'min' => -5,
				'max' => 5,
				'step' => 1,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__details' => 'order: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_self_align',
			[
				'label' => __( 'Icon Self Alignment', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'ultra-elementor-addons' ),
					'flex-start' => __( 'Start', 'ultra-elementor-addons' ),
					'center' => __( 'Center', 'ultra-elementor-addons' ),
					'flex-end' => __( 'End', 'ultra-elementor-addons' ),
					'stretch' => __( 'Stretch', 'ultra-elementor-addons' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'align-self: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'content_self_align',
			[
				'label' => __( 'Content Self Alignment', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'ultra-elementor-addons' ),
					'flex-start' => __( 'Start', 'ultra-elementor-addons' ),
					'center' => __( 'Center', 'ultra-elementor-addons' ),
					'flex-end' => __( 'End', 'ultra-elementor-addons' ),
					'stretch' => __( 'Stretch', 'ultra-elementor-addons' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__details' => 'align-self: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'gap_between',
			[
				'label' => __( 'Gap Between Elements', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box' => 'gap: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'content_spacing',
			[
				'label' => __( 'Content Spacing', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'elements_vertical_align',
			[
				'label' => __( 'Elements Vertical Align', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'ultra-elementor-addons' ),
					'top' => __( 'Top', 'ultra-elementor-addons' ),
					'middle' => __( 'Middle', 'ultra-elementor-addons' ),
					'bottom' => __( 'Bottom', 'ultra-elementor-addons' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__img, {{WRAPPER}} .orivo-blocks-info-box__details' => 'vertical-align: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();

		// Style Section - Title
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__details h2' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-blocks-info-box__details h2',
			]
		);

		$this->end_controls_section();

		// Style Section - Description
		$this->start_controls_section(
			'section_style_description',
			[
				'label' => __( 'Description', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__details p' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Description Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-blocks-info-box__details p',
			]
		);

		$this->end_controls_section();

		// Style Section - Tag
		$this->start_controls_section(
			'section_style_tag',
			[
				'label' => __( 'Tag', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tag_color',
			[
				'label' => __( 'Tag Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__details h3, {{WRAPPER}} .orivo-blocks-info-box__details h5, {{WRAPPER}} .orivo-blocks-info-box__details h6, {{WRAPPER}} .orivo-blocks-info-box__tag' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tag_typography',
				'label' => __( 'Tag Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-blocks-info-box__details h3, {{WRAPPER}} .orivo-blocks-info-box__details h5, {{WRAPPER}} .orivo-blocks-info-box__details h6, {{WRAPPER}} .orivo-blocks-info-box__tag',
			]
		);

		$this->add_control(
			'tag_bg_color',
			[
				'label' => __( 'Tag Background Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__details h3, {{WRAPPER}} .orivo-blocks-info-box__tag' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();

		// Style Section - Button
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Button', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Button Text Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => __( 'Button Background Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Button Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'button_padding',
			[
				'label' => __( 'Button Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'Button Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-blocks-info-box__btn a',
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => __( 'Button Hover Text Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => __( 'Button Hover Background', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();
	}

	private function icon_html() {
		$settings = $this->get_settings_for_display();
		// Check if icon is set
		if ( ! empty( $settings['selected_icon']['value'] ) ) {
			Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
			return;
		}

		// Fallback to image
		$img_url = ! empty( $settings['image']['url'] ) ? $settings['image']['url'] : '';
		if ( ! empty( $img_url ) ) {
			echo '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $settings['title'] ?? '' ) . '">';
		}
	}

	private function btn_html() {
		$settings = $this->get_settings_for_display();
		$url  = ! empty( $settings['button_url']['url'] ) ? $settings['button_url']['url'] : '#';
		$text = ! empty( $settings['button_text'] ) ? $settings['button_text'] : __( 'More Details', 'ultra-elementor-addons' );
		return '<div class="orivo-blocks-info-box__btn"><a href="' . esc_url( $url ) . '">' . esc_html( $text ) . '</a></div>';
	}

	protected function render() {
		$settings    = $this->get_settings_for_display();
		$preset      = ! empty( $settings['preset'] ) ? $settings['preset'] : 'layout1';
		$box_style   = ! empty( $settings['box_style'] ) ? $settings['box_style'] : '1';

		// Get box style classes based on layout and style selection
		$box_class = $this->get_box_class( $preset, $box_style );
		$extra_elements = $this->get_extra_elements( $preset, $box_style );

		// Container class
		$container_class = 'info-boxes--single'; ?>

		<div class="info-boxes <?php echo esc_attr( $container_class ); ?>">
			<div class="orivo-blocks-info-box <?php echo esc_attr( $box_class ); ?>">
				<?php $this->render_box_content( $preset, $box_style, $extra_elements ); ?>
			</div>
		</div>

	<?php }

	private function get_box_class( $preset, $box_style ) {
		$classes = [
			'layout1' => [ '1' => '', '2' => '', '3' => 'orivo-blocks-info-box--bg' ],
			'layout2' => [ '1' => 'orivo-blocks-info-box--one', '2' => 'orivo-blocks-info-box--two', '3' => 'orivo-blocks-info-box--three' ],
			'layout3' => [ '1' => '', '2' => '', '3' => '' ],
			'layout4' => [ '1' => 'orivo-blocks-info-box--four', '2' => 'orivo-blocks-info-box--five', '3' => 'orivo-blocks-info-box--six' ],
			'layout5' => [ '1' => 'orivo-blocks-info-box--seven', '2' => 'orivo-blocks-info-box--seven orivo-blocks-info-box--eight', '3' => 'orivo-blocks-info-box--nine' ],
			'layout6' => [ '1' => 'orivo-blocks-info-box--ten', '2' => 'orivo-blocks-info-box--ten orivo-blocks-info-box--eleven', '3' => 'orivo-blocks-info-box--ten' ],
			'layout7' => [ '1' => 'orivo-blocks-info-box__gradient-bg', '2' => 'orivo-blocks-info-box__gradient-bg', '3' => 'orivo-blocks-info-box__gradient-bg' ],
			'layout8' => [ '1' => 'orivo-blocks-info-box--half-bg', '2' => 'orivo-blocks-info-box--half-bg', '3' => 'orivo-blocks-info-box--half-bg' ],
			'layout9' => [ '1' => 'orivo-blocks-info-box--half-bg orivo-blocks-info-box__btm-bg', '2' => 'orivo-blocks-info-box--half-bg orivo-blocks-info-box__btm-bg', '3' => 'orivo-blocks-info-box--half-bg orivo-blocks-info-box__btm-bg' ],
			'layout10' => [ '1' => 'orivo-blocks-info-box--two orivo-blocks-info-box__smart', '2' => 'orivo-blocks-info-box--two orivo-blocks-info-box__smart', '3' => 'orivo-blocks-info-box--two orivo-blocks-info-box__smart' ],
			'last' => [ '1' => 'orivo-blocks-info-box__last txt-center', '2' => 'orivo-blocks-info-box__last txt-center', '3' => 'orivo-blocks-info-box__last txt-center' ],
		];

		return isset( $classes[ $preset ][ $box_style ] ) ? $classes[ $preset ][ $box_style ] : '';
	}

	private function get_default_images( $preset, $box_style ) {
		// Default image URLs - update these paths to match your plugin assets
		$base_url = ULTRA_ADDONS_URL . 'assets/images/';

		$images = [
			// Layout 3 - Bottom Image
			'layout3' => [
				'bottom_image' => $base_url . 'box7.png',
			],
			// Layout 6 - Top and Bottom Left Images
			'layout6' => [
				'top_image' => $base_url . 'Vector.svg',
				'btm_left_image' => $base_url . 'btm-lft-bg.svg',
			],
		];

		return isset( $images[ $preset ] ) ? $images[ $preset ] : [];
	}

	private function get_extra_elements( $preset, $box_style ) {
		$extra = [
			'has_border' => false,
			'has_gradient_wrapper' => false,
			'has_half_bg_wrapper' => false,
			'show_tag_outside' => false,
			'show_tag_first' => false,
			'triangle_class' => '',
			'img_bg_class' => '',
			'show_bottom_img' => false,
			'show_extra_images' => false,
		];

		// Layout 2 triangle classes
		if ( $preset === 'layout2' ) {
			$extra['triangle_class'] = [
				'1' => 'tri-right btm-left-in',
				'2' => '',
				'3' => 'tri-right btm-right',
			];
		}

		// Layout 3 img bg class
		if ( $preset === 'layout3' ) {
			$extra['img_bg_class'] = 'orivo-blocks-info-box__img--bg';
			$extra['show_bottom_img'] = true;
		}

		// Layout 5 has border for styles 1 & 2
		if ( $preset === 'layout5' ) {
			$extra['has_border'] = ( $box_style === '1' || $box_style === '2' );
			$extra['img_bg_class'] = ( $box_style === '1' || $box_style === '2' ) ? 'orivo-blocks-info-box__img--bg' : '';
			$extra['show_tag_outside'] = ( $box_style === '3' );
		}

		// Layout 6 extra images
		if ( $preset === 'layout6' ) {
			$extra['show_extra_images'] = ( $box_style === '1' || $box_style === '2' );
		}

		// Layout 7 gradient wrapper
		if ( $preset === 'layout7' ) {
			$extra['has_gradient_wrapper'] = true;
		}

		// Layout 8 & 9 half bg wrapper
		if ( $preset === 'layout8' || $preset === 'layout9' ) {
			$extra['has_half_bg_wrapper'] = true;
		}

		// Layout 10 & last tag first
		if ( $preset === 'layout10' || $preset === 'last' ) {
			$extra['show_tag_first'] = true;
		}

		return $extra;
	}

	private function render_box_content( $preset, $box_style, $extra ) {
		$settings = $this->get_settings_for_display();
		$triangle_class = isset( $extra['triangle_class'][ $box_style ] ) ? $extra['triangle_class'][ $box_style ] : '';

		// Get default images for this layout
		$default_images = $this->get_default_images( $preset, $box_style );

		// Start gradient wrapper if needed
		if ( $extra['has_gradient_wrapper'] ) {
			echo '<div class="orivo-blocks-info-box__white-bg txt-center">';
		}

		// Start half-bg wrapper if needed
		if ( $extra['has_half_bg_wrapper'] ) {
			$wrapper_class = ( $preset === 'layout9' ) ? 'orivo-blocks-info-box__round-bg-two' : 'orivo-blocks-info-box__round-bg';
			echo '<div class="' . esc_attr( $wrapper_class ) . '">';
		}

		// Start border wrapper if needed
		if ( $extra['has_border'] ) {
			echo '<div class="orivo-blocks-info-box__border">';
		}

		// Tag first (for layout10 & last)
		if ( $extra['show_tag_first'] ) {
			$tag_class = ( $preset === 'layout6' && $box_style === '2' ) ? 'orivo-blocks-info-box__tag--two' : '';
			$tag_element = ( $preset === 'layout10' ) ? 'h5' : 'h6';
			echo '<div class="orivo-blocks-info-box__tag ' . esc_attr( $tag_class ) . '">';
			echo '<' . $tag_element . '>' . esc_html( $settings['tag'] ) . '</' . $tag_element . '>';
			echo '</div>';
		}

		// Icon
		echo '<div class="orivo-blocks-info-box__img ' . esc_attr( $triangle_class . ' ' . $extra['img_bg_class'] ) . '">';
		$this->icon_html();
		echo '</div>';

		// Details
		echo '<div class="orivo-blocks-info-box__details">';

		if ( $extra['show_tag_first'] ) {
			echo '<h2>' . esc_html( $settings['title'] ) . '</h2>';
			echo '<p>' . esc_html( $settings['description'] ) . '</p>';
			echo $this->btn_html();
		} elseif ( $extra['show_tag_outside'] ) {
			echo '<h2>' . esc_html( $settings['title'] ) . '</h2>';
			echo '<p>' . esc_html( $settings['description'] ) . '</p>';
			echo $this->btn_html();
		} else {
			echo '<h2>' . esc_html( $settings['title'] ) . '</h2>';
			echo '<p>' . esc_html( $settings['description'] ) . '</p>';
			echo '<h3>' . esc_html( $settings['tag'] ) . '</h3>';
			echo $this->btn_html();
		}

		echo '</div>';

		// Tag outside (for layout5 style 3)
		if ( $extra['show_tag_outside'] ) {
			echo '<div class="orivo-blocks-info-box__tag">';
			echo '<h5>' . esc_html( $settings['tag'] ) . '</h5>';
			echo '</div>';
		}

		// End border wrapper
		if ( $extra['has_border'] ) {
			echo '</div>';
		}

		// Tag for layouts with tag (layout6, 8, 9)
		if ( ! $extra['show_tag_first'] && ! $extra['show_tag_outside'] && ( $preset === 'layout6' || $preset === 'layout8' || $preset === 'layout9' ) ) {
			$tag_class = ( $preset === 'layout6' && $box_style === '2' ) ? 'orivo-blocks-info-box__tag--two' : '';
			echo '<div class="orivo-blocks-info-box__tag ' . esc_attr( $tag_class ) . '">';
			$tag_element = ( $preset === 'layout6' || $preset === 'layout8' || $preset === 'layout9' ) ? 'h5' : 'h6';
			echo '<' . $tag_element . '>' . esc_html( $settings['tag'] ) . '</' . $tag_element . '>';
			echo '</div>';
		}

		// End half-bg wrapper
		if ( $extra['has_half_bg_wrapper'] ) {
			echo '</div>';
			echo '<div class="orivo-blocks-info-box__primary-bg"></div>';
		}

		// End gradient wrapper
		if ( $extra['has_gradient_wrapper'] ) {
			echo '</div>';
		}

		// Bottom image (layout3)
		if ( $extra['show_bottom_img'] ) {
			$img_url = ! empty( $settings['bottom_image']['url'] ) ? $settings['bottom_image']['url'] : '';
			// Use default image if user hasn't provided one
			if ( empty( $img_url ) && isset( $default_images['bottom_image'] ) ) {
				$img_url = $default_images['bottom_image'];
			}
			if ( $img_url ) {
				echo '<div class="orivo-blocks-info-box__btm-img">';
				echo '<img src="' . esc_url( $img_url ) . '" alt="">';
				echo '</div>';
			}
		}

		// Extra images (layout6)
		if ( $extra['show_extra_images'] ) {
			$top_img_url = ! empty( $settings['top_image']['url'] ) ? $settings['top_image']['url'] : '';
			$btm_left_img_url = ! empty( $settings['btm_left_image']['url'] ) ? $settings['btm_left_image']['url'] : '';

			// Use default images if user hasn't provided them
			if ( empty( $top_img_url ) && isset( $default_images['top_image'] ) ) {
				$top_img_url = $default_images['top_image'];
			}
			if ( empty( $btm_left_img_url ) && isset( $default_images['btm_left_image'] ) ) {
				$btm_left_img_url = $default_images['btm_left_image'];
			}

			if ( $top_img_url ) {
				echo '<div class="orivo-blocks-info-box__top-img">';
				echo '<img src="' . esc_url( $top_img_url ) . '" alt="">';
				echo '</div>';
			}

			if ( $btm_left_img_url ) {
				echo '<div class="orivo-blocks-info-box__btm-left-img">';
				echo '<img src="' . esc_url( $btm_left_img_url ) . '" alt="">';
				echo '</div>';
			}
		}
	}
}
