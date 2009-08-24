<div class="deliverables">
<?php
global $resource_manager;
foreach ($vars['deliverables'] as $deliverable) {
?>
    <div class="deliverable" id="deliverable-<?php echo $deliverable['id']; ?>">
        <?php hook('render_deliverable', $deliverable); ?>
        <input type="hidden" name="deliverable_id" value="<?php echo $deliverable['id']; ?>" />
        <h3><?php echo $deliverable['name']; ?></h3>
        
        <ul class="categories">
        <?php
        
        foreach ($deliverable['categories'] as $category_id => $category) {
            $empty = empty($category['resources']);
            // We display empty categories because we may need to add resources after loading
            echo '<li class="category'.($empty ? ' category-hidden' : '').'" id="category-'.$category['id'].'"><span class="category-label">'.$category['name'].'</span>';
            
            echo '<ul class="resources">';
            
            if (!$empty) {
                foreach ($category['resources'] as $resource) {
                    echo '<li class="resource '.$resource['resourcetype'].'" id="resource-'.$resource['id'].'">'.$resource_manager->resourcetypes[$resource['resourcetype']]->getLink(unserialize($resource['data'])).'</li>';
                }
            }
            
            echo '</ul>';
            echo '</li>';
        }
        ?>
        </ul>
    
    </div>
<?php
}
?>
</div>
<?php
$this->render('addresource', array(
        'deliverables' => $vars['deliverables'],
        'categories' => $vars['categories']
    ));
?>