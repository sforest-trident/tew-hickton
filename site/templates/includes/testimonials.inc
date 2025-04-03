<?php $testimonials = $pages->get("name=testimonials")->children(); ?>
	<section class="section-testimonials centered clearfix" id="testimonials">
		<div class="inner">
			<h3><?php echo $pages->get("name=testimonials")->title; ?></h3>
			<div class="testimonials-wrapper centered">
				<div class="testimonial-slider">
				<?php
					foreach($testimonials as $testimonial) {
						$summary = $testimonial->body;
						echo "<div class=\"testimonial\">
								<blockquote class=\"cms-text text-center\">
									{$summary}
								</blockquote>
								<p class=\"testimonial-name\">{$testimonial->title}<br >
								<span class=\"testimonial-title\">{$testimonial->headline}</span></p>
							</div>";
					}
				?>
				</div>
			</div>
		</div>
	</section>