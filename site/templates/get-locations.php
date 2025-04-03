<?php
include("includes/functions.php");

function sortCategories($categories, $parentTitle) {
	$types = '';
	foreach($categories as $type) {
		if($type->title != $parentTitle) {
			$types .= "{$type->title}, ";
		}
	}
	$types = $parentTitle . ", " . $types;
	$types = rtrim($types,", ");
	return $types;
}


function renderLocationsXML($locations) {
    $out = '<?xml version="1.0" encoding="utf-8"?>';
    $out .= '<markers>';
    
    foreach ($locations as $location) {
    	// sanitize:
    	// $title = str_replace("'","&#039;",$location->title);
    	$title = $location->title;
    	//$address = comma2br($location->office_location->address);
    	$address = nl2br($location->office_location->address);
    	//$address = "<![CDATA[".$address."]]>";

    	//$address = str_replace("<","&lt;",$address);
    	//$address = str_replace(">","&gt;",$address);
    	
        // use any fields of $location
        //$body = $sanitizer->textarea($location->body);
		$out .= "<marker name='{$title}' lat='{$location->office_location->lat}' lng='{$location->office_location->lng}' address='{$address}' phone='{$location->office_telephone}' parent='{$location->parent->name}' url='{$location->url}' />";
    }
    $out .= '</markers>';
    return $out;
    file_put_contents("locations.xml", $out);
}

//title~='Warwick Road',
$locations = $pages->find("template=office-location, sort=title");

header("Content-Type: text/xml");
echo renderLocationsXML($locations);
?>