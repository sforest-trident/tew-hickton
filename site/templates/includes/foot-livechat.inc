	<footer class="page-footer">
		<div class="inner clearfix">
			<div class="row footer-columns">
				<div class="col col-auto">
					<div class="footer-logo">
						<?php if($site->site_logo->count) {
							echo "<a href=\"{$config->urls->root}\"><img src=\"{$site->site_logo->eq(1)->width(300)->url}\" alt=\"{$site->site_company}\" ></a>";
						} ?>
					</div>
					
					<p>Head Office<br >
						<?php echo nl2br($site->site_address); ?></p>
				</div>
	
				<div class="col col-auto"> <!-- col-1of4 -->
					<a class="button button-rev" href="mailto:<?php echo $site->site_email; ?>">Email Us</a>
					<a class="button button-rev" href="tel:<?php echo str_replace(' ', '',$site->site_telephone); ?>"><?php echo $site->site_telephone; ?></a>
					<ul class="social-icons-wrapper">
						<?php 
							echo ($site->site_twitter != '' ? '<li class="social-icon"><a href="'.$site->site_twitter.'" class="social-icon-twitter" target="_blank"><svg><use xlink:href="#twitter-logo"></use></svg></a></li>' : '');
							echo ($site->site_facebook != '' ? '<li class="social-icon"><a href="'.$site->site_facebook.'" class="social-icon-facebook" target="_blank"><svg><use xlink:href="#facebook-logo"></use></svg></a></li>' : '');
							echo ($site->site_instagram != '' ? '<li class="social-icon"><a href="'.$site->site_instagram.'" class="social-icon-instagram" target="_blank"><svg><use xlink:href="#instagram-logo"></use></svg></a></li>' : '');
							echo ($site->site_linkedin != '' ? '<li class="social-icon"><a href="'.$site->site_linkedin.'" class="social-icon-linkedin" target="_blank"><svg><use xlink:href="#linkedin-logo"></use></svg></a></li>' : '');
							echo ($site->site_pinterest != '' ? '<li class="social-icon"><a href="'.$site->site_pinterest.'" class="social-icon-pinterest" target="_blank"><svg><use xlink:href="#pinterest-logo"></use></svg></a></li>' : '');
						?>
					</ul>	
				</div>
				
				<div class="col col-auto">
				<?php
					$homepage = $pages->get("/");
					//$children = $homepage->children->not("name=terms-conditions|privacy-policy");
					$others = $homepage->children("menu_footer=1");
					$others->prepend($homepage);
					
					echo "<ul>";
					foreach($others as $other) {
						echo "<li><a href=\"{$other->url}\">{$other->title}</a></li>";
					}
					echo "</ul>";
				?>
				</div>
				
				<div class="col col-auto">
				<?php
					$locations = $pages->find("parent=our-funeral-homes");
					echo "<ul>";
					foreach($locations as $location) {
						echo "<li><a href=\"{$location->url}\">{$location->title}</a></li>";
					}
					echo "</ul>";
				?>
				</div>
			</div>
			
			<p class="copyright text-center">&copy; Copyright <?php echo date('Y'); ?>. <?php echo $site->site_company; ?> All rights reserved.
			Company No. <?php echo $site->site_company_no; ?>. Website by <a href="https://www.tridentmarketinguk.com">Trident Marketing Anglia Ltd</a>.</p>
		</div>
	</footer>	

	<?php 
	// If the page is editable, then output a link that takes us straight to the page edit screen:
	if($page->editable()) {
		echo "<a class='nav' id='editpage' href='{$config->urls->admin}page/edit/?id={$page->id}'>Edit</a>"; 
	}
	?>
</div>

<div class="top-link">
	<a href="#top">Back to Top</a>
</div>

