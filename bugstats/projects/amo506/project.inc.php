<?php

class amo506 extends Project {
	public $name = 'amo506';
	public $displayName = 'AMO 5.0.6';
	
	public $queryBase = 'https://bugzilla.mozilla.org/';
	
	public $queryString = 'buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=5.0.6';
	
	public $developers = array(
		'clouserw@gmail.com',
		'fwenzel@mozilla.com',
		'jbalogh@jeffbalogh.org',
		'lorchard@mozilla.com',
		'rdoherty@mozilla.com',
		'smccammon@mozilla.com'
	);
	
	public $unassigned = 'nobody@mozilla.org';
}

?>