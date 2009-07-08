<div class="add-resource">
    <div class="content">
        <div class="type-selector">
            <ul>
            <?php
            if (!empty($vars['bugtrackers'])) {
                foreach ($vars['bugtrackers'] as $bugtracker_id => $bugtracker) {
                    echo '<li><a class="bugtracker selected">'.$bugtracker['nickname'].' '. $bugtracker['tracker_info']['bug_term'].'</a></li>';
                }
            }
            ?>
                <li><a class="link">link</a></li>
            </ul>
        </div>
        
        <div class="type-form">
            <div>
                <label>Bug number</label><input type="text" id="bugnumber" />
                <span class="loading">Loading...</span>
            </div>
            
            <div>
            
            </div>
            
            <div>
                <label>Categories:</label>
                <ul>
                <?php
                if (!empty($vars['categories'])) {
                    foreach ($vars['categories'] as $category) {
                        echo '<li><a class="category '.strtolower($category['name']).'" href="#">'.$category['name'].'</a></li>';
                    }
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>