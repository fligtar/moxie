<?php
require 'includes/init.inc.php';
require 'includes/template.inc.php';
require 'includes/resourcemanager.inc.php';

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
        
        $template = new Template();
        $template->render('json', array(
                'data' => $bugs
            ));
        
        break;
    /**
     * Add one or more resources to a deliverable
     * Params:
     *   deliverable_id - id of the deliverable
     *   resourcetype - id of the resourcetype
     *   category_id - id of the categories
     *   (other) - depending on resourcetype
     */
    case 'add-resource':
        $resource_manager = new ResourceManager(array($_GET['resourcetype']));
        $resourcetype =& $resource_manager->resourcetypes[$_GET['resourcetype']];
        $fields = $resourcetype->getFieldsToSave($_GET);
        $json = array();
        
        $data = array(
            'deliverable_id' => $_GET['deliverable_id'],
            'resourcetype' => $_GET['resourcetype'],
            'data' => serialize($fields)
        );
        
        // Insert into db
        list($Resource) = load_models('Resource');
        
        if (!is_array($_GET['category_id'])) {
            $_GET['category_id'] = array($_GET['category_id']);
        }
        
        foreach ($_GET['category_id'] as $category_id) {
            $data['category_id'] = $category_id;
            $Resource->insert($data);
            
            // Add to JSON output
            $json[] = array(
                'resource_id' => $Resource->db->getLastID(),
                'deliverable_id' => $data['deliverable_id'],
                'category_id' => $data['category_id'],
                'resourcetype' => $data['resourcetype'],
                'link' => $resourcetype->buildLink($fields)
            );
        }
        
        $template = new Template();
        $template->render('json', array(
                'data' => $json
            ));
        
        break;

    /**
     * Refresh one or more resources 
     * Params:
     *   resource_id - id of an individual resource to refresh
     *   deliverable_id - id of a deliverable to refresh all associated resources
     *   milestone_id - id of a milestone to refresh all associated resources
     */
    case 'refresh-resources':
        $resource_manager = new ResourceManager;
        
        // Get resource info
        list($Resource) = load_models('Resource');
        
        if (!empty($_GET['resource_id'])) {
            $query = 'id = \''.escape($_GET['resource_id']).'\'';
        }
        elseif (!empty($_GET['deliverable_id'])) {        
            $query = 'deliverable_id = \''.escape($_GET['deliverable_id']).'\'';
        }
        
        $resources = $Resource->getAll($query);
        
        if (!empty($resources)) {
            foreach ($resources as $resource) {
                // Make sure resourcetype has been loaded
                $resource_manager->loadAdditionalResourcetype($resource['resourcetype']);
                
                $resource_manager->resourcetypes[$resource['resourcetype']]->refreshAndUpdate($Resource, $resource['id'], unserialize($resource['data']));
            }
        }
        
        
        break;
        
}

?>