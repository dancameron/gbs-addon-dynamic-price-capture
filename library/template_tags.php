<?php

function gb_get_voucher_purchase_price( $voucher_id = 0 ) {
	if ( !$voucher_id ) {
		global $post;
		$voucher_id = $post->ID;
	}
	$voucher = Group_Buying_Voucher::get_instance( $voucher_id );
	$product_data = $voucher->get_product_data();
	$purchase_price = $product_data['unit_price'];
	return apply_filters( 'gb_get_purchase_price', $purchase_price );
}