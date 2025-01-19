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

    public function GetTaskList($UserRole) {
        $str = "SELECT x.*, 
                    y.full_name task_member, 
                    z.full_name task_leader 
                FROM tbl_task_list x
                    LEFT JOIN tbl_task_users y ON y.UserID = x.assigned_to
                    LEFT JOIN tbl_task_users z ON z.UserID = x.assigned_by
                WHERE x.isAvailable = 1";
        
        $query = $this->db->query($str);
        
        return $query->getResultArray();
    }

    public function GetTaskDetails($TaskID) {
        $str = "SELECT * FROM tbl_task_list 
                    WHERE TaskID = ?";

        $query = $this->db->query($str, [$TaskID]);
        
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

    public function GetActiveUsers() {
        $str = "SELECT 
                    UserID, 
                    first_name FirstName, 
                    middle_name MiddleName, 
                    last_name LastName, 
                    user_name UserName, 
                    user_status UserStatus 
                FROM tbl_user_access 
                    WHERE user_status = 1";
        
        $query = $this->db->query($str);

        return $query->getResultArray();
    }

    public function GetUserRecord($UserID) {
        $str = "SELECT * FROM tbl_user_access WHERE UserID = ?";
        
        $query = $this->db->query($str, [$UserID]);

        return $query->getResultArray();
    }

    public function GetTaskPrioLevelCount($TaskPrioLevel) {
        $str = "SELECT
                    SUM(CASE WHEN task_status = 1 THEN 1 ELSE 0 END) AS pending,
                    SUM(CASE WHEN task_status = 2 THEN 1 ELSE 0 END) AS completed,
                    COUNT(*) AS total
                FROM tbl_task_list WHERE task_level = ? AND isAvailable = 1";

        $query = $this->db->query($str, [$TaskPrioLevel]);

        return $query->getResultArray();
    }

    public function GetTaskStatusCount($TaskStatus) {
        $str = "SELECT
                    SUM(CASE WHEN task_level = 1 THEN 1 ELSE 0 END) AS low,
                    SUM(CASE WHEN task_level = 2 THEN 1 ELSE 0 END) AS medium,
                    SUM(CASE WHEN task_level = 3 THEN 1 ELSE 0 END) AS high,
                    COUNT(*) AS total
                FROM tbl_task_list WHERE task_status = ? AND isAvailable = 1";

        $query = $this->db->query($str, [$TaskStatus]);

        return $query->getResultArray();
    }
}
