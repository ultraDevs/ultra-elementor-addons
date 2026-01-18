<?php

namespace UltraElementorAddons\Widgets;

use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

defined( 'ABSPATH' ) || die();

class Icon_Box extends Widgets_Base {

	public function get_name() {
		return __( 'ua-icon', 'ultra-elementor-addons' );
	}

	public function get_title() {
		return __( 'Icon Box', 'ultra-elementor-addons' );
	}

	public function get_icon() {
		return 'ua-icon eicon-icon-box';
	}

	public function get_categories() {
		return [ 'ultra_addons_category' ];
	}

	public function get_keywords() {
		return [ 'icon', 'box', 'iconbox' ];
	}

	public function get_style_depends() {
		return [ 'ua-style-icon-box' ];
	}

	protected function ua_register_controls() {

		/* =======================
		 * Content Section
		 * ======================= */
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Icon Box', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => __( 'Choose Icon', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'icon_box_style',
			[
				'label' => __( 'Icon Box Style', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1 - Rounded Background', 'ultra-elementor-addons' ),
					'style2' => __( 'Style 2 - Circle Background', 'ultra-elementor-addons' ),
					'style3' => __( 'Style 3 - Rounded Border', 'ultra-elementor-addons' ),
					'style4' => __( 'Style 4 - Circle Border', 'ultra-elementor-addons' ),
					'style5' => __( 'Style 5 - Icon Only', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => __( 'Alignment', 'ultra-elementor-addons' ),
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
				'default' => 'center',
				'toggle' => true,
			]
		);

		$this->add_control(
			'icon_link',
			[
				'label' => __( 'Link', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ultra-elementor-addons' ),
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Icon Size Section
		 * ======================= */
		$this->start_controls_section(
			'section_icon_size',
			[
				'label' => __( 'Icon Size', 'ultra-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [ 'min' => 10, 'max' => 200 ],
					'em' => [ 'min' => 1, 'max' => 20 ],
					'rem' => [ 'min' => 1, 'max' => 20 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 48,
				],
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Icon Box Size Section
		 * ======================= */
		$this->start_controls_section(
			'section_box_size',
			[
				'label' => __( 'Icon Box Size', 'ultra-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'box_size',
			[
				'label' => __( 'Box Size', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [ 'min' => 40, 'max' => 400 ],
					'em' => [ 'min' => 4, 'max' => 40 ],
					'%' => [ 'min' => 10, 'max' => 100 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_box_style!' => 'style5',
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
				'label' => __( 'Icon', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_normal',
			[
				'label' => __( 'Normal', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#6366F1',
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background_color',
			[
				'label' => __( 'Background Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#EEF2FF',
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'icon_box_style' => [ 'style1', 'style2' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			[
				'label' => __( 'Hover', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Hover Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4F46E5',
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box:hover .ua-icon-box-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_background_color',
			[
				'label' => __( 'Hover Background Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#E0E7FF',
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'icon_box_style' => [ 'style1', 'style2' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/* =======================
		 * Style - Border
		 * ======================= */
		$this->start_controls_section(
			'section_style_border',
			[
				'label' => __( 'Border', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_box_style' => [ 'style3', 'style4' ],
				],
			]
		);

		$this->add_control(
			'border_width_new',
			[
				'label' => __( 'Border Width', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [ 'min' => 1, 'max' => 20 ],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_style',
			[
				'label' => __( 'Border Style', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid' => __( 'Solid', 'ultra-elementor-addons' ),
					'double' => __( 'Double', 'ultra-elementor-addons' ),
					'dotted' => __( 'Dotted', 'ultra-elementor-addons' ),
					'dashed' => __( 'Dashed', 'ultra-elementor-addons' ),
					'groove' => __( 'Groove', 'ultra-elementor-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_color_new',
			[
				'label' => __( 'Border Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#6366F1',
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_hover_color',
			[
				'label' => __( 'Border Hover Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4F46E5',
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Box Shadow
		 * ======================= */
		$this->start_controls_section(
			'section_style_box_shadow',
			[
				'label' => __( 'Box Shadow', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ua-icon-box',
			]
		);

		$this->add_control(
			'box_shadow_hover',
			[
				'label' => __( 'Box Shadow on Hover', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'ultra-elementor-addons' ),
				'label_off' => __( 'No', 'ultra-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover_effect',
				'label' => __( 'Hover Box Shadow', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ua-icon-box:hover',
				'condition' => [
					'box_shadow_hover' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Border Radius
		 * ======================= */
		$this->start_controls_section(
			'section_style_border_radius',
			[
				'label' => __( 'Border Radius', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '16',
					'right' => '16',
					'bottom' => '16',
					'left' => '16',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Spacing
		 * ======================= */
		$this->start_controls_section(
			'section_style_spacing',
			[
				'label' => __( 'Spacing', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label' => __( 'Margin', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' => __( 'Padding', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->end_controls_section();

		/* =======================
		 * Style - Animation
		 * ======================= */
		$this->start_controls_section(
			'section_style_animation',
			[
				'label' => __( 'Animation', 'ultra-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'ultra-elementor-addons' ),
					'fade' => __( 'Fade', 'ultra-elementor-addons' ),
					'slide-up' => __( 'Slide Up', 'ultra-elementor-addons' ),
					'slide-down' => __( 'Slide Down', 'ultra-elementor-addons' ),
					'zoom-in' => __( 'Zoom In', 'ultra-elementor-addons' ),
					'zoom-out' => __( 'Zoom Out', 'ultra-elementor-addons' ),
					'rotate' => __( 'Rotate', 'ultra-elementor-addons' ),
					'bounce' => __( 'Bounce', 'ultra-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'animation_duration',
			[
				'label' => __( 'Animation Duration', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 's', 'ms' ],
				'range' => [
					's' => [ 'min' => 0.1, 'max' => 5, 'step' => 0.1 ],
					'ms' => [ 'min' => 100, 'max' => 5000, 'step' => 100 ],
				],
				'default' => [
					'unit' => 's',
					'size' => 0.3,
				],
				'selectors' => [
					'{{WRAPPER}} .ua-icon-box' => 'transition-duration: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'hover_animation!' => 'none',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$style = $settings['icon_box_style'];
		$align = $settings['icon_align'];
		$animation = $settings['hover_animation'];
		$link = $settings['icon_link'];

		$wrapper_classes = [ 'ua-icon-box-wrapper', 'ua-icon-box-align-' . $align ];

		if ( 'none' !== $animation ) {
			$wrapper_classes[] = 'ua-icon-box-animation-' . $animation;
		}

		$box_classes = [ 'ua-icon-box' ];

		switch ( $style ) {
			case 'style1':
				$box_classes[] = 'ua-icon-box-style1';
				break;
			case 'style2':
				$box_classes[] = 'ua-icon-box-style2';
				break;
			case 'style3':
				$box_classes[] = 'ua-icon-box-style3';
				break;
			case 'style4':
				$box_classes[] = 'ua-icon-box-style4';
				break;
			case 'style5':
				$box_classes[] = 'ua-icon-box-style5';
				break;
		}

		$this->add_render_attribute( 'wrapper', 'class', $wrapper_classes );
		$this->add_render_attribute( 'box', 'class', $box_classes );

		if ( ! empty( $link['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $link['url'] );
			$this->add_render_attribute( 'link', 'class', 'ua-icon-box-link' );

			if ( $link['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $link['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( ! empty( $link['url'] ) ) : ?>
				<a <?php $this->print_render_attribute_string( 'link' ); ?>>
			<?php endif; ?>

			<div <?php $this->print_render_attribute_string( 'box' ); ?>>
				<?php if ( ! empty( $settings['selected_icon'] ) ) : ?>
					<span class="ua-icon-box-icon">
						<?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $link['url'] ) ) : ?>
				</a>
			<?php endif; ?>
		</div>
		<?php
	}
}
