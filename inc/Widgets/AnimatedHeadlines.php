<?php

/**
 * Animated Headlines Widget Class
 * 
 * @package Ultra_Addons
 */

namespace UltraAddons_Inc\Widgets;

use Elementor\Repeater;
use UltraAddons_Inc\Base\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

defined('ABSPATH') || die();

class AnimatedHeadlines extends Widgets_Base
{
    CONST W_NAME = 'ua_animated_headlines_';
    /**
     * Retrieve the widgte name
     * 
     * @return string Widget Name
     */
    public function get_name()
    {
        return __('ua-animated-headlines', 'ultra-addons');
    }

    /**
     * Retrieve the widgte title
     * 
     * @return string Widget title
     */
    public function get_title()
    {
        return __('Animated Headlines', 'ultra-addons');
    }

    /**
     * Retrieve the widgte icon
     * 
     * @return string Widget Name
     */
    public function get_icon()
    {
        return 'ua-icon eicon-animated-headline';
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
            'ua-script-animated-headlines',
        ];
    }

    /**
     * Retrieve the list of styles the widget depends on
     */
    public function get_style_depends() {
        return [
            'ua-style-animated-headlines',
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
            'ua_a_headlines_section_content',
            [
                'label' => __( 'Content', 'ultra-addons'),
            ]
        );

        $this->add_control(
            'ua_a_h_title_tag',
            [
                'label' => __('Title HTML Tag', 'ultra-addons'),
                'type'  => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => ultra_addons_get_title_tag(),
            ]
        );

        $this->add_control(
            'ua_a_h_first_heading',
            [
                'label' => esc_html__('First Heading', 'ultra-addons'),
                'type'  => Controls_Manager::TEXT,
                'default' => esc_html__('I Love', 'ultra-addons'),
                'label_block' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'ua_a_h_second_heading',
            [
                'label' => __('Second Titles', 'ultra-addons'),
                'type'  => Controls_Manager::TEXT,
                'default' => __('New', 'ultra-addons'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'tabs',
            [
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'ua_a_h_second_heading' => esc_html__( 'PHP', 'ultra-addons'),
                    ],
                    [
                        'ua_a_h_second_heading' => esc_html__( 'WordPress', 'ultra-addons'),
                    ],
                    [
                        'ua_a_h_second_heading' => esc_html__( 'Elementor', 'ultra-addons'),
                    ],
                    [
                        'ua_a_h_second_heading' => esc_html__( 'Ultra Addons', 'ultra-addons'),
                    ],
                ],
                'fields' => array_values($repeater->get_controls()),
                'title_field' => '{{{ ua_a_h_second_heading }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ua_a_headlines_section_style',
            [
                'label' => esc_html__( 'Style', 'ultra-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            self::W_NAME .'alignment',
            [
                'label' => esc_html__( 'Alignment', 'ultra-addons'),
                'type'  => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'ultra-addons' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [ 
                    '{{ WRAPPER }} .ua-animated-heading' => 'justify-content: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            self::W_NAME .'a_style',
            [
                'label' => esc_html__( 'Style', 'ultra-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'rotate-1',
                'options' => [
                    'rotate-1' => esc_html__( 'Rotate 1', 'ultra-addons' ),
                    'letters type' => esc_html__( 'Typing', 'ultra-addons' ),
                    'loading-bar' => esc_html__( 'Loading Bar', 'ultra-addons' ),
                    'slide' => esc_html__( 'Slide', 'ultra-addons' ),
                    'clip is-full-width' => esc_html__( 'Clip', 'ultra-addons' ),
                    'zoom' => esc_html__( 'Zoom', 'ultra-addons' ),
                    'push' => esc_html__( 'Push', 'ultra-addons' ),
                ],
            ]

        );

        $this->end_controls_section();

        $this->start_controls_section(
            self::W_NAME .'first_heading_styles',
            [
                'label' => esc_html__( 'First Heading', 'ultra-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            self::W_NAME . 'text_color',
            [
                'label' => esc_html__( 'Text Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR, 
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ua-animated-heading .ua-a-t-first' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            self::W_NAME . 'bg_color',
            [
                'label' => esc_html__( 'Background Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR, 
                'default' => '#f30d55',
                'selectors' => [
                    '{{WRAPPER}} .ua-animated-heading .ua-a-t-first' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            self::W_NAME .'first_heading_padding',
            [
                'label' => esc_html__( 'Padding', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em'],
                'selectors' => [
                    '{{ WRAPPER }} .ua-animated-heading .ua-a-h-wrapper .ua-a-h-title .ua-a-t-first' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => self::W_NAME . 'first_heading_typography',
                // 'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => 
                    '{{WRAPPER}} .ua-animated-heading .ua-a-h-wrapper .ua-a-h-title .ua-a-t-first',
            ]
        );

        $this->end_controls_section();

        /**
         * Second Heading
         */
        $this->start_controls_section(
            self::W_NAME .'second_heading_styles',
            [
                'label' => esc_html__( 'Second Heading', 'ultra-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            self::W_NAME . 'second_text_color',
            [
                'label' => esc_html__( 'Text Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR, 
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ua-animated-heading .ua-a-t-second' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            self::W_NAME . 'second_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'ultra-addons' ),
                'type' => Controls_Manager::COLOR, 
                'default' => '#5820e5',
                'selectors' => [
                    '{{WRAPPER}} .ua-animated-heading .ua-a-t-second' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            self::W_NAME .'second_heading_padding',
            [
                'label' => esc_html__( 'Padding', 'ultra-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em'],
                'selectors' => [
                    '{{ WRAPPER }} .ua-animated-heading .ua-a-h-wrapper .ua-a-h-title .ua-a-t-second' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => self::W_NAME . 'second_heading_typography',
                // 'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => 
                    '{{WRAPPER}} .ua-animated-heading .ua-a-h-wrapper .ua-a-h-title .ua-a-t-second',
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
?>
        <div class="ua-animated-heading" id="ua-animated-heading-<?php echo esc_attr($this->get_id()); ?>">
            <div class="ua-a-h-wrapper">
                <<?php echo $settings['ua_a_h_title_tag']; ?> class="ua-a-h-title <?php echo $settings[self::W_NAME . 'a_style'];?>">
                    <span class="ua-a-t-first">
                        <?php echo $settings['ua_a_h_first_heading']; ?>
                    </span>
                    <span class="ua-a-t-second">
                        <?php
                        foreach ( $settings['tabs'] as $key => $tab) {
                        ?>
                            <b class="ua-a-h-s-h <?php echo ($key == 0) ? 'is-visible' : ''; ?>">
                                <?php echo $tab['ua_a_h_second_heading']; ?>
                            </b>
                        <?php
                        }
                        ?>
                    </span>
                </<?php echo $settings['ua_a_h_title_tag']; ?>>
            </div>
        </div>
    <?php
    }
    /**
     * Render the widget output in the editor
     * 
     */
    protected function _content_template()
    {
    ?>
        <div class="ua-animated-heading" id="ua-animated-heading-">
            <div class="ua-a-h-wrapper">
                <{{{ settings.ua_a_h_title_tag }}} class="ua-a-h-title {{{ settings.ua_animated_headlines_a_style }}}">
                    <span class="ua-a-t-first">
                        {{{ settings.ua_a_h_first_heading }}}
                    </span>
                    <span class="ua-a-t-second">
                        <# _.each( settings.tabs, function( tab, index){ #>
                            <b class="ua-a-h-s-h <# if( index==0 ){ #>is-visible <# } #>">
                                    {{{ tab.ua_a_h_second_heading }}}
                            </b>
                            <# }); #>
                    </span>
                </{{{ settings.ua_a_h_title_tag }}}>
            </div>
        </div>
    <?php
    }
}
