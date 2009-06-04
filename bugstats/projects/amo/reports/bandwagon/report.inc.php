<?php

require_once dirname(dirname(dirname(__FILE__))).'/project.inc.php';

/**
 * Report configuration file
 * Must extend project class
 */
class bandwagon extends amo {
	// ID for files and classes
	public $reportID = 'bandwagon';
	
    // Short name for report URL
    public $reportName = 'bandwagon';
    
    // Pretty name to display for report
    public $reportDisplayName = 'Bandwagon';
    
    // Bugzilla query for the report
    public $queryString = 'buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=BW-M1&target_milestone=BW-M2&target_milestone=BW-M3&target_milestone=BW-M4&target_milestone=BW-M5&target_milestone=BW-M6';

    // Primary developers
    public $developers = array(
        'brian@mozdev.org',
        'dave@briks.si',
        'lorchard@mozilla.com'
    );
}

?>

