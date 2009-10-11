<div class="summary-block">
    <a class="edit-link" href="#" onclick="$(this).parent().find('.edit-box').toggle(); return false;">edit project</a>

    <h3>project summary</h3>
    <p class="description"><?php echo $vars['project']['description']; ?></p>
    
    <h3>schedule</h3>
<?php
if (!empty($vars['project']['milestone_id'])) {
    echo '<p>This project is assigned to <strong>';
    echo '<a href="'.$this->getBaseURL().'/'.$vars['product']['url'].'/milestones/'.$vars['project']['milestone']['url'].'">';
    echo 'milestone '.$vars['project']['milestone']['name'].'</a></strong>';
    
    if (!empty($vars['project']['milestone']['dates'])) {
        echo ', which ';
        foreach ($vars['project']['milestone']['dates'] as $date) {
            if ($date['type'] == DateModel::TYPE_LAUNCH) {
                $time = strtotime($date['date']);
                if (time() > $time) {
                    echo 'hopefully launched on ';
                }
                else {
                    echo 'launches on ';
                }
                echo '<strong>'.date('l, F j', $time);
                if (date('Y') != date('Y', $time)) {
                    echo date(', Y', $time);
                }
                echo '</strong>';
            }
        }
    }
    
    echo '.</p>';
}
?>

<div class="edit-box">
    <h3>edit project</h3>
    <dl class="inline">
        <dt><label for="name">project name</label></dt>
        <dd><input type="text" id="name" value="<?php echo $vars['project']['name']; ?>"/></dd>

        <dt><label for="url">project URL</label></dt>
        <dd><input type="text" id="url" value="<?php echo $vars['project']['url']; ?>"/></dd>
    </dl>
    
    <dl class="inline">
        <dt><label for="milestone_id">milestone</label></dt>
        <dd><select id="milestone_id">
        <option value="">none assigned</option>
        <?php
        foreach ($vars['milestones'] as $milestone) {
            echo '<option value="'.$milestone['id'].'"'.($vars['project']['milestone_id'] == $milestone['id'] ? ' selected' : '').'>'.$milestone['name'].'</option>';
        }
        ?>
        </select></dd>
        
        <dt><label for="product_id">product</label></dt>
        <dd><select id="product_id">
        <?php
        foreach ($vars['products'] as $product) {
            echo '<option value="'.$product['id'].'"'.($vars['product']['id'] == $product['id'] ? ' selected' : '').'>'.$product['name'].'</option>';
        }
        ?>
        </select></dd>
    </dl>
    
    <dl>
        <dt><label for="description">project summary</label></dt>
        <dd><textarea id="description" cols="20" rows="3"><?php echo $vars['project']['description']; ?></textarea></dd>
    </dl>
    
    <p class="save">
        <button>save settings</button>
        <span>Saving...</span>
    </p>
</div>

</div>

<div class="deliverables">
<?php
        
function renderDeliverables($deliverables, $level = 0, &$template) {
    if (!empty($deliverables)) {
        foreach ($deliverables as $deliverable_id => $deliverable) {
            echo '<div class="deliverable level-'.$level.'" id="deliverable-'.$deliverable['id'].'">';
            echo '<h3>';
            echo '<a class="edit-link" href="#">edit deliverable</a>';
            $template->renderDeliverableStatus($deliverable['status']);
            echo $deliverable['name'].'</h3>';
            
            //strip_tags_attributes($string,'<strong><em><a>','href,rel');
            echo '<p class="description">'.$deliverable['description'].'</p>';
            
            $hasAttachments = !empty($deliverable['attachments']);
            $hasBugs = !empty($deliverable['bugs']);
            
            if ($hasAttachments || $hasBugs) {
                echo '<div class="goodies">';
                echo '<a class="toggle" href="#" onclick="$(this).parent().hide(); return false;">hide</a>';
                
                // Output any associated attachments
                if ($hasAttachments) {
                    echo '<h4>Attachments</h4>';
                    echo '<ul class="attachments">';
                    foreach ($deliverable['attachments'] as $attachment) {
                        echo '<li>';
                        echo '<a href="'.$template->getBaseURL().'/uploads/originals/'.$attachment['file'].'">';
                        echo '<img src="'.$template->getBaseURL().'/uploads/thumbnails/'.$attachment['file'].'"/>';
                        echo '<p class="caption">'.$attachment['name'].'</p>';
                        echo '</a></li>';
                    }
                    echo '</ul>';
                }
            
                // Output any associated bugs
                if ($hasBugs) {
                    echo '<h4>Bugs</h4>';
                    echo '<ul class="bugs">';
                    foreach ($deliverable['bugs'] as $bug) {
                        echo '<li>';
                        if ($bug['role'] == BugModel::ROLE_TRACKING) {
                            echo '<span>Tracking: </span>';
                        }
                        elseif ($bug['role'] == BugModel::ROLE_DESIGN) {
                            echo '<span>Design: </span>';
                        }
                        elseif ($bug['role'] == BugModel::ROLE_IMPLEMENTATION) {
                            echo '<span>Implementation: </span>';
                        }
                    
                        $template->linkBug($bug);
                        echo '</li>';
                    }
                    echo '</ul>';
                }
                
                echo '</div>';
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