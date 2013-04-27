<?php
/*
Plugin Name: HTML Kickstart UI Library
Plugin URI: http://flightofthedodo.com/Kickstart-wpplug
Description: Extends Functionality from the HTML Kickstart (99lime.com) to any theme
Version: 1.0.0 BETA
Author: Matthew Hansen
Author URI: http://flightofthedodo.com
License: A "Slug" license name e.g. GPL2
*/

/* ==== DEFAULTS ==== */

$ks_pri = 12;
$ks_use_cust_css = 'false';
$ks_theme_css = "/kickstart-custom.css";
$ks_shortcodes = 'true';



$custom_css_loc = get_stylesheet_directory_uri() . $ks_theme_css;

/* ==== END DEFAULTS ==== */

/* ==== CHECK IF HAS ORVERRIDE FILE ==== */


if ( file_exists( get_stylesheet_directory() . '/kickstart-config.php' ) ) {
    require_once( get_stylesheet_directory() . '/kickstart-config.php' ); 
} 

/* ==== END OVERRIDE CHECK ==== */


function load_my_kickstart_js() {  
    wp_register_script('kickstart_js', plugins_url('KickstarterUI/js/kickstart.js'), array("jquery"), '1.0', false );  
    wp_enqueue_script('kickstart_js');  
}  
add_action('init', 'load_my_kickstart_js');  

function load_my_kickstart_css()  {  
	
    global $custom_css_loc;
    global $ks_use_cust_css;

    wp_deregister_style( 'style_css', get_stylesheet_directory_uri() . '/style.css' );
    wp_register_style( 'kickstart_css', plugins_url('KickstarterUI/css/kickstart.css'), array(), '20130423', 'all' );   
    wp_enqueue_style( 'kickstart_css' );  
      
    if ( $ks_use_cust_css == 'true' ) {
            wp_register_style( 'kickstart_custom', $custom_css_loc, array(), '20130423', 'all' );
            wp_enqueue_style( 'kickstart_custom' );
        }
}  
add_action( 'wp_enqueue_scripts', 'load_my_kickstart_css', $ks_pri );  


if ( $ks_shortcodes == 'true' ) { /* place all shortcode between if */

    function ksrt_column($atts, $content=null) {

    shortcode_atts( array('col'=>'1'), $atts);
    return '
    <div class="col_'.$atts['col'].'">' . do_shortcode($content) . ' </div>';
    }

    add_shortcode('ks_col', 'ksrt_column' );

    function ksrt_pre($content=null) {

        return '
        <pre> ' . do_shortcode($content) . ' </pre> ';
    }

    add_shortcode('ks-pre', 'ksrt_pre' );

}//END THE SHORTCODE BLOCK

?>