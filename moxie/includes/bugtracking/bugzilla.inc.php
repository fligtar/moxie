<?php

class bugzilla extends Bugtracking {
    
    protected function getBugs($bug_numbers) {
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
    
    private function getXML($bug_numbers) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url."/show_bug.cgi");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"ctype=xml&id=".implode($bug_numbers, "&id=").$this->getExcludedFields());

        $xml = curl_exec($ch);

        curl_close($ch);
        
        return $xml;
    }
    
    private function parseXML($xml) {
        $data = simplexml_load_string($xml);
        
        if (empty($data->bug)) return;
        $bugs = array();
        
        foreach ($data->bug as $bug) {
            $id = (string) $bug->bug_id;
            
            $bugs[$id] = array(
                'number' => $id,
                'summary' => (string) $bug->short_desc,
                'assignee' => (string) $bug->assigned_to,
                'fixed' => (string) $bug->resolution == 'FIXED' ? 1 : 0,
                'verified' => (string) $bug->bug_status == 'VERIFIED' ? 1 : 0
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