<?php

/**
 * Activate Class
 * 
 * @package Ultra_Addons
 */

namespace UltraAddons_Inc\Base;

defined('ABSPATH') || die();

class Activate {

    /**
     * Activation
     */
    public function activate() {
        flush_rewrite_rules();
    }

}