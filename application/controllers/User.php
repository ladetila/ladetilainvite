<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    
    
    public function gantipassword()
    {
        $data['title'] = 'GANTI PASSWORD';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // set rulesnya 
        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password1baru', 'Password Baru', 'required|trim|min_length[3]|matches[password2baru]');
        $this->form_validation->set_rules('password2baru', 'Konfirmasi Password', 'required|trim|min_length[3]|matches[password1baru]');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/gantipassword', $data);
            $this->load->view('templates/footer');
        } else {
            $password_saatini = $this->input->post('password_lama');
            $password_baru = $this->input->post('password1baru');
            if (!password_verify($password_saatini, $data['user']['password'])) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Password saat ini salah! </div>');
                redirect('user/gantipassword');
            } else {
                if ($password_saatini == $password_baru) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Password tidak boleh sama dengan yang lama ! </div>');
                    redirect('user/gantipassword');
                } else {
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Password anda telah diganti ! </div>');
                    redirect('user/gantipassword');
                }
            }
        }
    }
}
