<?php

namespace App\Controllers;
use App\Models\HomeModel;

class Home extends BaseController {
    private $postRequest;
    private $session;
    private $HomeModel;

    public function __construct() {
        helper('utility_helpers');
        $this->postRequest = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->HomeModel = new HomeModel();
    }

    public function index() {
        if($this->session->has('session_username')) {
            return view('MyDashboard');
        }
        return view('LoginForm');
    }

    public function ListOfTasks() {
        if($this->session->has('session_username')) {
            return view('ListOfTasks');
        }
        return view('LoginForm');
    }

    public function ListOfUsers() {
        if($this->session->has('session_username')) {
            return view('ListOfUsers');
        }
        return view('LoginForm');
    }

    public function UserProfile() {
        if($this->session->has('session_username')) {
            return view('UserProfile');
        }
        return view('LoginForm');
    }

    public function ListOfMenus() {
        if($this->session->has('session_username')) {
            return view('ListOfMenus');
        }
        return view('LoginForm');
    }

    public function ViewListOfTasks() {
        if($this->session->has('session_username')) {
            return view('Tasks/ListOfTasks');
        }
        return view('LoginForm');
    }

    public function ViewPendingTasks() {
        if($this->session->has('session_username')) {
            return view('Tasks/PendingTasks');
        }
        return view('LoginForm');
    }

    public function ViewCompletedTasks() {
        if($this->session->has('session_username')) {
            return view('Tasks/CompletedTasks');
        }
        return view('LoginForm');
    }

    public function GetTaskUsers() {
        return json_encode($this->HomeModel->GetTaskUsers());
    }

    public function GetTaskList() {
        $UserRole = $this->session->has('session_username');

        return json_encode($this->HomeModel->GetTaskList($UserRole));
    }

    public function GetTaskDetails() {
        $requestJson = $this->postRequest->getJSON();

        return json_encode($this->HomeModel->GetTaskDetails($requestJson->taskNo));
    }

    public function GetTaskStatusCount() {
        $requestJson = $this->postRequest->getJSON();

        return json_encode($this->HomeModel->GetTaskStatusCount($requestJson->taskStatus));
    }

    public function CreateTask() {
        $requestJson = $this->postRequest->getJSON();

        $data = [
            'task_name'        => $requestJson->taskName,
            'task_description' => $requestJson->taskDescription,
            'assigned_by'      => '10001',
            'assigned_to'      => $requestJson->taskAssignTo,
            'task_status'      => $requestJson->taskStatus,
            'task_level'       => $requestJson->taskLevel,
            'date_created '    => date('Y-m-d'),
            'task_deadline '   => $requestJson->taskDeadline
        ];

        if ($this->HomeModel->InsertData('tbl_task_list', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'Task successfully added.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'Task could not be added.']);
        }
    }

    public function EditTask() {
        $requestJson = $this->postRequest->getJSON();

        $fields = [
            'TaskID' => $requestJson->taskNo,
        ];

        $data = [
            'task_name'        => $requestJson->taskName,
            'task_description' => $requestJson->taskDescription,
            'assigned_to'      => $requestJson->taskAssignTo,
            'task_status'      => $requestJson->taskStatus,
            'task_level'       => $requestJson->taskLevel,
            'task_deadline '   => $requestJson->taskDeadline
        ];

        if ($this->HomeModel->UpdateData($fields, 'tbl_task_list', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'Task successfully updated.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'Task could not be updated.']);
        }
    }

    public function RemoveTask() {
        $requestJson = $this->postRequest->getJSON();

        $fields = [
            'TaskID' => $requestJson->taskNo,
        ];

        $data = [
            'isAvailable' => 0,
        ];

        if ($this->HomeModel->UpdateData($fields, 'tbl_task_list', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'Task successfully removed.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'Task could not be removed.']);
        }
    }

    public function CreateUser() {
        $requestJson = $this->postRequest->getJSON();

        if (empty($requestJson->UserName) || empty($requestJson->UserEmail) || empty($requestJson->UserPassword)) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Missing required fields!']);
        }

        $ValidateUserName = $this->HomeModel->ValidateUserName($requestJson->UserName);
        if($ValidateUserName > 0) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Username Already Exists!']);
        }

        $ValidateUserEmail = $this->HomeModel->ValidateUserEmail($requestJson->UserEmail);
        if($ValidateUserEmail > 0) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Email address Already Exists!']);
        }

        $data = [
            'first_name'  => $requestJson->FirstName,
            'middle_name' => $requestJson->MiddleName,
            'last_name'   => $requestJson->LastName,
            'user_name'   => $requestJson->UserName,
            'user_email'  => $requestJson->UserEmail,
            'password'    => sha1(md5($requestJson->UserPassword)),
            'user_role '  => $requestJson->UserRole
        ];

        if ($this->HomeModel->InsertData('tbl_user_access', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'User access successfully added.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'User access could not be added.']);
        }
    }

    public function GetUserList() {
        return json_encode($this->HomeModel->GetActiveUsers());
    }

    public function GetUserRecord() {
        $requestJson = $this->postRequest->getJSON();
   
        return json_encode($this->HomeModel->GetUserRecord($requestJson->userNo));
    }

    public function EditUser() {
        $requestJson = $this->postRequest->getJSON();

        if (empty($requestJson->UserName) || empty($requestJson->UserEmail)) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Missing required fields!']);
        }

        $fields = [
            'UserID' => $requestJson->userNo,
        ];

        $data = [
            'first_name'    => $requestJson->FirstName,
            'middle_name'   => $requestJson->MiddleName,
            'last_name'     => $requestJson->LastName,
            'user_name'     => $requestJson->UserName,
            'user_email'    => $requestJson->UserEmail,
            'user_role '    => $requestJson->UserRole,
            'date_modified' => date('Y-m-d H:i:s')
        ];

        if ($this->HomeModel->UpdateData($fields, 'tbl_user_access', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'User access successfully updated.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'User access could not be updated.']);
        }
    }

    public function RemoveUser() {
        $requestJson = $this->postRequest->getJSON();

        $fields = [
            'UserID' => $requestJson->userNo,
        ];

        $data = [
            'user_status' => 0,
        ];

        if ($this->HomeModel->UpdateData($fields, 'tbl_user_access', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'User successfully removed.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'User could not be removed.']);
        }
    }
}
