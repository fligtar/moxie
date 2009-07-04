<?php

class BugtrackerModel extends Model {
    public $table = 'bugtrackers';
    
    public function getBugtrackers($project_id = '') {
        if (!empty($project_id)) {
            $query = "SELECT bugtrackers.* FROM bugtrackers INNER JOIN projects_bugtrackers ON projects_bugtrackers.bugtracker_id = bugtrackers.id WHERE projects_bugtrackers.project_id = {$project_id}";
            
            $_bugtrackers = $this->db->query($query);
        }
        else {
            $_bugtrackers = $this->getAll();
        }
        
        $bugtrackers = array();
        
        if (!empty($_bugtrackers)) {
            foreach ($_bugtrackers as $bugtracker) {
                $bugtrackers[$bugtracker['id']] = $bugtracker;
            }
        }
        
        return $bugtrackers;
    }
}

?>