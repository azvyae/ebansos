<?php 
use Ebansos\core\Database;

class BansosModel {
    private $db, $table;
    public function __construct() {
        $this->table = 'tanggalterimabansos';
        $this->db = new Database;
    }

    public function tambahBansosBaru($data)
    {
        $query = "INSERT INTO {$this->table} VALUES (NULL, :date, :hashId, :jenisBansos)";
        $this->db->query($query);
        $this->db->bind('date', $data['date']);
        $this->db->bind('hashId', $data['hashId']);
        $this->db->bind('jenisBansos', $data['jenisBansos']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateBansos($data)
    {
        $query = "UPDATE {$this->table} SET tanggalMenerima = :date, jenisBansos = :jenisBansos WHERE hashId = :hashId";
        $this->db->query($query);
        $this->db->bind('date', $data['date']);
        $this->db->bind('hashId', $data['hashId']);
        $this->db->bind('jenisBansos', $data['jenisBansos']);
        $this->db->execute();
        return $this->db->rowCount();
    }
}

?>