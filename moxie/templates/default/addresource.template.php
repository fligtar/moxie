<div class="add-resource">
    <div class="content">
        <div class="close">
            <a href="#" onclick="milestone.hideAddPanel(this); return false;">Close</a>
        </div>
        
        <div class="type-selector">
            <ul>
            <?php
            global $resource_manager;
            if (!empty($resource_manager->resourcetypes)) {
                foreach ($resource_manager->resourcetypes as $resourcetype) {
                    echo '<li><a class="'.$resourcetype->id.'" href="#" onclick="milestone.showForm(this, \''.$resourcetype->id.'\'); return false;">'.$resourcetype->name.'</a></li>';
                }
            }
            ?>
            </ul>
        </div>
        
        <?php
        if (!empty($resource_manager->resourcetypes)) {
            foreach ($resource_manager->resourcetypes as $resourcetype) {
        ?>
                <div class="type-form <?php echo $resourcetype->id; ?>">
                    <input type="hidden" name="resourcetype" value="<?php echo $resourcetype->id; ?>" />
                    <div class="form"><?php echo $resourcetype->form(); ?></div>
                    
                    <div class="categories">
                        <label>Categories:</label>
                        <ul>
                        <?php
                        if (!empty($vars['categories'])) {
                            foreach ($vars['categories'] as $category) {
                                echo '<li><a class="category category-'.$category['id'].'" href="#" onclick="milestone.selectCategory(this); return false;">';
                                echo $category['name'];
                                echo '<input type="hidden" name="category_id" value="'.$category['id'].'" />';
                                echo '</a></li>';
                            }
                        }
                        ?>
                        </ul>
                    </div>
                    
                    <div class="submit">
                        <input type="button" value="Add to Deliverable" onclick="milestone.addResources(this);"/>
                        <span class="loading">Loading...</span>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>