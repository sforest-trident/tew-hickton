<?php 
// Hickton
if($page->external_redirect !='') {
	$session->redirect($page->external_redirect);
} else {
//if($page->first_child_redirect===1) {
	$session->redirect($page->child()->url);
}
?>