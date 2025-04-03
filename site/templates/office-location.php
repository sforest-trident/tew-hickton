<?php
//-- Contact Section -- //
include("./includes/contact-form-section/contact-form-section__head.inc");

if($page->external_redirect !='') {

	$session->redirect($page->external_redirect);

}

include("./includes/head.inc");

include("./includes/responsive-hero.inc");

$contrast = $page->hero_text_color == 1 ? ' reversed' : '';

//$justify  = $page->flex_justify != '' ? $page->flex_justify->value : 'flex-left';

//$align    = $page->flex_align != '' ? $page->flex_align->value : 'flex-middle';


// Phone number sanitizer to make it clickable for a phone.
function sanitizePhoneNumber($phone) {
    // Remove all non-numeric characters except + at the beginning
    $phone = preg_replace('/[^0-9+]/', '', $phone);
    
    // Ensure it starts with a plus sign or a valid country code
    if (strpos($phone, '+') !== 0) {
        $phone = '+' . ltrim($phone, '0'); // Convert leading zeros to +
    }
    
    return $phone;
}

?>


	<section class="top hero">

		<?php if($page->page_hero_on==1) {

			echo "<div class=\"inner flex-container\">";

			echo "<div class=\"hero-content {$contrast}\">

				{$page->hero_text}

				</div>";

			echo "</div>";

			}

		?>

	</section>


	<!-- Page Content  -->
	<section class="content main-content-section">
		<div class="inner inner-narrow clearfix">
			<h1 class="centered"><?php echo $page->get("headline|title"); ?></h1>
			<div class="cms-text">
				<section class="page-body">
					<?php echo $page->body; ?>
				</section>
			</div>
		</div>
	</section>

	<section class="content main-content-section contact-block-section">
		<div class="inner inner-narrow clearfix contact-block">
			<!-- Address / Contact Block -->
			<h3 class="cb-title">Get in touch</h3> 
			<div class="cb-wrapper">
				<div class="col address-block">
					<address>
						<?php echo str_replace(",", ",<br/>", $page->office_location->address); ?>
					</address>
				</div>
				
				<div class="col contact-details-block">
					<?php if($page->office_telephone): ?><div class="row telephone-row"><span class="row-title text-accent">Tel:</span> <a href="<?php echo 'tel:'.sanitizePhoneNumber($page->office_telephone); ?>" class="row-data target_telephone" id="target_telephone"><?php echo $page->office_telephone; ?></a></div><?php endif; ?>
					<?php if($page->office_email): ?><div class="row email-row"><span class="row-title text-accent">Email:</span> <a href="<?php echo 'mailto:'.htmlspecialchars($page->office_email); ?>" class="row-data target_email" id="target_email"><?php echo htmlspecialchars($page->office_email); ?></a></div><?php endif; ?>
					<?php if($page->sidebar): ?><div class="row hours-row"><span class="row-title text-accent">Opening hours:</span> <span class="row-data"><?php echo $page->sidebar; ?></span></div><?php endif; ?>
				</div>
			</div>
		</div>
	</section>


	<?php //-- Gallery Section -- // ?>
	<?php include("./includes/gallery-section.inc"); ?>

	<?php //-- FAQ Section -- // ?>
	<?php include("./includes/faq-section.inc"); ?>

	<?php //-- Brochure Promo Section -- // ?>
	<?php include("./includes/promo-blocks/download-brochure.inc"); ?>

	<?php //-- Reviews Section -- // ?>
	<?php include("./includes/reviews-section.inc"); ?>
			
	<?php //-- Contact Section (2 of 2)-- // ?>
	<?php include("./includes/contact-form-section/contact-form-section__body.inc"); ?>
	
	<?php //-- Map Section -- // ?>
	<?php include("./includes/map-section.inc"); ?>

	<?php //-- Membership Badges Section -- // ?>
	<?php include("./includes/membership-badges.inc"); ?>


<?php 

include("./includes/foot.inc");

?>