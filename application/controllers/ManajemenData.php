<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManajemenData extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ManajemenData_model');
        $this->load->library('pdf');
    }

    // DATA SERVICE //
    public function index()
    {
        $data['title'] = 'Servis';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_servis'] = $this->ManajemenData_model->get_servis();

        if ($this->input->post('keyword')) {
            $data['data_servis'] = $this->ManajemenData_model->search_servis();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('ManajemenData/index', $data);
        $this->load->view('templates/footer');
    }

    public function servis_tambah()
    {
        $data['title'] = 'Tambah data servis';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['id_servis'] = $this->ManajemenData_model->auto_idservis();
        $data['id_pelanggan'] = $this->ManajemenData_model->auto_idpelanggan();
        $data['part'] = $this->ManajemenData_model->get_part();

        $this->form_validation->set_rules('nm_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('no_hp', 'No. Telepon', 'required');
        $this->form_validation->set_rules('tipe_laptop', 'Merk & Tipe Laptop', 'required');
        $this->form_validation->set_rules('keluhan_awal', 'Keluhan', 'required');
        $this->form_validation->set_rules('nm_teknisi', 'Nama Teknisi', 'required');
        // $this->form_validation->set_rules('nm_part', 'List Rekomendasi Servis', 'required');
        // $this->form_validation->set_rules('id_brg', 'ID Barang', 'required');
        // $this->form_validation->set_rules('nm_brg', 'Nama Barang', 'required');
        // $this->form_validation->set_rules('harga', 'Harga', 'required');
        // $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/servis_tambah', $data);
            $this->load->view('templates/footer');
        } else {

            $pelanggan = [
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'nm_pelanggan' => $this->input->post('nm_pelanggan'),
                'no_hp' => $this->input->post('no_hp')
            ];
            $this->db->insert('pelanggan', $pelanggan);

            $idPart = $this->input->post('id_part[]');
            $nmPart = $this->input->post('nm_part[]');
            $harga = $this->input->post('harga[]');
            if ($idPart == null) {
                redirect('ManajemenData/servis_tambah');
            } else {
                $detailServis = array();
                for ($i = 0; $i < count($idPart); $i++) {
                    $detailServis[$i] = array(
                        'id_servis' => $this->input->post('id_servis'),
                        'id_part' => $idPart[$i],
                        'nm_part' => $nmPart[$i],
                        'harga' => $harga[$i]
                    );
                }
                $this->db->insert_batch('detail_servis', $detailServis);

                $biaya = array_sum($harga);
                $this->db->set('id_servis', $this->input->post('id_servis'));
                $this->db->set('tgl', Date('Y-m-d H:i:s'));
                $this->db->set('id_pelanggan', $this->input->post('id_pelanggan'));
                $this->db->set('nm_pelanggan', $this->input->post('nm_pelanggan'));
                $this->db->set('no_hp', $this->input->post('no_hp'));
                $this->db->set('tipe_laptop', $this->input->post('tipe_laptop'));
                $this->db->set('keluhan_awal', $this->input->post('keluhan_awal'));
                $this->db->set('nm_teknisi', $this->input->post('nm_teknisi'));
                $this->db->set('total_harga', $biaya);
                $this->db->insert('servis');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Servis berhasil ditambahkan!</div>');
                redirect('ManajemenData');
            }
        }
    }

    public function servis_ekspor($id)
    {
        $db = new mysqli("localhost", "root", "", "db_servis");
        if ($db->errno == 0) {
            $servis = $this->ManajemenData_model->get_servisId($id);
            $pdf = new FPDF('P', 'mm', 'Letter');
            $pdf->AddPage();

            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 10, 'RIWAYAT SERVIS', 0, 1, 'C');
            $pdf->Cell(0, 5, 'WISNU-TECH', 0, 1, 'C');
            $pdf->Image('assets/img/login/ahayy-rounded.png', 10, 10, -300);
            $pdf->Cell(0, 7, '', 0, 1);

            $pdf->Line(10, 30, 200, 30);
            $pdf->Ln(5);
            $pdf->SetFont('Arial', '', 11);

            $pdf->Cell(30, 10, 'ID Pelanggan', 0, 0);
            $pdf->Cell(90, 10, ' : ' . $servis['id_pelanggan'], 0, 0);
            $pdf->Cell(30, 10, 'ID Servis', 0, 0,);
            $pdf->Cell(90, 10, ' : ' . $servis['id_servis'], 0, 1);
            $pdf->Cell(30, 10, 'Nama Pelanggan', 0, 0);
            $pdf->Cell(90, 10, ' : ' . $servis['nm_pelanggan'], 0, 0);
            $pdf->Cell(30, 10, 'Tanggal', 0, 0);
            $pdf->Cell(30, 10, ' : ' . $servis['tgl'], 0, 1);
            $pdf->Cell(30, 10, 'No. Telepon', 0, 0);
            $pdf->Cell(90, 10, ' : ' . $servis['no_hp'], 0, 0);
            $pdf->Cell(30, 10, 'Nama Teknisi', 0, 0);
            $pdf->Cell(50, 10, ' : ' . $servis['nm_teknisi'], 0, 1);

            // $pdf->Ln(5);
            // $pdf->Cell(30, 10, ' : ' . $servis['id_part'], 0, 1);

            // $pdf->Cell(30, 10, ' : ' . $servis['nm_part'], 0, 1);

            // $pdf->Cell(30, 10, 'Harga', 0, 0);
            // $pdf->Cell(30, 10, ' : Rp ' . number_format($servis['harga'], 0, ',', '.'), 0, 1);

            $pdf->Cell(30, 10, 'Merk $ Tipe', 0, 0);
            $pdf->Cell(90, 10, ' : ' . $servis['tipe_laptop'], 0, 1);

            $pdf->Cell(30, 10, 'Keluhan Awal', 0, 0);
            $pdf->Cell(30, 10, ' : ' . $servis['keluhan_awal'], 0, 1);

            $pdf->Ln(5);
            $pdf->Line(10, 90, 200, 90);
            $pdf->Ln(5);

            $pdf->Cell(30, 10, 'List Perbaikan & Biaya', 1, 1);
            $pdf->Cell(30, 10, 'List Perbaikan & Biaya', 0, 0);

            $pdf->Output('dokumen-servis-' . $servis['id_servis'] . '.pdf', 'I');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenData');
        }
    }

    public function servis_ubah($id)
    {
        $data['title'] = 'Ubah data servis';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // Menyimpan data2 dri model kedalam variabel $data yang selanjutnya bisa dipanggil dihalaman view
        $data['ubah_servis'] = $this->ManajemenData_model->get_servisId($id);
        $data['part'] = $this->ManajemenData_model->get_part();
        $data['detail_servis'] = $this->ManajemenData_model->get_detailServis($id);
        $data['total_harga'] = $this->ManajemenData_model->total_harga($id);

        $this->form_validation->set_rules('nm_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('no_hp', 'No. Telepon', 'required');
        $this->form_validation->set_rules('tipe_laptop', 'Merk & Tipe Laptop', 'required');
        $this->form_validation->set_rules('keluhan_awal', 'Keluhan Awal', 'required');
        $this->form_validation->set_rules('nm_teknisi', 'Nama Teknisi', 'required');
        // $this->form_validation->set_rules('id_part', 'Nama Part', 'required');
        // $this->form_validation->set_rules('harga', 'Harga', 'required');
        // $this->form_validation->set_rules('jumlah', 'Jumlah Part', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/servis_ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $idPart = $this->input->post('id_part[]');
            // $jumlah = $this->input->post('jumlah');
            // $query = $this->db->get_where('part', ['id_part' => $id_part])->row_array();

            // if ($jumlah > $query['stok']) {
            //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal, jumlah part melampaui ketersediaan!</div>');
            //     redirect('ManajemenData');
            // } else {
            if ($idPart == null) {
                redirect('ManajemenData/servis_ubah/' . $id);
            } else {
                $this->ManajemenData_model->ubah_servis();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Servis berhasil diperbarui!</div>');
                redirect('ManajemenData');
            }
        }
    }

    public function servis_detail($id)
    {
        $data['title'] = 'Detail data servis';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['riwayat_servis'] = $this->ManajemenData_model->get_servisId($id);
        $data['detail_servis'] = $this->ManajemenData_model->get_detailServis($id);
        $data['total_harga'] = $this->ManajemenData_model->total_harga($id);

        $db = new mysqli("localhost", "root", "", "db_servis");
        if ($db->errno == 0) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/servis_detail', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenData');
        }
    }

    public function servis_hapus($id)
    {
        $this->ManajemenData_model->hapus_servis($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Servis berhasil dihapus!</div>');
        redirect('ManajemenData');
    }
    // END DATA SERVICE //

    // DATA PEMBAYARAN //
    public function pembayaran()
    {
        $data['title'] = 'Pembayaran';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_pembayaran'] = $this->ManajemenData_model->get_pembayaran();

        if ($this->input->post('keyword')) {
            $data['data_pembayaran'] = $this->ManajemenData_model->search_pembayaran();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('ManajemenData/pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaran_tambah()
    {
        $data['title'] = 'Tambah data pembayaran';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['no_nota'] = $this->ManajemenData_model->auto_nonota();

        $this->form_validation->set_rules('id_servis', 'ID Servis', 'required');
        // $this->form_validation->set_rules('nm_teknisi', 'Nama Teknisi', 'required');
        // $this->form_validation->set_rules('nm_part', 'Nama Part', 'required');
        $this->form_validation->set_rules('biaya_jasa', 'Biaya Jasa', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/pembayaran_tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $pembayaran = [
                'no_nota' => $this->input->post('no_nota'),
                'tgl' => Date('Y-m-d H:i:s'),
                'nm_admin' => $this->input->post('nm_admin'),
                'id_servis' => $this->input->post('id_servis'),
                'nm_pelanggan' => $this->input->post('nm_pelanggan'),
                'tipe_laptop' => $this->input->post('tipe_laptop'),
                'keluhan_awal' => $this->input->post('keluhan_awal'),
                'nm_teknisi' => $this->input->post('nm_teknisi'),
                'total_harga' => $this->input->post('total_harga'),
                'biaya_jasa' => $this->input->post('biaya_jasa'),
                'total' => $this->input->post('total_harga') + $this->input->post('biaya_jasa')
            ];
            $this->db->insert('pembayaran', $pembayaran);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pembayaran berhasil ditambahkan!</div>');
            redirect('ManajemenData/pembayaran');
        }
    }

    public function pembayaran_ekspor($id)
    {
        $db = new mysqli("localhost", "root", "", "db_servis");
        if ($db->errno == 0) {
            $pembayaran = $this->ManajemenData_model->get_nonota($id);
            $pdf = new FPDF('P', 'mm', 'Letter');
            $pdf->AddPage();

            $pdf->Image('assets/img/login/ahayy-rounded.png', 180, 3, -300);

            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(130, 5, 'STRUK PEMBAYARAN', 0, 1);

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(130, 5, 'WISNU-TECH', 0, 0);
            $pdf->Cell(59, 5, '', 0, 1);

            $pdf->Line(15, 25, 200, 25);

            $pdf->Ln(5);
            $pdf->Cell(127, 10, '', 0, 0);
            $pdf->Cell(25, 10, 'No Nota', 0, 0);
            $pdf->Cell(34, 10, ' : ' . $pembayaran['no_nota'], 0, 1);

            $pdf->Cell(40, 5, 'Nama Admin', 0, 0);
            $pdf->Cell(87, 5, ' : ' . $pembayaran['nm_admin'], 0, 0);
            $pdf->Cell(25, 8, 'Tanggal', 0, 0);
            $pdf->Cell(34, 8, ' : ' . $pembayaran['tgl'], 0, 1);

            $pdf->Cell(40, 5, 'Nama Teknisi', 0, 0);
            $pdf->Cell(87, 5, ' : ' . $pembayaran['nm_teknisi'], 0, 0);
            $pdf->Cell(25, 8, 'ID Servis', 0, 0);
            $pdf->Cell(34, 8, ' : ' . $pembayaran['id_servis'], 0, 1);

            $pdf->Ln(5);

            $pdf->Cell(40, 8, 'Nama Pelanggan', 0, 0);
            $pdf->Cell(90, 8, ' : ' . $pembayaran['nm_pelanggan'], 0, 1);

            $pdf->Cell(40, 8, 'Merk & Tipe Laptop', 0, 0);
            $pdf->Cell(90, 8, ' : ' . $pembayaran['tipe_laptop'], 0, 1);

            $pdf->Cell(40, 8, 'Keluhan Awal', 0, 0);
            $pdf->Cell(90, 8, ' : ' . $pembayaran['keluhan_awal'], 0, 1);

            $pdf->Cell(189, 10, '', 0, 1);

            $pdf->SetFont('Arial', 'B', 12);

            $pdf->Cell(124, 5, 'Part', 1, 0);
            $pdf->Cell(31, 5, 'Jumlah', 1, 0);
            $pdf->Cell(40, 5, 'Harga', 1, 1);

            $pdf->SetFont('Arial', '', 12);

            $pdf->Cell(124, 5, '' . $pembayaran['nm_part'], 1, 0);
            $pdf->Cell(31, 5, '' . $pembayaran['jumlah_part'], 1, 0);
            $pdf->Cell(40, 5, 'Rp ' . number_format($pembayaran['harga_part'], 0, ',', '.'), 1, 1, 'R');

            $pdf->Cell(120, 5, '', 0, 0);
            $pdf->Cell(35, 5, 'Subtotal Part', 0, 0, 'R');
            $pdf->Cell(40, 5, 'Rp ' . number_format($pembayaran['subtotal_brg'], 0, ',', '.'), 1, 1, 'R');

            $pdf->Cell(120, 5, '', 0, 0);
            $pdf->Cell(35, 5, 'Jasa', 0, 0, 'R');
            $pdf->Cell(40, 5, 'Rp ' . number_format($pembayaran['harga_jasa'], 0, ',', '.'), 1, 1, 'R');

            $pdf->Cell(120, 5, '', 0, 0);
            $pdf->Cell(35, 5, 'Total', 0, 0, 'R');
            $pdf->Cell(40, 5, 'Rp ' . number_format($pembayaran['total'], 0, ',', '.'), 1, 1, 'R');

            $pdf->Line(15, 130, 200, 130);

            $pdf->Ln(5);
            $pdf->Cell(0, 40, '*** Terima Kasih ***', 0, 0, 'C');

            $pdf->Output('struk-pembayaran-' . $pembayaran['no_nota'] . '.pdf', 'I');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenData/pembayaran');
        }
    }

    public function pembayaran_ubah($id)
    {
        $data['title'] = 'Ubah data pembayaran';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['ubah_pembayaran'] = $this->ManajemenData_model->get_nonota($id);

        $this->form_validation->set_rules('id_servis', 'ID Servis', 'required');
        $this->form_validation->set_rules('biaya_jasa', 'Biaya Jasa', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/pembayaran_ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ManajemenData_model->ubah_pembayaran();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pembayaran berhasil diperbarui!</div>');
            redirect('ManajemenData/pembayaran');
        }
    }

    public function pembayaran_detail($id)
    {
        $data['title'] = 'Detail data pembayaran';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['detail_pembayaran'] = $this->ManajemenData_model->get_nonota($id);

        $db = new mysqli("localhost", "root", "", "db_servis");
        if ($db->errno == 0) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/pembayaran_detail', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenData/laporan');
        }
    }

    public function pembayaran_hapus($id)
    {
        // $this->ManajemenData_model->hapus_pembayaran($id);
        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pembayaran telah terhapus!</div>');
        // redirect('ManajemenData/pembayaran');

        $db = new mysqli("localhost", "root", "", "db_servis");
        $row = mysqli_query($db, "DELETE FROM pembayaran WHERE no_nota = '$id'");

        if ($row) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pembayaran telah terhapus!</div>');
            redirect('ManajemenData/pembayaran');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal! Data ini terpakai pada Data Laporan.</div>');
            redirect('ManajemenData/pembayaran');
        }
    }
    // END DATA PEMBAYARAN //

    // DATA LAPORAN //
    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_laporan'] = $this->ManajemenData_model->get_laporan();

        if ($this->input->post('keyword')) {
            $data['data_laporan'] = $this->ManajemenData_model->search_laporan();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('ManajemenData/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function laporan_tambah()
    {
        $data['title'] = 'Tambah data laporan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['id_laporan'] = $this->ManajemenData_model->auto_idlaporan();

        $this->form_validation->set_rules('no_nota', 'No. Nota', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/laporan_tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $laporan = [
                'id_laporan' => $this->input->post('id_laporan'),
                'tgl' => Date('Y-m-d H:i:s'),
                'no_nota' => $this->input->post('no_nota'),
                'total' => $this->input->post('total')
            ];
            $this->db->insert('laporan', $laporan);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Laporan berhasil ditambahkan!</div>');
            redirect('ManajemenData/laporan');
        }
    }

    public function laporan_ubah($id)
    {
        $data['title'] = 'Ubah data laporan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['ubah_laporan'] = $this->ManajemenData_model->get_laporanId($id);

        $this->form_validation->set_rules('no_nota', 'No. Nota', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/laporan_ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $db = new mysqli("localhost", "root", "", "db_servis");
            if ($db->errno == 0) {
                $this->ManajemenData_model->ubah_laporan();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Laporan berhasil diperbarui!</div>');
                redirect('ManajemenData/laporan');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
                redirect('ManajemenData/laporan');
            }
        }
    }

    public function laporan_hapus($id)
    {
        $db = new mysqli("localhost", "root", "", "db_servis");
        if ($db->errno == 0) {
            $this->ManajemenData_model->hapus_laporan($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Laporan telah terhapus!</div>');
            redirect('ManajemenData/laporan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenData/laporan');
        }
    }
    // END DATA LAPORAN //

    // DATA FOR AUTOFILL //
    public function part_list()
    {
        $part = $this->input->post('id_part');
        $result = $this->ManajemenData_model->get_partList($part);
        foreach ($result as $row) {
            $data = [
                'nm_part' => $row->nm_part,
                'harga_part' => $row->harga_part,
            ];
        }
        echo json_encode($data);
    }

    public function servis_list()
    {
        $servis = $this->input->post('id_servis');
        $result = $this->ManajemenData_model->get_servisList($servis);

        foreach ($result as $row) {
            $data = [
                'nm_pelanggan' => $row->nm_pelanggan,
                'tipe_laptop' => $row->tipe_laptop,
                'keluhan_awal' => $row->keluhan_awal,
                'teknisi' => $row->nm_teknisi,
                'total_harga' => $row->total_harga
            ];
        }
        echo json_encode($data);
    }

    public function nota_list()
    {
        $nota = $this->input->post('no_nota');
        $result = $this->ManajemenData_model->get_notaList($nota);
        foreach ($result as $row) {
            $data = [
                'total' => $row->total
            ];
        }
        echo json_encode($data);
    }

    // END DATA FOR AUTOFILL //
}
