<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Pasien_model');
        $this->load->model('Dokter_model');
        $this->load->model('Pendaftaran_model');

        if (!$this->session->userdata('admin_logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['total_pasien']     = $this->Pasien_model->count_all();
        $data['total_pendaftaran'] = $this->Pendaftaran_model->count_all();
        $data['total_menunggu']   = $this->Pendaftaran_model->count_by_status('menunggu');
        $data['total_disetujui']  = $this->Pendaftaran_model->count_by_status('disetujui');
        $data['total_ditolak']    = $this->Pendaftaran_model->count_by_status('ditolak');
        $data['pendaftaran_terbaru'] = $this->Pendaftaran_model->get_all();
        $data['monthly_stats']    = $this->Pendaftaran_model->get_monthly_stats();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/admin_footer');
    }

    public function pasien()
    {
        $data['title'] = 'Kelola Data Pasien';
        $data['pasien_list'] = $this->Pasien_model->get_all();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('admin/pasien/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah_pasien()
    {
        $data['title'] = 'Tambah Pasien';

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
            $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
            $this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'required|trim');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[pasien.username]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

            if ($this->form_validation->run() === TRUE) {
                $insert = [
                    'nama'          => $this->input->post('nama', TRUE),
                    'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                    'alamat'        => $this->input->post('alamat', TRUE),
                    'nomor_telepon' => $this->input->post('nomor_telepon', TRUE),
                    'username'      => $this->input->post('username', TRUE),
                    'password'      => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
                ];
                $this->Pasien_model->insert($insert);
                $this->session->set_flashdata('success', 'Data pasien berhasil ditambahkan.');
                redirect('admin/pasien');
            }
        }

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('admin/pasien/create', $data);
        $this->load->view('templates/admin_footer');
    }

    public function edit_pasien($id)
    {
        $data['title'] = 'Edit Pasien';
        $data['pasien'] = $this->Pasien_model->get_by_id($id);

        if (!$data['pasien']) {
            $this->session->set_flashdata('error', 'Data pasien tidak ditemukan.');
            redirect('admin/pasien');
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
            $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
            $this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'required|trim');

            if ($this->form_validation->run() === TRUE) {
                $update = [
                    'nama'          => $this->input->post('nama', TRUE),
                    'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                    'alamat'        => $this->input->post('alamat', TRUE),
                    'nomor_telepon' => $this->input->post('nomor_telepon', TRUE)
                ];

                $new_password = $this->input->post('password');
                if (!empty($new_password)) {
                    $update['password'] = password_hash($new_password, PASSWORD_BCRYPT);
                }

                $this->Pasien_model->update($id, $update);
                $this->session->set_flashdata('success', 'Data pasien berhasil diperbarui.');
                redirect('admin/pasien');
            }
        }

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('admin/pasien/edit', $data);
        $this->load->view('templates/admin_footer');
    }

    public function hapus_pasien($id)
    {
        $pasien = $this->Pasien_model->get_by_id($id);
        if (!$pasien) {
            $this->session->set_flashdata('error', 'Data pasien tidak ditemukan.');
        } else {
            $this->Pasien_model->delete($id);
            $this->session->set_flashdata('success', 'Data pasien berhasil dihapus.');
        }
        redirect('admin/pasien');
    }

    public function pendaftaran()
    {
        $data['title'] = 'Kelola Pendaftaran';
        $data['pendaftaran_list'] = $this->Pendaftaran_model->get_all();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('admin/pendaftaran/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function detail_pendaftaran($id)
    {
        $data['title'] = 'Detail Pendaftaran';
        $data['detail'] = $this->Pendaftaran_model->get_by_id($id);

        if (!$data['detail']) {
            $this->session->set_flashdata('error', 'Data pendaftaran tidak ditemukan.');
            redirect('admin/pendaftaran');
        }

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('admin/pendaftaran/detail', $data);
        $this->load->view('templates/admin_footer');
    }

    public function setujui($id)
    {
        $catatan = $this->input->post('catatan_admin', TRUE);
        $this->Pendaftaran_model->update_status($id, [
            'status'        => 'disetujui',
            'catatan_admin' => $catatan
        ]);
        $this->session->set_flashdata('success', 'Pendaftaran berhasil disetujui.');
        redirect('admin/pendaftaran');
    }

    public function tolak($id)
    {
        $catatan = $this->input->post('catatan_admin', TRUE);
        $this->Pendaftaran_model->update_status($id, [
            'status'        => 'ditolak',
            'catatan_admin' => $catatan
        ]);
        $this->session->set_flashdata('success', 'Pendaftaran berhasil ditolak.');
        redirect('admin/pendaftaran');
    }

    public function jadwal()
    {
        $data['title'] = 'Jadwal Pendaftaran';
        $tanggal = $this->input->get('tanggal');
        $data['filter_tanggal'] = $tanggal;
        $data['jadwal_list'] = $this->Pendaftaran_model->get_jadwal($tanggal);

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('admin/jadwal', $data);
        $this->load->view('templates/admin_footer');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan & Statistik';
        $start = $this->input->get('start_date');
        $end   = $this->input->get('end_date');
        $data['start_date'] = $start;
        $data['end_date']   = $end;
        $data['report_data'] = $this->Pendaftaran_model->get_report_data($start, $end);
        $data['total_pasien']     = $this->Pasien_model->count_all();
        $data['total_mendaftar']  = $this->Pendaftaran_model->count_all();
        $data['total_disetujui']  = $this->Pendaftaran_model->count_by_status('disetujui');
        $data['total_ditolak']    = $this->Pendaftaran_model->count_by_status('ditolak');

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('templates/admin_footer');
    }

    public function export_csv()
    {
        $start = $this->input->get('start_date');
        $end   = $this->input->get('end_date');
        $data  = $this->Pendaftaran_model->get_report_data($start, $end);

        $filename = 'laporan_pendaftaran_' . date('Y-m-d_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

       fputcsv(
    $output,
    ['No', 'Nama Pasien', 'No. Telepon', 'Dokter', 'Spesialis', 'Keluhan', 'Tgl Kunjungan', 'Jam', 'Status', 'Catatan Admin', 'Tgl Daftar'],
    ';'
);

        $no = 1;
        foreach ($data as $row) {
            fputcsv($output, [
                $no++,
                $row->nama_pasien,
                $row->nomor_telepon,
                $row->nama_dokter,
                $row->spesialis,
                $row->keluhan,
                date('d-m-Y', strtotime($row->tanggal_kunjungan)),
            date('H:i', strtotime($row->jam_kunjungan)),
            date('d-m-Y H:i', strtotime($row->created_at))
                        ]);
        }

      fputcsv($output, [
    $no++,
    $row->nama_pasien,
    $row->nomor_telepon,
    $row->nama_dokter,
    $row->spesialis,
    $row->keluhan,
    date('d-m-Y', strtotime($row->tanggal_kunjungan)),
    date('H:i', strtotime($row->jam_kunjungan)),
    ucfirst($row->status),
    $row->catatan_admin,
    date('d-m-Y H:i', strtotime($row->created_at))
], ';');
    }

    public function export_pdf()
    {
        $start = $this->input->get('start_date');
        $end   = $this->input->get('end_date');
        $data['report_data'] = $this->Pendaftaran_model->get_report_data($start, $end);
        $data['start_date']  = $start;
        $data['end_date']    = $end;
        $data['title']       = 'Laporan Pendaftaran Pasien';

        $this->load->view('admin/laporan_pdf', $data);
    }
}
