<?php
include("./includes/head.inc");
//include("./includes/responsive-hero.inc");
?>

	<section class="top hero">
	</section>


	<section class="content main-content-section">
		<div class="inner inner-narrow clearfix">
			<h1 class="centered"><?php echo $page->get("headline|title"); ?></h1>
			<div class="cms-text">
				<?php echo $page->payment_code; ?>
				<p>&nbsp;</p>
				<?php echo $page->fca_wording; ?>
			</div>
		</div>
	</section>

<?php
include("./includes/membership-badges.inc");
include("./includes/foot.inc");
?>