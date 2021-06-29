<?php
/**
 * @package EpsPlugin
 */
/*
Plugin Name:  Eps Plugin
Plugin URI: https://github.com/VirajDilshan/Eps-Plugin1.git
Description: This is my first attempt to create eps-plugin
Version: 1.0.0
Author: Viraj Dilshan
Author URI: https://github.com/VirajDilshan/Eps-Plugin1
License: GPLv2 or later
Text Domain: eps-plugin
 */

/*
 Eps plugin was developed while learning the wordpress plugin development
Copyright (C) 2021  Viraj Dilshan

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

//if( ! defined('ABSPATH')) {
//    die;
//}

//defined('ABSPATH') or die('Access Denied!');

if (! function_exists('add_action')){
    echo 'Access Denied';
    exit;
}

class EpsPlugin {

    function __construct () {
//        $this->print_stuff();
    }

    protected function create_post_type() {
        add_action('init', array($this, 'custom_post_type'));
    }

    function register() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    function activate(){
        //generated a CPT
        $this->custom_post_type();
        //flush rewrite rules
        flush_rewrite_rules();
    }

    function deactivate(){
        //flush rewrite rules
        flush_rewrite_rules();
    }

    function uninstall(){
        //delete CPT
        //delete all plugin data from db
    }

//    protected function print_stuff(){
//        var_dump(['test']);
//    }

    function custom_post_type(){
        register_post_type('book', ['public' => true, 'label' => 'Books']);
    }

    function enqueue(){
        //enqueue all our scripts
        wp_enqueue_style('mypluginstyle', plugins_url('/assests/mystyle.css', __FILE__));
        wp_enqueue_script('mypluginscript', plugins_url('/assests/myscript.js', __FILE__));
    }

}

class SecondClass extends EpsPlugin {
    function register_post_type(){
        $this->create_post_type();
    }
}

$secondClass = new SecondClass();
$secondClass->register_post_type();

if (class_exists('EpsPlugin')) {
    $epsPlugin = new EpsPlugin();
    $epsPlugin->register();
}



//activation
register_activation_hook(__FILE__, array($epsPlugin, 'activate'));

//deactivation
register_deactivation_hook(__FILE__, array($epsPlugin, 'deactivate'));

//uninstalling

