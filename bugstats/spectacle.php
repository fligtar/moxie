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
    <link rel="stylesheet" href="style.css" />
</head>

<body>

<div id="header">
    <div id="header-content">
        <div id="right-area">
            <?=$render->projectSelectionBox($projectlister->projects);?>
        
            <div id="age-box">
            <?php
            // If data refresh is allowed and the data is more than 5 minutes old, allow manual refresh
            echo '<p>Data retrieved '.$report->cacher->getHumanCacheAge().'.</p>';
            if ($report->manualRefresh && $report->cacher->getCacheAge() > 300)
                echo '<p id="refresh-trigger"><a href="#" onclick="backfetch(); return false;">Refresh now</a></p>';
            ?>
            </div>
        </div>
    
        <img src="projects/<?=$projectName?>/logo.png" alt="<?=$report->reportDisplayName?>" />
        <h1><?="{$report->projectDisplayName} {$report->reportDisplayName}"?></h1>
        <h2>bug status</h2>
    </div>
</div>

<div id="content">

<div id="overall-status">
<h2>Overall Status</h2>
    <div id="status-pie"><?=count($report->data['bugsOpen'])?>,<?=count($report->data['bugsFixed'])?></div>
    <div id="assignment-pie"><?=count($report->data['users'][$report->unassigned]['assignedBugs']['bugsAll'])?>,<?=count($developerBugs)?>,<?=count($otherBugs)?></div>

    <ul id="status-legend">
        <li class="open bugcount"><?=$render->bugLink($report->data['bugsOpen'], '%s <span>OPEN</span> bugs', '1 <span>OPEN</span> bug')?></li>
        <li class="fixed bugcount"><?=$render->bugLink($report->data['bugsFixed'], '%s <span>FIXED</span> bugs', '1 <span>FIXED</span> bug')?></li>
        <li class="other bugcount"><?=$render->bugLink($report->data['bugsOtherResolved'], '%s other resolved bugs', '1 <span>other</span> resolved bug')?></li>
    </ul>
    
</div>

</div><!-- /#content -->

<script type="text/javascript" src="http://g.fligtar.com/jquery.js"></script>
<script type="text/javascript" src="js/shiny.js"></script>
<script type="text/javascript" src="js/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript">
    var projectName = '<?=$projectName?>';
    var reportID = '<?=$reportID?>';
    
    $(function() {
        $('.pie').sparkline('html', {type: 'pie', height: 45, sliceColors: ['#6B2418', '#336B47', '#69645C']} );
        $('#status-pie').sparkline('html', {type: 'pie', height: 150, sliceColors: ['#6B2418', '#336B47', '#69645C']} );
        $('#assignment-pie').sparkline('html', {type: 'pie', height: 150, sliceColors: ['#E8A81D', '#0B26A1', '#69645C']} );
        
        $('.tooltip').tooltip();
        
        <?php
        // If the cache is older than the maximum cache age, backfetch after loading
        if ($report->cacher->getCacheAge() > $report->refreshTime) {
            echo 'backfetch();';
        }
        ?>
    });
</script>

</body>
</html>