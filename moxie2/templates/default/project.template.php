<div class="deliverables">
<?php
        
function renderDeliverables($deliverables, $level = 0) {
    if (!empty($deliverables)) {
        foreach ($deliverables as $deliverable_id => $deliverable) {
            echo '<div class="deliverable level-'.$level.'" id="deliverable-'.$deliverable['id'].'">';
            echo "<h3>{$deliverable['name']}</h3>";
            echo "<p>{$deliverable['description']}</p>";
            
            // Render any sub-deliverables
            if (!empty($deliverable['children'])) {
                renderDeliverables($deliverable['children'], $level + 1);
            }
            
            echo '</div>';
        }
    }
}

renderDeliverables($vars['deliverables']);

?>
</div>