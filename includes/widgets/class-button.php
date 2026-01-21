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



		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		/* ========================
		 * Style Tabs
		 * ======================== */
		$this->start_controls_tabs( 'button_style_tabs' );

		/* Normal Tab */
		$this->start_controls_tab(
			'button_tab_normal',
			[
				'label' => __( 'Normal', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => __( 'Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'active' => true,
				],
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
				'global'    => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks--solid' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks--pill' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks--rounded' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color_heading',
			[
				'label'     => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
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
				'default'   => 'currentcolor',
				'global'    => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks__icon svg' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks__icon i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'icon_type!' => 'none',
				],
			]
		);

		// --- Typography ---
		$this->add_control(
			'button_typography_heading',
			[
				'label'     => __( 'Typography', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .orivo-btn-blocks',
			]
		);

		$this->end_controls_tab();

		/* Hover Tab */
		$this->start_controls_tab(
			'button_tab_hover',
			[
				'label' => __( 'Hover', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => __( 'Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'active' => true,
				],
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
				'label'     => __( 'Outline Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks--outline:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks--icon--outline:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_color_heading',
			[
				'label' => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'icon_type!' => 'none',
				],
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label'     => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'currentcolor',
				'global'    => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks:hover .orivo-btn-blocks__icon svg' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
					'{{WRAPPER}} .orivo-btn-blocks:hover .orivo-btn-blocks__icon i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'icon_type!' => 'none',
				],
			]
		);

		$this->end_controls_tab();

		/* Layout Options Tab */
		$this->start_controls_tab(
			'button_tab_layout',
			[
				'label' => __( 'Layout', 'ultra-elementor-addons' ),
			]
		);

		// --- Padding ---
		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// --- Layout Options ---
		$this->add_control(
			'ua_layout_tab',
			[
				'label'        => __( 'Layout Options', 'ultra-elementor-addons' ),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'alignment',
				'toggle'       => false,
				'label_block'  => true,
				'selectors'    => [
					'{{WRAPPER}}' => 'display:flex; justify-content:center;',
				],
				'options'      => [
					'alignment'     => [
						'title' => __( 'Alignment', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'icon_size'     => [
						'title' => __( 'Icon Size', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-image-bold',
					],
					'icon_spacing'  => [
						'title' => __( 'Icon Spacing', 'ultra-elementor-addons' ),
						'icon'  => 'eicon-h-align-stretch',
					],
				],
			]
		);

		/* --- TAB 1: Alignment --- */
		$this->add_responsive_control(
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
					'{{WRAPPER}}' => 'justify-content:{{VALUE}};',
				],
				'condition' => [
					'ua_layout_tab' => 'alignment',
				],
			]
		);

		/* --- TAB 2: Icon Size --- */
		$this->add_responsive_control(
			'ua_icon_size',
			[
				'label'      => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 8,
						'max' => 48,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-btn-blocks__icon' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}; display:inline-flex;',
					'{{WRAPPER}} .orivo-btn-blocks__icon svg' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .orivo-btn-blocks__icon i' => 'font-size:{{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'ua_layout_tab' => 'icon_size',
				],
			]
		);

		/* --- TAB 3: Icon Spacing --- */
		$this->add_responsive_control(
			'ua_icon_spacing',
			[
				'label'      => __( 'Icon Spacing', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 32,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-btn-blocks' => 'gap:{{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'ua_layout_tab' => 'icon_spacing',
				],
			]
		);

		// --- Border ---
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'selector' => '{{WRAPPER}} .orivo-btn-blocks',
			]
		);

		// --- Border Radius ---
		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'      => '5',
					'right'    => '5',
					'bottom'   => '5',
					'left'     => '5',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-btn-blocks' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		// --- Box Shadow ---
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .orivo-btn-blocks',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$button_classes = [ 'orivo-btn-blocks' ];
		$button_classes[] = 'orivo-btn-blocks--' . $settings['button_style'];

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
