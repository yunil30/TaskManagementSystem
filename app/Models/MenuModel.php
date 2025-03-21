<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model {
    protected $db;
    protected $str;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }

    public function InsertData($table, $data=[]) {
        $builder = $this->db->table($table);

        return $builder->insert($data);
    }

    public function UpdateData($where=[], $table, $data=[]) {
        $builder = $this->db->table($table);

        return $builder->where($where)->update($data);
    }

    public function DeleteData($where=[], $table) {
        $builder = $this->db->table($table);

        return $builder->delete($where);
    }

    public function GetListOfMappedMenu() {
        $str = "SELECT x.user_role,
                    GROUP_CONCAT(y.menu_name ORDER BY y.MenuID) AS menu_names
                        FROM tbl_menu_mapping x
                    LEFT JOIN tbl_user_menu y ON x.MenuID = y.MenuID
                GROUP BY x.user_role";
    
        $query = $this->db->query($str);
        
        return $query->getResultArray();
    }

    public function GetMappedMenuByRole($UserRole) {
        $str = "SELECT x.user_role,
                    GROUP_CONCAT(y.menu_name ORDER BY y.MenuID) AS menu_names,
                    GROUP_CONCAT(x.MenuID ORDER BY x.MenuID) AS MenuID
                FROM tbl_menu_mapping x
                    LEFT JOIN tbl_user_menu y ON x.MenuID = y.MenuID
                WHERE x.user_role = ?";
    
        $query = $this->db->query($str, [$UserRole]);
        
        return $query->getResultArray();
    }

    public function GetActiveMenu() {
        $str = "SELECT * FROM tbl_user_menu";

        $query = $this->db->query($str);

        return $query->getResultArray();
    }

    public function ValidateRoleMappedMenu($UserRole) {
        $str = "SELECT COUNT(1) existing FROM tbl_menu_mapping WHERE user_role = ?";

        $query = $this->db->query($str, [$UserRole]);

        $row = $query->getRow();

        return $row->existing;
    }

    public function GetListOfMenus() {
        $str = "SELECT * FROM tbl_user_menu WHERE menu_status = 1";
    
        $query = $this->db->query($str);
        
        return $query->getResultArray();
    }

    public function GetMenuRecord($MenuID) {
        $str = "SELECT * FROM tbl_user_menu WHERE MenuID = ?";
    
        $query = $this->db->query($str, [$MenuID]);
        
        return $query->getResultArray();
    }
}
