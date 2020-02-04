<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('*');
		$this->db->from('pelanggan');
		if($id!=null){
			$this->db->where('id_pelanggan', $id);
		}
		return $this->db->get();
	}

	public function tambah($post)
	{
		$data = [
			'id_pelanggan'=>$post['id_pelanggan'],
			'nama'=>$post['nama'],
			'jk'=>$post['jk'],
			'telpon'=>$post['telpon'],
			'email'=>$post['email'],
			'alamat'=>$post['alamat'],
			'tgl_update'=>time()
		];
		return $this->db->insert('pelanggan', $data);
	}

	public function ubah($post)
	{
		$data = [
			'nama'=>$post['nama'],
			'jk'=>$post['jk'],
			'telpon'=>$post['telpon'],
			'email'=>$post['email'],
			'alamat'=>$post['alamat'],
			'tgl_update'=>time()
		];
		$this->db->set($data);
		$this->db->where('id_pelanggan', $post['id_pelanggan']);
		return $this->db->update('pelanggan');
	}

	public function hapus($id)
	{
		$this->db->where('id_pelanggan', $id);
		return $this->db->delete('pelanggan');
	}

}