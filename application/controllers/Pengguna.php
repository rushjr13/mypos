<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();

		// KHUSUS
		$data['judul'] = "Pengguna";
		$data['subjudul'] = "Data Pengguna";
		$this->template->load('template', 'pengguna/index', $data);
	}

	public function profil($username=null)
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();

		// KHUSUS
		if($username==null){
			$this->session->set_flashdata('sukses', '<div class="alert alert-danger alert-dismissible">
										                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										                <i class="fa fa-ban"></i> Tidak ada pengguna yang dipilih!
										                </div>');
			redirect('beranda');
		}else{
			$data['judul'] = "Pengguna";
			$data['subjudul'] = "Profil";
			$this->template->load('template', 'pengguna/profil', $data);
		}
	}

	public function ubah_profil($username=null)
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();

		// KHUSUS
		if($username==null){
			$this->session->set_flashdata('sukses', '<div class="alert alert-danger alert-dismissible">
										                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										                <i class="fa fa-ban"></i> Tidak ada pengguna yang dipilih!
										                </div>');
			redirect('beranda');
		}else{
			$post = $this->input->post(null, TRUE);
			if(isset($post['ubahprofilumum'])){
				echo "Ubah Profil Umum";
			}else if(isset($post['ubahprofilfoto'])){
				echo "Ubah Foto Profil";
			}
		}
	}
}
