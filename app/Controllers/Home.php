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

    public function index(): string {
        return view('welcome_message');
    }

    public function ListOfTasks() {
        return view('ListOfTasks');
    }

    public function ListOfUsers() {
        return view('ListOfUsers');
    }

    public function GetTaskUsers() {
        return json_encode($this->HomeModel->GetTaskUsers());
    }

    public function GetTaskList() {
        return json_encode($this->HomeModel->GetTaskList());
    }

    public function GetTaskDetails() {
        $requestJson = $this->postRequest->getJSON();

        return json_encode($this->HomeModel->GetTaskDetails($requestJson->taskNo));
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
}
