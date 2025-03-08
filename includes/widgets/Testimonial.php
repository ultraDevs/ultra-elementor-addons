<?php

/**
 * Testimonial Widget Class
 *
 * @package Ultra_Elementor_Addons
 */

namespace UltraElementorAddons\Widgets;

use Elementor\Repeater;
use UltraElementorAddons\Base\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

defined( 'ABSPATH' ) || die();

class Testimonial extends Widgets_Base {

	const W_NAME = 'ua_testimonial_';
	/**
	 * Retrieve the widgte name
	 *
	 * @return string Widget Name
	 */
	public function get_name() {
		return 'ua-testimonial';
	}

	/**
	 * Retrieve the widgte title
	 *
	 * @return string Widget title
	 */
	public function get_title() {
		return __( 'Testimonial', 'ultra-elementor-addons' );
	}

	/**
	 * Retrieve the widgte icon
	 *
	 * @return string Widget Name
	 */
	public function get_icon() {
		return 'ua-icon eicon-testimonial';
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
	 * Retrieve the list of styles the widget depends on
	 */
	public function get_style_depends() {
		return [
			'ua-style-testimonial',
		];
	}

	/**
	 * Register the widget controls.
	 */
	protected function ua_register_controls() {
		$this->start_controls_section(
			'content',
			[
				'label' => __( 'Content', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			't_content',
			[
				'label'   => __( 'Description', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Testimonial Content', 'ultra-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			't_author_avatar',
			[
				'label'   => __( 'Avatar', 'ultra-elementor-addons' ),
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
			't_author',
			[
				'label'   => __( 'Name', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Name', 'ultra-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			't_a_title',
			[
				'label'   => __( 'Title', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Title', 'ultra-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();

		/** Styles */

		$this->start_controls_section(
			't_styles_section',
			[
				'label' => __( 'Styles', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			't_heading_'
		);

		$this->start_controls_tab(
			't_heading_t',
			[
				'label' => __( 'Normal', 'ultra-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'label'    => esc_html__( 'Background', 'ultra-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .t_item .t_txt',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_box-shadow-n',
				'selector' => '{{WRAPPER}} .ua-testimonial .t_item .t_txt',
			]
		);

		$this->add_control(
			'ta_bg_color',
			[
				'label'     => esc_html__( 'Triangle Arrow Background', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f30d55',
				'selectors' => [
					'{{WRAPPER}} .ua-testimonial .center .t_txt::after' => 'border-top: 30px solid {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			't_heading_t_h',
			[
				'label' => __( 'Hover', 'ultra-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'background-hover',
				'label'    => esc_html__( 'Background', 'ultra-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ua-testimonial .t_item:hover .t_txt',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_box-shadow-h',
				'selector' => '{{WRAPPER}} .ua-testimonial .t_item:hover .t_txt',
			]
		);

		$this->add_control(
			'ta_bg_h_color',
			[
				'label'     => esc_html__( 'Triangle Arrow Background', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f30d55',
				'selectors' => [
					'{{WRAPPER}} .ua-testimonial .t_item:hover .t_txt::after' => 'border-top: 30px solid {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			't_content_style',
			[
				'label' => __( 'Content', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			't_content_txt_color_a',
			[
				'label'     => esc_html__( 'Color ', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ua-testimonial .t_txt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 't_content_typo',
				// 'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ua-testimonial .t_txt',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			't_t_footer_style',
			[
				'label' => __( 'Footer Content', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_t_n',
			[
				'label'     => __( 'Name', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			't_f_name_color',
			[
				'label'     => esc_html__( 'Name Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3b566e',
				'selectors' => [
					'{{WRAPPER}} .ua-testimonial .c_o_info h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 't_f_name_typo',
				// 'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .ua-testimonial .c_o_info h2',
			]
		);

		$this->add_control(
			'heading_t_t',
			[
				'label'     => __( 'Title', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			't_f_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3b566e',
				'selectors' => [
					'{{WRAPPER}} .ua-testimonial .c_o_info h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 't_f_title_typo',
				// 'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .ua-testimonial .c_o_info h3',
			]
		);

		$this->add_control(
			'heading_t_a',
			[
				'label'     => __( 'Avatar', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			't_f_avatar_w_',
			[
				'label'     => esc_html__( 'Image Width', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 100,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ua-testimonial .c_img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			't_f_avatar_h',
			[
				'label'     => esc_html__( 'Image Height', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 100,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ua-testimonial .c_img img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			't_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => 50,
					'right'  => 50,
					'bottom' => 50,
					'left'   => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .ua-testimonial .c_img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$this->add_inline_editing_attributes( 't_content', 'advance' );
		$this->add_inline_editing_attributes( 't_author', 'none' );
		$this->add_inline_editing_attributes( 't_a_title', 'none' );

		?>
		<div class="ua-testimonial-s" id="ua-testimonial-<?php echo esc_attr( $this->get_id() ); ?>" >
			<div class="ua-testimonial">
				<div class="t_item">
					<div class="t_txt" <?php $this->print_render_attribute_string( 't_content' ); ?>>
						<?php echo $settings['t_content']; ?>
					</div>
					<div class="client_info text-center">
						<div class="c_img">
							<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'medium', 't_author_avatar' ); ?>
							
						</div>
						<div class="c_o_info">
							<h2 <?php $this->print_render_attribute_string( 't_author' ); ?>><?php echo $settings['t_author']; ?></h2>
							<h3 <?php $this->print_render_attribute_string( 't_a_title' ); ?>><?php echo $settings['t_a_title']; ?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	/**
	 * Render the widget output in the editor
	 */
	protected function _dcontent_template() {
		?>
		
		<?php
	}
}
