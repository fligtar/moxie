<?php

class wiki extends Resourcetype {
    public $id = 'wiki';
    public $name = 'wiki';
    
    public $icon = 'link.png';
    
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
     * This method should return an array of data to save for the resource.
     * @return array
     */
    public function onSubmit($parameters) {
        $data = array(
            'link_name' => $parameters['link_name'],
            'link_url' => $parameters['link_url']
        );
        
        return $data;
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