<?php 
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

	<section class="content main-content-section google-reviews">
		<div class="inner inner-narrow">
			<h1 class="centered"><?php echo $page->get("headline|title"); ?></h1>
			<div class="cms-text centered" style="margin-bottom: 40px;">
				<?php echo $page->body; ?>
			</div>

			<!-- Google reviews -->
			<div data-token="NFsyJo5hdkSA70S75oE83UTz8z8fnvPLMRFnjT1vQ1TYx48PmX" class="romw-reviews"></div> 
			<script src="https://reviewsonmywebsite.com/js/embedLoader.js?id=9b3acdde2be3481c94dd" type="text/javascript"></script>

			<?php if($page->children) {
				foreach($page->children as $testimonial) {
					$relativeDate = wireRelativeTimeStr($testimonial->generic_date);
					echo "<div class=\"source\">
							<p class=\"avatar-wrap\"><img src=\"{$config->urls->templates}images/small-avatar.png\" class=\"myavatar\" alt='testimonial avatar'/></p>
							<h3 class=\"romw-author-stars\" style=\"font-size: 18px;margin: 1.5em 0 0.3em;\">{$testimonial->title}</h3>
							<p class=\"romw-date\">&nbsp;</p>
							<!-- <p class=\"romw-date\">{$relativeDate}</p> -->
						</div>";
					echo "<div>
						{$testimonial->body}
						</div>";

				}
			} ?>
		</div>		
	</section>

<?php 
include("./includes/foot.inc");
?>