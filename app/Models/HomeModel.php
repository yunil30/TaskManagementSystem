<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model {
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

    public function GetTaskUsers() {
        $str = "SELECT UserID, full_name FullName FROM tbl_task_users";
        
        $query = $this->db->query($str);
        
        return $query->getResultArray();
    }
}
