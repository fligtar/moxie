<?php
$xml = file_get_contents('stats.xml');

$stats = simplexml_load_string($xml);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head>
    <title>Collection Stats</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../pages.css" />
</head>

<body class="collections">

<div id="content">
    
    <div style="height: 320px;">
        <ul class="left">
            <li class="total"><span><?=number_format($stats->collections->counts->total)?></span><br />collections created</li>
            <li class="total"><span><?=number_format($stats->collections->addon_downloads)?></span><br />add-ons downloaded from collections</li>
        </ul>
        
        <ul class="right">
            <li class="total"><span><?=number_format($stats->collections->collector->downloads)?></span><br />Add-on Collector downloads</li>
            <li class="total"><span><?=number_format($stats->collections->collector->updatepings)?></span><br />Add-on Collectors in use</li>
        </ul>
    </div>

    <div class="section">
        <ul class="left">
            <li class="public count"><span><?=number_format($stats->collections->counts->public)?></span> <strong>public</strong> collections</li>
            <li class="private count"><span><?=number_format($stats->collections->counts->private)?></span> <strong>private</strong> collections</li>
        </ul>
        
        <ul class="right">
            <li class="normal count"><span><?=number_format($stats->collections->counts->normal)?></span> <strong>normal</strong> collections</li>
            <li class="autopublisher count"><span><?=number_format($stats->collections->counts->autopublishers)?></span> <strong>auto-publishers</strong></li>
        </ul>
    </div>
    
    <div class="section">
        <div id="status-pie" class="left"><?=$stats->collections->counts->public.','.$stats->collections->counts->private?></div>
        <div id="type-pie" class="right"><?=$stats->collections->counts->normal.','.$stats->collections->counts->autopublishers?></div>
    </div>

</div><!-- /#content -->

<script type="text/javascript" src="http://g.fligtar.com/jquery.js"></script>
<script type="text/javascript" src="../../../bugstats/js/jquery.sparkline.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#status-pie').sparkline('html', {type: 'pie', height: 150, sliceColors: ['#607827', '#6B2418']} );
        $('#type-pie').sparkline('html', {type: 'pie', height: 150, sliceColors: ['#B8AB26', '#2055B7']} );
    });
</script>

</body>
</html>