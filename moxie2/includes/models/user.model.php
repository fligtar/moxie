<?php

class UserModel extends Model {
    public $table = 'users';
    
    /**
     * Finds a user based on their email address and password
     */
    public function authenticate($email, $password) {
        $users = $this->getAll("email = '".escape($email)."' AND password = '".escape(md5($password))."'");
        if (!empty($users[0])) {
            return $users[0];
        }
        else {
            return false;
        }
    }
}

?>