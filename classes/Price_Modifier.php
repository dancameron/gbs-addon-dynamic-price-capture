<?php

/**
 * Modify the price based on the time of checkout.
 * Store the price at the time of checkout too.
 *
 * @package GBS
 * @subpackage Base
 * @todo  move to the deals controller
 */
class Price_Modifier extends Group_Buying_Controller {
	const PURCHASE_DATA = 'purchase_data_meta';
	
	public static function init() {
		// filter the price for the voucher, etc..
		add_action( 'create_voucher_for_purchase', array( get_class(), 'store_purchase_data_with_voucher'), 10, 3 );
	}


	/**
	 * Store the purchase information with the voucher so it can be used in custom templates, etc..
	 * @param  int                $voucher_id Voucher ID
	 * @param  Group_Buying_Purchase $purchase   
	 * @param  array                $product    product array in the purchase.
	 * @return                             
	 */
	public function store_purchase_data_with_voucher( $voucher_id, $purchase, $product ) {
		$voucher = Group_Buying_Voucher::get_instance( $voucher_id );
		$voucher->save_post_meta( array( self::PURCHASE_DATA => $purchase ) );
	}

	/**
	 * Get the voucher's purchase data stored in the filtered create_voucher_for_purchase
	 * @param  int $voucher_id
	 * @return
	 */
	public function get_voucher_purchase_data( $voucher_id ) {
		return get_post_meta( $voucher_id, self::PURCHASE_DATA, TRUE );
	}

}