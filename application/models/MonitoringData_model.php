<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MonitoringData_model extends CI_model
{
    // DATA LAPORAN //
    public function get_laporan()
    {
        return $this->db->get('laporan')->result_array();
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

    // DATA BARANG //
    public function get_barang()
    {
        return $this->db->get('part')->result_array();
    }

    public function get_supplier()
    {
        return $this->db->get('supplier')->result_array();
    }

    public function auto_nofaktur()
    {
        $this->db->select('RIGHT(no_faktur,4) as noFaktur', false);
        $this->db->order_by("no_faktur", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('faktur');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->noFaktur) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 4, "0", STR_PAD_LEFT);
        $wordId = "F";
        $newId  = $wordId . $numberId;
        return $newId;
    }

    public function auto_idPart()
    {
        $this->db->select('RIGHT(id_part,3) as idPart', false);
        $this->db->order_by("id_part", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('part');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->idPart) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 3, "0", STR_PAD_LEFT);
        $wordId = "B";
        $newId  = $wordId . $numberId;
        return $newId;
    }

    public function get_partId($id)
    {
        return $this->db->get_where('part', ['id_part' => $id])->row_array();
    }

    public function ubah_part()
    {
        $part = [
            'id_part' => $this->input->post('id_part'),
            'nm_part' => $this->input->post('nm_part'),
            'stok' => $this->input->post('jumlah'),
            'harga_part' => $this->input->post('harga_part')
        ];
        $this->db->where('id_part', $this->input->post('id_part'));
        $this->db->update('part', $part);
    }

    public function hapus_part($id)
    {
        $this->db->delete('faktur', ['id_part' => $id]);
        $this->db->delete('part', ['id_part' => $id]);
    }

    public function search_part()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('id_part', $keyword);
        $this->db->or_like('nm_part', $keyword);
        $this->db->or_like('harga_part', $keyword);
        $this->db->or_like('stok', $keyword);
        return $this->db->get('part')->result_array();
    }
    // END DATA BARANG //
}
