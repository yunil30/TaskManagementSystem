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

    public function GetTaskUsers() {
        return json_encode($this->HomeModel->GetTaskUsers());
    }

    public function CreateTask() {
        $requestJson = $this->postRequest->getJSON();

        $data = [

        ];

        if ($this->HomeModel->InsertData('tbl_task_list', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'Data insertion success.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'Data insertion failed.']);
        }
    }
}
