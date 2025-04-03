<?php

// Hickton Funerals

// Get Site Variables

$site = $pages->get("title=Site Settings");

include("includes/functions.php");

?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">



    <?php

        if ($page->seo_maestro) {

            echo $page->seo_maestro->render();

        }

        elseif ($page->seo) {

            echo $page->seo->render;

        }

    ?>



<?php 



// if($page->seo) { 

// 		echo $page->seo->render;

// 	} else {

// 		echo "<title>{$page->get('meta-title|headline|title')} | {$site->site_company}</title>

// 		<meta name=\"description\" content=\"{$page->get('meta-description|summary')}\" >



// 		<!-- BEGIN Open Graph -->

// 		<meta property=\"og:description\" content=\"{$page->get('meta-description|summary')}\" >

// 		<meta property=\"og:site_name\" content=\"{$site->site_company}\" >

// 		<meta property=\"og:url\" content=\"{$site->site_url}{$page->url}\" >

// 		<meta property=\"og:type\" content=\"website\" >

// 		<!-- END Open Graph -->";

// 	}

?>

		<!-- Apple stuff -->

		<meta name="apple-mobile-web-app-capable" content="no" >

		<meta name="apple-mobile-web-app-status-bar-style" content="black" >

		<meta name="format-detection" content="telephone=yes" >



		<!-- Icons -->

		<link rel="Shortcut Icon" href="<?php echo $config->urls->root?>favicon.ico" type="image/x-icon" >

		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo $config->urls->templates?>images/favicons/apple-touch-icon-57x57.png" >

		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $config->urls->templates?>images/favicons/apple-touch-icon-114x114.png" >

		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $config->urls->templates?>images/favicons/apple-touch-icon-72x72.png" >

		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $config->urls->templates?>images/favicons/apple-touch-icon-144x144.png" >

		<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo $config->urls->templates?>images/favicons/apple-touch-icon-60x60.png" >

		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo $config->urls->templates?>images/favicons/apple-touch-icon-120x120.png" >

		<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo $config->urls->templates?>images/favicons/apple-touch-icon-76x76.png" >

		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo $config->urls->templates?>images/favicons/apple-touch-icon-152x152.png" >

		<link rel="icon" type="image/png" href="<?php echo $config->urls->templates?>images/favicons/favicon-196x196.png" sizes="196x196" >

		<link rel="icon" type="image/png" href="<?php echo $config->urls->templates?>images/favicons/favicon-96x96.png" sizes="96x96" >

		<link rel="icon" type="image/png" href="<?php echo $config->urls->templates?>images/favicons/favicon-32x32.png" sizes="32x32" >

		<link rel="icon" type="image/png" href="<?php echo $config->urls->templates?>images/favicons/favicon-16x16.png" sizes="16x16" >

		<link rel="icon" type="image/png" href="<?php echo $config->urls->templates?>images/favicons/favicon-128.png" sizes="128x128" >



		

		<!-- Robots and Viewport -->

		<meta name="robots" content="index, follow" >

		<meta http-equiv="X-UA-Compatible" content="IE=edge" >

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

	

        <!-- Google Verification -->

        <?php if($site->site_verification) { ?>

        		<meta name="google-site-verification" content="<?php echo $site->site_verification; ?>" >

        <?php } ?>



        <!-- Hotjar Code -->

        <?php if($site->site_hotjar_code) {

        		echo $site->site_hotjar_code;

        } ?>



        <!-- Meta Pixel Code -->

        <?php if($site->site_metapixel_code) {

            echo $site->site_metapixel_code;

        } ?>

		<script src="<?php echo $config->urls->templates?>js/modernizr.js"></script>

	

		<!-- Use Html5Shiv in order to allow IE render HTML5 -->

		<!--[if IE]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->



		<!-- Fonts -->

		<!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,600,700&display=swap" rel="stylesheet"> -->

		<style>

			@font-face{

				font-family:"Gentleman Light";

				src:url("<?php echo $config->urls->templates?>fonts/5159930/e36fb57b-ea73-4647-a0ac-233f23e176a2.eot?#iefix");

				src:url("<?php echo $config->urls->templates?>fonts/5159930/e36fb57b-ea73-4647-a0ac-233f23e176a2.eot?#iefix") format("eot"),url("<?php echo $config->urls->templates?>fonts/5159930/9f9d9e00-f9ef-4f73-afa6-b3aecb4cbf04.woff2") format("woff2"),url("<?php echo $config->urls->templates?>fonts/5159930/8383c67a-ae3a-420c-b678-c2ddee6cb541.woff") format("woff"),url("<?php echo $config->urls->templates?>fonts/5159930/1f615d51-25b0-4bbe-a683-af3fd97fcc27.ttf") format("truetype");

			}

			@font-face{

				font-family:"Gentleman Medium";

				src:url("<?php echo $config->urls->templates?>fonts/5180876/46b5c340-ac41-48b7-87ba-86c11d53f5e9.eot?#iefix");

				src:url("<?php echo $config->urls->templates?>fonts/5180876/46b5c340-ac41-48b7-87ba-86c11d53f5e9.eot?#iefix") format("eot"),url("<?php echo $config->urls->templates?>fonts/5180876/78240b35-1231-46d3-963e-48f5f4655fdc.woff2") format("woff2"),url("<?php echo $config->urls->templates?>fonts/5180876/de27b811-81df-409e-a601-4ec1c3fe40ac.woff") format("woff"),url("<?php echo $config->urls->templates?>fonts/5180876/3ecdb0bd-b80b-48f1-aec2-26d1c291d98e.ttf") format("truetype");

			}

		</style> 

		

		

		<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>css/owl.carousel.css">

		<!-- <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>css/featherlight.min.css">

		<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>css/featherlight.gallery.min.css"> -->

		<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>slick/slick.css" media="screen" >

		<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>slick/slick-theme.css" media="screen" >

		<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>css/magnific-popup.css">

		<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>css/main.css?<?php echo rand(20,25); ?>" >

        <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>includes/tc-card-grid/tc-card-grid.css" >

		<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>includes/what-if-custom-page-card/what-if-custom-page-card.css" >

		<div class="tr-widget" data-id="5763" data-view="badge" data-lang="" style="position:relative;"><a href="https://trust.reviews/" class="trcr" target="_blank">Powered by <span>Trust.Reviews</span></a>

		<div class="tr-override"><a href="https://www.tewhickton.co.uk/about-us/reviews" class="override-link"></a></div>

		</div>

		<script type="text/javascript" src="https://cdn.trust.reviews/widget/embed.min.js" defer></script>

		<!--[if IE]>

  			<link rel="stylesheet" type="text/css" href="all-ie-only.css" >

		<![endif]-->

		<!-- Analytics -->

