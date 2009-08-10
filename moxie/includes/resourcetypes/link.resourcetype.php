<?php

class link extends Resourcetype {
    public $id = 'link';
    public $name = 'link';
    
    public $fields = array(
        'link_name', 'link_url'
    );
    
    public $icon = 'link.png';
    
    /**
     * This method should RETURN (not render) the CSS used by the resource.
     * @return string
     */
    public function css(&$template) {
        if (PAGE != 'milestone') {
            return '';
        }
        
        $img = $template->image('resources/link.png');
        $css = <<<CSS


        
CSS;
        
        return $css;
    }
    
    /**
     * This method should RETURN (not render) the HTML for the resource's form
     * Do not use id="" in your tags, and prepend your resource id whenever possible.
     * @return string
     */
    public function form() {
        $form = <<<FORM

<h2>Add Link</h2>

<label>Name <input type="text" name="link_name" /></label><br />
<label>URL <input type="text" name="link_url" /></label><br />

FORM;
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