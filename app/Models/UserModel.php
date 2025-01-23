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

    public function ValidateUserName($UserName) {
        $str = "SELECT COUNT(1) existing FROM tbl_user_access WHERE user_name = ?";

        $query = $this->db->query($str, [$UserName]);

        $row = $query->getRow();

        return $row->existing;
    }

    public function ValidateUserEmail($UserEmail) {
        $str = "SELECT COUNT(1) existing FROM tbl_user_access WHERE user_email = ?";

        $query = $this->db->query($str, [$UserEmail]);

        $row = $query->getRow();

        return $row->existing;
    }

    public function ValidateUserNumber($UserNumber) {
        $str = "SELECT COUNT(1) existing FROM tbl_user_access WHERE contact_number = ?";

        $query = $this->db->query($str, [$UserNumber]);

        $row = $query->getRow();

        return $row->existing;
    }
}
