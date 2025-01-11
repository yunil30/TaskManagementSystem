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

    public function GetActiveMenu() {
        return json_encode($this->MenuModel->GetActiveMenu());
    }
}
