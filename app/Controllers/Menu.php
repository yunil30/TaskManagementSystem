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

    public function GetListOfMenus() {
        return json_encode($this->MenuModel->GetListOfMenus());
    }

    public function GetActiveMenu() {
        return json_encode($this->MenuModel->GetActiveMenu());
    }

    public function GetMappedMenuByRole() {
        $requestJson = $this->postRequest->getJSON();

        return json_encode($this->MenuModel->GetMappedMenuByRole($requestJson->userRole));
    }

    public function GetMenuRecord() {
        $requestJson = $this->postRequest->getJSON();

        return json_encode($this->MenuModel->GetMenuRecord($requestJson->menuID));
    }

    public function SaveMenuMapping() {
        $requestJson = $this->postRequest->getJSON();

        $ValidateRoleMappedMenu = $this->MenuModel->ValidateRoleMappedMenu($requestJson->userRole);
        if ($ValidateRoleMappedMenu > 0) {
            return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'User role already mapped!']);
        }

        $menus = explode(',', $requestJson->roleMenus);

        foreach ($menus as $menuID) {
            $data = [
                'MenuID'    => intval($menuID), 
                'user_role' => $requestJson->userRole
            ];

            if (!$this->MenuModel->InsertData('tbl_menu_mapping', $data)) {
                return $this->response
                            ->setStatusCode(500)
                            ->setJSON(['error' => 'Menu could not be mapped.']);
            }
        }

        return $this->response
                    ->setStatusCode(200)
                    ->setJSON(['message' => 'Menu successfully mapped.']);
    }

    public function EditMenuMapping() {
        $requestJson = $this->postRequest->getJSON();

        $this->MenuModel->DeleteData(['user_role' => $requestJson->userRole], 'tbl_menu_mapping');

        $menus = explode(',', $requestJson->roleMenus);

        foreach ($menus as $menuID) {
            $data = [
                'MenuID'    => intval($menuID),   
                'user_role' => $requestJson->userRole
            ];

            if (!$this->MenuModel->InsertData('tbl_menu_mapping', $data)) {
                return $this->response
                            ->setStatusCode(500)
                            ->setJSON(['error' => 'Menu could not be updated.']);
            }
        }

        return $this->response
                    ->setStatusCode(200)
                    ->setJSON(['message' => 'Menu successfully updated.']);
    }

    public function CreateNewMenu() {
        $requestJson = $this->postRequest->getJSON();

        $data = [
            'menu_name'   => $requestJson->MenuName,
            'menu_page'   => $requestJson->MenuPage,
            'parent_menu' => $requestJson->ParentMenu,
            'menu_type'   => $requestJson->MenuType,
            'menu_index'  => $requestJson->MenuIndex
        ];

        if ($this->MenuModel->InsertData('tbl_user_menu', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'Menu successfully created.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'Menu could not be created.']);
        }
    }

    public function EditMenu() {
        $requestJson = $this->postRequest->getJSON();
        
        $fields = [
            'MenuID' => intval($requestJson->MenuID)
        ];

        $data = [
            'menu_name'   => $requestJson->MenuName,
            'menu_page'   => $requestJson->MenuPage,
            'parent_menu' => $requestJson->ParentMenu,
            'menu_type'   => $requestJson->MenuType,
            'menu_index'  => $requestJson->MenuIndex
        ];

        if ($this->MenuModel->UpdateData($fields, 'tbl_user_menu', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'Menu successfully updated.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'Menu could not be updated.']);
        }
    }

    public function RemoveMenu() {
        $requestJson = $this->postRequest->getJSON();
        
        $fields = [
            'MenuID' => intval($requestJson->MenuID)
        ];

        $data = [
            'menu_status' => 0,
        ];

        if ($this->MenuModel->UpdateData($fields, 'tbl_user_menu', $data)) {
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'Menu successfully removed.']);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'Menu could not be removed.']);
        }
    }
}
