<?php

/**
 * ProjectLister!
 * Figures out what projects exist and reads their metadata
 */
class ProjectLister {
    public $projectsDir;
    public $projects;
    public $detailedProjects;
    
    /**
     * Sets the projects directory path
     */
    public function __construct() {
        $this->projectsDir = dirname(dirname(__FILE__)).'/projects';
    }
    
    /**
     * Lists the project short names
     */
    public function listProjects() {
        $notProjects = array('.', '..', '.DS_Store', '.svn');
        
        $projects = array();
        if ($dh = opendir($this->projectsDir)) {
            while (($project = readdir($dh)) !== false) {
                if (!in_array($project, $notProjects))
                    $projects[] = $project;
            }
            closedir($dh);
        }
        
        $this->projects = $projects;
        
        return $this->projects;
    }
    
    /**
     * Determines whether the name is a valid project
     */
    public function isProject($projectName) {
        if (empty($this->projects))
            $this->listProjects();
        
        return in_array($projectName, $this->projects);
    }
    
    /**
     * Gets a list of all projects with their metadata
     */
    public function getProjectsWithDetails() {
        if (empty($this->projects))
            $this->listProjects();
            
        foreach ($this->projects as $projectName) {
            $this->detailedProjects[$projectName] = $this->getProjectDetails($projectName);
        }
        
        return $this->detailedProjects;
    }
    
    /**
     * Gets the metadata from a project's config file
     */
    private function getProjectDetails($projectName) {
        if (!class_exists($projectName))
            include "{$this->projectsDir}/{$projectName}/project.inc.php";
        
        $project = new $projectName;
        
        $detailedProject = array(
            'name' => $project->name,
            'displayName' => $project->displayName
        );
        
        return $detailedProject;
    }
}

?>