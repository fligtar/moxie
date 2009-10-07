<?php

class BugModel extends Model {
    public $table = 'bugs';
    
    const STATUS_OPEN = 1;
    const STATUS_FIXED = 2;
    const STATUS_OTHER = 3;
    
    const ROLE_TRACKING = 1;
    const ROLE_DESIGN = 2;
    const ROLE_IMPLEMENTATION = 3;
    const ROLE_OTHER = 4;
    
    /**
     * Gets all bugs in a given milestone
     */
    public function getBugsForMilestone($milestone_id) {
        $_bugs = $this->db->query("SELECT bugs.* FROM bugs INNER JOIN bugs_milestones ON bugs_milestones.bug_id = bugs.id WHERE bugs_milestones.milestone_id = ".escape($milestone_id));
        $bugs = $this->db->query("
            SELECT
                bugs.*, IFNULL(users.name, bugs.assignee) as name
            FROM bugs 
            INNER JOIN bugs_milestones ON bugs_milestones.bug_id = bugs.id
            LEFT JOIN users ON bugs.assignee = users.buguser
            WHERE
                bugs_milestones.milestone_id = ".escape($milestone_id)."
        ");
        
        return $bugs;
    }
    
    /**
     * Pulls bugs for the given deliverables and adds them to the array
     */
    public function addBugsToDeliverables(&$deliverables) {
        $bugs = $this->db->query("
            SELECT
                bugs.*, bugs_deliverables.*, IFNULL(users.name, bugs.assignee) as name
            FROM bugs 
            INNER JOIN bugs_deliverables ON bugs_deliverables.bug_id = bugs.id
            LEFT JOIN users ON bugs.assignee = users.buguser
            WHERE
                bugs_deliverables.deliverable_id IN (".implode(',', array_keys($deliverables)).")
        ");
        
        if (!empty($bugs)) {
            foreach ($bugs as $bug) {
                if (empty($deliverables[$bug['deliverable_id']])) {
                    $deliverables[$bug['deliverable_id']]['bugs'] = array();
                }
                $deliverables[$bug['deliverable_id']]['bugs'][] = $bug;
            }
        }
    }
    
    /**
     * Groups an array of bugs by the given field
     */
    public function groupBugs(&$bugs, $group, $sort, $group_sort) {
        $groups = array();
        
        if (!empty($bugs)) {
            // Sort bugs
            usort($bugs, create_function('$a,$b', 'return strcmp($a["'.$sort.'"], $b["'.$sort.'"]);'));
        
            // Group bugs
            foreach ($bugs as $bug) {
                if (!array_key_exists($bug[$group], $groups)) {
                    $groups[$bug[$group]] = array(
                        'bugs' => array(),
                        'total' => 0,
                        'status-'.BugModel::STATUS_OPEN => 0,
                        'status-'.BugModel::STATUS_FIXED => 0,
                        'status-'.BugModel::STATUS_OTHER => 0
                    );
                }
                
                $groups[$bug[$group]]['bugs'][] = $bug;
            }
            
            // Count bugs
            foreach ($groups as $group => $data) {
                $groups[$group]['total'] = count($data['bugs']);
                
                foreach ($data['bugs'] as $bug) {
                    $groups[$group]['status-'.$bug['status']]++;
                }
            }
            
            // Sort groups
            if ($group_sort == 'name') {
                ksort($groups);
            }
            elseif ($group_sort == 'totalbugs') {
                // Sort by total bug count backwards
                uasort($groups, create_function('$a,$b', 'return $a["total"] == $b["total"] ? 0 : ($a["total"] > $b["total"] ? -1 : 1);'));
            }
            elseif ($group_sort == 'openfixed') {
                // Sort by open bug count backwards
                uasort($groups, create_function('$a,$b', 'return $a["status-".BugModel::STATUS_OPEN] == $b["status-".BugModel::STATUS_OPEN] ? 0 : ($a["status-".BugModel::STATUS_OPEN] > $b["status-".BugModel::STATUS_OPEN] ? -1 : 1);'));
            }
            elseif ($group_sort == 'fixedbugs') {
                // Sort by fixed bug count backwards
                uasort($groups, create_function('$a,$b', 'return $a["status-".BugModel::STATUS_FIXED] == $b["status-".BugModel::STATUS_FIXED] ? 0 : ($a["status-".BugModel::STATUS_FIXED] > $b["status-".BugModel::STATUS_FIXED] ? -1 : 1);'));
            }
        }
        
        return $groups;
    }
    
}

?>