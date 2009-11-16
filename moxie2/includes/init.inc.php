<?php
$starttime = microtime();
$startarray = explode(" ", $starttime);
$starttime = $startarray[1] + $startarray[0];

define('INCLUDES', dirname(__FILE__));

require INCLUDES.'/global.inc.php';

if (!file_exists(INCLUDES.'/config.php')) {
    fatal_error('No config file found. Copy or rename '.dirname(__FILE__).'/config.default.php to config.php and fill in your database information.');
}

require INCLUDES.'/config.php';
require INCLUDES.'/db.inc.php';
require INCLUDES.'/db/'.$db_engine.'.inc.php';
require INCLUDES.'/model.inc.php';

// Instantiate database class of selected engine
$db = new $db_engine($db_user, $db_pass, $db_name, $db_host, $db_port);

// Unset database config vars
unset($db_user, $db_pass, $db_host, $db_name, $db_port);

load_models('Config');

session_start();


?>