<?php

class TempModel extends Model {
    public $table = 'temp';
    
    public function createTempEntry($data) {
        if ($this->insert(array('data' => serialize($data)))) {
            return $this->db->getLastID();
        }
        else {
            return false;
        }
    }
}

?>