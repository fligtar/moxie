<?php
function renderDeliverables($deliverables, $level = 0, &$template) {
    if (!empty($deliverables)) {
        foreach ($deliverables as $deliverable_id => $deliverable) {
            echo '<div class="deliverable level-'.$level.'" id="deliverable-'.$deliverable['id'].'">';
            echo '<h5>';
            $template->renderDeliverableStatus($deliverable['status']);
            echo $deliverable['name'].'</h5>';
            
            // Render any sub-deliverables
            if (!empty($deliverable['children'])) {
                renderDeliverables($deliverable['children'], $level + 1, $template);
            }
            
            echo '</div>';
        }
    }
}

if (!empty($vars['projects'])) {
    echo '<h3>Projects</h3>';
    foreach ($vars['projects'] as $project) {
        echo '<h4><a href="'.$this->getBaseURL().'/'.$vars['product']['url'].'/projects/'.$project['url'].'">'.$project['name'].'</a></h4>';
        echo '<div class="deliverables">';
        renderDeliverables($project['deliverables'], 0, $this);
        echo '</div>';
    }
}

if (!empty($vars['bugs'])) {
    echo '<h3>Bugs</h3>';
    ?>
    <div class="bug-filters">
        <div>
            <span>group bugs by:</span>
            <ul>
                <li><a href="#" onclick="return false;">assignee</a></li>
                <li><a href="#" onclick="return false;" class="selected">component</a></li>
                <li><a href="#" onclick="return false;">status</a></li>
                <li><a href="#" onclick="return false;">priority</a></li>
            </ul>
        </div>
        <div>
            <span>sort groups by:</span>
            <ul>
                <li><a href="#" onclick="return false;">name</a></li>
                <li><a href="#" onclick="return false;" class="selected">total bugs</a></li>
                <li><a href="#" onclick="return false;">open bugs</a></li>
                <li><a href="#" onclick="return false;">fixed bugs</a></li>
            </ul>
        </div>
        <div>
            <span>sort bugs by:</span>
            <ul>
                <li><a href="#" onclick="return false;" class="selected">assignee</a></li>
                <li><a href="#" onclick="return false;">component</a></li>
                <li><a href="#" onclick="return false;">status</a></li>
                <li><a href="#" onclick="return false;">priority</a></li>
                <li><a href="#" onclick="return false;">id</a></li>
            </ul>
        </div>
    </div>
    <?php
    $i = 1;
    echo '<ul class="bug-groups">';
    foreach ($vars['bugs'] as $group => $data) {
        echo '<li><h4>'.$group.' &mdash; <a href="#" onclick="$(\'#bug-group-'.$i.'\').toggle(); return false;">'.$data['status-'.BugModel::STATUS_OPEN].' open, '.$data['status-'.BugModel::STATUS_FIXED].' fixed</a></h4></li>';
        
        echo '<ul id="bug-group-'.$i.'" class="bugs">';
        foreach ($data['bugs'] as $bug) {
            echo '<li>'.$this->linkBug($bug).'</li>';
        }
        echo '</ul>';
        $i++;
    }
    echo '</ul>';
}

?>