<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

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
		if($level_pengguna==1){
			$data['judul'] = "Pengaturan";
			$data['subjudul'] = "Pengaturan System";
			$this->template->load('template', 'pengaturan', $data);
		}else{
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Hanya Administrator yang dapat mengakses halaman <strong>Pengguna</strong>.</p>
															              </div>');
			redirect('beranda');
		}
	}

	public function proses()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		if($level_pengguna==1){
			$this->form_validation->set_rules('nama_aplikasi', 'Nama Aplikasi', 'required',[
				'required' => 'Nama Aplikasi harus diisi!'
			]);
			$this->form_validation->set_rules('nama_alias', 'Nama Alias', 'required',[
				'required' => 'Nama Alias harus diisi!'
			]);
			$this->form_validation->set_rules('url', 'URL / Link Aplikasi', 'required',[
				'required' => 'URL / Link Aplikasi harus diisi!'
			]);
			$this->form_validation->set_rules('db', 'Database Aplikasi', 'required',[
				'required' => 'Database Aplikasi harus diisi!'
			]);

			if ($this->form_validation->run() == FALSE){
				$this->index();
			}else{
				$post = $this->input->post(null, TRUE);
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'png';
				$config['file_name'] = 'icon';
				$this->load->library('upload', $config);

				$icon = @$_FILES['icon']['name'];
				if($icon!=null){
					if($this->upload->do_upload('icon')){
						$target_ikon = './uploads/'.$post['ikon'];
						unlink($target_ikon);
						$post['icon'] = $this->upload->data('file_name');
						$query_ubah = $this->pengaturan->ubah($post);
						if($this->db->affected_rows()>0){
							$this->session->set_flashdata('info', '<div class="callout callout-success">
																											<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																			                <p>Pengaturan Aplikasi telah diperbarui.</p>
																			              </div>');
							redirect('pengaturan');
						}else{
							$this->session->set_flashdata('info', '<div class="callout callout-danger">
																											<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																			                <p>Pengaturan Aplikasi gagal diperbarui.</p>
																			              </div>');
							redirect('pengaturan');
						}
					}else{
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>'.$error.'</p>
																		              </div>');
						redirect('pengaturan');
					}
				}else{
					$query_ubah = $this->pengaturan->ubah($post);
					if($this->db->affected_rows()>0){
						$this->session->set_flashdata('info', '<div class="callout callout-success">
																										<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																		                <p>Pengaturan Aplikasi telah diperbarui.</p>
																		              </div>');
						redirect('pengaturan');
					}else{
						$this->session->set_flashdata('info', '<div class="callout callout-danger">
																										<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																		                <p>Pengaturan Aplikasi gagal diperbarui.</p>
																		              </div>');
						redirect('pengaturan');
					}
				}
			}
		}else{
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Hanya Administrator yang dapat mengakses halaman <strong>Pengguna</strong>.</p>
															              </div>');
			redirect('beranda');
		}
	}

}
