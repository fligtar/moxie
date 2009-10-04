<?php

class ProjectModel extends Model {
    public $table = 'projects';
    
    /**
     * Gets the projects associated with the given milestone
     */
    public function getProjectsForMilestone($milestone_id) {
        $_projects = $this->getAll('milestone_id = '.escape($milestone_id));
        
        return $_projects;
    }
}

?>