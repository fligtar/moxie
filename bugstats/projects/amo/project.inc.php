<?php

class amo extends Project {
	public $name = 'amo';
	public $displayName = 'AMO (all-time)';
	
	public $queryBase = 'https://bugzilla.mozilla.org/';
	
	public $queryString = 'buglist.cgi?query_format=advanced&product=addons.mozilla.org';
	
	public $developers = array(
		'clouserw@gmail.com',
		'fwenzel@mozilla.com',
		'jbalogh@jeffbalogh.org',
		'lorchard@mozilla.com',
		'rdoherty@mozilla.com',
		'smccammon@mozilla.com',
		'morgamic@gmail.com',
		'fligtar@mozilla.com',
		'Bugzilla-alanjstrBugs@sneakemail.com',
		'bugtrap@psychoticwolf.net',
		'cpollett@gmail.com',
		'laura@mozilla.com'
	);
	
	public $unassigned = 'nobody@mozilla.org';
	
	public $refresh = false;
}

?>