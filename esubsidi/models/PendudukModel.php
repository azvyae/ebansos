<?php

use APP\core\Database as Database;

class PendudukModel {
    private $db, $table;
    public function __construct() {
        $this->table = 'penduduk';
        $this->db = new Database;
    }

    public function getPendudukByNikAndTanggal($data)
    {
        $this->db->query("SELECT nik, nama FROM {$this->table} WHERE nik = :nik AND tanggalLahir = :tanggalLahir");
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('tanggalLahir', $data['tanggalLahir']);
        $this->db->execute();
        return $this->db->single();
    }


}