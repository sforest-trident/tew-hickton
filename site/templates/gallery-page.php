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
		<div class="inner clearfix">
			<div class="cms-text">
				<?php echo $page->body; ?>
			</div>
					
			<?php 
				//$galleries = $page->children("template=simple-page");
				$heros = $pages->find("hero_image!=''");
				if(count($heros)) {
					echo "<p>{$heros->count()} pages with Hero images</p>";
					foreach($heros as $hero) {
						foreach($hero->hero_image as $image) {
						
							echo "<div style=\"margin: 0 0 20px;\">
								<img src=\"{$image->url}\" style=\"width:100%;\" />
								<p>Page: <a href=\"$hero->url\">{$hero->title}</a> - Image: {$image}</p>
								</div>";
						}

					}
				} ?>
				
			<?php
			/*
				$missing = $pages->find("hero_image='', status=published");
				if(count($missing)) {
					echo "<p>{$missing->count()} pages without Hero images</p>";
					foreach($missing as $p) {
						echo "<p>Page: <a href=\"$p->url\">{$p->title}</a></p>";
					}
				}
			*/
			?>
				
		</div>
	</section>

<?php 
include("./includes/foot.inc");
/*
echo "<div style=\"margin: 0 0 20px;\">
	<img src=\"{$hero->hero_image->first->url}\" style=\"width:100%;\" />
	<p>Page: <a href=\"$hero->url\">{$hero->title}</a> - Image: {$hero->hero_image->first}</p>
	</div>";
*/
?>