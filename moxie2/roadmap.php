<?php
define('PAGE', 'roadmap');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($Date, $Milestone, $Product, $Project) = 
load_models('Date', 'Milestone', 'Product', 'Project');

if (is_numeric($_GET['product'])) {
    $product = $Product->get($_GET['product']);
}
else {
    $products = $Product->getAll("url = '".escape($_GET['product'])."'");
    $product = $products[0];
}

$view = !empty($_GET['extra']) ? $_GET['extra'] : 'upcoming';

$current_quarter = ceil(date('n') / 3);
$current_year = date('Y');
$quarters = array();

// Show the upcoming year (this quarter + next 3)
if ($view == 'upcoming') {
    $quarter = $current_quarter;
    $year = $current_year;
    
    for ($q = 0; $q < 4; $q++) {
        $quarters[] = array(
            'quarter' => $quarter,
            'year' => $year,
            'active' => ($quarter == $current_quarter && $year == $current_year) ? true : false,
            'start' => date('Y-m-d H:i:s', mktime(0, 0, 0, ($quarter - 1) * 3 + 1, 1, $year)),
            'end' => date('Y-m-d H:i:s', mktime(23, 23, 59, ($quarter - 1) * 3 + 3, date('t', mktime(0, 0, 0, ($quarter - 1) * 3 + 3, 1, $year)), $year))
        );
        
        if ($quarter == 4) {
            $quarter = 1;
            $year++;
        }
        else {
            $quarter++;
        }
    }
    
    // Elapsed time for this chart is only how far we are into this quarter
    $elapsed = (date('n') % 3) - 1 + date('j') / date('t');
}
// Show the current year (Q1-4)
elseif ($view == 'year') {
    for ($q = 1; $q <= 4; $q++) {
        $quarters[] = array(
            'quarter' => $q,
            'year' => $current_year,
            'active' => ($q == $current_quarter) ? true : false,
            'start' => date('Y-m-d H:i:s', mktime(0, 0, 0, ($q - 1) * 3 + 1, 1, $current_year)),
            'end' => date('Y-m-d H:i:s', mktime(23, 23, 59, ($q - 1) * 3 + 3, date('t', mktime(0, 0, 0, ($q - 1) * 3 + 3, 1, $current_year)), $current_year))
        );
    }
    
    // Elapsed time for this chart is how far we are into the year
    $elapsed = (date('n') - 1) + (date('j') / date('t'));
}


// Pull milestones and projects in the given timeframes
foreach ($quarters as $k => $quarter) {
    $quarters[$k]['items'] = $Milestone->getMilestonesStartedDuring($product['id'], $quarter['start'], $quarter['end']);
}

$template = new Template($product['theme'], $Config->get('theme'));

$template->breadcrumbs = array(
        $template->getBaseURL() => 'mozilla',
        $template->getBaseURL().'/'.$product['url'] => $product['name'],
        $template->getBaseURL().'/'.$product['url'].'/roadmap' => 'Roadmap'
    );

$template->render('head', array(
        'title' => $product['name'].' Roadmap @ '. $Config->get('site_name').' moxie',
        'css' => $template->cssString('global')
    ));

$template->render('header', array(
        'product' => $product
    ));

$template->render('roadmap', array(
        'product' => $product,
        'quarters' => $quarters,
        'elapsed' => $elapsed
    ));

$template->render('footer', array(
    ));

?>