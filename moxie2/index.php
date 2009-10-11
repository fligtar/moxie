<?php
define('PAGE', 'index');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($Product) = 
load_models('Product');

// Get all products
$products = $Product->getAll();


$template = new Template($Config->get('theme'));

$template->render('head', array(
        'title' => $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'site_name' => $Config->get('site_name'),
    ));

$template->render('index', array(
        'products' => $products
    ));

$template->render('footer', array());

?>