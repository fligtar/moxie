<?php

class wiki extends Resourcetype {
    public $id = 'wiki';
    public $name = 'wiki';
    
    public $fields = array(
        'wiki_name', 'wiki_url'
    );
    
    /**
     * This method should RETURN (not render) the HTML for the resource's form
     * Do not use id="" in your tags, and prepend your resource id whenever possible.
     * @return string
     */
    public function form() {
        $form = '<label>Name<input type="text" name="wiki_name"/></label><br />';
        $form .= '<label>URL<input type="text" name="wiki_url" /></label>';
        
        return $form;
    }
    
    /**
     * This method should RETURN (not render) the HTML for the resource's link
     * @return string
     */
    public function buildLink($data) {
        $link = '<a href="'.$data['wiki_url'].'">'.$data['wiki_name'].'</a>';
        
        return $link;
    }
    
}

?>