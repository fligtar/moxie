<?php
define('PAGE', 'admin');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($Date, $Milestone, $Product, $Project) = 
load_models('Date', 'Milestone', 'Product', 'Project');

$template = new Template($product['theme'], $Config->get('theme'));

$template->render('head', array(
        'title' => $product['name'].' Roadmap @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
    'site_name' => $Config->get('site_name'),
    'product_name' => $product['name'],
    'page_type' => 'roadmap',
    'product_base_url' => $template->getBaseURL().'/'.$product['url']
    ));

$template->render('roadmap', array(
        'product' => $product,
        'quarters' => $quarters,
        'elapsed' => $elapsed,
        'view' => $view
    ));

$template->render('footer', array(
    ));

?>