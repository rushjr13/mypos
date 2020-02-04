<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
  {
      parent::__construct();
  }

	public function index()
	{
    // UMUM
    cek_sudah_masuk();
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
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
				if($row['status_pengguna']=="Aktif"){
					$this->session->set_userdata('username', $username);
					$this->session->set_flashdata('info', '<div class="callout callout-success">
	                																	<h4><i class="icon fa fa-check"></i> Anda Berhasil Masuk!</h4>
																		                <p>Selamat datang <strong>'.$row['nama_lengkap'].'</strong>. Kami senang melihat Anda kembali.</p>
																		              </div>');
					if($row['level']==1){
						redirect('pengguna/profil/'.$username);
					}else{
						redirect('penjualan');
					}
				}else{
					$this->session->set_flashdata('info', '<div class="callout callout-danger">
	                																	<h4><i class="icon fa fa-ban"></i> Gagal Masuk!</h4>
																		                <p>Akun Anda (<strong>'.$username.'</strong>) belum aktif. Silahkan hubungi Administator untuk aktivasi akun Anda.</p>
																		              </div>');
					redirect('masuk');
				}
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
                																	<h4><i class="icon fa fa-ban"></i> Gagal Masuk!</h4>
																	                <p>Nama Pengguna / Kata Sandi salah!</p>
																	              </div>');
				redirect('masuk');
			}
		}else if(isset($post['daftar'])){
			echo "proses daftar";
		} else {
			echo "tidak ada post";
		}
	}

	public function daftar()
	{
    // UMUM
    cek_sudah_masuk();
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['judul'] = "Daftar";
		$this->template->load('auth/template', 'auth/daftar', $data);
	}

	public function lupa_sandi()
	{
    // UMUM
    cek_sudah_masuk();
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['judul'] = "Lupa Kata Sandi";
		$this->template->load('auth/template', 'auth/lupa_sandi', $data);
	}

	public function keluar()
	{
		$this->session->unset_userdata('username');
		$this->session->set_flashdata('info', '<div class="callout callout-success">
															                <p><i class="fa fa-check"></i> Anda telah keluar.</p>
															              </div>');
		redirect('masuk');
	}
}
