<div id="add-resources" class="overlay">
    <div class="sidebar">
        <h4>Add resources:</h4>
        <ul>
        <?php
        global $resource_manager;
        if (!empty($resource_manager->resourcetypes)) {
            foreach ($resource_manager->resourcetypes as $resourcetype) {
                echo '<li><a id="tab-'.$resourcetype->id.'" href="#"';
                echo ' onclick="add_resources.showPanel(\''.$resourcetype->id.'\'); return false;"';
                echo ' style="'.(!empty($resourcetype->icon) ? 'background-image: url('.$this->image('resources/'.$resourcetype->icon).');' : '').'">';
                echo $resourcetype->name.'<span class="badge"></span>';
                echo '</a></li>';
            }
        }
        ?>
        </ul>
    </div>
    
    <div class="panel">
    <?php
    if (!empty($resource_manager->resourcetypes)) {
        foreach ($resource_manager->resourcetypes as $resourcetype) {
    ?>
            <div class="resource-panel" id="panel-<?php echo $resourcetype->id; ?>">
                <input type="hidden" name="resourcetype" value="<?php echo $resourcetype->id; ?>" />
                <div class="form"><?php echo $resourcetype->form(); ?></div>
                
                <div class="categories">
                    <label>Categories:</label>
                    <ul>
                    <?php
                    if (!empty($vars['categories'])) {
                        foreach ($vars['categories'] as $category) {
                            echo '<li class="category category-'.$category['id'].'"><a class="category-label" href="#" onclick="milestone.selectCategory(this); return false;">';
                            echo $category['name'];
                            echo '<input type="hidden" name="category_id" value="'.$category['id'].'" />';
                            echo '</a></li>';
                        }
                    }
                    ?>
                    </ul>
                </div>
            </div>
    <?php
        }
    }
    ?>
    </div>
    
    <div class="footer">
        <a href="#" onclick="add_resources.hide(); return false;" class="cancel">Cancel</a>
        <button type="button" class="pretty-button">Add Resources</button>
    </div>
</div>
