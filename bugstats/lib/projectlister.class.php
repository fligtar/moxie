<?php

/**
 * ProjectLister!
 * Figures out what projects exist and reads their metadata
 */
class ProjectLister {
    public $projectsDir;
    public $projects;
	public $reports;
    public $detailedProjects;

	public $ignored = array('.', '..', '.DS_Store', '.svn');
    
    /**
     * Sets the projects directory path and lists projects and reports
     */
    public function __construct() {
        $this->projectsDir = dirname(dirname(__FILE__)).'/projects';
		$this->listProjects();
    }
    
    /**
     * Lists the project short names
     */
    public function listProjects() {   
        $projects = array();
        if ($dh = opendir($this->projectsDir)) {
            while (($project = readdir($dh)) !== false) {
                if (!in_array($project, $this->ignored)) {
                    $projects[] = $project;
					$this->listReports($project);
				}
            }
            closedir($dh);
        }
        
        $this->projects = $projects;
    }
    
	/**
	 * Lists the report short names
	 */
	public function listReports($projectName) {
		$reports = array();
		$reportsDir = "{$this->projectsDir}/{$projectName}/reports";
		
		if ($dh = opendir($reportsDir)) {
			while (($report = readdir($dh)) !== false) {
				if (!in_array($report, $this->ignored)) {
					$reports[] = $report;
				}
			}
			closedir($dh);
		}
		
		$this->reports[$projectName] = $reports;
	}
	
    /**
     * Determines whether the name is a valid project
     */
    public function isProject($projectName) {
        return in_array($projectName, $this->projects);
    }
	
	/**
	 * Determines whether the name is a valid report in the given project
	 */
	public function isReport($projectName, $reportName) {
		
	}
    
    /**
     * Gets a list of all projects with their metadata
     */
    public function getProjectDetails() {
        foreach ($this->projects as $projectName) {
            $this->detailedProjects[$projectName] = $this->loadProjectDetails($projectName);
        }
        
        return $this->detailedProjects;
    }
    
    /**
     * Gets the metadata from a project's config file
     */
    private function loadProjectDetails($projectName) {
        if (!class_exists($projectName))
            include "{$this->projectsDir}/{$projectName}/project.inc.php";
        
        $project = new $projectName;
        
        $detailedProject = array(
            'projectName' => $project->projectName,
            'projectDisplayName' => $project->projectDisplayName,
			'reports' => $this->getReportDetails($projectName)
        );
        
        return $detailedProject;
    }
	
	/*
	 * Gets a list of all reports with their metadata
	 */
	public function getReportDetails($projectName) {
		$reports = array();
		foreach ($this->reports[$projectName] as $reportName) {
			$reports[] = $this->loadReportDetails($projectName, $reportName);
		}
		
		return $reports;
	}
	
	/**
	 * Gets the metadata from a report's config file
	 */
	private function loadReportDetails($projectName, $reportName) {
		include "{$this->projectsDir}/{$projectName}/reports/{$reportName}/report.inc.php";
		
		$report = new Report;
		
		$detailedReport = array(
			'reportName' => $report->reportName,
			'reportDisplayName' => $report->reportDisplayName
		);
		
		return $detailedReport;
	}
}

?>