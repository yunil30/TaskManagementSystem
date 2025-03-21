<?php

namespace App\Controllers;
use App\Models\LoginModel;

class Login extends BaseController {
    private $postRequest;
    private $encrypter;
    private $session;
    private $LoginModel;

	public function __construct() {
        helper('utility_helpers');
        $this->postRequest = \Config\Services::request();
        $this->encrypter = \Config\Services::encrypter();
        $this->session = \Config\Services::session();
		$this->LoginModel = new LoginModel();
	}

    public function Authenticate() {
        $requestJson = $this->postRequest->getJSON();

        $Username = $requestJson->UserName;
        $Password = hashPassword($requestJson->PassWord);

        $result = $this->LoginModel->LoginUser($Username, $Password);
        $count = count($result);

        if ($count == 0) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Invalid Username or Password!']);
    	} 

        $encryptedUsername = $this->encrypter->encrypt($requestJson->UserName);
        $encryptedPassword = $this->encrypter->encrypt($requestJson->PassWord);

        $this->response->setCookie('uname', $encryptedUsername, 7200); 
        $this->response->setCookie('pword', $encryptedPassword, 7200);

        $this->session->set('session_userno', $result[0]['UserNo']);
        $this->session->set('session_username', $result[0]['UserName']);
        $this->session->set('session_userrole', $result[0]['UserRole']);
        $this->session->set('session_password', $result[0]['UserPass']);
        
        return $this->response
                    ->setStatusCode(200)
                    ->setJSON(['message' => 'Login successful']);
    }
    
    public function Logout() {
        $this->session->destroy();

        $this->response->deleteCookie('uname');
        $this->response->deleteCookie('pword');
    
        return view('LoginForm');
    }

    public function GetMenu() {
        $userRole = $this->session->get('session_userrole'); 

        $menuData = $this->LoginModel->GetMenu($userRole);
    
        return $this->response->setJSON($menuData);
    }
}
