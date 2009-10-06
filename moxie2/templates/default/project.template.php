<?php
if (!empty($vars['project']['milestone_id'])) {
    echo '<p class="hello-notice">';
    echo 'This project is assigned to <strong>';
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

<div class="deliverables">
<?php
        
function renderDeliverables($deliverables, $level = 0, &$template) {
    if (!empty($deliverables)) {
        foreach ($deliverables as $deliverable_id => $deliverable) {
            echo '<div class="deliverable level-'.$level.'" id="deliverable-'.$deliverable['id'].'">';
            echo '<h3>';
            $template->renderDeliverableStatus($deliverable);
            echo $deliverable['name'].'</h3>';
            
            //strip_tags_attributes($string,'<strong><em><a>','href,rel');
            echo '<p class="description">'.$deliverable['description'].'</p>';
            
            $hasAttachments = !empty($deliverable['attachments']);
            $hasBugs = !empty($deliverable['bugs']);
            
            if ($hasAttachments || $hasBugs) {
                echo '<div class="goodies">';
                echo '<a class="toggle" href="#" onclick="return flase;">hide</a>';
                
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