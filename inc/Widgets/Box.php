<?php

/**
 * Box Widget Class
 * 
 * @package Ultra_Addons
 */

namespace UltraAddons_Inc\Widgets;

use Elementor\Repeater;
use UltraAddons_Inc\Base\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

defined('ABSPATH') || die();

class Box extends Widgets_Base
{
    CONST W_NAME = 'ua_box_';
    /**
     * Retrieve the widgte name
     * 
     * @return string Widget Name
     */
    public function get_name()
    {
        return __( 'ua-box', 'ultra-addons');
    }

    /**
     * Retrieve the widgte title
     * 
     * @return string Widget title
     */
    public function get_title()
    {
        return __( 'Box', 'ultra-addons');
    }

    /**
     * Retrieve the widgte icon
     * 
     * @return string Widget Name
     */
    public function get_icon()
    {
        return 'ua-icon eicon-info-box';
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
            'ua-box',
        ];
    }

    /**
     * Retrieve the list of styles the widget depends on
     */
    public function get_style_depends() {
        return [
            'ua-style-box',
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
            self::W_NAME . 'box_content_sections',
            [
                'label' => __( 'Content')
            ]
        ); 

        if ( version_compare( ELEMENTOR_VERSION, '2.6.0', '<' ) ) {
            $this->add_control(
                'icon',
                [
                    'label' => esc_html__( 'Box Icon', 'ultra-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                    'default' => 'fa fa-th-large',
                ]
            );

        } else {
            $this->add_control(
                'b_icon',
                [
                    'label' => esc_html__( 'Box Icon', 'ultra-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'box_icon',
                    'default' => [
                        'value' => 'fa fa-th-large',
                        'library' => 'normal',
                    ],
                ]
            );
        }

        $this->add_control(
            self::W_NAME . 'b_title',
            [
                'label' => esc_html__( 'Box Title', 'ultra-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Box Title', 'ultra-addons' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            self::W_NAME . 'contents',
            [
                'label' => esc_html__( 'Box Content', 'ultra-addons' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Box Content', 'ultra-addons' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            self::W_NAME . 'box_styles_section',
            [
                'label' => __( 'Styles', 'ultra-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            self::W_NAME . 'box_b'
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
                'default' => '#f30d55',
                'selectors' => [
                    '{{WRAPPER}} .ua-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            self::W_NAME . 'i_h_bg_color',
            [
                'label' => esc_html__( 'Icon Background Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f30d55',
                'selectors' => [
                    '{{WRAPPER}} .ua-box__icon i' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => self::W_NAME . 'box_box-shadow',
                'selector' => '{{WRAPPER}} .ua-box',
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
                'default' => '#5820e5',
                'selectors' => [
                    '{{WRAPPER}} .ua-box:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            self::W_NAME . 'i_h_h_bg_color',
            [
                'label' => esc_html__( 'Icon Background Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#5820e5',
                'selectors' => [
                    '{{WRAPPER}} .ua-box:hover .ua-box__icon i' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => self::W_NAME . 'box_box-shadow_hover',
                'selector' => '{{WRAPPER}} .ua-box:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            self::W_NAME . 'box_padding',
            [
                'label' => __( 'Padding', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ua-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            self::W_NAME . 'box_margin',
            [
                'label' => __( 'Margin', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ua-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            self::W_NAME . 'box_radius',
            [
                'label' => __( 'Border Radius', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'px' => 5
                ],
                'selectors' => [
                    '{{WRAPPER}} .ua-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            self::W_NAME . 'box_icon_section',
            [
                'label' => __( 'Box Icon', 'ultra-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            self::W_NAME . 'icon_alignment__',
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
                    '{{WRAPPER}} .ua-box__icon' => 'float:{{VALUE}}; text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control( 
            self::W_NAME . 'icon_color',
            [
                'label' => __( 'Icon Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ua-box__icon i' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control( 
            self::W_NAME . 'icon_mr',
            [
                'label' => __( 'Margin', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ua-box__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'default' => [
                    'isLinked' => false,
                ]
            ]
        );

        $this->add_control(
            self::W_NAME . 'i_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ua-box__icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => self::W_NAME . 'box_i_box-shadow',
                'selector' => '{{WRAPPER}} .ua-box__icon i',
            ]
        );

        $this->add_responsive_control( 
            self::W_NAME . 'icon_size',
            [
                'label' => __( 'Icon Size', 'ultra-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 25,
                        'max' => 200,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .ua-box__icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            self::W_NAME . 'box_title_section',
            [
                'label' => __( 'Box Title', 'ultra-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control( 
            self::W_NAME . 'title_color',
            [
                'label' => __( ' Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ua-box__title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            self::W_NAME . 'title_alignment__',
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
                    '{{WRAPPER}} .ua-box__title' => ' text-align: {{VALUE}};',
                ]
            ]
        );


        $this->add_responsive_control( 
            self::W_NAME . 'title_mr',
            [
                'label' => __( 'Margin', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ua-box__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'default' => [
                    'isLinked' => false,
                ]
            ]
        );

        $this->add_group_control( 
            Group_Control_Typography::get_type(),
            [
                'name' => self::W_NAME . 'title_typo',
                // 'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ua-box__title'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            self::W_NAME . 'box_content_section',
            [
                'label' => __( 'Box Content', 'ultra-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control( 
            self::W_NAME . 'content_color',
            [
                'label' => __( 'Text Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ua-box__content' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control( 
            self::W_NAME . 'contents_mr',
            [
                'label' => __( 'Margin', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ua-box__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'default' => [
                    'isLinked' => false,
                ]
            ]
        );

        $this->add_responsive_control(
            self::W_NAME . 'con_alignment__',
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
                    '{{WRAPPER}} .ua-box__content' => ' text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control( 
            Group_Control_Typography::get_type(),
            [
                'name' => self::W_NAME . 'content_typo',
                // 'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .ua-box__content'
                
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render the widget output in the frontend
     * 
     */
    protected function render( $item = false)
    {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes( self::W_NAME . 'b_title', 'basic');
        // Check if its already migrated
        $migrated = isset( $settings['__fa4_migrated']['b_icon'] );
        // Check if its a new widget without previously selected icon using the old Icon control
        $is_new = empty( $settings['icon'] );
	
    ?>
        <div class="ua-box">
            <div class="ua-box__icon">
                <?php 
                if ( $is_new || $migrated ) {
                    Icons_Manager::render_icon( $settings['b_icon'], [ 'aria-hidden' => 'true' ] );
                } else {
                    ?>
                    <i class="<?php echo $settings['icon']; ?>" aria-hidden="true"></i>
                    <?php
                }
                ?>
            </div>
            <h4 class="ua-box__title" <?php $this->get_render_attribute_string( self::W_NAME . 'b_title'); ?>>
                <?php echo $settings[ self::W_NAME . 'b_title' ];?>
            </h4>
            <div class="ua-box__content">
                <?php echo $settings[ self::W_NAME . 'contents' ];?>
            </div>
        </div>    
    <?php
    }
    
}
