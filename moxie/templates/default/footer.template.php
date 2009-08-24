    </div> <!-- /#content -->

    <div id="footer">

    </div>

</div> <!-- /#page -->

<div id="global-footer">
    <a href="http://www.moxieproject.org"><img src="<?php echo $this->image('moxie-logo.png') ?>" alt="moxie" title="powered by moxie" /></a>
</div>

<?php
echo $this->jsString('jquery/jquery.min', 'jquery/jquery-ui.min');

// Custom JS in the page
if (!empty($vars['js'])) {
    echo '<script type="text/javascript">';
    echo $vars['js'];
    echo '</script>';
}

// Page-specific js files
if (!empty($vars['jsFiles'])) {
    echo $vars['jsFiles'];
}

echo '<script type="text/javascript">';
hook('output_js');
echo '</script>';

/*global $starttime;
$endtime = microtime();
$endarray = explode(" ", $endtime);
$endtime = $endarray[1] + $endarray[0];
$totaltime = $endtime - $starttime;
$totaltime = round($totaltime,5);
echo "<div>This page loaded in $totaltime seconds.</div>";*/
?>

</body>
</html>