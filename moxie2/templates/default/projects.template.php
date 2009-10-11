<ul>
    <li>active projects</li>
    <li>archived projects</li>
</ul>

<button>create project</button>

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