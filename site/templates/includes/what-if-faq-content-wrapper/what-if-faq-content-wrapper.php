<?php
/*
Template: What If page  content block
Template that displays content to the left with an image / image grid to the right (on desktop)
*/
?>

<?php 

// Get Component CSS file (if exists) and write out to page.
$cssPath = getcwd().'/includes/what-if-faq-content-wrapper/what-if-faq-content-wrapper.css'; 
if(file_exists($cssPath)) : ?>
    <style>    
        <?php echo file_get_contents(trim($cssPath)); ?>
    </style>
<?php endif; ?>


<?php // --- Component code -- ?>
<section class="what-if-faq-block content">
    <div class="inner inner-narrow">

    <div class="accordion">
        <?php
            $i = 0;
            foreach ($component_data->items as $child) {   
                ?>
                <article class="wi_faq--wrapper">
                    <div class="wi_faq--content-wrapper">
                            <input id="article<?php echo $i; ?>" type="radio" name="articles" checked>
                            <label for="article<?php echo $i; ?>">
                                <h3 class="wi_faq--heading"><?php echo $child['title']; ?></h3>
                            </label>
                        <div class="wi_faq--body">
                            <div class="inner cms-text">
                                <?php echo $child['body']; ?>
                            </div>
                        </div>
                    </div>
                </article>
            <?php
                $i++;
            }
        ?>
    </div>
</section>