<?php

foreach ($vars['deliverables'] as $deliverable) {
    echo '<div class="deliverable-box">';
    
    echo '<ul class="deliverable-menu">';
    echo '<li><a class="add" href="#" onclick="milestone.showAddPanel(this); return false;">add resource</a></li>';
    echo '<li><a class="refresh" href="#">refresh</a></li>';
    echo '</ul>';
    echo '<h3>'.$deliverable['name'].'</h3>';
    
    $this->render('addresource', array(
            'bugtrackers' => $vars['bugtrackers'],
            'categories' => $vars['categories']
        ));
    
    echo '<ul class="categories">';
    foreach ($deliverable['categories'] as $category_name => $category) {
        echo '<li><span class="category '.strtolower($category_name).'">'.$category_name.'</span>';
        
        if (!empty($category['links']) || !empty($category['bugs'])) {
            echo '<ul class="resources">';
            
            if (!empty($category['links'])) {
                foreach ($category['links'] as $link) {
                    echo '<li class="resource link"><a href="'.$link['url'].'">'.$link['name'].'</a></li>';
                }
            }
            
            if (!empty($category['bugs'])) {
                foreach ($category['bugs'] as $bug) {
                    echo '<li class="resource bug">'.$this->bugLink($bug, $vars['bugtrackers'][$bug['bugtracker_id']]).'</li>';
                }
            }
            
            echo '</ul>';
        }
        echo '</li>';
    }
    echo '</ul>';
    
    echo '</div>';
}

?>