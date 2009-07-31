<?php

class ResourceModel extends Model {
    public $table = 'resources';
    
    public function getResources($deliverable_id, $category_id) {
        $results = $this->getAll("
                category_id = {$category_id} AND 
                deliverable_id = {$deliverable_id}
            ");
        
        return $results;
    }
}

?>