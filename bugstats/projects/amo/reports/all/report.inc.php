<?php

/**
 * Report configuration file
 * Must extend project class
 */
class Report extends amo {
    // Short name for report
    public $reportName = 'all';
    
    // Pretty name to display for report
    public $reportDisplayName = '(all-time)';
    
    // Bugzilla query for the report
    public $queryString = 'buglist.cgi?query_format=advanced&product=addons.mozilla.org';
}

?>