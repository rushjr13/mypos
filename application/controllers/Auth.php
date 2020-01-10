<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$data['judul'] = "Masuk";
		$this->template->load('auth/template', 'auth/masuk', $data);
	}

	public function daftar()
	{
		$data['judul'] = "Daftar";
		$this->template->load('auth/template', 'auth/daftar', $data);
	}

	public function lupa_sandi()
	{
		$data['judul'] = "Lupa Kata Sandi";
		$this->template->load('auth/template', 'auth/lupa_sandi', $data);
	}
}
