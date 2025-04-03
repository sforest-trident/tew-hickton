<?php 
// Set dataId as site settings default. This is the 'All' catch-all.
$dataId = $pages->get("template=site-variables")->review_id;

// If Review ID is set in the admin page, use it instead.
$dataId = ($page->review_id ? $page->review_id : $dataId);
?>


<?php if($dataId !== null && $dataId > 0): ?>
<!-- Section: Reviews -->
<section class="content main-content-section review-section">
    <div class="inner inner-narrow clearfix">
        <h3 class="rs--heading h3">What our customers say</h3>
        <div class="key-topics-section anchor" data-content="tab-1" id="">
            <div class="tr-widget" data-id="<?php echo $dataId; ?>" data-view="grid2" data-lang=""></div>
        </div>

	    <script type="text/javascript" src="https://cdn.trust.reviews/widget/embed.min.js" defer></script>
    </div>
</section>
<!-- / Section: Reviews -->
<?php endif; ?>

