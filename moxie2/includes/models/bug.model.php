<?php

class BugModel extends Model {
    public $table = 'bugs';
    
    const STATUS_OPEN = 1;
    const STATUS_FIXED = 2;
    const STATUS_OTHER = 3;
    
    const ROLE_TRACKING = 1;
    const ROLE_DESIGN = 2;
    const ROLE_IMPLEMENTATION = 3;
    const ROLE_OTHER = 4;
    
    /**
     * Gets all bugs in a given milestone
     */
    public function getBugsForMilestone($milestone_id) {
        $_bugs = $this->db->query("SELECT bugs.* FROM bugs INNER JOIN bugs_milestones ON bugs_milestones.bug_id = bugs.id WHERE bugs_milestones.milestone_id = ".escape($milestone_id));
        
        return $_bugs;
    }
    
    /**
     * Pulls bugs for the given deliverables and adds them to the array
     */
    public function addBugsToDeliverables(&$deliverables) {
        $bugs = $this->db->query("SELECT * FROM bugs INNER JOIN bugs_deliverables ON bugs_deliverables.bug_id = bugs.id WHERE bugs_deliverables.deliverable_id IN (".implode(',', array_keys($deliverables)).")");
        
        if (!empty($bugs)) {
            foreach ($bugs as $bug) {
                if (empty($deliverables[$bug['deliverable_id']])) {
                    $deliverables[$bug['deliverable_id']]['bugs'] = array();
                }
                $deliverables[$bug['deliverable_id']]['bugs'][] = $bug;
            }
        }
    }
}

?>