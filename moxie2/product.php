<?php
define('PAGE', 'product');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($Product) = 
load_models('Product');

$product = $Product->getProductFromURL($_GET['product']);


$template = new Template($product['theme'], $Config->get('theme'));

$template->breadcrumbs = array(
        $template->getBaseURL() => $Config->get('site_name'),
        $template->getBaseURL().'/'.$product['url'] => $product['name']
    );

$template->render('head', array(
        'title' => $product['name'].' @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'page_title' => $product['name'],
        'product_base_url' => $template->getBaseURL().'/'.$product['url']
    ));

$template->render('product', array(
        'product' => $product
    ));

$template->render('footer', array());

?>