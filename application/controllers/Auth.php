<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$data['judul'] = "Masuk";
		$this->load->view('auth/masuk', $data);
	}

	public function daftar()
	{
		$data['judul'] = "Daftar";
		$this->load->view('auth/daftar', $data);
	}

	public function lupa_sandi()
	{
		$data['judul'] = "Lupa Kata Sandi";
		$this->load->view('auth/lupa_sandi', $data);
	}
}
