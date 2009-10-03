<?php

class MilestoneModel extends Model {
    public $table = 'milestones';
    
    
    public function getMilestonesStartedDuring($product_id, $start, $end) {
        $_milestones = $this->db->query("SELECT milestones.* FROM milestones INNER JOIN dates ON dates.milestone_id = milestones.id WHERE milestones.product_id = ".escape($product_id)." AND dates.type = ".DateModel::TYPE_START." AND dates.date >= '{$start}' AND dates.date <= '{$end}' ORDER BY dates.date");
        
        return $_milestones;
    }
}

?>