			<?php // Markup Google Captcha.
			$captcha = $modules->get("MarkupGoogleRecaptcha"); ?>
			<form id="contact-us" class="form-contact-form" action="<?php echo $config->urls->root; ?>ajax/" method="post">
				<input type="hidden" name="subject" value="Contact Form">
				<input type="hidden" name="action" value="contactform" >
				<fieldset>
				<h3>General Enquiries</h3>
				<div id="content-loading"></div>
				<div id="contact-us-message"></div><!--  style="display: none;" -->
				<ul class="form-input side-labels">
					<li><label for="name">Name</label>
					<input type="text" name="name" id="name" placeholder="Name"></li>
					
					<li><label for="email">Email</label>
					<input type="text" name="email" id="email" placeholder="Email"></li>

					<li><label for="tel">Telephone</label>
					<input type="text" name="telephone" id="telephone" placeholder="Telephone"></li>
					
					<li><label for="address">Address</label>
					<textarea name="address" id="address" rows="4" maxlength="700" placeholder="Address"></textarea></li>
					
					<li><label for="postcode">Post Code</label>
					<input type="text" name="postcode" id="postcode" placeholder="Post Code"></li>
					
					<!-- <li><label for="subject">Subject</label>
					<input type="text" name="subject"></li> -->			

					<!-- <li><label for="source">How did you hear about us?</label>
					<input type="text" name="source"></li> -->
		
					<li class="antispam"><label for="fax">What is two plus two?</label>
					<input type="text" name="fax" id="fax"></li>

					<li><label for="enquiry">Enquiry</label>
					<textarea name="enquiry" id="enquiry" rows="6" maxlength="700" placeholder="Enquiry"></textarea></li>

					<li class="contact-consent form-consent">
						<label class="check-control" for="agreeterms">
							<input type="checkbox" name="agreeterms" id="agreeterms" class="check-input required" >
							<small>I understand and agree to the <a href="<?php echo $config->urls->root; ?>terms-conditions/">Terms &amp; Conditions</a> and <a href="<?php echo $config->urls->root; ?>privacy-policy/">Privacy Policy</a>.</small>
						</label>
					</li>
					<li>
						<label class="check-control" for="agreecontact">
							<input type="checkbox" name="agreecontact" id="agreecontact" class="check-input" >
							<small>You may contact me about products and services I may be interested in.</small>
						</label>
					</li>				

					<?php if($_SERVER['SERVER_NAME'] == 'localhost'): ?>
						<li>
							<label class="check-control" for="recaptcha">
							<?php echo $captcha->render(); ?>
							</label>
						</li>
					<?php endif; ?>
					
					<li><input type="submit" class="button" name="submit" value="Send Enquiry" ></li>
				</ul>
				</fieldset>
			</form>
			<?php echo $captcha->getScript(); ?>