<svg style="display: none;" xmlns="http://www.w3.org/2000/svg">
	<symbol id="facebook-logo" viewBox="0 0 48 48" xml:space="preserve">
		<title>Facebook</title><g><path d="M25.638355,48 L2.649232,48 C1.185673,48 0,46.813592 0,45.350603 L0,2.649211 C0,1.18585 1.185859,0 2.649232,0 L45.350955,0 C46.813955,0 48,1.18585 48,2.649211 L48,45.350603 C48,46.813778 46.813769,48 45.350955,48 L33.119305,48 L33.119305,29.411755 L39.358521,29.411755 L40.292755,22.167586 L33.119305,22.167586 L33.119305,17.542641 C33.119305,15.445287 33.701712,14.01601 36.70929,14.01601 L40.545311,14.014333 L40.545311,7.535091 C39.881886,7.446808 37.604784,7.24957 34.955552,7.24957 C29.424834,7.24957 25.638355,10.625526 25.638355,16.825209 L25.638355,22.167586 L19.383122,22.167586 L19.383122,29.411755 L25.638355,29.411755 L25.638355,48 L25.638355,48 Z"></path></g>
	</symbol>
	<symbol id="instagram-logo" viewBox="0 0 48 48" xml:space="preserve">
		<title>Instagram</title><g><path d="M24.000048,0 C17.481991,0 16.664686,0.027628 14.104831,0.144427 C11.550311,0.260939 9.805665,0.666687 8.279088,1.260017 C6.700876,1.873258 5.362454,2.693897 4.028128,4.028128 C2.693897,5.362454 1.873258,6.700876 1.260017,8.279088 C0.666687,9.805665 0.260939,11.550311 0.144427,14.104831 C0.027628,16.664686 0,17.481991 0,24.000048 C0,30.518009 0.027628,31.335314 0.144427,33.895169 C0.260939,36.449689 0.666687,38.194335 1.260017,39.720912 C1.873258,41.299124 2.693897,42.637546 4.028128,43.971872 C5.362454,45.306103 6.700876,46.126742 8.279088,46.740079 C9.805665,47.333313 11.550311,47.739061 14.104831,47.855573 C16.664686,47.972372 17.481991,48 24.000048,48 C30.518009,48 31.335314,47.972372 33.895169,47.855573 C36.449689,47.739061 38.194335,47.333313 39.720912,46.740079 C41.299124,46.126742 42.637546,45.306103 43.971872,43.971872 C45.306103,42.637546 46.126742,41.299124 46.740079,39.720912 C47.333313,38.194335 47.739061,36.449689 47.855573,33.895169 C47.972372,31.335314 48,30.518009 48,24.000048 C48,17.481991 47.972372,16.664686 47.855573,14.104831 C47.739061,11.550311 47.333313,9.805665 46.740079,8.279088 C46.126742,6.700876 45.306103,5.362454 43.971872,4.028128 C42.637546,2.693897 41.299124,1.873258 39.720912,1.260017 C38.194335,0.666687 36.449689,0.260939 33.895169,0.144427 C31.335314,0.027628 30.518009,0 24.000048,0 Z M24.000048,4.324317 C30.40826,4.324317 31.167356,4.348801 33.69806,4.464266 C36.038036,4.570966 37.308818,4.961946 38.154513,5.290621 C39.274771,5.725997 40.074262,6.246066 40.91405,7.08595 C41.753934,7.925738 42.274003,8.725229 42.709379,9.845487 C43.038054,10.691182 43.429034,11.961964 43.535734,14.30194 C43.651199,16.832644 43.675683,17.59174 43.675683,24.000048 C43.675683,30.40826 43.651199,31.167356 43.535734,33.69806 C43.429034,36.038036 43.038054,37.308818 42.709379,38.154513 C42.274003,39.274771 41.753934,40.074262 40.91405,40.91405 C40.074262,41.753934 39.274771,42.274003 38.154513,42.709379 C37.308818,43.038054 36.038036,43.429034 33.69806,43.535734 C31.167737,43.651199 30.408736,43.675683 24.000048,43.675683 C17.591264,43.675683 16.832358,43.651199 14.30194,43.535734 C11.961964,43.429034 10.691182,43.038054 9.845487,42.709379 C8.725229,42.274003 7.925738,41.753934 7.08595,40.91405 C6.246161,40.074262 5.725997,39.274771 5.290621,38.154513 C4.961946,37.308818 4.570966,36.038036 4.464266,33.69806 C4.348801,31.167356 4.324317,30.40826 4.324317,24.000048 C4.324317,17.59174 4.348801,16.832644 4.464266,14.30194 C4.570966,11.961964 4.961946,10.691182 5.290621,9.845487 C5.725997,8.725229 6.246066,7.925738 7.08595,7.08595 C7.925738,6.246066 8.725229,5.725997 9.845487,5.290621 C10.691182,4.961946 11.961964,4.570966 14.30194,4.464266 C16.832644,4.348801 17.59174,4.324317 24.000048,4.324317 Z M24.000048,11.675683 C17.193424,11.675683 11.675683,17.193424 11.675683,24.000048 C11.675683,30.806576 17.193424,36.324317 24.000048,36.324317 C30.806576,36.324317 36.324317,30.806576 36.324317,24.000048 C36.324317,17.193424 30.806576,11.675683 24.000048,11.675683 Z M24.000048,32 C19.581701,32 16,28.418299 16,24.000048 C16,19.581701 19.581701,16 24.000048,16 C28.418299,16 32,19.581701 32,24.000048 C32,28.418299 28.418299,32 24.000048,32 Z M39.691284,11.188768 C39.691284,12.779365 38.401829,14.068724 36.811232,14.068724 C35.22073,14.068724 33.931276,12.779365 33.931276,11.188768 C33.931276,9.598171 35.22073,8.308716 36.811232,8.308716 C38.401829,8.308716 39.691284,9.598171 39.691284,11.188768 Z"></path></g>
	</symbol>
	<symbol id="linkedin-logo" viewBox="0 0 48 48" xml:space="preserve">
		<title>LinkedIn</title><g><path d="M44.4440988,0 C46.4013777,0 48,1.5492903 48,3.4585706 L48,44.5347629 C48,46.4467098 46.4013777,47.9986667 44.4440988,47.9986667 L3.53990167,47.9986667 C1.58662259,47.9986667 0,46.4467098 0,44.5347629 L0,3.4585706 C0,1.5492903 1.58662259,0 3.53990167,0 L44.4440988,0 Z M40.8988639,40.9001972 L40.8988639,28.3365462 C40.8988639,22.1673842 39.5669009,17.4248493 32.363101,17.4248493 C28.9005305,17.4248493 26.5765951,19.3234632 25.6272881,21.1247465 L25.5286242,21.1247465 L25.5286242,17.9955001 L18.7048138,17.9955001 L18.7048138,40.9001972 L25.8152829,40.9001972 L25.8152829,29.5698453 C25.8152829,26.580595 26.3806005,23.6886753 30.0858309,23.6886753 C33.7350629,23.6886753 33.7857282,27.1059137 33.7857282,29.7618399 L33.7857282,40.9001972 L40.8988639,40.9001972 Z M10.67837,14.8622538 C12.9556401,14.8622538 14.8049221,13.0129719 14.8049221,10.7343685 C14.8049221,8.45843171 12.9556401,6.60781645 10.67837,6.60781645 C8.3904336,6.60781645 6.54781812,8.45843171 6.54781812,10.7343685 C6.54781812,13.0129719 8.3904336,14.8622538 10.67837,14.8622538 Z M7.11313575,40.9001972 L14.2396045,40.9001972 L14.2396045,17.9955001 L7.11313575,17.9955001 L7.11313575,40.9001972 Z"></path></g>
	</symbol>
	<symbol id="twitter-logo" viewBox="0 0 48 40" xml:space="preserve">
		<title>Twitter</title><g><path d="M48,4.735283 C46.236309,5.538462 44.337383,6.081618 42.345483,6.324305 C44.379644,5.076201 45.940482,3.097147 46.675823,0.739617 C44.771263,1.895269 42.666667,2.736006 40.418384,3.18671 C38.626519,1.224991 36.065504,0 33.231203,0 C27.796443,0 23.387216,4.521488 23.387216,10.097508 C23.387216,10.88913 23.471738,11.657638 23.640782,12.397255 C15.456242,11.975442 8.201444,7.959552 3.341433,1.843265 C2.493397,3.339834 2.008804,5.076201 2.008804,6.925244 C2.008804,10.426869 3.747139,13.518238 6.389857,15.329722 C4.778306,15.280607 3.256911,14.821235 1.9271,14.070061 L1.9271,14.194294 C1.9271,19.08848 5.322064,23.17082 9.8299,24.095341 C9.004402,24.33225 8.133826,24.450704 7.235077,24.450704 C6.601162,24.450704 5.981335,24.390033 5.381229,24.271578 C6.634971,28.28169 10.269414,31.2026 14.580032,31.280607 C11.210424,33.99061 6.961789,35.605634 2.349709,35.605634 C1.555203,35.605634 0.769149,35.559408 0,35.466956 C4.358514,38.327194 9.53689,40 15.095615,40 C33.211481,40 43.114633,24.615385 43.114633,11.270495 C43.114633,10.831347 43.106181,10.392199 43.089276,9.961719 C45.013559,8.537378 46.684275,6.760563 48,4.735283"></path></g>
	</symbol>
