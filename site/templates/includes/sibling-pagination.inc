					<?php if($page->parent->path != "/") {
						echo "<div class=\"sibling-nav\">";
						if( $page->siblings->count() > 1 ) {
							if($page->prev->url) { echo "<a href=\"{$page->prev->url}\" class=\"prev-nav\">&laquo; {$page->prev->title}</a>"; } 
							if($page->next->url) { echo "<a href=\"{$page->next->url}\" class=\"next-nav\">{$page->next->title} &raquo;</a>"; }
						}
						echo "</div>";
					} ?>