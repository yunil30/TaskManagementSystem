<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model {
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

    public function GetCompletedTaskList($UserID) {
        $str = "SELECT x.*, y.full_name AS team_leader FROM tbl_task_list x
                    LEFT JOIN tbl_task_users y on y.UserID = x.assigned_by
                WHERE x.isAvailable = 1 AND x.task_status = 3 AND x.assigned_to = ?";
        
        $query = $this->db->query($str, [$UserID]);
        
        return $query->getResultArray();
    }

    public function GetTaskDetails($TaskID) {
        $str = "SELECT x.*, y.full_name AS team_leader FROM tbl_task_list x
                    LEFT JOIN tbl_task_users y on y.UserID = x.assigned_by
                WHERE x.TaskID = ?";

        $query = $this->db->query($str, [$TaskID]);
        
        return $query->getResultArray();
    }
}
