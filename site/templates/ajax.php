<?php
if($config->ajax) {
	// Hickton
	/**
		* AJAX helper script.
		* This file handles all front-end AJAX calls. Each call should have an action.
		* Data passed in should be very well sanitized, especially for storage into the DB
		* Ideally browser data should be cast to avoid any SQL Injections
	*/
	$contactPage = $pages->get("name=contact-us");
	$tester = $contactPage->test_recipient; //spi-des-ign.com
	$recipient = $contactPage->form_recipient ? $contactPage->form_recipient : 'paul@spi-des-ign.co.uk';
	$recipient = $contactPage->test_mode === 1 ? $tester : $recipient;
	
	
	// An action must be set
	if(!isset($_POST['action']) && !isset($_GET['action'])) {
		die(json_encode(array("error"=>"No action set","FILES"=>$_FILES,"POST"=>$_POST)));
	}
	
	// email verification
	function valid_email($email) {
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
	}

	// Is a session required
	if(isset($_POST['cmssid'])) {
		session_id(trim($_POST['cmssid']));
		session_start();
	}

	$action = (!empty($_POST['action'])?$_POST['action']:$_GET['action']);
	$response = array();
	
	switch($action) {
		// Another Action
		case "addtask":
			echo 'goomba';
		break;
		
		case "contactform":
			// user submitted the form, process it and check for errors

			// response hash
			$response = array('type'=>'', 'message'=>'');
			$error = '';   
	
			try {
				// Use if/then statement if different forms require different fields.
				$required_fields = array('name','email','enquiry','agreeterms');
		
				// Use a simple spam 'honeypot' field
				$verboten_fields = array('fax');
		
				foreach($verboten_fields as $spam) {
					if(!empty($_POST[$spam]) && !($_POST[$spam] == "4" || $_POST[$spam] == "four")){
						throw new Exception('Go away, spammer.');
					}
				}

				// do some sort of data validations, very simple example below
				foreach($required_fields as $field){
					if(empty($_POST[$field])){
						$field2 = str_replace('_',' ',$field);
						//throw new Exception('Required field "'.ucfirst($field).'" missing input.');
						if($field == 'agreeterms') {
							throw new Exception('You must agree to the Terms &amp Conditions.');
						} else {
							throw new Exception('The field "'.ucfirst($field2).'" is required.');
							//throw new Exception('Please check the required fields.');
						}
					}
				}

				// do some sort of data validations, very simple example below
				if(valid_email($_POST['email'])==0){
					throw new Exception('Please provide a valid email address.');
				}

				// Load ReCaptcha Module
				$captcha = $modules->get("MarkupGoogleRecaptcha");
				if ($captcha->verifyResponse() === false) {
					throw new Exception('You must verify that you are human.');
				}
				

				// create a new contact
				$tr = new Page();
				$tr->template    = $templates->get("contact-email");
				$tr->parent      = $pages->get("/contact-us/");
				$tr->title 		 = 'new page';
				$url = uniqid();
				$tr->name = $url;
	
				$tr->of(false); // turns off output formatting
				//$tr>of(false); // this was wrong on my first post. must be false

				// fill the fields with the collected and sanitized info.
				// See here about sanitation in pw [url="http://processwire.com/api/variables/sanitizer/"]http://processwire.com/api/variables/sanitizer/[/url]
				//$emailTo = 'paul@spi-des-ign.co.uk'; // see above.
				$emailTo = $recipient; // see above.
				$subject = $sanitizer->text($input->post->subject);
				$name    = $sanitizer->text($input->post->name);
				$email   = $sanitizer->email($input->post->email);
				$phone   = $sanitizer->text($input->post->telephone);
				$address = $sanitizer->textarea($input->post->address);
				$postcode = $sanitizer->text($input->post->postcode);
				$interest = $sanitizer->text($input->post->interest);
				$message = $sanitizer->textarea($input->post->enquiry);
				$terms   = $sanitizer->text($input->post->agreeterms);
				$contact = $sanitizer->text($input->post->agreecontact);

				// Prepare for PW
				//$tr->title = $title;
				$tr->c_subject = $subject;
				$tr->title = $name;
				$tr->c_email = $email;
				$tr->c_phone = $phone;
				$tr->c_address = $address;
				$tr->c_postcode = $postcode;
				$tr->c_interest = $interest;
				$tr->c_message = $message;
				$tr->c_terms_consent = $terms;
				$tr->c_contact_consent = $contact;

				//save the page
				$tr->save();

				// prepare email body text
				$body = "";
				$body .= "The following message has been submitted via the TWE Hickton website: \n\n";
				$body .= "***************************\n";

				$body .= "Name: ";
				$body .= $name;
				$body .= "\n\n";			
			
				if(isset($_POST['company'])) {
					$body .= "Company: ";
					$body .= $company;
					$body .= "\n\n";	
				}
			
				$body .= "Email Address: ";
				$body .= $email;
				$body .= "\n\n";

				$body .= "Telephone: ";
				$body .= $phone;
				$body .= "\n\n";
				
				if(isset($_POST['postcode'])) {
					$body .= "Post Code: ";
					$body .= $postcode;
					$body .= "\n\n";
				}

				if(!empty($_POST['interest'])) {
					$body .= "I am interested in: ";
					//foreach($_POST['interest'] as $interest) {
						$body .= $interest.', ';
					//}
					$body .= "\n\n";
				}
			
				$body .= "Message: ";
				$body .= $message;
				$body .= "\n\n";
				
				$body .= "Agree to be Contacted: ";
				$body .= $contact == 'on' ? 'Yes' : 'No';
				$body .= "\n\n";
				
				
				$body .= "***************************\n";
				$body .= "- Your Website Robot";
				
				$headers = "From: ross@tewhickton.co.uk\r\n";
				$headers .= "Reply-To: ".$email."\r\n";
				$headers .= "X-Mailer: php\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
				//$headers .= "Content-Type: text/html; charset=\"utf-8\"\r\n";
				//$headers .= "Bcc: paul@strandoo.com\r\n";
				//$headers .= "Bcc: rich@spi-des-ign.co.uk\r\n";

				ini_set("sendmail_from", "ross@tewhickton.co.uk");
				mail($emailTo,$subject,$body,$headers,"ross@tewhickton.co.uk");
				
				// here you can redirect to a confirmation page, or to the same page for another buy
				//wire("session")->redirect('/transactions/'.$url);

				// let's assume everything is ok, setup successful response
				$response['type'] = 'success';
				$response['message'] = 'Thank you! Your message has been sent.';	

				} catch(Exception $e){
					$response['type'] = 'error';
					$response['message'] = $e->getMessage();
				}

			// now we are ready to turn this hash into JSON
			print json_encode($response);
			//print ($response);
			exit;

		break;
		
	}
} else {
	//echo "ajax page";
	$response = 'Nothing to see here.';
	die(json_encode($response));
}
?>