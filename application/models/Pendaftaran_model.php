<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model
{
    protected $table = 'pendaftaran';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select('p.*, pas.nama AS nama_pasien, pas.nomor_telepon, pas.tanggal_lahir, pas.alamat AS alamat_pasien, d.nama AS nama_dokter, d.spesialis, d.jadwal_hari, d.jadwal_jam');
        $this->db->from($this->table . ' p');
        $this->db->join('pasien pas', 'pas.id = p.pasien_id', 'left');
        $this->db->join('dokter d', 'd.id = p.dokter_id', 'left');
        $this->db->order_by('p.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('p.*, pas.nama AS nama_pasien, pas.nomor_telepon, pas.tanggal_lahir, pas.alamat AS alamat_pasien, d.nama AS nama_dokter, d.spesialis, d.jadwal_hari, d.jadwal_jam');
        $this->db->from($this->table . ' p');
        $this->db->join('pasien pas', 'pas.id = p.pasien_id', 'left');
        $this->db->join('dokter d', 'd.id = p.dokter_id', 'left');
        $this->db->where('p.id', $id);
        return $this->db->get()->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_pasien($pasien_id, $limit = null)
    {
        $this->db->select('p.*, pas.nama AS nama_pasien, pas.nomor_telepon, pas.tanggal_lahir, pas.alamat AS alamat_pasien, d.nama AS nama_dokter, d.spesialis, d.jadwal_hari, d.jadwal_jam');
        $this->db->from($this->table . ' p');
        $this->db->join('pasien pas', 'pas.id = p.pasien_id', 'left');
        $this->db->join('dokter d', 'd.id = p.dokter_id', 'left');
        $this->db->where('p.pasien_id', $pasien_id);
        $this->db->order_by('p.created_at', 'DESC');
        if ($limit) {
            $this->db->limit($limit);
        }
        return $this->db->get()->result();
    }

    public function get_by_id_and_pasien($id, $pasien_id)
    {
        $this->db->select('p.*, pas.nama AS nama_pasien, pas.nomor_telepon, pas.tanggal_lahir, pas.alamat AS alamat_pasien, d.nama AS nama_dokter, d.spesialis, d.jadwal_hari, d.jadwal_jam');
        $this->db->from($this->table . ' p');
        $this->db->join('pasien pas', 'pas.id = p.pasien_id', 'left');
        $this->db->join('dokter d', 'd.id = p.dokter_id', 'left');
        $this->db->where('p.id', $id);
        $this->db->where('p.pasien_id', $pasien_id);
        return $this->db->get()->row();
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function count_by_status($status)
    {
        $this->db->where('status', $status);
        return $this->db->count_all_results($this->table);
    }

    public function get_monthly_stats()
    {
        $this->db->select("DATE_FORMAT(created_at, '%Y-%m') AS month", FALSE);
        $this->db->select('COUNT(*) AS total');
        $this->db->group_by('month');
        $this->db->order_by('month', 'ASC');
        return $this->db->get($this->table)->result();
    }

    public function update_status($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function get_jadwal($tanggal = null)
    {
        $this->db->select('p.*, pas.nama AS nama_pasien, pas.nomor_telepon, pas.tanggal_lahir, pas.alamat AS alamat_pasien, d.nama AS nama_dokter, d.spesialis, d.jadwal_hari, d.jadwal_jam');
        $this->db->from($this->table . ' p');
        $this->db->join('pasien pas', 'pas.id = p.pasien_id', 'left');
        $this->db->join('dokter d', 'd.id = p.dokter_id', 'left');

        if ($tanggal) {
            $this->db->where('p.tanggal_kunjungan', $tanggal);
        }

        $this->db->order_by('p.tanggal_kunjungan', 'ASC');
        return $this->db->get()->result();
    }

    public function get_report_data($start = null, $end = null)
    {
        $this->db->select('p.*, pas.nama AS nama_pasien, pas.nomor_telepon, pas.tanggal_lahir, pas.alamat AS alamat_pasien, d.nama AS nama_dokter, d.spesialis, d.jadwal_hari, d.jadwal_jam');
        $this->db->from($this->table . ' p');
        $this->db->join('pasien pas', 'pas.id = p.pasien_id', 'left');
        $this->db->join('dokter d', 'd.id = p.dokter_id', 'left');

        if ($start) {
            $this->db->where('p.created_at >=', $start . ' 00:00:00');
        }
        if ($end) {
            $this->db->where('p.created_at <=', $end . ' 23:59:59');
        }

        $this->db->order_by('p.created_at', 'DESC');
        return $this->db->get()->result();
    }
}
