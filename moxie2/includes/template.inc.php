<?php

class Template {
    public $primary_theme;
    public $backup_theme;
    public $default_theme = 'default';
    public $template_dir;
    public $vars = array();
    public $product_url;
    
    public function __construct($primary_theme = 'default', $backup_theme = 'default', $product_url = '') {
        $this->primary_theme = $primary_theme;
        $this->backup_theme = $backup_theme;
        $this->product_url = $product_url;
        
        $this->template_dir = dirname(dirname(__FILE__)).'/templates/';
    }
    
    /**
     * Takes an array of values to set for the template.
     */
    public function set($variables) {
        foreach ($variables as $key => $value) {
            $this->vars[$key] = $value;
        }
    }
    
    /**
     * Takes a list of templates to render in order.
     * Ex: $template->render('head', 'header', 'page', 'footer');
     */
    public function render() {
        $templates = func_get_args();
        $reserved = array('templates', 'template', 'this', 'key', 'value', 'reserved');
        
        // Give access to the set variables
        if (!empty($this->vars)) {
            foreach ($this->vars as $key => $value) {
                if (!in_array($key, $reserved)) {
                    $$key = $value;
                }
            }
        }
        
        // Load the templates
        foreach ($templates as $template) {
            include $this->getThemedFile("{$template}.template.php");
        }
    }
    
    /**
     * Sets variables and then renders a template in one
     */
    public function setAndRender($template, $variables) {
        $this->set($variables);
        
        $this->render($template);
    }
    
    private function getThemedFile($file) {
        // First, try the primary theme (usually project-specific)
        if (file_exists($this->template_dir.$this->primary_theme."/{$file}")) {
            return $this->template_dir.$this->primary_theme."/{$file}";
        }
        
        // Next, try the backup theme (usually the site theme)
        if (file_exists($this->template_dir.$this->backup_theme."/{$file}")) {
            return $this->template_dir.$this->backup_theme."/{$file}";
        }
        
        // Finally, use the default theme (regardless of file's existence)
        return $this->template_dir.$this->default_theme."/{$file}";
    }
    
    /**
     * Gets the absolute URL for a relative URL
     * Allowed substitutions:
     *      %product% -> product url prefix
     */
    public function url($url = '') {
        if (strpos($url, '%') !== false) {
            $url = str_replace('%product%', $this->product_url, $url);
        }
        
        return $this->getBaseURL().'/'.$url;
    }
    
    /**
     * Gets the absolute base URL of the moxie installation.
     * Use $this->url() instead.
     */
    public function getBaseURL() {
        $url = $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        
        $url .= $_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
        
        return $url;
    }
    
    public function getCurrentURL() {
        $url = $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        
        $url .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        
        return $url;
    }
    
    public function cssString() {
        $files = func_get_args();
        $string = '';
        
        foreach ($files as $file) {
            $path = str_replace($this->template_dir, '', $this->getThemedFile("css/{$file}.css"));
            $string .= '<link rel="stylesheet" type="text/css" href="templates/'.$path.'" />'."\n";
        }
        
        return $string;
    }
    
    public function jsString() {
        $files = func_get_args();
        $string = '';
        
        foreach ($files as $file) {
            $path = str_replace($this->template_dir, '', $this->getThemedFile("js/{$file}.js"));
            $string .= '<script type="text/javascript" src="templates/'.$path.'"></script>'."\n";
        }
        
        return $string;
    }
    
    public function image($img) {
        $path = str_replace($this->template_dir, '', $this->getThemedFile("images/{$img}"));
        return "templates/{$path}";
    }
    
    public function linkBug(&$bug, $include_details = true) {
        echo '<a class="bug status-'.$bug['status'].'"';
        echo ' href="https://bugzilla.mozilla.org/show_bug.cgi?id='.$bug['number'].'">';
        echo $bug['summary'];
        echo '</a>';
        
        if ($include_details) {
            echo '<span class="bug-details">(';
            
            // Bug status
            if ($bug['status'] == BugModel::STATUS_OPEN) {
                echo 'Open';
            }
            elseif ($bug['status'] == BugModel::STATUS_FIXED) {
                echo 'Fixed';
            }
            elseif ($bug['status'] == BugModel::STATUS_OTHER) {
                echo 'Other';
            }
            
            echo ' - ';
            
            // Bug assignee
            echo $bug['name'];
            
            echo ')</span>';
        }
    }
    
    /**
     * Renders the deliverable status menu
     */
    public function renderDeliverableStatus($status) {
        echo '<span class="deliverable-status status-'.$status.'">';
        
        if ($status == DeliverableModel::STATUS_NOTSTARTED) {
            echo 'NOT STARTED';
        }
        elseif ($status == DeliverableModel::STATUS_INPROGRESS) {
            echo 'IN PROGRESS';
        }
        elseif ($status == DeliverableModel::STATUS_COMPLETE) {
            echo 'COMPLETE';
        }
        elseif ($status == DeliverableModel::STATUS_BLOCKED) {
            echo 'BLOCKED';
        }
        
        echo '</span>';
    }
    
}

?>