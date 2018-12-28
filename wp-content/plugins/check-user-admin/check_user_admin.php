<?php
/**
 * Plugin Name: Check User Admin
 * Description: Custom user wordpress for minhduongads
 * Plugin URI: https://minhduongads.com/
 * Author: Elementor.com
 * Version: 1.0.0
 * Author URI: https://minhduongads.com/
 * Text Domain: nextcore
 */

class CheckUserAdmin{
    private static $instance;

    public static function getInstance(){
        if (!isset(self::$instance) && !(self::$instance instanceof CheckUserAdmin)) {
            self::$instance = new CheckUserAdmin();
            self::$instance->setup();
            self::$instance->user_option_page();
            self::$instance->post_type();
        }

        return self::$instance;
    }

    public function setup(){
        if (!defined('DIR')) {
            define('DIR', plugin_dir_path(__FILE__));
        }

        if (!defined('URL')) {
            define('URL', plugin_dir_url(__FILE__));
        }
    }

    public function post_type(){
        include 'inc/menu/post_type/post_type_user.php';
    }

    public function user_option_page(){
        include 'inc/menu/create_user.php';
    }


}

function getCheckUserAdmin(){
    return CheckUserAdmin::getInstance();
}

getCheckUserAdmin();

