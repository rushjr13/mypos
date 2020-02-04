<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

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
		$data['judul'] = "Unit";
		$data['subjudul'] = "Unit Satuan Barang";
		$data['unit'] = $this->unit->get()->result_array();
		$this->template->load('template', 'produk/unit/index', $data);
	}

	public function tambah()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['judul'] = "Unit";
		$data['subjudul'] = "Tambah Unit Satuan Barang";
		$data['hal'] = "tambah";
		$data['id_unit'] = "UNT".time();
		$data['nama_unit'] = "";
		$this->template->load('template', 'produk/unit/form', $data);
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
															                <p>Tidak ada unit yang dipilih</p>
															              </div>');
			redirect('unit');
		}else{
			$unit = $this->unit->get($id)->row_array();
			$data['judul'] = "Unit";
			$data['subjudul'] = "Ubah Unit Satuan Barang";
			$data['hal'] = "ubah";
			$data['id_unit'] = $unit['id_unit'];
			$data['nama_unit'] = $unit['nama_unit'];
			$this->template->load('template', 'produk/unit/form', $data);
		}
	}

	public function proses($form=null, $id=null)
	{
		if($form==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Tidak ada proses yang dipilih</p>
															              </div>');
			redirect('unit');
		}else{
			if($form=='tambah'){
				$this->form_validation->set_rules('nama_unit', 'Nama Unit', 'required',[
					'required' => 'Nama Unit harus diisi!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->tambah();
				}else{
					$post = $this->input->post(null, TRUE);
					$query_tambah = $this->unit->tambah($post);
					if($query_tambah){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>Satuan '.$post['nama_unit'].' telah ditambahkan.</p>
																		              </div>');
						redirect('unit');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>Satuan '.$post['nama_unit'].' gagal ditambahkan.</p>
																		              </div>');
						redirect('unit');
					}
				}
			}else if($form=='ubah'){
				$this->form_validation->set_rules('nama_unit', 'Nama Unit', 'required',[
					'required' => 'Nama Unit harus diisi!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->ubah($id);
				}else{
					$post = $this->input->post(null, TRUE);
					$query_ubah = $this->unit->ubah($post);
					if($query_ubah){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>Satuan '.$post['nama_unit'].' telah diperbarui.</p>
																		              </div>');
						redirect('unit');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>Satuan '.$post['nama_unit'].' gagal diperbarui.</p>
																		              </div>');
						redirect('unit');
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
															                <p>Tidak ada unit yang dipilih.</p>
															              </div>');
			redirect('unit');
		}else{
			$nama_unit = $this->input->post('nama_unit');
			$query_hapus = $this->unit->hapus($id);
			if($query_hapus){
				$this->session->set_flashdata('info', '<div class="callout callout-success">
																								<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																                <p>Satuan '.$nama_unit.' telah dihapus.</p>
																              </div>');
				redirect('unit');
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																                <p>Satuan '.$nama_unit.' gagal dihapus.</p>
																              </div>');
				redirect('unit');
			}
		}
	}
}
