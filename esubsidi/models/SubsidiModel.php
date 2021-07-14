<?php 
use Esubsidi\core\Database;

class SubsidiModel {
    private $db, $table;
    public function __construct() {
        $this->table = 'tanggalterimasubsidi';
        $this->db = new Database;
    }

    public function tambahSubsidiBaru($data)
    {
        $query = "INSERT INTO {$this->table} VALUES (NULL, :date, :hashId, :jenisSubsidi)";
        $this->db->query($query);
        $this->db->bind('date', $data['date']);
        $this->db->bind('hashId', $data['hashId']);
        $this->db->bind('jenisSubsidi', $data['jenisSubsidi']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateSubsidi($data)
    {
        $query = "UPDATE {$this->table} SET tanggalMenerima = :date, jenisSubsidi = :jenisSubsidi WHERE hashId = :hashId";
        $this->db->query($query);
        $this->db->bind('date', $data['date']);
        $this->db->bind('hashId', $data['hashId']);
        $this->db->bind('jenisSubsidi', $data['jenisSubsidi']);
        $this->db->execute();
        return $this->db->rowCount();
    }
}

?>