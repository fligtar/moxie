<?php
require 'includes/init.inc.php';
require 'includes/template.inc.php';

switch ($_GET['action']) {
    /**
     * Look up a single bug's summary and status
     * Params:
     *   bugtracker_id - bugtracker_id of the bugtracker
     *   bug_number - number of the bug to lookup
     */
    case 'bug-lookup':
        require 'includes/bugtracking.inc.php';
        
        list($Bug, $Bugtracker) = load_models('Bug', 'Bugtracker');
        
        // See if we already have information on the bug
        $bug = $Bug->getAll('number = \''.escape($_GET['bug_number']).'\' AND bugtracker_id = '.escape($_GET['bugtracker_id']));
        
        if (!empty($bug)) {
            $bug = $bug[0];
        }
        else {     
            $bugtracker = $Bugtracker->get($_GET['bugtracker_id']);
        
            if (!empty($bugtracker)) {
                $trackertype = Bugtracking::getTrackerInfo($bugtracker['type']);
        
                if (!class_exists($trackertype['shortname'])) {
                    require 'includes/bugtracking/'.$trackertype['shortname'].'.inc.php';
                }
                
                $tracker = new $trackertype['shortname']($bugtracker['url']);
                
                $bug = $tracker->getBugInfo($_GET['bug_number']);
                
                if (!empty($bug[$_GET['bug_number']])) {
                    $bug = $bug[$_GET['bug_number']];
                    $bug['bugtracker_id'] = $_GET['bugtracker_id'];
                    
                    // Add bug to db
                    $Bug->insert($bug);
                    $bug['id'] = $Bug->db->getLastID();
                }
            }
        }
        
        header('Content-type: text/plain');
        $template = new Template();
        $template->render('json', array(
                'data' => $bug
            ));
        
        break;
}

?>