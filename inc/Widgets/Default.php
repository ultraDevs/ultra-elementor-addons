<?php

/**
 * Accordion Widget Class
 * 
 * @package Ultra_Addons
 */

namespace UA_Inc\Widgets;

use Elementor\Repeater;
use UA_Inc\Base\Widgets_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

defined('ABSPATH') || die();

class Accordion extends Widgets_Base
{
    CONST W_NAME = 'ua_accordion_';
    /**
     * Retrieve the widgte name
     * 
     * @return string Widget Name
     */
    public function get_name()
    {
        return __('ua-accordion', UA_TD);
    }

    /**
     * Retrieve the widgte title
     * 
     * @return string Widget title
     */
    public function get_title()
    {
        return __( 'Accordion', UA_TD);
    }

    /**
     * Retrieve the widgte icon
     * 
     * @return string Widget Name
     */
    public function get_icon()
    {
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
    public function get_script_depends()
    {
        return [
            UA_TD . '-accordion',
        ];
    }

    /**
     * Retrieve the list of styles the widget depends on
     */
    public function get_style_depends() {
        return [
            UA_TD . '-style-accordion',
        ];
    }

    /**
     * Register the widget controls.
     * 
     * 
     */
    protected function ua_register_controls()
    {

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
                    <span class="ua-a-t-second" style="width: auto;">
                        <?php
                        foreach ($settings['tabs'] as $key => $tab) {
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
                    <span class="ua-a-t-second" style="width: auto;">
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
