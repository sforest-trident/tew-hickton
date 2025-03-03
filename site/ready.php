<?php namespace ProcessWire;

/**
 * ProcessWire Bootstrap API Ready 
 * ===============================
 * This ready.php file is called during ProcessWire bootstrap initialization process.
 * This occurs after the current page has been determined and the API is fully ready 
 * to use, but before the current page has started rendering. This file receives a 
 * copy of all ProcessWire API variables.
 *
 */
 
 /*
$this->addHookBefore('SimpleContactForm::sendAdditionalMail', function(HookEvent $event) {
  $form = $event->arguments(0);
  //$emailCopy = $form->get('scf_emailcopy');
  $emailCopy = 'paul@strandoo.com';
  $this->emailAddTo = $emailCopy;

  // more logic here

});
*/

//  $this->addHookBefore('SimpleContactForm::sendAdditionalMail', function(HookEvent $event) {
//   $form = $event->arguments(0);
//   //$emailCopy = $form->get('scf_emailcopy');
//   $emailCopy = 'strandoo@icloud.com';
//   $this->emailAddTo = $emailCopy;

//   // more logic here

// });


/* This hook can be used for additional spam filtering on a SimpleContactForm */
$this->addHookBefore('SimpleContactForm::processValidation', function(HookEvent $event) {
	$form = $event->arguments(0);
	// Google  ReCaptcha
	$recaptcha = $form->get('c_recaptcha'); // the field name

	// Google ReCaptcha
	if (!$this->input->post->{'g-recaptcha-response'}) { // attach an error to the field
		$recaptcha->error(__('You didn\'t pass the reCaptcha test.')); // it will be displayed along the field
	}

	// Math Captcha
	//$mathcaptcha = $form->get('math_captcha');
	//$theanswer = $_SESSION['number'];

	// Math Captcha
	//if ($this->input->post->{'mathcaptcha'}!=$theanswer) { // attach an error to the field
	//	$mathcaptcha->error(__('You didn\'t pass the math test.')); // it will be displayed along the field
	//}
});