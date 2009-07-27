<?php
foreach ($vars['deliverables'] as $deliverable) {
?>
    <div class="deliverable-box">
        <ul class="deliverable-menu">
            <li><a class="add" href="#" onclick="milestone.showAddPanel(this); return false;">add resource</a></li>
            <li><a class="refresh" href="#">refresh</a></li>
        </ul>
        <h3><?php echo $deliverable['name']; ?></h3>
    
        <?php
        $this->render('addresource', array(
                'deliverable_id' => $deliverable['id'],
                'categories' => $vars['categories']
            ), Template::CACHE_MEMORY);
        ?>
        
        <ul class="categories">
        <?php
        foreach ($deliverable['categories'] as $category_name => $resources) {
            // Make sure category has at least one resource
            if (empty($resources)) {
                continue;
            }
            
            echo '<li><span class="category '.strtolower($category_name).'">'.$category_name.'</span>';
            
            echo '<ul class="resources">';
            
            global $resource_manager;
            foreach($resources as $resource) {
                echo '<li class="resource '.$resource['resourcetype'].'">'.$resource_manager->resourcetypes[$resource['resourcetype']]->buildLink(unserialize($resource['data'])).'</li>';
            }
            
        /*if (!empty($category['links'])) {
            foreach ($category['links'] as $link) {
                echo '<li class="resource link"><a href="'.$link['url'].'">'.$link['name'].'</a></li>';
            }
        }
        
        if (!empty($category['bugs'])) {
            foreach ($category['bugs'] as $bug) {
                echo '<li class="resource bug">'.$this->bugLink($bug, $vars['bugtrackers'][$bug['bugtracker_id']]).'</li>';
            }
        }*/
            echo '</ul>';
            echo '</li>';
        }
        ?>
        </ul>
    
    </div>
<?php
}
?>