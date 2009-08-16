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
    
    public function retrieveAndDestroyTempEntry($temp_id) {
        if ($data = $this->get($temp_id)) {
            $this->delete($temp_id);
            
            return unserialize($data['data']);
        }
        
        return false;
    }
}

?>