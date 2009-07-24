<?php
require dirname(__FILE__).'/resourcetype.inc.php';

class ResourceManager {
    public $resourcetypes = array();
    public $resourcetype_list = array();
    
    public function __construct($resourcetype_list) {
        $this->resourcetype_list = $resourcetype_list;
        
        $this->loadResourcetypes();
    }
    
    public function loadResourcetypes() {
        if (!empty($this->resourcetype_list)) {
            foreach ($this->resourcetype_list as $k => $resourcetype) {
                if ($this->loadResourcetypeFile($resourcetype)) {
                    $this->resourcetypes[$resourcetype] = new $resourcetype;
                }
                else {
                    // We didn't find the resourcetype. Let's remove it!
                    unset($this->resourcetype_list[$k]);
                    // @TODO we should probably disable it in the db too
                }
            }
        }
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
     * @return string
     */
    public function callMethodOnAll($method) {
        $result = '';
        
        if (!empty($this->resourcetypes)) {
            foreach ($this->resourcetypes as $resourcetype) {
                $result .= $resourcetype->$method();
            }
        }
        
        return $result;
    }
    
}

?>