<?php

class Bugtracking {
    /**
     * Retrieves bugs from an API query URL and updates the
     * database accordingly.
     */
    public function retrieveAndUpdateBugs($milestone_id, $url) {
        // Get bugs
        $bugs = $this->retrieveBugs($url);
        
        // Update bugs
        $bug_ids = $this->updateBugs($bugs);
        
        // Update associations
        $this->updateAssociations($bug_ids, $milestone_id);
    }
    
    /**
     * Retrieves bugs from a Bugzilla API URL and formats them in an
     * array
     */
    private function retrieveBugs($url) {
        $output = load_url($url);
        $json = json_decode($output, true);
        $bugs = array();
        
        foreach ($json['bugs'] as $bug) {
            $bugs[$bug['id']] = $bug;
        }
        
        return $bugs;
    }
    
    /**
     * This function compares the list of bugs to be updated with the bugs
     * currently in the database and determines which need to be updated
     * or inserted.
     */
    private function updateBugs($new_bugs) {
        list($Bug) = load_models('Bug');
        $bug_ids = array();
        
        // Get any existing bugs in the db that are in these results
        $_existing_bugs = $Bug->getAll('number IN ('.implode(',', array_keys($new_bugs)).')', 'id, number, lastupdated');
        $existing_bugs = array();
        if (!empty($_existing_bugs)) {
            foreach ($_existing_bugs as $existing_bug) {
                $existing_bugs[$existing_bug['number']] = array(
                    'id' => $existing_bug['id'],
                    'lastupdated' => $existing_bug['lastupdated']
                );
            }
        }
        
        // Figure out which bugs need to be added and updated
        foreach ($new_bugs as $bug_number => $bug) {
            // Check if bug is already in the db
            if (array_key_exists($bug_number, $existing_bugs)) {
                // Since it's already in the db, check if it has been updated
                if ($bug['last_change_time'] == $existing_bugs[$bug_number]['lastupdated']) {
                    // Bug is up to date in the db. Nothing to do
                    $bug_ids[] = $existing_bugs[$bug_number]['id'];
                }
                else {
                    // Bug needs to be updated
                    $data = $this->pullFieldsForDB($bug);
                    $Bug->update($existing_bugs[$bug_number]['id'], $data);
                    $bug_ids[] = $existing_bugs[$bug_number]['id'];
                }
            }
            else {
                // Bug isn't in the db yet. We should do something about that.
                $data = $this->pullFieldsForDB($bug);
                $Bug->insert($data);
                $bug_ids[] = $Bug->db->getLastID();
            }
        }
        
        return $bug_ids;
    }
    
    private function updateAssociations($bug_ids, $milestone_id) {
        $milestone_id = escape($milestone_id);
        
        list($Bug) = load_models('Bug');
        $Bug->db->execute("START TRANSACTION");
        
        // Delete existing associations
        $Bug->db->execute("DELETE FROM bugs WHERE milestone_id = {$milestone_id}");
        
        // Add new associations
        foreach ($bug_ids as $bug_id) {
            $Bug->db->execute("INSERT INTO bugs_milestones (milestone_id, bug_id) VALUES({$milestone_id}, {$bug_id})");
        }
        
        $Bug->db->execute("COMMIT");
    }
    
    /**
     * Returns an array of data to be put in the database from
     * the current bug object
     */
    private function pullFieldsForDB($bug) {
        if ($bug['status'] != 'RESOLVED' && $bug['status'] != 'VERIFIED') {
            $status = BugModel::STATUS_OPEN;
        }
        elseif ($bug['resolution'] == 'FIXED') {
            $status = BugModel::STATUS_FIXED;
        }
        else {
            $status = BugModel::STATUS_OTHER;
        }
        
        $data = array(
            'number' => $bug['id'],
            'assignee' => $bug['assigned_to']['name'],
            'priority' => $bug['priority'],
            'status' => $status,
            'product' => $bug['product'],
            'component' => $bug['component'],
            'summary' => $bug['summary'],
            'lastupdated' => $bug['last_change_time']
        );
        
        return $data;
    }
}

?>