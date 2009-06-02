<?php

/**
 * Cacher!
 * Handles reading and writing to file cache
 */
class Cacher {
    private $cache = array();
    private $cacheFile;
    
    /**
     * Sets cache file path and loads it if it exists
     */
    public function __construct($projectName) {
        $this->cacheFile = dirname(dirname(__FILE__)).'/projects/'.$projectName.'/data.cache';
        $this->readCacheFile();
    }
    
    /**
     * Saves data in the cache
     */
    public function cache($key, $data) {
        $this->cache[$key] = $data;
        $this->writeCacheFile();
    }
    
    /**
     * Checks if a key exists in the cache
     */
    public function check($key) {
        return array_key_exists($key, $this->cache);
    }
    
    /**
     * Retrieves data from the cache
     */
    public function pull($key) {
        if ($this->check($key)) {
            return $this->cache[$key];
        }
    }
    
    /**
     * Reads the cache file
     */
    private function readCacheFile() {
        if (file_exists($this->cacheFile)) {
            $cache = file_get_contents($this->cacheFile);
            $this->cache = unserialize($cache);
        }
    }
    
    /**
     * Writes the cache file
     */
    private function writeCacheFile() {
        $this->cache['timestamp'] = time();
        file_put_contents($this->cacheFile, serialize($this->cache));
    }
    
    /**
     * Gets the age of the cache file in seconds
     */
    public function getCacheAge() {
        return time() - $this->pull('timestamp');
    }
    
    /**
     * Gets the age of the cache file in human terms
     * @TODO need to stop using ceil()
     */
    public function getHumanCacheAge() {
        $diff = $this->getCacheAge();
        
        if ($diff < 20)
            $str = 'just now';
        elseif ($diff < 60)
            $str = 'less than a minute ago';
        elseif ($diff < 3600)
            $str = ceil($diff / 60).' minutes ago';
        elseif ($diff < 86400)
            $str = ceil($diff / 3600).' hours ago';
        else
            $str = ceil($diff / 86400).' days ago';
            
        return $str;
    }
}

?>