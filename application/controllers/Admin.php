<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{



    public function index()
    {
        $data['title']  = 'Dashboard';
        $data['title1'] = 'Total Visitor Web';
        $data['title2'] = 'Social Media';
        $data['title3'] = 'Home';
        $data['title4'] = 'Judul & Slogan';
        $data['title5'] = 'Data Ucapan Tamu';
        $data['user']   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $data['hero_image'] = $this->db->get('hero_image')->result_array();
        $data['hero_judul'] = $this->db->get('hero_judul')->result_array();
        // $data['about'] = $this->db->get('about')->result_array();
        // $data['berita'] = $this->db->get('berita')->result_array();
        // $data['media'] = $this->db->get('media')->result_array();
        // $data['blog'] = $this->db->get('blog')->result_array();

        $data['social_media'] = $this->db->get('social_media')->result_array();
        $data['rsvp'] = $this->db->get('rsvp')->result_array();

        // Mendapatkan IP user

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }








    public function slider_image()
    {
        $data['title'] = 'Slider Image';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['hero_image'] = $this->db->get('hero_image')->result_array();
        $data['hero_judul'] = $this->db->get('hero_judul')->result_array();


        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/slider_image', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar Slider belum ditambahkan </div>');
                redirect('admin/slider_image');
            } else {
                $gambar     = $this->upload->data();
                $gambar     = $gambar['file_name'];
                $nama       = $this->input->post('nama', true);

                $data = [
                    'nama'      => $nama,
                    'image'     => $gambar
                ];

                $this->db->insert('hero_image', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Gambar Slider sudah berhasil ditambahkan </div>');
                redirect('admin/slider_image');
            }
        }
    }




    public function edit_slider($id)
    {
        $data['title'] = 'Edit Slider Image';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hero_image'] = $this->db->get_where('hero_image', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_slider', $data);
            $this->load->view('templates/footer');
        } else {

            $nama     = $this->input->post('nama', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['hero_image']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . './wedding-2/images/wedding/wedding-1/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('hero_image');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Hero Image anda berhasil diubah! </div>');
            redirect('admin/slider_image');
        }
    }




    public function delete_slider($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('hero_image', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Slider Img sudah berhasil dihapus </div>');
        redirect('admin/slider_image');
    }





    public function wedding_detail()
    {
        $data['title']  = 'Wedding Detail';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['wedding_detail'] = $this->db->get('wedding_detail')->result_array();


        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_rules('paragraph', 'Paragraph', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/wedding_detail', $data);
            $this->load->view('templates/footer');
        } else {

            $judul     = $this->input->post('judul', true);
            $text      = $this->input->post('text', true);
            $paragraph = $this->input->post('paragraph', true);

            $data = [
                'judul'        => $judul,
                'text'         => $text,
                'paragraph'    => $paragraph
            ];

            $this->db->insert('wedding_detail', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Wedding Detail sudah berhasil ditambahkan </div>');
            redirect('admin/wedding_detail');
        }
    }



    public function edit_wedding_detail($id)
    {
        $data['title'] = 'Edit Wedding Detail';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['wedding_detail'] = $this->db->get_where('wedding_detail', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_rules('paragraph', 'Paragraph', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_wedding_detail', $data);
            $this->load->view('templates/footer');
        } else {

            $judul     = $this->input->post('judul', true);
            $text      = $this->input->post('text', true);
            $paragraph = $this->input->post('paragraph', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets1/images/media/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['media']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'assets1/images/media/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('judul', $judul);
            $this->db->set('text', $text);
            $this->db->set('paragraph', $paragraph);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('wedding_detail');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary text-center" role="alert">
            Selamat, Wedding detail anda berhasil diubah! </div>');
            redirect('admin/wedding_detail');
        }
    }

    public function delete_wedding_digital($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('wedding_detail', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
        Wedding detail sudah berhasil dihapus </div>');
        redirect('admin/wedding_detail');
    }





    public function social_media()
    {
        $data['title']  = 'Social Media';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['social_media'] = $this->db->get('social_media')->result_array();


        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('sosmed', 'Sosmed', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/social_media', $data);
            $this->load->view('templates/footer');
        } else {

            $nama    = $this->input->post('nama', true);
            $sosmed  = $this->input->post('sosmed', true);
            $icon    = $this->input->post('icon', true);

            $data = [
                'nama'        => $nama,
                'sosmed'      => $sosmed,
                'icon'        => $icon
            ];

            $this->db->insert('social_media', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Social Media sudah berhasil ditambahkan </div>');
            redirect('admin/social_media');
        }
    }



    public function edit_social($id)
    {
        $data['title'] = 'Edit Social Media';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['social_media'] = $this->db->get_where('social_media', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('sosmed', 'Sosmed', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_social', $data);
            $this->load->view('templates/footer');
        } else {

            $nama    = $this->input->post('nama', true);
            $sosmed  = $this->input->post('sosmed', true);
            $icon    = $this->input->post('icon', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets1/images/media/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['media']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'assets1/images/media/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->set('sosmed', $sosmed);
            $this->db->set('icon', $icon);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('social_media');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary text-center" role="alert">
            Selamat, Social Media Perusahaan anda berhasil diubah! </div>');
            redirect('admin/social_media');
        }
    }

    public function delete_social($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('social_media', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Social Media Perusahaan sudah berhasil dihapus </div>');
        redirect('admin/social_media');
    }






    public function music()
    {
        $data['title']  = 'Music';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['music'] = $this->db->get('music')->result_array();


        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('id_music', 'ID Music', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/music', $data);
            $this->load->view('templates/footer');
        } else {

            $nama      = $this->input->post('nama', true);
            $id_music  = $this->input->post('id_music', true);

            $data = [
                'nama'          => $nama,
                'id_music'      => $id_music
            ];

            $this->db->insert('music', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Music sudah berhasil ditambahkan </div>');
            redirect('admin/music');
        }
    }



    public function edit_music($id)
    {
        $data['title'] = 'Edit Music';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['music'] = $this->db->get_where('music', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('id_music', 'ID Music', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_music', $data);
            $this->load->view('templates/footer');
        } else {

            $nama      = $this->input->post('nama', true);
            $id_music  = $this->input->post('id_music', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets1/images/media/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['media']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'assets1/images/media/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->set('id_music', $id_music);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('music');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary text-center" role="alert">
            Selamat, Music anda berhasil diubah! </div>');
            redirect('admin/music');
        }
    }

    public function delete_music($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('music', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Music sudah berhasil dihapus </div>');
        redirect('admin/music');
    }




    public function mundur()
    {
        $data['title']  = 'Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['hitung_mundur'] = $this->db->get('hitung_mundur')->result_array();


        $this->form_validation->set_rules('tahun', 'Tahun', 'required');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/mundur', $data);
            $this->load->view('templates/footer');
        } else {

            $tahun   = $this->input->post('tahun', true);
            $bulan   = $this->input->post('bulan', true);
            $hari    = $this->input->post('hari', true);

            $data = [
                'tahun'        => $tahun,
                'bulan'        => $bulan,
                'hari'         => $hari
            ];

            $this->db->insert('hitung_mundur', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                hitung mundur acara sudah berhasil ditambahkan </div>');
            redirect('admin/mundur');
        }
    }



    public function edit_mundur($id)
    {
        $data['title'] = 'Edit Hitung Mundur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hitung_mundur'] = $this->db->get_where('hitung_mundur', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('tahun', 'Tahun', 'required');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_mundur', $data);
            $this->load->view('templates/footer');
        } else {

            $tahun   = $this->input->post('tahun', true);
            $bulan   = $this->input->post('bulan', true);
            $hari    = $this->input->post('hari', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets1/images/media/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['media']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'assets1/images/media/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('tahun', $tahun);
            $this->db->set('bulan', $bulan);
            $this->db->set('hari', $hari);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('hitung_mundur');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary text-center" role="alert">
            Selamat, Hitung mundur acara anda berhasil diubah! </div>');
            redirect('admin/mundur');
        }
    }

    public function delete_mundur($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('hitung_mundur', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Hitung Mundur Acara sudah berhasil dihapus </div>');
        redirect('admin/mundur');
    }













    public function logo_web()
    {
        $data['title'] = 'Logo Web';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['logo_web'] = $this->db->get('logo_web')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/logo_web', $data);
        $this->load->view('templates/footer');
    }



    public function edit_logo_web($id)
    {
        $data['title'] = 'Logo Web';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['logo_web'] = $this->db->get_where('logo_web', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_logo_web', $data);
            $this->load->view('templates/footer');
        } else {

            $nama    = $this->input->post('nama', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 1024;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/logo/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['logo_web']['image'];
                    if ($gambar_lama != 'logo-web.png') {
                        unlink(FCPATH . 'wedding-2/images/wedding/wedding-1/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('logo_web');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Logo Web anda berhasil diubah! </div>');
            redirect('admin/logo_web');
        }
    }









    public function edit_judul($id)
    {
        $data['title'] = 'Edit Judul';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hero_judul'] = $this->db->get_where('hero_judul', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_rules('paragraph', 'Paragraph', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_judul', $data);
            $this->load->view('templates/footer');
        } else {

            $judul     = $this->input->post('judul', true);
            $text      = $this->input->post('text', true);
            $paragraph = $this->input->post('paragraph', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '1024';
                $config['upload_path'] = './assets1/images/hero-image/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['hero_image']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'assets1/images/hero-image/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('judul', $judul);
            $this->db->set('text', $text);
            $this->db->set('paragraph', $paragraph);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('hero_judul');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Hero Judul anda berhasil diubah! </div>');
            redirect('admin/slider_image');
        }
    }










    public function hero_link()
    {
        $data['title'] = 'Hero Link';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['banner_1'] = $this->db->get('banner_1')->result_array();


        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/hero_link', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                redirect('admin/hero_link');
            } else {
                $gambar     = $this->upload->data();
                $gambar     = $gambar['file_name'];
                $nama       = $this->input->post('nama', true);
                $link       = $this->input->post('link', true);

                $data = [
                    'nama'      => $nama,
                    'image'     => $gambar,
                    'link'      => $link
                ];

                $this->db->insert('banner_1', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Banner Iklan anda sudah berhasil ditambahkan </div>');
                redirect('admin/hero_link');
            }
        }
    }




    public function edit_hero_link($id)
    {
        $data['title'] = 'Edit Hero Link';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['banner_1'] = $this->db->get_where('banner_1', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_hero_link', $data);
            $this->load->view('templates/footer');
        } else {

            $nama       = $this->input->post('nama', true);
            $link       = $this->input->post('link', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 1024;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['banner_1']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'wedding-2/images/wedding/wedding-1/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->set('link', $link);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('banner_1');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Hero link anda anda berhasil diubah! </div>');
            redirect('admin/hero_link');
        }
    }


    public function delete_hero_link($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('banner_1', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Hero Link sudah berhasil dihapus </div>');
        redirect('admin/hero_link');
    }



    public function thanks()
    {
        $data['title'] = 'Terima Kasih';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['banner_utama'] = $this->db->get('banner_utama')->result_array();


        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/thanks', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/thanks';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                redirect('admin/thanks');
            } else {
                $gambar     = $this->upload->data();
                $gambar     = $gambar['file_name'];
                $nama       = $this->input->post('nama', true);
                $link       = $this->input->post('link', true);

                $data = [
                    'nama'      => $nama,
                    'image'     => $gambar,
                    'link'      => $link
                ];

                $this->db->insert('banner_utama', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Gambar Ucapan Terima kasih anda sudah berhasil ditambahkan </div>');
                redirect('admin/thanks');
            }
        }
    }




    public function edit_thanks($id)
    {
        $data['title'] = 'Edit Terima kasih';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['banner_utama'] = $this->db->get_where('banner_utama', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_thanks', $data);
            $this->load->view('templates/footer');
        } else {

            $nama       = $this->input->post('nama', true);
            $link       = $this->input->post('link', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 1024;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/thanks';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['banner_1']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . 'wedding-2/images/wedding/wedding-1/thanks' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->set('link', $link);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('banner_utama');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Gambar Ucapan terima kasih anda anda berhasil diubah! </div>');
            redirect('admin/thanks');
        }
    }


    public function delete_thanks($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('banner_utama', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
        Gambar Ucapan terima kasih sudah berhasil dihapus </div>');
        redirect('admin/thanks');
    }




    public function mempelai()
    {
        $data['title'] = 'Mempelai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['mempelai'] = $this->db->get('nama_mempelai')->result_array();


        $this->form_validation->set_rules('nama_lk', 'Nama laki-Laki', 'required');
        $this->form_validation->set_rules('nama_pr', 'Nama Perempuan', 'required');
        $this->form_validation->set_rules('save_the_date', 'Save The Date', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/mempelai', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/mempelai/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                redirect('admin/mempelai');
            } else {
                $gambar        = $this->upload->data();
                $gambar        = $gambar['file_name'];
                $nama_lk       = $this->input->post('nama_lk', true);
                $nama_pr       = $this->input->post('nama_pr', true);
                $std           = $this->input->post('save_the_date', true);
                $tanggal       = $this->input->post('tanggal', true);
                $alamat        = $this->input->post('alamat', true);

                $data = [
                    'nama_lk'       => $nama_lk,
                    'image'         => $gambar,
                    'nama_pr'       => $nama_pr,
                    'save_the_date' => $std,
                    'tanggal'       => $tanggal,
                    'alamat'        => $alamat
                ];

                $this->db->insert('nama_mempelai', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Mempelai anda sudah berhasil ditambahkan </div>');
                redirect('admin/mempelai');
            }
        }
    }




    public function edit_mempelai($id)
    {
        $data['title'] = 'Edit Mempelai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['mempelai'] = $this->db->get_where('nama_mempelai', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama_lk', 'Nama laki-Laki', 'required');
        $this->form_validation->set_rules('nama_pr', 'Nama Perempuan', 'required');
        $this->form_validation->set_rules('save_the_date', 'Save The Date', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_mempelai', $data);
            $this->load->view('templates/footer');
        } else {

            $nama_lk       = $this->input->post('nama_lk', true);
            $nama_pr       = $this->input->post('nama_pr', true);
            $std           = $this->input->post('save_the_date', true);
            $tanggal       = $this->input->post('tanggal', true);
            $alamat        = $this->input->post('alamat', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/mempelai/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['nama_mempelai']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . './wedding-2/images/wedding/wedding-1/mempelai/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama_lk', $nama_lk);
            $this->db->set('nama_pr', $nama_pr);
            $this->db->set('save_the_date', $std);
            $this->db->set('tanggal', $tanggal);
            $this->db->set('alamat', $alamat);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('nama_mempelai');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Mempelai anda anda berhasil diubah! </div>');
            redirect('admin/mempelai');
        }
    }


    public function delete_mempelai($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('nama_mempelai', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Mempelai sudah berhasil dihapus </div>');
        redirect('admin/mempelai');
    }





    public function laki()
    {
        $data['title'] = 'Laki-laki';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['laki'] = $this->db->get('laki-laki')->result_array();


        $this->form_validation->set_rules('nama', 'Nama laki-Laki', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/laki', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/laki-laki/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                redirect('admin/laki');
            } else {
                $gambar        = $this->upload->data();
                $gambar        = $gambar['file_name'];
                $nama          = $this->input->post('nama', true);

                $data = [
                    'nama'       => $nama,
                    'image'      => $gambar
                ];

                $this->db->insert('laki-laki', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Pihak Laki-laki anda sudah berhasil ditambahkan </div>');
                redirect('admin/laki');
            }
        }
    }




    public function edit_laki($id)
    {
        $data['title'] = 'Edit Laki-laki';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['laki'] = $this->db->get_where('laki-laki', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama laki-Laki', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_laki', $data);
            $this->load->view('templates/footer');
        } else {

            $nama       = $this->input->post('nama', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/laki-laki/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['laki-laki']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . './wedding-2/images/wedding/wedding-1/laki-laki/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('laki-laki');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Pihak Laki-laki anda anda berhasil diubah! </div>');
            redirect('admin/laki');
        }
    }


    public function delete_laki($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('laki-laki', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Pihak Laki-laki sudah berhasil dihapus </div>');
        redirect('admin/laki');
    }






    public function perempuan()
    {
        $data['title'] = 'Perempuan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['perempuan'] = $this->db->get('pr')->result_array();


        $this->form_validation->set_rules('nama', 'Nama Perempuan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/perempuan', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/perempuan/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                redirect('admin/perempuan');
            } else {
                $gambar        = $this->upload->data();
                $gambar        = $gambar['file_name'];
                $nama          = $this->input->post('nama', true);

                $data = [
                    'nama'       => $nama,
                    'image'      => $gambar
                ];

                $this->db->insert('pr', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Pihak Perempuan anda sudah berhasil ditambahkan </div>');
                redirect('admin/perempuan');
            }
        }
    }




    public function edit_perempuan($id)
    {
        $data['title'] = 'Edit Perempuan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['perempuan'] = $this->db->get_where('pr', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('nama', 'Nama Perempuan', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_perempuan', $data);
            $this->load->view('templates/footer');
        } else {

            $nama       = $this->input->post('nama', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/perempuan/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['pr']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . './wedding-2/images/wedding/wedding-1/perempuan/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('pr');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Pihak Perempuan anda anda berhasil diubah! </div>');
            redirect('admin/perempuan');
        }
    }


    public function delete_perempuan($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('pr', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Pihak Perempuan sudah berhasil dihapus </div>');
        redirect('admin/perempuan');
    }





    public function akad()
    {
        $data['title'] = 'Akad';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('id', 'DESC');

        $data['akad'] = $this->db->get('akad')->result_array();


        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
        $this->form_validation->set_rules('link_maps', 'Link Maps', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/akad', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './wedding-2/images/wedding/wedding-1/akad/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Gambar anda belum ditambahkan </div>');
                redirect('admin/akad');
            } else {
                $gambar      = $this->upload->data();
                $gambar      = $gambar['file_name'];
                $judul       = $this->input->post('judul', true);
                $jam         = $this->input->post('jam', true);
                $alamat      = $this->input->post('alamat', true);
                $no_hp       = $this->input->post('no_hp', true);
                $link_maps   = $this->input->post('link_maps', true);

                $data = [
                    'judul'       => $judul,
                    'image'      => $gambar,
                    'jam'         => $jam,
                    'alamat'      => $alamat,
                    'no_hp'       => $no_hp,
                    'link_maps'   => $link_maps
                ];

                $this->db->insert('akad', $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Akad anda sudah berhasil ditambahkan </div>');
                redirect('admin/akad');
            }
        }
    }




    public function edit_akad($id)
    {
        $data['title'] = 'Edit Akad';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['akad'] = $this->db->get_where('akad', ['id' => $id])->row_array();

        // berikan rules untuk mengedit nama user
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
        $this->form_validation->set_rules('link_maps', 'Link Maps', 'required');

        // jalankan form validation
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_akad', $data);
            $this->load->view('templates/footer');
        } else {

            $judul       = $this->input->post('judul', true);
            $jam         = $this->input->post('jam', true);
            $alamat      = $this->input->post('alamat', true);
            $no_hp       = $this->input->post('no_hp', true);
            $link_maps   = $this->input->post('link_maps', true);

            //cek jika ada gambar yang akan diupload
            $upload_gambar = $_FILES['image']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './wedding-2/images/wedding/wedding-1/akad/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // hapus gambar user lama
                    $gambar_lama = $data['akad']['image'];
                    if ($gambar_lama != 'bg-1.png') {
                        unlink(FCPATH . './wedding-2/images/wedding/wedding-1/akad/' . $gambar_lama);
                    }

                    // upload gambar user baru
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('judul', $judul);
            $this->db->set('jam', $jam);
            $this->db->set('alamat', $alamat);
            $this->db->set('no_hp', $no_hp);
            $this->db->set('link_maps', $link_maps);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('akad');

            // buat flash data agar memberi tahu user bahwa data berhasil diedit
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat, Akad anda anda berhasil diubah! </div>');
            redirect('admin/akad');
        }
    }


    public function delete_akad($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->delete('akad', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Akad sudah berhasil dihapus </div>');
        redirect('admin/akad');
    }
}
