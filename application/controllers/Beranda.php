<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

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
		$data['jumlah_pengguna'] = $this->pengguna->get()->num_rows();
		$data['jumlah_pelanggan'] = $this->pelanggan->get()->num_rows();
		$data['jumlah_supplier'] = $this->supplier->get()->num_rows();
		$data['jumlah_item'] = $this->item->get()->num_rows();
		$data['penjualan_item_data'] = $this->penjualan->penjualan_item_data()->result_array();
		$data['pemasukan'] = $this->pemasukan->get()->result_array();
		$data['pengeluaran'] = $this->pengeluaran->get()->result_array();
		$data['judul'] = "Beranda";
		$data['subjudul'] = "Makaleka POS v.1.0.0";
		$this->template->load('template', 'beranda', $data);
	}
}
