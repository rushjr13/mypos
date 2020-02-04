<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

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
		$data['judul'] = "Kategori";
		$data['subjudul'] = "Kategori Barang";
		$data['kategori'] = $this->kategori->get()->result_array();
		$this->template->load('template', 'produk/kategori/index', $data);
	}

	public function tambah()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['judul'] = "Kategori";
		$data['subjudul'] = "Tambah Kategori";
		$data['hal'] = "tambah";
		$data['id_kategori'] = "KTG".time();
		$data['nama_kategori'] = "";
		$this->template->load('template', 'produk/kategori/form', $data);
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
															                <p>Tidak ada kategori yang dipilih</p>
															              </div>');
			redirect('kategori');
		}else{
			$kategori = $this->kategori->get($id)->row_array();
			$data['judul'] = "Kategori";
			$data['subjudul'] = "Ubah Kategori";
			$data['hal'] = "ubah";
			$data['id_kategori'] = $kategori['id_kategori'];
			$data['nama_kategori'] = $kategori['nama_kategori'];
			$this->template->load('template', 'produk/kategori/form', $data);
		}
	}

	public function proses($form=null, $id=null)
	{
		if($form==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Tidak ada proses yang dipilih</p>
															              </div>');
			redirect('kategori');
		}else{
			if($form=='tambah'){
				$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required',[
					'required' => 'Nama Kategori harus diisi!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->tambah();
				}else{
					$post = $this->input->post(null, TRUE);
					$query_tambah = $this->kategori->tambah($post);
					if($query_tambah){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>Kategori '.$post['nama_kategori'].' telah ditambahkan.</p>
																		              </div>');
						redirect('kategori');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>Kategori '.$post['nama_kategori'].' gagal ditambahkan.</p>
																		              </div>');
						redirect('kategori');
					}
				}
			}else if($form=='ubah'){
				$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required',[
					'required' => 'Nama Kategori harus diisi!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->ubah($id);
				}else{
					$post = $this->input->post(null, TRUE);
					$query_ubah = $this->kategori->ubah($post);
					if($query_ubah){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>Kategori '.$post['nama_kategori'].' telah diperbarui.</p>
																		              </div>');
						redirect('kategori');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>Kategori '.$post['nama_kategori'].' gagal diperbarui.</p>
																		              </div>');
						redirect('kategori');
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
															                <p>Tidak ada kategori yang dipilih.</p>
															              </div>');
			redirect('kategori');
		}else{
			$nama_kategori = $this->input->post('nama_kategori');
			$query_hapus = $this->kategori->hapus($id);
			if($query_hapus){
				$this->session->set_flashdata('info', '<div class="callout callout-success">
																								<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																                <p>Kategori '.$nama_kategori.' telah dihapus.</p>
																              </div>');
				redirect('kategori');
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																                <p>Kategori '.$nama_kategori.' gagal dihapus.</p>
																              </div>');
				redirect('kategori');
			}
		}
	}
}
