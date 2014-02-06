<?php
/*
Plugin Name: Group Buying Addon - Dynamic Price Capturing
Version: 1
Plugin URI: http://groupbuyingsite.com/marketplace
Description: Allow for dynamic priced deals to be captured immediately.
Author: Sprout Venture
Author URI: http://sproutventure.com/wordpress
Plugin Author: Dan Cameron
Text Domain: group-buying
*/

define( 'GB_DYN_PRICE_CAPTURE_PATH', WP_PLUGIN_DIR . '/' . basename( dirname( __FILE__ ) ) . '/' );
define ('GB_DYN_PRICE_CAPTURE_URL', plugins_url( '', __FILE__) );

// Load after all other plugins since we need to be compatible with groupbuyingsite
add_action( 'plugins_loaded', 'gb_dynamic_price_capture_addon' );
function gb_dynamic_price_capture_addon() {
	require_once 'classes/Dynamic_Price_Immediate_Capture_Addon.php';
	// Hook this plugin into the GBS add-ons controller
	add_filter( 'gb_addons', array( 'Dynamic_Price_Immediate_Capture_Addon', 'gb_addon' ), 10, 1 );
}