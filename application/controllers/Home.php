<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
		$data = [
			'judul' => "Katalog Buku",
			'buku' => $this->ModelBuku->getBuku()->result(),
			'user' => $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array()
		];

		$this->load->view('templates/user_header', $data);
		$this->load->view('buku/daftarbuku');
		$this->load->view('templates/user_footer');

		//jika sudah login dan jika belum login
		// if ($this->session->userdata('email')) {
		// 	$user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
		// 	$data['user']=$user['nama'];

		// 	$this->load->view('templates/templates-user/header',$data);
		// 	$this->load->view('templates/templates-user/index',$data);
		// 	$this->load->view('templates/templates-user/modal');
		// 	$this->load->view('templates/templates-user/footer',$data);
		// } else {
		// 	$data['user'] = 'Pengunjung';
		// 	$this->load->view('templates/templates-user/header',$data);
		// 	$this->load->view('buku/daftarbuku',$data);
		// 	$this->load->view('templates/templates-user/modal');
		// 	$this->load->view('templates/templates-user/footer',$data);
		// }
	}

	public function detailBuku()
	{
		$id = $this->uri->segment(3);
		$buku = $this->ModelBuku->joinKategoriBuku(['buku.id' => $id])->row_array();

		$data = [
			'title' => "Detail Buku",
			'buku' => $this->ModelBuku->getBuku()->result(),
			'user' => $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(),
			'judul' => $buku['judul_buku'],
			'pengarang' => $buku['pengarang'],
			'penerbit' => $buku['penerbit'],
			'kategori' => $buku['nama_kategori'],
			'tahun' => $buku['tahun_terbit'],
			'isbn' => $buku['isbn'],
			'gambar' => $buku['image'],
			'dipinjam' => $buku['dipinjam'],
			'dibooking' => $buku['dibooking'],
			'stok' => $buku['stok'],
			'id' => $buku['id'],
		];
		
		$this->load->view('templates/user_header', $data);
		$this->load->view('buku/detailbuku');
		$this->load->view('templates/user_footer');
	}
}