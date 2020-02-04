<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
      date_default_timezone_set('Asia/Makassar');
    }

	public function index()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		if($level_pengguna==1){
			$data['judul'] = "Pengguna";
			$data['subjudul'] = "Data Pengguna";
			$data['pengguna'] = $this->pengguna->get()->result_array();
			$this->template->load('template', 'pengguna/index', $data);
		}else{
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Hanya Administrator yang dapat mengakses halaman <strong>Pengguna</strong>.</p>
															              </div>');
			redirect('beranda');
		}
	}

	public function tambah()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		if($level_pengguna==1){
			$this->form_validation->set_rules('username', 'Nama Pengguna', 'required|is_unique[pengguna.username]',[
				'required' => 'Nama Pengguna harus diisi!',
				'is_unique' => 'Nama Pengguna sudah digunakan!',
			]);
			$this->form_validation->set_rules('password', 'Kata Sandi', 'required',[
				'required' => 'Kata Sandi harus diisi!',
			]);
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required',[
				'required' => 'Nama Lengkap harus diisi!',
			]);
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[pengguna.email]|valid_email',[
				'required' => 'Email harus diisi!',
				'is_unique' => 'Email sudah terdaftar pada Pengguna lain!',
				'valid_email' => 'Email yang anda masukkan tidak valid!',
			]);
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required',[
				'required' => 'Jenis Kelamin harus dipilih!',
			]);
			$this->form_validation->set_rules('alamat', 'Alamat', 'required',[
				'required' => 'Alamat harus diisi!',
			]);
			$this->form_validation->set_rules('level', 'Level', 'required',[
				'required' => 'Level harus dipilih!',
			]);

			if ($this->form_validation->run() == FALSE){
				$data['judul'] = "Pengguna";
				$data['subjudul'] = "Tambah Pengguna";
				$this->template->load('template', 'pengguna/tambah', $data);
			}else{
				$post = $this->input->post(null, TRUE);
				$query_tambah = $this->pengguna->tambah($post);
				if($query_tambah){
					$this->session->set_flashdata('info', '<div class="callout callout-success">
																									<h4><i class="icon fa fa-check"></i> Proses Tambah Pengguna Berhasil!</h4>
																	                <p>'.$post['nama_lengkap'].' berhasil ditambahkan.</p>
																	              </div>');
					redirect('pengguna');
				}else{
					$this->session->set_flashdata('info', '<div class="callout callout-danger">
																									<h4><i class="icon fa fa-ban"></i> Proses Tambah Pengguna Gagal!</h4>
																	                <p>'.$post['nama_lengkap'].' gagal ditambahkan.</p>
																	              </div>');
					redirect('pengguna');
				}
			}
		}else{
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Hanya Administrator yang dapat menambah pengguna.</p>
															              </div>');
			redirect('beranda');
		}
	}

	public function ubah($id=null)
	{
// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		if($level_pengguna==1){
			if($id==null){
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
	              																	<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
																	                <p>Tidak ada Pengguna yang dipilih.</p>
																	              </div>');
				redirect('pengguna');
			}else{
				$this->form_validation->set_rules('username', 'Nama Pengguna', 'required',[
					'required' => 'Nama Pengguna harus diisi!',
				]);
				$this->form_validation->set_rules('password', 'Kata Sandi', 'required',[
					'required' => 'Kata Sandi harus diisi!',
				]);
				$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required',[
					'required' => 'Nama Lengkap harus diisi!',
				]);
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email',[
					'required' => 'Email harus diisi!',
					'valid_email' => 'Email yang anda masukkan tidak valid!',
				]);
				$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required',[
					'required' => 'Jenis Kelamin harus dipilih!',
				]);
				$this->form_validation->set_rules('alamat', 'Alamat', 'required',[
					'required' => 'Alamat harus diisi!',
				]);
				$this->form_validation->set_rules('level', 'Level', 'required',[
					'required' => 'Level harus dipilih!',
				]);

				if ($this->form_validation->run() == FALSE){
					$data['judul'] = "Pengguna";
					$data['subjudul'] = "Ubah Pengguna";
					$data['pengguna'] = $this->pengguna->get($id)->row_array();
					$this->template->load('template', 'pengguna/ubah', $data);
				}else{
					$post = $this->input->post(null, TRUE);
					$query_ubah = $this->pengguna->ubah($post);
					if($query_ubah){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Ubah Pengguna Berhasil!</h4>
																		                <p>'.$post['nama_lengkap'].' berhasil diperbarui.</p>
																		              </div>');
						redirect('pengguna');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Ubah Pengguna Gagal!</h4>
																		                <p>'.$post['nama_lengkap'].' gagal diperbarui.</p>
																		              </div>');
						redirect('pengguna');
					}
				}
			}
		}else{
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Hanya Administrator yang dapat menambah pengguna.</p>
															              </div>');
			redirect('beranda');
		}
	}

	public function profil($username=null)
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		if($username==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
              																	<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
																                <p>Tidak ada Pengguna yang dipilih.</p>
																              </div>');
			redirect('beranda');
		}else{
			$this->form_validation->set_rules('password', 'Kata Sandi', 'required',[
				'required' => 'Kata Sandi harus diisi!',
			]);
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required',[
				'required' => 'Nama Lengkap harus diisi!',
			]);
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email',[
				'required' => 'Email harus diisi!',
				'valid_email' => 'Email yang anda masukkan tidak valid!',
			]);
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required',[
				'required' => 'Jenis Kelamin harus dipilih!',
			]);
			$this->form_validation->set_rules('alamat', 'Alamat', 'required',[
				'required' => 'Alamat harus diisi!',
			]);
			$this->form_validation->set_rules('level', 'Level', 'required',[
				'required' => 'Level harus dipilih!',
			]);

			if ($this->form_validation->run() == FALSE){
				$data['judul'] = "Pengguna";
				$data['subjudul'] = "Ubah Pengguna";
				$this->template->load('template', 'pengguna/profil', $data);
			}else{
				$this->ubah_profil($username);
			}
		}
	}

	public function ubah_profil($username=null)
	{
		if($username==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
              																	<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
																                <p>Tidak ada Pengguna yang dipilih.</p>
																              </div>');
			redirect('pengguna');
		}else{
			$post = $this->input->post(null, TRUE);
			if(isset($post['ubahprofilumum'])){
				$query_ubah = $this->pengguna->ubah($post);
				if($query_ubah){
					$this->session->set_flashdata('info', '<div class="callout callout-success">
																									<h4><i class="icon fa fa-check"></i> Proses Ubah Profil Berhasil!</h4>
																	                <p>Profil Anda berhasil diperbarui.</p>
																	              </div>');
					redirect('pengguna/profil/'.$username);
				}else{
					$this->session->set_flashdata('info', '<div class="callout callout-danger">
																									<h4><i class="icon fa fa-ban"></i> Proses Ubah Profil Gagal!</h4>
																	                <p>Profil Anda gagal diperbarui.</p>
																	              </div>');
					redirect('pengguna/profil/'.$username);
				}
			}else if(isset($post['ubahprofilfoto'])){
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Proses Ubah Profil Gagal!</h4>
																                <p>Foto Profil Anda gagal diperbarui.</p>
																              </div>');
				redirect('pengguna/profil/'.$username);
			}
		}
	}

	public function hapus($user=null)
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		if($level_pengguna==1){
			if($user==null){
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
	              																	<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
																	                <p>Tidak ada Pengguna yang dipilih.</p>
																	              </div>');
				redirect('pengguna');
			}else{
				$nama_lengkap = $this->input->post('nama_lengkap');
				$query_hapus = $this->pengguna->hapus($user);
				if($query_hapus){
					$this->session->set_flashdata('info', '<div class="callout callout-success">
	                																	<h4><i class="icon fa fa-check"></i> Proses Hapus Pengguna Berhasil!</h4>
																		                <p>'.$nama_lengkap.' telah dihapus.</p>
																		              </div>');
					redirect('pengguna');
				}else{
					$this->session->set_flashdata('info', '<div class="callout callout-danger">
	                																	<h4><i class="icon fa fa-ban"></i> Proses Hapus Pengguna Gagal!</h4>
																		                <p>'.$nama_lengkap.' gagal dihapus.</p>
																		              </div>');
					redirect('pengguna');
				}
			}
		}else{
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
              																	<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
																                <p>Hanya Administrator yang dapat menghapus pengguna.</p>
																              </div>');
			redirect('beranda');
		}
	}

	public function status($user=null)
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		if($level_pengguna==1){
			if($user==null){
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
	              																	<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
																	                <p>Tidak ada Pengguna yang dipilih.</p>
																	              </div>');
				redirect('pengguna');
			}else{
				$nama_lengkap = $this->input->post('nama_lengkap');
				$status_pengguna = $this->input->post('sts_pengguna');
				$ket_status = $this->input->post('ket_status');
				$query_status = $this->pengguna->status($user, $status_pengguna);
				if($query_status){
					$this->session->set_flashdata('info', '<div class="callout callout-success">
	                																	<h4><i class="icon fa fa-check"></i> Perubahan Status Pengguna Berhasil!</h4>
																		                <p>'.$nama_lengkap.' telah di '.$ket_status.'.</p>
																		              </div>');
					redirect('pengguna');
				}else{
					$this->session->set_flashdata('info', '<div class="callout callout-danger">
	                																	<h4><i class="icon fa fa-ban"></i> Perubahan Status Pengguna Gagal!</h4>
																		                <p>'.$nama_lengkap.' tidak dapat di '.$ket_status.'.</p>
																		              </div>');
					redirect('pengguna');
				}
			}
		}else{
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
              																	<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
																                <p>Hanya Administrator yang dapat merubah status pengguna.</p>
																              </div>');
			redirect('beranda');
		}
	}
}
