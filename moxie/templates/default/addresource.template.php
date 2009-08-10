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
                
                <div class="uncategorized-box">
                    <h3>Uncategorized:</h3>
                    <div class="chooser">
                        <p>Assign a deliverable and category to each resource before it can be added:</p>
                        <label>Deliverable:
                        <select>
                            <option></option>
                        <?php
                        if (!empty($vars['deliverables'])) {
                            foreach ($vars['deliverables'] as $deliverable) {
                                echo '<option>'.$deliverable['name'].'</option>';
                            }
                        }
                        ?>
                        </select></label>
                        
                        <label>Category: 
                        <select>
                            <option></option>
                        <?php
                        if (!empty($vars['categories'])) {
                            foreach ($vars['categories'] as $category) {
                                echo '<option>'.$category['name'].'</option>';
                            }
                        }
                        ?>
                        </select></label>
                        
                        <button type="button">Assign Selected</button>
                    </div>
                    
                    <ul class="resource-grid">
                        <li>
                            <h5><input type="checkbox">bug 1234430</h5>
                            <p>something something</p>
                            <p class="uncategorized">Uncategorized<p>
                        </li>
                        <li>
                            <h5><input type="checkbox">bug 1234430</h5>
                            <p>something something something</p>
                            <p>Uncategorized<p>
                        </li>
                        <li>
                            <h5><input type="checkbox">bug 1234430</h5>
                            <p>something something something</p>
                            <p>Uncategorized<p>
                        </li>
                        <li>
                            <h5><input type="checkbox">bug 1234430</h5>
                            <p>something something something</p>
                            <p>Uncategorized<p>
                        </li>
                    </ul>
                </div>
                
                <div class="tobeadded-box">
                    <h3>To be added:</h3>
                    <ul class="resource-grid">
                        <li>
                            <h5><input type="checkbox">bug 1234430</h5>
                            <p>something something something</p>
                            <p>Uncategorized<p>
                        </li>
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
