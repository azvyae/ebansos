<?php

use Esubsidi\core\Database;

class PendudukModel
{
    private $db, $table, $table2;
    public function __construct()
    {
        $this->table = 'penduduk';
        $this->table2 = 'tanggalterimasubsidi';
        $this->db = new Database;
    }

    public function getPenduduk($data)
    {
        if (!empty($data['nik']) && !empty($data['tanggalLahir'])) {
            $query = "SELECT nik, nama, alamatRumah, {$this->table2}.tanggalMenerima, {$this->table2}.jenisSubsidi FROM {$this->table} LEFT JOIN {$this->table2} ON {$this->table}.hashId = {$this->table2}.hashId  WHERE nik = :nik AND tanggalLahir = :tanggalLahir ORDER BY {$this->table2}.tanggalMenerima DESC LIMIT 0, 1";
            $this->db->query($query);
            $this->db->bind('nik', $data['nik']);
            $this->db->bind('tanggalLahir', $data['tanggalLahir']);
        } else {
            $query = "SELECT {$this->table}.*, {$this->table2}.tanggalMenerima, {$this->table2}.jenisSubsidi FROM {$this->table} LEFT JOIN {$this->table2} ON {$this->table}.hashId = {$this->table2}.hashId WHERE {$this->table}.hashId = :hashId ORDER BY {$this->table2}.tanggalMenerima DESC LIMIT 0, 1";
            $this->db->query($query);
            $this->db->bind('hashId', $data['hashId']);
        }
        $this->db->execute();
        return $this->db->single();
    }

    public function getNikArray($data)
    {
        if (!empty($data['rt'])) {
            $data['rw'] = $data['rw'];
            $data['rt'] = $data['rt'];
            $query = "SELECT nik FROM {$this->table} WHERE hashId = :hashId AND ( rt = :rt and rw = :rw )";
            $this->db->query($query);
            $this->db->bind('rw', $data['rw']);
            $this->db->bind('rt', $data['rt']);
        } else if (!empty($data['rw'])) {
            $data['rw'] = $data['rw'];
            $query = "SELECT nik FROM {$this->table} WHERE hashId = :hashId AND ( rw = :rw )";
            $this->db->query($query);
            $this->db->bind('rw', $data['rw']);
        } else {
            $query = "SELECT nik FROM {$this->table} WHERE hashId = :hashId";
            $this->db->query($query);
        }
        $this->db->bind('hashId', $data['hashId']);
        $this->db->execute();
        return $this->db->single();
    }

    public function cekNikSudahAda($data)
    {
        if (!empty($data['nik'])) {
            $query = "SELECT nik FROM {$this->table} WHERE nik = :nik LIMIT 0, 1";
            $this->db->query($query);
            $this->db->bind('nik', $data['nik']);
            $this->db->execute();
            return $this->db->rowCount();
        } else {
            return 0;
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

    public function getDataRW()
    {
        $query = "SELECT DISTINCT rw FROM {$this->table} ORDER BY rw ASC";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getDataRT($data)
    {
        $data['rw'] = $data['rw'];
        $query = "SELECT DISTINCT rt FROM {$this->table} where rw = :rw ORDER BY rt ASC";
        $this->db->query($query);
        $this->db->bind('rw', $data['rw']);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function hitungBarisDikueri($data)
    {
        if (!empty($data['rt'])) {
            $data['rw'] = $data['rw'];
            $data['rt'] = $data['rt'];
            $query = "SELECT nik FROM {$this->table} where ( rt = :rt and rw = :rw ) and ( nik LIKE :q or nama LIKE :q )";
            $this->db->query($query);
            $this->db->bind('rw', $data['rw']);
            $this->db->bind('rt', $data['rt']);
        } else if (!empty($data['rw'])) {
            $data['rw'] = $data['rw'];
            $query = "SELECT nik FROM {$this->table} where rw = :rw  and ( nik LIKE :q or nama LIKE :q )";
            $this->db->query($query);
            $this->db->bind('rw', $data['rw']);
        } else {
            $query = "SELECT nik FROM {$this->table} where  nik LIKE :q or nama LIKE :q ";
            $this->db->query($query);
        }
        $this->db->bind('q', '%' . $data['q'] . '%');
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDataPenduduk($data)
    {
        if (!empty($data['rt'])) {
            $data['rw'] = $data['rw'];
            $data['rt'] = $data['rt'];
            $query = "SELECT hashId, nik, nama, alamatRumah FROM {$this->table} where ( rt = :rt and rw = :rw ) and ( nik LIKE :q or nama LIKE :q ) ORDER BY nama LIMIT :halaman, 25";
            $this->db->query($query);
            $this->db->bind('rw', $data['rw']);
            $this->db->bind('rt', $data['rt']);
        } else if (!empty($data['rw'])) {
            $data['rw'] = $data['rw'];
            $query = "SELECT hashId, nik, nama, alamatRumah FROM {$this->table} where rw = :rw  and ( nik LIKE :q or nama LIKE :q ) ORDER BY nama LIMIT :halaman, 25";
            $this->db->query($query);
            $this->db->bind('rw', $data['rw']);
        } else {
            $query = "SELECT hashId, nik, nama, alamatRumah FROM {$this->table} where  nik LIKE :q or nama LIKE :q ORDER BY nama LIMIT :halaman, 25";
            $this->db->query($query);
        }
        $this->db->bind('halaman', $data['halaman']);
        $this->db->bind('q', '%' . $data['q'] . '%');
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function hapusDataPenduduk($data)
    {
        if (!empty($data['rt'])) {
            $data['rw'] = $data['rw'];
            $data['rt'] = $data['rt'];
            $query = "DELETE FROM {$this->table} WHERE hashId = :hashId AND ( rt = :rt and rw = :rw )";
            $this->db->query($query);
            $this->db->bind('rw', $data['rw']);
            $this->db->bind('rt', $data['rt']);
        } else if (!empty($data['rw'])) {
            $data['rw'] = $data['rw'];
            $query = "DELETE FROM {$this->table} WHERE hashId = :hashId AND ( rw = :rw )";
            $this->db->query($query);
            $this->db->bind('rw', $data['rw']);
        } else {
            $query = "DELETE FROM {$this->table} WHERE hashId = :hashId";
            $this->db->query($query);
        }
        $this->db->bind('hashId', $data['hashId']);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
