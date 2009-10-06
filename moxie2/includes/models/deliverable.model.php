<?php

class DeliverableModel extends Model {
    public $table = 'deliverables';
    
    const STATUS_AUTOMATIC = 0;
    const STATUS_NOTSTARTED = 1;
    const STATUS_INPROGRESS = 2;
    const STATUS_COMPLETE = 3;
    const STATUS_BLOCKED = 4;
    
    /**
     * Gets all deliverables for the given project
     */
    public function getKeyedDeliverables($project_id) {
        $_deliverables = $this->getAll("project_id = {$project_id}", '*', 'parent_id, id');
        
        $deliverables = array();
        
        if (!empty($_deliverables)) {
            foreach ($_deliverables as $deliverable) {
                $deliverables[$deliverable['id']] = $deliverable;
            }
        }
        
        return $deliverables;
    }
    
    /**
     * Nests deliverables based on their parent
     */
    public function nestDeliverables($deliverables) {
        $parents = array();
        if (!empty($deliverables)) {
            foreach ($deliverables as $deliverable) {
                // Deliverables that have no parent are NULL due to FK
                if (empty($deliverable['parent_id'])) {
                    $deliverable['parent_id'] = 0;
                }
                
                if (empty($parents[$deliverable['parent_id']])) {
                    $parents[$deliverable['parent_id']] = array();
                }
                
                $parents[$deliverable['parent_id']][$deliverable['id']] = $deliverable;
            }
            
            $deliverables = $this->findChildren($parents[0], $parents);
        }
        
        return $deliverables;
    }
    
    /**
     * Finds the children of the deliverable
     */
    private function findChildren($deliverables, &$parents) {
        foreach ($deliverables as $deliverable_id => $deliverable) {
            if (array_key_exists($deliverable_id, $parents)) {
                $deliverables[$deliverable_id]['children'] = $this->findChildren($parents[$deliverable_id], $parents);
            }
        }
        
        return $deliverables;
    }

}

?>