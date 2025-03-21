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

        $inserted = $builder->insert($data);

        if ($inserted) {
            return $this->db->insertID();
        }
    }

    public function UpdateData($where=[], $table, $data=[]) {
        $builder = $this->db->table($table);

        return $builder->where($where)->update($data);
    }

    public function GetPendingTaskList($UserID) {
        $str = "SELECT x.*, y.full_name AS team_leader FROM tbl_task_list x
                    LEFT JOIN tbl_task_users y on y.UserID = x.assigned_by
                WHERE x.isAvailable = 1 AND x.task_status = 1 AND x.assigned_to = ?";
        
        $query = $this->db->query($str, [$UserID]);
        
        return $query->getResultArray();
    }

    public function GetCompletedTaskList($UserID) {
        $str = "SELECT x.*, y.full_name AS team_leader FROM tbl_task_list x
                    LEFT JOIN tbl_task_users y on y.UserID = x.assigned_by
                WHERE x.isAvailable = 1 AND x.task_status = 2 AND x.assigned_to = ?";
        
        $query = $this->db->query($str, [$UserID]);
        
        return $query->getResultArray();
    }

    public function GetAnsweredTaskList($UserID) {
        $str = "SELECT x.*, CONCAT(y.first_name, ' ', y.last_name) AS fullname
                    FROM tbl_task_list x
                LEFT JOIN tbl_user_access y ON y.UserID = x.assigned_to
                    WHERE x.isAvailable = 1 AND x.task_status = 2 AND x.assigned_by = ?";
        
        $query = $this->db->query($str, [$UserID]);
        
        return $query->getResultArray();
    }

    public function GetTaskDetails($TaskID) {
        $str = "SELECT x.*, 
                    y.full_name AS team_leader, 
                    z.task_response, 
                    z.doc_folder, 
                    z.doc_name 
                FROM tbl_task_list x
                    LEFT JOIN tbl_task_users y on y.UserID = x.assigned_by
                    LEFT JOIN tbl_task_response z on z.TaskID = x.TaskID
                WHERE x.TaskID = ?";

        $query = $this->db->query($str, [$TaskID]);
        
        return $query->getResultArray();
    }
}
