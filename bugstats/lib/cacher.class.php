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
    public function __construct($cacheFile) {
        $this->cacheFile = $cacheFile;
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
     * Flushes a certain key from the cache for better
     * memory management
     */
    public function flush($key) {
        $this->cache[$key] = null;
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
     */
    public function getHumanCacheAge() {
        $diff = $this->getCacheAge();
        
        if ($diff < 20)
            $str = 'just now';
        elseif ($diff < 60)
            $str = 'less than a minute ago';
        elseif ($diff < 3600)
            $str = ceil($diff / 60).' minutes ago';
        elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            $minutes = round(($diff % 3600) / 60, 0);
            
            $str = "{$hours} hour";
            if ($hours != 1)
                $str .= 's';
            $str .= ", {$minutes} minute";
            if ($minutes != 1)
                $str .= 's';
            $str .= " ago";
        }
        else
            $str = round($diff / 86400, 0).' days ago';
            
        return $str;
    }
}

?>