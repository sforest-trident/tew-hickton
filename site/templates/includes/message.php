<?php
	$name    = $sanitizer->text($input->post->c_name);
	$email   = $sanitizer->email($input->post->c_email);
	$phone   = $sanitizer->text($input->post->c_phone);
	$message = $sanitizer->textarea($input->post->c_message);
	$location = $sanitizer->text($input->post->c_locations);
	$subject  = $sanitizer->text($input->post->c_subject);
	//$source  = $sanitizer->int($input->post->c_source);
	$contact = $sanitizer->text($input->post->c_contact_consent);
	$date = date('d M Y h:i A');
	
	$subject = $pages->get($subject)->title;
	$location = $pages->get($location)->title;
	$contact = $contact==1 ? 'Yes' : 'No';

	$emailMessage = "
Hello,

We have received a new message from the T.E.W. Hickton website:

Name: {$name}

Email: {$email}

Phone: {$phone}

Location: {$location}

Interest: {$subject}

Message: {$message}


Consent to be contacted: {$contact}

Date: {$date}

A copy of this email has been saved to the CMS. (https://tewhickton.co.uk/admin)";