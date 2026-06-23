<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Controller
 * Handles login, register, and logout for Admin and Pasien
 */
class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Pasien_model');
    }

    /**
     * Default - redirect to login
     */
    public function index()
    {
        // If already logged in, redirect
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin');
        }
        if ($this->session->userdata('pasien_logged_in')) {
            redirect('pasien');
        }
        redirect('auth/login');
    }

    /**
     * Login page - handles both admin and pasien login
     */
    public function login()
    {
        // If already logged in, redirect
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin');
        }
        if ($this->session->userdata('pasien_logged_in')) {
            redirect('pasien');
        }

        $this->load->view('auth/login');
    }

    /**
     * Admin login page
     */
    public function admin_login()
    {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin');
        }
        if ($this->session->userdata('pasien_logged_in')) {
            redirect('pasien');
        }

        $this->load->view('auth/admin_login');
    }

    /**
     * Pasien login submit handler
     */
    public function login_process()
    {
        if ($this->input->method() !== 'post') {
            redirect('auth/login');
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password');

        $pasien = $this->Pasien_model->get_by_username($username);
        if ($pasien && password_verify($password, $pasien->password)) {
            $this->session->set_userdata([
                'pasien_id'        => $pasien->id,
                'pasien_username'  => $pasien->username,
                'pasien_nama'      => $pasien->nama,
                'pasien_logged_in' => TRUE
            ]);
            redirect('pasien');
        }

        $this->session->set_flashdata('error', 'Username atau password pasien salah!');
        redirect('auth/login');
    }

    /**
     * Admin login submit handler
     */
    public function admin_login_process()
    {
        if ($this->input->method() !== 'post') {
            redirect('auth/admin_login');
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password');

        $admin = $this->Admin_model->get_by_username($username);
        if ($admin && password_verify($password, $admin->password)) {
            $this->session->set_userdata([
                'admin_id'        => $admin->id,
                'admin_username'  => $admin->username,
                'admin_nama'      => $admin->nama,
                'admin_logged_in' => TRUE
            ]);
            redirect('admin');
        }

        $this->session->set_flashdata('error', 'Username atau password admin salah!');
        redirect('auth/admin_login');
    }

    /**
     * Register page - pasien only
     */
    public function register()
    {
        if ($this->session->userdata('pasien_logged_in')) {
            redirect('pasien');
        }

        $this->load->view('auth/register');
    }

    /**
     * Pasien registration submit handler
     */
    public function register_process()
    {
        if ($this->input->method() !== 'post') {
            redirect('auth/register');
        }

        if ($this->session->userdata('pasien_logged_in')) {
            redirect('pasien');
        }

        // Validation rules
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'required|trim|numeric');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|is_unique[pasien.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() === TRUE) {
            $data = [
                'nama'           => $this->input->post('nama', TRUE),
                'tanggal_lahir'  => $this->input->post('tanggal_lahir'),
                'alamat'         => $this->input->post('alamat', TRUE),
                'nomor_telepon'  => $this->input->post('nomor_telepon', TRUE),
                'username'       => $this->input->post('username', TRUE),
                'password'       => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            ];

            $this->Pasien_model->insert($data);
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('auth/login');
        }

        $this->load->view('auth/register');
    }

    /**
     * Logout - destroy session
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
