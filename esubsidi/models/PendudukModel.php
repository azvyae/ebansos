<?php

use APP\core\Database as Database;

class PendudukModel {
    private $db, $table;
    public function __construct() {
        $this->table = 'penduduk';
        $this->db = new Database;
    }

    public function getPendudukByNikDanTanggal($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id=:id");
        $this->db->bind('id', $id);
        return $this->db->rowCount();
    }


}