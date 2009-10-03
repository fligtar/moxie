<?php

class ResourceModel extends Model {
    public $table = 'resources';
    
    public function addResourcesToDeliverables($deliverables) {
        $deliverable_ids = array();
        foreach ($deliverables as $deliverable) {
            $deliverable_ids[] = $deliverable['id'];
        }
        
        $resources = $this->getAll('deliverable_id IN ('.implode(',', $deliverable_ids).')', '*', 'resourcetype');
        
        if (!empty($resources)) {
            foreach ($resources as $resource) {
                if (empty($deliverables[$resource['deliverable_id']])) {
                    $deliverables[$resource['deliverable_id']]['resources'] = array();
                }
                $deliverables[$resource['deliverable_id']]['resources'][] = $resource;
            }
        }
        
        return $deliverables;
    }
}

?>