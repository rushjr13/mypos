<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kesalahan extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();

		// KHUSUS
		$data['judul'] = "Kesalahan";
		$data['subjudul'] = "404 Halaman Tidak Ditemukan";
		$this->template->load('template', 'kesalahan', $data);
	}
}
