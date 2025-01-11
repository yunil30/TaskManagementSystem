<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model {
    protected $db;
    protected $str;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }

    public function GetActiveMenu() {
        $str = "SELECT RecID, menu_name FROM tbl_user_menu";

        $query = $this->db->query($str);

        return $query->getResultArray();
    }
}