<?php if($site->site_analytics) { ?>

		<!-- Global site tag (gtag.js) - Google Analytics -->

		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $site->site_analytics; ?>"></script>

		<script>

		window.dataLayer = window.dataLayer || [];

		function gtag(){dataLayer.push(arguments);}

		gtag('js', new Date());gtag('config', '<?php echo $site->site_analytics; ?>');

		</script>

<?php } ?>

		<!-- Begin Cookie Consent plugin by Silktide - https://silktide.com/cookieconsent -->

		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" >

		<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>

		<script>

		window.addEventListener("load", function(){

		window.cookieconsent.initialise({

		  "palette": {

			"popup": {

			  "background": "#000"

			},

			"button": {

			  "background": "#f1d600"

			}

		  },

		  "content": {

			"dismiss": "I Accept",

			"href": "<?php echo $config->HTTPurl; ?>privacy-policy"

		  }

		})});

		</script><!-- End Cookie Consent plugin -->

<?php if($page->template=='home' || $page->template=='office-location' || $page->template=='location-page' || $page->template == 'contact-page') { ?>

	<?php if($site->google_map_api_key !=''): ?>
		<script src='https://maps.googleapis.com/maps/api/js?key=<?php echo $site->google_map_api_key; ?>'></script>
	<?php endif; ?>
<?php } ?>

<?php if($site->google_tag_manager !='') { ?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){
		w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','<?php echo $site->google_tag_manager; ?>');</script>
	<!-- End Google Tag Manager -->
<?php } ?>

	</head>

	<body class="<?php echo 'p-'.$page->parent->name.' t-'.$page->template.' '.$page->name; ?>">

<?php if($site->google_tag_manager !='') { ?>

		<!-- Google Tag Manager (noscript) -->

		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $site->google_tag_manager; ?>"

		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

		<!-- End Google Tag Manager (noscript) -->

<?php } ?>

		<a id="top" href='#'></a>

		

		<div class="side-navigation" id="sidenav" style="background: #333;">

			<div class="cart-wrapper">

				<?php				

					$sideHome = $pages->get("/");

					$sideContact = $pages->get("/contact-us/");

					//$children = $homepage->children->not("name=terms-conditions|site-map");

					$sideChildren = $sideHome->children("menu_top=1");

					$sideChildren->append($sideContact);

					$sideChildren->prepend($sideHome);



					echo "<ul class=\"side-nav\">";

					

					foreach($sideChildren as $child) {

						$class1 = "li-".$child->name;

						$class2 = ($child->numChildren && $child->id!=1 && $child->name!="contact-us") ? 'has-children' : '';

						$class1a = "class='";

						$class1a .= $child === $page->rootParent ? 'on ' : '';

						$class1a .= "'";



						echo "<li class=\"$class1 $class2\"><a $class1a href=\"{$child->url}\">{$child->title}</a> ";

						//For drop-down menus

						if($child->numChildren && $child->name!="contact-us") {

							$subpages = $child->children('parent!=/');

							if($subpages->count) {

								echo "<div class='subnav'>";

								echo "<ul class='{$child->name}'>";



								foreach($subpages as $subpage) {

									$current = $subpage === $page ? " class='on'" : '';

									//$link = $child->name === 'services' ? $child->url.'#'.$subpage->name : $subpage->url;

									echo "<li class=\"{$subpage->name}\"><a {$current} href=\"{$subpage->url}\">{$subpage->title}</a></li>";

								}

								echo "</ul>";

								echo "</div>";

							}

						}

						echo "</li>";

					} ?>

                    <li class="payment-page"><a href="https://www.tewhickton.co.uk/payment-page/" title="Make A Payment">Make A Payment</a></li>

					<li class="mobile-tel"><a href="tel:<?php echo str_replace(' ', '', $site->site_telephone); ?>" target="_blank" title="Call us">Tel: <?php echo $site->site_telephone; ?></a></li>

				</ul>

			</div>

		</div>



		<div class="page-wrapper" id="page">

			<div class="overlay"></div>

			<header class="page-header">				

				<div class="inner page-header-inner <?php if($page->template == 'office-location') { echo "location"; } ?>">

					



