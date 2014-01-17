<?php
/*
Plugin Name: Group Buying Addon - Freeze the Dynamic Price to the time of Checkout
Version: 1
Plugin URI: http://groupbuyingsite.com/marketplace
Description: Unknown
Author: Sprout Venture
Author URI: http://sproutventure.com/wordpress
Plugin Author: Dan Cameron
Text Domain: group-buying
*/

define( 'GB_DYN_FREEZE_PATH', WP_PLUGIN_DIR . '/' . basename( dirname( __FILE__ ) ) . '/' );

// Load after all other plugins since we need to be compatible with groupbuyingsite
add_action( 'plugins_loaded', 'gb_dynamic_freeze_addon' );
function gb_dynamic_freeze_addon() {
	require_once 'classes/Dynamic_Price_Freeze_Addon.php';
	// Hook this plugin into the GBS add-ons controller
	add_filter( 'gb_addons', array( 'Dynamic_Price_Freeze_Addon', 'gb_addon' ), 10, 1 );
}