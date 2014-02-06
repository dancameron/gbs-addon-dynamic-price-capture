jQuery.noConflict();

sec_admin_deal_dyn_pricing_capture = {};

jQuery(document).ready(function($){
	sec_admin_deal_dyn_pricing_capture.ready($);
});

sec_admin_deal_dyn_pricing_capture.ready = function($) {
	// enable checkboxes
	$('#deal_capture_before_expiration').removeAttr('disabled');
	$('#deal_expiration_never').removeAttr('disabled');
	// modify names
	$('#deal_capture_before_expiration').change(function(){
		$('#deal_capture_before_expiration').attr('name','deal_capture_before_expiration_dyn_mod');
	});
	$('#deal_expiration_never').change(function(){
		$('#deal_expiration_never').attr('name','deal_expiration_never_dyn_mod');
	});
	// remove disclaimer.
	$('#gb_deal_expiration p small').hide();
	
	
};