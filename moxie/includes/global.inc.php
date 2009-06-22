<?php

function fatal_error($error) {
    echo $error;
    
    exit;
}

function pr($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function load_models() {
    $models = func_get_args();
    global $db;
    $return = array();
    
    foreach ($models as $model) {
        require_once dirname(__FILE__).'/models/'.strtolower($model).'.model.php';
        $model_name = "{$model}Model";
        $return[] = new $model_name($db);
    }
    
    return $return;
}

function escape($string) {
    return mysql_real_escape_string($string);
}

?>