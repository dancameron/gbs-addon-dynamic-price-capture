<?php

/**
 * Load via GBS Add-On API
 */
class Dynamic_Price_Freeze_Addon extends Group_Buying_Controller {
	
	public static function init() {
		require_once('Price_Modifier.php');
		require_once( GB_DYN_FREEZE_PATH . 'library/template_tags.php');

		Price_Modifier::init();
	}

	public static function gb_addon( $addons ) {
		$addons['dynamic_price_freeze'] = array(
			'label' => self::__( 'Dynamic Price Freeze' ),
			'description' => self::__( 'Freeze the Dynamic Price to the time of Checkout.' ),
			'files' => array(),
			'callbacks' => array(
				array( __CLASS__, 'init' ),
			)
		);
		return $addons;
	}

}