<?php

function cek_sudah_masuk()
{
	$ci =& get_instance();
	$username_session = $ci->session->userdata('username');
	if($username_session){
		$ci->session->set_flashdata('info', '<div class="callout callout-danger">
																						<h4>Akses Ditolak!</h4>
														                <p>Anda sudah masuk! Klik tombol keluar di profil untuk keluar dari aplikasi!</p>
														              </div>');
		redirect('beranda');
	}
}

function cek_tidak_masuk()
{
	$ci =& get_instance();
	$username_session = $ci->session->userdata('username');
	if(!$username_session){
		$ci->session->set_flashdata('info', '<div class="callout callout-danger">
																						<h4>Akses Ditolak!</h4>
														                <p>Anda harus masuk dahulu!</p>
														              </div>');
		redirect('auth');
	}
}