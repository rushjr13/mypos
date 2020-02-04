<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('*');
		$this->db->from('supplier');
		if($id!=null){
			$this->db->where('id_supplier', $id);
		}
		return $this->db->get();
	}

	public function tambah($post)
	{
		$data = [
			'id_supplier'=>$post['id_supplier'],
			'nama'=>$post['nama'],
			'telpon'=>$post['telpon'],
			'email'=>$post['email'],
			'alamat'=>$post['alamat'],
			'deskripsi'=>$post['deskripsi'],
			'tgl_update'=>time()
		];
		return $this->db->insert('supplier', $data);
	}

	public function ubah($post)
	{
		$data = [
			'nama'=>$post['nama'],
			'telpon'=>$post['telpon'],
			'email'=>$post['email'],
			'alamat'=>$post['alamat'],
			'deskripsi'=>$post['deskripsi'],
			'tgl_update'=>time()
		];
		$this->db->set($data);
		$this->db->where('id_supplier', $post['id_supplier']);
		return $this->db->update('supplier');
	}

	public function hapus($id)
	{
		$this->db->where('id_supplier', $id);
		return $this->db->delete('supplier');
	}

}