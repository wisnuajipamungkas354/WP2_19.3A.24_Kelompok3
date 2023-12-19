<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MonitoringData extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MonitoringData_model');
    }

    // DATA LAPORAN //
    public function index()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_laporan'] = $this->MonitoringData_model->get_laporan();

        if ($this->input->post('keyword')) {
            $data['data_laporan'] = $this->MonitoringData_model->search_laporan();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('MonitoringData/index', $data);
        $this->load->view('templates/footer');
    }
    // END DATA LAPORAN //

    // DATA BARANG //
    public function barang()
    {
        $data['title'] = 'Komponen & Part';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_barang'] = $this->MonitoringData_model->get_barang();

        if ($this->input->post('keyword')) {
            $data['data_barang'] = $this->MonitoringData_model->search_barang();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('MonitoringData/barang', $data);
        $this->load->view('templates/footer');
    }

    public function barang_tambah()
    {
        $data['title'] = 'Tambah data barang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['no_faktur'] = $this->MonitoringData_model->auto_nofaktur();
        $data['id_part'] = $this->MonitoringData_model->auto_idPart();
        $data['data_supplier'] = $this->MonitoringData_model->get_supplier();

        $this->form_validation->set_rules('id_supplier', 'Supplier', 'required');
        $this->form_validation->set_rules('nm_part', 'Nama Barang', 'required');
        $this->form_validation->set_rules('harga_part', 'Harga', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('MonitoringData/barang_tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $part = [
                'id_part' => $this->input->post('id_part'),
                'nm_part' => $this->input->post('nm_part'),
                'stok' => $this->input->post('jumlah'),
                'harga_part' => $this->input->post('harga_part')
            ];
            $faktur = [
                'no_faktur' => $this->input->post('no_faktur'),
                'tgl' => Date('Y-m-d h:i:s'),
                'id_supplier' => $this->input->post('id_supplier'),
                'id_part' => $this->input->post('id_part'),
                'harga_part' => $this->input->post('harga_part'),
                'jumlah' => $this->input->post('jumlah'),
                'total_faktur' => $this->input->post('harga_part') * $this->input->post('jumlah')
            ];
            $this->db->insert('part', $part);
            $this->db->insert('faktur', $faktur);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Barang berhasil ditambahkan!</div>');
            redirect('MonitoringData/barang');
        }
    }

    public function barang_ubah($id)
    {
        $data['title'] = 'Ubah data barang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['no_faktur'] = $this->MonitoringData_model->auto_nofaktur();
        $data['ubah_barang'] = $this->MonitoringData_model->get_partId($id);
        $data['data_supplier'] = $this->MonitoringData_model->get_supplier();

        $this->form_validation->set_rules('id_supplier', 'Supplier', 'required');
        $this->form_validation->set_rules('nm_part', 'Nama Part', 'required');
        $this->form_validation->set_rules('harga_part', 'Harga', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('MonitoringData/barang_ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->MonitoringData_model->ubah_part();
            $faktur = [
                'no_faktur' => $this->input->post('no_faktur'),
                'tgl' => Date('Y-m-d h:i:s'),
                'id_supplier' => $this->input->post('id_supplier'),
                'id_part' => $this->input->post('id_part'),
                'harga_part' => $this->input->post('harga_part'),
                'jumlah' => $this->input->post('jumlah'),
                'total_faktur' => $this->input->post('harga_part') * $this->input->post('jumlah')
            ];
            $this->db->insert('faktur', $faktur);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data barang berhasil diperbarui!</div>');
            redirect('MonitoringData/barang');
        }
    }

    public function barang_hapus($id)
    {
        $this->MonitoringData_model->hapus_part($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Barang telah terhapus!</div>');
        redirect('MonitoringData/barang');
    }
    // END DATA BARANG //
}
