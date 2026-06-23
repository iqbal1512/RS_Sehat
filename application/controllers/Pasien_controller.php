<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pasien_model');
        $this->load->model('Dokter_model');
        $this->load->model('Pendaftaran_model');

        if (!$this->session->userdata('pasien_logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $pasien_id = $this->session->userdata('pasien_id');
        $data['pasien'] = $this->Pasien_model->get_by_id($pasien_id);
        $data['pendaftaran'] = $this->Pendaftaran_model->get_by_pasien($pasien_id, 5);

        $this->load->view('templates/pasien_header', $data);
        $this->load->view('templates/pasien_sidebar', $data);
        $this->load->view('pasien/home', $data);
        $this->load->view('templates/pasien_footer');
    }

    public function daftar()
    {
        $data['title'] = 'Formulir Pendaftaran';
        $data['dokter_list'] = $this->Dokter_model->get_all();

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('dokter_id', 'Dokter Spesialis', 'required|numeric');
            $this->form_validation->set_rules('tanggal_kunjungan', 'Tanggal Kunjungan', 'required');
            $this->form_validation->set_rules('jam_kunjungan', 'Jam Kunjungan', 'required');
            $this->form_validation->set_rules('keluhan', 'Keluhan', 'required|trim');

            if ($this->form_validation->run() === TRUE) {
                $pendaftaran = [
                    'pasien_id'       => $this->session->userdata('pasien_id'),
                    'dokter_id'       => $this->input->post('dokter_id', TRUE),
                    'keluhan'         => $this->input->post('keluhan', TRUE),
                    'tanggal_kunjungan' => $this->input->post('tanggal_kunjungan'),
                    'jam_kunjungan'   => $this->input->post('jam_kunjungan'),
                    'status'          => 'menunggu'
                ];

                $this->Pendaftaran_model->insert($pendaftaran);
                $this->session->set_flashdata('success', 'Pendaftaran berhasil dikirim. Tunggu konfirmasi admin.');
                redirect('pasien/status');
            }
        }

        $this->load->view('templates/pasien_header', $data);
        $this->load->view('templates/pasien_sidebar', $data);
        $this->load->view('pasien/daftar', $data);
        $this->load->view('templates/pasien_footer');
    }

    public function status()
    {
        $data['title'] = 'Status Pendaftaran';
        $pasien_id = $this->session->userdata('pasien_id');
        $data['pendaftaran'] = $this->Pendaftaran_model->get_by_pasien($pasien_id);

        $this->load->view('templates/pasien_header', $data);
        $this->load->view('templates/pasien_sidebar', $data);
        $this->load->view('pasien/status', $data);
        $this->load->view('templates/pasien_footer');
    }

    public function detail($id)
    {
        $pasien_id = $this->session->userdata('pasien_id');
        $data['detail'] = $this->Pendaftaran_model->get_by_id_and_pasien($id, $pasien_id);

        if (!$data['detail']) {
            $this->session->set_flashdata('error', 'Data pendaftaran tidak ditemukan.');
            redirect('pasien/status');
        }

        $data['title'] = 'Detail Pendaftaran';

        $this->load->view('templates/pasien_header', $data);
        $this->load->view('templates/pasien_sidebar', $data);
        $this->load->view('pasien/detail', $data);
        $this->load->view('templates/pasien_footer');
    }
}
