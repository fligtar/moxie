<?php

class bandwagon extends Project {
	public $name = 'bandwagon';
	public $displayName = 'Bandwagon';
	
	public $queryBase = 'https://bugzilla.mozilla.org/';
	
	public $queryString = 'buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=BW-M1&target_milestone=BW-M2&target_milestone=BW-M3&target_milestone=BW-M4&target_milestone=BW-M5&target_milestone=BW-M6';
	
	public $developers = array(
		'brian@mozdev.org',
		'dave@briks.si',
		'lorchard@mozilla.com'
	);
	
	public $unassigned = 'nobody@mozilla.org';
}

?>
