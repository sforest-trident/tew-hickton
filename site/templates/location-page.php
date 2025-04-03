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

	<section class="content main-content-section">
		<div class="inner inner-narrow clearfix">
			<h1 class="centered"><?php echo $page->get("headline|title"); ?></h1>
			<div class="cms-text">
				<?php echo $page->body; ?>
				
				<?php
					$locations = $pages->find("template=office-location");
					foreach($locations as $location) {
						echo "<p><strong><a href=\"{$location->url}\" title=\"{$location->get('headline|title')}\">{$location->get('headline|title')}</a></strong><br>
							{$location->office_location->address}<br>
							Tel: <a href=\"tel:{$location->office_telephone}\">{$location->office_telephone}</a><br />
							Email: <a href=\"mailto:{$location->office_email}\">{$location->office_email}</a></p>";
					}
				?>
			</div>

			<form class="location-form centered" id="bh-sl-user-location" method="post" action="#">
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
	</div>


<?php include("./includes/gallery-section.inc"); ?>

<?php 
include("./includes/membership-badges.inc");
include("./includes/foot.inc");
?>