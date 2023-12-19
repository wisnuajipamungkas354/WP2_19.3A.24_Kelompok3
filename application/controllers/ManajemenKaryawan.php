<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManajemenKaryawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ManajemenKaryawan_model');
    }

    // DATA USER //
    public function index()
    {
        $data['title'] = 'Pengguna';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['userasli'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_user'] = $this->ManajemenKaryawan_model->get_user();

        if ($this->input->post('keyword')) {
            $data['data_user'] = $this->ManajemenKaryawan_model->search_user();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('ManajemenKaryawan/index', $data);
        $this->load->view('templates/footer');
    }

    public function user_tambah()
    {
        $data['title'] = 'Tambah data pengguna';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('id_karyawan', 'ID Karyawan', 'required');
        $this->form_validation->set_rules('id_role', 'Role', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenKaryawan/user_tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $user = [
                'id_karyawan' => $this->input->post('id_karyawan'),
                'id_role' => $this->input->post('id_role'),
                'nm_karyawan' => $this->input->post('nm_karyawan'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'image' => 'default.svg',
                'status_akun' => $this->input->post('status_akun')
            ];
            $this->db->insert('user', $user);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pengguna berhasil ditambahkan!</div>');
            redirect('ManajemenKaryawan');
        }
    }

    public function karyawan_list()
    {
        $karyawan = $this->input->post('id_karyawan');
        $result = $this->ManajemenKaryawan_model->get_karyawanList($karyawan);
        foreach ($result as $row) {
            $data = [
                'nama' => $row->nm_karyawan
            ];
        }
        echo json_encode($data);
    }

    public function user_ubah($id)
    {
        $data['title'] = 'Ubah data pengguna';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['ubah_user'] = $this->ManajemenKaryawan_model->get_userId($id);
        $data['role'] = [1, 2];
        $data['status'] = ['Aktif', 'Tidak Aktif'];

        $this->form_validation->set_rules('id_karyawan', 'ID Karyawan', 'required');
        $this->form_validation->set_rules('id_role', 'Role', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenKaryawan/user_ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ManajemenKaryawan_model->ubah_user();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pengguna berhasil diperbarui!</div>');
            redirect('ManajemenKaryawan');
        }
    }

    public function user_hapus($id)
    {
        $db = new mysqli("localhost", "root", "", "db_servis");
        if ($db->errno == 0) {
            $this->ManajemenKaryawan_model->hapus_user($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pengguna telah terhapus!</div>');
            redirect('ManajemenKaryawan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenKaryawan');
        }
    }
    // END DATA USER //

    // DATA KARYAWAN //
    public function karyawan()
    {
        $data['title'] = 'Karyawan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_karyawan'] = $this->ManajemenKaryawan_model->get_karyawan();

        if ($this->input->post('keyword')) {
            $data['data_karyawan'] = $this->ManajemenKaryawan_model->search_karyawan();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('ManajemenKaryawan/karyawan', $data);
        $this->load->view('templates/footer');
    }

    public function karyawan_tambah()
    {
        $data['title'] = 'Tambah Data Karyawan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['id_karyawan'] = $this->ManajemenKaryawan_model->auto_idkaryawan();

        $this->form_validation->set_rules('nm_karyawan', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('noTlp', 'No. Telepon', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenKaryawan/karyawan_tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $karyawan = [
                'id_karyawan' => $this->input->post('id_karyawan'),
                'nm_karyawan' => $this->input->post('nm_karyawan'),
                'noHp_karyawan' => $this->input->post('noTlp'),
                'jabatan' => $this->input->post('jabatan')
            ];
            $this->db->insert('karyawan', $karyawan);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Karyawan berhasil ditambahkan!</div>');
            redirect('ManajemenKaryawan/karyawan');
        }
    }

    public function karyawan_ubah($id)
    {
        $data['title'] = 'Ubah Data Karyawan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['ubah_karyawan'] = $this->ManajemenKaryawan_model->get_karyawanId($id);
        $data['jabatan'] = ['Admin', 'Owner', 'Teknisi'];

        $this->form_validation->set_rules('nm_karyawan', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('noTlp', 'No. Telepon', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenKaryawan/karyawan_ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ManajemenKaryawan_model->ubah_karyawan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Karyawan berhasil diperbarui!</div>');
            redirect('ManajemenKaryawan/karyawan');
        }
    }

    public function karyawan_hapus($id)
    {
        $db = new mysqli("localhost", "root", "", "db_servis");
        if ($db->errno == 0) {
            $this->ManajemenKaryawan_model->hapus_karyawan($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Karyawan telah terhapus!</div>');
            redirect('ManajemenKaryawan/karyawan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenKaryawan/karyawan');
        }
    }
    // END DATA KARYAWAN //
}
