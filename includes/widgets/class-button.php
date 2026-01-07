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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .orivo-btn-blocks',
			]
		);

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

		if ( 'none' !== $settings['icon_type'] && ! empty( $settings['button_icon'] ) ) {
			echo '<span class="orivo-btn-blocks__icon">';
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
			echo ob_get_clean();
			echo '</span>';
		}

		echo '<span class="orivo-btn-blocks__text">' . esc_html( $settings['button_text'] ) . '</span>';

		if ( ! empty( $settings['button_link']['url'] ) ) {
			echo '</a>';
		} else {
			echo '</span>';
		}
	}
}
