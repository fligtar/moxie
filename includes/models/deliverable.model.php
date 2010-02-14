<?php

class DeliverableModel extends Model {
    public $table = 'deliverables';
    
    const STATUS_NOTSTARTED = 0;
    const STATUS_INPROGRESS = 1;
    const STATUS_COMPLETE = 2;
    const STATUS_BLOCKED = 3;
    
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
    
    /**
     * Determines which deliverables need status updates based on bug changes
     * since the last status update, and then updates the statuses
     */
    public function updateStatuses() {
        // Get deliverables that need to be updated
        $deliverables = $this->db->query("
            SELECT DISTINCT
                deliverables.id
            FROM deliverables
            INNER JOIN bugs_deliverables ON bugs_deliverables.deliverable_id = deliverables.id
            INNER JOIN bugs ON bugs.id = bugs_deliverables.bug_id
            WHERE
                deliverables.status_last_updated < bugs.modified AND
                deliverables.autostatus = 1
        ");
        
        if (!empty($deliverables)) {
            list($Bug) = load_models('Bug');
            
            foreach ($deliverables as $deliverable) {
                // Get bugs for the deliverable
                $bugs = $Bug->getBugsForDeliverable($deliverable['id']);
                
                // Get the status based on those bugs
                $status = $this->determineStatus($bugs);
                
                $data = array(
                    'status' => $status,
                    'status_last_updated' => 'NOW()'
                );
                
                // Update the status
                $this->update($deliverable['id'], $data);
            }
        }
    }
    
    /**
     * Determines deliverable status based on its bugs
     */
    public function determineStatus($bugs) {
        // No bugs = not started
        if (empty($bugs)) {
            $status = DeliverableModel::STATUS_NOTSTARTED;
        }
        else {
            $complete = true;
            // No open bugs = complete
            foreach ($bugs as $bug) {
                if ($bug['status'] == BugModel::STATUS_OPEN) {
                    $complete = false;
                }
            }
        
            if ($complete) {
                $status = DeliverableModel::STATUS_COMPLETE;
            }
            else {
                $status = DeliverableModel::STATUS_INPROGRESS;
            }
        }
        
        return $status;
    }

}

?>