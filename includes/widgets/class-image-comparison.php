<?php

/**
 * Image Comparison Widget Class
 *
 * @package Ultra_Elementor_Addons
 */

namespace UltraElementorAddons\Widgets;

use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Image_Comparison extends Widgets_Base {

	const W_NAME = 'ua_ic_';
	/**
	 * Retrieve the widgte name
	 *
	 * @return string Widget Name
	 */
	public function get_name() {
		return __( 'ua-image-comparison', 'ultra-elementor-addons' );
	}

	/**
	 * Retrieve the widgte title
	 *
	 * @return string Widget title
	 */
	public function get_title() {
		return __( 'Image Comparison', 'ultra-elementor-addons' );
	}

	/**
	 * Retrieve the widgte icon
	 *
	 * @return string Widget Name
	 */
	public function get_icon() {
		return 'ua-icon eicon-image';
	}

	/**
	 * Widget Category
	 *
	 * @return array Widget categories
	 */
	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depened on.
	 *
	 * @return array Widget scripts dependies.
	 */
	public function get_script_depends() {
		return [
			'ua-image-comparison',
		];
	}

	/**
	 * Retrieve the list of styles the widget depends on
	 */
	public function get_style_depends() {
		return [
			'ua-style-image-comparison',
		];
	}

	/**
	 * Register the widget controls.
	 */
	protected function ua_register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Images & Label', 'ultra-elementor-addons' ),
			]
		);

			$this->start_controls_tabs(
				'before_after_img'
			);

				$this->start_controls_tab(
					'before_img',
					[
						'label' => __( 'Before', 'ultra-elementor-addons' ),
					]
				);
					$this->add_control(
						'before_image',
						[
							'label'   => __( 'Image', 'ultra-elementor-addons' ),
							'type'    => Controls_Manager::MEDIA,
							'default' => [
								'url' => Utils::get_placeholder_image_src(),
							],
							'dynamic' => [
								'active' => true,
							],
						]
					);
					$this->add_control(
						'before_txt',
						[
							'label'   => esc_html__( 'Label', 'ultra-elementor-addons' ),
							'type'    => Controls_Manager::TEXT,
							'default' => __( 'Before', 'ultra-elementor-addons' ),
							'dynamic' => [
								'active' => true,
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'after_img',
					[
						'label' => __( 'After', 'ultra-elementor-addons' ),
					]
				);
					$this->add_control(
						'after_image',
						[
							'label'   => __( 'Image', 'ultra-elementor-addons' ),
							'type'    => Controls_Manager::MEDIA,
							'default' => [
								'url' => Utils::get_placeholder_image_src(),
							],
							'dynamic' => [
								'active' => true,
							],
						]
					);
					$this->add_control(
						'after_txt',
						[
							'label'   => esc_html__( 'Label', 'ultra-elementor-addons' ),
							'type'    => Controls_Manager::TEXT,
							'default' => __( 'After', 'ultra-elementor-addons' ),
							'dynamic' => [
								'active' => true,
							],
						]
					);
				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'    => 'image_size',
					'default' => 'full',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'settings',
			[
				'label' => __( 'Settings', 'ultra-elementor-addons' ),
			]
		);

			$this->add_control(
				'v_ratio',
				[
					'label'   => __( 'Visibility Ratio', 'ultra-elementor-addons' ),
					'type'    => Controls_Manager::SLIDER,
					'range'   => [
						'px' => [
							'min'  => 0,
							'max'  => 1,
							'step' => .1,
						],
					],
					'default' => [
						'size' => 0.5,
					],
				]
			);

			$this->add_control(
				'orientation',
				[
					'label'   => __( 'Orientation', 'ultra-elementor-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'vertical'   => __( 'Vertical', 'ultra-elementor-addons' ),
						'horizontal' => __( 'Horizontal', 'ultra-elementor-addons' ),
					],
					'default' => 'horizontal',
				]
			);

			$this->add_control(
				'hide_overlay',
				[
					'label'        => __( 'Hide Overlay', 'ultra-elementor-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Yes', 'ultra-elementor-addons' ),
					'label_off'    => __( 'No', 'ultra-elementor-addons' ),
					'default'      => 'no',
					'return_value' => 'yes',
				]
			);

			$this->add_control(
				'handle',
				[
					'label'   => __( 'Move Handle', 'ultra-elementor-addons' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'on_swipe' => __( 'On Swipe', 'ultra-elementor-addons' ),
						'on_click' => __( 'On Click', 'ultra-elementor-addons' ),
						'on_hover' => __( 'On Hover', 'ultra-elementor-addons' ),
					],
					'default' => 'on_swipe',
				]
			);

		$this->end_controls_section();

		/**
		 * Styles
		 */

		$this->start_controls_section(
			'styles',
			[
				'label' => __( 'Overlay', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs(
				'overlay_tabs'
			);

				$this->start_controls_tab(
					'normal',
					[
						'label' => __( 'Normal', 'ultra-elementor-addons' ),
					]
				);
					$this->add_control(
						'o_bg_color',
						[
							'label'     => esc_html__( 'Background Color', 'ultra-elementor-addons' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => 'rgba(0, 0, 0, 0)',
							'selectors' => [
								'{{WRAPPER}} .ua-image-comparison .twentytwenty-overlay' => 'background-color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'hover',
					[
						'label' => __( 'Hover', 'ultra-elementor-addons' ),
					]
				);
					$this->add_control(
						'o_bg_color_hover',
						[
							'label'     => esc_html__( 'Background Color', 'ultra-elementor-addons' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => 'rgba(0, 0, 0, 0.5)',
							'selectors' => [
								'{{WRAPPER}} .ua-image-comparison .twentytwenty-overlay:hover' => 'background-color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'label',
			[
				'label' => __( 'Label', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs(
				'label_tabs'
			);

				$this->start_controls_tab(
					'before',
					[
						'label' => __( 'Before', 'ultra-elementor-addons' ),
					]
				);

					$this->add_control(
						'before_bg_color',
						[
							'label'     => esc_html__( 'Background Color', 'ultra-elementor-addons' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => 'rgba(0, 0, 0, 0.3)',
							'selectors' => [
								'{{WRAPPER}} .ua-image-comparison .twentytwenty-before-label:before' => 'background-color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'before_txt_color',
						[
							'label'     => esc_html__( 'Color', 'ultra-elementor-addons' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#fff',
							'selectors' => [
								'{{WRAPPER}} .ua-image-comparison .twentytwenty-before-label:before' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Typography::get_type(),
						[
							'name'     => 'before_typo',
							// 'scheme' => Scheme_Typography::TYPOGRAPHY_1,
							'selector' => '{{WRAPPER}} .ua-image-comparison .twentytwenty-before-label:before',
						]
					);

					$this->add_control(
						'b_border_radius',
						[
							'label'      => esc_html__( 'Border Radius', 'ultra-elementor-addons' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px' ],
							'selectors'  => [
								'{{WRAPPER}} .ua-image-comparison .twentytwenty-before-label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'before_padding',
						[
							'label'      => esc_html__( 'Padding', 'ultra-elementor-addons' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .ua-image-comparison .twentytwenty-before-label:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'after',
					[
						'label' => __( 'After', 'ultra-elementor-addons' ),
					]
				);
					$this->add_control(
						'after_bg_color',
						[
							'label'     => esc_html__( 'Background Color', 'ultra-elementor-addons' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => 'rgba(0, 0, 0, 0.3)',
							'selectors' => [
								'{{WRAPPER}} .ua-image-comparison .twentytwenty-after-label:after' => 'background-color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'after_txt_color',
						[
							'label'     => esc_html__( 'Color', 'ultra-elementor-addons' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#fff',
							'selectors' => [
								'{{WRAPPER}} .ua-image-comparison .twentytwenty-after-label:after' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Typography::get_type(),
						[
							'name'     => 'after_typo',
							// 'scheme' => Scheme_Typography::TYPOGRAPHY_2,
							'selector' => '{{WRAPPER}} .ua-image-comparison .twentytwenty-after-label:after',
						]
					);

					$this->add_control(
						'a_border_radius',
						[
							'label'      => esc_html__( 'Border Radius', 'ultra-elementor-addons' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px' ],
							'selectors'  => [
								'{{WRAPPER}} .ua-image-comparison .twentytwenty-after-label:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'after_padding',
						[
							'label'      => esc_html__( 'Padding', 'ultra-elementor-addons' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .ua-image-comparison .twentytwenty-after-label:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'divider',
			[
				'label' => __( 'Divider', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'd_color',
			[
				'label'     => esc_html__( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ua-image-comparison .twentytwenty-handle:after, {{WRAPPER}} .ua-image-comparison .twentytwenty-handle:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'd_width',
			[
				'label'      => __( 'Width', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors'  => [
					'{{WRAPPER}} .ua-image-comparison .twentytwenty-handle:after, {{WRAPPER}} .ua-image-comparison .twentytwenty-handle:before' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'Handler',
			[
				'label' => __( 'Handler', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'h_bg_color',
				[
					'label'     => esc_html__( 'Background Color', 'ultra-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .ua-image-comparison .twentytwenty-handle' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'h_a_color',
				[
					'label'     => esc_html__( 'Icon Color', 'ultra-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ff0000',
					'selectors' => [
						'{{WRAPPER}} .ua-image-comparison .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}};',
						'{{WRAPPER}} .ua-image-comparison .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'h_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'ultra-elementor-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}} .ua-image-comparison .twentytwenty-handle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output in the frontend
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'before_image', 'src', $settings['before_image']['url'] );
		$this->add_render_attribute( 'before_image', 'alt', Control_Media::get_image_alt( $settings['before_image'] ) );

		$this->add_render_attribute( 'after_image', 'src', $settings['before_image']['url'] );
		$this->add_render_attribute( 'after_image', 'alt', Control_Media::get_image_alt( $settings['before_image'] ) );

		$data = array(
			'default_offset_pct'    => isset( $settings['v_ratio'] ) ? $settings['v_ratio']['size'] : '0.5',
			'orientation'           => isset( $settings['orientation'] ) ? $settings['orientation'] : 'horizontal',
			'before_label'          => isset( $settings['before_txt'] ) ? $settings['before_txt'] : 'Before',
			'after_label'           => isset( $settings['after_txt'] ) ? $settings['after_txt'] : 'After',
			'no_overlay'            => ( $settings['hide_overlay'] == 'yes' ) ? true : false,
			'move_slider_on_hover'  => ( $settings['handle'] === 'on_hover' ) ? true : false,
			'move_with_handle_only' => ( $settings['handle'] === 'on_swipe' ) ? true : false,
			'click_to_move'         => ( $settings['handle'] === 'on_click' ) ? true : false,
		);
		?>
		<div class="ua-image-comparison" id="ua-image-comparison" class="twentytwenty-container" data-config='<?php echo wp_json_encode( $data ); ?>'>
			<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'before_image' ); ?>
			<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'after_image' ); ?>
		</div>
		<?php
	}
}
