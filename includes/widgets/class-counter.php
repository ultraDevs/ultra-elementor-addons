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
				'label' => __( 'Counter', 'ultra-elementor-addons' ),
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

		$this->add_responsive_control(
			'columns',
			[
				'label'   => __( 'Columns', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-counter-blocks' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));',
				],
			]
		);

		$this->add_control(
			'heading_separator',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'counter_icon',
			[
				'label' => __( 'Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-trophy',
					'library' => 'fa-solid',
				],
				'condition' => [
					'counter_layout!' => 'layout-2',
				],
			]
		);

		$repeater->add_control(
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

		$repeater->add_control(
			'counter_prefix',
			[
				'label'       => __( 'Prefix', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => __( 'Text before number (e.g., $, +, #)', 'ultra-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'counter_suffix',
			[
				'label'       => __( 'Suffix', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => __( 'Text after number (e.g., %, +, k)', 'ultra-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'counter_title',
			[
				'label'       => __( 'Title', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Projects Completed', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
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
					'counter_layout!' => 'layout-1',
				],
			]
		);

		$repeater->add_control(
			'counter_link',
			[
				'label'         => __( 'Link', 'ultra-elementor-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => 'https://example.com',
				'show_external' => true,
			]
		);

		$this->add_control(
			'counters',
			[
				'label'       => __( 'Counters', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'counter_icon'    => [
							'value'   => 'fas fa-trophy',
							'library' => 'fa-solid',
						],
						'counter_number'  => 1250,
						'counter_title'   => __( 'Projects Completed', 'ultra-elementor-addons' ),
					],
					[
						'counter_icon'    => [
							'value'   => 'fas fa-users',
							'library' => 'fa-solid',
						],
						'counter_number'  => 890,
						'counter_title'   => __( 'Happy Clients', 'ultra-elementor-addons' ),
					],
					[
						'counter_icon'    => [
							'value'   => 'fas fa-heart',
							'library' => 'fa-solid',
						],
						'counter_number'  => 3200,
						'counter_title'   => __( 'Likes Received', 'ultra-elementor-addons' ),
					],
				],
				'title_field' => '{{{ counter_title }}}',
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

		$this->add_responsive_control(
			'container_gap',
			[
				'label'      => __( 'Gap', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 30 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => __( 'Item Padding', 'ultra-elementor-addons' ),
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

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'item_background',
				'label'    => __( 'Item Background', 'ultra-elementor-addons' ),
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

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .orivo-counter-blocks__item',
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
				'selectors' => [
					'{{WRAPPER}} .orivo-counter-blocks__item' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Icon
		 * ======================= */
		$this->start_controls_section(
			'section_style_icon',
			[
				'label'     => __( 'Icon', 'ultra-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#6366F1',
				'selectors' => [
					'{{WRAPPER}} .orivo-counter-blocks__icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-counter-blocks__icon svg' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 10, 'max' => 100 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 48 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'      => __( 'Icon Spacing', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 15 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

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

		$this->add_responsive_control(
			'number_spacing',
			[
				'label'      => __( 'Number Spacing', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 10 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

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

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Title Spacing', 'ultra-elementor-addons' ),
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

		$this->add_responsive_control(
			'progress_size',
			[
				'label'      => __( 'Progress Size (Layout 2)', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 80, 'max' => 200 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 120 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks__progress svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => 'layout-2',
				],
			]
		);

		$this->add_responsive_control(
			'progress_height',
			[
				'label'      => __( 'Progress Bar Height (Layout 3)', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 2, 'max' => 20 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 14 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-counter-blocks--layout-3 .orivo-counter-blocks__progress' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => 'layout-3',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$layout = ! empty( $settings['layout'] ) ? $settings['layout'] : 'layout-1';
		$counters = ! empty( $settings['counters'] ) ? $settings['counters'] : [];

		$container_classes = [
			'orivo-counter-blocks',
			'orivo-counter-blocks--' . $layout,
		];

		echo '<div class="' . esc_attr( implode( ' ', $container_classes ) ) . '">';

		if ( empty( $counters ) ) {
			echo '</div>';
			return;
		}

		foreach ( $counters as $index => $counter ) {
			$item_classes = [ 'orivo-counter-blocks__item' ];
			$item_classes[] = 'elementor-repeater-item-' . ( $counter['_id'] ?? $index );

			echo '<div class="' . esc_attr( implode( ' ', $item_classes ) ) . '">';

			// Link wrapper
			if ( ! empty( $counter['counter_link']['url'] ) ) {
				$link_key = 'counter_link_' . $index;
				$this->add_link_attributes( $link_key, $counter['counter_link'] );
				echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
			}

			// Layout 1: Icon + Number + Title
			if ( 'layout-1' === $layout ) {
				// Icon
				if ( ! empty( $counter['counter_icon']['value'] ) ) {
					echo '<div class="orivo-counter-blocks__icon">';
					Icons_Manager::render_icon( $counter['counter_icon'], [ 'aria-hidden' => 'true' ] );
					echo '</div>';
				}

				// Number
				$prefix = ! empty( $counter['counter_prefix'] ) ? '<span class="orivo-counter-blocks__prefix">' . esc_html( $counter['counter_prefix'] ) . '</span>' : '';
				$suffix = ! empty( $counter['counter_suffix'] ) ? '<span class="orivo-counter-blocks__suffix">' . esc_html( $counter['counter_suffix'] ) . '</span>' : '';
				$number = ! empty( $counter['counter_number'] ) ? $counter['counter_number'] : 0;

				echo '<div class="orivo-counter-blocks__number" data-target="' . esc_attr( $number ) . '">';
				echo $prefix . '<span class="orivo-counter-blocks__count">0</span>' . $suffix;
				echo '</div>';

				// Title
				if ( ! empty( $counter['counter_title'] ) ) {
					echo '<div class="orivo-counter-blocks__title">' . esc_html( $counter['counter_title'] ) . '</div>';
				}
			}

			// Layout 2: Circular Progress
			elseif ( 'layout-2' === $layout ) {
				$percent = isset( $counter['counter_percent']['size'] ) ? $counter['counter_percent']['size'] : 85;
				$number = ! empty( $counter['counter_number'] ) ? $counter['counter_number'] : 0;

				echo '<div class="orivo-counter-blocks__progress" data-percent="' . esc_attr( $percent ) . '">';
				echo '<svg viewBox="0 0 160 160">';
				echo '<circle class="orivo-counter-blocks__circle-bg" cx="80" cy="80" r="70"></circle>';
				echo '<circle class="orivo-counter-blocks__circle-progress" cx="80" cy="80" r="70"></circle>';
				echo '</svg>';
				echo '<span class="orivo-counter-blocks__progress-number">';
				echo '<span class="orivo-counter-blocks__count">0</span>';
				if ( ! empty( $counter['counter_suffix'] ) ) {
					echo '<span class="orivo-counter-blocks__suffix">' . esc_html( $counter['counter_suffix'] ) . '</span>';
				}
				echo '</span>';
				echo '</div>';

				if ( ! empty( $counter['counter_title'] ) ) {
					echo '<div class="orivo-counter-blocks__title">' . esc_html( $counter['counter_title'] ) . '</div>';
				}
			}

			// Layout 3: Number + Bar Progress
			elseif ( 'layout-3' === $layout ) {
				$number = ! empty( $counter['counter_number'] ) ? $counter['counter_number'] : 0;
				$percent = isset( $counter['counter_percent']['size'] ) ? $counter['counter_percent']['size'] : 85;

				// Number
				$prefix = ! empty( $counter['counter_prefix'] ) ? '<span class="orivo-counter-blocks__prefix">' . esc_html( $counter['counter_prefix'] ) . '</span>' : '';
				$suffix = ! empty( $counter['counter_suffix'] ) ? '<span class="orivo-counter-blocks__suffix">' . esc_html( $counter['counter_suffix'] ) . '</span>' : '';

				echo '<div class="orivo-counter-blocks__number" data-target="' . esc_attr( $number ) . '">';
				echo $prefix . '<span class="orivo-counter-blocks__count">0</span>' . $suffix;
				echo '</div>';

				// Progress Bar (no extra wrapper)
				echo '<div class="orivo-counter-blocks__progress" data-percent="' . esc_attr( $percent ) . '">';
				echo '<div class="orivo-counter-blocks__progress-bar"></div>';
				echo '</div>';

				// Title
				if ( ! empty( $counter['counter_title'] ) ) {
					echo '<div class="orivo-counter-blocks__title">' . esc_html( $counter['counter_title'] ) . '</div>';
				}
			}

			if ( ! empty( $counter['counter_link']['url'] ) ) {
				echo '</a>';
			}

			echo '</div>';
		}

		echo '</div>';
	}
}
