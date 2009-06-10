<?php
// "I thought YOU had class"
require_once 'lib/renderer.class.php';
require_once 'lib/projectlister.class.php';
$projectlister = new ProjectLister;

// If no project or report, go to index
if (empty($_GET['project']) || empty($_GET['report'])) {
    header('Location: ../../index.php');
    exit;
}

$projectName = $_GET['project'];
$reportName = $_GET['report'];

if (!empty($_GET['params'])) {
    $_params = explode('/', $_GET['params']);
    foreach ($_params as $_param) {
        $split = explode(':', $_param);
        $params[$split[0]] = $split[1];
    }
}
else {
    $params = array();
}

$sort = !empty($params['sort']) ? $params['sort'] : 'bugsOpen';

$reportID = $projectlister->getReportID($reportName, $projectName);

// Make sure the project and report exists
if (!$reportID) {
    header('Location: ../../index.php');
    exit;
}

// Include the report config file
require_once "projects/{$projectName}/reports/{$reportID}/report.inc.php";

// Instantiate the report
$report = new $reportID;

// BAM!
$report->bam();

$render = new Renderer($report);

//echo "<pre>".print_r($report->data, true)."</pre>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head>
    <title><?="{$report->projectDisplayName} {$report->reportDisplayName}"?> Status</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <base href="http://<?=$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF'])?>/" />
    <link rel="stylesheet" href="css/spectacle.css" />
</head>

<body>

<div id="content">

<div id="details">
    <p><?=$report->summary?></p>
    <ul>
        <li>Code Freeze: <strong><?=date('F j', strtotime($report->codeFreeze))?></strong></li>
        <li>Launch: <strong><?=date('F j', strtotime($report->launch))?></strong></li>
    </ul>
</div>

<div id="bug-status">
    <div id="status-pie"><?=count($report->data['bugsOpen'])?>,<?=count($report->data['bugsFixed'])?></div>

    <ul>
        <li class="open bugcount"><?=$render->bugLink($report->data['bugsOpen'], '<span>%s</span><strong>OPEN</strong> bugs', '<span>1</span><strong>OPEN</strong> bug')?></li>
        <li class="fixed bugcount"><?=$render->bugLink($report->data['bugsFixed'], '<span>%s</span><strong>FIXED</strong> bugs', '<span>1</span><strong>FIXED</strong> bug')?></li>
    </ul>
    
</div>

<div id="footer">
    <p>Last updated: <?=$report->cacher->getHumanCacheAge()?></p>
</div>

</div><!-- /#content -->

<script type="text/javascript" src="http://g.fligtar.com/jquery.js"></script>
<script type="text/javascript" src="js/jquery.sparkline.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#status-pie').sparkline('html', {type: 'pie', height: 200, sliceColors: ['#6B2418', '#336B47']} );
    });
</script>

</body>
</html>