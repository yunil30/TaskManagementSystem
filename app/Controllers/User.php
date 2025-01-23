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

    public function EditUserInfo() {
        $requestJson = $this->postRequest->getJSON();
        $UserID = $this->session->get('session_userno'); 

        if (empty($requestJson->FirstName) || empty($requestJson->MiddleName) || empty($requestJson->LastName) || empty($requestJson->UserName)) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Missing required fields!']);
        }

        $ValidateUserName = $this->UserModel->ValidateUserName($requestJson->UserName);
        if($ValidateUserName > 0) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Username Already Exists!']);
        }

        $fields = [
            'UserID' => $UserID,
        ];

        $data = [
            'first_name'  => $requestJson->FirstName,
            'middle_name' => $requestJson->MiddleName,
            'last_name'   => $requestJson->LastName,
            'user_name'   => $requestJson->UserName,
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

    public function EditUserContacts() {
        $requestJson = $this->postRequest->getJSON();
        $UserID = $this->session->get('session_userno'); 

        if (empty($requestJson->UserEmail) || empty($requestJson->UserNumber)) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Missing required fields!']);
        }

        $ValidateUserEmail = $this->UserModel->ValidateUserEmail($requestJson->UserEmail);
        if($ValidateUserEmail > 0) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Email address Already Exists!']);
        }

        $ValidateUserEmail = $this->UserModel->ValidateUserNumber(intval($requestJson->UserNumber));
        if($ValidateUserEmail > 0) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Contact number Already Exists!']);
        }

        $fields = [
            'UserID' => $UserID,
        ];

        $data = [
            'user_email'  => $requestJson->UserEmail,
            'contact_number' => intval($requestJson->UserNumber)
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

    public function ChangePassword() {
        $requestJson = $this->postRequest->getJSON();
        $UserID = $this->session->get('session_userno'); 
        $UserName = $this->session->get('session_username');

        if (empty($requestJson->NewPassword)) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Missing required fields!']);
        }

        $fields = [
            'UserID'    => $UserID,
            'user_name' => $UserName
        ];

        $data = [
            'password' => sha1(md5($requestJson->NewPassword)),
        ];

        if ($this->UserModel->UpdateData($fields, 'tbl_user_access', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'Password changed successfully!']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'Password change failed!']);
        }
    }

    public function GetUserInfo() {
        $UserID = $this->session->get('session_userno'); 
        
        return json_encode($this->UserModel->GetUserInfo($UserID));
    }

}
