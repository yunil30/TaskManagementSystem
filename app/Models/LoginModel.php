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
        $Username = $username;
        $Password = $password;

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

        $KeyBindings = [
            'username' => $Username,
            'password' => $Password
        ];

        $query = $this->db->query($this->str, $KeyBindings);

        return $query->getResultArray();
    }

    public function GetMenu($userRole) {
        if ($userRole == 'admin') {
            $this->str = "SELECT * FROM tbl_user_menu";
        } else {
            $this->str = "SELECT x.* FROM tbl_user_menu x
                LEFT JOIN tbl_menu_mapping y ON x.MenuID = y.MenuID
            WHERE y.user_role = ?";
        }
    
        $query = $this->db->query($this->str, [$userRole]);
        
        $result = $query->getResultArray();
        
        return json_encode($result);
    }
}
