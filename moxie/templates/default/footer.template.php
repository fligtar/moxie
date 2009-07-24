</div> <!-- /#content -->

<div id="footer">


</div>

<?php echo $this->jsString('jquery/jquery.min', 'jquery/jquery-ui.min'); ?>
<?php if (!empty($vars['js'])) echo $vars['js']; ?>

<?php
global $starttime;
$endtime = microtime();
$endarray = explode(" ", $endtime);
$endtime = $endarray[1] + $endarray[0];
$totaltime = $endtime - $starttime;
$totaltime = round($totaltime,5);
echo "<div>This page loaded in $totaltime seconds.</div>";
?>

</body>
</html>