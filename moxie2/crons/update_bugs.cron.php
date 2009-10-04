<?php
require '../includes/init.inc.php';
require '../includes/bugtracking.inc.php';

$bugtracker = new Bugtracking();

list($Milestone) = load_models('Milestone');

$milestones = $Milestone->getAll();

if (!empty($milestones)) {
    foreach ($milestones as $milestone) {
        $bugtracker->retrieveAndUpdateBugs($milestone['id'], $milestone['bugquery']);
    }
}

?>