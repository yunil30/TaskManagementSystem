<?php

namespace App\Controllers;
use App\Models\MenuModel;

class Menu extends BaseController {
    private $postRequest;
    private $session;
    private $MenuModel;

    public function __construct() {
        helper('utility_helpers');
        $this->postRequest = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->MenuModel = new MenuModel();
    }
    
    public function GetListOfMappedMenu() {
        return json_encode($this->MenuModel->GetListOfMappedMenu());
    }

    public function GetActiveMenu() {
        return json_encode($this->MenuModel->GetActiveMenu());
    }

    public function GetMappedMenuByRole() {
        $requestJson = $this->postRequest->getJSON();

        return json_encode($this->MenuModel->GetMappedMenuByRole($requestJson->userRole));
    }

    public function SaveMenuMapping() {
        $requestJson = $this->postRequest->getJSON();

        $ValidateRoleMappedMenu = $this->MenuModel->ValidateRoleMappedMenu($requestJson->userRole);
        if($ValidateRoleMappedMenu > 0) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'User role already mapped!']);
        }

        if (is_string($requestJson->roleMenus)) {
            $menus = explode(',', $requestJson->roleMenus); 
        }
        
        $menusJson = json_encode($menus);
    
        $data = [
            'MenuID'    => $menusJson,  
            'user_role' => $requestJson->userRole
        ];

        if ($this->MenuModel->InsertData('tbl_menu_mapping', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'Menu successfully mapped.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'Menu could not be mapped.']);
        }
    }

    public function EditMenuMapping() {
        $requestJson = $this->postRequest->getJSON();

        if (is_string($requestJson->roleMenus)) {
            $menus = explode(',', $requestJson->roleMenus); 
        }

        $menusJson = json_encode($menus);

        $fields = [
            'user_role' => $requestJson->userRole
        ];

        $data = [
            'MenuID'    => $menusJson,  
            'user_role' => $requestJson->userRole
        ];

        if ($this->MenuModel->UpdateData($fields, 'tbl_menu_mapping', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'Menu successfully updated.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'Menu could not be updated.']);
        }
    }
}
