<?php

use APP\core\Database as Database;

class UserModel {
    private $db, $table;
    public function __construct() {
        $this->table = 'mahasiswa';
        $this->db = new Database;
    }


}