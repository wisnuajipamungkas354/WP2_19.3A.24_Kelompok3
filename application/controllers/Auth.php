<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Wisnu-Tech | Login';
            $this->load->view('auth/login', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->db->get_where('user', ['username' => $username])->row_array();

            if ($user) {
                if ($user['status_akun'] == 'Aktif') {
                    if (password_verify($password, $user['password'])) {
                        $data = [
                            'username' => $user['username'],
                            'id_role' => $user['id_role']
                        ];
                        $this->session->set_userdata($data);
                        if ($user['id_role'] != 0) {
                            redirect('dashboard');
                        } else {
                            redirect('auth');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Password salah!</div>');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Username ini tidak aktif!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Username tidak ditemukan!</div>');
                redirect('auth');
            }
        }
    }

    public function lupa_password()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|matches[password2]');
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'trim|required|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password';
            $this->load->view('auth/lupa_password', $data);
        } else {
            $username = $this->input->post('username');
            $password1 = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $user = $this->db->get_where('user', ['username' => $username])->row_array();

            if ($user) {
                if ($user['status_akun'] == 'Aktif') {
                    $this->db->set('password', $password1);
                    $this->db->where('username', $username);
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Password berhasil diubah!</div>');
                    redirect('auth');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Username ini tidak aktif!</div>');
                    redirect('auth/lupa_password');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Username tidak ditemukan!</div>');
                redirect('auth/lupa_password');
            }
        }
    }

    public function ubah_password()
    {
        $this->form_validation->set_rules('password1', 'Password', 'trim|required');
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ubah Password';
            $this->load->view('auth/ubah_password', $data);
        } else {
            $password1 = $this->input->post('password1');
            $password2 = $this->input->post('password2');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Anda berhasil logout!</div>');
        redirect('auth');
    }
}
