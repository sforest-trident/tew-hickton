<?php if($page->hero_image->count()) { 
	$position = $page->hero_position !='' ? $page->hero_position->name : "50%";
?>
	<style scoped>
		.hero {
			background-image: url('<?php echo $page->hero_image->first->width(800)->url; ?>');
			background-size:cover;
			background-position: 50% <?php echo $position; ?>;
			background-repeat: no-repeat;
			/*background-attachment: fixed;*/
			}
		@media only screen and (min-width: 37.5em) {
			.hero {
				background-image: url('<?php echo $page->hero_image->first->width(1040)->url; ?>');
				}	
		}
		@media only screen and (min-width: 1200px) {
			.hero {
				background-image: url('<?php echo $page->hero_image->first->width(1920)->url; ?>');
				}	
		}

		<?php if(count($page->hero_image) > 1) { ?>
		.hero-two {
			background-image: url('<?php echo $page->hero_image->eq(1)->width(800)->url; ?>');
			background-size:cover;
			background-position: 50% <?php echo $position; ?>;
			background-repeat: no-repeat;
			}
		@media only screen and (min-width: 37.5em) {
			.hero-two {
				background-image: url('<?php echo $page->hero_image->eq(1)->width(1040)->url; ?>');
				}	
		}
		@media only screen and (min-width: 1200px) {
			.hero-two {
				background-image: url('<?php echo $page->hero_image->eq(1)->width(1920)->url; ?>');
				}	
		}
		<?php } ?>
	</style>
<?php } else { ?>
	<style scoped>
		.hero {
			background-image: url('https://source.unsplash.com/random/800x300?flowers');
			background-size:cover;
			background-position: 50% 50%;
			background-repeat: no-repeat;
			}
		@media only screen and (min-width: 37.5em) {
			.hero {
				background-image: url('https://source.unsplash.com/random/1000x435?flowers');
				}	
		}
		@media only screen and (min-width: 1200px) {
			.hero {
				background-image: url('https://source.unsplash.com/random/1920x550?flowers');
				}	
		}
	</style>	
<?php } ?>