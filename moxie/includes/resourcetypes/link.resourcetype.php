<?php

class link extends Resourcetype {
    
    public $fields = array(
        'link_name', 'link_url'
    );
    
    public $icon = 'link.png';
    
    public function renderAddResourcesPanel() {
    ?>
        <h2>Add Link</h2>

        <label>Name <input type="text" name="link_name" /></label><br />
        <label>URL <input type="text" name="link_url" /></label><br />
    <?php
    }
    
    /**
     * This method should RETURN (not render) the HTML for the resource's link
     * @return string
     */
    public function getLink($data, $type = 'summary') {
        $link = '<a href="'.$data['link_url'].'">'.$data['link_name'].'</a>';
        
        return $link;
    }
    
}

?>