<?php
global $resource_manager;
foreach ($vars['deliverables'] as $deliverable) {
?>
    <div class="deliverable deliverable-<?php echo $deliverable['id']; ?>">
        <ul class="deliverable-menu">
            <li><a class="add" href="#" onclick="milestone.showAddPanel(this); return false;">add resource</a></li>
            <li><a class="refresh" href="#">refresh</a></li>
        </ul>
        <h3><?php echo $deliverable['name']; ?></h3>
        
        <input type="hidden" name="deliverable_id" value="<?php echo $deliverable['id']; ?>" />
        <?php
        $this->render('addresource', array(
                'categories' => $vars['categories']
            ), Template::CACHE_MEMORY);
        ?>
        
        <ul class="categories">
        <?php
        
        foreach ($deliverable['categories'] as $category_id => $category) {
            $empty = empty($category['resources']);
            // We display empty categories because we may need to add resources after loading
            echo '<li class="category category-'.$category['id'].($empty ? ' category-hidden' : '').'"><span class="category-label">'.$category['name'].'</span>';
            
            echo '<ul class="resources">';
            
            if (!$empty) {
                foreach ($category['resources'] as $resource) {
                    echo '<li class="resource '.$resource['resourcetype'].' resource-'.$resource['id'].'" id="resource-'.$resource['id'].'">'.$resource_manager->resourcetypes[$resource['resourcetype']]->buildLink(unserialize($resource['data'])).'</li>';
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