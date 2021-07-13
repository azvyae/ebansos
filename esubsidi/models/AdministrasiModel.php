<?php 
use Esubsidi\core\Database;

class AdministrasiModel {
    private $db, $table;
    public function __construct() {
        $this->table = 'administrasi';
        $this->db = new Database;
    }

    public function getStatusRegister()
    {
        $query = "SELECT registrasi FROM {$this->table} LIMIT 0, 1";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->single();
    }

    public function updateStatusRegister($data)
    {
        $query = "UPDATE {$this->table} SET registrasi=:statusRegistrasi WHERE id = 1";
        $this->db->query($query);
        $this->db->bind('statusRegistrasi', $data['statusRegistrasi']);
        $this->db->execute();
        return $this->db->rowCount();
    }
}

?>