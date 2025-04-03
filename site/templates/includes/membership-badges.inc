	<div class="footer-badges">
		<?php
			$badges = $pages->get(1147)->images;
			foreach ($badges as $badge) {
				$link = $badge->website !='' ? $badge->website : "#" ;
				if($badge->tags !='blackcountry') {
					echo "<a href=\"{$link}\">";
					echo "<img src=\"{$badge->height(240)->url}\" class=\"footer-badge\" alt=\"{$badge->description}\" >";
					//echo $badge->website !='' ? "</a>" : "" ;
					echo "</a>";
				}
				
				if($badge->tags =='blackcountry' && ($page->id==1144 || $page->id==1145)) {
					echo "<a href=\"{$link}\">";
					echo "<img src=\"{$badge->height(240)->url}\" class=\"footer-badge\" alt=\"{$badge->description}\" >";
					echo "</a>";
				}
			}
		?>
	</div>