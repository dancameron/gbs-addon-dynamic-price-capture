jQuery.noConflict();

sec_admin_deal_dyn_pricing_capture = {};

jQuery(document).ready(function($){
	sec_admin_deal_dyn_pricing_capture.ready($);
});

sec_admin_deal_dyn_pricing_capture.ready = function($) {
	// enable checkboxes
	$('#deal_capture_before_expiration').removeAttr('disabled');
	$('#deal_expiration_never').removeAttr('disabled');

	// Create hidden fields
	$('<input>').attr({
		type: 'hidden',
		id: 'deal_capture_before_expiration_dyn_mod',
		name: 'deal_capture_before_expiration_dyn_mod',
		value: $('#deal_capture_before_expiration').is(':checked')
	}).insertAfter('#deal_capture_before_expiration');

	// Create hidden fields
	$('<input>').attr({
		type: 'hidden',
		id: 'deal_expiration_never_dyn_mod',
		name: 'deal_expiration_never_dyn_mod',
		value: $('#deal_expiration_never').is(':checked')
	}).insertAfter('#deal_expiration_never');

	// modify names
	$('#deal_capture_before_expiration').change(function(){
		$value = $(this).is(':checked');
		$('#deal_capture_before_expiration_dyn_mod').val($value);
	});
	$('#deal_expiration_never').change(function(){
		$value = $(this).is(':checked');
		$('#deal_expiration_never_dyn_mod').val($value);
	});
	// remove disclaimer.
	$('#gb_deal_expiration p small').hide();
	
	
};