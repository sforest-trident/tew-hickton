<?php 
/*****
* Include: FAQ section
* Description: Manages the output of the FAQ content for a pgae (where field group is applied).
* Page template requirements: faq-block (wrapper).
* Author: Scott Forest
*******/
?>

<?php

	//Create content data array
	$component_data_array = [];

?>

<?php 
	foreach($page->faq_content_repeater as $item):
	
		array_push($component_data_array, array('title' => $item->title, 'body' => $item->body));
		
		$component_data = (object)['items' => $component_data_array];

	endforeach; 

	include("./faq-content/faq-content.php");
?>


