<?php
$xml = file_get_contents('stats.xml');

$stats = simplexml_load_string($xml);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head>
    <title>Add-on Stats</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../pages.css" />
</head>

<body>

<div id="content">
    
    <div>
        <ul>
            <li class="total"><span><?=number_format($stats->addons->downloads)?></span><br />add-ons downloaded</li>
            <li class="total"><span><?=number_format($stats->addons->updatepings)?></span><br />add-ons in use</li>
        </ul>
    </div>

    <div class="section">
        <div id="status-pie"><?=$stats->addons->counts->public.','.$stats->addons->counts->experimental.','.$stats->addons->counts->nominated?></div>

        <ul>
            <li class="public count"><span><?=number_format($stats->addons->counts->public)?></span> <strong>public</strong> add-ons</li>
            <li class="indented count"><?=number_format($stats->addons->counts->pending)?> updates pending</li>
            <li class="experimental count"><span><?=number_format($stats->addons->counts->experimental)?></span> <strong>experimental</strong> add-ons</li>
            <li class="nominated count"><span><?=number_format($stats->addons->counts->nominated)?></span> <strong>nominated</strong> add-ons</li>
        </ul>

    </div>

</div><!-- /#content -->

<script type="text/javascript" src="http://g.fligtar.com/jquery.js"></script>
<script type="text/javascript" src="../../../bugstats/js/jquery.sparkline.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#status-pie').sparkline('html', {type: 'pie', height: 250, sliceColors: ['#607827', '#6B2418', '#2055B7']} );
    });
</script>

</body>
</html>