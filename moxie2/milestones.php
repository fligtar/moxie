<?php
define('PAGE', 'milestones');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($Milestone, $Product) = 
load_models('Milestone', 'Product');

$product = $Product->getProductFromURL($_GET['product']);

// Get all milestones for this product
$milestones = $Milestone->getAll('product_id = '.escape($product['id']));


$template = new Template($product['theme'], $Config->get('theme'));

$template->render('head', array(
        'title' => $product['name'].' milestones @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'site_name' => $Config->get('site_name'),
        'product_name' => $product['name'],
        'page_type' => 'milestones',
        'product_base_url' => $template->getBaseURL().'/'.$product['url']
    ));

$template->render('milestones', array(
        'product' => $product,
        'milestones' => $milestones
    ));

$template->render('footer', array());

?>