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
                    echo '<li><a href="'.$vars['project']['tracker_url'].'/show_bug.cgi?id='.$bug['number'].'">'.$bug['number'].' - '.$bug['summary'].'</a></li>';
                }
            }
            
            echo '</ul>';
        }
    }
    echo '</ul>';
    
    echo '</div>';
}

?>