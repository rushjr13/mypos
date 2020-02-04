<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

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
		$data['judul'] = "Penjualan";
		$data['subjudul'] = "Transaksi Penjualan";
		$data['pelanggan'] = $this->pelanggan->get()->result_array();
		$data['item'] = $this->item->getjual()->result_array();
		$hari_ini = date('Y-m-d',time());
		$jphi = $this->penjualan->get_id($hari_ini)->num_rows();
		if($jphi<10){
			$data['id_penjualan'] = $data['pengaturan']['nama_alias'].date('ymd',time()).'000'.($jphi+1);
		}else if($jphi<100){
			$data['id_penjualan'] = $data['pengaturan']['nama_alias'].date('ymd',time()).'00'.($jphi+1);
		}else if($jphi<1000){
			$data['id_penjualan'] = $data['pengaturan']['nama_alias'].date('ymd',time()).'0'.($jphi+1);
		}else if($jphi<10000){
			$data['id_penjualan'] = $data['pengaturan']['nama_alias'].date('ymd',time()).($jphi+1);
		}
		$data['penjualan_template'] = $this->penjualan->penjualan_template($data['id_penjualan'])->result_array();
		$this->template->load('template', 'transaksi/penjualan/index', $data);
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		$barang = $this->db->get_where('penjualan_template', ['id_item'=>$post['id_item']])->num_rows();
		$penjualan_template = $this->penjualan->penjualan_template($post['id_penjualan'])->result_array();

		if(isset($post['tbltambahbarang'])){
			if($post['id_item']){
				if($post['jumlah']>0){
					if($barang>0){
						$this->penjualan->penjualan_template_tambah2($post);
					}else{
						$this->penjualan->penjualan_template_tambah($post);
					}
					if($this->db->affected_rows()>0){
						redirect('penjualan');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Gagal Tambah Barang!</h4>
																		                <p>'.$this->db->error().'.</p>
																		              </div>');
						redirect('penjualan');
					}
				}else{
					$this->session->set_flashdata('info', '<div class="callout callout-danger">
																									<h4><i class="icon fa fa-ban"></i> Gagal Tambah Barang!</h4>
																	                <p>Jumlah barang yang dipilih minimal 1.</p>
																	              </div>');
					redirect('penjualan');
				}
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Gagal Tambah Barang!</h4>
																                <p>Tidak ada barang yang dipilih.</p>
																              </div>');
				redirect('penjualan');
			}
		}else if(isset($post['tblubahbarang'])){
			if($post['jumlah']>0){
				if($post['diskon_item']==0 || $post['diskon_item']>0){
					$this->penjualan->penjualan_template_ubah($post);
					if($this->db->affected_rows()>0){
						redirect('penjualan');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Gagal Ubah Barang!</h4>
																		                <p>'.$this->db->error().'.</p>
																		              </div>');
						redirect('penjualan');
					}
				}else{
					$this->session->set_flashdata('info', '<div class="callout callout-danger">
																									<h4><i class="icon fa fa-ban"></i> Gagal Ubah Barang!</h4>
																	                <p>Diskon barang tidak boleh kurang dari nol (0).</p>
																	              </div>');
					redirect('penjualan');
				}
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Gagal Ubah Barang!</h4>
																                <p>Jumlah barang yang dipilih minimal 1.</p>
																              </div>');
				redirect('penjualan');
			}
		}else if(isset($post['tblhapusbarang'])){
			$this->penjualan->penjualan_template_hapus($post);
			if($this->db->affected_rows()>0){
				redirect('penjualan');
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Gagal Hapus Barang!</h4>
																                <p>'.$this->db->db_debug().'.</p>
																              </div>');
				redirect('penjualan');
			}
		}else if(isset($post['tblprosespenjualan'])){
			if($post['tunai']>0){
				if($post['sisauang']>0 || $post['sisauang']==0){
					$this->penjualan->penjualan_tambah($post);
					foreach ($penjualan_template as $pjtp) {
						$post = [
							'id_penjualan'=>$pjtp['id_penjualan'],
							'id_item'=>$pjtp['id_item'],
							'jumlah'=>$pjtp['jumlah'],
							'diskon_item'=>$pjtp['diskon_item'],
							'tgl_update_penjualan_template'=>$pjtp['tgl_update_penjualan_template'],
						];
						$this->penjualan->penjualan_item($post);
						$this->item->stok_keluar_update($post);
					}
					$this->db->empty_table('penjualan_template');
					$this->session->set_flashdata('info', '<div class="callout callout-success">
																									<h4><i class="icon fa fa-check"></i> Proses Penjualan Berhasil!</h4>
																	                <p>Cetak Struk Penjualan!</p>
																	              </div>');
					redirect('penjualan/struk/'.$post['id_penjualan']);
				}else{
					$this->session->set_flashdata('info', '<div class="callout callout-danger">
																									<h4><i class="icon fa fa-ban"></i> Proses Penjualan Gagal!</h4>
																	                <p>Jumlah uang tunai tidak cukup!</p>
																	              </div>');
					redirect('penjualan');
				}
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Proses Penjualan Gagal!</h4>
																                <p>Jumlah uang tunai harus diisi!</p>
																              </div>');
				redirect('penjualan');
			}
		}else if(isset($post['tblbatalpenjualan'])){
			$this->db->empty_table('penjualan_template');
			$this->session->set_flashdata('info', '<div class="callout callout-success">
																							<h4><i class="icon fa fa-check"></i> Proses Penjualan Dibatalkan!</h4>
															                <p>Transaksi penjualan telah dibatalkan!</p>
															              </div>');
			redirect('penjualan/');
		}
	}

	public function laporan()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['judul'] = "Laporan";
		$data['subjudul'] = "Penjualan";
		$data['penjualan'] = $this->penjualan->get()->result_array();
		$this->template->load('template', 'laporan/penjualan/index', $data);
	}

	public function struk($id=null)
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
															                <p>Tidak ada transaksi penjualan yang dipilih!</p>
															              </div>');
			redirect('penjualan');
		}else{
			$data['judul'] = "Penjualan";
			$data['subjudul'] = "Cetak Struk";
			$data['penjualan'] = $this->penjualan->get($id)->row_array();
			$data['penjualan_item'] = $this->penjualan->penjualan_item_data($data['penjualan']['id_penjualan'])->result_array();
			$this->template->load('template', 'transaksi/penjualan/struk', $data);
		}
	}

	public function cetak($id=null)
	{
		// UMUM
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		if($id==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Tidak ada transaksi penjualan yang dipilih!</p>
															              </div>');
			redirect('penjualan');
		}else{
			$data['judul'] = "Penjualan";
			$data['subjudul'] = "Cetak Struk";
			$data['penjualan'] = $this->penjualan->get($id)->row_array();
			$data['penjualan_item'] = $this->penjualan->penjualan_item_data($data['penjualan']['id_penjualan'])->result_array();
			$this->load->view('transaksi/penjualan/cetak', $data);
		}
	}
}
