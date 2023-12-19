<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManajemenPegawai_model extends CI_model
{
    // DATA USER //
    public function get_user()
    {
        return $this->db->get('user')->result_array();
    }

    public function get_pegawaiList($pegawai)
    {
        $this->db->select('*');
        $this->db->where('id_pegawai', $pegawai);
        return $this->db->get('pegawai')->result();
    }

    public function get_userId($id)
    {
        return $this->db->get_where('user', ['id_pegawai' => base64_decode($id)])->row_array();
    }

    public function ubah_user()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($password == $user['password']) {
            $pengguna = [
                'id_pegawai' => $this->input->post('id_pegawai'),
                'id_role' => $this->input->post('id_role'),
                'nama_pegawai' => $this->input->post('nm_pegawai'),
                'username' => $this->input->post('username'),
                'image' => 'default.svg',
                'status_akun' => $this->input->post('status_akun')
            ];
            $this->db->where('id_pegawai', $this->input->post('id_pegawai'));
            $this->db->update('user', $pengguna);
        } else {
            $pengguna = [
                'id_pegawai' => $this->input->post('id_pegawai'),
                'id_role' => $this->input->post('id_role'),
                'nama_pegawai' => $this->input->post('nm_pegawai'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'image' => 'default.svg',
                'status_akun' => $this->input->post('status_akun')
            ];
            $this->db->where('id_pegawai', $this->input->post('id_pegawai'));
            $this->db->update('user', $pengguna);
        }
    }

    public function hapus_user($id)
    {
        $this->db->delete('user', ['id_pegawai' => base64_decode($id)]);
    }

    public function search_user()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('id_pegawai', $keyword);
        $this->db->or_like('id_role', $keyword);
        $this->db->or_like('nama_pegawai', $keyword);
        $this->db->or_like('username', $keyword);
        $this->db->or_like('status_akun', $keyword);
        return $this->db->get('user')->result_array();
    }
    // END DATA USER //

    // DATA PEGAWAI //
    public function get_pegawai()
    {
        return $this->db->get('pegawai')->result_array();
    }

    public function get_pegawaiId($id)
    {
        return $this->db->get_where('pegawai', ['id_pegawai' => $id])->row_array();
    }

    public function auto_idpegawai()
    {
        $this->db->select('RIGHT(id_pegawai,2) as idPegawai', false);
        $this->db->order_by("id_pegawai", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('pegawai');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->idPegawai) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 2, "0", STR_PAD_LEFT);
        $wordId = "P";
        $newId  = $wordId . $numberId;
        return $newId;
    }

    public function ubah_pegawai()
    {
        $pegawai = [
            'id_pegawai' => $this->input->post('id_pegawai'),
            'nm_pegawai' => $this->input->post('nm_pegawai'),
            'noTlp_pegawai' => $this->input->post('noTlp'),
            'jabatan' => $this->input->post('jabatan')
        ];
        $this->db->where('id_pegawai', $this->input->post('id_pegawai'));
        $this->db->update('pegawai', $pegawai);
    }

    public function hapus_pegawai($id)
    {
        $this->db->delete('pegawai', ['id_pegawai' => $id]);
    }

    public function search_pegawai()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('id_pegawai', $keyword);
        $this->db->or_like('nm_pegawai', $keyword);
        $this->db->or_like('noTlp_pegawai', $keyword);
        $this->db->or_like('jabatan', $keyword);
        return $this->db->get('pegawai')->result_array();
    }
    // END DATA PEGAWAI //
}
