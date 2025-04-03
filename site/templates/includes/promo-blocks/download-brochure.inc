<?php
/******
* Include: Download brochure
* Description: Calls a generic template to show the download brchure content block.
* Template Requirements: download-brochure-block.
* Author: Scott Forest
*/

$data = $pages->get('template=promo-section-brochure-template');


// If $data has data, then output...

if($data && (!empty($data))):
    ?>
    <!-- Promo Section: Download Brochure -->
    <section class="find-out-more promo-block red promo-brochure-download">
        <div class="inner inner-narrow">
            <div class="pb--body">
                <div class="col body-content">
                    <span class="pb--heading"><?php echo($data->headline); ?></span>
                    <div><?php echo($data->body); ?></div>
                    <div><a class="btn" href="<?php echo($data->download_files->first->url); ?>" target="_blank">Download</a></div>
                </div>
                <figure class="col body-img-block">
                    <img src="<?php echo($data->image_upload->url); ?>" alt="">
                </figure>
            </div>
        </div>
    </section>
    <!-- / Promo Section: Download Brochure -->
<?php
endif;

    