<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
    cek_tidak_masuk();
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
		$data['judul'] = "Pelanggan";
		$data['subjudul'] = "Pelanggan";
		$data['pelanggan'] = $this->pelanggan->get()->result_array();
		$this->template->load('template', 'pelanggan/index', $data);
	}

	public function tambah()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['judul'] = "Pelanggan";
		$data['subjudul'] = "Tambah Pelanggan";
		$data['hal'] = "tambah";
		$data['id_pelanggan'] = "CS".time();
		$data['nama'] = "";
		$data['jk'] = "";
		$data['telpon'] = "";
		$data['email'] = "";
		$data['alamat'] = "";
		$this->template->load('template', 'pelanggan/form', $data);
	}

	public function ubah($id=null)
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		if($id==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Tidak ada pelanggan yang dipilih</p>
															              </div>');
			redirect('pelanggan');
		}else{
			$pelanggan = $this->pelanggan->get($id)->row_array();
			$data['judul'] = "Pelanggan";
			$data['subjudul'] = "Ubah Pelanggan";
			$data['hal'] = "ubah";
			$data['id_pelanggan'] = $pelanggan['id_pelanggan'];
			$data['nama'] = $pelanggan['nama'];
			$data['jk'] = $pelanggan['jk'];
			$data['telpon'] = $pelanggan['telpon'];
			$data['email'] = $pelanggan['email'];
			$data['alamat'] = $pelanggan['alamat'];
			$this->template->load('template', 'pelanggan/form', $data);
		}
	}

	public function proses($form=null, $id=null)
	{
		if($form==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Tidak ada proses yang dipilih</p>
															              </div>');
			redirect('pelanggan');
		}else{
			if($form=='tambah'){
				$this->form_validation->set_rules('nama', 'Nama Pelanggan', 'required',[
					'required' => 'Nama Pelanggan harus diisi!',
				]);
				$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required',[
					'required' => 'Jenis Kelamin harus dipilih!',
				]);
				$this->form_validation->set_rules('telpon', 'No. Telepon Pelanggan', 'required',[
					'required' => 'No. Telepon Pelanggan harus diisi!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->tambah();
				}else{
					$post = $this->input->post(null, TRUE);
					$query_tambah = $this->pelanggan->tambah($post);
					if($query_tambah){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>'.$post['nama'].' telah ditambahkan.</p>
																		              </div>');
						redirect('pelanggan');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>'.$post['nama'].' gagal ditambahkan.</p>
																		              </div>');
						redirect('pelanggan');
					}
				}
			}else if($form=='ubah'){
				$this->form_validation->set_rules('nama', 'Nama Pelanggan', 'required',[
					'required' => 'Nama Pelanggan harus diisi!',
				]);
				$this->form_validation->set_rules('telpon', 'No. Telepon Pelanggan', 'required',[
					'required' => 'No. Telepon Pelanggan harus diisi!',
				]);
				$this->form_validation->set_rules('jk', 'Jenis Kalamin', 'required',[
					'required' => 'Jenis Kalamin harus dipilih!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->ubah($id);
				}else{
					$post = $this->input->post(null, TRUE);
					$query_ubah = $this->pelanggan->ubah($post);
					if($query_ubah){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>'.$post['nama'].' telah diperbarui.</p>
																		              </div>');
						redirect('pelanggan');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>'.$post['nama'].' gagal diperbarui.</p>
																		              </div>');
						redirect('pelanggan');
					}
				}
			}
		}
	}

	public function hapus($id=null)
	{
		if($id==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
															                <p>Tidak ada pelanggan yang dipilih.</p>
															              </div>');
			redirect('pelanggan');
		}else{
			$nama = $this->input->post('nama');
			$query_hapus = $this->pelanggan->hapus($id);
			if($query_hapus){
				$this->session->set_flashdata('info', '<div class="callout callout-success">
																								<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																                <p>'.$nama.' telah dihapus.</p>
																              </div>');
				redirect('pelanggan');
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																                <p>'.$nama.' gagal dihapus.</p>
																              </div>');
				redirect('pelanggan');
			}
		}
	}
}
