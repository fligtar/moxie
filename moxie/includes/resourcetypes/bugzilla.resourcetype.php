<?php

class bugzilla extends Resourcetype {
    public $id = 'bugzilla';
    public $name = 'bugzilla';
    
    public $fields = array(
        'bz_number', 'bz_summary', 'bz_assignee', 'bz_fixed', 'bz_verified'
    );
    
    public function css(&$template) {
        if (PAGE != 'milestone') {
            return '';
        }

        $img = $template->image('resources/bug.png');
        $css = <<<CSS

.add-resource .content .type-selector ul li a.bugzilla {
    background-image: url({$img});
    background-position: 3px 50%;
    background-repeat: no-repeat;
    padding-left: 23px;
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
    bugLookup: function(button) {
        var form = $(button).parent();
        var query = form.find('.query').val();
        if (query == '') return;

        form.find('.loading').show();

        var url = 'ajax.php?action=resourcetype-custom&resourcetype=bugzilla&handler=lookup&bug_query=' + query;

        $.getJSON(url, function(data) {
            form.find('.loading').hide();

            $.each(data, function(i, bug) {
               form.find('.preview').append('<li><label><input type="checkbox" name="bug_id" value="' + bug.id + '" checked="checked" />' + bug.number + ' - ' + milestone.truncateSummary(bug.summary) + '</label></li>'); 
            });

            form.parent().find('.categories,.submit').show();
            form.find('.bug_number').val('');

        });
    },

    truncateSummary: function(summary) {
        if (summary.length > 50) {
            summary =  summary.substring(0, 50) + '...';
        }

        return summary;
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

<form>
    <label>Bug numbers<input type="text" name="query" class="query" /></label>
    <span class="loading">Loading...</span>
    <input type="submit" value="Look up" onclick="bugzilla.bugLookup(this); return false;" class="button"/>
    <ul class="preview"></ul>
</form>

FORM;
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
    
    public function lookup() {
        require INCLUDES.'/bugtracking.inc.php';
        
        list($Bug, $Bugtracker) = load_models('Bug', 'Bugtracker');
        
        $bug_numbers = explode(',', $_GET['bug_numbers']);
        $bugs = array();
        
        foreach ($bug_numbers as $bug_number) {
            // See if we already have information on the bug
            $bug = $Bug->getAll('number = \''.escape($bug_number).'\' AND bugtracker_id = '.escape($_GET['bugtracker_id']));
            
            if (!empty($bug)) {
                $bug = $bug[0];
            }
            else {
                // If we don't have it in the database, look it up in the tracker
                $bugtracker = $Bugtracker->get($_GET['bugtracker_id']);
        
                if (!empty($bugtracker)) {
                    $trackertype = Bugtracking::getTrackerInfo($bugtracker['type']);
                    
                    if (!class_exists($trackertype['shortname'])) {
                        require 'includes/bugtracking/'.$trackertype['shortname'].'.inc.php';
                    }
                    
                    $tracker = new $trackertype['shortname']($bugtracker['url']);
                    
                    $bug = $tracker->getBugInfo($bug_number);
                    
                    if (!empty($bug[$bug_number])) {
                        $bug = $bug[$bug_number];
                        $bug['bugtracker_id'] = $_GET['bugtracker_id'];
                        
                        // Add bug to db
                        $Bug->insert($bug);
                        $bug['id'] = $Bug->db->getLastID();
                    }
                }
            }
            
            $bugs[] = $bug;
        }
        
        $template = new Template();
        $template->render('json', array(
                'data' => $bugs
            ));
    }
    
}

?>