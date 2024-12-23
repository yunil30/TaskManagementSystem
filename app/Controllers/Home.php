<?php

namespace App\Controllers;

class Home extends BaseController {
    private $postRequest;
    private $session;

    public function __construct() {
        helper('utility_helpers');
        $this->postRequest = \Config\Services::request();
        $this->session = \Config\Services::session();
    }

    public function index(): string {
        return view('welcome_message');
    }
}
