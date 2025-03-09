<?php

/**
 * Accordion Widget Class
 *
 * @package Ultra_Elementor_Addons
 */

namespace UltraElementorAddons\Widgets;

use Elementor\Repeater;
use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

defined( 'ABSPATH' ) || die();

class Accordion extends Widgets_Base {

	const W_NAME = 'ua_accordion_';
	/**
	 * Retrieve the widgte name
	 *
	 * @return string Widget Name
	 */
	public function get_name() {
		return __( 'ua-accordion', 'ultra-elementor-addons' );
	}

	/**
	 * Retrieve the widgte title
	 *
	 * @return string Widget title
	 */
	public function get_title() {
		return __( 'Accordion', 'ultra-elementor-addons' );
	}

	/**
	 * Retrieve the widgte icon
	 *
	 * @return string Widget Name
	 */
	public function get_icon() {
		return 'ua-icon eicon-accordion';
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
			'ua-script-accordion',
		];
	}

	public function enqueue() {
	}

	/**
	 * Retrieve the list of styles the widget depends on
	 */
	public function get_style_depends() {
		return [
			'ua-style-accordion',
		];
	}

	/**
	 * Register the widget controls.
	 */
	protected function ua_register_controls() {
		$this->start_controls_section(
			self::W_NAME . 'section_content',
			[
				'label' => esc_html__( 'Content', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			self::W_NAME . 'speed',
			[
				'label'              => __( 'Speed (ms)', 'ultra-elementor-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 300,
				'frontend_available' => true,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			self::W_NAME . 'default_item',
			[
				'label'        => __( 'Active ?', 'ultra-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			]
		);
		$repeater->add_control(
			self::W_NAME . 'title',
			[
				'label'   => esc_html__( 'Accordion Title', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Accordion Title', 'ultra-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			self::W_NAME . 'contents',
			[
				'label'   => esc_html__( 'Accordion Content', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Accordion Content ', 'ultra-elementor-addons' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			self::W_NAME . 'accordions',
			[
				'type'        => Controls_Manager::REPEATER,
				'default'     => [
					[
						self::W_NAME . 'title' => esc_html__( 'Panel 1', 'ultra-elementor-addons' ),
					],
					[
						self::W_NAME . 'title' => esc_html__( 'Panel 2', 'ultra-elementor-addons' ),
					],
				],
				'fields'      => array_values( $repeater->get_controls() ),
				'title_field' => '{{ua_accordion_title}}',
			]
		);

		$this->end_controls_section();

		/**
		 * Style Section
		 */

		$this->start_controls_section(
			self::W_NAME . 'styles_section',
			[
				'label' => esc_html__( 'Styles', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			self::W_NAME . 'border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ua-accordion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 'i_margin_bottom',
			[
				'label'     => esc_html__( 'Item Margin Bottom', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ua-accordion__item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => self::W_NAME . 'item_border',
				'label'    => __( 'Border', 'ultra-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ua-accordion__item',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => self::W_NAME . 'item_box-shadow',
				'selector' => '{{WRAPPER}} .ua-accordion__item',
			]
		);

		$this->add_control(
			self::W_NAME . 'bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ua-accordion' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			self::W_NAME . 'title',
			[
				'label' => esc_html__( 'Tab Header', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 't_h_padding',
			[
				'label'      => esc_html__( 'Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ua-accordion .ua-accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			self::W_NAME . 't_heading_'
		);

		$this->start_controls_tab(
			self::W_NAME . 't_heading_t',
			[
				'label' => __( 'Normal', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			self::W_NAME . 't_h_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f30d55',
				'selectors' => [
					'{{WRAPPER}} .ua-accordion .ua-accordion-header' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 't_h_txt_color',
			[
				'label'     => esc_html__( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ua-accordion .ua-accordion-header' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => self::W_NAME . 't_h_typo',
				'selector' => '{{WRAPPER}} .ua-accordion .ua-accordion-header',
			]
		);

		// $this->add_group_control(
		// \Elementor\Group_Control_Typography::get_type(),
		// [
		// 'name' => 'content_typography',
		// 'selector' => '{{WRAPPER}} .ua-accordion .ua-accordion-header',
		// ]
		// );

		$this->end_controls_tab();

		$this->start_controls_tab(
			self::W_NAME . 't_heading_t_h',
			[
				'label' => __( 'Hover', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			self::W_NAME . 't_h_h_color',
			[
				'label'     => esc_html__( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#5820e5',
				'selectors' => [
					'{{WRAPPER}} .ua-accordion .ua-accordion-header:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 't_h_txt_h_color',
			[
				'label'     => esc_html__( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ua-accordion .ua-accordion-header:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 't_h_border_color',
			[
				'label'     => __( 'Border Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#dddddd',
				'selectors' => [
					'{{WRAPPER}} .ua-accordion .ua-accordion__item:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			self::W_NAME . 't_heading_t_a',
			[
				'label' => __( 'Active', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			self::W_NAME . 't_h_a_color',
			[
				'label'     => esc_html__( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#5820e5',
				'selectors' => [
					'{{WRAPPER}} .ua-accordion .ua-a-active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 't_h_txt_a_color',
			[
				'label'     => esc_html__( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ua-accordion .ua-a-active' => 'color: {{VALUE}};',
				],
			]
		);

		/*
		$this->add_control(
			self::W_NAME . 't_a_border_color',
			[
				'label' => __( 'Border Color', 'ultra-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#5820e5',
				'selectors' => [
					'{{WRAPPER}} .ua-accordion__item:contains-selector(.ua-a-active)' => 'border-color: {{VALUE}};',
				],
			]
		); */

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			self::W_NAME . 'content_sec',
			[
				'label' => esc_html__( 'Tab Content', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			self::W_NAME . 'c_bg_color',
			[
				'label'     => esc_html__( 'Content Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f7f7f7',
				'selectors' => [
					'{{WRAPPER}} .ua-accordion .ua-accordion-body__contents' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			self::W_NAME . 't_c_padding',
			[
				'label'      => esc_html__( 'Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ua-accordion .ua-accordion-body__contents' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . 'tab_c_txt_color',
			[
				'label'     => esc_html__( 'Text Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3b566e',
				'selectors' => [
					'{{WRAPPER}} .ua-accordion .ua-accordion-body__contents' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => self::W_NAME . 't_c_typo',
				// 'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .ua-accordion .ua-accordion-body__contents',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output in the frontend
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$id       = substr( $this->get_id_int(), 0, 3 );

		$this->add_inline_editing_attributes( self::W_NAME . 'title', 'basic' );

		$this->add_render_attribute( 'ua_accordion', 'id', 'ua-accordion-' . esc_attr( $this->get_id() ) );

		?>
		<div class="ua-accordion accordion-<?php echo esc_attr( $this->get_id() ); ?>" <?php echo 'data-accordion-id="' . esc_attr( $this->get_id() ) . '"'; ?> data-speed="<?php echo $settings[ self::W_NAME . 'speed' ]; ?>" <?php echo $this->get_render_attribute_string( 'ua_accordion' ); ?>>
			<?php
			foreach ( $settings[ self::W_NAME . 'accordions' ] as $key => $accordion ) {
				$a_count = $key + 1;

				?>
				<div class="ua-accordion__item" <?php echo $this->get_render_attribute_string( self::W_NAME . 'item' ); ?>>
					<div class="ua-accordion-header 
					<?php
					if ( $accordion[ self::W_NAME . 'default_item' ] == 'yes' ) {
						echo 'ua-a-active';}
					?>
					" <?php echo $this->get_render_attribute_string( self::W_NAME . 'title' ); ?>>
						<?php echo $accordion[ self::W_NAME . 'title' ]; ?> 
						<div class="ua-accordion-icon"><i class="eicon-plus-circle-o"></i></div>
					</div>
					<div class="ua-accordion-body__contents" 
					<?php
					if ( $accordion[ self::W_NAME . 'default_item' ] == 'yes' ) {
						echo 'style="display:block;"';}
					?>
					<?php echo $this->get_render_attribute_string( self::W_NAME . 'contents' ); ?>>
						<?php echo $accordion[ self::W_NAME . 'contents' ]; ?>
					</div>
				</div>
			
				<?php
			}
			?>
		</div>
		<?php
	}
}
