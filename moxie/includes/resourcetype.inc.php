<?php

class Resourcetype {
    
    public function js() {}
    public function css() {}
    public function form() {}
    
    public function getFieldsToSave($data) {
        $fields = array();
        
        if ($this->fields) {
            foreach ($this->fields as $field) {
                if (!empty($data[$field])) {
                    $fields[$field] = $data[$field];
                }
            }
        }
        
        return $fields;
    }
    
}

?>