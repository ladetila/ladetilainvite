<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        // function untuk membuat user tidak bisa berpindah halamn, kecuali tekan tombol logout
        if ($this->session->userdata('email')) {
            redirect('admin');
        }
        // function untuk login user dan admin
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        // $data['page_template'] = $this->db->get('page_template')->result_array();

        $data['hero_image'] = $this->db->get('hero_image')->result_array();
        // $data['hero_judul'] = $this->db->get('hero_judul')->result_array();
        // $data['social_media'] = $this->db->get('social_media')->result_array();
        // $data['contact'] = $this->db->get('contact')->result_array();
        // $data['banner_1'] = $this->db->get('banner_1')->result_array();

        // $data['instagram'] = $this->db->get('instagram')->result_array();

        // $data['testimonial'] = $this->db->get('testimonial')->result_array();

        // $data['sponsor'] = $this->db->get('sponsor')->result_array();


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/wedding_header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/wedding_footer', $data);
        } else {
            // validasinya sukses
            $this->_login();
        }
    }


    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // jika ada user
        if ($user) {
            // jika user aktiv
            if ($user['is_active'] == 1) {
                // cek passwordnya benar atau tidak
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {

                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Password anda salah!!! </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Email anda belum aktif </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Email anda belum terdaftar </div>');
            redirect('auth');
        }
    }







    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('pesan', '<div class="alert alert-info" role="alert">
            Anda sudah Logout!! </div>');
        redirect('auth');
    }
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
