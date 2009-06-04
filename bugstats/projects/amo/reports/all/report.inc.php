<?php

require_once dirname(dirname(dirname(__FILE__))).'/project.inc.php';

/**
 * Report configuration file
 * Must extend project class
 */
class all extends amo {
    // Short name for report
    public $reportName = 'all';
    
    // Pretty name to display for report
    public $reportDisplayName = '(all-time)';
    
    // Bugzilla query for the report
    public $queryString = 'buglist.cgi?query_format=advanced&product=addons.mozilla.org';
}

?>