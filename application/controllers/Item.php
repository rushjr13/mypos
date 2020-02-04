<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

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
		$data['judul'] = "Item";
		$data['subjudul'] = "Item Barang";
		$data['item'] = $this->item->get()->result_array();
		$this->template->load('template', 'produk/item/index', $data);
	}

	public function tambah()
	{
		// UMUM
		$username = $this->session->userdata('username');
		$data['pengguna_masuk'] = $this->pengguna->get($username)->row_array();
		$level_pengguna = $data['pengguna_masuk']['level'];
		$data['pengaturan'] = $this->pengaturan->get();

		// KHUSUS
		$data['kategori'] = $this->kategori->get()->result_array();
		$data['unit'] = $this->unit->get()->result_array();
		$data['judul'] = "Item";
		$data['subjudul'] = "Tambah Item Barang";
		$data['hal'] = "tambah";
		$data['id_item'] = "BRG".time();
		$data['id_kategori'] = "";
		$data['id_unit'] = "";
		$data['nama_item'] = "";
		$data['harga_jual'] = 0;
		$this->template->load('template', 'produk/item/form', $data);
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
															                <p>Tidak ada item yang dipilih</p>
															              </div>');
			redirect('item');
		}else{
			$data['kategori'] = $this->kategori->get()->result_array();
			$data['unit'] = $this->unit->get()->result_array();
			$item = $this->item->get($id)->row_array();
			$data['judul'] = "Item";
			$data['subjudul'] = "Ubah Item Barang";
			$data['hal'] = "ubah";
			$data['id_item'] = $item['id_item'];
			$data['id_kategori'] = $item['id_kategori'];
			$data['id_unit'] = $item['id_unit'];
			$data['nama_item'] = $item['nama_item'];
			$data['harga_jual'] = $item['harga_jual'];
			$data['gambar_item'] = $item['gambar_item'];
			$this->template->load('template', 'produk/item/form', $data);
		}
	}

	public function history($id=null)
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
															                <p>Tidak ada item yang dipilih</p>
															              </div>');
			redirect('item');
		}else{
			$data['stok'] = $this->stok->get_history($id)->result_array();
			$data['item'] = $this->item->get($id)->row_array();
			$data['judul'] = "Item";
			$data['subjudul'] = "History Stok Barang";
			$this->template->load('template', 'produk/item/history', $data);
		}
	}

	public function proses($form=null, $id=null)
	{
		if($form==null){
			$this->session->set_flashdata('info', '<div class="callout callout-danger">
																							<h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
															                <p>Tidak ada proses yang dipilih</p>
															              </div>');
			redirect('item');
		}else{
			if($form=='tambah'){
				$this->form_validation->set_rules('nama_item', 'Nama Barang', 'required',[
					'required' => 'Nama Barang harus diisi!',
				]);
				$this->form_validation->set_rules('id_kategori', 'Kategori Barang', 'required',[
					'required' => 'Kategori Barang harus dipilih!',
				]);
				$this->form_validation->set_rules('id_unit', 'Unit/Satuan Barang', 'required',[
					'required' => 'Unit/Satuan Barang harus dipilih!',
				]);
				$this->form_validation->set_rules('harga_jual', 'Harga Barang', 'required|greater_than[0]',[
					'required' => 'Harga Barang harus diisi!',
					'greater_than' => 'Harga Barang harus lebih dari 0!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->tambah();
				}else{
					$post = $this->input->post(null, TRUE);
					$config['upload_path'] = './uploads/item/';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['file_name'] = $post['id_item'];
					$this->load->library('upload', $config);

					$gambar_item = @$_FILES['gambar_item']['name'];
					if($gambar_item!=null){
						if($this->upload->do_upload('gambar_item')){
							$post['gambar_item'] = $this->upload->data('file_name');
							$query_tambah = $this->item->tambah($post);
							if($query_tambah){
								$this->session->set_flashdata('info', '<div class="callout callout-success">
																												<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																				                <p>'.$post['nama_item'].' telah ditambahkan.</p>
																				              </div>');
								redirect('item');
							}else{
								$this->session->set_flashdata('info', '<div class="callout callout-danger">
																												<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																				                <p>'.$post['nama_item'].' gagal ditambahkan.</p>
																				              </div>');
								redirect('item');
							}
						}else{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('info', '<div class="callout callout-danger">
																											<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																			                <p>'.$error.'</p>
																			              </div>');
							redirect('item/tambah/');
						}
					}else{
						$post['gambar_item'] = null;
						$query_tambah = $this->item->tambah($post);
						if($query_tambah){
							$this->session->set_flashdata('info', '<div class="callout callout-success">
																											<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																			                <p>'.$post['nama_item'].' telah ditambahkan.</p>
																			              </div>');
							redirect('item');
						}else{
							$this->session->set_flashdata('info', '<div class="callout callout-danger">
																											<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																			                <p>'.$post['nama_item'].' gagal ditambahkan.</p>
																			              </div>');
							redirect('item');
						}
					}
				}
			}else if($form=='ubah'){
				$this->form_validation->set_rules('nama_item', 'Nama Barang', 'required',[
					'required' => 'Nama Barang harus diisi!',
				]);
				$this->form_validation->set_rules('id_kategori', 'Kategori Barang', 'required',[
					'required' => 'Kategori Barang harus dipilih!',
				]);
				$this->form_validation->set_rules('id_unit', 'Unit/Satuan Barang', 'required',[
					'required' => 'Unit/Satuan Barang harus dipilih!',
				]);
				$this->form_validation->set_rules('harga_jual', 'Harga Barang', 'required|is_numeric',[
					'required' => 'Harga Barang harus diisi!',
					'is_numeric' => 'Harga Barang harus diisi angka!',
				]);

				if ($this->form_validation->run() == FALSE){
					$this->ubah($id);
				}else{
					$post = $this->input->post(null, TRUE);
					$config['upload_path'] = './uploads/item/';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['file_name'] = $post['id_item'];
					$this->load->library('upload', $config);

					$gambar_item = @$_FILES['gambar_item']['name'];
					if($gambar_item!=null){
						if($this->upload->do_upload('gambar_item')){
							if($post['gambar']!=null){
								$target_gambar = './uploads/item/'.$post['gambar'];
								unlink($target_gambar);
							}
							$post['gambar_item'] = $this->upload->data('file_name');
							$query_ubah = $this->item->ubah($post);
							if($query_ubah){
								$this->session->set_flashdata('info', '<div class="callout callout-success">
																												<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																				                <p>'.$post['nama_item'].' telah diperbarui.</p>
																				              </div>');
								redirect('item');
							}else{
								$this->session->set_flashdata('info', '<div class="callout callout-danger">
																												<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																				                <p>'.$post['nama_item'].' gagal diperbarui.</p>
																				              </div>');
								redirect('item');
							}
						}else{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('info', '<div class="callout callout-danger">
																											<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																			                <p>'.$error.'</p>
																			              </div>');
							redirect('item/ubah/'.$post['id_item']);
						}
					}else{
						$query_ubah = $this->item->ubah($post);
						if($query_ubah){
							$this->session->set_flashdata('info', '<div class="callout callout-success">
																											<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																			                <p>'.$post['nama_item'].' telah diperbarui.</p>
																			              </div>');
							redirect('item');
						}else{
							$this->session->set_flashdata('info', '<div class="callout callout-danger">
																											<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																			                <p>'.$post['nama_item'].' gagal diperbarui.</p>
																			              </div>');
							redirect('item');
						}
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
															                <p>Tidak ada item yang dipilih.</p>
															              </div>');
			redirect('item');
		}else{
			$nama_item = $this->input->post('nama_item');
			$gambar_item = $this->input->post('gambar_item');
			if($gambar_item!=null){
				$target_gambar = './uploads/item/'.$gambar_item;
				unlink($target_gambar);
			}
			$query_hapus = $this->item->hapus($id);
			if($query_hapus){
				$this->session->set_flashdata('info', '<div class="callout callout-success">
																								<h4><i class="icon fa fa-check"></i> Proses Berhasil!</h4>
																                <p>Satuan '.$nama_item.' telah dihapus.</p>
																              </div>');
				redirect('item');
			}else{
				$this->session->set_flashdata('info', '<div class="callout callout-danger">
																								<h4><i class="icon fa fa-ban"></i> Proses Gagal!</h4>
																                <p>Satuan '.$nama_item.' gagal dihapus.</p>
																              </div>');
				redirect('item');
			}
		}
	}
}
