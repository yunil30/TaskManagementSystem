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
        $str = "SELECT x.MenuID, 
                            x.user_role, 
                            y.menu_name, 
                            y.menu_type
                        FROM tbl_menu_mapping AS x
                            LEFT JOIN tbl_user_menu AS y ON x.MenuID = y.MenuID";
    
        $query = $this->db->query($str);
        
        return $query->getResultArray();
    }

    public function GetActiveMenu() {
        $str = "SELECT MenuID, menu_name FROM tbl_user_menu";

        $query = $this->db->query($str);

        return $query->getResultArray();
    }
}
