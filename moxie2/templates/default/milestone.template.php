<?php if (!empty($vars['projects'])): ?>

    <h3>Projects</h3>
    <?php foreach ($vars['projects'] as $project): ?>
        <h4><a href="<?php echo $this->getBaseURL().'/'.$vars['product']['url'].'/projects/'.$project['url']; ?>"><?php echo $project['name']; ?></a></h4>
    <?php endforeach; ?>

<?php endif; ?>

<?php if (!empty($vars['bugs'])): ?>

    <h3>Bugs</h3>
    <ul class="bugs">
    <?php foreach ($vars['bugs'] as $bug): ?>
        <li><?php echo $this->linkBug($bug); ?></li>
    <?php endforeach; ?>
    </ul>
    
<?php endif; ?>