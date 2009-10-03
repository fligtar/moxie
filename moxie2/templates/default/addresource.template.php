<?php
function deliverableOptions($deliverables, $level = 0) {
    $output = '';
    if (!empty($deliverables)) {
        foreach ($deliverables as $deliverable_id => $deliverable) {
            $output .= '<option value="'.$deliverable['id'].'" style="padding-left: '.($level * 20).'px;">'.$deliverable['name'].'</option>';

            if (!empty($deliverable['children'])) {
                $output .= deliverableOptions($deliverable['children'], $level + 1);
            }
        }
    }
    return $output;
}

$options = deliverableOptions($vars['deliverables']);
?>
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
        <div class="resource-panel selected" id="main-panel">
            <h2>Add Resources</h2>
        </div>
    <?php
    if (!empty($resource_manager->resourcetypes)) {
        foreach ($resource_manager->resourcetypes as $resourcetype) {
    ?>
            <div class="resource-panel" id="panel-<?php echo $resourcetype->id; ?>">
                <input type="hidden" name="resourcetype" value="<?php echo $resourcetype->id; ?>" />
                <div class="form">
                <?php
                $panelSettings = $resourcetype->renderAddResourcesPanel();

                if (!empty($panelSettings['multibox']) && $panelSettings['multibox'] == true) {
                ?>
                    <div class="uncategorized-box">
                        <h3>Uncategorized:</h3>
                        <div class="chooser">
                            <p>Assign a deliverable to each resource before it can be added:</p>
                            <select name="deliverable">
                                <option></option>
                                <?php echo $options; ?>
                            </select>
                        
                            <button type="button" onclick="add_resources.addMultiple('<?php echo $resourcetype->id; ?>');">Add Selected Resources</button>
                        </div>
                    
                        <ul class="resource-grid"></ul>
                    </div>
                <?php
                }
                else {
                ?>
                    <label>Deliverable
                    <select name="deliverable">
                        <option></option>
                        <?php echo $options; ?>
                    </select>
                    </label>
                    
                    <div>
                        <button type="button" onclick="add_resources.addSingle('<?php echo $resourcetype->id; ?>'<?php if (!empty($panelSettings['validate'])) { echo ", '{$panelSettings['validate']}'"; } ?>);" class="pretty-button">Add Resource</button>
                    </div>
                <?php
                }
                ?>
                    <div class="ready-box">
                        <h3>Adding resources...</h3>
                        <ul class="resource-grid"></ul>
                    </div>
                    
                    <div class="added-box">
                        <h3>Successfully Added</h3>
                        <ul class="resource-grid"></ul>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>
        <div class="resource-panel" id="add-panel">
            <h2>Adding Resources...</h2>
            
            <ul class="resource-grid"></ul>
        </div>
    </div>
    
    <div class="footer">
        <button type="button" class="pretty-button close-button" onclick="add_resources.hide();">Close</button>
    </div>
</div>