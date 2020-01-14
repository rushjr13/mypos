<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

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
		$data['jumlah_pengguna'] = $this->pengguna->get()->num_rows();
		$data['judul'] = "Beranda";
		$data['subjudul'] = "Makaleka POS v.1.0.0";
		$this->template->load('template', 'beranda', $data);
	}
}
