<?php

class ResourcetypeModel extends Model {
    public $table = 'resourcetypes';
    
    /**
     * Get the active resource types for the given project
     */
    public function getActiveForProject($project_id) {
        $types = $this->getAll("project_id = ".escape($project_id)." AND enabled=1");
        
        $resourcetypes = array();
        if (!empty($types)) {
            foreach ($types as $type) {
                $resourcetypes[] = $type['resourcetype'];
            }
        }
        
        return $resourcetypes;
    }
}

?>