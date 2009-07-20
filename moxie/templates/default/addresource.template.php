<div class="add-resource">
    <div class="content">
        <div class="close">
            <a href="#" onclick="milestone.hideAddPanel(this); return false;">Close</a>
        </div>
        
        <div class="type-selector">
            <ul>
            <?php
            if (!empty($vars['bugtrackers'])) {
                foreach ($vars['bugtrackers'] as $bugtracker_id => $bugtracker) {
                    echo '<li><a class="bugtracker" href="#" onclick="milestone.showForm(this, \'bugtracker\', '.$bugtracker_id.'); return false;">'.$bugtracker['nickname'].' '. $bugtracker['tracker_info']['bug_term'].'</a></li>';
                }
            }
            ?>
                <li><a class="link" href="#" onclick="milestone.showForm(this, 'link'); return false;">link</a></li>
            </ul>
        </div>
        
        <div class="type-form">
            <div class="form bugtracker"><form>
                <label>Bug numbers<input type="text" name="bug_number" class="bug_number" /></label>
                <input type="hidden" name="bugtracker_id" class="bugtracker_id" value="" />
                <span class="loading">Loading...</span>
                <input type="submit" value="Look up" onclick="milestone.bugLookup(this); return false;" class="button"/>
                <ul class="preview"></ul>
            </form></div>
            
            <div class="form link">
                <label>Name<input type="text" name="name" class="name" /></label><br />
                <label>URL<input type="text" name="url" class="url" /></label>
            </div>
            
            <div class="categories">
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
            
            <div class="submit">
                <input type="button" value="Add to Deliverable" onclick="milestone.addResources(this);"/>
            </div>
        </div>
    </div>
</div>