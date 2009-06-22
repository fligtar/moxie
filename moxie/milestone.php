<?php
require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($Project, $Milestone, 
    $Deliverable, $Category, 
    $Resource, $Bug) = load_models(
                                    'Project', 'Milestone', 
                                    'Deliverable', 'Category', 
                                    'Resource', 'Bug');

if (is_numeric($_GET['project'])) {
    $project = $Project->get($_GET['project']);
}
else {
    $projects = $Project->getAll("url = '".escape($_GET['project'])."'");
    $project = $projects[0];
}

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
                $deliverables[$d]['categories'][$category['name']] = array(
                    'links' => $Resource->getLinkResources($deliverable['id'], $category['id']),
                    'bugs' => $Resource->getBugResources($deliverable['id'], $category['id'])
                );
            }
        }
    }
}

$template = new Template($project['theme'], $Config->get('theme'));

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
        'deliverables' => $deliverables
    ));

$template->render('footer');

?>