</svg>

	<!-- Scripts -->
	<script src="<?php echo $config->urls->templates?>js/jquery-2.1.1.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
	<script src="<?php echo $config->urls->templates?>js/jquery.easing.1.3.js"></script>
	<script src="<?php echo $config->urls->templates?>js/jquery-scrolltofixed-min.js"></script>
	<script src="<?php echo $config->urls->templates?>js/owl.carousel.min.js"></script>
	<!-- <script src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script> -->
	<script src="<?php echo $config->urls->templates?>slick/slick.min.js"></script>
	
	<script src="<?php echo $config->urls->templates?>js/isotope.pkgd.min.js"></script>
	<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
	<script src="<?php echo $config->urls->templates?>js/magnific.min.js"></script>
	<script src="<?php echo $config->urls->siteModules?>SimpleContactForm/resources/jquery.simplecontactform.js"></script>
	<script src="<?php echo $config->urls->templates?>js/main.js"></script>

<?php if($page->template == 'home' || $page->template == 'location-page' || $page->template == 'contact-page') { ?>
	<!-- StoreFinder -->
	<script src="<?php echo $config->urls->siteModules; ?>MarkupStoreLocator/assets/js/libs/handlebars.min.js"></script>
	<script src="<?php echo $config->urls->siteModules; ?>MarkupStoreLocator/assets/js/plugins/storeLocator/jquery.storelocator.js"></script>
	<script>
		$(function() {		
			$('#bh-sl-map-container').storeLocator({
				'mapSettings' : {
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					zoom     : 12,
					styles: [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}],
				},
				'dataLocation': '/locations/',
				'bounceMarker': true,
				'markerImg': '<?php echo $config->urls->templates; ?>images/map-pin.png',
				'markerDim': { height: 45, width: 27 },
				'openNearest': true,
				'originMarker': true,
				'originMarkerDim': { height: 45, width: 27 },
				'originMarkerImg': '<?php echo $config->urls->templates; ?>images/map-pin-green.png',
				//'autoComplete': true,
				'dataType': 'xml',
				'slideMap': false,
				//'defaultLoc': true,
				//'defaultLat': 51.508069,
				//'defaultLng': -0.127692,
				'fullMapStart': true,
				'debug': true,
				'autoGeocode': false,
				'dragSearch': true,
				'maxDistance': false,
				'storeLimit': 10,
			});
		});
	</script>
