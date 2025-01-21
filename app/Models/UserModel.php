<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $db;
    protected $str;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }

    public function InsertData($table, $data=[]) {
        $builder = $this->db->table($table);

        $inserted = $builder->insert($data);

        if ($inserted) {
            return $this->db->insertID();
        }
    }

    public function UpdateData($where=[], $table, $data=[]) {
        $builder = $this->db->table($table);

        return $builder->where($where)->update($data);
    }

    public function GetUserInfo($UserID) {
        $str = "SELECT * FROM tbl_user_access WHERE UserID = ?";
        
        $query = $this->db->query($str, [$UserID]);
        
        return $query->getResultArray();
    }
}
