<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController {
    private $postRequest;
    private $session;
    private $UserModel;

    public function __construct() {
        helper('utility_helpers');
        $this->postRequest = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->UserModel = new UserModel();
    }

    public function UpdateUserInfo() {
        $requestJson = $this->postRequest->getJSON();
        $UserID = $this->session->get('session_userno'); 

        $fields = [
            'UserID' => $UserID,
        ];

        $data = [
            'first_name'  => $requestJson->FirstName,
            'middle_name' => $requestJson->MiddleName,
            'last_name'   => $requestJson->LastName,
            'user_name'   => $requestJson->UserName,
            'user_email'  => $requestJson->UserEmail
        ];

        if ($this->UserModel->UpdateData($fields, 'tbl_user_access', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'User data successfully updated.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'User data could not be updated.']);
        }
    }

    public function GetUserInfo() {
        $UserID = $this->session->get('session_userno'); 
        
        return json_encode($this->UserModel->GetUserInfo($UserID));
    }
}
