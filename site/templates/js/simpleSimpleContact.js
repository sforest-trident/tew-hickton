$(document).ready(function() {
	/* --- Simple Contact Form --- */
	if ($('.js-simplecontactform').length) {
		$.simplecontactform($('.js-simplecontactform'));
	}
	
    if ($('.js-simplecontactform').length) {
    	var htmlToReplace = "I agree to the <a href='/terms-conditions/' >terms and conditions</a> and <a href='/privacy-policy/' >privacy policy</a>.";
    	$('#wrap_Inputfield_c_terms_consent span.pw-no-select').replaceWith(htmlToReplace);
		//$("#wrap_Inputfield_submit").append( "<img src='/site/templates/images/dots@2x.gif' class='submit-spinner' alt='wait' />" );
    }
    
    $('#Inputfield_submit').bind('click', function(event) {
        $('.ui-button-text').after('&nbsp;&nbsp;<i class="fa fa-circle-o-notch fa-spin"></i>');
    });
    
    $(document).ajaxStart(function() {
		$("#Inputfield_submit").prop('disabled', true);
	}).ajaxStop(function() {
		$("#Inputfield_submit").prop('disabled', false);
	});
    
    $('.form--error--message').show().delay(5000).fadeOut();
 });
