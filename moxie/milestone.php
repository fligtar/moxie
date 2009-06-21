<?php
require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($project_model, $milestone_model, $deliverable_model) = load_models('Project', 'Milestone', 'Deliverable');

if (is_numeric($_GET['project'])) {
    $project = $project_model->get($_GET['project']);
}
else {
    $projects = $project_model->getAll("url = '".escape($_GET['project'])."'");
    $project = $projects[0];
}

$milestone = $milestone_model->get($_GET['milestone']);

pr($project);
pr($milestone);

$template = new Template($project['theme'], $config->get('theme'));

$template->render('head', array(
        'title' => $config->get('site_name').' &raquo; '.$milestone['name'],
        'css' => $template->cssString('global')
    ));

$template->render('header');


$template->render('footer');

?>