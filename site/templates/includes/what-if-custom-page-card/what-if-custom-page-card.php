<?php
/*
Format data as schema below and place directly above the include call on parent page.

$card_grid_data = (object)[
    'id' => "unique-id",
    'heading' => "HTML block containing section heading/blurb",
    'cards' => [An array of card objects]
]
*/
// Get Component CSS file (if exists) and write out to page.
?>

<section class="tc-card-block wi_custom-card-block" >
    <div class="inner inner-narrow">    
        <div class="tc-card-block-main-container">
            <article class='tc-card-block-card wi_custom-card'>
            <hr class="icon-blob" />
                <div class="top-bar cms-text">
                    <div class="col tb-content">
                        <h3><?php echo $component->title; ?></h3>
                        <div><?php echo $component->body; ?></div>
                    </div>
                    <div class="col tb-price">
                        <p><strong><?php echo $component->product_price; ?></strong><span class="sup-text">plus crematoriam/officiant</span></p>
                    </div>
                </div>
                <hr />
                <div class="tc-card-body-wrapper wi_custom-card-body-wrapper">
                    <?php
                    foreach($component->custom_content_repeater as $content_block){
                        ?>
                        <div class="col cms-text">
                            <?php echo $content_block->body; ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </article>
        </div>
    </div>
</section>