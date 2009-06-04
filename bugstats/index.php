<?php
/**
 * Super simple, fugly page to list all available projects
 * for selection
 */
require 'lib/project.class.php';
require 'lib/projectlister.class.php';
$projectlister = new ProjectLister;

echo '<h1>Available Projects</h1>';
echo '<ul>';
$currentProject = '';
foreach ($projectlister->projects as $projectName => $project) {
	echo '<li>'.$project['projectDisplayName'].'</li>';
	echo '<ul>';
	foreach ($project['reports'] as $reportID => $reportDetails) {
		echo '<li><a href="'.$projectName.'/'.$reportDetails['reportName'].'">'.$reportDetails['reportDisplayName'].'</a></li>';
	}
	echo '</ul>';
}
echo '</ul>';

?>