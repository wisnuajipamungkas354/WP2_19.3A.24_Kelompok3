<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManajemenData_model extends CI_model
{
    // DATA SERVICE //
    public function get_servis()
    {
        return $this->db->get('servis')->result_array();
    }

    public function get_detailServis($id)
    {
        return $this->db->get_where('detail_servis', ['id_servis' => $id])->result_array();
    }

    public function total_harga($id)
    {
        $this->db->select_sum('harga');
        $this->db->from('detail_servis');
        $this->db->where('id_servis', $id);
        return $this->db->get()->result_array();
    }

    public function get_servisId($id)
    {
        return $this->db->get_where('servis', ['id_servis' => $id])->row_array();
    }

    public function auto_idservis()
    {
        $this->db->select('RIGHT(id_servis,4) as idServis', false);
        $this->db->order_by("id_servis", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('servis');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->idServis) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 4, "0", STR_PAD_LEFT);
        $wordId = "S";
        $newId  = $wordId . $numberId;
        return $newId;
    }

    public function ubah_servis()
    {
        $pelanggan = [
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'nm_pelanggan' => $this->input->post('nm_pelanggan'),
            'no_hp' => $this->input->post('no_hp')
        ];
        $this->db->where('id_pelanggan', $this->input->post('id_pelanggan'));
        $this->db->update('pelanggan', $pelanggan);

        $servis = [
            'id_servis' => $this->input->post('id_servis'),
            'tgl' => Date('Y-m-d H:i:s'),
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'nm_pelanggan' => $this->input->post('nm_pelanggan'),
            'no_hp' => $this->input->post('no_hp'),
            'tipe_laptop' => $this->input->post('tipe_laptop'),
            'keluhan_awal' => $this->input->post('keluhan_awal'),
            'nm_teknisi' => $this->input->post('nm_teknisi'),
            'total_harga' => $this->input->post('total_harga')
        ];
        $this->db->where('id_servis', $this->input->post('id_servis'));
        $this->db->update('servis', $servis);

        $idPart = $this->input->post('id_part[]');
        $nmPart = $this->input->post('nm_part[]');
        $harga = $this->input->post('harga[]');
        $detailServis = array();
        for ($i = 0; $i < count($idPart); $i++) {
            $detailServis[$i] = array(
                'id_servis' => $this->input->post('id_servis'),
                'id_part' => $idPart[$i],
                'nm_part' => $nmPart[$i],
                'harga' => $harga[$i]
            );
        }
        $this->db->where('id_servis', $this->input->post('id_servis'));
        $this->db->delete('detail_servis');
        $this->db->insert_batch('detail_servis', $detailServis);
    }

    public function hapus_servis($id)
    {
        $idServis = $this->db->get_where('servis', ['id_pelanggan' => $id])->result_array();
        $this->db->delete('detail_servis', ['id_servis' => $idServis[0]['id_servis']]);
        $this->db->delete('servis', ['id_pelanggan' => $id]);
        $this->db->delete('pelanggan', ['id_pelanggan' => $id]);
    }

    public function search_servis()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('id_servis', $keyword);
        $this->db->or_like('tgl', $keyword);
        $this->db->or_like('id_pelanggan', $keyword);
        $this->db->or_like('nm_pelanggan', $keyword);
        $this->db->or_like('no_hp', $keyword);
        $this->db->or_like('tipe_laptop', $keyword);
        $this->db->or_like('keluhan_awal', $keyword);
        $this->db->or_like('nm_teknisi', $keyword);
        $this->db->or_like('total_harga', $keyword);
        return $this->db->get('servis')->result_array();
    }

    public function get_servisList($servis)
    {
        $this->db->select('*');
        $this->db->where('id_servis', $servis);
        return $this->db->get('servis')->result();
    }

    // END DATA SERVICE //

    // DATA PART //
    public function get_part()
    {
        return $this->db->get('part')->result_array();
    }

    public function get_partList($part)
    {
        $this->db->select('*');
        $this->db->where('id_part', $part);
        return $this->db->get('part')->result();
    }
    // END DATA PART //

    // DATA PELANGGAN //
    public function auto_idpelanggan()
    {
        $this->db->select('RIGHT(id_pelanggan,4) as idPelanggan', false);
        $this->db->order_by("id_pelanggan", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('pelanggan');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->idPelanggan) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 4, "0", STR_PAD_LEFT);
        $wordId = "C";
        $newId  = $wordId . $numberId;
        return $newId;
    }
    // END DATA PELANGGAN //

    // DATA PEMBAYARAN //
    public function get_pembayaran()
    {
        return $this->db->get('pembayaran')->result_array();
    }

    public function auto_nonota()
    {
        $this->db->select('RIGHT(no_nota,4) as noNota', false);
        $this->db->order_by("no_nota", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('pembayaran');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->noNota) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 4, "0", STR_PAD_LEFT);
        $wordId = "N";
        $newId  = $wordId . $numberId;
        return $newId;
    }

    public function get_nonota($id)
    {
        return $this->db->get_where('pembayaran', ['no_nota' => $id])->row_array();
    }

    public function ubah_pembayaran()
    {
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
        $this->db->where('no_nota', $this->input->post('no_nota'));
        $this->db->update('pembayaran', $pembayaran);
    }

    public function hapus_pembayaran($id)
    {
        $this->db->delete('pembayaran', ['no_nota' => $id]);
    }

    public function search_pembayaran()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('no_nota', $keyword);
        $this->db->or_like('tgl', $keyword);
        $this->db->or_like('id_servis', $keyword);
        $this->db->or_like('nm_pelanggan', $keyword);
        $this->db->or_like('tipe_laptop', $keyword);
        $this->db->or_like('keluhan_awal', $keyword);
        $this->db->or_like('nm_teknisi', $keyword);
        $this->db->or_like('total_harga', $keyword);
        $this->db->or_like('biaya_jasa', $keyword);
        $this->db->or_like('total', $keyword);
        return $this->db->get('pembayaran')->result_array();
    }
    // END DATA PEMBAYARAN //

    // DATA LAPORAN //
    public function get_laporan()
    {
        return $this->db->get('laporan')->result_array();
    }

    public function get_laporanId($id)
    {
        return $this->db->get_where('laporan', ['id_laporan' => $id])->row_array();
    }

    public function auto_idlaporan()
    {
        $this->db->select('RIGHT(id_laporan,4) as idLaporan', false);
        $this->db->order_by("id_laporan", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('laporan');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->idLaporan) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 4, "0", STR_PAD_LEFT);
        $wordId = "L";
        $newId  = $wordId . $numberId;
        return $newId;
    }

    public function ubah_laporan()
    {
        $laporan = [
            'id_laporan' => $this->input->post('id_laporan'),
            'tgl' => Date('Y-m-d H:i:s'),
            'no_nota' => $this->input->post('no_nota'),
            'total' => $this->input->post('total')
        ];
        $this->db->where('id_laporan', $this->input->post('id_laporan'));
        $this->db->update('laporan', $laporan);
    }

    public function get_notaList($nota)
    {
        $this->db->select('*');
        $this->db->where('no_nota', $nota);
        return $this->db->get('pembayaran')->result();
    }

    public function hapus_laporan($id)
    {
        $this->db->delete('laporan', ['id_laporan' => $id]);
    }

    public function search_laporan()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('id_laporan', $keyword);
        $this->db->or_like('tgl', $keyword);
        $this->db->or_like('no_nota', $keyword);
        $this->db->or_like('total', $keyword);
        return $this->db->get('laporan')->result_array();
    }
    // END DATA LAPORAN //
}
