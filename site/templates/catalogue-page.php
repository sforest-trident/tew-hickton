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
		<div class="inner inner-narrow">
			<h1 class="centered"><?php echo $page->get("headline|title"); ?></h1>
			<div class="cms-text">
				<?php echo $page->body; ?>
			</div>
		</div>
	</section>
			
	<section class="content">
		<div class="inner inner-narrow centered clearfix">
			<?php 
				$categories = $page->children("template=category-page");
				
				if($categories->count()) {
					echo "<h2>Our Catalogue</h2>";
					echo "<div class=\"row padding-10\">";
					foreach($categories as $category) {						
						$options = array('upscaling' => true, 'cropping' => false, 'quality' => 90 );
						
						if(count($category->images)) {
							$image = $category->images->first->width >= $category->images->first->height ? $category->images->first->width(520,$options)->url : $category->images->first->height(520,$options)->url ;
						} else {
							$image = $config->urls->templates.'images/avatar.jpg';
						}

						echo "<div class=\"col col-1of3\">
							<div class=\"product-card\">
								<a href=\"{$category->url}\">
								<div class=\"product-image-wrapper\">
								<img src=\"{$image}\" class=\"product-image\" alt=\"{$category->title}\" />
								</div>
								
								<h4>{$category->get('headline|title')}</h4>
								</a>
							</div>
						</div>";
					}
					echo "</div>";
				}
			?>
		</div>
	</section>

<?php 
include("./includes/membership-badges.inc");
include("./includes/foot.inc");
?>