<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('*');
		$this->db->from('unit');
		if($id!=null){
			$this->db->where('id_unit', $id);
		}
		return $this->db->get();
	}

	public function tambah($post)
	{
		$data = [
			'id_unit'=>$post['id_unit'],
			'nama_unit'=>$post['nama_unit'],
			'tgl_update_unit'=>time()
		];
		return $this->db->insert('unit', $data);
	}

	public function ubah($post)
	{
		$data = [
			'nama_unit'=>$post['nama_unit'],
			'tgl_update_unit'=>time()
		];
		$this->db->set($data);
		$this->db->where('id_unit', $post['id_unit']);
		return $this->db->update('unit');
	}

	public function hapus($id)
	{
		$this->db->where('id_unit', $id);
		return $this->db->delete('unit');
	}

}