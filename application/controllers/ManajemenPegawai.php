<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManajemenPegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ManajemenPegawai_model');
    }

    // DATA USER //
    public function index()
    {
        $data['title'] = 'Pengguna';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_user'] = $this->ManajemenPegawai_model->get_user();

        if ($this->input->post('keyword')) {
            $data['data_user'] = $this->ManajemenPegawai_model->search_user();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ManajemenPegawai/index', $data);
        $this->load->view('templates/footer');
    }

    public function user_tambah()
    {
        $data['title'] = 'Tambah data pengguna';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('id_pegawai', 'ID Pegawai', 'required');
        $this->form_validation->set_rules('id_role', 'Role', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenPegawai/user_tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $user = [
                'id_pegawai' => $this->input->post('id_pegawai'),
                'id_role' => $this->input->post('id_role'),
                'nama_pegawai' => $this->input->post('nm_pegawai'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'image' => 'default.svg',
                'status_akun' => $this->input->post('status_akun')
            ];
            $this->db->insert('user', $user);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pengguna berhasil ditambahkan!</div>');
            redirect('ManajemenPegawai');
        }
    }

    public function pegawai_list()
    {
        $pegawai = $this->input->post('id_pegawai');
        $result = $this->ManajemenPegawai_model->get_pegawaiList($pegawai);
        foreach ($result as $row) {
            $data = [
                'nama' => $row->nm_pegawai
            ];
        }
        echo json_encode($data);
    }

    public function user_ubah($id)
    {
        $data['title'] = 'Ubah data pengguna';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['ubah_user'] = $this->ManajemenPegawai_model->get_userId($id);
        $data['role'] = [1, 2];
        $data['status'] = ['Aktif', 'Tidak Aktif'];

        $this->form_validation->set_rules('id_pegawai', 'ID Pegawai', 'required');
        $this->form_validation->set_rules('id_role', 'Role', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenPegawai/user_ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ManajemenPegawai_model->ubah_user();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pengguna berhasil diperbarui!</div>');
            redirect('ManajemenPegawai');
        }
    }

    public function user_hapus($id)
    {
        $db = new mysqli("localhost", "root", "", "db_bengkel");
        if ($db->errno == 0) {
            $this->ManajemenPegawai_model->hapus_user($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pengguna telah terhapus!</div>');
			redirect('ManajemenPegawai');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenPegawai');
        }
    }
    // END DATA USER //

    // DATA PEGAWAI //
    public function pegawai()
    {
        $data['title'] = 'Pegawai';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_pegawai'] = $this->ManajemenPegawai_model->get_pegawai();

        if ($this->input->post('keyword')) {
            $data['data_pegawai'] = $this->ManajemenPegawai_model->search_pegawai();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ManajemenPegawai/pegawai', $data);
        $this->load->view('templates/footer');
    }

    public function pegawai_tambah()
    {
        $data['title'] = 'Tambah data pegawai';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['id_pegawai'] = $this->ManajemenPegawai_model->auto_idpegawai();

        $this->form_validation->set_rules('nm_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('noTlp', 'No. Telepon', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenPegawai/pegawai_tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $pegawai = [
                'id_pegawai' => $this->input->post('id_pegawai'),
                'nm_pegawai' => $this->input->post('nm_pegawai'),
                'noTlp_pegawai' => $this->input->post('noTlp'),
                'jabatan' => $this->input->post('jabatan')
            ];
            $this->db->insert('pegawai', $pegawai);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pegawai berhasil ditambahkan!</div>');
            redirect('ManajemenPegawai/pegawai');
        }
    }

    public function pegawai_ubah($id)
    {
        $data['title'] = 'Ubah data pegawai';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['ubah_pegawai'] = $this->ManajemenPegawai_model->get_pegawaiId($id);
        $data['jabatan'] = ['Admin', 'Manajer', 'Mekanik'];

        $this->form_validation->set_rules('nm_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('noTlp', 'No. Telepon', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenPegawai/pegawai_ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ManajemenPegawai_model->ubah_pegawai();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pegawai berhasil diperbarui!</div>');
            redirect('ManajemenPegawai/pegawai');
        }
    }

    public function pegawai_hapus($id)
    {
        $db = new mysqli("localhost", "root", "", "db_bengkel");
        if ($db->errno == 0) {
            $this->ManajemenPegawai_model->hapus_pegawai($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pegawai telah terhapus!</div>');
			redirect('ManajemenPegawai/pegawai');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenPegawai/pegawai');
        }
    }
    // END DATA PEGAWAI //
}
