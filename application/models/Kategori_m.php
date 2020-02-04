<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('*');
		$this->db->from('kategori');
		if($id!=null){
			$this->db->where('id_kategori', $id);
		}
		return $this->db->get();
	}

	public function tambah($post)
	{
		$data = [
			'id_kategori'=>$post['id_kategori'],
			'nama_kategori'=>$post['nama_kategori'],
			'tgl_update_kategori'=>time()
		];
		return $this->db->insert('kategori', $data);
	}

	public function ubah($post)
	{
		$data = [
			'nama_kategori'=>$post['nama_kategori'],
			'tgl_update_kategori'=>time()
		];
		$this->db->set($data);
		$this->db->where('id_kategori', $post['id_kategori']);
		return $this->db->update('kategori');
	}

	public function hapus($id)
	{
		$this->db->where('id_kategori', $id);
		return $this->db->delete('kategori');
	}

}