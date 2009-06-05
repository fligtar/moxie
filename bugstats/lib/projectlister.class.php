<?php

require_once 'cacher.class.php';

/**
 * ProjectLister!
 * Figures out what projects exist and reads their metadata
 */
class ProjectLister {
    public $projectsDir;
    public $projects;

    private $ignored = array('.', '..', '.DS_Store', '.svn');
    
    /**
     * Sets the projects directory path and lists projects and reports
     */
    public function __construct() {
        $this->projectsDir = dirname(dirname(__FILE__)).'/projects';

        $cacheFile = dirname(dirname(__FILE__)).'/projects.cache';
        $cacher = new Cacher($cacheFile);
        
        // Pull project listing from cache if it's there and less than an hour old
        if ($cacher->check('projects') && $cacher->getCacheAge() > 3600) {
            $this->projects = $cacher->pull('projects');
        }
        else {
            $this->findProjectsAndReports();
            $cacher->cache('projects', $this->projects);
        }
    }
    
    /**
     * Gets the metadata for all projects and reports
     */
    public function findProjectsAndReports() {   
        $projects = array();
        if ($dh = opendir($this->projectsDir)) {
            while (($project = readdir($dh)) !== false) {
                if (!in_array($project, $this->ignored)) {
                    $reportIDs = $this->listReports($project);
                    $reports = $this->getReportDetails($project, $reportIDs);
                    $keys = array_keys($reports);
                    $projects[$project] = array(
                        'projectName' => $reports[$keys[0]]['projectName'],
                        'projectDisplayName' => $reports[$keys[0]]['projectDisplayName'],
                        'reports' => $reports
                    );
                }
            }
            closedir($dh);
        }
        
        $this->projects = $projects;
    }
    
    /**
     * Lists the report short names
     */
    private function listReports($projectName) {
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
        
        return $reports;
    }
    
    /**
     * Determines whether the name is a valid project
     */
    public function isProject($projectName) {
        return array_key_exists($projectName, $this->projects);
    }
    
    /**
     * Determines whether the ID is a valid report in the given project
     */
    public function isReport($projectName, $reportID) {
        return array_key_exists($reportID, $this->projects[$projectName]['reports']);
    }
    
    /**
     * Determines the report ID based on the report name
     */
    public function getReportID($reportName, $projectName) {
        if (!$this->isProject($projectName))
            return false;
        
        foreach ($this->projects[$projectName]['reports'] as $reportID => $reportDetails) {
            if ($reportDetails['reportName'] == $reportName) {
                return $reportID;
            }
        }
    }
    
    /*
     * Gets a list of all reports with their metadata
     */
    public function getReportDetails($projectName, $reportIDs) {
        $reports = array();
        
        foreach ($reportIDs as $reportID) {
            $reports[$reportID] = $this->loadReportDetails($projectName, $reportID);
        }
        
        return $reports;
    }
    
    /**
     * Gets the metadata from a report's config file
     */
    private function loadReportDetails($projectName, $reportID) {
        include_once "{$this->projectsDir}/{$projectName}/reports/{$reportID}/report.inc.php";
        
        $report = new $reportID;
        
        $detailedReport = array(
            'projectName' => $report->projectName,
            'projectDisplayName' => $report->projectDisplayName,
            'reportID' => $reportID,
            'reportName' => $report->reportName,
            'reportDisplayName' => $report->reportDisplayName
        );
        
        return $detailedReport;
    }
}

?>