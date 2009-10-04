<?php
define('PAGE', 'project');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($Attachment, $Bug, $Date, $Deliverable, $Milestone, $Product, $Project) = 
load_models('Attachment', 'Bug', 'Date', 'Deliverable', 'Milestone', 'Product', 'Project');

$product = $Product->getProductFromURL($_GET['product']);

// Get the project's info
$project = $Project->getProjectFromURL($_GET['project']);

// Get all deliverables for the project
$deliverables = $Deliverable->getKeyedDeliverables($project['id']);

// Get resources for each deliverable
if (!empty($deliverables)) {
    //$deliverables = $Resource->addResourcesToDeliverables($deliverables);
    
    $deliverables = $Deliverable->nestDeliverables($deliverables);
}

$template = new Template($product['theme'], $Config->get('theme'));

$template->breadcrumbs = array(
        $template->getBaseURL() => 'mozilla',
        $template->getBaseURL().'/'.$product['url'] => $product['name'],
        $template->getBaseURL().'/'.$product['url'].'/projects/'.$project['url'] => $project['name']
    );

$template->render('head', array(
        'title' => $product['name'].' - '.$project['name'].' @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'product' => $product,
        'project' => $project,
    ));

$template->render('project', array(
        'product' => $product,
        'project' => $project,
        'deliverables' => $deliverables
    ));

$template->render('footer', array(
    ));

?>