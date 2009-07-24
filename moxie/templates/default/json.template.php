<?php
function json($json, $tab = 0, $encode = false) {
    echo "{\n";
    if (!empty($json)) {
        foreach ($json as $key => $value) {
            echo str_repeat("\t", $tab).'"'.addslashes($key).'": ';
            if (is_array($value))
                json($value, $tab + 1, $encode);
            else
                if (is_numeric($value) && strpos($value, '.') === false)
                    echo "{$value},\n";
                elseif ($encode)
                    echo '"'.urlencode($value).'",'."\n";
                else
                    echo "'".preg_replace('/\n/', '\n', addslashes($value))."',\n";
        }
    }
    echo str_repeat("\t", $tab).'}'.($tab == 0 ? '' : ',')."\n";
}

json($vars['data']);
?>