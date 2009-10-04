<?php
define('PAGE', 'milestone');

require 'includes/init.inc.php';
require 'includes/template.inc.php';
require 'includes/resourcemanager.inc.php';
require 'includes/bugtracking.inc.php';

list($Attachment, $Bug, $Date, $Deliverable, $Milestone, $Product, $Project) = 
load_models('Attachment', 'Bug', 'Date', 'Deliverable', 'Milestone', 'Product', 'Project');

$product = $Product->getProductFromURL($_GET['product']);

// Get the milestone's info
$milestone = $Milestone->getMilestoneFromURL($_GET['milestone']);

// Get the milestone's projects
$projects = $Project->getProjectsForMilestone($milestone['id']);

// Get the milestone's bugs
$bugs = $Bug->getBugsForMilestone($milestone['id']);

$template = new Template($product['theme'], $Config->get('theme'));

$template->breadcrumbs = array(
        $template->getBaseURL() => 'mozilla',
        $template->getBaseURL().'/'.$product['url'] => $product['name'],
        $template->getBaseURL().'/'.$product['url'].'/milestones/'.$milestone['url'] => $milestone['name']
    );

$template->render('head', array(
        'title' => $product['name'].' - '.$milestone['name'].' @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'product' => $product,
        'milestone' => $milestone,
    ));

$template->render('milestone', array(
        'product' => $product,
        'milestone' => $milestone,
        'projects' => $projects,
        'bugs' => $bugs
    ));

$template->render('footer', array(
        'js' => "var milestone_id = '{$milestone['id']}';",
        'jsFiles' => $template->jsString('milestone')
    ));

?>