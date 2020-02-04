<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan extends CI_Controller {

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
		$data['judul'] = "Pemasukan Lain";
		$data['subjudul'] = "Data Pemasukan Lainnya";
		$data['pemasukan'] = $this->pemasukan->get()->result_array();
		$this->template->load('template', 'transaksi/pemasukan/index', $data);
	}

	public function tambah()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['judul'] = "Pemasukan Lain";
		$data['subjudul'] = "Tambah Pemasukan Lainnya";
		$data['hal'] = "tambah";
		$data['id_pemasukan'] = "MSK".time();
		$data['tgl_pemasukan'] = date('Y-m-d', time());
		$data['keterangan'] = "";
		$data['jumlah_masuk'] = 0;
		$this->template->load('template', 'transaksi/pemasukan/form', $data);
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
															                <p>Tidak ada pemasukan yang dipilih</p>
															              </div>');
			redirect('pemasukan');
		}else{
			$pemasukan = $this->pemasukan->get($id)->row_array();
			$data['judul'] = "Pemasukan Lain";
			$data['subjudul'] = "Ubah Pemasukan Lainnya";
			$data['hal'] = "ubah";
			$data['id_pemasukan'] = $pemasukan['id_pemasukan'];
			$data['tgl_pemasukan'] = $pemasukan['tgl_pemasukan'];
			$data['keterangan'] = $pemasukan['keterangan'];
			$data['jumlah_masuk'] = $pemasukan['jumlah_masuk'];
			$this->template->load('template', 'transaksi/pemasukan/form', $data);
		}
	}

	public function proses($form=null, $id=null)
	{
		if($form==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Tidak ada proses yang dipilih</p>
															              </div>');
			redirect('pemasukan');
		}else{
			if($form=='tambah'){
				$this->form_validation->set_rules('tgl_pemasukan', 'Tanggal Transaksi', 'required',[
					'required' => 'Tanggal Transaksi harus diisi!',
				]);
				$this->form_validation->set_rules('keterangan', 'Keterangan Transaksi', 'required',[
					'required' => 'Keterangan Transaksi harus diisi!',
				]);
				$this->form_validation->set_rules('jumlah_masuk', 'Jumlah Transaksi Masuk', 'required|greater_than[0]',[
					'required' => 'Jumlah Transaksi Masuk harus diisi!',
					'greater_than' => 'Jumlah Transaksi Masuk harus lebih dari 0!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->tambah();
				}else{
					$post = $this->input->post(null, TRUE);
					$query_tambah = $this->pemasukan->tambah($post);
					if($this->db->affected_rows()>0){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>Pemasukan telah ditambahkan.</p>
																		              </div>');
						redirect('pemasukan');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>Pemasukan gagal ditambahkan.</p>
																		              </div>');
						redirect('pemasukan');
					}
				}
			}else if($form=='ubah'){
				$this->form_validation->set_rules('tgl_pemasukan', 'Tanggal Transaksi', 'required',[
					'required' => 'Tanggal Transaksi harus diisi!',
				]);
				$this->form_validation->set_rules('keterangan', 'Keterangan Transaksi', 'required',[
					'required' => 'Keterangan Transaksi harus diisi!',
				]);
				$this->form_validation->set_rules('jumlah_masuk', 'Jumlah Transaksi Masuk', 'required|greater_than[0]',[
					'required' => 'Jumlah Transaksi Masuk harus diisi!',
					'greater_than' => 'Jumlah Transaksi Masuk harus lebih dari 0!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->ubah($id);
				}else{
					$post = $this->input->post(null, TRUE);
					$query_ubah = $this->pemasukan->ubah($post);
					if($this->db->affected_rows()>0){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>Pemasukan telah diperbarui.</p>
																		              </div>');
						redirect('pemasukan');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>Pemasukan gagal diperbarui.</p>
																		              </div>');
						redirect('pemasukan');
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
															                <p>Tidak ada pemasukan yang dipilih.</p>
															              </div>');
			redirect('pemasukan');
		}else{
			$query_hapus = $this->pemasukan->hapus($id);
			if($this->db->affected_rows()>0){
				$this->session->set_flashdata('info', '<div class="callout callout-success">
																								<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																                <p>Pemasukan telah dihapus.</p>
																              </div>');
				redirect('pemasukan');
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																                <p>Pemasukan gagal dihapus.</p>
																              </div>');
				redirect('pemasukan');
			}
		}
	}
}
