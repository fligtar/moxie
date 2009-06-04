<?php
/**
 * Super simple, fugly page to list all available projects
 * for selection
 */
require 'lib/project.class.php';
require 'lib/projectlister.class.php';
$projectlister = new ProjectLister;

$projects = $projectlister->getProjectDetails();

echo '<h1>Available Projects</h1>';
echo '<ul>';
foreach ($projects as $project) {
	echo '<li><a href="'.$project['name'].'">'.$project['displayName'].'</a></li>';
}
echo '</ul>';

?>