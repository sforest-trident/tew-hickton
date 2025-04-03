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

<section class="tc-card-block" id="<?php echo $card_block_data->id ;?>">
    <div class="inner inner-narrow">    
        <header class="tc-card-block-heading-container">
            <?php
                echo $card_grid_data->heading;
            ?>
        </header>
        <main class="tc-card-block-main-container">
            
            <?php
                foreach ($card_block_data->cards as $card) {
                    echo "<article class='tc-card-block-card'>";
                        echo $card;
                    echo "</article>";
                }
            ?>
        </main>
    </div>
</section>