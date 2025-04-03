<?php 
/* Reviews page for Google Reviews
 * Widget from https://admin.trust.reviews/
 * drew@tridentmarketinguk.com
 * Marketing2024!
 */

include("./includes/head.inc");
include("./includes/responsive-hero.inc");

$contrast = $page->hero_text_color == 1 ? ' reversed' : '';
$justify  = $page->flex_justify != '' ? $page->flex_justify->value : 'flex-left';
$align    = $page->flex_align != '' ? $page->flex_align->value : 'flex-middle';


if(strlen($input->urlSegment2)) throw new Wire404Exception();

$dataId = "5698";
switch($input->urlSegment1) {
  case '':
    // Segment 1 is empty so display main content
    $dataId = "5742";
    break;
  case 'All':
    $dataId = "5742";
    break;
  case 'BartlyGreen':
    $dataId = "5698";
    break;
  case 'CastleBromwich':
    $dataId = "5699";
    break;
  case 'CradleyHeath':
    $dataId = "5421";
    break;
  case 'Halesowen':
    $dataId = "5700";
    break;
  case 'Wolverhampton':
    $dataId = "5701";
    break;
  case 'Timmins':
    $dataId = "5702";
    break;
  case 'Codsall':
    $dataId = "5703";
    break;
  case 'Dudley':
    $dataId = "5704";
    break;
  case 'Kidderminster':
    $dataId = "5705";
    break;

  default:
    // Anything else? Throw a 404
    //throw new Wire404Exception();
}

?>
<style>
.rplg-row .rplg-row-right {
	margin-right: 66px;
	}
.rplg div {
	text-align: center;
	}
.rplg .rplg-biz-based {
	text-align: center !important;
	}
.rplg .rplg-review-name {
	color: #000 !important;
	text-align: left;
	}
.rplg-review-time {
	text-align: left !important;
	}
.rplg .rplg-url {
	text-decoration: none;
	border-bottom: 1px solid #df7086  !important;
	box-shadow: inset 0 0 0 #df7086  !important; /* 0 -1px 0 #... */
	color: #000 !important;
	transition: background 0.1s cubic-bezier(.33,.66,.66,1);
	white-space: nowrap;
	display: inline-block;
	margin: 10px auto !important;
	}
.rplg .rplg-url:hover {
	background: #df7086;
	background: rgba(223,112,134,0.3);
	color: #000;
	}
