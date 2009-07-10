<div class="add-resource">
    <div class="content">
        <div class="type-selector">
            <ul>
            <?php
            if (!empty($vars['bugtrackers'])) {
                foreach ($vars['bugtrackers'] as $bugtracker_id => $bugtracker) {
                    echo '<li><a class="bugtracker selected" href="#" onclick="milestone.showForm(this, \'bugtracker\', '.$bugtracker_id.'); return false;">'.$bugtracker['nickname'].' '. $bugtracker['tracker_info']['bug_term'].'</a></li>';
                }
            }
            ?>
                <li><a class="link" href="#" onclick="milestone.showForm(this, 'link'); return false;">link</a></li>
            </ul>
        </div>
        
        <div class="type-form">
            <div class="form bugtracker">
                <label>Bug number</label><input type="text" name="bug_number" class="bug_number" />
                <input type="hidden" name="bugtracker_id" class="bugtracker_id" value="" />
                <span class="loading">Loading...</span>
                <input type="button" value="Lookup" onclick="milestone.bugLookup(this);" class="button"/>
            </div>
            
            <div class="form link">
                <label>Link</label><input type="text" id="link" />
            </div>
            
            <div>
                <label>Categories:</label>
                <ul>
                <?php
                if (!empty($vars['categories'])) {
                    foreach ($vars['categories'] as $category) {
                        echo '<li><a class="category '.strtolower($category['name']).'" href="#" onclick="milestone.selectCategory(this); return false;">'.$category['name'].'</a></li>';
                    }
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>