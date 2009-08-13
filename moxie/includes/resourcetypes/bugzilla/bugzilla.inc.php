<?php

class bugzilla_library {
    private $url = '';
    
    /**
     * Set the URL of the bugzilla instance
     */
    public function __construct($url) {
        $this->url = $url;
    }
    
    /**
     * Breaks the bugs into groups of 200 and fetches their details
     */
    public function getBugs($bug_numbers) {
        $bugs = array();
        
        // More than 200 bugs at a time is not good for Bugzilla's health
        for ($i = 0; $i < count($bug_numbers); $i += 200) {
            $segment = array_slice($bug_numbers, $i, 200);
            $xml = $this->getXML($segment);
            $_bugs = $this->parseXML($xml);
            
            // array_merge messes up the keys
            foreach ($_bugs as $key => $value) {
                $bugs[$key] = $value;
            }
        }
        
        return $bugs;
    }
    
    /**
     * Parses out the bug numbers of the search results
     */
    public function getBugsFromSearch($search_url) {
        $results = load_url($search_url);
        
        $start = strpos($results, '<input type="hidden" name="ctype" value="xml">');
        $results = substr($results, $start, strlen($results) - $start);

        preg_match_all('<input type="hidden" name="id" value="(\d+?)">', $results, $matches);
        
        return $matches[1];
    }
    
    /**
     * Gets the bug XML for each specified bug
     */
    private function getXML($bug_numbers) {
        $xml = load_url($this->url.'/show_bug.cgi', 'ctype=xml&id='.implode($bug_numbers, '&id=').$this->getExcludedFields());
        
        return $xml;
    }
    
    /**
     * Parses the bug XML to get the details we want
     */
    private function parseXML($xml) {
        $data = simplexml_load_string($xml);
        
        if (empty($data->bug)) return;
        $bugs = array();
        
        foreach ($data->bug as $bug) {
            $id = (string) $bug->bug_id;
            
            $bugs[$id] = array(
                'bz_number' => $id,
                'bz_summary' => (string) $bug->short_desc,
                'bz_assignee' => (string) $bug->assigned_to,
                'bz_fixed' => (string) $bug->resolution == 'FIXED' ? 1 : 0,
                'bz_verified' => (string) $bug->bug_status == 'VERIFIED' ? 1 : 0
            );
        }
        
        return $bugs;
    }
    
    /**
     * Get the unneeded fields string for the XML request
     */
    private function getExcludedFields() {
        $fields = array(
            'attachmentdata',
            'creation_ts',
            'delta_ts',
            'reporter_accessible',
            'cclist_accessible',
            'classification_id',
            'product',
            'component',
            'version',
            'rep_platform',
            'op_sys',
            'priority',
            'bug_severity',
            'target_milestone',
            'everconfirmed',
            'cc',
            'qa_contact',
            'cf_blocking_fennec',
            'token',
            'long_desc',
            'attachment',
            'alias',
            'classification'
        );
        
        return '&excludefield='.implode('&excludefield=', $fields);
    }
    
}

?>