<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
    cek_tidak_masuk();
    date_default_timezone_set('Asia/Makassar');
  }

	public function stok_masuk()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['judul'] = "Stok Masuk";
		$data['subjudul'] = "Stok Masuk Barang";
		$data['stok'] = $this->stok->get('masuk')->result_array();
		$this->template->load('template', 'transaksi/stok/masuk/index', $data);
	}

	public function stok_masuk_tambah()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['item'] = $this->item->get()->result_array();
		$data['supplier'] = $this->supplier->get()->result_array();
		$data['judul'] = "Stok Masuk";
		$data['subjudul'] = "Tambah Stok Masuk Barang";
		$this->template->load('template', 'transaksi/stok/masuk/form', $data);
	}

	public function stok_masuk_hapus($id=null)
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
															                <p>Tidak ada stok yang dipilih</p>
															              </div>');
			redirect('stok/masuk');
		}else{
			$post = $this->input->post(null, TRUE);
			$this->item->stok_keluar_update($post);
			$this->stok->stok_masuk_hapus($post);
			if($this->db->affected_rows()>0){
				$this->session->set_flashdata('info', '<div class="callout callout-success">
																								<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																                <p>Stok Masuk '.$post['nama_item'].' telah dihapus.</p>
																              </div>');
				redirect('stok/masuk');
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																                <p>Stok Masuk '.$post['nama_item'].' gagal dihapus.</p>
																              </div>');
				redirect('stok/masuk');
			}
		}
	}

	public function stok_keluar()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['judul'] = "Stok Keluar";
		$data['subjudul'] = "Stok Keluar Barang";
		$data['stok'] = $this->stok->get('keluar')->result_array();
		$this->template->load('template', 'transaksi/stok/keluar/index', $data);
	}

	public function stok_keluar_tambah()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['item'] = $this->item->get()->result_array();
		$data['judul'] = "Stok Keluar";
		$data['subjudul'] = "Tambah Stok Keluar Barang";
		$this->template->load('template', 'transaksi/stok/keluar/form', $data);
	}

	public function stok_keluar_hapus($id=null)
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
															                <p>Tidak ada stok yang dipilih</p>
															              </div>');
			redirect('stok/keluar');
		}else{
			$post = $this->input->post(null, TRUE);
			$this->item->stok_masuk_update($post);
			$this->stok->stok_keluar_hapus($post);
			if($this->db->affected_rows()>0){
				$this->session->set_flashdata('info', '<div class="callout callout-success">
																								<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																                <p>Stok Masuk '.$post['nama_item'].' telah dihapus.</p>
																              </div>');
				redirect('stok/keluar');
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																                <p>Stok Masuk '.$post['nama_item'].' gagal dihapus.</p>
																              </div>');
				redirect('stok/keluar');
			}
		}
	}

	public function proses($stok=null)
	{
		if($stok==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Tidak ada proses stok yang dipilih</p>
															              </div>');
			redirect('beranda');
		}else{
			if($stok=='masuk'){
				$this->form_validation->set_rules('id_item', 'Kode Barang', 'required',[
					'required' => 'Kode Barang harus diisi!',
				]);
				$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|greater_than[0]',[
					'required' => 'Jumlah harus diisi!',
					'greater_than' => 'Jumlah harus lebih dari 0!',
				]);
				$this->form_validation->set_rules('tanggal', 'Tanggal', 'required',[
					'required' => 'Tanggal harus diisi!',
				]);
				$this->form_validation->set_rules('detail', 'Detail Stok', 'required',[
					'required' => 'Detail Stok harus diisi!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->stok_masuk_tambah();
				}else{
					$post = $this->input->post(null, TRUE);
					$this->stok->stok_masuk_tambah($post);
					$this->item->stok_masuk_update($post);
					if($this->db->affected_rows()>0){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>Stok Masuk '.$post['nama_item'].' telah ditambahkan.</p>
																		              </div>');
						redirect('stok/masuk');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>Stok Masuk '.$post['nama_item'].' gagal ditambahkan.</p>
																		              </div>');
						redirect('stok/masuk');
					}
				}
			}else if($stok=='keluar'){
				$this->form_validation->set_rules('id_item', 'Kode Barang', 'required',[
					'required' => 'Kode Barang harus diisi!',
				]);
				$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|greater_than[0]',[
					'required' => 'Jumlah harus diisi!',
					'greater_than' => 'Jumlah harus lebih dari 0!',
				]);
				$this->form_validation->set_rules('tanggal', 'Tanggal', 'required',[
					'required' => 'Tanggal harus diisi!',
				]);
				$this->form_validation->set_rules('detail', 'Detail Stok', 'required',[
					'required' => 'Detail Stok harus diisi!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->stok_keluar_tambah();
				}else{
					$post = $this->input->post(null, TRUE);
					if($post['stok']==0){
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>Stok '.$post['nama_item'].' tidak ada (0).</p>
																		              </div>');
						redirect('stok/keluar/tambah');
					}else{
						if($post['jumlah']>$post['stok']){
							$this->session->set_flashdata('info', '<div class="callout callout-danger">
																											<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																			                <p>Jumlah yang dikeluarkan ('.$post['jumlah'].') lebih besar dari Stok '.$post['nama_item'].' ('.$post['stok'].').</p>
																			              </div>');
							redirect('stok/keluar/tambah');
						}else{
							$this->stok->stok_keluar_tambah($post);
							$this->item->stok_keluar_update($post);
							if($this->db->affected_rows()>0){
								$this->session->set_flashdata('info', '<div class="callout callout-success">
																												<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																				                <p>Stok Keluar '.$post['nama_item'].' telah ditambahkan.</p>
																				              </div>');
								redirect('stok/keluar');
							}else{
								$this->session->set_flashdata('info', '<div class="callout callout-danger">
																												<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																				                <p>Stok Keluar '.$post['nama_item'].' gagal ditambahkan.</p>
																				              </div>');
								redirect('stok/keluar');
							}
						}
					}
				}
			}
		}
	}

}
