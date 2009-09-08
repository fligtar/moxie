<?php

class image extends Resourcetype {
    
    public $fields = array(
        'image_name', 'image_url'
    );
    
    public $icon = 'image.png';
    
    public function css() {
        if (PAGE == 'milestone') {
    ?>
        .resources .image img {
            max-width: 100px;
            max-height: 100px;
        }
    <?php
        }
    }
    
    public function renderAddResourcesPanel() {
    ?>
        <h2>Add Image</h2>
        <p>Add an image</p>
        <label>Name <input type="text" name="image_name" class="field resource-title"/></label><br />
        <label>URL <input type="text" name="image_url" class="field resource-description"/></label><br />
    <?php
    }
    
    /**
     * This method should RETURN (not render) the HTML for the resource's link
     * @return string
     */
    public function getLink($data, $type = 'summary') {
        $link = '<a href="'.$data['image_url'].'"><img src="'.$data['image_url'].'" alt="'.$data['image_name'].'" /></a>';
        
        return $link;
    }
    
}

?>