<?php
define('PAGE', 'roadmap');

require 'includes/init.inc.php';
require 'includes/template.inc.php';

list($Date, $Milestone, $Product, $Project) = 
load_models('Date', 'Milestone', 'Product', 'Project');

$product = $Product->getProductFromURL($_GET['product']);

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

$template->render('head', array(
        'title' => $product['name'].' roadmap @ '. $Config->get('site_name').' moxie',
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