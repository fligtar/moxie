<?php

class db {
    public $dbh;
    public $debug = false;
    
    public function __construct($user, $pass, $db, $host, $port) {
        $this->connect($user, $pass, $db, $host.':'.$port);
    }
    
    
    public function __destruct() {
        $this->disconnect();
    }
}

?>