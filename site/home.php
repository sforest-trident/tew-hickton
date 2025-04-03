<?php
// TEW Hickton
include("./includes/head.inc");
?>

	<section class="top carousel" style="overflow:hidden;">
		<div class="inner inner-full clearfix">
		<?php
		$hero_type = $page->hero_type;
		    if($hero_type=='3') {
				$hero = $pages->find("parent=/home-slider/, sort=sort");
    			if($hero) { 
    				if($hero->count() == 1) {
    					// just one, no slider.
    					echo "<div class=\"hero\">";
    					foreach($hero as $slide) {
    						$nameclass = strtolower(str_replace(" ","",$slide->title));
    						$contrast = $slide->hero_text_color == 1 ? ' reversed' : '';
    						echo "<div class=\"hero-bg\" style=\"background: url('{$slide->hero_image->first->width(1920)->url}') 50% 50% no-repeat; background-size: cover;\">";
    						if($slide->body) {
    							echo "<div class=\"home-hero-content {$contrast}\">{$slide->body}</div>";
    						}
    						echo "</div>";
    					}
    					echo "</div>";				
    				} else {
    					// engage slider.
    					echo "<div class=\"home-hero owl-carousel\">";
    					$i=1;
    					foreach($hero as $slide) {
    						$contrast = $slide->hero_text_color == 1 ? ' reversed' : '';
    						$justify  = $slide->flex_justify != '' ? $slide->flex_justify->value : 'flex-left';
    						$align    = $slide->flex_align != '' ? $slide->flex_align->value : 'flex-middle';
    						
    						$heroOpacity = $slide->hero_overlay ? $slide->hero_overlay : 0;
    						$heroOpacity = $heroOpacity * 0.1;
    					
    						$nameclass = strtolower(str_replace(" ","",$slide->title));
    						
    						echo "<div class=\"hero-bg slide-{$i}\" style=\"background: url('{$slide->hero_image->first->width(1920)->url}') 50% 50% no-repeat; background-size: cover;\" >";
    						echo "<div class=\"hero-overlay\" style=\"background: rgba(0,0,0,{$heroOpacity})\"></div>";
    						echo "<div class=\"inner flex-container {$justify} {$align} clearfix\" >";
    						if($slide->body) {
    							echo "<div class=\"home-hero-content {$contrast}\">{$slide->body}</div>";
    						}
    						echo "</div>";
    						echo "</div>";
    						$i++;
    					}
    					echo "</div>";
    				}
    			}
		    } elseif($hero_type=='2') {
		        $hero_video = $page->hero_video;				echo "<div class=\"hero\">";					echo "<div class=\"home-hero-content\">";						echo $hero_video;					echo "</div>";				echo "</div>";
            } else {}
?>
		</div>
	</section>

<?php if($page->home_notice_display==1) { ?>
	<section class="section-notice dark centered" style="background: #fff;">
		<div class="inner clearfix">
			<div class="about-text cms-text">
			<?php 
				echo $page->home_notice;
			?>
			</div>
		</div>
	</section>
<?php } ?>

	<section class="main-content-section centered">
		<div class="inner clearfix">
			<h1><?php echo $page->get("headline|title"); ?></h1>
			<div class="home-text cms-text">
				<?php echo $page->body; ?>
			</div>
		</div>
	</section>

	<section class="properties-grid-section">
		<div class="inner">
			<div class="row padding-20 flex-cols">
				<?php
					// Office Locations
					$locations = $pages->find("template=office-location, location_image!='', sort=sort, limit=12");
					foreach($locations as $location) {
						$thumb = $location->location_image->first->size(720,520)->url;
						$address = avoidOrphans($location->office_location->address);
						$hours = str_replace("<p>","",$location->sidebar);
						$hours = str_replace("</p>","",$hours);
						$count = $locations->count();
						$columns = ($count==5 or $count==6 or $count==9 or $count==10) ? "col-1of3" : "col-1of4";
						$office_telephone = str_replace(' ', '', $location->office_telephone);
						echo "<div class=\"col {$columns} media-card-col\">
							<div class=\"media-card media-card-rounded centered\">
								<div class=\"media\">
									<a href=\"{$location->url}\">
									<img src=\"{$thumb}\" class=\"thumbnail\" alt=\"{$location->get('headline|title')}\" >
									</a>
								</div>
								<div class=\"card-body\">
									<h3>{$location->title}</h3>
									<p>{$address}</p>
									<p><strong><a href=\"tel:{$office_telephone}\">Tel: {$location->office_telephone}</a></strong></p>
									<div>Office Open:<br/>{$hours}</div>
									<!-- <div class=\"text-right\"><a href=\"{$location->url}\">read more</a></div> -->
								</div>
							</div>
						</div>";
					}
				?>
			</div>
		</div>
	</section>


<?php include("./includes/testimonials.inc"); ?>

	<section class="content">
		<div class="inner inner-narrow clearfix">			
			<form class="centered" id="bh-sl-user-location" method="post" action="#">
				<div class="form-input placefinder">
					<label class="h3" for="bh-sl-address">Find your nearest funeral home</label>
					<div class="field-group">
						<input type="text" class="sl-search-field" id="bh-sl-address" name="bh-sl-address" placeholder="town/postcode" >
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


<?php include("./includes/membership-badges.inc"); ?>

<?php 
include("./includes/foot.inc");
?>