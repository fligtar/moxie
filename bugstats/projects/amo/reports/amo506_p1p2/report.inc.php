<?php

/**
 * Report configuration file
 * Must extend project class
 */
class Report extends amo {
    // Short name for report
    public $reportName = '5.0.6-p1p2';
    
    // Pretty name to display for report
    public $reportDisplayName = '5.0.6 (High Priority)';
    
    // Bugzilla query for the report
    public $queryString = 'buglist.cgi?query_format=advanced&product=addons.mozilla.org&target_milestone=5.0.6&priority=--&priority=P1&priority=P2';
}

?>
