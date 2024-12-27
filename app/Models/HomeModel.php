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

    public function GetTaskList() {
        $str = "SELECT x.*, 
                    y.full_name task_member, 
                    z.full_name task_leader 
                FROM tbl_task_list x
                    LEFT JOIN tbl_task_users y ON y.UserID = x.assigned_to
                    LEFT JOIN tbl_task_users z ON z.UserID = x.assigned_by";
        
        $query = $this->db->query($str);
        
        return $query->getResultArray();
    }

    public function GetTaskDetails($TaskID) {
        $str = "SELECT * FROM tbl_task_list 
                    WHERE TaskID = ?";

        $query = $this->db->query($str, [$TaskID]);
        
        return $query->getResultArray();
    }
}
