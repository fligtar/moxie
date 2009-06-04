<?php

/**
 * Project configuration file
 * Any of these settings can be overwritten by the report settings
 */
class amo extends Project {
    // Short name for URLs and class names. MUST be same as class name
    public $projectName = 'amo';
    
    // Pretty display name for the project
    public $projectDisplayName = 'AMO';
    
    // Base of the bugzilla installation with trailing slash
    public $queryBase = 'https://bugzilla.mozilla.org/';
    
    // Primary developer email addresses
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
    
    // Unassigned email address
    public $unassigned = 'nobody@mozilla.org';
    
    // Maximum cache age in seconds before refreshing
    public $refreshTime = 3600;
    
    // Manual refresh enabled?
    public $manualRefresh = true;
}

?>