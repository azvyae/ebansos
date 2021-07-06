<?php 
use Esubsidi\core\Database;

class UserModel {
    private $db, $table;
    public function __construct() {
        $this->table = 'user';
        $this->db = new Database;
    }

    public function getUserId($data)
    {
        $this->db->query("SELECT userId FROM {$this->table} WHERE userId = :userId");
        $this->db->bind('userId', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getUser($data)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE userId = :userId");
        $this->db->bind('userId', $data['userId']);
        $this->db->execute();
        return $this->db->single();
    }

    public function tambahUser($data)
    {
        $query =   "INSERT INTO {$this->table}
                    VALUES
                    (:userId, :nama, :password, :tipeAkun, :rw, :rt)";

        $this->db->query($query);
        $this->db->bind('userId', $data['userId']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('password', password_hash($data['password'],PASSWORD_ARGON2ID));
        $this->db->bind('tipeAkun', $data['tipeAkun']);
        $this->db->bind('rw', $data['rw']);
        $this->db->bind('rt', $data['rt']);
        $this->db->execute();

        return $this->db->rowCount(); 
    }
}

?>