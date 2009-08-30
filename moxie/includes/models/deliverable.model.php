<?php

class DeliverableModel extends Model {
    public $table = 'deliverables';
    
    public function nestDeliverables($deliverables) {
        $parents = array();
        if (!empty($deliverables)) {
            foreach ($deliverables as $deliverable) {
                if (empty($parents[$deliverable['parent_id']])) {
                    $parents[$deliverable['parent_id']] = array();
                }
                
                $parents[$deliverable['parent_id']][$deliverable['id']] = $deliverable;
            }
            
            $deliverables = $this->findChildren($parents[0], $parents);
        }
        
        return $deliverables;
    }
    
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