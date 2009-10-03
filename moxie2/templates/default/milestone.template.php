<div class="deliverables">
<?php
        
function renderDeliverables($deliverables, $level = 0) {
    global $resource_manager;
    
    if (!empty($deliverables)) {
        foreach ($deliverables as $deliverable_id => $deliverable) {
            echo '<div class="deliverable level-'.$level.'" id="deliverable-'.$deliverable['id'].'">';
            hook('render_deliverable', $deliverable);
            echo '<input type="hidden" name="deliverable_id" value="'.$deliverable['id'].'" />';
            echo "<h3>{$deliverable['name']}</h3>";
            
            // Render resources for this deliverable
            echo '<ul class="resources">';
            if (!empty($deliverable['resources'])) {
                foreach ($deliverable['resources'] as $resource) {
                    echo '<li class="resource '.$resource['resourcetype'].'" id="resource-'.$resource['id'].'">'.$resource_manager->resourcetypes[$resource['resourcetype']]->getLink(unserialize($resource['data'])).'</li>';
                }
            }
            echo '</ul>';
            
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
<?php
$this->render('addresource', array(
        'deliverables' => $vars['deliverables']
    ));
?>