<?php 

                        

                        $office_telephone = str_replace(' ', '', $page->office_telephone);

                        $site_telephone_link = str_replace(' ', '', $site->site_telephone);



                        if($page->template == 'office-location') {

                            echo "<div class=\"page-details\">";

							echo "<h2 class=\"h1 office-head\">{$page->title}</h2>";

							echo "<div class=\"header-phone\"><a href=\"tel:{$office_telephone}\" class=\"tel-link\" target=\"_blank\" title=\"Call us\"><span>Tel: </span>{$page->office_telephone}</a></div>";

                            echo "</div>";

						}

?>

                    <div class="logowrap">

						<a href="<?php echo $config->urls->root; ?>" id="logo" >

							<img src="<?php echo $site->site_logo->first->width(1000)->url; ?>" alt="<?php echo $site->site_company; ?>" >

						</a>

					</div>

					

					<div class="header-meta">

						<?php 

                        

                        $office_telephone = str_replace(' ', '', $page->office_telephone);

                        $site_telephone_link = str_replace(' ', '', $site->site_telephone);



                        if($page->template == 'office-location') {



						} else {

							echo "<div class=\"header-phone\"><a href=\"tel:{$site_telephone_link}\" class=\"tel-link\" target=\"_blank\" title=\"Call us\"><span>Tel: </span>{$site->site_telephone}</a></div>";

						}?>

                        <div class="header-column">

                            <div class="header-button"><a href="/payment-page/" class="button button-large button-secondary">Make A Payment</a></div>

						    <div class="header-button"><a href="/contact-us/" class="button button-large button-secondary">Please Contact Us</a></div>

                        </div>

					</div>

					

					<a class="menu-trigger" href="#0"><span class="menu-text" style="display: none;">Menu</span>

					<span class="menu-icon"></span></a>

				</div>

				

				<nav class="main-nav-wrapper">

					<?php

							

					$homepage = $pages->get("/");

					//$children = $homepage->children->not("name=terms-conditions|privacy-policy");

					$children = $homepage->children("menu_top=1");

					$children->prepend($homepage);

					

					$i=0;

					echo "<ul class=\"main-navigation\">";

					foreach($children as $child) {

						$class1 = "li-".$child->name;

						$class2 = $child === $page->rootParent ? 'on ' : '';

						$class3 = $child->name=='services' ? 'has-children' : '';



						echo "<li class=\"nav-level-1 $class1\"><a class=\"$class2 $class3\" href=\"{$child->url}\">{$child->title}</a> ";

						

						//For drop-down menus

						if($child->numChildren && $child!='1') {

							//$subpages = $child->children("parent=about-us|services|our-funeral-homes|funeral-options");

							$subpages = $child->children();

							if(count($subpages)) {



								// Optional: sub-divide long lists; '3' is for columns

								/*

								$theCount = $subpages->count;

								$break = (int)$theCount/3;

								$break = $break+1;

								$ii = 1;

								*/



								echo "<div class='dropnav'>";

								echo "<ul class='{$child->name}'>";



								foreach($subpages as $subpage) {

									$current = $subpage === $page ? " class='on'" : '';

									//$link = $child->name === 'services' ? $child->url.'#'.$subpage->name : $subpage->url;

									echo "<li class=\"nav-level-2 {$subpage->name}\"><a {$current} href=\"{$subpage->url}\">{$subpage->title}</a></li>";

			

									// Optional: see sub-divide above; '8' is where to break

									/*

									if($theCount > 8 && $ii % $break == 0) {

										echo "</ul><ul class='{$child->name}'>";

										}

									$ii++;

									*/

								}

								echo "</ul>";

								echo "</div>";

							}

						}

						echo "</li>";

					$i++;	

					}

					echo "</ul>";

					?>

				</nav>

			</header>

			<!-- end header -->