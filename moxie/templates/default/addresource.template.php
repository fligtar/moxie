<div class="addresource">
    <div class="type-selector">
        <p>Add resource:</p>
        <ul>
        <?php
        if (!empty($vars['bugtrackers'])) {
            foreach ($vars['bugtrackers'] as $bugtracker_id => $bugtracker) {
                echo '<li class="bugtracker">'.$bugtracker['nickname'].'</li>';
            }
        }
        ?>
            <li class="link">link</li>
        </ul>
    </div>
    
    <div>
        <label>bug number</label><input type="text" />
        
        <p>Categories:</p>
        <ul>
        <?php
        if (!empty($vars['categories'])) {
            foreach ($vars['categories'] as $category) {
                echo '<li><span class="category '.strtolower($category['name']).' unselected">'.$category['name'].'</span></li>';
            }
        }
        ?>
        </ul>
    </div>
</div>