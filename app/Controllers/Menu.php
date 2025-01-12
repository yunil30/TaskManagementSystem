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

    public function SaveMenuMapping() {
        $requestJson = $this->postRequest->getJSON();
        $menus = explode(',', $requestJson->roleMenus);

        foreach ($menus as $menu) {
            $data = [
                'MenuID'    => $menu,
                'user_role' => $requestJson->userRole
            ];

            $this->MenuModel->InsertData('tbl_menu_mapping', $data);
        }

        return $this->response
                    ->setStatusCode(200)
                    ->setJSON(['message' => 'Menu successfully added.']);
    }

}
