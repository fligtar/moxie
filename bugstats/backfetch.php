<?php
/**
 * This script fetches new data in the background
 */
require 'lib/project.class.php';
require 'lib/projectlister.class.php';
$projectlister = new ProjectLister;

$projectName = $_GET['project'];

if (!$projectlister->isProject($projectName)) {
	die('Invalid project name.');
}

if (!class_exists($projectName))
	require "projects/{$projectName}/project.inc.php";

$project = new $projectName;

$project->bam(true);

?>
