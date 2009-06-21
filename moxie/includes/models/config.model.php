<?php

class ConfigModel extends Model {
    public $table = 'config';
    private $config;
    
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