<?php
require dirname(__FILE__).'/resourcetype.inc.php';

class ResourceManager {
    public $resourcetypes = array();
    public $resourcetype_list = array();
    
    public function __construct($resourcetype_list = array()) {
        $this->resourcetype_list = $resourcetype_list;
        
        $this->loadResourcetypes();
    }
    
    public function isLoaded($resourcetype) {
        return array_key_exists($resourcetype, $this->resourcetypes);
    }
    
    public function loadAdditionalResourcetype($resourcetype) {
        if ($this->isLoaded($resourcetype)) {
            return false;
        }
        
        $this->resourcetype_list[] = $resourcetype;
        
        $this->loadResourcetypes();
    }
    
    public function loadResourcetypes() {
        if (!empty($this->resourcetype_list)) {
            foreach ($this->resourcetype_list as $k => $resourcetype) {
                // Make sure the resource type hasn't already been loaded
                if ($this->isLoaded($resourcetype)) {
                    continue;
                }
                
                if (strpos($resourcetype, array('/')) === false && $this->loadResourcetypeFile($resourcetype)) {
                    $this->resourcetypes[$resourcetype] = new $resourcetype;
                }
                else {
                    // We didn't find the resourcetype. Let's remove it!
                    unset($this->resourcetype_list[$k]);
                    // @TODO we should probably disable it in the db too
                }
            }
        }
        
        ksort($this->resourcetypes);
    }
    
    public function loadResourcetypeFile($resourcetype) {
        // Make sure resourcetype isn't already available
        if (class_exists($resourcetype)) {
            return true;
        }
        
        // First, try built-in resourcetypes
        $path = dirname(__FILE__)."/resourcetypes/{$resourcetype}.resourcetype.php";
        if (file_exists($path)) {
            include $path;
            return true;
        }
        
        // Next, try custom resourcetypes
        $path = dirname(dirname(__FILE__))."/custom/resourcetypes/{$resourcetype}.resourcetype.php";
        if (file_exists($path)) {
            include $path;
            return true;
        }
        
        // Uh oh. We didn't find it.
        return false;
    }
    
    /**
     * Calls a string-returning method on all resourcetypes and returns the results
     * @param string $method name of the method (ex: css, js, form)
     * @param mixed $params parameter(s) to pass to the method
     * @return string
     */
    public function callMethodOnAll($method, &$params = array()) {
        $result = '';
        
        if (!empty($this->resourcetypes)) {
            foreach ($this->resourcetypes as $resourcetype) {
                $result .= $resourcetype->$method($params);
            }
        }
        
        return $result;
    }
    
}

?>