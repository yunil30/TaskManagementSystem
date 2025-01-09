<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model {
    protected $db;
    protected $str;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }

}
