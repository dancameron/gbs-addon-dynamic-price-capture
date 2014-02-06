<?php

/**
 * Load via GBS Add-On API
 */
class Dynamic_Price_Immediate_Capture_Addon extends Group_Buying_Controller {
	
	public static function init() {
		require_once('Immediate_Capture.php');
		require_once( GB_DYN_PRICE_CAPTURE_PATH . 'library/template_tags.php');

		Immediate_Capture::init();
	}

	public static function gb_addon( $addons ) {
		$addons['dynamic_price_capturing'] = array(
			'label' => self::__( 'Dynamic Price Capturing' ),
			'description' => self::__( 'Allow for dynamic priced deals to be captured immediately..' ),
			'files' => array(),
			'callbacks' => array(
				array( __CLASS__, 'init' ),
			)
		);
		return $addons;
	}

}