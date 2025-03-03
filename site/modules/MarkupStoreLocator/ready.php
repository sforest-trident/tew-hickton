<?php namespace ProcessWire;

// This hook creates a fresh locations.xml file for the Map page
// after saving a Develoment page.
$this->addHookAfter('Pages::saved', function(HookEvent $event) {
	// Get the object the event occurred on, if needed
	$pages = $event->object;


	// An 'after' hook can retrieve and/or modify the return value
	//$return = $event->return;

	// Get values of arguments sent to hook (if needed)
	//$page = $event->arguments(0);
	//$changes = $event->arguments(1);
	//$values = $event->arguments(2);

	/* Your code here, perhaps modifying the return value */
	
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
			//$title = str_replace("'","&#039;",$location->title);
			//$title = str_replace("&","&amp;",$title);
			//$client = str_replace("'","&#039;",$location->dev_client);
			//$client = str_replace("&","&amp;",$client);
			//$architect = str_replace("'","&#039;",$location->dev_architect);
			//$architect = str_replace("&","&amp;",$architect);
			
			$title = wire()->sanitizer->entities($location->title);
			$title = str_replace("&rsquo;","&#8217;",$title);
			$title = str_replace("&lsquo;","&#8216;",$title);
			
			$client = wire()->sanitizer->entities($location->dev_client);
			$client = str_replace("&rsquo;","&#8217;",$client);
			$client = str_replace("&lsquo;","&#8216;",$client);
			
			$architect = wire()->sanitizer->entities($location->dev_architect);
			$architect = str_replace("&rsquo;","&#8217;",$architect);
			$architect = str_replace("&lsquo;","&#8216;",$architect);

			$value1 = $location->dev_value_1 == 0 ? "" : ($location->dev_value_1 >=1 ? "£{$location->dev_value_1}M" : "£".($location->dev_value_1 * 1000)."K");
			$value2 = $location->dev_value_2 == 0 ? "" : ($location->dev_value_2 >=1 ? "£{$location->dev_value_2}M" : "£".($location->dev_value_2 * 1000)."K");
			$value = $value2 != '' ? $value1." / ".$value2 : ($value1 != '' ? $value1 : $location->dev_value);
											
			$date1 = $location->dev_date_1 !='' ? date("M Y", $location->getUnformatted("dev_date_1")) : 'Pre 2007';
			$date2 = $location->dev_date_2 !='' ? ' / ' . date("M Y", $location->getUnformatted("dev_date_2")) : '';
			$date = $date1.$date2;
			
			$thumb = $location->dev_thumbnail->count() ? $location->dev_thumbnail->first->size(160,160)->url : "/site/templates/images/generic-thumb-100.jpg";
			//$category = $location->dev_type->each("{title}, ");
			$category = sortCategories($location->dev_type,$location->parent->title);
			$status = $location->dev_status2->title;
			$url = $location->dev_map_only == 'off' ? $location->url : '';
			$search = $title." ".$client;
		
			// use any fields of $location
			//$out .= "<marker name='{$title}' lat='{$location->dev_address->lat}' lng='{$location->dev_address->lng}' category='{$category}' status='{$status}' client='{$client}' architect='{$architect}' search='{$search}' parent='{$location->parent->name}' date='{$date1}' image='{$thumb}' url='{$url}' />";
			$out .= "<marker name='{$title}' lat='{$location->dev_address->lat}' lng='{$location->dev_address->lng}' category='{$category}' status='{$status}' client='{$client}' architect='{$architect}' search='{$search}' parent='{$location->parent->name}' date='{$date}' value='{$value}' image='{$thumb}' url='{$url}' />\n";
		}
		$out .= '</markers>';
		return $out;
	}
	
	$page = $event->arguments('page');
	
	if($page->template->name == 'development-page')  {
	
		$locations = $pages->find("template=development-page, sort=title");
		$xml = renderLocationsXML($locations);
	
		$file = "locations.xml";
		file_put_contents($file, $xml);

		$this->message('Page saved and XML updated');	
		// Populate back return value, if you have modified it
		// $event->return = $return;
	}
});