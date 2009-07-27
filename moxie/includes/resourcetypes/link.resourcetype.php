<?php

class link extends Resourcetype {
    public $id = 'link';
    public $name = 'link';
    
    public $icon = 'link.png';
    
    public $fields = array(
        'link_name', 'link_url'
    );
    
    /**
     * This method should RETURN (not render) any JavaScript used by this resource's form
     * @return string
     */
    public function js() {
        
    }
    
    /**
     * This method should RETURN (not render) the HTML for the resource's form
     * Do not use id="" in your tags, and prepend your resource id whenever possible.
     * @return string
     */
    public function form() {
        $form = '<label>Name<input type="text" name="link_name"/></label><br />';
        $form .= '<label>URL<input type="text" name="link_url" /></label>';
        
        return $form;
    }
    
    /**
     * This method should RETURN (not render) the HTML for the resource's link
     * @return string
     */
    public function buildLink($data) {
        $link = '<a href="'.$data['link_url'].'">'.$data['link_name'].'</a>';
        
        return $link;
    }
    
}

?>