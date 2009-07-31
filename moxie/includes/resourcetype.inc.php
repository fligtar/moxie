<?php

class Resourcetype {
    
    public function js() {}
    public function css() {}
    public function form() {}
    public function refresh() {}
    
    /**
     * Refreshes the data for a resource and updates that resource in the db
     */
    public function refreshAndUpdate(&$Resource, $id, $data) {
        $new = $this->refresh($id, $data);
        
        if (!empty($new)) {
            $Resource->update($id, array('data' => serialize($new)));
            return $new;
        }
        else {
            return false;
        }
    }
    
    /**
     * Extracts the resourcetype's custom fields from an array
     */
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