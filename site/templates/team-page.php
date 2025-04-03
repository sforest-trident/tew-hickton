<?php 
include("./includes/head.inc");
include("./includes/responsive-hero.inc");

$contrast = $page->hero_text_color == 1 ? ' reversed' : '';
$justify  = $page->flex_justify != '' ? $page->flex_justify->value : 'flex-left';
$align    = $page->flex_align != '' ? $page->flex_align->value : 'flex-middle';

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
		<div class="inner clearfix">
			<h1 class="centered"><?php echo $page->get("headline|title"); ?></h1>
			<div class="cms-text text-center">
				<?php echo $page->body; ?>
			</div>
			
			<div class="row padding-10">
			<?php 
				$employees = $page->children();
				
				$i=0;
				foreach($employees as $employee) {
					/*
					if($i==4) {
						echo "</div>
							<div class=\"row padding-20\" id=\"other-employees\" style=\"display: none;\">";
					}
					*/
					$biopic = count($employee->images) ? $employee->images->first->size(500,500)->url : $config->urls->templates.'images/avatar.jpg';
					$employee_email = $employee->employee_email;
					echo "<div class=\"col col-1of3\">
						<div class=\"employee-card\">
							<!-- <a href=\"{$employee->url}\" class=\"employee-link\"> -->
								<img src=\"{$biopic}\" class=\"bio-image\" alt=\"{$employee->title}\" />
								<h3>{$employee->title}</h3>
								<h4 style=\"height:60px!important;\">{$employee->headline}</h4>";
						if (!empty($employee_email)) { 
					echo "<a href=\"mailto:{$employee->employee_email}\" class=\"button\">Email ";
										echo strtok($employee->title, " ");
					echo "</a>";
						}
					echo "<!-- </a> -->
						</div>
					</div>";
				$i++;
				}
				
			?>
			</div>
			
		</div>
	</section>

<?php 
include("./includes/membership-badges.inc");
include("./includes/foot.inc");
?>