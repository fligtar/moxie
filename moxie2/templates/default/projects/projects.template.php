<div>
    <a href="#" class="button right">create project</a>
    <div class="filters">
        <span>show:</span>
        <ul>
            <li><a href="#" onclick="return false;">active projects</a></li>
            <li class="separator">/</li>
            <li><a href="#" onclick="return false;" class="selected">archived projects</a></li>
        </ul>
    </div>
</div>

<div class="projects">
<?php if (!empty($vars['projects'])): ?>
    <dl>
    <?php
    foreach ($vars['projects'] as $project) {
        echo '<dt><a href="'.$this->getBaseURL().'/'.$vars['product']['url'].'/projects/'.$project['url'].'">'.$project['name'].'</a></dt>';
        echo '<dd>'.$project['description'].'</dd>';
    }
    ?>
    </dl>
<?php else: ?>
    <p>No projects found. <a href="#">Create one!</a></p>
<?php endif; ?>
</div>