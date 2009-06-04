<?php

require_once dirname(dirname(dirname(__FILE__))).'/project.inc.php';

/**
 * Report configuration file
 * Must extend project class
 */
class amo506_p1p2 extends amo {
	// ID for files and classes
	public $reportID = 'amo506_p1p2';
	
    // Short name for report URL
    public $reportName = '5.0.6-p1p2';
    
    // Pretty name to display for report
    public $reportDisplayName = '5.0.6 (High Priority)';
    
    // Bugzilla query for the report
    public $queryString = 'buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=5.0.6&priority=--&priority=P1&priority=P2';
}

?>
