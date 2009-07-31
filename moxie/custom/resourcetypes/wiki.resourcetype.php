<?php

class wiki extends Resourcetype {
    public $id = 'wiki';
    public $name = 'wiki';
    
    public $fields = array(
        'wiki_name', 'wiki_url', 'wiki_lastupdate'
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
        $link = '<a href="'.$data['wiki_url'].'" title="'.(!empty($data['wiki_lastupdate']) ? 'Last updated: '.date('M j, Y H:i', $data['wiki_lastupdate']) : '').'">'.$data['wiki_name'].'</a>';
        
        return $link;
    }
    
    /**
     * This method should return an array of updated data to save for the resource
     * @return array
     */
    public function refresh($id, $data) {
        $content = load_url($data['wiki_url']);
        
        // MediaWiki: <span id="f-lastmod"> This page was last modified on 26 July 2009, at 23:43.</span>
        if (preg_match('/lastmod.+?(\d{1,2} \w+? \d{4}).+?(\d{1,2}:\d{2})/', $content, $matches) >= 1) {
            $time = strtotime("{$matches[1]} {$matches[2]}");
        }
        // DekiWiki: <p class="pageLastchange">Page last modified <a title="11:22, 5 Sep 2008" href="/index.php?title=en/Toolkit_version_format&amp;action=history">11:22, 5 Sep 2008</a>...
        elseif (preg_match('/pageLastchange.+?title="(\d{1,2}:\d{2})\, (\d{1,2} \w+? \d{4})"/', $content, $matches) >= 1) {
            $time = strtotime("{$matches[2]} {$matches[1]}");
        }
        else {
            // No wiki format match
            return array();
        }
        
        $data['wiki_lastupdate'] = $time;
        
        return $data;
    }
    
}

?>