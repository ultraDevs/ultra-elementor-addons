<?php

namespace UltraElementorAddons\Widgets;

use Elementor\Repeater;
use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

defined( 'ABSPATH' ) || die();

class Button extends Widgets_Base {

	public function get_name() {
		return 'ua_button';
	}

	public function get_title() {
		return __( 'Button', 'ultra-elementor-addons' );
	}

	public function get_icon() {
		return 'ua-icon eicon-button';
	}

	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	public function get_keywords() {
		return [ 'button', 'call to action', 'cta' ];
	}

	public function get_script_depends() {
		return [ 'ua-script-button' ];
	}

	public function get_style_depends() {
		return [ 'ua-style-button' ];
	}

	protected function ua_register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Button', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => __( 'Button Text', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Click Me', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_link',
			[
				'label'       => __( 'Link', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
			]
		);

			$this->add_control(
			'button_style',
			[
				'label'   => __( 'Style', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid'   => __( 'Solid', 'ultra-elementor-addons' ),
					'outline' => __( 'Outline', 'ultra-elementor-addons' ),
					'pill'    => __( 'Pill', 'ultra-elementor-addons' ),
					'rounded' => __( 'Rounded', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label'   => __( 'Size', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'medium',
				'options' => [
					'small'  => __( 'Small', 'ultra-elementor-addons' ),
					'medium' => __( 'Medium', 'ultra-elementor-addons' ),
					'large'  => __( 'Large', 'ultra-elementor-addons' ),
					'xl'     => __( 'Extra Large', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'button_text_transform',
			[
				'label'   => __( 'Text Transform', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'       => __( 'None', 'ultra-elementor-addons' ),
					'uppercase' => __( 'Uppercase', 'ultra-elementor-addons' ),
					'lowercase' => __( 'Lowercase', 'ultra-elementor-addons' ),
					'capitalize' => __( 'Capitalize', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'button_alignment',
			[
				'label'   => __( 'Alignment', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
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
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_display',
			[
				'label'   => __( 'Display', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'inline-flex',
				'options' => [
					'inline-flex' => __( 'Inline', 'ultra-elementor-addons' ),
					'flex'        => __( 'Block', 'ultra-elementor-addons' ),
					'block'       => __( 'Block (full width)', 'ultra-elementor-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks' => 'display: {{VALUE}}; {{WRAPPER}} .orivo-btn-blocks.block {width: 100%;}',
				],
			]
		);

		$this->add_control(
			'button_position',
			[
				'label' => __( 'Position', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'static',
				'options' => [
					'static' => __( 'Static', 'ultra-elementor-addons' ),
					'relative' => __( 'Relative', 'ultra-elementor-addons' ),
					'absolute' => __( 'Absolute', 'ultra-elementor-addons' ),
					'fixed' => __( 'Fixed', 'ultra-elementor-addons' ),
					'sticky' => __( 'Sticky', 'ultra-elementor-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks' => 'position: {{VALUE}};',
				],
				'condition' => [
					'button_position!' => 'static',
				],
			]
		);

		$this->add_control(
			'button_position_offset',
			[
				'label' => __( 'Position Offset', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_position!' => 'static',
				],
			]
		);

		$this->add_control(
			'button_width',
			[
				'label' => __( 'Width', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 50,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks.flex, {{WRAPPER}} .orivo-btn-blocks.block' => 'width: {{SIZE}}{{UNIT}}; min-width: auto;',
				],
				'condition' => [
					'button_display!' => 'inline-flex',
				],
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'   => __( 'Icon Type', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon-left',
				'options' => [
					'none'       => __( 'No Icon', 'ultra-elementor-addons' ),
					'icon-left'  => __( 'Icon Left', 'ultra-elementor-addons' ),
					'icon-right' => __( 'Icon Right', 'ultra-elementor-addons' ),
					'icon-only'  => __( 'Icon Only', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'   => __( 'Icon', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'condition' => [
					'icon_type!' => 'none',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label'       => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 8,
						'max' => 48,
					],
				],
				'default'     => [
					'unit' => 'px',
					'size' => 20,
				],
				'condition' => [
					'icon_type!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_spacing',
			[
				'label'       => __( 'Icon Spacing', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 32,
					],
				],
				'default'     => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label'       => __( 'Border Width', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default'     => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks--outline' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => __( 'Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label'     => __( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks--solid' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks--pill' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks--rounded' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => __( 'Hover Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks:hover' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'     => __( 'Hover Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks--solid:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks--pill:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks--rounded:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks--icon--solid:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks--icon--pill:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks--icon--rounded:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_outline_bg_color',
			[
				'label'     => __( 'Hover Outline BG Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks--outline:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks--icon--outline:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color_heading',
			[
				'label' => __( 'Icon Colors', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'icon_type!' => 'none',
				],
			]
		);

			$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks__icon svg' => 'stroke: {{VALUE}} !important; fill: none !important;',
					'{{WRAPPER}} .orivo-btn-blocks__icon i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .orivo-btn-blocks__icon img' => '',
				],
				'condition' => [
					'icon_type!' => 'none',
				],
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label'     => __( 'Icon Hover Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks:hover .orivo-btn-blocks__icon svg' => 'stroke: {{VALUE}} !important; fill: none !important;',
					'{{WRAPPER}} .orivo-btn-blocks:hover .orivo-btn-blocks__icon i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .orivo-btn-blocks:hover .orivo-btn-blocks__icon img' => '',
				],
				'condition' => [
					'icon_type!' => 'none',
				],
			]
		);

			$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .orivo-btn-blocks',
			]
		);

		$this->add_control(
			'button_size_styles',
			[
				'label' => __( 'Size Styles', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_size!' => '',
				],
			]
		);

		$this->add_control(
			'button_icon_size_styles',
			[
				'label' => __( 'Icon Size Variants', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'icon_type!' => 'none',
				],
			]
		);

		$this->add_control(
			'icon_size_small',
			[
				'label' => __( 'Small Icon Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 8,
						'max' => 24,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks--small .orivo-btn-blocks__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type!' => 'none',
					'button_size' => 'small',
				],
			]
		);

		$this->add_control(
			'icon_size_large',
			[
				'label' => __( 'Large Icon Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 16,
						'max' => 64,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks--large .orivo-btn-blocks__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type!' => 'none',
					'button_size' => 'large',
				],
			]
		);

		$this->add_control(
			'icon_size_xl',
			[
				'label' => __( 'Extra Large Icon Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 24,
						'max' => 80,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 32,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks--xl .orivo-btn-blocks__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type!' => 'none',
					'button_size' => 'xl',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$button_classes = [ 'orivo-btn-blocks' ];
		$button_classes[] = 'orivo-btn-blocks--' . $settings['button_style'];

		if ( ! empty( $settings['button_size'] ) ) {
			$button_classes[] = 'orivo-btn-blocks--' . $settings['button_size'];
		}

		if ( 'icon-right' === $settings['icon_type'] ) {
			$button_classes[] = 'orivo-btn-blocks--icon-right';
		}

		if ( 'icon-only' === $settings['icon_type'] ) {
			$button_classes[] = 'orivo-btn-blocks--icon';
		}

		if ( 'none' === $settings['icon_type'] ) {
			$button_classes[] = 'orivo-btn-blocks--text-only';
		}

		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_link_attributes( 'button_link', $settings['button_link'] );
			echo '<a class="' . esc_attr( implode( ' ', $button_classes ) ) . '" ' . $this->get_render_attribute_string( 'button_link' ) . '>';
		} else {
			echo '<span class="' . esc_attr( implode( ' ', $button_classes ) ) . '">';
		}

		if ( 'none' !== $settings['icon_type'] && ! empty( $settings['button_icon']['value'] ) ) {
			echo '<span class="orivo-btn-blocks__icon">';
			\Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
			echo '</span>';
		}

		if ( 'icon-only' !== $settings['icon_type'] ) {
			echo '<span class="orivo-btn-blocks__text">' . esc_html( $settings['button_text'] ) . '</span>';
		}

		if ( ! empty( $settings['button_link']['url'] ) ) {
			echo '</a>';
		} else {
			echo '</span>';
		}
	}
}
