<?php

/**
 * Cruncher!
 * Crunches data into digestible nuggets
 */
class Cruncher {
    public $data;
    
    /**
     * Starts the crunch
     */
    public function crunch($xml, $unassigned = '') {
        $this->initializeData();

        // The unassigned account must always exist
        if (!empty($unassigned)) {
            $this->createUser($unassigned);
        }
        
        foreach ($xml as $xmlSegment) {
            // Parse each XML result
            $bugs = simplexml_load_string($xmlSegment);
            $this->analyzeBugs($bugs);
        }
        
        return $this->data;
    }
    
    /**
     * Initializes the data array
     */
    private function initializeData() {
        $this->data = array(
            'users' => array(),
            
            'bugsAll' => array(),
            'bugsOpen' => array(),
            'bugsFixed' => array(),
            'bugsOpenAwaitingReview' => array(),
            'bugsOpenReviewedPlus' => array(),
            'bugsOtherResolved' => array()
        );
    }
    
    /**
     * Records a bug in both the total and assignee count
     */
    private function recordBug($stat, $bug_id, $assignee, $assignee_name = '') {
        $this->data[$stat][] = $bug_id;
        
        // Create user if doesn't exist
        if (empty($this->data['users'][$assignee])) {
            $this->createUser($assignee, $assignee_name);
        }
        elseif (!empty($assignee_name) && $this->data['users'][$assignee]['name'] == $assignee) {
            // If user's name wasn't known at creation but is now, update it
            $this->data['users'][$assignee]['name'] = $assignee_name;
        }
        
        $this->data['users'][$assignee]['assignedBugs'][$stat][] = $bug_id;
    }
    
    /**
     * Record a review request
     */
    private function recordReviewRequest($bug_id, $requestee) {
        if (empty($requestee)) return;
        
        if (empty($this->data['users'][$requestee])) {
            $this->createUser($requestee);
        }
        
        $this->data['users'][$requestee]['otherBugs']['reviewRequests'][] = $bug_id;
    }
    
    /**
     * Create a user in the data array with initialized counts
     */
    public function createUser($email, $name = '') {
        if (!empty($name)) {
            $name = preg_replace('/\s?[\[\(].+[\]\)]/', '', $name);
            $name = preg_replace('/\s?:.+/', '', $name);
        }
        else {
            $name = $email;
        }
        
        $this->data['users'][$email] = array(
            'name' => $name,
            'email' => $email,
            'id' => str_replace(array('@', '.', '+'), '', $email),
            
            'assignedBugs' => array(
                'bugsAll' => array(),
                'bugsOpen' => array(),
                'bugsFixed' => array(),
                'bugsOpenAwaitingReview' => array(),
                'bugsOpenReviewedPlus' => array(),
                'bugsOtherResolved' => array()
            ),
            
            'otherBugs' => array(
                'reviewRequests' => array()
            )
        );
    }
    
    /**
     * Analyzes the bugs and records them appropriately
     */
    private function analyzeBugs($bugs) {
        if (empty($bugs->bug)) return;
        
        foreach ($bugs->bug as $bug) {
            $assignee = (string) $bug->assigned_to;
            $id = (string) $bug->bug_id;
            
            // Record bug's existence
            $this->recordBug('bugsAll', $id, $assignee, (string) $bug->assigned_to->attributes()->name);
            
            if (!empty($bug->resolution)) {
                // Record bug's resolution
                if ($bug->resolution == 'FIXED') {
                    $this->recordBug('bugsFixed', $id, $assignee);
                }
                else {
                    $this->recordBug('bugsOtherResolved', $id, $assignee);
                }
            }
            else {
                // Record open bug
                $this->recordBug('bugsOpen', $id, $assignee);
                
                // Record any patches
                if (isset($bug->attachment)) {
                    /**
                     * As far as I can tell there is no way to check if the atachment object
                     * is an array short of doing this. is_array() returns false, so wtf.
                     */
                    $attachments = !isset($bug->attachment[1]) ? array($bug->attachment) : $bug->attachment;
                    
                    foreach ($attachments as $attachment) {
                        if ($attachment->attributes()->ispatch == 1 && isset($attachment->flag)) {
                            if ($attachment->flag->attributes()->status == '?') {
                                $this->recordBug('bugsOpenAwaitingReview', $id, $assignee);
                                $this->recordReviewRequest($id, (string) $attachment->flag->attributes()->requestee);
                            }
                            elseif ($attachment->flag->attributes()->status == '+') {
                                $this->recordBug('bugsOpenReviewedPlus', $id, $assignee);
                            }
                        }
                    }
                }
            }
        }
    }
}

?>