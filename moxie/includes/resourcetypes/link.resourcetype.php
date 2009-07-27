<?php

class link extends Resourcetype {
    public $id = 'link';
    public $name = 'link';
    
    public $fields = array(
        'link_name', 'link_url'
    );
    
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

.add-resource .content .type-selector ul li a.link {
    background-image: url({$img});
    background-position: 3px 50%;
    background-repeat: no-repeat;
    padding-left: 23px;
}
        
CSS;
        
        return $css;
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