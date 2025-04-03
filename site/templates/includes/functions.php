<?php 
// if there's a reg cookie,
//$info_bar = "strandoo";
//setcookie("InfoBar", $info_bar, time()+3600, "/", null);

//$url = '';

if(isset($_GET['logout'])) {
	//$url = $pages->get($redirect)->url;
	if($session->get('reg_email')) {
		$session->remove('reg_name');
		$session->remove('reg_email');
	}
	//$session->redirect($url);
}

/**
* Return all of the page's children where $field falls in $month and $year.
*
* @param Page $page The page that has the children we are finding.
* @param int $month Month you want to match.
* @param int $year Year you want to match.
* @param string Name of the date field to check.
* @return PageArray All the matching children.
*
*/
function childrenInMonth($page, $month, $year, $field = 'post_date') {
    $startTime = strtotime("$month/1/$year");
    $endTime = strtotime("next month", $startTime);
    return $page->children("$field>=$startTime, $field<$endTime, sort=$field");
}					

function childrenInYear($page, $year, $field = 'post_date') {
    $startTime = strtotime("$year-01");
    $endTime = strtotime("next year", $startTime);
    return $page->children("$field>=$startTime, $field<$endTime, sort=$field");
}		

function formatBytes($size, $precision = 2) {
    $base = log($size, 1024);
    $suffixes = array('', 'K', 'M', 'G', 'T');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}

// $subject is the original string
// $search is the thing you want to replace
// $replace is what you want to replace it with
function avoidOrphans($subject,$search = " ",$replace = "&nbsp;") {
	$text = substr_replace($subject, $replace, strrpos($subject, $search), strlen($search));
	return $text;
}

function nl2br2($string) { 
   $intro = str_replace(array("\r\n", "\r", "\n"), "<br />", $string); 
   return $intro; 
}

function comma2br($string) { 
   //$result = str_replace(", ", "<br />", $string);
   $result = str_replace(", ", "&#xA;", $string);
   return $result; 
}

function truncateText($text, $maxlength = 100) {
	$text = substr(strip_tags($text), 0, $maxlength);
	// check if we've truncated to a spot that needs further truncation
	//if(strlen(rtrim($text, ' .!?,;')) == $maxlength) {
		// truncate to last word 
		//$text = substr($summary, 0, strrpos($summary, ' ')); 
	//}
	return trim($text); 
}	