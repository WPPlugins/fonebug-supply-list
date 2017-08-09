<?php
/**
 * @package DB Explorer
 * @version 1.0
 */
/*
Plugin Name: Fonebug Supply List
Plugin URI: http://www.fonebug.com/
Description: A simple, but effective list-making tool for you to keep track of items that you have and items that you need.
Version: 1.0
Author URI: http://www.fonebug.com/
*/

add_action('activated_plugin','fb_save_error');
function fb_save_error(){file_put_contents(plugin_dir_path( __FILE__ ) . '/error.html', ob_get_contents());}

function fb_plugin_admin_add_page() {
	add_menu_page( 'Fonebug Admin', 'Supplies', 'manage_options', plugin_dir_path( __FILE__ ) . 'admin_home.php', '', 'dashicons-list-view', 82);
}
add_action('admin_menu', 'fb_plugin_admin_add_page');


function fb_my_enqueue($hook) {
  //-- for our special admin page
	if( 'fonebug-supply-list/admin_home.php' != $hook )
		return;

  wp_register_style('fonebug', plugins_url('fonebug-supply-list/_include/fb-styles.php'));
  wp_enqueue_style('fonebug');
}

//-- Start session if not already started
function fb_register_session(){if( !session_id() )session_start();}
add_action('init','fb_register_session');

add_action('admin_enqueue_scripts', 'fb_my_enqueue');


//[fonebug-supply-list]
function fonebug_supplies_shortcode($atts){include_once(plugin_dir_path( __FILE__ ) . "index.php");}
add_shortcode( 'fonebug-supply-list', 'fonebug_supplies_shortcode' );
?>