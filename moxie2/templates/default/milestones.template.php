<div>
    <a href="#" class="button right">create milestones</a>
    <div class="filters">
        <span>show:</span>
        <ul>
            <li><a href="#" onclick="return false;">active milestone</a></li>
            <li class="separator">/</li>
            <li><a href="#" onclick="return false;" class="selected">archived milestones</a></li>
        </ul>
    </div>
</div>

<div class="milestones">
<?php if (!empty($vars['milestones'])): ?>
    <dl>
    <?php
    foreach ($vars['milestones'] as $milestone) {
        echo '<dt><a href="'.$this->getBaseURL().'/'.$vars['product']['url'].'/milestones/'.$milestone['url'].'">'.$milestone['name'].'</a></dt>';
        echo '<dd>'.'</dd>';
    }
    ?>
    </dl>
<?php else: ?>
    <p>No milestones found. <a href="#">Create one!</a></p>
<?php endif; ?>
</div>