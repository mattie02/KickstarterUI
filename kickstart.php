<?php
/*
Plugin Name: HTML Kickstart UI Library
Plugin URI: http://flightofthedodo.com/Kickstart-wpplug
Description: Extends Functionality from the HTML Kickstart (99lime.com) to any theme
Version: 0.0.0 ALPHA
Author: Matthew Hansen
Author URI: http://flightofthedodo.com
License: A "Slug" license name e.g. GPL2
*/

function load_my_kickstart_js() {  
    wp_register_script('kickstart_js', plugins_url('KickstarterUI/js/kickstart.js'), array("jquery"), '1.0', false );  
    wp_enqueue_script('kickstart_js');  
}  
add_action('init', 'load_my_kickstart_js');  

function load_my_kickstart_css()  {  
	wp_deregister_style( 'style_css', get_stylesheet_directory_uri() . '/style.css' );
	//$style = get_stylesheet_directory_uri() . '/style.css';
	//wp_dequeue_style_style( $style );
    wp_register_style( 'kickstart_css', plugins_url('KickstarterUI/css/kickstart.css'), array(), '20130423', 'all' );   
    wp_enqueue_style( 'kickstart_css' );  
     if ( file_exists( get_stylesheet_directory() . '/kickstart-custom.css' ) ) {
            wp_register_style( 'kickstart_custom', get_stylesheet_directory_uri() . '/kickstart-custom.css', array(), '20130423', 'all' );
            wp_enqueue_style( 'kickstart_custom' );
        }
}  
add_action( 'wp_enqueue_scripts', 'load_my_kickstart_css', 12 );  
?>