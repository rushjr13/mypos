<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

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
		$data['judul'] = "Pengeluaran";
		$data['subjudul'] = "Data Pengeluaran";
		$data['pengeluaran'] = $this->pengeluaran->get()->result_array();
		$this->template->load('template', 'transaksi/pengeluaran/index', $data);
	}

	public function tambah()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['judul'] = "Pengeluaran";
		$data['subjudul'] = "Tambah Pengeluaran";
		$data['hal'] = "tambah";
		$data['id_pengeluaran'] = "KLR".time();
		$data['tgl_pengeluaran'] = date('Y-m-d', time());
		$data['keterangan'] = "";
		$data['jumlah_keluar'] = 0;
		$this->template->load('template', 'transaksi/pengeluaran/form', $data);
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
															                <p>Tidak ada pengeluaran yang dipilih</p>
															              </div>');
			redirect('pengeluaran');
		}else{
			$pengeluaran = $this->pengeluaran->get($id)->row_array();
			$data['judul'] = "Pengeluaran";
			$data['subjudul'] = "Ubah Pengeluaran";
			$data['hal'] = "ubah";
			$data['id_pengeluaran'] = $pengeluaran['id_pengeluaran'];
			$data['tgl_pengeluaran'] = $pengeluaran['tgl_pengeluaran'];
			$data['keterangan'] = $pengeluaran['keterangan'];
			$data['jumlah_keluar'] = $pengeluaran['jumlah_keluar'];
			$this->template->load('template', 'transaksi/pengeluaran/form', $data);
		}
	}

	public function proses($form=null, $id=null)
	{
		if($form==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Tidak ada proses yang dipilih</p>
															              </div>');
			redirect('pengeluaran');
		}else{
			if($form=='tambah'){
				$this->form_validation->set_rules('tgl_pengeluaran', 'Tanggal Transaksi', 'required',[
					'required' => 'Tanggal Transaksi harus diisi!',
				]);
				$this->form_validation->set_rules('keterangan', 'Keterangan Transaksi', 'required',[
					'required' => 'Keterangan Transaksi harus diisi!',
				]);
				$this->form_validation->set_rules('jumlah_keluar', 'Jumlah Transaksi Keluar', 'required|greater_than[0]',[
					'required' => 'Jumlah Transaksi Keluar harus diisi!',
					'greater_than' => 'Jumlah Transaksi Keluar harus lebih dari 0!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->tambah();
				}else{
					$post = $this->input->post(null, TRUE);
					$query_tambah = $this->pengeluaran->tambah($post);
					if($this->db->affected_rows()>0){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>Pengeluaran telah ditambahkan.</p>
																		              </div>');
						redirect('pengeluaran');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>Pengeluaran gagal ditambahkan.</p>
																		              </div>');
						redirect('pengeluaran');
					}
				}
			}else if($form=='ubah'){
				$this->form_validation->set_rules('tgl_pengeluaran', 'Tanggal Transaksi', 'required',[
					'required' => 'Tanggal Transaksi harus diisi!',
				]);
				$this->form_validation->set_rules('keterangan', 'Keterangan Transaksi', 'required',[
					'required' => 'Keterangan Transaksi harus diisi!',
				]);
				$this->form_validation->set_rules('jumlah_keluar', 'Jumlah Transaksi Keluar', 'required|greater_than[0]',[
					'required' => 'Jumlah Transaksi Keluar harus diisi!',
					'greater_than' => 'Jumlah Transaksi Keluar harus lebih dari 0!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->ubah($id);
				}else{
					$post = $this->input->post(null, TRUE);
					$query_ubah = $this->pengeluaran->ubah($post);
					if($this->db->affected_rows()>0){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>Pengeluaran telah diperbarui.</p>
																		              </div>');
						redirect('pengeluaran');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>Pengeluaran gagal diperbarui.</p>
																		              </div>');
						redirect('pengeluaran');
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
															                <p>Tidak ada pengeluaran yang dipilih.</p>
															              </div>');
			redirect('pengeluaran');
		}else{
			$query_hapus = $this->pengeluaran->hapus($id);
			if($this->db->affected_rows()>0){
				$this->session->set_flashdata('info', '<div class="callout callout-success">
																								<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																                <p>Pengeluaran telah dihapus.</p>
																              </div>');
				redirect('pengeluaran');
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																                <p>Pengeluaran gagal dihapus.</p>
																              </div>');
				redirect('pengeluaran');
			}
		}
	}
}