</style>
	<section class="top hero">
		<?php
			echo "<div class=\"inner flex-container {$justify} {$align} clearfix\">";
			echo "<div class=\"hero-content {$contrast}\">
				{$page->hero_text}
				</div>";
			echo "<div id=\"reviews\"></div>";
			echo "</div>";
		?>
	</section>

	<section class="content main-content-section google-reviews" >
		<div class="inner inner-narrow" style="max-width: 900px;">
			<h1 class="centered"><?php echo $page->get("headline|title"); ?></h1>
			<div class="cms-text centered" style="margin-bottom: 40px;">
				<?php echo $page->body; ?>
			</div>

			<!-- Google reviews -->
			<!-- <div data-token="NFsyJo5hdkSA70S75oE83UTz8z8fnvPLMRFnjT1vQ1TYx48PmX" class="romw-reviews"></div> 
			<script src="https://reviewsonmywebsite.com/js/embedLoader.js?id=9b3acdde2be3481c94dd" type="text/javascript"></script> -->

			<div class="filter-tabs">
				<nav class="events-submenu">
					<a class="button filter-toggle" id="filter-menu">Filter by Office</a>
					<ul id="submenu" class="tabs-navigation">
						<li><a data-content="tab-0" href="<?php echo $page->url; ?>All/#reviews" class="tab-link">All Offices</a></li>
						<li><a data-content="tab-1" href="<?php echo $page->url; ?>BartlyGreen/#reviews" class="tab-link">Hickton - Bartly Green</a></li>
						<li><a data-content="tab-2" href="<?php echo $page->url; ?>CastleBromwich/#reviews" class="tab-link">Hickton - Castle Bromwich</a></li>
						<li><a data-content="tab-3" href="<?php echo $page->url; ?>CradleyHeath/#reviews" class="tab-link">Hickton - Cradley Heath</a></li>
						<li><a data-content="tab-4" href="<?php echo $page->url; ?>Halesowen/#reviews" class="tab-link">Hickton - Halesowen</a></li>
						<li><a data-content="tab-5" href="<?php echo $page->url; ?>Wolverhampton/#reviews" class="tab-link">Hickton - Wolverhampton</a></li>
						<li><a data-content="tab-9" href="<?php echo $page->url; ?>Timmins/#reviews" class="tab-link">Mark Roy Timmins - Halesowen</a></li>
						<li><a data-content="tab-6" href="<?php echo $page->url; ?>Codsall/#reviews" class="tab-link">Hickton - Codsall &amp; Bilbrook</a></li>
						<li><a data-content="tab-8" href="<?php echo $page->url; ?>Dudley/#reviews" class="tab-link">Jones Memorials Dudley</a></li>
						<li><a data-content="tab-7" href="<?php echo $page->url; ?>Kidderminster/#reviews" class="tab-link">Hickton - Kidderminster &amp; Stourport</a></li>
					</ul>
				</nav>


				<ul class="tabs-content">
					<li class="key-topics-section anchor" data-content="tab-1" id="BartlyGreen">
						<div class="tr-widget bartly-green" data-id="<?php echo $dataId; ?>" data-view="grid2" data-lang=""></div>
					</li>
				</ul>

<!-- <div class="tr-widget" data-id="5742" data-view="grid2" data-lang=""><a href="https://trust.reviews/" class="trcr" target="_blank">Powered by <span>Trust.Reviews</span></a></div><script type="text/javascript" src="https://cdn.trust.reviews/widget/embed.min.js" defer></script> -->

				<!-- <ul class="tabs-content">
					<li class="key-topics-section anchor" data-content="tab-1" id="BartlyGreen">
						<div class="tr-widget bartly-green" data-id="5698" data-view="grid2" data-lang=""></div>
					</li>
					<li class="key-topics-section anchor" data-content="tab-2" id="CastleBromwich">
						<div class="tr-widget castle-bromwich" data-id="5699" data-view="grid2" data-lang=""></div>
					</li>
					<li class="key-topics-section anchor" data-content="tab-3" id="CradleyHeath">
						<div class="tr-widget cradley-heath" data-id="5421" data-view="grid2" data-lang=""></div>
					</li>
					<li class="key-topics-section anchor" data-content="tab-4" id="Halesowen">
						<div class="tr-widget hales-owen" data-id="5700" data-view="grid2" data-lang=""></div>
					</li>
					<li class="key-topics-section anchor" data-content="tab-5" id="Wolverhampton">
						<div class="tr-widget wolverhampton" data-id="5701" data-view="grid2" data-lang=""></div>
					</li>
					<li class="key-topics-section anchor" data-content="tab-6" id="Codsall">
						<div class="tr-widget mark-roy" data-id="5703" data-view="grid2" data-lang=""></div>
					</li>
					<li class="key-topics-section anchor" data-content="tab-7" id="Kidderminster">
						<div class="tr-widget codsail" data-id="5705" data-view="grid2" data-lang=""></div>
					</li>
					<li class="key-topics-section anchor" data-content="tab-8" id="Dudley">
						<div class="tr-widget dudley" data-id="5704" data-view="grid2" data-lang=""></div>
					</li>
					<li class="key-topics-section anchor" data-content="tab-9" id="Timmins">
						<div class="tr-widget kidderminster" data-id="5702" data-view="grid2" data-lang=""></div>
					</li>
				</ul> -->
				<script type="text/javascript" src="https://cdn.trust.reviews/widget/embed.min.js" defer></script>
			</div>
		</div>		
	</section>

<?php 
include("./includes/foot.inc");
?>