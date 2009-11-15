<?php
define('PAGE', 'account');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($Product) = 
load_models('Product');

$template = new Template($Config->get('theme'));

$template->render('head', array(
        'title' => $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'site_name' => $Config->get('site_name'),
    ));

if ($_GET['action'] == 'login') {
    exit;
    $template->render('login', array());
}
elseif ($_GET['action'] == 'logout') {
    $_SESSION = array();
    session_destroy();
    
    $template->render('loggedout', array());
}
elseif ($_GET['action'] == 'register') {
    $template->render('register', array());
}

$template->render('footer', array());

?>