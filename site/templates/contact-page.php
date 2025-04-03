<?php
// Hickton Funerals
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
} else {

	include("./includes/head.inc");
	include("./includes/responsive-hero.inc");
	
	$contrast = $page->hero_text_color == 1 ? ' reversed' : '';
	$justify  = $page->flex_justify != '' ? $page->flex_justify->value : 'flex-left';
	$align    = $page->flex_align != '' ? $page->flex_align->value : 'flex-middle';
?>

	<section class="top hero">
		<?php
			echo "<div class=\"inner flex-container {$justify} {$align} clearfix\">";
			echo "<div class=\"hero-content {$contrast}\">
				{$page->hero_text}
				</div>";
			echo "</div>";
		?>
	</section>

	<section class="content main-content-section">
		<div class="inner inner-narrow clearfix">
			<h1 class="centered"><?php echo $page->get("headline|title"); ?></h1>
			<div class="cms-text">
				<?php echo $page->body; ?>
			</div>
					
			<div class="contact-details" style="margin: 30px 0;">					
				<div class="fieldset clearfix">
					<h3>General Enquiries <span class="required-text">* required fields</span></h3>
					
					<?php
						$scf = $modules->get('SimpleContactForm');
						include("./includes/message.php");
						
						//$altEmail = $page->alt_recipient!='' ? $page->alt_recipient : "";

						$options = array(
							'emailSubject' => 'From the T.E.W Hickton Contact Form',
							'emailMessage' => $emailMessage,
							'btnText' => 'Send Enquiry',
							//'btnClass' => 'button-full',
							//'emailAdd' => true,
							'emailReplyTo' => $input->c_email,
							'emailAddTo' => 'developer@tridentmarketingdev.co.uk',
							'errorMessage' => 'Please check that you have entered all the required fields correctly.',
							'successMessage' => 'Thank you. Your message has been sent. Someone from our office will contact you soon.'
						);

						// Send to additional recipient (if configured)
						if($page->alt_recipient!='') {
							$options["emailAddTo"]=$page->alt_recipient;
						}
						
						// If page_link field has a value set, use this as the form redirect location.
						if($page->page_link){
							$options['redirectSamePage'] = false;
							$options['redirectPage'] = $page->page_link->id;
						}
					?>
					<div><?php echo $scf->render($options); ?></div>
				</div>
			</div>			
		</div>
	</section>
	
	<section class="content">
		<div class="inner inner-narrow clearfix">			
			<form class="centered" id="bh-sl-user-location" method="post" action="#">
				<div class="form-input placefinder">
					<label class="h3" for="bh-sl-address">Find your nearest funeral home</label>
					<div class="field-group">
						<input type="text" class="sl-search-field" id="bh-sl-address" name="bh-sl-address" placeholder="town/postcode" />
						<button id="bh-sl-submit" type="submit"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
		</div>
	</section>

	<div class="bh-sl-map-container" id="bh-sl-map-container" style="background: #f9f9f9;">
		<div class="bh-sl-map" id="bh-sl-map" ></div>
		<!--- <div class="bh-sl-loc-list"><ul class="list"></ul></div> -->
	</div>
	
<?php 
include("./includes/membership-badges.inc");
include("./includes/foot.inc");
}
?>