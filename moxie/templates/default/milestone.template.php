<?php

foreach ($vars['deliverables'] as $deliverable) {
    echo '<div class="deliverable-box">';
    echo '<h3>'.$deliverable['name'].'</h3>';
    
    echo '<ul>';
    foreach ($deliverable['categories'] as $category_name => $category) {
        echo '<li>'.$category_name.'</li>';
        
        if (!empty($category['links']) || !empty($category['bugs'])) {
            echo '<ul>';
            
            if (!empty($category['links'])) {
                foreach ($category['links'] as $link) {
                    echo '<li><a href="'.$link['url'].'">'.$link['url'].'</a></li>';
                }
            }
            
            if (!empty($category['bugs'])) {
                foreach ($category['bugs'] as $bug) {
                    $tracker = $vars['bugtrackers'][$bug['bugtracker_id']];
                    echo '<li><a href="'.$tracker['url'].sprintf($tracker['tracker_info']['viewpage'], $bug['number']).'">'.$tracker['tracker_info']['bug_term'].' '.$bug['number'].' - '.$bug['summary'].'</a></li>';
                }
            }
            
            echo '</ul>';
        }
    }
    echo '</ul>';
    
    echo '</div>';
}

?>