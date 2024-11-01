<?php
/*
Plugin Name: Slider-Gallery
Plugin URI: http://wordpress.org
Description: A responsive slider gallery plugin for wordpress
Author: ilieiulian.ovidiu@gmail.com
Version: 1.1
*/

require_once( 'functions/custom_post_types.php' );
require_once( 'functions/custom_css.php' );
require_once( 'functions/ajax_load_photo.php' );
require_once( 'functions/shortcode.php' );
require_once( 'functions/slider_code.php' );

add_action('admin_enqueue_scripts', 'myplugin_admin_style');
add_action('login_enqueue_scripts', 'myplugin_admin_style');
add_action('wp_enqueue_scripts', 'myplugin_dynamic_css');
add_action('login_enqueue_scripts', 'myplugin-dynamic-css');

add_action('login_enqueue_scripts', 'myplugin_options_enqueue_scripts');
add_action('admin_enqueue_scripts', 'myplugin_options_enqueue_scripts');

add_action( 'wp_enqueue_scripts', 'slider_gallery_css' );
add_action( 'wp_enqueue_scripts', 'slider_gallery_js' );

function myplugin_admin_style() {
    wp_enqueue_style('my-admin-theme', plugins_url('css/wp-admin.css', __FILE__));
}
function myplugin_dynamic_css() {
   wp_enqueue_style('my-dynamic-css', plugins_url('css/dinamic_css.php', __FILE__));
}
function slider_gallery_css() {
   wp_register_style( 'font-awesome', plugins_url('/font-awesome/css/font-awesome.min.css', __FILE__),array(),'4.1.0' );
   wp_register_style( 'style-css', plugins_url('/css/css.css', __FILE__) ,array(),'1.0.0' );
	wp_enqueue_style( 'style-css' );
   wp_enqueue_style( 'font-awesome' );
   }
function slider_gallery_js() {

wp_register_script('js-frontend', plugins_url('js/js_frontend.js', __FILE__) ,array('jquery'),'1.0.0',true); 
wp_enqueue_script('jquery'); 
wp_enqueue_script('js-frontend');
   
}

function myplugin_options_enqueue_scripts() {

    wp_register_script( 'admin_script_plugin', plugins_url() .'/Slider-Gallery/js/js.js', array('jquery','media-upload') );
	wp_enqueue_script('admin_script_plugin');
	wp_enqueue_media();
	 }



?>