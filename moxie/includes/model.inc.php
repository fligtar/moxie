<?php

class Model {
    public $db;
    
    public function __construct(&$db) {
        $this->db =& $db;
    }
    
    public function getAll($conditions = '', $fields = '*') {
        $conditions = !empty($conditions) ? "WHERE {$conditions}" : '';
        
        $query = "SELECT {$fields} FROM {$this->table} {$conditions}";
        
        return $this->db->query($query);
    }
    
    public function get($id) {
        $result = $this->getAll('id = '.escape($id));
        
        if (!empty($result)) {
            return $result[0];
        }
        else {
            return null;
        }
    }
    
    public function update($id, $data) {
        $fields = array();
        
        foreach ($data as $field => $value) {
            $fields[] = "{$field} = '".escape($value)."'";
        }
        
        if (!array_key_exists('modified', $data)) {
            $fields[] = "modified = NOW()";
        }
        
        $query = "UPDATE {$this->table} SET ".implode(', ', $fields)." WHERE id = {$id}";
        
        return $this->db->execute($query);
    }
    
}

?>