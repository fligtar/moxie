<?php

class Resourcetype {
    public $id = '';
    public $name = '';
    
    private $handlers = array();
    
    public function __construct() {
        // Set default metdata
        if (empty($this->id)) {
            $this->id = get_class($this);
        }
        
        if (empty($this->name)) {
            $this->name = $this->id;
        }
        
        // Add callbacks for certain methods if they exist
        
        // CSS
        if (method_exists($this, 'css')) {
            $this->addHook('output_css', 'css');
        }
        
        // JavaScript
        if (method_exists($this, 'js')) {
            $this->addHook('output_js', 'js');
        }
        
        // Call init method if it exists
        if (method_exists($this, 'init')) {
            $this->init();
        }
    }
    
    // Required methods
    public function getLink() {}
    public function renderAddResourcesPanel() {}
    
    // Optional methods
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
    
    // Helpers
    
    /**
     * Adds a hook that will call the given callback.
     * Callback must be a method in the calling class.
     */
    public function addHook($action, $method) {
        add_hook($action, array(get_class($this), $method));
    }
    
    /**
     * Registers a custom handler function for an AJAX call
     */
     public function addHandler($action, $handler) {
         $this->handlers[$action] = $handler;
     }
     
     /**
      * Calls a custom handler for the resourcetype
      */
     public function handle($action) {
         if (!empty($this->handlers[$action])) {
             $params = func_get_args();
             unset($params[0]);

             call_user_func_array(array($this, $this->handlers[$action]), $params);
         }
     }
    
}

?>