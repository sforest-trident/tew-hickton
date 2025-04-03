<?php if($page->create_image_gallery==1) { 
	$width = $page->gallery_width->name!="" ? "inner-".$page->gallery_width->name : "";
	//$type = $page->gallery_type->name!="" ? " type-".$page->gallery_type->name : " type-grid";

	echo "<section class=\"content\">
		<div class=\"inner {$width}\">";

	if($page->gallery_type->name=="mosaic") {
		echo "<div class=\"grid popup-gallery\">
				<div class=\"grid-sizer\"></div>
				<div class=\"gutter-sizer\"></div>";
				
		foreach($page->gallery_images as $gallery) {
			$category = $gallery->tags;
			
			echo "<div class=\"grid-item {$category}\">
				<a class=\"thumbnail-link gallery-link\" href=\"{$gallery->width(1000)->url}\" data-lightbox=\"gallery-set\" title=\"View image\">
					<img src=\"{$gallery->width(600)->url}\" alt=\"{$gallery->description}\" />
					<!-- <div class=\"hover-caption\">
						<span>{$gallery->name}</span>
					</div> -->
					<div class=\"gallery-icon\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i></div>
				</a>
				</div>";
		}
		echo "</div>";
	} else if($page->gallery_type->name=="horizontal") {
		// to do	
	} else {
		echo "<div class=\"row padding-10 popup-gallery\">";
		$i=0;
		foreach($page->gallery_images as $image) {
			$photo = $image->size(500,500,array("cropping" => false));
			echo "<div class=\"col col-1of3\">
				<div class=\"gallery-card centered\">
				<a class=\"thumbnail-link gallery-link\" href=\"{$image->width(1000)->url}\" data-lightbox=\"gallery-set\" title=\"View image\">
					<img src=\"{$photo->url}\" class=\"gallery-image\" alt=\"{$image->description}\" style='max-width: 100%; max-height: 260px; margin: 10px auto;' />
					<p>{$image->description}</p>
					<div class=\"gallery-icon\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i></div>
				</a>
				</div>
			</div>";
		$i++;
		}
		echo "</div>";	
	}
	echo "</div>
		</section>";
} ?>
