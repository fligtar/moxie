<?php

require_once dirname(dirname(dirname(__FILE__))).'/project.inc.php';

/**
 * Report configuration file
 * Must extend project class
 */
class amo507 extends amo {
    // Short name for report
    public $reportName = '5.0.7';
    
    // Pretty name to display for report
    public $reportDisplayName = '5.0.7';
    
    // Bugzilla query for the report
    public $queryString = 'buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=5.0.7';
}

?>