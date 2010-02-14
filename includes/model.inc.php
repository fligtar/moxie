<?php

class Model {
    public $db;
    
    public function __construct(&$db) {
        $this->db =& $db;
    }
    
    public function getAll($conditions = '', $fields = '*', $order = '') {
        $conditions = !empty($conditions) ? "WHERE {$conditions}" : '';
        $order = !empty($order) ? "ORDER BY {$order}" : '';
        
        $query = "SELECT {$fields} FROM {$this->table} {$conditions} {$order}";
        
        return $this->db->query($query);
    }
    
    public function get($id) {
        $result = $this->getAll("id = '".escape($id)."'");
        
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
            if ($value == 'NOW()') {
                // hax r us
                $fields[] = "{$field} = NOW()";
            }
            else {
                $fields[] = "{$field} = '".escape($value)."'";
            }
        }
        
        if (!array_key_exists('modified', $data)) {
            $fields[] = "modified = NOW()";
        }
        
        $query = "UPDATE {$this->table} SET ".implode(', ', $fields)." WHERE id = {$id}";
        
        return $this->db->execute($query);
    }
    
    public function insert($data) {
        $fields = array();
        $values = array();
        
        foreach ($data as $field => $value) {
            $fields[] = $field;
            $values[] = '\''.escape($value).'\'';
        }
        
        if (!array_key_exists('created', $data)) {
            $fields[] = 'created';
            $values[] = 'NOW()';
        }
        
        $query = "INSERT INTO {$this->table} (".implode(', ', $fields).") VALUES (".implode(', ', $values).")";
        
        return $this->db->execute($query);
    }
    
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = {$id}";
        
        return $this->db->execute($query);
    }
    
    public function filterData($data, $fields) {
        $safe = array();
        
        if (empty($data) || empty($fields)) {
            return array();
        }
        
        foreach ($data as $key => $value) {
            if (in_array($key, $fields)) {
                $safe[$key] = $value;
            }
        }
        
        return $safe;
    }
}

?>