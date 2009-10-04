<?php
if (!empty($vars['projects'])) {
    echo '<ul>';
    foreach ($vars['projects'] as $project) {
        echo '<li><a href="'.$this->getBaseURL().'/'.$vars['product']['url'].'/projects/'.$project['url'].'">'.$project['name'].'</a></li>';
    }
    echo '</ul>';
}
?>