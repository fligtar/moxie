<?php

require_once dirname(dirname(dirname(__FILE__))).'/lib/project.class.php';

/**
 * Project configuration file
 * Any of these settings can be overwritten by the report settings
 */
class gecko extends Project {
    // Short name for URLs and class names. MUST be same as class name
    public $projectName = 'gecko';
    
    // Pretty display name for the project
    public $projectDisplayName = 'Gecko';
    
    // Base of the bugzilla installation with trailing slash
    public $queryBase = 'https://bugzilla.mozilla.org/';
    
    // Primary developer email addresses
    public $developers = array(
    );
    
    // Unassigned email address
    public $unassigned = 'nobody@mozilla.org';
    
    // Maximum cache age in seconds before refreshing
    public $refreshTime = 86400000;
    
    // Manual refresh enabled?
    public $manualRefresh = false;
}

?>
