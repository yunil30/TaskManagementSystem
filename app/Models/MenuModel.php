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

    public function GetListOfMappedMenu() {
        $str = "SELECT 
            y.MenuID,
            y.menu_name,
            x.user_role
        FROM 
            tbl_menu_mapping AS x
        JOIN 
            tbl_user_menu AS y 
        ON 
            JSON_CONTAINS(CAST(x.MenuID AS JSON), JSON_ARRAY(CAST(y.MenuID AS CHAR)), '$')";
    
        $query = $this->db->query($str);
        
        return $query->getResultArray();
    }

    public function GetMappedMenuByRole($UserRole) {
        $str = "SELECT 
                    y.MenuID,
                    y.menu_name,
                    x.user_role
                FROM 
                    tbl_menu_mapping AS x
                JOIN 
                    tbl_user_menu AS y 
                ON 
                    JSON_CONTAINS(CAST(x.MenuID AS JSON), JSON_ARRAY(CAST(y.MenuID AS CHAR)), '$')
                WHERE x.user_role = ?";
    
        $query = $this->db->query($str, [$UserRole]);
        
        return $query->getResultArray();
    }

    public function GetActiveMenu() {
        $str = "SELECT MenuID, menu_name FROM tbl_user_menu";

        $query = $this->db->query($str);

        return $query->getResultArray();
    }

    public function ValidateRoleMappedMenu($UserRole) {
        $str = "SELECT COUNT(1) existing FROM tbl_menu_mapping WHERE user_role = ?";

        $query = $this->db->query($str, [$UserRole]);

        $row = $query->getRow();

        return $row->existing;
    }
}
