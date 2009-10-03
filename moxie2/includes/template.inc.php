<?php

class Template {
    public $primary_theme;
    public $backup_theme;
    public $default_theme = 'default';
    public $template_dir;
    public $breadcrumbs = array();
    
    private $cache = array();
    
    const CACHE_NONE = 0;
    const CACHE_MEMORY = 1;
    //const CACHE_FILE = 2;
    
    public function __construct($primary_theme = 'default', $backup_theme = 'default') {
        $this->primary_theme = $primary_theme;
        $this->backup_theme = $backup_theme;
        
        $this->template_dir = dirname(dirname(__FILE__)).'/templates/';
    }
    
    public function render($template, $vars = array(), $cache_level = Template::CACHE_NONE) {
        // If caching requesting, see if a cached version is available
        if ($cache_level > Template::CACHE_NONE) {
            if (!empty($this->cache[$template])) {
                // Cached version found in memory. Use it and return
                echo "<!-- Cached template {$template} -->";
                echo $this->cache[$template];
                return;
            }
            else {
                // No cached version found. We'll cache the one we're about to render!
                ob_start();
            }
        }
        
        include $this->getThemedFile("{$template}.template.php");
        
        if ($cache_level > Template::CACHE_NONE) {
            $this->cache[$template] = ob_get_contents();
            ob_end_flush();
        }
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
    
    public function getBaseURL() {
        $url = $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        
        $url .= $_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
        
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
    
    public function bugLink($bug, $tracker) {
        echo '<a class="bug';
        if ($bug['fixed'])
            echo ' fixed';
        if ($bug['verified'])
            echo ' verified';
        echo '" title="'.htmlentities($bug['assignee'].' - '.$bug['summary']).'" ';
        echo 'href="'.$tracker['url'].sprintf($tracker['tracker_info']['viewpage'], $bug['number']).'">';
        echo $tracker['tracker_info']['bug_term'].' '.$bug['number'];
        echo '</a>';
    }
}

?>