<?php

/**
 * Init Class
 * 
 * @package Ultra_Addons
 */
namespace UA_Inc;

use UA_Inc\Base\Dashboard;
use UA_Inc\Base\Enqueue;

defined( 'ABSPATH') || die();

final class Init {
    /**
     * Return All classes as array
     * 
     * @return array list of classes
     */
    public static function get_classes() {
        return [
            Dashboard::class,
            Enqueue::class,
        ];
    }

    /**
     * Get all class, initialize them, call register method if exists
     * 
     * @return
     */
    public static function register_services() {
        foreach( self::get_classes() as $class ) {
            $service = self::init_class( $class);
            if( method_exists( $service, 'register' ) ) {
                $service->register();
            }
        }
    }

    /**
     *  Initialize the class
     * 
     * @param class $class
     * 
     * @return class instance new instance of the class 
     */
    public static function init_class( $class ) {
        return new $class;
    } 
}