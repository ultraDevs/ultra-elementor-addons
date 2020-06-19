<?php

/**
 * Testimonial Carousel Widget Class
 * 
 * @package Ultra_Addons
 */

namespace UA_Inc\Widgets;

use Elementor\Repeater;
use UA_Inc\Base\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

defined('ABSPATH') || die();

class Testimonial_carousel extends Widgets_Base
{
    CONST W_NAME = 'ua_testimonial_';
    /**
     * Retrieve the widgte name
     * 
     * @return string Widget Name
     */
    public function get_name()
    {
        return 'ua-testimonial-carousel';
    }

    /**
     * Retrieve the widgte title
     * 
     * @return string Widget title
     */
    public function get_title()
    {
        return __( 'Testimonial Carousel', UA_TD);
    }

    /**
     * Retrieve the widgte icon
     * 
     * @return string Widget Name
     */
    public function get_icon()
    {
        return 'ua-icon eicon-testimonial-carousel';
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
     * Retrieve the list of scripts the widget depened on.
     * 
     * @return array Widget scripts dependies.
     */
    public function get_script_depends()
    {
        return [
            UA_TD . '-testimonial-carousel',
        ];
    }

    /**
     * Retrieve the list of styles the widget depends on
     */
    public function get_style_depends() {
        return [
            UA_TD . '-style-testimonial-carousel',
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
                'label' => __( 'Content', UA_TD),
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            't_content',
            [
                'label' => __( 'Description', UA_TD ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Testimonial Content', UA_TD ),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $repeater->add_control(
            't_author_avatar',
            [
                'label' => __( 'Avatar', UA_TD ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $repeater->add_control(
            't_author',
            [
                'label' => __( 'Name', UA_TD ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Name', UA_TD ),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $repeater->add_control(
            't_a_title',
            [
                'label' => __( 'Title', UA_TD ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Title', UA_TD ),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        't_conten' => __( 'Testimonial Content 1', UA_TD ),
                        't_author' => __( 'MH Imon', UA_TD ),
                        't_a_title' => __( 'ultraDevs', UA_TD ),
                    ],
                    [
                        't_conten' => __( 'Testimonial Content 2', UA_TD ),
                        't_author' => __( 'MH Imon', UA_TD ),
                        't_a_title' => __( 'ultraDevs', UA_TD ),
                    ],
                    [
                        't_conten' => __( 'Testimonial Content 3', UA_TD ),
                        't_author' => __( 'MH Imon', UA_TD ),
                        't_a_title' => __( 'ultraDevs', UA_TD ),
                    ]
                ],
                'fields' => array_values( $repeater->get_controls()),
                
            ]
        );

        $this->add_control(
            'i_desktop',
            [
                'label' => __( 'Slide Per View ( Desktop) ', UA_TD ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4
                ]
            ]
        );

        $this->add_control(
            'i_mobile',
            [
                'label' => __( 'Slide Per View ( Mobile) ', UA_TD ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4
                ]
            ]
        );

        $this->add_control(
            'i_tablet',
            [
                'label' => __( 'Slide Per View ( Tablet) ', UA_TD ),
                'type' => Controls_Manager::SELECT,
                'default' => '2',
                'options' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4
                ]
            ]
        );

        $this->add_control(
            'show_navs',
            [
                'label' => __( 'Show Navs?', UA_TD ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'label' => __( 'Show Dots?', UA_TD ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        /** Styles */

        $this->start_controls_section(
            't_styles_section',
            [
                'label' => __( 'Styles', UA_TD ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            't_heading_'
        );

        $this->start_controls_tab(
            't_heading_t',
            [
                'label' => __( 'Normal', UA_TD )
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', UA_TD ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .t_item .t_txt',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box-shadow-n',
                'selector' => '{{WRAPPER}} .ua-testimonial-c .t_item .t_txt',
            ]
        );

        $this->add_control(
            'ta_bg_color',
            [
                'label' => esc_html__( 'Triangle Arrow Background', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f30d55',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .center .t_txt::after' => 'border-top: 30px solid {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            't_heading_t_h',
            [
                'label' => __( 'Hover', UA_TD )
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background-hover',
                'label' => esc_html__( 'Background', UA_TD ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ua-testimonial-c .t_item:hover .t_txt',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box-shadow-h',
                'selector' => '{{WRAPPER}} .ua-testimonial-c .t_item:hover .t_txt',
            ]
        );

        $this->add_control(
            'ta_bg_h_color',
            [
                'label' => esc_html__( 'Triangle Arrow Background', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f30d55',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .t_item:hover .t_txt::after' => 'border-top: 30px solid {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            't_heading_t_a',
            [
                'label' => __( 'Active', UA_TD )
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background-active',
                'label' => esc_html__( 'Background', UA_TD ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ua-testimonial-c .center .t_txt',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box-shadow-a',
                'selector' => '{{WRAPPER}} .ua-testimonial-c .center .t_txt',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            't_content_style',
            [
                'label' => __( 'Content', UA_TD ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            't_content_txt_color_i',
            [
                'label' => esc_html__( 'Color ( Inactive )', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#6f8ba4',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .t_item .t_txt,{{WRAPPER}} .t_item:hover .t_txt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            't_content_txt_color_a',
            [
                'label' => esc_html__( 'Color ( Active )', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .center .t_txt, {{WRAPPER}} .ua-testimonial-c .t_item:hover .t_txt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 't_content_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ua-testimonial-c .t_txt,{{WRAPPER}} .t_item:hover .t_txt',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            't_t_footer_style',
            [
                'label' => __( 'Footer Content', UA_TD ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_t_n',
            [
                'label' => __( 'Name', UA_TD ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            't_f_name_color',
            [
                'label' => esc_html__( 'Name Color', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#3b566e',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .c_o_info h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 't_f_name_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .ua-testimonial-c .c_o_info h2',
            ]
        );

        $this->add_control(
            'heading_t_t',
            [
                'label' => __( 'Title', UA_TD ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            't_f_title_color',
            [
                'label' => esc_html__( 'Title Color', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#3b566e',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .c_o_info h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 't_f_title_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .ua-testimonial-c .c_o_info h3',
            ]
        );

        $this->add_control(
            'heading_t_a',
            [
                'label' => __( 'Avatar', UA_TD ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            't_f_avatar_w_',
            [
                'label' => esc_html__( 'Image Width', UA_TD ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .c_img img' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            't_f_avatar_h',
            [
                'label' => esc_html__( 'Image Height', UA_TD ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .c_img img' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            't_border_radius',
            [
                'label' => esc_html__( 'Border Radius', UA_TD ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em'],
                'default' => [
                    'top' => 50,
                    'right' => 50,
                    'bottom' => 50,
                    'left' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .c_img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nav_dot_section',
            [
                'label' => __( 'Navs & Dots', UA_TD ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'navs_dots_c'
        );
        
        $this->start_controls_tab(
            'md_c_n',
            [
                'label' => __( 'Normal', UA_TD )
            ]
        );
        
        $this->add_control( 
            'nav_bg_c',
            [
                'label' => __( 'Nav Backgorund', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#5820e5',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .owl-nav button' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control( 
            'dot_bg_c',
            [
                'label' => __( 'Dot Backgorund', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#5820e5',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .owl-dots .owl-dot span' => 'background-color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control( 
            'nav_txt_c',
            [
                'label' => __( 'Nav Arrow Color', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .owl-nav button' => 'color: {{VALUE}} !important;'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'md_c_h',
            [
                'label' => __( 'Hover', UA_TD )
            ]
        );
        
        $this->add_control( 
            'nav_bg_c_h',
            [
                'label' => __( 'Nav Backgorund', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f30d55',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .owl-nav button:hover' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control( 
            'dot_bg_c_h',
            [
                'label' => __( 'Dot Backgorund', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f30d55',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .owl-dots .owl-dot:hover span' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control( 
            'nav_txt_c_h',
            [
                'label' => __( 'Nav Arrow Color', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .owl-nav button:hover' => 'color: {{VALUE}} !important;'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'md_c_a',
            [
                'label' => __( 'Active', UA_TD )
            ]
        );

        $this->add_control( 
            'dot_bg_c_a',
            [
                'label' => __( 'Dot Backgorund', UA_TD ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f30d55',
                'selectors' => [
                    '{{WRAPPER}} .ua-testimonial-c .owl-dots .owl-dot.active span' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();
    }

    /**
     * Render the widget output in the frontend
     * 
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes( 't_content', 'advance');
        $this->add_inline_editing_attributes( 't_author', 'none');
        $this->add_inline_editing_attributes( 't_a_title', 'none');

        
    ?>
        <style>
            .ua-testimonial-c .owl-nav{ display: <?php if ( 'yes' == $settings['show_navs'] ) { echo 'block';} else{ echo 'none';}?> !important; }
            .ua-testimonial-c .owl-dots{ display: <?php if ( 'yes' == $settings['show_dots'] ) { echo 'block';} else{ echo 'none';}?> !important; }
        </style>
        <div class="ua-testimonial-carousel" id="ua-testimonial-carousel-<?php echo esc_attr($this->get_id()); ?>" data-desktop="<?php echo isset( $settings['i_desktop']) ? $settings['i_desktop'] : 3; ?>" data-mobile="<?php echo isset( $settings['i_mobile']) ? $settings['i_mobile'] : 1; ?>" data-tablet="<?php echo isset( $settings['i_tablet']) ? $settings['i_tablet'] : 2; ?>">
            <div class="owl-carousel owl-theme ua-testimonial-c">
                <?php
                foreach( $settings['testimonials'] as $testimonial ) {
                ?>
                <div class="t_item">
                    <div class="t_txt" <?php $this->print_render_attribute_string('t_content');?>>
                        <?php echo $testimonial['t_content'];?>
                    </div>
                    <div class="client_info text-center">
                        <div class="c_img">
                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'medium', 't_author_avatar');?>
                            
                        </div>
                        <div class="c_o_info">
                            <h2 <?php $this->print_render_attribute_string('t_author');?>><?php echo $testimonial['t_author'];?></h2>
                            <h3 <?php $this->print_render_attribute_string('t_a_title');?>><?php echo $testimonial['t_a_title'];?></h3>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    <?php
    }
    /**
     * Render the widget output in the editor
     * 
     */
    protected function _dcontent_template()
    {
    ?>
        
    <?php
    }
}
