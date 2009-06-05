<?php

/**
 * Fetcher!
 * Fetches data from the server
 */
class Fetcher {
    
    /**
     * Fetches all XML results for a Bugzilla query URL
     */
    public function fetch($queryURL) {
        // Get the HTML of the search results page
        $searchResults = $this->fetchBugs($queryURL);
        
        // Parse out the bug numbers of the results
        $bugs = $this->parseBugs($searchResults);
        
        // Get the XML for the bugs
        $xml = $this->fetchXML($bugs);
        
        return $xml;
    }
    
    /**
     * Grabs the HTML of the search results page
     */
    private function fetchBugs($queryURL) {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $queryURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $output = curl_exec($ch);
        
        curl_close($ch);
        
        return $output;
    }
    
    /**
     * Parses out the bug numbers of the search results
     */
    private function parseBugs($results) {
        $start = strpos($results, '<input type="hidden" name="ctype" value="xml">');
        $results = substr($results, $start, strlen($results) - $start);

        preg_match_all('<input type="hidden" name="id" value="(\d+?)">', $results, $matches);
        
        return $matches[1];
    }
    
    /**
     * Breaks the bugs into groups of 200 and fetches the XML
     */
    private function fetchXML($bugs) {
        $xml = array();
        
        // More than 200 bugs at a time is not good for Bugzilla's health
        for ($i = 0; $i < count($bugs); $i += 200) {
            $segment = array_slice($bugs, $i, 200);
            $xml[] = $this->xmlRequest($segment);
        }
        
        return $xml;
    }
    
    /**
     * Retrieves the XML for a set of bugs
     */
    private function xmlRequest($bugs) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://bugzilla.mozilla.org/show_bug.cgi");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"ctype=xml&id=".implode($bugs, "&id=").$this->getExcludedFields());

        $xml = curl_exec($ch);

        curl_close($ch);
        
        return $xml;
    }
    
    /**
     * Get the unneeded fields string for the XML request
     */
    private function getExcludedFields() {
        $fields = array(
            'attachmentdata',
            'creation_ts',
            'delta_ts',
            'short_desc',
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
            'long_desc'
        );
        
        return '&excludefield='.implode('&excludefield=', $fields);
    }

}

?>
