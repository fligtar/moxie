<?php
require '../includes/init.inc.php';
require '../includes/bugtracking.inc.php';

list($Bug, $Bugtracker) = load_models('Bug', 'Bugtracker');

$bugtrackers = $Bugtracker->getBugtrackers();

if (!empty($bugtrackers)) {
    foreach ($bugtrackers as $bugtracker) {
        $trackertype = Bugtracking::getTrackerInfo($bugtracker['type']);
        
        if (!class_exists($trackertype['shortname'])) {
            require '../includes/bugtracking/'.$trackertype['shortname'].'.inc.php';
        }
        
        $tracker = new $trackertype['shortname']($bugtracker['url']);
        
        $bug_numbers = $Bug->getAll("bugtracker_id = {$bugtracker['id']}", 'id, number');
        if (empty($bug_numbers)) {
            continue;
        }
        
        $bugs = array();
        foreach ($bug_numbers as $bug_number) {
            $bugs[] = $bug_number['number'];
        }
        
        $bugs = $tracker->getBugInfo($bugs);
        
        foreach ($bug_numbers as $bug_number) {
            if (!empty($bugs[$bug_number['number']])) {
                $Bug->update($bug_number['id'], $bugs[$bug_number['number']]);
                echo "Updated bug {$bug_number['id']} (number {$bug_number['number']} in tracker {$bugtracker['id']})\n";
            }
        }
    }
}

?>