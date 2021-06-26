<?php

use Esubsidi\core\Database;

class PendudukModel
{
    private $db, $table;
    public function __construct()
    {
        $this->table = 'penduduk';
        $this->db = new Database;
    }

    public function getPendudukByNikAndTanggal($data)
    {
        $this->db->query("SELECT nik, nama, alamatRumah FROM {$this->table} WHERE nik = :nik AND tanggalLahir = :tanggalLahir");
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('tanggalLahir', $data['tanggalLahir']);
        $this->db->execute();
        return $this->db->single();
    }

    public function __call($name, $arg)
    {
        if ($name == 'getDataPenduduk') {
            switch (count($arg)) {
                case 1:
                    if (isset($_SESSION['user']['rw'])) {
                        $this->db->query("SELECT hashId, nik, nama, alamatRumah FROM {$this->table} where rw = :rw ORDER BY nama ASC");
                        $this->db->bind('rw', $arg[0]);
                        $this->db->execute();
                        return $this->db->resultSet();
                    } else {
                        $this->db->query("SELECT hashId, nik, nama, alamatRumah FROM {$this->table} where nik LIKE :q or nama LIKE :q ORDER BY nama ASC");
                        $this->db->bind('q', '%' . $arg[0] . '%');
                        $this->db->execute();
                        return $this->db->resultSet();
                    }
                    break;
                case 2:
                    if (isset($_SESSION['user']['rt'])) {
                        $this->db->query("SELECT hashId, nik, nama, alamatRumah FROM {$this->table} WHERE rt = :rt and rw = :rw ORDER BY nama ASC");
                        $this->db->bind('rw', $arg[0]);
                        $this->db->bind('rt', $arg[1]);
                        $this->db->execute();
                        return $this->db->resultSet();
                    } else {
                        $this->db->query("SELECT hashId, nik, nama, alamatRumah FROM {$this->table} where rw = :rw and ( nik like :q or nama like :q )  ORDER BY nama ASC");
                        $this->db->bind('q', '%' . $arg[0] . '%');
                        $this->db->bind('rw', $arg[1]);
                        $this->db->execute();
                        return $this->db->resultSet();
                    }
                    break;
                case 3:
                    $this->db->query("SELECT hashId, nik, nama, alamatRumah FROM {$this->table} where ( rt = :rt and rw = :rw ) and ( nik LIKE :q or nama LIKE :q ) ORDER BY nama ASC");
                    $this->db->bind('q', '%' . $arg[0] . '%');
                    $this->db->bind('rw', $arg[1]);
                    $this->db->bind('rt', $arg[2]);
                    $this->db->execute();
                    return $this->db->resultSet();
                    break;
                default:
                    $this->db->query("SELECT hashId, nik, nama, alamatRumah FROM {$this->table} ORDER BY nama ASC");
                    $this->db->execute();
                    return $this->db->resultSet();
                    break;
            }
        }
    }


    public function tambahDataPenduduk($data)
    {
        $query =   "INSERT INTO {$this->table}
                    VALUES
                    (:hashId, :nik, :nama, :tempatLahir, :tanggalLahir, :jenisKelamin, :alamatRumah, :rt, :rw, :kelurahan, :kecamatan, :statusPerkawinan, :pekerjaan)";

        $this->db->query($query);
        $this->db->bind('hashId', $data['hashId']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('tempatLahir', $data['tempatLahir']);
        $this->db->bind('tanggalLahir', $data['tanggalLahir']);
        $this->db->bind('jenisKelamin', $data['jenisKelamin']);
        $this->db->bind('alamatRumah', $data['alamatRumah']);
        $this->db->bind('rt', $data['rt']);
        $this->db->bind('rw', $data['rw']);
        $this->db->bind('kelurahan', $data['kelurahan']);
        $this->db->bind('kecamatan', $data['kecamatan']);
        $this->db->bind('statusPerkawinan', $data['statusPerkawinan']);
        $this->db->bind('pekerjaan', $data['pekerjaan']);


        $this->db->execute();

        return $this->db->rowCount();
    }
}
