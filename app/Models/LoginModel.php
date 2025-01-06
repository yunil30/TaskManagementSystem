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

    public function GetUserMenu() {
        $this->str =  "SELECT 
                            parent.RecID AS parent_id,
                            parent.menu_name AS parent_menu,
                            parent.menu_page AS parent_page,
                            parent.menu_icon AS parent_icon,
                            child.RecID AS child_id,
                            child.menu_name AS child_menu,
                            child.menu_page AS child_page,
                            child.menu_index AS child_index,
                            child.menu_icon AS child_icon
                        FROM 
                            tbl_user_menu AS parent
                        LEFT JOIN 
                            tbl_user_menu AS child 
                            ON parent.RecID = child.parent_menu
                        WHERE 
                            parent.menu_type = 'parent'
                        ORDER BY 
                            parent.RecID, child.menu_name, child.menu_index ASC";

        $query = $this->db->query($this->str);

        return $query->getResultArray();
    }
}
