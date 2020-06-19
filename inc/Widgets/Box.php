<?php

/**
 * Box Widget Class
 * 
 * @package Ultra_Addons
 */

namespace UA_Inc\Widgets;

use Elementor\Repeater;
use UA_Inc\Base\Widgets_Base;
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
        return __( 'ua-box', UA_TD);
    }

    /**
     * Retrieve the widgte title
     * 
     * @return string Widget title
     */
    public function get_title()
    {
        return __( 'Box', UA_TD);
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
            UA_TD . '-box',
        ];
    }

    /**
     * Retrieve the list of styles the widget depends on
     */
    public function get_style_depends() {
        return [
            UA_TD . '-style-box',
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

        $this->add_control(
            self::W_NAME . 'b_icon',
            [
                'label' => esc_html__( 'Box Icon', UA_TD ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'box_icon',
                'default' => [
                    'value' => 'eicon-info-box',
                ],
                'default' => [
                    'value' => 'fa fa-th-large',
                    'library' => 'normal',
                ],
            ]
        );

        $this->add_control(
            self::W_NAME . 'b_title',
            [
                'label' => esc_html__( 'Box Title', UA_TD ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Box Title', UA_TD ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            self::W_NAME . 'contents',
            [
                'label' => esc_html__( 'Box Content', UA_TD ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Box Content', UA_TD ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            self::W_NAME . 'box_styles_section',
            [
                'label' => __( 'Styles', UA_TD ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            self::W_NAME . 'box_b'
        );

        $this->start_controls_tab(
            self::W_NAME . 't_heading_t',
            [
                'label' => __( 'Normal', UA_TD )
            ]
        );

        $this->add_control(
            self::W_NAME . 't_h_bg_color',
            [
                'label' => esc_html__( 'Background Color', UA_TD ),
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
                'label' => esc_html__( 'Icon Background Color', UA_TD ),
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
                'label' => __( 'Hover', UA_TD )
            ]
        );

        $this->add_control(
            self::W_NAME . 't_h_h_color',
            [
                'label' => esc_html__( 'Background Color', UA_TD ),
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
                'label' => esc_html__( 'Icon Background Color', UA_TD ),
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
                'label' => __( 'Padding', UA_TD ),
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
                'label' => __( 'Margin', UA_TD ),
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
                'label' => __( 'Border Radius', UA_TD ),
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
                'label' => __( 'Box Icon', UA_TD ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            self::W_NAME . 'icon_alignment__',
            [
                'label' => __( 'Alignment', UA_TD ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', UA_TD ),
                        'icon'  => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => __( 'Center', UA_TD ),
                        'icon'  => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => __( 'Right', UA_TD ),
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
                'label' => __( 'Icon Color', UA_TD ),
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
                'label' => __( 'Margin', UA_TD ),
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
                'label' => esc_html__( 'Border Radius', UA_TD ),
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
                'label' => __( 'Icon Size', UA_TD ),
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
                'label' => __( 'Box Title', UA_TD ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control( 
            self::W_NAME . 'title_color',
            [
                'label' => __( ' Color', UA_TD ),
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
                'label' => __( 'Alignment', UA_TD ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', UA_TD ),
                        'icon'  => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => __( 'Center', UA_TD ),
                        'icon'  => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => __( 'Right', UA_TD ),
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
                'label' => __( 'Margin', UA_TD ),
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
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ua-box__title'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            self::W_NAME . 'box_content_section',
            [
                'label' => __( 'Box Content', UA_TD ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control( 
            self::W_NAME . 'content_color',
            [
                'label' => __( 'Text Color', UA_TD ),
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
                'label' => __( 'Margin', UA_TD ),
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

        $this->add_group_control( 
            Group_Control_Typography::get_type(),
            [
                'name' => self::W_NAME . 'content_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
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

        $box_icon_migrated 	= isset( $item['__fa4_migrated'][self::W_NAME . 'b_icon'] );
		$box_icon_is_new 	= empty( $item['box_icon'] ) && Icons_Manager::is_migration_allowed();
		$has_box_icon 		= ! empty( $settings['box_icon'] ) || ! empty( $settings[ self::W_NAME . 'b_icon']['value'] );
    ?>
        <div class="ua-box">
            
            <div class="ua-box__icon">
                <?php Icons_Manager::render_icon( $settings[ self::W_NAME . 'b_icon'] , [ 'aria-hidden' => 'true' ]);?>
                <?php 
                // Check if its already migrated
                $migrated = isset( $settings['__fa4_migrated'][self::W_NAME . 'b_icon'] );
                // Check if its a new widget without previously selected icon using the old Icon control
                $is_new = empty( $settings['box_icon'] );
                if ( $is_new || $migrated ) {
                    Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                } else {
                    ?>
                    <i class="<?php echo $settings['box_icon']; ?>" aria-hidden="true"></i>
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
