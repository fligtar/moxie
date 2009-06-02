<?php

require 'fetcher.class.php';
require 'cruncher.class.php';
require 'cacher.class.php';

/**
 * Project!
 * The class to rule all classes
 */
class Project {
    public $fetcher;
    public $cruncher;
    public $cacher;
    
    public $data = array();
    
    /**
     * Instantiates necessary classes
     */
    public function __construct() {
        $this->fetcher = new Fetcher;
        $this->cruncher = new Cruncher;
        $this->cacher = new Cacher($this->name);
    }
    
    /**
     * Pulls data from cache if available or fetches new data
     * if not. Then crunches it.
     */
    public function bam($noCache = false) {
        // If we can use the cache and have data cached, use it
        if (!$noCache && $this->cacher->check('XML')) {
            $xml = $this->cacher->pull('XML');
        }
        else {
            $xml = $this->fetch();
        }
        
        $this->cacher->flush('XML');
        
        // Crunch it! *grunt*
        $this->data = $this->crunch($xml);
    }
    
    /**
     * Fetches new data using the Fetcher and caches it using the Cacher
     */
    public function fetch() {
        $xml = $this->fetcher->fetch($this->queryBase.$this->queryString);
        
        $this->cacher->cache('XML', $xml);
        
        return $xml;
    }
    
    /**
     * Crunches data using the Cruncher
     */
    public function crunch($xml) {
        return $this->cruncher->crunch($xml, $this->unassigned);
    }
}

?>