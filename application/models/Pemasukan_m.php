<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('*');
		$this->db->from('pemasukan');
		if($id!=null){
			$this->db->where('id_pemasukan', $id);
		}
		return $this->db->get();
	}

	public function tambah($post)
	{
		$data = [
			'id_pemasukan'=>$post['id_pemasukan'],
			'tgl_pemasukan'=>$post['tgl_pemasukan'],
			'keterangan'=>$post['keterangan'],
			'jumlah_masuk'=>$post['jumlah_masuk'],
			'username'=>$this->session->userdata('username'),
			'tgl_update_pemasukan'=>time()
		];
		return $this->db->insert('pemasukan', $data);
	}

	public function ubah($post)
	{
		$data = [
			'tgl_pemasukan'=>$post['tgl_pemasukan'],
			'keterangan'=>$post['keterangan'],
			'jumlah_masuk'=>$post['jumlah_masuk'],
			'username'=>$this->session->userdata('username'),
			'tgl_update_pemasukan'=>time()
		];
		$this->db->set($data);
		$this->db->where('id_pemasukan', $post['id_pemasukan']);
		return $this->db->update('pemasukan');
	}

	public function hapus($id)
	{
		$this->db->where('id_pemasukan', $id);
		return $this->db->delete('pemasukan');
	}

}