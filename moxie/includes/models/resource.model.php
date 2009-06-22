<?php

class ResourceModel extends Model {
    public $table = 'resources';
    
    public function getBugResources($deliverable_id, $category_id) {
        $query = "
            SELECT * 
            FROM resources
            INNER JOIN bugs
            ON
                resources.bug_id = bugs.id
            WHERE
                resources.deliverable_id = {$deliverable_id} AND 
                resources.category_id = {$category_id}
            ";
        
        $results = $this->db->query($query);
        
        return $results;
    }
    
    public function getLinkResources($deliverable_id, $category_id) {
        $results = $this->getAll("
                category_id = {$category_id} AND 
                deliverable_id = {$deliverable_id} AND 
                url IS NOT NULL
            ");
        
        return $results;
    }
}

?>