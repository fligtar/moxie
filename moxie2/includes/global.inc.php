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

function load_url($url, $post = '') {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    // @TODO remove later
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    
    if (!empty($post)) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    
    $response = curl_exec($ch);

    curl_close($ch);
    
    return $response;
}

/* Hooks */
$hooks = array();

function add_hook($action, $callback) {
    global $hooks;
    
    if (!array_key_exists($action, $hooks)) {
        $hooks[$action] = array();
    }
    
    $hooks[$action][] = $callback;
}

function hook($action) {
    global $hooks;
    
    if (!empty($hooks[$action])) {
        $params = func_get_args();
        unset($params[0]);
        
        foreach ($hooks[$action] as $function) {
            call_user_func_array($function, $params);
        }
    }
}

function strip_tags_attributes($string,$allowtags=NULL,$allowattributes=NULL){
    $string = strip_tags($string,$allowtags);
    if (!is_null($allowattributes)) {
        if(!is_array($allowattributes))
            $allowattributes = explode(",",$allowattributes);
        if(is_array($allowattributes))
            $allowattributes = implode(")(?<!",$allowattributes);
        if (strlen($allowattributes) > 0)
            $allowattributes = "(?<!".$allowattributes.")";
        $string = preg_replace_callback("/<[^>]*>/i",create_function(
            '$matches',
            'return preg_replace("/ [^ =]*'.$allowattributes.'=(\"[^\"]*\"|\'[^\']*\')/i", "", $matches[0]);'   
        ),$string);
    }
    return $string;
}
?>