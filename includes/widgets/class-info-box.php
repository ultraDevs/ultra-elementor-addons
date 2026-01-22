<?php

namespace UltraElementorAddons\Widgets;

use Elementor\Repeater;
use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Info_Box extends Widgets_Base {

	public function get_name() {
		return 'ua_info_box';
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
		return [ 'info', 'box', 'card', 'info box' ];
	}

	public function get_style_depends() {
		return [ 'ua-style-info-box' ];
	}

	protected function ua_register_controls() {

		/* =======================
		 * Content
		 * ======================= */
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Info Box', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'box_layout',
			[
				'label'   => __( 'Layout Style', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'       => __( '1 - Default', 'ultra-elementor-addons' ),
					'left_tri'      => __( '2 - Left Triangle', 'ultra-elementor-addons' ),
					'center'        => __( '3 - Center Aligned', 'ultra-elementor-addons' ),
					'right_tri'     => __( '4 - Right Triangle', 'ultra-elementor-addons' ),
					'border'        => __( '5 - Bordered Icon', 'ultra-elementor-addons' ),
					'centered_icon' => __( '6 - Centered Icon', 'ultra-elementor-addons' ),
					'corner_icon'   => __( '7 - Corner Icon', 'ultra-elementor-addons' ),
					'hover'         => __( '8 - Hover Effect', 'ultra-elementor-addons' ),
					'primary_bg'    => __( '9 - Primary Background', 'ultra-elementor-addons' ),
					'decorations'   => __( '10 - With Decorations', 'ultra-elementor-addons' ),
					'gradient_wrap' => __( '11 - Gradient Wrapper', 'ultra-elementor-addons' ),
					'half_bg'       => __( '12 - Half Background', 'ultra-elementor-addons' ),
					'half_bg_btm'   => __( '13 - Half Background Btm', 'ultra-elementor-addons' ),
					'smart'         => __( '14 - Smart Style', 'ultra-elementor-addons' ),
					'last'          => __( '15 - Centered Tag Top', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => __( '1', 'ultra-elementor-addons' ),
					'2' => __( '2', 'ultra-elementor-addons' ),
					'3' => __( '3', 'ultra-elementor-addons' ),
					'4' => __( '4', 'ultra-elementor-addons' ),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'box_icon',
			[
				'label' => __( 'Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'box_title',
			[
				'label' => __( 'Title', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Easy DropBox Integration', 'ultra-elementor-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'box_description',
			[
				'label' => __( 'Description', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Easy DropBox Integration - Browse, Upload, and Manage Your Dropbox Files from Your WordPress Website.', 'ultra-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'box_tag',
			[
				'label' => __( 'Tag Text', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'New Plugin', 'ultra-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'box_button_text',
			[
				'label' => __( 'Button Text', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'More Details', 'ultra-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'box_link',
			[
				'label' => __( 'Link', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'info_boxes',
			[
				'label' => __( 'Info Boxes', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'box_icon' => [
							'value' => 'fas fa-rocket',
							'library' => 'fa-solid',
						],
						'box_title' => 'Easy Integration',
						'box_description' => 'Browse, Upload, and Manage Your Dropbox Files from Your WordPress Website.',
						'box_tag' => 'New',
						'box_button_text' => 'More Details',
					],
					[
						'box_icon' => [
							'value' => 'fas fa-shield-alt',
							'library' => 'fa-solid',
						],
						'box_title' => 'Secure & Reliable',
						'box_description' => 'Browse, Upload, and Manage Your Dropbox Files from Your WordPress Website.',
						'box_tag' => 'Pro',
						'box_button_text' => 'More Details',
					],
					[
						'box_icon' => [
							'value' => 'fas fa-bolt',
							'library' => 'fa-solid',
						],
						'box_title' => 'Lightning Fast',
						'box_description' => 'Browse, Upload, and Manage Your Dropbox Files from Your WordPress Website.',
						'box_tag' => 'Plus',
						'box_button_text' => 'More Details',
					],
				],
				'title_field' => '{{{ box_title }}}',
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
				'label' => __( 'Gap', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 100 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 20 ],
				'selectors' => [
					'{{WRAPPER}} .ua-info-boxes' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Box
		 * ======================= */
		$this->start_controls_section(
			'section_style_box',
			[
				'label' => __( 'Box', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_background',
				'label' => __( 'Background', 'ultra-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .orivo-blocks-info-box',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .orivo-blocks-info-box',
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 12,
					'right' => 12,
					'bottom' => 12,
					'left' => 12,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 40,
					'right' => 40,
					'bottom' => 40,
					'left' => 40,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->end_controls_section();

		/* =======================
		 * Style - Icon
		 * ======================= */
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_background_color',
			[
				'label' => __( 'Icon Background Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#5820E5',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-blocks-info-box__icon img' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .orivo-blocks-info-box__icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 16, 'max' => 64 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 48 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Icon Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 30 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 16 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Icon Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'rounded',
				'options' => [
					'square' => __( 'Square', 'ultra-elementor-addons' ),
					'rounded' => __( 'Rounded', 'ultra-elementor-addons' ),
					'circle' => __( 'Circle', 'ultra-elementor-addons' ),
				],
				'prefix_class' => 'ua-icon-radius-',
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

		$this->add_control(
			'tag_heading',
			[
				'label' => __( 'Tag', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'tag_color',
			[
				'label' => __( 'Tag Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#F30D55',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__tag' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-blocks-info-box__details h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-blocks-info-box__details h5' => 'color: {{VALUE}};',
					'{{WRAPPER}} .orivo-blocks-info-box__details h6' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tag_typography',
				'label' => __( 'Tag Typography', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .orivo-blocks-info-box__tag, {{WRAPPER}} .orivo-blocks-info-box__details h3, {{WRAPPER}} .orivo-blocks-info-box__details h5, {{WRAPPER}} .orivo-blocks-info-box__details h6',
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' => __( 'Title', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#404040',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__details h2' => 'color: {{VALUE}};',
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

		$this->add_control(
			'description_heading',
			[
				'label' => __( 'Description', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7D7D7D',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__details p' => 'color: {{VALUE}};',
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

		/* =======================
		 * Style - Button
		 * ======================= */
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Button', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'button_tabs' );

		$this->start_controls_tab(
			'button_normal_tab',
			[
				'label' => __( 'Normal', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(88, 32, 229, 1)',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __( 'Background Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Border Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(88, 32, 229, 0.751)',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_tab',
			[
				'label' => __( 'Hover', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => __( 'Text Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background_color',
			[
				'label' => __( 'Background Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#5820E5',
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 12,
					'right' => 20,
					'bottom' => 12,
					'left' => 20,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 30 ],
				'selectors' => [
					'{{WRAPPER}} .orivo-blocks-info-box__btn a' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$info_boxes = ! empty( $settings['info_boxes'] ) ? $settings['info_boxes'] : [];
		$columns = ! empty( $settings['columns'] ) ? $settings['columns'] : '3';
		$layout = ! empty( $settings['box_layout'] ) ? $settings['box_layout'] : 'default';

		$container_classes = [ 'ua-info-boxes', 'info-boxes' ];
		$box_classes = [ 'orivo-blocks-info-box' ];

		// Add layout-specific classes
		switch ( $layout ) {
			case 'left_tri':
				$box_classes[] = 'orivo-blocks-info-box--one';
				break;
			case 'center':
				$box_classes[] = 'orivo-blocks-info-box--two';
				break;
			case 'right_tri':
				$box_classes[] = 'orivo-blocks-info-box--three';
				break;
			case 'border':
				$box_classes[] = 'orivo-blocks-info-box--four';
				break;
			case 'centered_icon':
				$box_classes[] = 'orivo-blocks-info-box--five';
				break;
			case 'corner_icon':
				$box_classes[] = 'orivo-blocks-info-box--six';
				break;
			case 'hover':
				$box_classes[] = 'orivo-blocks-info-box--seven';
				break;
			case 'primary_bg':
				$box_classes[] = 'orivo-blocks-info-box--nine';
				break;
			case 'decorations':
				$box_classes[] = 'orivo-blocks-info-box--ten';
				break;
			case 'gradient_wrap':
				$box_classes[] = 'orivo-blocks-info-box__gradient-bg';
				break;
			case 'half_bg':
				$box_classes[] = 'orivo-blocks-info-box--half-bg';
				break;
			case 'half_bg_btm':
				$box_classes[] = 'orivo-blocks-info-box--half-bg';
				$box_classes[] = 'orivo-blocks-info-box__btm-bg';
				break;
			case 'smart':
				$box_classes[] = 'orivo-blocks-info-box--two';
				$box_classes[] = 'orivo-blocks-info-box__smart';
				break;
			case 'last':
				$box_classes[] = 'orivo-blocks-info-box__last';
				$container_classes[] = 'txt-center';
				break;
		}

		$box_class = implode( ' ', $box_classes );
		$container_class = implode( ' ', $container_classes );

		echo '<div class="' . esc_attr( $container_class ) . '">';

		foreach ( $info_boxes as $index => $box ) {
			$box_link = ! empty( $box['box_link']['url'] ) ? $box['box_link']['url'] : '#';
			$box_link_target = ! empty( $box['box_link']['is_external'] ) ? ' target="_blank"' : '';
			$box_link_nofollow = ! empty( $box['box_link']['nofollow'] ) ? ' rel="nofollow"' : '';

			$this->render_single_box( $box, $box_class, $layout, $box_link, $box_link_target, $box_link_nofollow );
		}

		echo '</div>';
	}

	private function render_single_box( $box, $box_class, $layout, $box_link, $box_link_target, $box_link_nofollow ) {
		echo '<div class="' . esc_attr( $box_class ) . '">';

		// Different HTML structure based on layout
		switch ( $layout ) {
			case 'hover':
				echo '<div class="orivo-blocks-info-box__border">';
				$this->render_box_content( $box, $layout, $box_link, $box_link_target, $box_link_nofollow );
				echo '</div>';
				break;

			case 'gradient_wrap':
				echo '<div class="orivo-blocks-info-box__white-bg txt-center">';
				$this->render_box_content( $box, $layout, $box_link, $box_link_target, $box_link_nofollow );
				echo '</div>';
				break;

			case 'half_bg':
			case 'half_bg_btm':
				$inner_class = ( $layout === 'half_bg_btm' ) ? 'orivo-blocks-info-box__round-bg-two' : 'orivo-blocks-info-box__round-bg';
				echo '<div class="' . esc_attr( $inner_class ) . '">';
				$this->render_box_content( $box, $layout, $box_link, $box_link_target, $box_link_nofollow );
				echo '</div>';
				echo '<div class="orivo-blocks-info-box__primary-bg"></div>';
				break;

			case 'decorations':
				$this->render_box_content( $box, $layout, $box_link, $box_link_target, $box_link_nofollow );
				// Add decorative image elements
				echo '<div class="orivo-blocks-info-box__top-img">';
				echo '<img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1 1\'%3E%3C/svg%3E" alt="">';
				echo '</div>';
				echo '<div class="orivo-blocks-info-box__btm-left-img">';
				echo '<img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1 1\'%3E%3C/svg%3E" alt="">';
				echo '</div>';
				break;

			default:
				$this->render_box_content( $box, $layout, $box_link, $box_link_target, $box_link_nofollow );
				// Add bottom image for default layout (info boxes 3)
				if ( $layout === 'default' ) {
					echo '<div class="orivo-blocks-info-box__btm-img">';
					echo '<img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1 1\'%3E%3C/svg%3E" alt="">';
					echo '</div>';
				}
				break;
		}

		echo '</div>';
	}

	private function render_box_content( $box, $layout, $box_link, $box_link_target, $box_link_nofollow ) {
		// Icon
		if ( ! empty( $box['box_icon']['value'] ) ) {
			$icon_classes = [ 'orivo-blocks-info-box__icon' ];

			// Add special icon classes for certain layouts
			if ( in_array( $layout, [ 'default', 'gradient_wrap' ] ) ) {
				$icon_classes[] = 'orivo-blocks-info-box__img--bg';
			}

			if ( $layout === 'smart' ) {
				$icon_classes[] = 'orivo-blocks-info-box__img--gradient';
			}

			// Triangle classes for left/right layouts
			if ( $layout === 'left_tri' ) {
				echo '<div class="orivo-blocks-info-box__icon tri-right btm-left-in">';
			} elseif ( $layout === 'right_tri' ) {
				echo '<div class="orivo-blocks-info-box__icon tri-right btm-right">';
			} else {
				echo '<div class="' . esc_attr( implode( ' ', $icon_classes ) ) . '">';
			}

			Icons_Manager::render_icon( $box['box_icon'], [ 'aria-hidden' => 'true' ] );
			echo '</div>';
		}

		echo '<div class="orivo-blocks-info-box__details">';

		// Tag position based on layout
		if ( ! empty( $box['box_tag'] ) ) {
			if ( $layout === 'last' ) {
				// Tag comes first for last layout
				echo '<div class="orivo-blocks-info-box__tag">';
				echo '<h6>' . esc_html( $box['box_tag'] ) . '</h6>';
				echo '</div>';
			} elseif ( in_array( $layout, [ 'half_bg', 'half_bg_btm' ] ) ) {
				echo '<div class="orivo-blocks-info-box__tag">';
				echo '<h6>' . esc_html( $box['box_tag'] ) . '</h6>';
				echo '</div>';
			} elseif ( in_array( $layout, [ 'primary_bg', 'decorations' ] ) ) {
				echo '<div class="orivo-blocks-info-box__tag">';
				echo '<h5>' . esc_html( $box['box_tag'] ) . '</h5>';
				echo '</div>';
			}
		}

		// Smart layout has h5 tag
		if ( $layout === 'smart' && ! empty( $box['box_tag'] ) ) {
			echo '<h5>' . esc_html( $box['box_tag'] ) . '</h5>';
		}

		// Title
		if ( ! empty( $box['box_title'] ) ) {
			echo '<h2>' . esc_html( $box['box_title'] ) . '</h2>';
		}

		// Description
		if ( ! empty( $box['box_description'] ) ) {
			echo '<p>' . esc_html( $box['box_description'] ) . '</p>';
		}

		// Tag for normal layouts (h3)
		if ( ! empty( $box['box_tag'] ) && ! in_array( $layout, [ 'last', 'half_bg', 'half_bg_btm', 'primary_bg', 'decorations', 'smart' ] ) ) {
			echo '<h3>' . esc_html( $box['box_tag'] ) . '</h3>';
		}

		// Button
		if ( ! empty( $box['box_button_text'] ) ) {
			echo '<div class="orivo-blocks-info-box__btn">';
			echo '<a href="' . esc_url( $box_link ) . '"' . $box_link_target . $box_link_nofollow . '>' . esc_html( $box['box_button_text'] ) . '</a>';
			echo '</div>';
		}

		echo '</div>'; // End details
	}
}
