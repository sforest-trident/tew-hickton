<?php
// Contact Form Submit Behavior
if ($config->ajax) {
	$scf = $modules->get('SimpleContactForm');
	include("./includes/message.php");
	
	//$alternateEmail = $page->alt_recipient!='' ? "'emailAddTo' => \"{$page->alt_recipient}\"" : "";

	$options = array(
	  'emailSubject' => 'From the T.E.W Hickton Contact Form.',
	  'emailMessage' => $emailMessage,
	  'btnText' => 'Send Enquiry',
	  //'btnClass' => 'button-full',
	  //'emailAdd' => true,
	  'emailReplyTo' => $input->c_email,
	  'emailAddTo' => 'developer@tridentmarketingdev.co.uk',
	  'errorMessage' => 'Please check that you have entered all the required fields correctly.',
	  'successMessage' => 'Thank you. Your message has been sent. Someone from our office will contact you soon.'
	);

	if($page->alt_recipient!='') {
		$options["emailAddTo"]=$page->alt_recipient;
	}

	echo "<div>{$scf->render($options)}
			<script type='text/javascript'>
			$(document).ready(function(){
				if ($('.js-simplecontactform').length) {
					$.simplecontactform($('.js-simplecontactform'));
					var htmlToReplace = \"I agree to the <a href='/terms-conditions/' >terms and conditions</a> and <a href='/gdpr-policies/' >privacy policy</a>.\";
    				$('#wrap_Inputfield_c_terms_consent span.pw-no-select').replaceWith(htmlToReplace);
				}
				$('#Inputfield_submit').bind('click', function(event) {
					$('.ui-button-text').after('&nbsp;&nbsp;<i class=\"fa fa-circle-o-notch fa-spin\"></i>');
				});
				$('.form--error--message').show().delay(5000).fadeOut();
			});
		</script>
		</div>";
	exit();
}

?>