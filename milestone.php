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

if (!empty($projects)) {
    foreach ($projects as $k => $project) {
        // Get all deliverables for the project
        $deliverables = $Deliverable->getKeyedDeliverables($project['id']);
        
        // Get resources for each deliverable
        if (!empty($deliverables)) {
            $deliverables = $Deliverable->nestDeliverables($deliverables);
        }
        
        $projects[$k]['deliverables'] = $deliverables;
    }
}

// Get the milestone's bugs
$bugs = $Bug->getBugsForMilestone($milestone['id']);

// Group the bugs
$bugs = $Bug->groupBugs($bugs, 'component', 'assignee', 'totalbugs');

$template = new Template($product['theme'], $Config->get('theme'));

$template->render('head', array(
        'title' => $product['name'].' - milestone '.$milestone['name'].' @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'site_name' => $Config->get('site_name'),
        'product_name' => $product['name'],
        'page_type' => 'milestones',
        'page_name' => $milestone['name'],
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