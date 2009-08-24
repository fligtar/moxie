<?php
define('PAGE', 'milestone');

require 'includes/init.inc.php';
require 'includes/template.inc.php';
require 'includes/resourcemanager.inc.php';
require 'includes/bugtracking.inc.php';

list($Bug, $Bugtracker, $Category, $Deliverable, $Milestone, $Resource, $Resourcetype, $Project) = 
load_models('Bug', 'Bugtracker', 'Category', 'Deliverable', 'Milestone', 'Resource', 'Resourcetype', 'Project');

if (is_numeric($_GET['project'])) {
    $project = $Project->get($_GET['project']);
}
else {
    $projects = $Project->getAll("url = '".escape($_GET['project'])."'");
    $project = $projects[0];
}

// Get resourcetypes for the project
$resourcetypes = $Resourcetype->getActiveForProject($project['id']);
$resource_manager = new ResourceManager($resourcetypes);

// Get the milestone's info
$milestone = $Milestone->get($_GET['milestone']);

// Get all deliverables for the milestone
$deliverables = $Deliverable->getAll("milestone_id = ".$milestone['id']);

// Get all categories
$categories = $Category->getAll();

// Pull details for each deliverable
if (!empty($deliverables)) {
    foreach ($deliverables as $d => $deliverable) {
        $deliverables[$d]['categories'] = array();
        
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $deliverables[$d]['categories'][$category['id']] = $category;
                $deliverables[$d]['categories'][$category['id']]['resources'] = $Resource->getResources($deliverable['id'], $category['id']);
            }
        }
    }
}

$template = new Template($project['theme'], $Config->get('theme'));

$template->breadcrumbs = array(
        $template->getBaseURL() => 'mozilla',
        $template->getBaseURL().'/'.$project['url'] => $project['name'],
        $template->getBaseURL().'/'.$project['url'].'/milestones/'.$milestone['id'] => $milestone['name']
    );

$template->render('head', array(
        'title' => $project['name'].' - '.$milestone['name'].' @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'project' => $project,
        'milestone' => $milestone,
    ));

$template->render('milestone', array(
        'project' => $project,
        'milestone' => $milestone,
        'deliverables' => $deliverables,
        'categories' => $categories
    ));

$template->render('footer', array(
        'js' => "var milestone_id = '{$milestone['id']}';",
        'jsFiles' => $template->jsString('milestone')
    ));

?>