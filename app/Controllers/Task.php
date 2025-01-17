<?php

namespace App\Controllers;
use App\Models\Taskmodel;

class Task extends BaseController {
    private $postRequest;
    private $session;
    private $Taskmodel;

    public function __construct() {
        helper('utility_helpers');
        $this->postRequest = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->Taskmodel = new Taskmodel();
    }

    public function GetCompletedTaskList() {
        $UserID = $this->session->get('session_userno'); 
        
        return json_encode($this->Taskmodel->GetCompletedTaskList($UserID));
    }
    
    public function GetTaskDetails() {
        $requestJson = $this->postRequest->getJSON();

        return json_encode($this->Taskmodel->GetTaskDetails($requestJson->taskNo));
    }
}
