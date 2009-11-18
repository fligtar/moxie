<?php
require 'includes/init.inc.php';
require 'includes/template.inc.php';

// Load models used by all actions on the page
load_models('Group', 'Product');

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
        // Check if we have POST data to save
        if (isset($_POST['name'])) {
            $errors = array();
            
            //$errors['url'] = 'Not unique';
            
            if (empty($errors)) {
                $fields = array('name', 'description', 'url');
                $data = $Product->filterData($_POST, $fields);
            
                $Product->update($product['id'], $data);
            
                // Update our product data for templates
                $product = $data;
            
                // Update product URL for templates
                $template->product_url = $product['url'];
            
                // Clear POST data
                $_POST = array();
            
                $template->set(array(
                    'success_message' => 'Changes saved.',
                    'product_name' => $product['name'],
                    'page_title' => $product['name'].' settings @ '. $Config->get('site_name').' moxie',
                ));
            }
            else {
                // There were errors
                $template->set(array(
                    'error_message' => 'There were some problems. Please see the specific errors below.',
                    'errors' => $errors
                ));
            }
        }
        
        $template->set(array(
            'page_name' => 'product information',
            'product' => $product
        ));
        $template->render('layout/header', 'settings/info', 'layout/footer');
        break;
        
    case 'permissions':
        $groups = $Group->getGroupsForUser(1);
        $Group->addPermissionsToGroups($groups);
        pr($groups);
        
        $Group->sumPermissions($groups);
        
        $template->set(array(
            'page_name' => 'manage permissions'
        ));
        $template->render('layout/header', 'settings/permissions', 'layout/footer');
        break;
    
    default:
        $template->render('layout/header', 'settings/settings', 'layout/footer');
        break;
}

?>