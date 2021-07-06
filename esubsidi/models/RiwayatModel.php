<?php

use Esubsidi\core\Database;

class RiwayatModel
{
    private $db, $table, $table2;
    public function __construct()
    {
        $this->table = 'riwayat';
        $this->db = new Database;
    }

    public function hitungRiwayat()
    {
        $query =   "SELECT id FROM {$this->table} ORDER BY timestamp ASC";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusRiwayatTerakhir()
    {
        $query = "DELETE FROM riwayat WHERE id IN (
                    SELECT * FROM (
                        SELECT id FROM riwayat ORDER BY timestamp ASC LIMIT 1
                    ) as sorted
                )";
        $this->db->query($query);
        $this->db->execute();
    }

    public function tambahRiwayat($data)
    {
        $query =   "INSERT INTO {$this->table}
                    VALUES
                    (null, :datetime ,:userId, :aksi, :nikDipengaruhi)";

        $this->db->query($query);
        $this->db->bind('datetime', $data['datetime']);
        $this->db->bind('userId', $data['userId']);
        $this->db->bind('aksi', $data['aksi']);
        $this->db->bind('nikDipengaruhi', $data['nikDipengaruhi']);
        $this->db->execute();
        $GLOBALS['notif'] = 1;
    }

    public function getRiwayat($data)
    {
        $query = "SELECT * FROM {$this->table} ORDER BY timestamp DESC LIMIT 0, :data";
        $this->db->query($query);
        $this->db->bind('data', $data);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getAllRiwayat($data)
    {
        $query = "SELECT {$this->table}.*, {$this->table2}.tanggalMenerima, {$this->table2}.jenisSubsidi FROM {$this->table} LEFT JOIN {$this->table2} ON {$this->table}.hashId = {$this->table2}.hashId WHERE {$this->table}.hashId = :hashId ORDER BY {$this->table2}.tanggalMenerima DESC LIMIT 0, 1";
        $this->db->query($query);
        $this->db->bind('hashId', $data['hashId']);
        $this->db->execute();
        return $this->db->resultSet();
    }
}
