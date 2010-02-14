<?php

class ConfigModel extends Model {
    public $table = 'config';
    private $config;
    
    // Permission levels, with room to grow
    const PERMISSION_NONE = 0;
    const PERMISSION_VIEW = 5;
    const PERMISSION_CONTRIBUTE = 10;
    const PERMISSION_CREATE = 15;
    const PERMISSION_MANAGE = 20;
    
    public function get($key) {
        if (empty($this->config)) {
            $this->getConfig();
        }
        
        if (array_key_exists($key, $this->config)) {
            return $this->config[$key];
        }
        
        return null;
    }
    
    private function getConfig() {
        $_results = $this->getAll();
        
        $config = array();
        
        foreach ($_results as $_result) {
            $config[$_result['key']] = $_result['value'];
        }
        
        $this->config = $config;
    }
    
}

?>