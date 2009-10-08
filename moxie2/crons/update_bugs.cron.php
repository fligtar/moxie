<?php
require '../includes/init.inc.php';
require '../includes/bugtracking.inc.php';

$bugtracker = new Bugtracking();

list($Bug, $Deliverable, $Milestone) = load_models('Bug', 'Deliverable', 'Milestone');

$milestones = $Milestone->getAll();

if (!empty($milestones)) {
    foreach ($milestones as $milestone) {
        $bugtracker->retrieveAndUpdateBugs($milestone['id'], $milestone['bugquery']);
    }
}

// Update any deliverable statuses that may have changed
$Deliverable->updateStatuses();

?>