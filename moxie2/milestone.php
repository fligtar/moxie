<?php
define('PAGE', 'milestone');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

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
        $template->getBaseURL() => $Config->get('site_name'),
        $template->getBaseURL().'/'.$product['url'] => $product['name'],
        $template->getBaseURL().'/'.$product['url'].'/milestones' => 'milestones',
        $template->getBaseURL().'/'.$product['url'].'/milestones/'.$milestone['url'] => $milestone['name']
    );

$template->render('head', array(
        'title' => $product['name'].' - milestone '.$milestone['name'].' @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'page_title' => $product['name'],
        'page_subtitle' => 'milestone '.$milestone['name'],
        'product_base_url' => $template->getBaseURL().'/'.$product['url']
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