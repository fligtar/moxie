<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head>
    <title>Spectacle</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="style.css" />
</head>

<body onload="getBrowserSize(); rotateViews();" onresize="getBrowserSize();">

<ul id="nav">
    <li><a href="../bugstats/amo/5.0.6/spectacle" onclick="changeView(this); return false;">AMO 5.0.6</a><img src="../bugstats/projects/amo/logo-large.png" alt=""/></li>
    <li><a href="../bugstats/amo/5.0.7/spectacle" onclick="changeView(this); return false;">AMO 5.0.7</a><img src="../bugstats/projects/amo/logo-large.png" alt=""/></li>
    <!--<li><a href="http://addons.mozilla.org" onclick="changeView(this); return false;">AMO Stats</a><img src="../bugstats/projects/amo/logo-large.png" alt=""/></li>
    <li><a href="http://status.mozilla.com/en-US/outages.html" onclick="changeView(this); return false;">IT Bugs</a></li>-->
</ul>

<h1>&nbsp;</h1>

<div id="content-box">
    <iframe src="" scrolling="no"></iframe>
</div>

<img id="logo" src="" />

<script type="text/javascript" src="http://g.fligtar.com/jquery.js"></script>
<script type="text/javascript">
function rotateViews() {
    var next = $('#nav li:not(.past):not(.present):first a');
    
    if (next.size() == 0) {
        $('.present,.past').removeClass('present').removeClass('past');
        rotateViews();
        return;
    }
    
    changeView(next);
    
    window.setTimeout("rotateViews()", 20000);
}

function changeView(a) {
    $(a).blur();
    $('iframe').attr('src', $(a).attr('href'));
    $('.present').removeClass('present').addClass('past');
    $(a).parent().addClass('present');
    $('h1').text($(a).text());
    $('#logo').attr('src', $(a).parent().find('img').attr('src'));
}

function getBrowserSize() {
    if (parseInt(window.innerWidth) > 0 && parseInt(window.innerHeight) > 0) {
        // Firefox
        resize(window.innerHeight, window.innerWidth)
    }
    else if (parseInt(document.body.clientWidth) > 0 && parseInt(document.body.clientHeight) > 0) {
        // IE
        resize(document.body.clientHeight, document.body.clientWidth);
    }
}

function resize(height, width) {
    $('iframe').css('height', height - 115 - 30 + 'px');
}

</script>
</body>
</html>