<?php

/**
 * Team Members Carousel Widget Class
 *
 * @package Ultra_Elementor_Addons
 */

namespace UltraElementorAddons\Widgets;

use Elementor\Repeater;
use UltraElementorAddons\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

defined( 'ABSPATH' ) || die();

class Team_Members_Carousel extends Widgets_Base {

	const W_NAME = 'ua_tmc_';

	/**
	 * Retrieve the widget name
	 *
	 * @return string Widget Name
	 */
	public function get_name() {
		return __( 'ua-team-members-carousel', 'ultra-elementor-addons' );
	}

	/**
	 * Retrieve the widget title
	 *
	 * @return string Widget title
	 */
	public function get_title() {
		return __( 'Team Members Carousel', 'ultra-elementor-addons' );
	}

	/**
	 * Retrieve the widget icon
	 *
	 * @return string Widget Name
	 */
	public function get_icon() {
		return 'ua-icon eicon-person';
	}

	/**
	 * Widget Category
	 *
	 * @return array Widget categories
	 */
	public function get_categories() {
		return [ 'ultra_addons_pro_category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depends on.
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [
			'ua-team-members-carousel',
		];
	}

	/**
	 * Retrieve the list of styles the widget depends on
	 */
	public function get_style_depends() {
		return [
			'ua-style-team-members-carousel',
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
		$tmc_repeater = new Repeater();

		$tmc_repeater->add_control(
			'tm_u_link',
			[
				'label'   => __( 'Member Info Link', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$tmc_repeater->add_control(
			'tm_content',
			[
				'label'   => __( 'Description', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum delectus, reiciendis dolorum voluptas repellat debitis voluptatem doloremque nisi quasi deleniti et mollitia vero laborum adipisci veniam dignissimos perspiciatis nemo facere?', 'ultra-elementor-addons' ),
			]
		);

		$tmc_repeater->add_control(
			'tm_m_avatar',
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

		$tmc_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'tm_m_avatar_size',
				'default'   => 'full',
				'condition' => [
					'tm_m_avatar[url]!' => '',
				],
			]
		);

		$tmc_repeater->add_control(
			'tm_name',
			[
				'label'   => __( 'Name', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'MH Imon', 'ultra-elementor-addons' ),
			]
		);

		$tmc_repeater->add_control(
			'tm_designation',
			[
				'label'   => __( 'Designation', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Owner', 'ultra-elementor-addons' ),
			]
		);

		$tmc_repeater->add_control(
			'tmc_enable_social_profiles',
			[
				'label'   => __( 'Display social profiles?', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$tmc_repeater->add_control(
			'tmc_s_fb',
			[
				'label'       => __( 'Facebook URL', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'default'     => [
					'url'         => 'https://facebook.com/hello.ultradevs',
					'is_external' => true,
				],
				'condition'   => [
					'tmc_enable_social_profiles!' => '',
				],
				'label_block' => true,
			]
		);

		$tmc_repeater->add_control(
			'tmc_s_twitter',
			[
				'label'       => __( 'Twitter URL', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'default'     => [
					'url'         => 'https://twitter.com/mh_imon',
					'is_external' => true,
				],
				'condition'   => [
					'tmc_enable_social_profiles!' => '',
				],
				'label_block' => true,
			]
		);

		$tmc_repeater->add_control(
			'tmc_s_instagram',
			[
				'label'       => __( 'Instagram URL', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'default'     => [
					'url'         => 'https://instagram.com/mahbub.hasan.imon',
					'is_external' => true,
				],
				'condition'   => [
					'tmc_enable_social_profiles!' => '',
				],
				'label_block' => true,
			]
		);

		$tmc_repeater->add_control(
			'tmc_s_linked_in',
			[
				'label'       => __( 'Linkedin URL', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'default'     => [
					'url'         => 'https://www.linkedin.com/in/mhimon/',
					'is_external' => true,
				],
				'condition'   => [
					'tmc_enable_social_profiles!' => '',
				],
				'label_block' => true,
			]
		);

		$tmc_repeater->add_control(
			'tmc_s_dribbble',
			[
				'label'       => __( 'Dribbble URL', 'ultra-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'default'     => [
					'url'         => 'https://dribbble.com/',
					'is_external' => true,
				],
				'condition'   => [
					'tmc_enable_social_profiles!' => '',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'teammembers',
			[
				'type'         => Controls_Manager::REPEATER,
				'default'      => [
					[
						'tm_content'     => __( 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora, illo? ', 'ultra-elementor-addons' ),
						'tm_name'        => __( 'MH Imon', 'ultra-elementor-addons' ),
						'tm_designation' => __( 'Founder', 'ultra-elementor-addons' ),
					],
					[
						'tm_content'     => __( 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora, illo?', 'ultra-elementor-addons' ),
						'tm_name'        => __( 'Imran Khan', 'ultra-elementor-addons' ),
						'tm_designation' => __( 'Support Engineer', 'ultra-elementor-addons' ),
					],
					[
						'tm_content'     => __( 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora, illo?', 'ultra-elementor-addons' ),
						'tm_name'        => __( 'Sohag SRZ', 'ultra-elementor-addons' ),
						'tm_designation' => __( 'Software Engineer', 'ultra-elementor-addons' ),
					],
				],
				'fields'       => $tmc_repeater->get_controls(),
				'title_fileds' => ' {{{ tm_name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slide_settings',
			[
				'label' => __( 'Carousel Settings', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'tmc_i_spv',
			[
				'label'   => __( 'Slides Per View ', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
				],
			]
		);

		$this->add_control(
			'tmc_i_scroll',
			[
				'label'   => __( 'Items to scroll', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
					'5' => 5,
				],
			]
		);

		$this->add_control(
			'tmc_show_navs',
			[
				'label'   => __( 'Show Navs?', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'tmc_show_dots',
			[
				'label'   => __( 'Show Dots?', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'tmv_i_autoplay',
			[
				'label'   => __( 'Autoplay?', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'tmv_i_autoplay_speed',
			[
				'label'   => __( 'Autoplay Speed', 'ultra-elementor-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '2000',
			]
		);

		$this->end_controls_section();

		/** Styles */

		$this->start_controls_section(
			'tmc_styles_section',
			[
				'label' => __( 'General Styles', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		if ( ultra_addons_fs()->can_use_premium_code() ) {
			$this->add_control(
				'tm_style',
				[
					'label'   => __( 'Style Preset', 'ultra-elementor-addons' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'tm__s1',
					'options' => [
						'tm__s1' => 'Default',
					],
				]
			);
		} else {
			$this->add_control(
				'tm_style',
				[
					'label'       => __( 'Style Preset', 'ultra-elementor-addons' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'tm__s1',
					'options'     => [
						'tm__s1' => 'Default',
					],
					'description' => __( sprintf( 'Upgrade to <a href="%s" target="_blank">Pro Version</a>', ultra_addons_fs()->get_upgrade_url() ), 'ultra-elementor-addons' ),
				]
			);
		}

		$this->add_control(
			'tmc_item_padding',
			[
				'label'      => __( 'Item Spacing', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'unit'     => 'px',
					'top'      => 30,
					'right'    => 10,
					'bottom'   => 50,
					'left'     => 10,
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .ua-team-members-c' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 4em {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			self::W_NAME . 'tm_b'
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
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ua-team-members-c' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => self::W_NAME . 'box_box-shadow',
				'selector'      => '{{WRAPPER}} .ua-team-members-c',
				'fields_option' => [
					'box_shadow_type' => [
						'default' => 'yes',
					],
					'box_shadow'      => [
						'default' => [
							'horizontal' => 0,
							'vertical'   => '19px',
							'blur'       => '38px',
							'spread'     => 3,
							'color'      => 'rgba(0, 0, 0, 0.10)',
						],
					],
				],

			]
		);

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
				'default'   => '#f7f7f7',
				'selectors' => [
					'{{WRAPPER}} .ua-team-members-c:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => self::W_NAME . 'box_box-shadow_hover',
				'selector' => '{{WRAPPER}} .ua-team-members-c:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			self::W_NAME . 'padding',
			[
				'label'      => __( 'Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ua-team-members-c' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			self::W_NAME . '_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'px' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .ua-team-members-c' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->end_controls_section();

		$this->start_controls_section(
			'tm_avatar',
			[
				'label' => __( 'Avatar', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'a_width',
			[
				'label'      => __( 'Width', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 110,
				],
				'selectors'  => [
					'{{WRAPPER}} .ua-tm__avatar img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'a_height',
			[
				'label'      => __( 'Height', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 110,
				],
				'selectors'  => [
					'{{WRAPPER}} .ua-tm__avatar img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'a_alignment',
			[
				'label'     => __( 'Alignment', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'ultra-elementor-addons' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'ultra-elementor-addons' ),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end'   => [
						'title' => __( 'Right', 'ultra-elementor-addons' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .ua-tm__avatar' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'a_radius',
			[
				'label'      => __( 'Border Radius', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'%' => 100,
				],
				'selectors'  => [
					'{{WRAPPER}} .ua-tm__avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tm_name_style',
			[
				'label' => __( 'Name', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tm_name_style_color',
			[
				'label'     => esc_html__( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => [
					'{{WRAPPER}} .ua-tm__info h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'name_alignment__',
			[
				'label'     => __( 'Alignment', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'ultra-elementor-addons' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ultra-elementor-addons' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ultra-elementor-addons' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .ua-tm__info h3' => ' text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tm_item_name_padding',
			[
				'label'      => __( 'Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ua-tm__info h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tm_name_style_typo',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ua-tm__info h3',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tm_designation_style',
			[
				'label' => __( 'Designation', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tm_designation_style_color',
			[
				'label'     => esc_html__( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#312b2b',
				'selectors' => [
					'{{WRAPPER}} .ua-tm__info h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'desi_alignment__',
			[
				'label'     => __( 'Alignment', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'ultra-elementor-addons' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ultra-elementor-addons' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ultra-elementor-addons' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .ua-tm__info h4' => ' text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tm_item_des_padding',
			[
				'label'      => __( 'Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ua-tm__info h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tm_designation_style_typo',
				'scheme'   => Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .ua-tm__info h4',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tm_content_style',
			[
				'label' => __( 'Content', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tm_content_style_color_txt',
			[
				'label'     => esc_html__( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#312b2b',
				'selectors' => [
					'{{WRAPPER}} .ua-tm__info p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'desc_alignment',
			[
				'label'     => __( 'Alignment', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'ultra-elementor-addons' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ultra-elementor-addons' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ultra-elementor-addons' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .ua-tm__info p' => ' text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tm_item_content_padding',
			[
				'label'      => __( 'Padding', 'ultra-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ua-tm__info p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tm_content_style_typo_t',
				'scheme'   => Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .ua-tm__info p',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tm_more_info_style',
			[
				'label' => __( 'Social Icon', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tm_more_info_style_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7e57c2',
				'selectors' => [
					'{{WRAPPER}} .ua-t-m .ua-tm__bottom' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tm_more_info_style_color_txt_a',
			[
				'label'     => esc_html__( 'Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ua-t-m .ua-tm__bottom' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tmc_nav_dot_section',
			[
				'label' => __( 'Navs & Dots', 'ultra-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'tmc_navs_dots_c'
		);

		$this->start_controls_tab(
			'tmc_md_c_n',
			[
				'label' => __( 'Normal', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'tmc_nav_bg_c',
			[
				'label'     => __( 'Nav Backgorund', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#5820e5',
				'selectors' => [
					'{{WRAPPER}} .ua-tm-carousel-c .slick-prev, 
                    {{WRAPPER}} .slick-next' => 'background: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'tmc_dot_bg_c',
			[
				'label'     => __( 'Dot Backgorund', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#5820e5',
				'selectors' => [
					'{{WRAPPER}} ul.slick-dots li' => 'background-color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'tmc_nav_txt_c',
			[
				'label'     => __( 'Nav Arrow Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ua-tm-carousel-c .slick-prev, {{WRAPPER}} .slick-next' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tmc_md_c_h',
			[
				'label' => __( 'Hover', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'tmc_nav_bg_c_h',
			[
				'label'     => __( 'Nav Backgorund', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f30d55',
				'selectors' => [
					'{{WRAPPER}} .ua-tm-carousel-c .slick-prev:hover, {{WRAPPER}} .slick-next:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'tmc_dot_bg_c_h',
			[
				'label'     => __( 'Dot Backgorund', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f30d55',
				'selectors' => [
					'{{WRAPPER}} ul.slick-dots li' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'tmc_nav_txt_c_h',
			[
				'label'     => __( 'Nav Arrow Color', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ua-tm-carousel-c .slick-prev:hover, {{WRAPPER}} .slick-next:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tmc_md_c_a',
			[
				'label' => __( 'Active', 'ultra-elementor-addons' ),
			]
		);

		$this->add_control(
			'tmc_dot_bg_c_a',
			[
				'label'     => __( 'Dot Backgorund', 'ultra-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f30d55',
				'selectors' => [
					'{{WRAPPER}} ul.slick-dots li.slick-active' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render the widget output in the frontend
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'tm_name', 'basic' );
		$this->add_inline_editing_attributes( 'tm_designation', 'basic' );
		$this->add_inline_editing_attributes( 'tm_content', 'advanced' );
		?>
		<style>
			.ua-tm-carousel-c .slick-prev, .slick-next{ display: 
			<?php
			if ( 'yes' == $settings['tmc_show_navs'] ) {
				echo 'block';
			} else {
				echo 'none';}
			?>
			!important; }
			.ua-tm-carousel-c ul.slick-dots{ display: 
			<?php
			if ( 'yes' == $settings['tmc_show_dots'] ) {
				echo 'block';
			} else {
				echo 'none';}
			?>
			!important; }
		</style>
		<div class="ua-tm-carousel" id="ua-tm-carousel-<?php echo esc_attr( $this->get_id() ); ?>" data-slides="<?php echo isset( $settings['tmc_i_spv'] ) ? $settings['tmc_i_spv'] : 3; ?>" data-scroll="<?php echo isset( $settings['tmc_i_scroll'] ) ? $settings['tmc_i_scroll'] : 1; ?>" data-autoplay="
																	<?php
																	if ( $settings['tmv_i_autoplay'] == true ) {
																		echo true;
																	} else {
																		echo false; }
																	?>
		" data-autoplay-speed="<?php echo isset( $settings['tmv_i_autoplay_speed'] ) ? $settings['tmv_i_autoplay_speed'] : 2000; ?>">
			<div class="slider ua-tm-carousel-c">
				<?php
				foreach ( $settings['teammembers'] as $teammember ) {
					$this->add_render_attribute( 'tm_m_avatar', 'src', $teammember['tm_m_avatar']['url'] );
					$this->add_render_attribute( 'tm_m_avatar', 'alt', Control_Media::get_image_alt( $teammember['tm_m_avatar'] ) );

					$target   = $teammember['tm_u_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $teammember['tm_u_link']['nofollow'] ? ' rel="nofollow"' : '';
					?>
						<div class="ua-team-members-c" id="ua-tm-<?php echo esc_attr( $this->get_id() ); ?>">
							<a href="<?php echo $teammember['tm_u_link']['url']; ?>" <?php echo $target . $nofollow; ?>>
								<div class="ua-t-m <?php echo $settings['tm_style']; ?>">
									<div class="ua-tm__avatar">
									<?php echo Group_Control_Image_Size::get_attachment_image_html( $teammember, 'tm_m_avatar_size', 'tm_m_avatar' ); ?>
									</div>
									<div class="ua-tm__info">
										<h3 <?php $this->print_render_attribute_string( 'tm_name' ); ?>><?php echo $teammember['tm_name']; ?></h3>
										<h4 <?php $this->print_render_attribute_string( 'tm_designation' ); ?>><?php echo $teammember['tm_designation']; ?></h4>
										<p <?php $this->print_render_attribute_string( 'tm_content' ); ?>><?php echo $teammember['tm_content']; ?></p>
									</div>
								<?php
								if ( 'yes' == $teammember['tmc_enable_social_profiles'] ) {
									?>
									<div class="ua-tm__bottom">
										<div class="ua-tm__social"> 
											<ul>
												<li><a href="<?php echo $teammember['tmc_s_fb']['url']; ?>" 
																		<?php
																		echo $teammember['tmc_s_fb']['is_external'] ? ' target="_blank"' : '';
																		echo $teammember['tmc_s_fb']['nofollow'] ? ' rel="nofollow"' : '';
																		?>
												><i class="fab fa-facebook"></i></a></li>
												<li><a href="<?php echo $teammember['tmc_s_twitter']['url']; ?>" 
																		<?php
																		echo $teammember['tmc_s_twitter']['is_external'] ? ' target="_blank"' : '';
																		echo $teammember['tmc_s_twitter']['nofollow'] ? ' rel="nofollow"' : '';
																		?>
												><i class="fab fa-twitter"></i></a></li>
												<li><a href="<?php echo $teammember['tmc_s_instagram']['url']; ?>" 
																		<?php
																		echo $teammember['tmc_s_instagram']['is_external'] ? ' target="_blank"' : '';
																		echo $teammember['tmc_s_instagram']['nofollow'] ? ' rel="nofollow"' : '';
																		?>
												><i class="fab fa-instagram"></i></a></li>
												<li><a href="<?php echo $teammember['tmc_s_linked_in']['url']; ?>" 
																		<?php
																		echo $teammember['tmc_s_linked_in']['is_external'] ? ' target="_blank"' : '';
																		echo $teammember['tmc_s_linked_in']['nofollow'] ? ' rel="nofollow"' : '';
																		?>
												><i class="fab fa-linkedin"></i></a></li>
												<li><a href="<?php echo $teammember['tmc_s_dribbble']['url']; ?>" 
																		<?php
																		echo $teammember['tmc_s_dribbble']['is_external'] ? ' target="_blank"' : '';
																		echo $teammember['tmc_s_dribbble']['nofollow'] ? ' rel="nofollow"' : '';
																		?>
												><i class="fab fa-dribbble"></i></a></li>
											</ul>
										</div>
									</div>
									<?php
								}
								?>
								</div>
							</a>
						</div>
						<?php
				}
				?>
			</div>
			
		</div>
		<?php
	}
}
