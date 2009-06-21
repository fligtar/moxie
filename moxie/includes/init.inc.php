<?php
require dirname(__FILE__).'/global.inc.php';

if (!file_exists(dirname(__FILE__).'/config.php')) {
    fatal_error('No config file found. Copy or rename '.dirname(__FILE__).'/config.default.php to config.php and fill in your database information.');
}

require dirname(__FILE__).'/config.php';
require dirname(__FILE__).'/db.inc.php';
require dirname(__FILE__).'/db/'.$db_engine.'.inc.php';
require dirname(__FILE__).'/model.inc.php';

// Instantiate database class of selected engine
$db = new $db_engine($db_user, $db_pass, $db_name, $db_host, $db_port);

// Unset database config vars
unset($db_user, $db_pass, $db_host, $db_name, $db_port);

list($config) = load_models('Config');


?>