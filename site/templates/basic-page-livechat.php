<?php 
// Hickton
if($page->external_redirect !='') {
	$session->redirect($page->external_redirect);
}
if($page->first_child_redirect===1) {
	$session->redirect($page->child()->url);
}
include("./includes/head.inc");
include("./includes/responsive-hero.inc");

$contrast = $page->hero_text_color == 1 ? ' reversed' : '';
$justify  = $page->flex_justify != '' ? $page->flex_justify->value : 'flex-left';
$align    = $page->flex_align != '' ? $page->flex_align->value : 'flex-middle';

?>
    <?php
        if ($page->title == 'Our Fees and Costs') {
            
        }
        else{
            
        }
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
			</div>
		</div>
	</section>

<?php include("./includes/gallery-section.inc"); ?>

<?php if($page->children->count()) { ?>
	<section class="content">
		<div class="inner inner-narrow clearfix">
			<div class="cms-text">
				<ul>
				<?php
				foreach($page->children as $child) {
                    if ($child->template == 'component-card-grid') {
                        continue;
                    }
					echo "<li><a href=\"{$child->url}\">{$child->title}</a></li>";
				}
				?>
				</ul>
			</div>
		</div>
	</section>
<?php } ?>

<?php

$components = $page->children('template=component-card-grid');
    foreach ($components as $component) {
        if ($component->template == 'component-card-grid') {
            //Creat Cards
            $component_grid_card_array = [];
            foreach ($component->children as $card) {
                $new_card = $card->text_area_1;
                array_push($component_grid_card_array, $new_card);
            }

            //Populate Grid
            $card_grid_data = (object)[
                'id' => $component->id,
                'heading' => '',
                'cards' => $component_grid_card_array
            ];
            include "./includes/tc-card-grid/tc-card-grid.php";
        }
    }

?>

<?php 
include("./includes/membership-badges.inc");
include("./includes/foot-livechat.inc");
?>
