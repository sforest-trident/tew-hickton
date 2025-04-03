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

	<section class="top hero">

		<?php
        if ($page->id != '3436') {
			echo "<div class=\"inner flex-container {$justify} {$align} clearfix\">";            
                echo "<div class=\"hero-content {$contrast}\">
                    {$page->hero_text}
                    </div>";
			echo "</div>";
        } else {}
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

	<?php
    // --- Render 'What If Content Block(s)' that are children of the page.
    $components = $page->children('template=component-what-if-page-content-block');
    foreach ($components as $component) {

        if ($component->template == 'component-what-if-page-content-block') {
            
            //Create content data array
            $component_data_array = [];
            foreach ($component->children as $child) {
                array_push($component_data_array, array('heading' => $child->title, 'body' => $child->body, 'images' => $child->sidebar_images));
            }

            //Populate Grid

            $component_data = (object)[
                'id' => $component->id,
                'heading' => '',
                'items' => $component_data_array
            ];

            include "./includes/what-if-content-block/what-if-content-block.php";
        }
    }
    // Unset at end of function.
    unset($components, $component, $component_data_array);


     // --- Render 'Cards' component block
     $components = $page->children('template=what-if-custom-page-card');
     foreach ($components as $component) {
         if ($component->template == 'what-if-custom-page-card') {
             
             $template = $component->template->name;
             include "./includes/". $template ."/". $template .".php";

         }
     }
     // Unset at end of function.
     unset($components, $component, $component_data_array);


    //var_dump($page->gallery_images);
    include("./includes/what-if-gallery-section.inc");


    $components = $page->children('template=what-if-faq-content-wrapper');
    foreach ($components as $component) {

        if(!empty($components)){
            //Create content data array
            $component_data_array = [];

            foreach ($component->children as $item){
                array_push($component_data_array, array('title' => $item->title, 'body' => $item->body));
            }

            $component_data['template'] = $component->template->name;
            
            $component_data = (object)[
                'items' => $component_data_array
            ];
        }

        $template = $component->template->name;
        include "./includes/". $template ."/". $template .".php";
    }
    unset($components, $component, $component_data_array);


    // Custom stuff for 'Simple Funeral Options' (as ran out of time to do it as fields / templates in back end) - SF (28/02/25)
    $components = $page->children('template=additional-what-if-content-block-white');
    foreach ($components as $component) {
        include "./includes/additional-what-if-content-block-white/additional-what-if-content-block-white.php";

    }
    unset($components, $component, $component_data_array);


    // Render Grey promo block.
    $components = $page->children('template=grey-content-promo-block');
    foreach ($components as $component) {

        $template = $component->template->name;
        include "./includes/". $template ."/". $template .".php";

    }
    unset($components, $component, $component_data_array);



    


    
    // --- Render 'Find Out More' block
    $components = $page->children('template=more-info-block');

    foreach ($components as $component) {
        //var_dump($component);
        if ($component->template == 'more-info-block') : ?>
            <section class="find-out-more promo-block red">
                <div class="inner inner-narrow">
                    <h3 class="pb--heading"><?php echo $component->title; ?></h3>
                    <div class="pb--body"><?php echo $component->body; ?></div>
                </div>
        </section>
        <?php
        endif;
    }
    // Unset at end of function.
    unset($components, $component, $component_data_array);

// Render Membership Badges.
include("./includes/membership-badges.inc");

// Render Site Footer.
include("./includes/foot.inc");

?>