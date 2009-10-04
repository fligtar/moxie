<?php

class MilestoneModel extends Model {
    public $table = 'milestones';
    
    /**
     * Get the milestone's information based on the URL parameter,
     * which could either be the id or URL slug
     */
    public function getMilestoneFromURL($param) {
        $milestone = $this->get($param);
        
        if (!$milestone) {
            $milestones = $this->getAll("url = '".escape($param)."'");
            $milestone = $milestones[0];
        }
        
        return $milestone;
    }
    
    /**
     * Finds all milestones started during the given timeframe
     */
    public function getMilestonesStartedDuring($product_id, $start, $end) {
        $_milestones = $this->db->query("SELECT milestones.* FROM milestones INNER JOIN dates ON dates.milestone_id = milestones.id WHERE milestones.product_id = ".escape($product_id)." AND dates.type = ".DateModel::TYPE_START." AND dates.date >= '{$start}' AND dates.date <= '{$end}' ORDER BY dates.date");
        
        return $_milestones;
    }
}

?>