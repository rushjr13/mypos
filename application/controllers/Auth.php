<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$data['judul'] = "Masuk";
		$this->template->load('auth/template', 'auth/masuk', $data);
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($post['masuk'])){
			$query_masuk = $this->pengguna->masuk($post);
			if($query_masuk->num_rows() > 0){
				$row = $query_masuk->row_array();
				$username = $row['username'];
				$this->session->set_userdata('username', $username);
				$this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissible">
																	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
																	                <h4><i class="icon fa fa-check"></i> Anda Berhasil Masuk!</h4>
																	                Selamat datang '.$row['nama_lengkap'].'. Kami senang melihat anda kembali.
																	              </div>');
				redirect('beranda');
			}else{
				$this->session->set_flashdata('sukses', '<div class="alert alert-danger alert-dismissible">
																	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
																	                <h4><i class="icon fa fa-ban"></i> Gagal Masuk!</h4>
																	                Nama Pengguna / Kata Sandi salah!
																	              </div>');
				redirect('auth');
			}
		}else if(isset($post['daftar'])){
			echo "proses daftar";
		} else {
			echo "tidak ada post";
		}
	}

	public function daftar()
	{
		$data['judul'] = "Daftar";
		$this->template->load('auth/template', 'auth/daftar', $data);
	}

	public function lupa_sandi()
	{
		$data['judul'] = "Lupa Kata Sandi";
		$this->template->load('auth/template', 'auth/lupa_sandi', $data);
	}

	public function keluar()
	{
		$this->session->unset_userdata('username');
		$this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissible">
																	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
																	                Anda telah keluar!
																	                </div>');
		redirect('auth');
	}
}
