<?php

/**
 * Team Member Widget Class
 * 
 * @package Ultra_Addons
 */

namespace UltraAddons_Inc\Widgets;

use Elementor\Repeater;
use UltraAddons_Inc\Base\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

defined('ABSPATH') || die();

class TeamMember extends Widgets_Base
{
    CONST W_NAME = 'ua_tm_';
    /**
     * Retrieve the widgte name
     * 
     * @return string Widget Name
     */
    public function get_name()
    {
        return __('ua-team-member', 'ultra-addons');
    }

    /**
     * Retrieve the widgte title
     * 
     * @return string Widget title
     */
    public function get_title()
    {
        return __( 'Team Member', 'ultra-addons');
    }

    /**
     * Retrieve the widgte icon
     * 
     * @return string Widget Name
     */
    public function get_icon()
    {
        return 'ua-icon eicon-lock-user';
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
    public function get_script_depends()
    {
        return [
            'ua-team-member',
        ];
    }

    /**
     * Retrieve the list of styles the widget depends on
     */
    public function get_style_depends() {
        return [
            'ua-style-team-member',
        ];
    }

    /**
     * Register the widget controls.
     * 
     * 
     */
    protected function ua_register_controls()
    {
        $this->start_controls_section(
            'content',
            [
                'label' => __( 'Content', 'ultra-addons'),
            ]
        );
        
        $this->add_control(
            'tm_content',
            [
                'label' => __( 'Description', 'ultra-addons' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true
                ],
                'default' => __( 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum delectus, reiciendis dolorum voluptas repellat debitis voluptatem doloremque nisi quasi deleniti et mollitia vero laborum adipisci veniam dignissimos perspiciatis nemo facere?', 'ultra-addons' ) 
            ]
        );

        $this->add_control(
            'tm_m_avatar',
            [
                'label' => __( 'Avatar', 'ultra-addons' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tm_m_avatar_size',
                'default' => 'full',
                'condition' => [
                    'tm_m_avatar[url]!' => ''
                ]
            ]
        );

        $this->add_control(
            'tm_name',
            [
                'label' => __( 'Name', 'ultra-addons' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true
                ],
                'default' => __( 'MH Imon', 'ultra-addons' )
            ]
        );

        $this->add_control(
            'tm_designation',
            [
                'label' => __( 'Designation', 'ultra-addons' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true
                ],
                'default' => __( 'Ownder', 'ultra-addons' )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'social_links_section',
            [
                'label' => __( 'Social Links', 'ultra-addons' )
            ]
        );

        $this->add_control(
            'tm_enable_social_profiles',
            [
                'label' => __( 'Display social profiles?', 'ultra-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $repeater = new Repeater();

        if ( version_compare( ELEMENTOR_VERSION, '2.6.0', '<' ) ) {
            $repeater->add_control(
                'icon',
                [
                    'label' => __( 'Icon', 'ultra-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                    'default' => 'fa fa-github',
                ]
            );

        } else {
            $repeater->add_control(
                's_icon',
                [
                    'label' => __( 'Icon', 'ultra-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'fa fa-facebook',
                        'library' => 'normal',
                    ],
                ]
            );
        }

        $repeater->add_control(
            's_url',
            [
                'label' => __( 'Link', 'ultra-addons' ),
                'label_block' => true,
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                ],
                'placeholder' => __( 'Enter URL here', 'ultra-addons' ),
            ]
        );

        $this->add_control( 
            'social_links',
            [
                'label' => __( 'Social Links', 'ultra-addons' ),
                'condition'   => [
                    'tm_enable_social_profiles!' => ''
                ],
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<i class="{{s_icon}}"></i> {{s_url.url}}',
                'default' => [
                    [
                        'icon' => 'fa fa-facebook',
                        's_url' => 'https://facebook.com/hello.ultradevs'
                    ],
                    [
                        'icon' => 'fa fa-twitter',
                        's_url' => 'https://twitter.com/mh_imon'
                    ]
                ]
            ]
        );

        $this->end_controls_section();

        /** Styles */

        $this->start_controls_section(
            'tm_styles_section',
            [
                'label' => __( 'General Styles', 'ultra-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        if( ultra_addons_fs()->can_use_premium_code() ) {
            $this->add_control(
                'tm_style',
                [
                    'label' => __( 'Style Preset', 'ultra-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'tm__s1',
                    'options' => [
                        'tm__s1' => 'Default',
                    ]
                ]
            );
        }
        else {
            $this->add_control(
                'tm_style',
                [
                    'label' => __( 'Style Preset', 'ultra-addons' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'tm__s1',
                    'options' => [
                        'tm__s1' => 'Default',
                    ],
                    'description' => __( sprintf( 'Upgrade to <a href="%s" target="_blank">Pro Version</a>', ultra_addons_fs()->get_upgrade_url() ), 'ultra-addons' ),
                ]
            );
        }

        $this->start_controls_tabs(
            self::W_NAME . 'tm_b'
        );

        $this->start_controls_tab(
            self::W_NAME . 't_heading_t',
            [
                'label' => __( 'Normal', 'ultra-addons' )
            ]
        );

        $this->add_control(
            self::W_NAME . 't_h_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ua-team-members' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => self::W_NAME . 'box_box-shadow',
                'selector' => '{{WRAPPER}} .ua-team-members',
                'fields_option' => [
                    'box_shadow_type' => [
                        'default' => 'yes',
                    ],
                    'box_shadow' => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical' => '19px',
                            'blur' => '38px',
                            'spread' => 3,
                            'color' => 'rgba(0, 0, 0, 0.10)'
                        ]
                    ]
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            self::W_NAME . 't_heading_t_h',
            [
                'label' => __( 'Hover', 'ultra-addons' )
            ]
        );

        $this->add_control(
            self::W_NAME . 't_h_h_color',
            [
                'label' => esc_html__( 'Background Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f7f7f7',
                'selectors' => [
                    '{{WRAPPER}} .ua-team-members:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => self::W_NAME . 'box_box-shadow_hover',
                'selector' => '{{WRAPPER}} .ua-team-members:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();



        $this->add_control(
            self::W_NAME . 'padding',
            [
                'label' => __( 'Padding', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ua-team-members' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            self::W_NAME . '_margin',
            [
                'label' => __( 'Margin', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ua-team-members' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            self::W_NAME . '_radius',
            [
                'label' => __( 'Border Radius', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'px' => 10
                ],
                'selectors' => [
                    '{{WRAPPER}} .ua-team-members' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->end_controls_section();

        $this->start_controls_section(
            'tm_avatar',
            [
                'label' => __( 'Avatar', 'ultra-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'a_width',
			[
				'label' => __( 'Width', 'ultra-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 110,
				],
				'selectors' => [
					'{{WRAPPER}} .ua-tm__avatar img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_control(
			'a_height',
			[
				'label' => __( 'Height', 'ultra-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 110,
				],
				'selectors' => [
					'{{WRAPPER}} .ua-tm__avatar img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
        );
        
        $this->add_responsive_control(
            'a_alignment',
            [
                'label' => __( 'Alignment', 'ultra-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => __( 'Center', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => __( 'Right', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-right'
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .ua-tm__avatar' => ' text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'a_radius',
            [
                'label' => __( 'Border Radius', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    '%' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .ua-tm__avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tm_name_style',
            [
                'label' => __( 'Name', 'ultra-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tm_name_style_color',
            [
                'label' => esc_html__( 'Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .ua-tm__info h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'name_alignment__',
            [
                'label' => __( 'Alignment', 'ultra-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => __( 'Center', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => __( 'Right', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-right'
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .ua-tm__info h3' => ' text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tm_item_name_padding',
            [
                'label' => __( 'Padding', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ua-tm__info h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tm_name_style_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ua-tm__info h3',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tm_designation_style',
            [
                'label' => __( 'Designation', 'ultra-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tm_designation_style_color',
            [
                'label' => esc_html__( 'Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#312b2b',
                'selectors' => [
                    '{{WRAPPER}} .ua-tm__info h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desi_alignment__',
            [
                'label' => __( 'Alignment', 'ultra-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => __( 'Center', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => __( 'Right', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-right'
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .ua-tm__info h4' => ' text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tm_item_des_padding',
            [
                'label' => __( 'Padding', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ua-tm__info h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tm_designation_style_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .ua-tm__info h4',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tm_content_style',
            [
                'label' => __( 'Content', 'ultra-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tm_content_style_color_txt',
            [
                'label' => esc_html__( 'Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#312b2b',
                'selectors' => [
                    '{{WRAPPER}} .ua-tm__info p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_alignment',
            [
                'label' => __( 'Alignment', 'ultra-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => __( 'Center', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => __( 'Right', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-right'
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .ua-tm__info p' => ' text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tm_item_content_padding',
            [
                'label' => __( 'Padding', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ua-tm__info p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tm_content_style_typo_t',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .ua-tm__info p',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tm_more_info_style',
            [
                'label' => __( 'Social Icon', 'ultra-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tm_more_info_style_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#7e57c2',
                'selectors' => [
                    '{{WRAPPER}} .ua-t-m .ua-tm__bottom' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tm_more_info_style_color_txt_a',
            [
                'label' => esc_html__( 'Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ua-t-m .ua-tm__bottom' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

    /**
     * Render the widget output in the frontend
     * 
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes( 'tm_name', 'basic' );
        $this->add_inline_editing_attributes( 'tm_designation', 'basic' );
        $this->add_inline_editing_attributes( 'tm_content', 'advanced' );

        $this->add_render_attribute( 'tm_m_avatar', 'src', $settings['tm_m_avatar']['url'] );
        $this->add_render_attribute( 'tm_m_avatar', 'alt', Control_Media::get_image_alt( $settings['tm_m_avatar'] ) );

?>
        <div class="ua-team-members" id="ua-tm-<?php echo esc_attr($this->get_id()); ?>">
            <div class="ua-t-m <?php echo $settings['tm_style'];?>">
                <div class="ua-tm__avatar">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'tm_m_avatar_size', 'tm_m_avatar' ); ?>
                </div>
                <div class="ua-tm__info">
                    <h3 <?php $this->print_render_attribute_string('tm_name'); ?>><?php echo $settings['tm_name'];?></h3>
                    <h4 <?php $this->print_render_attribute_string('tm_designation'); ?>><?php echo $settings['tm_designation'];?></h4>
                    <p <?php $this->print_render_attribute_string('tm_content'); ?>><?php echo $settings['tm_content'];?></p>
                </div>
                <?php
                    if ( 'yes' == $settings['tm_enable_social_profiles'] ) {
                ?>
                <div class="ua-tm__bottom">
                    <div class="ua-tm__social"> 
                        <ul>
                        <?php
                            foreach ( $settings['social_links'] as $social_link ) {
                        ?>
                            <li><a href="<?php echo esc_attr( $social_link['s_url']['url']);?>" <?php echo esc_attr( $social_link['s_url']['is_external']) ? ' target="_blank"' : ''; echo $social_link['s_url']['nofollow'] ? ' rel="nofollow"' : ''; ?>>
                            <?php 
                                // Check if its already migrated
                                $migrated = isset( $social_link['__fa4_migrated']['s_icon'] );
                                // Check if its a new widget without previously selected icon using the old Icon control
                                $is_new = empty( $social_link['icon'] );
                                if ( $is_new || $migrated ) {
                                    Icons_Manager::render_icon( $social_link['s_icon'], [ 'aria-hidden' => 'true' ] );
                                } else {
                                    ?>
                                    <i class="<?php echo $social_link['icon']; ?>" aria-hidden="true"></i>
                                    <?php
                                }
                                ?></a></li>
                        <?php 
                            }
                        ?>
                        </ul>
                    </div>
                </div>
                <?php 
                    }
                ?>
            </div>
        </div>
    <?php
    }
    
}
