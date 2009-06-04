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
        <link rel="stylesheet" href="../style.css" />
</head>

<body>

<div id="header">
    <div id="header-content">
        <div id="right-area">
            <div>
                <?=$render->projectSelectionBox($projectlister->projects);?>
            </div>
        
            <div id="age-box">
            <?php
            // If data refresh is allowed and the data is more than 5 minutes old, allow manual refresh
            echo '<p>Data retrieved '.$report->cacher->getHumanCacheAge().'.</p>';
            if ((!isset($report->refresh) || $report->refresh === true) && $report->cacher->getCacheAge() > 300)
                echo '<p id="refresh-trigger"><a href="#" onclick="backfetch(); return false;">Refresh now</a></p>';
            ?>
            </div>
        </div>
    
        <img src="../projects/<?=$projectName?>/logo.png" alt="<?=$report->reportDisplayName?>" />
        <h1><?="{$report->projectDisplayName} {$report->reportDisplayName}"?></h1>
        <h2>bug status</h2>
    </div>
</div>

<div id="toolbar">
    <div id="toolbar-content">
        <div>
            <p>highlight:</p>
            <ul>
                <li id="highlight-reviewRequests" class="toggle button"><a href="#" onclick="highlight('reviewRequests'); return false;">review requests</a></li>
                <li id="highlight-bugsOpenReviewedPlus" class="toggle button"><a href="#" onclick="highlight('bugsOpenReviewedPlus'); return false;">reviewed patches</a></li>
                <li id="highlight-bugsOpenAwaitingReview" class="toggle button"><a href="#" onclick="highlight('bugsOpenAwaitingReview'); return false;">unreviewed patches</a></li>
            </ul>
        </div>
        <div>
            <p>sort by:</p>
            <ul>
                <li id="sort-bugsOpen" class="button<?=($sort == 'bugsOpen' ? ' on' : '')?>"><a href="<?=$render->currentURL()?>/sort:bugsOpen">open bugs</a></li>
                <li id="sort-bugsFixed" class="button<?=($sort == 'bugsFixed' ? ' on' : '')?>"><a href="<?=$render->currentURL()?>/sort:bugsFixed">fixed bugs</a></li>
            </ul>
        </div>
    </div>
</div>

<div id="content">

    <div id="backfetching">
        New data is currently being retrieved and processed. You will be notified when it is ready.
    </div>
    <div id="backfetched">
        New data is available. <a href="javascript:location.reload();">Refresh this page</a> to see it.
    </div>

<?php
    $developers = array();
    $developerBugs = array();
    $others = array();
    $otherBugs = array();
    $sorted = array();
    
    // Build an array with the sorted field counts
    foreach ($report->data['users'] as $user) {
        if ($user['email'] != $report->unassigned) {
            $sorted[$user['email']] = $user['assignedBugs'][$sort];
        }
    }
    
    // Sort!
    arsort($sorted);
    
    foreach ($sorted as $email => $count) {
        $user =& $report->data['users'][$email];
        
        // Build primary developer array
        if (in_array($user['email'], $report->developers)) {
            $developers[] = $user;
            $developerBugs = array_merge($developerBugs, $user['assignedBugs']['bugsAll']);
        }
        elseif ($user['email'] != $report->unassigned) {
            $others[] = $user;
            $otherBugs = array_merge($otherBugs, $user['assignedBugs']['bugsAll']);
        }
    }
?>

<div id="overall-status">
<h2>Overall Status</h2>
    <div id="status-pie"><?=count($report->data['bugsOpen'])?>,<?=count($report->data['bugsFixed'])?>,<?=count($report->data['bugsOtherResolved'])?></div>
    <div id="assignment-pie"><?=count($report->data['users'][$report->unassigned]['assignedBugs']['bugsAll'])?>,<?=count($developerBugs)?>,<?=count($otherBugs)?></div>

    <ul id="status-legend">
        <li class="open bugcount"><?=$render->bugLink($report->data['bugsOpen'], '%s <span>OPEN</span> bugs', '1 <span>OPEN</span> bug')?></li>
        <li class="fixed bugcount"><?=$render->bugLink($report->data['bugsFixed'], '%s <span>FIXED</span> bugs', '1 <span>FIXED</span> bug')?></li>
        <li class="other bugcount"><?=$render->bugLink($report->data['bugsOtherResolved'], '%s other resolved bugs', '1 <span>other</span> resolved bug')?></li>
    </ul>
    
    <ul id="assignment-legend">
        <li class="unassigned bugcount"><?=$render->bugLink($report->data['users'][$report->unassigned]['assignedBugs']['bugsAll'], '%s <span>unassigned</span> bugs', '1 <span>unassigned</span> bug')?></li>
        <li class="primary bugcount"><?=$render->bugLink($developerBugs, '%s <span>primary developer</span> bugs', '1 <span>primary developer</span> bug')?></li>
        <li class="other bugcount"><?=$render->bugLink($otherBugs, '%s other bugs', '1 other  bug')?></li>
    </ul>
    
    <p class="unassigned-count"><?=$render->bugLink($report->data['users'][$report->unassigned]['assignedBugs']['bugsOpen'], '%s <span class="open">OPEN</span> <span class="unassigned">unassigned</span> bugs', '1 <span class="open">OPEN</span> <span class="unassigned">unassigned</span> bug')?></p>
</div>

<h2>Primary Developers</h2>
<?=$render->userGrid($developers);?>

<h2>Others</h2>
<?=$render->userGrid($others);?>

</div><!-- /#content -->

<div id="footer">
    Report generated based on <a href="<?=$report->queryBase.htmlentities($report->queryString)?>">this query</a> and does not include non-public bugs.
	<div id="poweredby">
		<a href="http://code.google.com/p/moxie-dev/"><img src="../images/poweredbymoxie.png" alt="powered by moxie" /></a>
	</div>
</div>

<script type="text/javascript" src="http://g.fligtar.com/jquery.js"></script>
<script type="text/javascript" src="../js/shiny.js"></script>
<script type="text/javascript" src="../js/jquery.sparkline.min.js"></script>
<script type="text/javascript">
    var projectName = '<?=$projectName?>';
	var reportID = '<?=$reportID?>';
    
    $(function() {
        $('.pie').sparkline('html', {type: 'pie', height: 50, sliceColors: ['#6B2418', '#336B47', '#69645C']} );
        $('#status-pie').sparkline('html', {type: 'pie', height: 150, sliceColors: ['#6B2418', '#336B47', '#69645C']} );
        $('#assignment-pie').sparkline('html', {type: 'pie', height: 150, sliceColors: ['#E8A81D', '#0B26A1', '#69645C']} );
        
        <?php
        // If refresh is allowed and the cache is more than an hour old, backfetch after loading
        if ((!isset($report->refresh) || $report->refresh === true) && $report->cacher->getCacheAge() > 3600) {
            echo 'backfetch();';
        }
        ?>
    });
</script>

</body>
</html>