<div class="deliverables">
<?php
        
function renderDeliverables($deliverables, $level = 0, &$template) {
    if (!empty($deliverables)) {
        foreach ($deliverables as $deliverable_id => $deliverable) {
            echo '<div class="deliverable level-'.$level.'" id="deliverable-'.$deliverable['id'].'">';
            echo "<h3>{$deliverable['name']}</h3>";
            echo "<p>{$deliverable['description']}</p>";
            
            // Output any associated attachments
            if (!empty($deliverable['attachments'])) {
                echo '<ul>';
                foreach ($deliverable['attachments'] as $attachment) {
                    echo '<li>';
                    echo '<img src="'.$template->getBaseURL().'/uploads/thumbnails/'.$attachment['file'].'"/>';
                    echo '</li>';
                }
                echo '</ul>';
            }
            
            // Output any associated bugs
            if (!empty($deliverable['bugs'])) {
                echo '<ul>';
                foreach ($deliverable['bugs'] as $bug) {
                    echo '<li>';
                    if ($bug['role'] == BugModel::ROLE_TRACKING) {
                        echo '<span>Tracking Bug: </span>';
                    }
                    
                    $template->linkBug($bug);
                    echo '</li>';
                }
                echo '</ul>';
            }
            
            // Render any sub-deliverables
            if (!empty($deliverable['children'])) {
                renderDeliverables($deliverable['children'], $level + 1, $template);
            }
            
            echo '</div>';
        }
    }
}

renderDeliverables($vars['deliverables'], 0, $this);

?>
</div>