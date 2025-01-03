<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model {
    protected $db;
    protected $str;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }

    public function LoginUser($username, $password) {
        $this->Username = $username;
        $this->Password = $password;

        $this->str = "SELECT UserID UserNo, 
                            first_name FirstName,   
                            middle_name MiddleName, 
                            last_name LastName, 
                            user_name UserName,
                            user_role UserRole, 
                            password UserPass,
                            user_status UserStatus
                        FROM tbl_user_access 
                    WHERE user_name = :username: AND password = :password: AND user_status = 1";

        $this->KeyBindings = [
            'username' => $this->Username,
            'password' => $this->Password
        ];

        $query = $this->db->query($this->str, $this->KeyBindings);

        return $query->getResultArray();
    }
}
