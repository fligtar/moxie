<?php

require_once dirname(dirname(dirname(__FILE__))).'/project.inc.php';

/**
 * Report configuration file
 * Must extend project class
 */
class amo506 extends amo {
	// ID for files and classes
	public $reportID = 'amo506';
	
    // Short name for report URL
    public $reportName = '5.0.6';
    
    // Pretty name to display for report
    public $reportDisplayName = '5.0.6';
    
    // Bugzilla query for the report
    public $queryString = 'buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=5.0.6';
    
    // Code freeze date
    public $codeFreeze = '2009-06-04';
    
    // Launch date
    public $launch = '2009-06-09';
    
    // Summary of release
    public $summary = 'Collections, Add-on Collector, New Homepage, and Site Reskin';
}

?>