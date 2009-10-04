<?php
define('PAGE', 'projects');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($Product, $Project) = 
load_models('Product', 'Project');

$product = $Product->getProductFromURL($_GET['product']);

// Get all projects for this product
$projects = $Project->getAll('product_id = '.escape($product['id']));


$template = new Template($product['theme'], $Config->get('theme'));

$template->breadcrumbs = array(
        $template->getBaseURL() => $Config->get('site_name'),
        $template->getBaseURL().'/'.$product['url'] => $product['name'],
        $template->getBaseURL().'/'.$product['url'].'/projects' => 'projects'
    );

$template->render('head', array(
        'title' => $product['name'].' projects @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'page_title' => $product['name'],
        'page_subtitle' => 'projects',
        'product_base_url' => $template->getBaseURL().'/'.$product['url']
    ));

$template->render('projects', array(
        'product' => $product,
        'projects' => $projects
    ));

$template->render('footer', array());

?>