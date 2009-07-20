<?php
require 'includes/init.inc.php';
require 'includes/template.inc.php';

switch ($_GET['action']) {
    /**
     * Look up bug summaries and status
     * Params:
     *   bugtracker_id - bugtracker_id of the bugtracker
     *   bug_numbers - numbers of the bug to lookup
     */
    case 'bug-lookup':
        require 'includes/bugtracking.inc.php';
        
        list($Bug, $Bugtracker) = load_models('Bug', 'Bugtracker');
        
        $bug_numbers = explode(',', $_GET['bug_numbers']);
        $bugs = array();
        
        foreach ($bug_numbers as $bug_number) {
            // See if we already have information on the bug
            $bug = $Bug->getAll('number = \''.escape($bug_number).'\' AND bugtracker_id = '.escape($_GET['bugtracker_id']));
            
            if (!empty($bug)) {
                $bug = $bug[0];
            }
            else {
                // If we don't have it in the database, look it up in the tracker
                $bugtracker = $Bugtracker->get($_GET['bugtracker_id']);
        
                if (!empty($bugtracker)) {
                    $trackertype = Bugtracking::getTrackerInfo($bugtracker['type']);
                    
                    if (!class_exists($trackertype['shortname'])) {
                        require 'includes/bugtracking/'.$trackertype['shortname'].'.inc.php';
                    }
                    
                    $tracker = new $trackertype['shortname']($bugtracker['url']);
                    
                    $bug = $tracker->getBugInfo($bug_number);
                    
                    if (!empty($bug[$bug_number])) {
                        $bug = $bug[$bug_number];
                        $bug['bugtracker_id'] = $_GET['bugtracker_id'];
                        
                        // Add bug to db
                        $Bug->insert($bug);
                        $bug['id'] = $Bug->db->getLastID();
                    }
                }
            }
            
            $bugs[] = $bug;
        }
        
        header('Content-type: text/plain');
        $template = new Template();
        $template->render('json', array(
                'data' => $bugs
            ));
        
        break;
    /**
     * Add one or more resources to a deliverable
     * Params:
     *   bugtracker_id - bugtracker_id of the bugtracker
     *   bug_numbers - numbers of the bug to lookup
     *   category_id - id of the categories
     *   deliverable_id - id of the deliverable
     */
    case 'add-resource':
        
        break;

    /**
     * Refresh the bugs 
     * Params:
     *   bugtracker_id - bugtracker_id of the bugtracker
     *   bug_id - ids of the bugs to add
     */
    case 'refresh-bugs':
        
        break;
        
}

?>