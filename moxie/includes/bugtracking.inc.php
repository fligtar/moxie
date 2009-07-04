<?php

class Bugtracking {
    const TRACKER_BUGZILLA = 1;
    
    public $url;
    
    public function __construct($url) {
        $this->url = $url;
    }
    
    public function getBugInfo($bug_numbers) {
        // Make sure we have an array of bug numbers
        if (!is_array($bug_numbers)) {
            $bug_numbers = array($bug_numbers);
        }
        
        return $this->getBugs($bug_numbers);
    }
    
    public function getTrackerInfo($id) {
        switch ($id) {
            case Bugtracking::TRACKER_BUGZILLA:
                $info = array(
                    'name' => 'Bugzilla',
                    'shortname' => 'bugzilla',
                    'bug_term' => 'bug',
                    'bugs_term' => 'bugs',
                    'viewpage' => '/show_bug.cgi?id=%s'
                );
                break;
        }
        
        return $info;
    }
    
}

?>