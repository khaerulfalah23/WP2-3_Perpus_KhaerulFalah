<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    // Management anggota
    public function index()
    {
        $data['judul'] = 'Data Anggota';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['anggota'] = $this->ModelUser->getUser()->result_array();

        $this->form_validation->set_rules(
            'nama', 
            'Nama Anggota', 
            'required', [
                'required' => 'Nama Anggota harus diisi!',
        ]);
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[user.email]', [
            'valid_email' => 'Email Tidak Benar!!',
            'required' => 'Email Belum diisi!!',
            'is_unique' => 'Email Sudah Terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password Tidak Sama!!',
            'min_length' => 'Password Terlalu Pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password]');
        $this->form_validation->set_rules(
            'status', 
            'Status', 
            'required', [
                'required' => 'Status harus diisi!',
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/profile/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $config['file_name'] = 'img' . time();
        $this->load->library('upload', $config);
        if ($this->form_validation->run() == false) 
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('anggota/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) 
            {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else { $gambar = 'default.jpg'; }
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => $gambar,
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => intval($this->input->post('status', true)),
                'tanggal_input' => time()
            ];
            $this->ModelUser->simpanData($data);
            redirect('anggota');
        }
    }

    public function ubahAnggota()
    {
        $data['judul'] = 'Ubah Data Anggota';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['anggota'] = $this->ModelUser->getUserWhere(['id' => $this->uri->segment(3)])->row_array();

        $this->form_validation->set_rules(
          'nama', 
          'Nama Anggota', 
          'required', [
              'required' => 'Nama Anggota harus diisi!',
        ]);
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', [
            'valid_email' => 'Email Tidak Benar!!',
            'required' => 'Email Belum diisi!!',
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/profile/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();

        //memuat atau memanggil library upload
        $this->load->library('upload', $config);
        if ($this->form_validation->run() == false) 
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('anggota/ubah_anggota', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) 
            {
                $image = $this->upload->data();
                $old_image = $data['anggota']['image'];
                if ($old_image != 'default.jpg') {
                  unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }
                $gambar = $image['file_name'];
            } else { $gambar = $data['anggota']['image']; }
            
            // data postingan
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => $gambar,
                'role_id' => 2,
                'is_active' => intval($this->input->post('status', true)),
                'tanggal_input' => time()
            ];

            $this->ModelUser->updateUser($data, ['id' => $this->input->post('id')]);
            redirect('buku');
        }
    }

    public function hapusAnggota()
    {
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['anggota'] = $this->ModelUser->getUserWhere(['id' => $this->uri->segment(3)])->row_array();
        $old_image = $data['anggota']['image'];
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelUser->hapusUser($where);
        if ($old_image != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/' . $old_image);
        }
        redirect('anggota');
    }
}
