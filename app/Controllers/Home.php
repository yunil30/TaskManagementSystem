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

    public function Testing() {
        var_dump('Hello World');
        return false;
    }
}
