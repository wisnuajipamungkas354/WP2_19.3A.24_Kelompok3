<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManajemenKaryawan_model extends CI_model
{
    // DATA USER //
    public function get_user()
    {
        return $this->db->get('user')->result_array();
    }

    public function get_karyawanList($karyawan)
    {
        $this->db->select('*');
        $this->db->where('id_karyawan', $karyawan);
        return $this->db->get('karyawan')->result();
    }

    public function get_userId($id)
    {
        return $this->db->get_where('user', ['id_karyawan' => base64_decode($id)])->row_array();
    }

    public function ubah_user()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($password == $user['password']) {
            $pengguna = [
                'id_karyawan' => $this->input->post('id_karyawan'),
                'id_role' => $this->input->post('id_role'),
                'nm_karyawan' => $this->input->post('nm_karyawan'),
                'username' => $this->input->post('username'),
                'image' => 'default.svg',
                'status_akun' => $this->input->post('status_akun')
            ];
            $this->db->where('id_karyawan', $this->input->post('id_karyawan'));
            $this->db->update('user', $pengguna);
        } else {
            $pengguna = [
                'id_karyawan' => $this->input->post('id_karyawan'),
                'id_role' => $this->input->post('id_role'),
                'nm_karyawan' => $this->input->post('nm_karyawan'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'image' => 'default.svg',
                'status_akun' => $this->input->post('status_akun')
            ];
            $this->db->where('id_karyawan', $this->input->post('id_karyawan'));
            $this->db->update('user', $pengguna);
        }
    }

    public function hapus_user($id)
    {
        $this->db->delete('user', ['id_karyawan' => base64_decode($id)]);
    }

    public function search_user()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('id_karyawan', $keyword);
        $this->db->or_like('id_role', $keyword);
        $this->db->or_like('nm_karyawan', $keyword);
        $this->db->or_like('username', $keyword);
        $this->db->or_like('status_akun', $keyword);
        return $this->db->get('user')->result_array();
    }
    // END DATA USER //

    // DATA KARYAWAN //
    public function get_karyawan()
    {
        return $this->db->get('karyawan')->result_array();
    }

    public function get_karyawanId($id)
    {
        return $this->db->get_where('karyawan', ['id_karyawan' => $id])->row_array();
    }

    public function auto_idkaryawan()
    {
        $this->db->select('RIGHT(id_karyawan,2) as idKaryawan', false);
        $this->db->order_by("id_karyawan", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('karyawan');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->idKaryawan) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 2, "0", STR_PAD_LEFT);
        $wordId = "P";
        $newId  = $wordId . $numberId;
        return $newId;
    }

    public function ubah_karyawan()
    {
        $karyawan = [
            'id_karyawan' => $this->input->post('id_karyawan'),
            'nm_karyawan' => $this->input->post('nm_karyawan'),
            'noHp_karyawan' => $this->input->post('noTlp'),
            'jabatan' => $this->input->post('jabatan')
        ];
        $this->db->where('id_karyawan', $this->input->post('id_karyawan'));
        $this->db->update('karyawan', $karyawan);
    }

    public function hapus_karyawan($id)
    {
        $this->db->delete('karyawan', ['id_karyawan' => $id]);
    }

    public function search_karyawan()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('id_karyawan', $keyword);
        $this->db->or_like('nm_karyawan', $keyword);
        $this->db->or_like('noHp_karyawan', $keyword);
        $this->db->or_like('jabatan', $keyword);
        return $this->db->get('karyawan')->result_array();
    }
    // END DATA KARYAWAN //
}
