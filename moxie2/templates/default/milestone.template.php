<?php

if (!empty($vars['projects'])) {
    echo '<h3>Projects</h3>';
    foreach ($vars['projects'] as $project) {
        echo '<h4><a href="'.$this->getBaseURL().'/'.$vars['product']['url'].'/projects/'.$project['url'].'">'.$project['name'].'</a></h4>';
    }
}

if (!empty($vars['bugs'])) {
    echo '<h3>Bugs</h3>';
    echo 'group by assignee, component, status, priority, etc.<br/>';
    echo 'sort bugs by number, status, assignee, priority, component<br/>';
    echo 'sort groups by name, #bugs, #open, #fixed';
    echo '<ul class="bug-groups">';
    foreach ($vars['bugs'] as $group => $data) {
        echo '<li><h4>'.$group.' &mdash; <a href="#" onclick="return false;">'.$data['status-'.BugModel::STATUS_OPEN].' open, '.$data['status-'.BugModel::STATUS_FIXED].' fixed</a></h4></li>';
        
        echo '<ul class="bugs">';
        foreach ($data['bugs'] as $bug) {
            echo '<li>'.$this->linkBug($bug).'</li>';
        }
        echo '</ul>';
        
    }
    echo '</ul>';
}

?>