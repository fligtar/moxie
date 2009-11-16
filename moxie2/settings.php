<?php
require 'includes/init.inc.php';
require 'includes/template.inc.php';

// Load models used by all actions on the page
load_models('Product');

// Determine the product
$product = $Product->getProductFromURL($_GET['product']);

// Load template engine and set some variables
$template = new Template($product['theme'], $Config->get('theme'), $product['url']);
$template->set(array(
    'page_id' => 'settings',
    'page_title' => $product['name'].' settings @ '. $Config->get('site_name').' moxie',
    'page_type' => 'settings',
    'css' => $template->cssString('global'),
    'site_name' => $Config->get('site_name'),
    'product_name' => $product['name']
));

// Action-specific logic
switch ($_GET['extra']) {
    case 'info':
        $template->set(array(
            'page_name' => 'product information'
        ));
        $template->render('head', 'header', 'settings/info', 'footer');
        break;
        
    case 'permissions':
        $template->set(array(
            'page_name' => 'manage permissions'
        ));
        $template->render('head', 'header', 'settings/permissions', 'footer');
        break;
    
    default:
        $template->render('head', 'header', 'settings/settings', 'footer');
        break;
}

?>