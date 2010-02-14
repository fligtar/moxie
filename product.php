<?php
define('PAGE', 'product');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($Product) = 
load_models('Product');

$product = $Product->getProductFromURL($_GET['product']);


$template = new Template($product['theme'], $Config->get('theme'));

$template->render('head', array(
        'title' => $product['name'].' @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'site_name' => $Config->get('site_name'),
        'product_name' => $product['name'],
        'product_base_url' => $template->getBaseURL().'/'.$product['url']
    ));

$template->render('product', array(
        'product' => $product
    ));

$template->render('footer', array());

?>