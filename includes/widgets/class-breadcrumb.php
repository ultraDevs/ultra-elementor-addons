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

class Breadcrumb extends Widgets_Base {

	public function get_name() {
		return 'ua_breadcrumb';
	}

	public function get_title() {
		return __( 'Breadcrumb', 'ultra-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-breadcrumbs';
	}

	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	public function get_keywords() {
		return [ 'breadcrumb', 'path', 'navigation', 'trail' ];
	}

	public function get_script_depends() {
		return [ 'ua-script-breadcrumb' ];
	}

	public function get_style_depends() {
		return [ 'ua-style-breadcrumb' ];
	}

	protected function ua_register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Breadcrumbs', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Layout', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Arrow', 'ultra-elementor-addons' ),
					'layout-2' => __( 'Slash', 'ultra-elementor-addons' ),
					'layout-3' => __( 'Connected Box', 'ultra-elementor-addons' ),
					'layout-4' => __( 'Dot', 'ultra-elementor-addons' ),
					'layout-5' => __( 'Modern', 'ultra-elementor-addons' ),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label'       => __( 'Text', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Home', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => __( 'Link', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://',
			]
		);

		$this->add_control(
			'breadcrumbs',
			[
				'label'       => __( 'Breadcrumb Items', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[ 'text' => 'Home' ],
					[ 'text' => 'Category' ],
					[ 'text' => 'Current Page' ],
				],
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_items',
			[
				'label' => __( 'Items', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_color',
			[
				'label'     => __( 'Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__item' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'active_color',
			[
				'label'     => __( 'Active Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__item--active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .orivo-breadcrumb-blocks',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$items    = $settings['breadcrumbs'];

		if ( empty( $items ) ) return;

		echo '<nav class="orivo-breadcrumb-blocks orivo-breadcrumb-blocks--' . esc_attr( $settings['layout'] ) . '" aria-label="Breadcrumb">';

		$last_index = count( $items ) - 1;

		foreach ( $items as $index => $item ) {
			$is_last = ( $index === $last_index );

			if ( ! $is_last && ! empty( $item['link']['url'] ) ) {
				$this->add_link_attributes( 'breadcrumb_link_' . $index, $item['link'] );
				echo '<a class="orivo-breadcrumb-blocks__item" ' . $this->get_render_attribute_string( 'breadcrumb_link_' . $index ) . '>';
				echo '<span>' . esc_html( $item['text'] ) . '</span></a>';
			} else {
				echo '<span class="orivo-breadcrumb-blocks__item orivo-breadcrumb-blocks__item--active">';
				echo '<span>' . esc_html( $item['text'] ) . '</span></span>';
			}

			if ( ! $is_last && 'layout-3' !== $settings['layout'] ) {
				echo '<span class="orivo-breadcrumb-blocks__separator"></span>';
			}
		}

		echo '</nav>';
	}
}
