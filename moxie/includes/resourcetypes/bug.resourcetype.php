<?php

class Bug extends Resource {
    public $id = 'bug@moxie';
    public $name = 'bug';
    
    public $icon = '';
    
    public function js() {
        
    }
    
    public function form() {
        
    }
    
    public function onSubmit($parameters) {
        
    }
    
}

?>


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
                        echo '<li><a class="bugtracker bugtracker-<?=$bugtracker_id?>" href="#" onclick="milestone.showForm(this); return false;">'.$bugtracker['nickname'].' '. $bugtracker['tracker_info']['bug_term'].'</a></li>';
                    }
                }
                ?>
                    <li><a class="link" href="#" onclick="milestone.showForm(this, 'link'); return false;">link</a></li>
                </ul>
            </div>

            <?php
            if (!empty($vars['bugtrackers'])) {
                foreach ($vars['bugtrackers'] as $bugtracker_id => $bugtracker) {
            ?>
                    <div class="type-form bugtracker bugtracker-<?=$bugtracker_id?>">
                        <div class="form">
                            <form>
                                <label><?=ucwords($bugtracker['tracker_info']['bug_term'])?> numbers<input type="text" name="bug_number" class="bug_number" /></label>
                                <input type="hidden" name="bugtracker_id" class="bugtracker_id" value="<?=$bugtracker_id?>" />
                                <span class="loading">Loading...</span>
                                <input type="submit" value="Look up" onclick="milestone.bugLookup(this); return false;" class="button"/>
                                <ul class="preview"></ul>
                            </form>
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
            <?php
                }
            }
            ?>

            <!--<div class="type-form link">
                <label>Name<input type="text" name="name" class="name" /></label><br />
                <label>URL<input type="text" name="url" class="url" /></label>
            </div>-->
        </div>
    </div>