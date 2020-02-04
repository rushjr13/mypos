<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

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
		$data['judul'] = "Supplier";
		$data['subjudul'] = "Pemasok Barang";
		$data['supplier'] = $this->supplier->get()->result_array();
		$this->template->load('template', 'supplier/index', $data);
	}

	public function tambah()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['judul'] = "Supplier";
		$data['subjudul'] = "Tambah Supplier";
		$data['hal'] = "tambah";
		$data['id_supplier'] = "SP".time();
		$data['nama'] = "";
		$data['telpon'] = "";
		$data['email'] = "";
		$data['alamat'] = "";
		$data['deskripsi'] = "";
		$this->template->load('template', 'supplier/form', $data);
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
															                <p>Tidak ada supplier yang dipilih</p>
															              </div>');
			redirect('supplier');
		}else{
			$supplier = $this->supplier->get($id)->row_array();
			$data['judul'] = "Supplier";
			$data['subjudul'] = "Ubah Supplier";
			$data['hal'] = "ubah";
			$data['id_supplier'] = $supplier['id_supplier'];
			$data['nama'] = $supplier['nama'];
			$data['telpon'] = $supplier['telpon'];
			$data['email'] = $supplier['email'];
			$data['alamat'] = $supplier['alamat'];
			$data['deskripsi'] = $supplier['deskripsi'];
			$this->template->load('template', 'supplier/form', $data);
		}
	}

	public function proses($form=null, $id=null)
	{
		if($form==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Tidak ada proses yang dipilih</p>
															              </div>');
			redirect('supplier');
		}else{
			if($form=='tambah'){
				$this->form_validation->set_rules('nama', 'Nama Supplier', 'required',[
					'required' => 'Nama Supplier harus diisi!',
				]);
				$this->form_validation->set_rules('telpon', 'No. Telepon Supplier', 'required',[
					'required' => 'No. Telepon Supplier harus diisi!',
				]);
				$this->form_validation->set_rules('email', 'Email Supplier', 'required|valid_email',[
					'required' => 'Email Supplier harus diisi!',
					'valid_email' => 'Email yang anda masukkan tidak valid!',
				]);
				$this->form_validation->set_rules('alamat', 'Alamat Supplier', 'required',[
					'required' => 'Alamat Supplier harus diisi!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->tambah();
				}else{
					$post = $this->input->post(null, TRUE);
					$query_tambah = $this->supplier->tambah($post);
					if($query_tambah){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>'.$post['nama'].' telah ditambahkan.</p>
																		              </div>');
						redirect('supplier');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>'.$post['nama'].' gagal ditambahkan.</p>
																		              </div>');
						redirect('supplier');
					}
				}
			}else if($form=='ubah'){
				$this->form_validation->set_rules('nama', 'Nama Supplier', 'required',[
					'required' => 'Nama Supplier harus diisi!',
				]);
				$this->form_validation->set_rules('telpon', 'No. Telepon Supplier', 'required',[
					'required' => 'No. Telepon Supplier harus diisi!',
				]);
				$this->form_validation->set_rules('email', 'Email Supplier', 'required|valid_email',[
					'required' => 'Email Supplier harus diisi!',
					'valid_email' => 'Email yang anda masukkan tidak valid!',
				]);
				$this->form_validation->set_rules('alamat', 'Alamat Supplier', 'required',[
					'required' => 'Alamat Supplier harus diisi!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->ubah($id);
				}else{
					$post = $this->input->post(null, TRUE);
					$query_ubah = $this->supplier->ubah($post);
					if($query_ubah){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>'.$post['nama'].' telah diperbarui.</p>
																		              </div>');
						redirect('supplier');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>'.$post['nama'].' gagal diperbarui.</p>
																		              </div>');
						redirect('supplier');
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
															                <p>Tidak ada supplier yang dipilih.</p>
															              </div>');
			redirect('supplier');
		}else{
			$nama = $this->input->post('nama');
			$query_hapus = $this->supplier->hapus($id);
			if($query_hapus){
				$this->session->set_flashdata('info', '<div class="callout callout-success">
																								<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																                <p>'.$nama.' telah dihapus.</p>
																              </div>');
				redirect('supplier');
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																                <p>'.$nama.' gagal dihapus.</p>
																              </div>');
				redirect('supplier');
			}
		}
	}
}
