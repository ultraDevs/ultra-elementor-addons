<?php

namespace UltraElementorAddons\Widgets;

use Elementor\Repeater;
use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Breadcrumb extends Widgets_Base {

    public function get_name() {
        return 'ua_breadcrumb';
    }

    public function get_title() {
        return __( 'Breadcrumb', 'ultra-elementor-addons' );
    }

    public function get_icon() {
        return 'eicon-breadcrumb';
    }

    public function get_categories() {
        return [ 'ultra_addons_category' ];
    }

    public function get_keywords() {
        return [ 'breadcrumb', 'path', 'navigation', 'trail' ];
    }

    protected function ua_register_controls() {

		// ----------------- Content Section -----------------
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

		$this->add_control(
			'home_icon',
			[
				'label' => __( 'Home Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-home',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'home_text',
			[
				'label'       => __( 'Home Text', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Home', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [ 'min' => 8, 'max' => 100 ],
					'em' => [ 'min' => 0.5, 'max' => 10 ],
					'rem' => [ 'min' => 0.5, 'max' => 10 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__item i, {{WRAPPER}} .orivo-breadcrumb-blocks__item svg' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_gap',
			[
				'label'      => __( 'Icon Gap', 'ultra-elementor-addons' ),
				'description' => __( 'Space between icon and text', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
					'em' => [ 'min' => 0, 'max' => 5 ],
					'rem' => [ 'min' => 0, 'max' => 5 ],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors'  => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__item' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// ----------------- Normal State -----------------
		$this->start_controls_section(
			'section_style_normal',
			[
				'label' => __( 'Normal', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'normal_text_color',
			[
				'label'     => __( 'Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__item:not(.orivo-breadcrumb-blocks__item--active)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'normal_icon_color',
			[
				'label'     => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__item:not(.orivo-breadcrumb-blocks__item--active) i, {{WRAPPER}} .orivo-breadcrumb-blocks__item:not(.orivo-breadcrumb-blocks__item--active) svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'normal_bg_color',
			[
				'label'     => __( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks--layout-1 .orivo-breadcrumb-blocks__item, {{WRAPPER}} .orivo-breadcrumb-blocks--layout-3 .orivo-breadcrumb-blocks__item, {{WRAPPER}} .orivo-breadcrumb-blocks--layout-4 .orivo-breadcrumb-blocks__item, {{WRAPPER}} .orivo-breadcrumb-blocks--layout-5 .orivo-breadcrumb-blocks__item:not(.orivo-breadcrumb-blocks__item--active)' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		// ----------------- Hover State -----------------
		$this->start_controls_section(
			'section_style_hover',
			[
				'label' => __( 'Hover', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hover_text_color',
			[
				'label'     => __( 'Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__item:hover:not(.orivo-breadcrumb-blocks__item--active)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_icon_color',
			[
				'label'     => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__item:hover:not(.orivo-breadcrumb-blocks__item--active) i, {{WRAPPER}} .orivo-breadcrumb-blocks__item:hover:not(.orivo-breadcrumb-blocks__item--active) svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_bg_color',
			[
				'label'     => __( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks--layout-1 .orivo-breadcrumb-blocks__item:hover:not(.orivo-breadcrumb-blocks__item--active), {{WRAPPER}} .orivo-breadcrumb-blocks--layout-3 .orivo-breadcrumb-blocks__item:hover:not(.orivo-breadcrumb-blocks__item--active), {{WRAPPER}} .orivo-breadcrumb-blocks--layout-4 .orivo-breadcrumb-blocks__item:hover:not(.orivo-breadcrumb-blocks__item--active), {{WRAPPER}} .orivo-breadcrumb-blocks--layout-5 .orivo-breadcrumb-blocks__item:not(.orivo-breadcrumb-blocks__item--active):hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		// ----------------- Active State -----------------
		$this->start_controls_section(
			'section_style_active',
			[
				'label' => __( 'Active', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'active_text_color',
			[
				'label'     => __( 'Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__item--active' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'active_icon_color',
			[
				'label'     => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__item--active i, {{WRAPPER}} .orivo-breadcrumb-blocks__item--active svg' => 'color: {{VALUE}} !important; fill: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'active_bg_color',
			[
				'label'     => __( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks--layout-3 .orivo-breadcrumb-blocks__item--active, {{WRAPPER}} .orivo-breadcrumb-blocks--layout-4 .orivo-breadcrumb-blocks__item--active, {{WRAPPER}} .orivo-breadcrumb-blocks--layout-5 .orivo-breadcrumb-blocks__item--active' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'active_hover_text_color',
			[
				'label'     => __( 'Hover Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__item--active:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'active_hover_icon_color',
			[
				'label'     => __( 'Hover Icon Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__item--active:hover i, {{WRAPPER}} .orivo-breadcrumb-blocks__item--active:hover svg' => 'color: {{VALUE}} !important; fill: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'active_hover_bg_color',
			[
				'label'     => __( 'Hover Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks--layout-3 .orivo-breadcrumb-blocks__item--active:hover, {{WRAPPER}} .orivo-breadcrumb-blocks--layout-4 .orivo-breadcrumb-blocks__item--active:hover, {{WRAPPER}} .orivo-breadcrumb-blocks--layout-5 .orivo-breadcrumb-blocks__item--active:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();


		// ----------------- Typography -----------------
		$this->start_controls_section(
			'section_style_typography',
			[
				'label' => __( 'Typography', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => __( 'Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-breadcrumb-blocks__item span',
			]
		);

		$this->end_controls_section();


		// ----------------- Separator -----------------
		$this->start_controls_section(
			'section_style_separator',
			[
				'label' => __( 'Separator', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label'     => __( 'Separator Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__separator' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_size',
			[
				'label'      => __( 'Separator Size', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [ 'min' => 8, 'max' => 100 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 16 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__separator' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_space',
			[
				'label'      => __( 'Separator Space', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'unit' => 'px', 'size' => 0 ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks__separator' => 'margin: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// ----------------- Layout 5 - Modern -----------------
		$this->start_controls_section(
			'section_style_layout_5',
			[
				'label'     => __( 'Layout 5 - Modern', 'ultra-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'layout' => 'layout-5' ],
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'l5_border',
				'label'    => __( 'Item Border', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-breadcrumb-blocks--layout-5 .orivo-breadcrumb-blocks__item',
			]
		);

		// Border Radius
		$this->add_control(
			'l5_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks--layout-5 .orivo-breadcrumb-blocks__item' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'l5_padding',
			[
				'label'      => __( 'Item Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks--layout-5 .orivo-breadcrumb-blocks__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Shine
		$this->add_control(
			'l5_shine_color',
			[
				'label'     => __( 'Shine Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks--layout-5 .orivo-breadcrumb-blocks__item::before' => 'background: linear-gradient(90deg, transparent, {{VALUE}}, transparent);',
				],
			]
		);

		$this->add_control(
			'l5_shine_speed',
			[
				'label'     => __( 'Shine Speed (s)', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 's' => [ 'min' => 0.1, 'max' => 2, 'step' => 0.1 ] ],
				'selectors' => [
					'{{WRAPPER}} .orivo-breadcrumb-blocks--layout-5 .orivo-breadcrumb-blocks__item::before' => 'transition: left {{SIZE}}s;',
				],
			]
		);

		$this->end_controls_section();

	}

    // ----------------- Render Method -----------------
    protected function render() {
		$settings = $this->get_settings_for_display();
		$layout_class = 'orivo-breadcrumb-blocks--' . esc_attr( $settings['layout'] );
		$this->add_render_attribute( 'breadcrumb_wrapper', [
			'class'      => [ 'orivo-breadcrumb-blocks', $layout_class ],
			'aria-label' => 'Breadcrumb',
		] );

		echo '<nav ' . $this->get_render_attribute_string( 'breadcrumb_wrapper' ) . '>';

		global $post;
		$breadcrumbs = [];

		// Home
		$breadcrumbs[] = [
			'text' => $settings['home_text'],
			'link' => home_url(),
			'type' => 'home',
		];

		if ( is_category() || is_single() ) {
			// Get categories for posts
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$category = $categories[0]; // take first category
				$parents  = get_ancestors( $category->term_id, 'category' );
				$parents  = array_reverse( $parents );
				foreach ( $parents as $parent_id ) {
					$parent_cat = get_category( $parent_id );
					$breadcrumbs[] = [
						'text' => $parent_cat->name,
						'link' => get_category_link( $parent_cat->term_id ),
						'type' => 'category',
					];
				}
				$breadcrumbs[] = [
					'text' => $category->name,
					'link' => get_category_link( $category->term_id ),
					'type' => 'category',
				];
			}

			if ( is_single() ) {
				$breadcrumbs[] = [
					'text' => get_the_title(),
					'link' => '',
					'type' => 'current',
				];
			}
		} elseif ( is_page() ) {
			// Get parent pages
			if ( $post->post_parent ) {
				$parents = array_reverse( get_post_ancestors( $post->ID ) );
				foreach ( $parents as $parent_id ) {
					$breadcrumbs[] = [
						'text' => get_the_title( $parent_id ),
						'link' => get_permalink( $parent_id ),
						'type' => 'page',
					];
				}
			}
			$breadcrumbs[] = [
				'text' => get_the_title(),
				'link' => '',
				'type' => 'current',
			];
		} elseif ( is_archive() ) {
			$breadcrumbs[] = [
				'text' => post_type_archive_title( '', false ),
				'link' => '',
				'type' => 'archive',
			];
		} elseif ( is_search() ) {
			$breadcrumbs[] = [
				'text' => 'Search Results',
				'link' => '',
				'type' => 'search',
			];
		}

		// Render items
		$last_index = count( $breadcrumbs ) - 1;
		foreach ( $breadcrumbs as $index => $item ) {
			$is_last = ( $index === $last_index );

			// Output icon for home item only
			$icon_html = '';
			if ( 'home' === $item['type'] && ! empty( $settings['home_icon']['value'] ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['home_icon'], [ 'aria-hidden' => 'true' ] );
				$icon_html = ob_get_clean();
			}

			if ( ! $is_last && ! empty( $item['link'] ) ) {
				echo '<a class="orivo-breadcrumb-blocks__item" href="' . esc_url( $item['link'] ) . '">';
				echo $icon_html;
				echo '<span>' . esc_html( $item['text'] ) . '</span>';
				echo '</a>';
			} else {
				echo '<span class="orivo-breadcrumb-blocks__item orivo-breadcrumb-blocks__item--active" aria-current="page">';
				echo $icon_html;
				echo '<span>' . esc_html( $item['text'] ) . '</span>';
				echo '</span>';
			}

			if ( ! $is_last && 'layout-3' !== $settings['layout'] ) {
				$separator = $this->get_separator_content( $settings['layout'] );
				echo '<span class="orivo-breadcrumb-blocks__separator">' . $separator . '</span>';
			}
		}

		echo '</nav>';
	}

    protected function get_separator_content( $layout ) {
        $separators = [
            'layout-1' => '›',
            'layout-2' => '/',
            'layout-4' => '',
            'layout-5' => '〉',
        ];

        return $separators[ $layout ] ?? '›';
    }
}
