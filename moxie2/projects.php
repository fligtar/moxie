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

$template->render('head', array(
        'title' => $product['name'].' projects @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'site_name' => $Config->get('site_name'),
        'product_name' => $product['name'],
        'page_type' => 'projects',
        'product_base_url' => $template->getBaseURL().'/'.$product['url']
    ));

$template->render('projects', array(
        'product' => $product,
        'projects' => $projects
    ));

$template->render('footer', array());

?>