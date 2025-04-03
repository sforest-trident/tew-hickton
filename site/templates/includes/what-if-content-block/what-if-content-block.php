<?php
/*
Template: What If page  content block
Template that displays content to the left with an image / image grid to the right (on desktop)
*/
?>

<?php 

// Get Component CSS file (if exists) and write out to page.
$cssPath = getcwd().'/includes/what-if-content-block/what-if-content-block.css'; 
if(file_exists($cssPath)) : ?>
    <style>    
        <?php echo file_get_contents(trim($cssPath)); ?>
    </style>
<?php endif; ?>


<?php // --- Component code -- ?>
<section class="what-if-content-block content main-content-section" id="<?php echo $component_data->id ;?>">
    <div class="inner inner-narrow">
        <?php
            foreach ($component_data->items as $child) {
                ?>
                <article class="wi_cb--wrapper">
                    <div class="wi_cb--content-wrapper col">
                        <h3><?php echo $child['heading']; ?></h3>

                        <div>
                            <?php echo $child['body']; ?>
                        </div>
                    </div>

                    <div class="wi_cb--img-block-wrapper col <?php echo((count($child['images']) > 1) ? 'image-grid' : ''); ?>">
                        <?php
                        foreach ($child['images'] as $img) :
                            ?>
                            <div><img src="<?php echo $img['url']; ?>" /></div>
                            <?php
                        endforeach;
                        ?>
                    </div>
                </article>
            <?php
            }
        ?>
    </div>
</section>