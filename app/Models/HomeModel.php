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

        $inserted = $builder->insert($data);

        if ($inserted) {
            return $this->db->insertID();
        }
    }

    public function UpdateData($where=[], $table, $data=[]) {
        $builder = $this->db->table($table);

        return $builder->where($where)->update($data);
    }

    public function GetTaskUsers($UserID, $UserRole) {
        if ($UserRole == 'admin') { 
            $str = "SELECT UserID, full_name AS FullName 
                        FROM tbl_task_users
                    WHERE team_leader = ?";
        } elseif ($UserRole == 'leader') {
            $str = "SELECT UserID, full_name AS FullName 
                        FROM tbl_task_users 
                    WHERE team_leader = ?";
        } else {
            $str = "SELECT UserID, full_name AS FullName 
                        FROM tbl_task_users 
                    WHERE user_role = 'user' AND UserId <> ?";
        }

        $query = $this->db->query($str, [$UserID]);
        
        return $query->getResultArray();
    }

    public function GetTaskLeaders() {
        $str = "SELECT UserID, full_name FullName 
                    FROM tbl_task_users 
                WHERE user_role = 'admin' OR user_role = 'leader'";
        
        $query = $this->db->query($str);
        
        return $query->getResultArray();
    }

    public function GetTaskList($UserID, $UserRole) {
        if ($UserRole == 'admin') { 
            $str = "SELECT x.*, 
                    y.full_name task_member, 
                    z.full_name task_leader 
                FROM tbl_task_list x
                    LEFT JOIN tbl_task_users y ON y.UserID = x.assigned_to
                    LEFT JOIN tbl_task_users z ON z.UserID = x.assigned_by
                WHERE x.isAvailable = 1";
        } else {
            $str = "SELECT x.*, 
                    y.full_name task_member, 
                    z.full_name task_leader 
                FROM tbl_task_list x
                    LEFT JOIN tbl_task_users y ON y.UserID = x.assigned_to
                    LEFT JOIN tbl_task_users z ON z.UserID = x.assigned_by
                WHERE x.isAvailable = 1 AND x.assigned_by = ?";
        }
        
        $query = $this->db->query($str, [$UserID]);
        
        return $query->getResultArray();
    }

    public function GetTaskDetails($TaskID) {
        $str = "SELECT x.*, y.full_name AssignedToFname
                    FROM tbl_task_list x
                LEFT JOIN tbl_task_users y ON y.UserID = x.assigned_to 
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
        $str = "SELECT x.*, y.team_leader
                    FROM tbl_user_access x 
                LEFT JOIN tbl_task_users y ON y.UserID = x.UserID
                    WHERE x.UserID = ?";
        
        $query = $this->db->query($str, [$UserID]);

        return $query->getResultArray();
    }

    public function GetTaskPrioLevelCount($TaskPrioLevel, $UserID, $UserRole) {
        if ($UserRole == 'admin') {
            $str = "SELECT
                    SUM(CASE WHEN task_status = 1 THEN 1 ELSE 0 END) AS pending,
                    SUM(CASE WHEN task_status = 2 THEN 1 ELSE 0 END) AS completed,
                    COUNT(*) AS total
                FROM tbl_task_list WHERE task_level = ? AND isAvailable = 1";

            $query = $this->db->query($str, [$TaskPrioLevel]);
        } else {
            $str = "SELECT
                    SUM(CASE WHEN task_status = 1 THEN 1 ELSE 0 END) AS pending,
                    SUM(CASE WHEN task_status = 2 THEN 1 ELSE 0 END) AS completed,
                    COUNT(*) AS total
                FROM tbl_task_list WHERE task_level = ? AND isAvailable = 1 AND (assigned_by = ? OR assigned_to = ?)";

            $query = $this->db->query($str, [$TaskPrioLevel, $UserID, $UserID]);
        }

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

    public function GetPendingTaskCount($UserID) {
        $str = "SELECT
                    SUM(CASE WHEN task_level = 1 THEN 1 ELSE 0 END) AS low,
                    SUM(CASE WHEN task_level = 2 THEN 1 ELSE 0 END) AS medium,
                    SUM(CASE WHEN task_level = 3 THEN 1 ELSE 0 END) AS high,
                    COUNT(*) AS total
                FROM tbl_task_list WHERE task_status = 1 AND isAvailable = 1 AND assigned_to = ?";

        $query = $this->db->query($str, [$UserID]);

        return $query->getResultArray();
    }

    public function GetCompletedTaskCount($UserID) {
        $str = "SELECT
                    SUM(CASE WHEN task_level = 1 THEN 1 ELSE 0 END) AS low,
                    SUM(CASE WHEN task_level = 2 THEN 1 ELSE 0 END) AS medium,
                    SUM(CASE WHEN task_level = 3 THEN 1 ELSE 0 END) AS high,
                    COUNT(*) AS total
                FROM tbl_task_list WHERE task_status = 2 AND isAvailable = 1 AND assigned_to = ?";

        $query = $this->db->query($str, [$UserID]);

        return $query->getResultArray();
    }

    public function GetCreatedTaskCount($UserID) {
        $str = "SELECT
                    SUM(CASE WHEN task_level = 1 THEN 1 ELSE 0 END) AS low,
                    SUM(CASE WHEN task_level = 2 THEN 1 ELSE 0 END) AS medium,
                    SUM(CASE WHEN task_level = 3 THEN 1 ELSE 0 END) AS high,
                    COUNT(*) AS total
                FROM tbl_task_list WHERE task_status = 1 AND isAvailable = 1 AND assigned_by = ?";

        $query = $this->db->query($str, [$UserID]);

        return $query->getResultArray();
    }
}
