<?php
define('PAGE', 'account');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($User) = load_models('User');

$template = new Template($Config->get('theme'));



if ($_GET['action'] == 'login') {
    $error = '';
    
    // Check if there is already login data in POST
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        if ($user = $User->authenticate($_POST['email'], $_POST['password'])) {
            // Login successful. Set session data and redirect
            $_SESSION = $user;
            
            if (!empty($_POST['redirect'])) {
                header('Location: '.$_POST['redirect']);
            }
            else {
                header('Location: '.$template->getBaseURL());
            }
            exit;
        }
        else {
            // Login failed. Add to error messages
            $error = 'Invalid e-mail address or password. Won\'t you try again?';
        }
    }
    
    $action_template = 'login';
    $action_vars = array(
        'context' => 'full',
        'error' => $error,
        'site_name' => $Config->get('site_name')
    );
}
// Log the user out
elseif ($_GET['action'] == 'logout') {
    $_SESSION = array();
    session_destroy();
    
    $action_template = 'loggedout';
    $action_vars = array();
}
elseif ($_GET['action'] == 'register') {
    $action_template = 'register';
    $action_vars = array();
}
elseif ($_GET['action'] == 'account') {
    $action_template = 'account';
    $action_vars = array();
}

$template->render('head', array(
        'title' => $Config->get('site_name').' moxie',
        'css' => $template->cssString('global'),
        'body_class' => 'body-'.$_GET['action']
    ));

if ($_GET['action'] != 'login') {
    $template->render('header', array(
            'site_name' => $Config->get('site_name'),
            ));
}

// The main template on this page depends on the action.    
$template->render($action_template, $action_vars);

$template->render('footer', array());

?>