<?php 
include("./includes/head.inc");
if($page->page_hero_on==1) {
include("./includes/responsive-hero.inc");
}

$contrast = $page->hero_text_color == 1 ? ' reversed' : '';
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

	<section class="content main-content-section">
		<div class="inner inner-narrow">
			<h1 class="centered"><?php echo $page->get("headline|title"); ?></h1>
			<div class="cms-text">
				<?php echo $page->body; ?>
			</div>
			
			<div class="cms-text centered" style="margin: 50px 0 30px;">
				<h3>All Categories</h3>
				<?php 
					$categories = $pages->find("template=category-page, sort=sort");
					
					echo "<ul class=\"product-category-menu centered\">";
					foreach($categories as $category) {
						$on = $category->name == $page->name ? "active" : "";
						echo "<li><a class=\"{$on}\" href=\"{$category->url}\">{$category->title}</a></li>";
					}
					echo "</ul>";
				?>
			</div>

			<?php 
				$products = $page->children("template=product-page, limit=21");

				if($products) {
					echo "<div class=\"row padding-10 centered\">";
					$i=0;
					foreach($products as $product) {
						/*
						$mainDim = $product->images->width >= $product->images->height ? $product->images->width : $product->images->height;
						$stuff = $mainDim.",".$mainDim;
						*/
						$options = array('upscaling' => true, 'cropping' => false, 'quality' => 90 );
						
						if(count($product->images)) {
							$image = $product->images->first->width >= $product->images->first->height ? $product->images->first->width(520,$options)->url : $product->images->first->height(520,$options)->url ;
						} else {
							$image = $config->urls->templates.'images/avatar.jpg';
						}
						
						//$image = $product->images->count() ? $product->images->first()->width(500,array("cropping" => false)) : "";
						$price = $product->product_price !='' ? " – {$product->product_price}" : "";
					
						echo "<div class=\"col col-1of3\">
							<div class=\"product-card\">
								<div class=\"product-image-wrapper\">
								<img src=\"{$image}\" class=\"product-image\" alt=\"{$product->title}\" />
								</div>
								<h4>{$product->title} {$price}</h4>
								<div class=\"product-description\">{$product->body}</div>
							</div>
						</div>";
					$i++;
					}
					echo "</div>";
					$pagination = $products->renderPager();
					echo $pagination;
				}
			?>
		</div>
	</section>

<?php 
include("./includes/membership-badges.inc");
include("./includes/foot.inc");
?>