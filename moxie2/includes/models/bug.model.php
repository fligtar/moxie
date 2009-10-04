<?php

class BugModel extends Model {
    public $table = 'bugs';
    
    const STATUS_OPEN = 1;
    const STATUS_FIXED = 2;
    const STATUS_OTHER = 3;
    
    public function getBugsForMilestone($milestone_id) {
        $_bugs = $this->db->query("SELECT bugs.* FROM bugs INNER JOIN bugs_milestones ON bugs_milestones.bug_id = bugs.id WHERE bugs_milestones.milestone_id = ".escape($milestone_id));
        
        return $_bugs;
    }
}

?>