<?php
/**
 * This script fetches new data in the background
 */
require 'lib/projectlister.class.php';
$projectlister = new ProjectLister;

$projectName = $_GET['project'];
$reportID = $_GET['report'];

if (!$projectlister->isProject($projectName) || !$projectlister->isReport($projectName, $reportID)) {
	die('Invalid project name.');
}

require_once "projects/{$projectName}/reports/{$reportID}/report.inc.php";

$report = new $reportID;

$report->bam(true);

?>
