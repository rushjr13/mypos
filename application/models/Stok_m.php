<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_m extends CI_Model {

	public function get($stok)
	{
		$this->db->select('*');
		$this->db->from('stok');
		$this->db->join('item', 'item.id_item=stok.id_item');
		$this->db->join('supplier', 'supplier.id_supplier=stok.id_supplier', 'left');
		if($stok=='masuk'){
			$this->db->where('tipe', 'masuk');
		}else if($stok=='keluar'){
			$this->db->where('tipe', 'keluar');
		}
		$this->db->order_by('stok.id_item', 'ASC');
		$this->db->order_by('tgl_update_stok', 'DESC');
		return $this->db->get();
	}

	public function get_history($id_item)
	{
		$this->db->select('*');
		$this->db->from('stok');
		$this->db->join('supplier', 'supplier.id_supplier=stok.id_supplier', 'left');
		$this->db->join('pengguna', 'pengguna.username=stok.username');
		$this->db->where('stok.id_item', $id_item);
		$this->db->order_by('stok.tipe', 'ASC');
		$this->db->order_by('tgl_update_stok', 'DESC');
		return $this->db->get();
	}

	public function stok_masuk_tambah($post)
	{
		$data = [
			'id_stok'=>$post['id_stok'],
			'id_item'=>$post['id_item'],
			'tipe'=>'masuk',
			'detail'=>$post['detail'],
			'id_supplier'=>$post['id_supplier'] == '' ? null : $post['id_supplier'],
			'jumlah'=>$post['jumlah'],
			'username'=>$this->session->userdata('username'),
			'tanggal'=>$post['tanggal'],
			'tgl_update_stok'=>time()
		];
		return $this->db->insert('stok', $data);
	}

	public function stok_masuk_hapus($post)
	{
		$this->db->where('id_stok', $post['id_stok']);
		return $this->db->delete('stok');
	}

	public function stok_keluar_tambah($post)
	{
		$data = [
			'id_stok'=>$post['id_stok'],
			'id_item'=>$post['id_item'],
			'tipe'=>'keluar',
			'detail'=>$post['detail'],
			'id_supplier'=>null,
			'jumlah'=>$post['jumlah'],
			'username'=>$this->session->userdata('username'),
			'tanggal'=>$post['tanggal'],
			'tgl_update_stok'=>time()
		];
		return $this->db->insert('stok', $data);
	}

	public function stok_keluar_hapus($post)
	{
		$this->db->where('id_stok', $post['id_stok']);
		return $this->db->delete('stok');
	}

}