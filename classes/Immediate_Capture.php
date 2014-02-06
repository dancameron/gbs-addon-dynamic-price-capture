<?php

/**
 * Allow for the deal collect payments after the tipping point when dynamic pricing is used.
 *
 * @package GBS
 * @subpackage Base
 */
class Immediate_Capture extends Group_Buying_Controller {
	
	public static function init() {
		if ( is_admin() ) {
			// deals submitted on the front-end won't have meta boxes
			add_action( 'admin_init', array( get_class(), 'register_resources' ) );
			add_action( 'admin_enqueue_scripts', array( get_class(), 'queue_admin_resources' ) );
			add_action( 'save_post', array( get_class(), 'save_meta_boxes' ), 20, 2 );
		}
	}

	public function register_resources() {
		wp_register_script( 'sec_admin_deal_dyn_pricing_capture', GB_DYN_PRICE_CAPTURE_URL . '/resources/offer.admin.js', array( 'jquery' ), Group_Buying::GB_VERSION );
	}

	public static function queue_admin_resources() {
		if ( is_admin() ) {
			$post_id = isset( $_GET['post'] ) ? (int)$_GET['post'] : -1;
			if (
				( isset( $_GET['post_type'] ) && Group_Buying_Deal::POST_TYPE == $_GET['post_type'] ) ||
				Group_Buying_Deal::POST_TYPE == get_post_type( $post_id )
			) {
				wp_enqueue_script( 'sec_admin_deal_dyn_pricing_capture' );
			}
		}
	}

	public static function save_meta_boxes( $post_id, $post ) {
		// Don't save meta boxes when the importer is used.
		if ( isset( $_GET['import'] ) && $_GET['import'] == 'wordpress' ) {
			return;
		}

		// only continue if it's a deal post
		if ( $post->post_type != Group_Buying_Deal::POST_TYPE ) {
			return;
		}
		// don't do anything on autosave, auto-draft, bulk edit, or quick edit
		if ( wp_is_post_autosave( $post_id ) || $post->post_status == 'auto-draft' || defined( 'DOING_AJAX' ) || isset( $_GET['bulk_edit'] ) ) {
			return;
		}
		// Since the save_box_gb_deal_[meta] functions don't check if there's a _POST, a nonce was added to safe guard save_post actions from ... scheduled posts, etc.
		if ( !isset( $_POST['gb_deal_submission'] ) && ( empty( $_POST ) || !check_admin_referer( 'gb_save_metaboxes', 'gb_save_metaboxes_field' ) ) ) {
			return;
		}

		// save all the meta boxes
		$deal = Group_Buying_Deal::get_instance( $post_id );

		// save expiration last, since it depends on the value of the deal_price meta box
		self::save_meta_box_gb_deal_expiration( $deal, $post_id, $post );
	}

	/**
	 * Save the deal expiration meta box
	 *
	 * @static
	 * @param Group_Buying_Deal $deal
	 * @param int     $post_id
	 * @param object  $post
	 * @return void
	 */
	private static function save_meta_box_gb_deal_expiration( Group_Buying_Deal $deal, $post_id, $post ) {
		if ( $deal->has_dynamic_price() ) {
			if ( isset( $_POST['deal_expiration_never_dyn_mod'] ) && $_POST['deal_expiration_never_dyn_mod'] ) {
				$deal->set_expiration_date( Group_Buying_Deal::NO_EXPIRATION_DATE );
				$_POST['deal_capture_before_expiration_dyn_mod'] = TRUE; // if it never expires, you have to capture earlier than expiration
			}
			if ( isset( $_POST['deal_capture_before_expiration_dyn_mod'] ) && $_POST['deal_capture_before_expiration_dyn_mod'] ) {
				$deal->set_capture_before_expiration( TRUE );
			}
		}
	}

}