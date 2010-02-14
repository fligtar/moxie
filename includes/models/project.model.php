<?php

class ProjectModel extends Model {
    public $table = 'projects';
    
    /**
     * Get the project's information based on the URL parameter,
     * which could either be the id or URL slug
     */
    public function getProjectFromURL($param) {
        $project = $this->get($param);
        
        if (!$project) {
            $projects = $this->getAll("url = '".escape($param)."'");
            $project = $projects[0];
        }
        
        return $project;
    }
    
    /**
     * Gets the projects associated with the given milestone
     */
    public function getProjectsForMilestone($milestone_id) {
        $_projects = $this->getAll('milestone_id = '.escape($milestone_id));
        
        return $_projects;
    }
}

?>