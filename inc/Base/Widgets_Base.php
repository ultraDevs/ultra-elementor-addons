<?php

/**
 * Activate Class
 * 
 * @package Ultra_Addons
 */

namespace UltraAddons_Inc\Base;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined('ABSPATH') || die();

abstract class Widgets_Base extends Widget_Base {

    /**
     * Register the widget controls.
     * 
     */
    protected function _register_controls() {
        $this->ua_register_controls();

        //Premium Version
        if ( ultra_addons_fs()->is_not_paying() ) {
            $this->start_controls_section(
                'ua_not_paying',
                [
                    'label' => __( 'Upgrade to Pro', 'ultra-addons' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );
            $this->add_control(
                'ua_not_paying_msg',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => __( sprintf( 'Upgrade to <a href="%s" target="_blank">Pro Version</a> for more features, customization options & widgets!', ultra_addons_fs()->get_upgrade_url() ), 'ultra-addons' ),
                ]
            );
            $this->end_controls_section();
        }
    }

    /**
     * Ultra Addons Controls
     */
    abstract protected function ua_register_controls();
}