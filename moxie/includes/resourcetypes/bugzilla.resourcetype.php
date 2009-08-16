<?php

class bugzilla extends Resourcetype {
    public $id = 'bugzilla';
    public $name = 'bugzilla';
    
    public $fields = array(
        'bz_number', 'bz_summary', 'bz_assignee', 'bz_fixed', 'bz_verified'
    );
    
    public $bugzilla_url = 'https://bugzilla.mozilla.org';
    
    public $icon = 'bug.png';
    
    public function css(&$template) {
        if (PAGE != 'milestone') {
            return '';
        }

        $img = $template->image('resources/bug.png');
        $css = <<<CSS

#panel-bugzilla .form .bug-lookup {
    text-align: center;
}
#panel-bugzilla .form .bug-lookup input {
    font-size: 1.3em;
    width: 80%;
    margin: 10px;
}
#panel-bugzilla .form .bug-lookup .pretty-button {
    background-color: #FFFFFF;
}

CSS;

        return $css;
    }
        
    
    public function js(&$template) {
        if (PAGE != 'milestone') {
            return '';
        }

        $js = <<<JS

var bugzilla = {
    lookup: function() {
        var form = $('#add-resources #panel-bugzilla .form');
        var query = form.find('.bug-lookup input').val();
        if (query == '') return;

        form.find('button').addClass('loading').text('Retrieving Bugs...').blur();
        form.find('.bug-lookup input, .bug-lookup button').attr('disabled', 'disabled');

        var url = 'ajax.php?action=resourcetype-custom&resourcetype=bugzilla&handler=lookup&query=' + query;

        $.getJSON(url, function(data) {
            form.find('button').removeClass('loading').text('Retrieve Bugs');
            form.find('.bug-lookup input, .bug-lookup button').attr('disabled', '');
            
            $.each(data, function(i, bug) {
                add_resources.addUncategorizedResource('bugzilla', 'bug ' + bug.bz_number, bug.bz_summary, 'temp_id=' + bug.temp_id);
            });

            form.find('.bug-lookup input').val('');
        });
    }
};

JS;

        return $js;
    }
    
    /**
     * This method should RETURN (not render) the HTML for the resource's form
     * Do not use id="" in your tags, and prepend your resource id whenever possible.
     * @return string
     */
    public function form() {
        $form = <<<FORM

<h2>Add Bug Resources</h2>

<div class="bug-lookup">
    <p>Enter one or more bug numbers, bug URLs, or a search results URL.</p>
    <input type="text" name="q" value="506751"/><br />
    <button type="button" class="pretty-button" onclick="bugzilla.lookup();">Retrieve Bugs</button>
</div>

FORM;
        return $form;
    }
    
    /**
     * This method should RETURN (not render) the HTML for the resource's link
     * @return string
     */
    public function buildLink($data) {
        $link = '<a href="'.addslashes($this->bugzilla_url.'/show_bug.cgi?id='.$data['bz_number']).'" title="'.addslashes($data['bz_assignee'].' - '.$data['bz_summary']).'">bug '.$data['bz_number'].'</a>';
        
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
    
    public function getFieldsToSave($data) {
        list($Temp) = load_models('Temp');
        
        $fields = $Temp->retrieveAndDestroyTempEntry($data['temp_id']);
        
        return $fields;
    }
    
    public function lookup($data) {
        require_once dirname(__FILE__).'/bugzilla/bugzilla.inc.php';
        
        $lib = new bugzilla_library($this->bugzilla_url);
        
        list($Temp) = load_models('Temp');
        
        $q = $data['query'];
        
        // Determine what kind of input we have
        
        if (strpos($q, 'http') !== false && strpos($q, 'buglist') !== false) {
            // If it's a URL and is a buglist, get the bugs from it
            $bug_numbers = $lib->getBugsFromSearch($q);
        }
        elseif (preg_match_all('/\d+/', $q, $matches) >= 1) {
            // Otherwise, get the bug numbers directly from the query
            // Hopefully this is one or more bug numbers, or a bug's url
            $bug_numbers = $matches[0];
        }
        
        if (empty($bug_numbers)) {
            // Error
        }
        
        $bugs = $lib->getBugs($bug_numbers);
        
        if (!empty($bugs)) {
            foreach ($bugs as $k => $bug) {
                $temp_id = $Temp->createTempEntry($bug);
                $bugs[$k]['temp_id'] = $temp_id;
                //$bugs[$k]['link'] = $this->buildLink($bug);
            }
        }
        
        $template = new Template();
        $template->render('json', array(
                'data' => $bugs
            ));
    }
    
}

?>