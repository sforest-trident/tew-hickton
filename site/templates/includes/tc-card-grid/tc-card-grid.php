<?php
/*
Format data as schema below and place directly above the include call on parent page.

$card_grid_data = (object)[
    'id' => "unique-id",
    'heading' => "HTML block containing section heading/blurb",
    'cards' => [An array of card objects]
]
*/
?>

<section class="tc-card-grid" id="<?php echo $card_grid_data->id ;?>">
    <header class="tc-card-grid-heading-container">
        <?php
            echo $card_grid_data->heading;
        ?>
    </header>
    <main class="tc-card-grid-main-container">
        <?php
            foreach ($card_grid_data->cards as $card) {
                echo "<article class='tc-card-grid-card'>";
                    echo $card;
                echo "</article>";
            }
        ?>
    </main>

</section>