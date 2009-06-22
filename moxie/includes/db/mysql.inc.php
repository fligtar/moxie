<?php

class mysql extends db {
    
    public function connect($user, $pass, $db, $host) {
        $this->dbh = mysql_connect($host, $user, $pass);
        
        if (!$this->dbh) {
            fatal_error('Could not connect to database with credentials given.');
        }
        
        if (!mysql_select_db($db, $this->dbh)) {
            fatal_error('Could not select database.');
        }
    }
    
    public function execute($query) {
       return mysql_query($query, $this->dbh);
    }
    
    public function query($query) {
        $_result = mysql_query($query, $this->dbh);
        
        $results = array();
        while ($row = mysql_fetch_array($_result, MYSQL_ASSOC)) {
            $results[] = $row;
        }
        
        return $results;
    }
    
    public function disconnect() {
        mysql_close($this->dbh);
    }
}

?>