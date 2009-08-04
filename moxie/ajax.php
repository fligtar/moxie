<?php
require 'includes/init.inc.php';
require 'includes/template.inc.php';
require 'includes/resourcemanager.inc.php';

switch ($_GET['action']) {

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
    
    /**
     * Calls a resourcetype's custom handler function
     * Params:
     *   resourcetype - the resourcetype
     *   handler - name of the function to call
     *   (other) - other data to be passed on to handler
     */
    case 'resourcetype-custom':
        $resource_manager = new ResourceManager(array($_GET['resourcetype']));
        $resourcetype =& $resource_manager->resourcetypes[$_GET['resourcetype']];
        
        list($Resource) = load_models('Resource');
        
        $resourcetype->{$_GET['handler']}($_GET);
        
        break;
        
}

?>