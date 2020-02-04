<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('*');
		$this->db->from('pengeluaran');
		if($id!=null){
			$this->db->where('id_pengeluaran', $id);
		}
		return $this->db->get();
	}

	public function tambah($post)
	{
		$data = [
			'id_pengeluaran'=>$post['id_pengeluaran'],
			'tgl_pengeluaran'=>$post['tgl_pengeluaran'],
			'keterangan'=>$post['keterangan'],
			'jumlah_keluar'=>$post['jumlah_keluar'],
			'username'=>$this->session->userdata('username'),
			'tgl_update_pengeluaran'=>time()
		];
		return $this->db->insert('pengeluaran', $data);
	}

	public function ubah($post)
	{
		$data = [
			'tgl_pengeluaran'=>$post['tgl_pengeluaran'],
			'keterangan'=>$post['keterangan'],
			'jumlah_keluar'=>$post['jumlah_keluar'],
			'username'=>$this->session->userdata('username'),
			'tgl_update_pengeluaran'=>time()
		];
		$this->db->set($data);
		$this->db->where('id_pengeluaran', $post['id_pengeluaran']);
		return $this->db->update('pengeluaran');
	}

	public function hapus($id)
	{
		$this->db->where('id_pengeluaran', $id);
		return $this->db->delete('pengeluaran');
	}

}