<?php } ?>

	<script>
		$(document).ready(function(){
			$('.owl-carousel').owlCarousel({
				center: true,
				margin:10,
				dots: true,
				//stagePadding: 10,
				animateOut: 'fadeOut',
				lazyLoad: true,
				autoplay:true,
    			autoplayTimeout:6000,
    			autoplayHoverPause:true,
				responsiveClass: true,
				responsive:{
					0:{
						items:1,
						nav:false,
						loop:true
					},
					600:{
						items:1,
						nav:false,
						loop:true,
						dots: true,
						//stagePadding: 60
					},
					1000:{
						items:1,
						nav:true,
						loop:true,
						dots: true,
						//stagePadding: 120
					}
				}
			});
			$('.testimonial-slider').slick({
				dots: true,
				arrows: true,
				infinite: true,
				speed: 1500,
				slidesToShow: 1,
				centerMode: false,
				variableWidth: false,
				autoplay: true,
				autoplaySpeed: 7000,
				/*fade: true,
				cssEase: 'linear'*/
			});
			$('.popup-gallery').magnificPopup({
				delegate: 'a',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				mainClass: 'mfp-img-mobile',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						//return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
					}
				}
			});
		});
	</script>



	<?php if($page->template == 'office-location') { ?>
		<!-- Project/Development Page Map -->
		<?php
			$address = nl2br2($page->office_location->address);
			$zoom = $page->office_location->zoom ? $page->office_location->zoom : '12';
		?>
	
		<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyB66KywlSKy7OmfD02lfJfWm-CDaGs6NA0"></script> -->
		<script>
			var map;
			var contentString = '<div id="balloon" class="info-window">'+
				'<h5 id="" class="firstHeading"><?php echo $page->title; ?></h5>'+
				'<div id="bodyContent">'+
				'<p><?php echo $address; ?><br >Tel: <?php echo $page->office_telephone; ?><br >Email: <?php echo $page->office_email; ?></p>'+
				//'<p>Tel: <?php echo $page->office_telephone; ?><br >email: <?php echo $page->office_email; ?><br ></p>'+
				'</div>'+
				'</div>';
			var infowindow = new google.maps.InfoWindow({
				content: contentString,
				maxWidth: 600
			});
	
			function initialize() {
				var myLatlng = new google.maps.LatLng(<?php echo $page->office_location->lat; ?>,<?php echo $page->office_location->lng; ?>);

				var mapOptions = {
					//zoom: 14,
					zoom: <?php echo $zoom; ?>,
					styles: [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}],
					//styles: [{"featureType":"all","elementType":"geometry.fill","stylers":[{"weight":"2.00"}]},{"featureType":"all","elementType":"geometry.stroke","stylers":[{"color":"#9c9c9c"}]},{"featureType":"all","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#eeeeee"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#7b7b7b"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#c8d7d4"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#070707"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]}],
					center: new google.maps.LatLng(<?php echo $page->office_location->lat; ?>, <?php echo $page->office_location->lng; ?>),
					scrollwheel: false
				};
			
				var icon = {
					url: "<?php echo $config->urls->templates?>images/map-pin.png",
					size: new google.maps.Size(27, 45),
					scaledSize: new google.maps.Size(27, 45)
				};
			
				map = new google.maps.Map(document.getElementById('map-canvas'),
					mapOptions);
					var marker = new google.maps.Marker({
					position: myLatlng,
					map: map,
					//icon: "<?php echo $config->urls->templates?>images/map-marker.png",
					icon: icon,
					title: 'Our Location'
				});
			
				//infowindow.open(map,marker); 
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
			}
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
	<?php } ?>
<!-- Schema Strucured Data -->
<script type="application/ld+json">{"@context":"http://schema.org","@type":"Organization","name":"Trevor E.W. Hickton Ltd","url":"https://www.tewhickton.co.uk/","address":"Whitmore House 8-11 Lower High Street Cradley Heath B64 5AB","sameAs":["https://www.facebook.com/TEWHickton/","https://twitter.com/Hicktons","https://www.instagram.com/hickton_family_funeraldirector/"]}</script>
<!-- Start of Tawk.to Script -->
<script type="text/javascript">
var Tawk_API=Tawk_API||{},
Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e1725cf27773e0d832cadcd/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!-- End of Tawk.to Script -->
</body>
</html>