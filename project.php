<?php
define('PAGE', 'project');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($Attachment, $Bug, $Comment, $Date, $Deliverable, $Milestone, $Product, $Project) = 
load_models('Attachment', 'Bug', 'Comment', 'Date', 'Deliverable', 'Milestone', 'Product', 'Project');

$product = $Product->getProductFromURL($_GET['product']);

// Get the project's info
$project = $Project->getProjectFromURL($_GET['project']);

// If project is in a milestone, get milestone info
if (!empty($project['milestone_id'])) {
    $project['milestone'] = $Milestone->get($project['milestone_id']);
    $project['milestone']['dates'] = $Date->getAll('milestone_id = '.escape($project['milestone_id']));
}

// Get all deliverables for the project
$deliverables = $Deliverable->getKeyedDeliverables($project['id']);

// Get resources for each deliverable
if (!empty($deliverables)) {
    $Attachment->addAttachmentsToDeliverables($deliverables);
    $Bug->addBugsToDeliverables($deliverables);
    $Comment->addCommentsToDeliverables($deliverables);
    
    $deliverables = $Deliverable->nestDeliverables($deliverables);
}

// Get all products and milestones for edit dropdowns
$milestones = $Milestone->getAll(null, 'id, name');
$products = $Product->getAll(null, 'id, name');

$template = new Template($product['theme'], $Config->get('theme'));

$template->render('head', array(
        'title' => $product['name'].' - '.$project['name'].' @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'site_name' => $Config->get('site_name'),
        'product_name' => $product['name'],
        'page_type' => 'projects',
        'page_name' => $project['name'],
        'product_base_url' => $template->getBaseURL().'/'.$product['url']
    ));

$template->render('project', array(
        'product' => $product,
        'project' => $project,
        'deliverables' => $deliverables,
        'products' => $products,
        'milestones' => $milestones
    ));

$template->render('footer', array(
        'jsFiles' => $template->jsString('project')
    ));

?>