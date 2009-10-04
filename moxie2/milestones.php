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

$template->breadcrumbs = array(
        $template->getBaseURL() => $Config->get('site_name'),
        $template->getBaseURL().'/'.$product['url'] => $product['name'],
        $template->getBaseURL().'/'.$product['url'].'/milestones' => 'milestones'
    );

$template->render('head', array(
        'title' => $product['name'].' milestones @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'page_title' => $product['name'],
        'page_subtitle' => 'milestones',
        'product_base_url' => $template->getBaseURL().'/'.$product['url']
    ));

$template->render('milestones', array(
        'product' => $product,
        'milestones' => $milestones
    ));

$template->render('footer', array());

?>