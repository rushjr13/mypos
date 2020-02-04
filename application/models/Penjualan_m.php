<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('*');
		$this->db->from('penjualan');
		$this->db->join('pengguna', 'pengguna.username=penjualan.username');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan=penjualan.id_pelanggan', 'left');
		if($id!=null){
			$this->db->where('id_penjualan', $id);
		}
		$this->db->order_by('penjualan.id_penjualan', 'DESC');
		return $this->db->get();
	}

	public function get_id($id)
	{
		$this->db->select('*');
		$this->db->from('penjualan');
		$this->db->where('tgl_penjualan', $id);
		return $this->db->get();
	}

	public function penjualan_tambah($post)
	{
		$data = [
			'id_penjualan'=>$post['id_penjualan'],
			'tgl_penjualan'=>$post['tgl_jual'],
			'username'=>$this->session->userdata('username'),
			'id_pelanggan'=>$post['id_pelanggan'] == '' ? null : $post['id_pelanggan'],
			'diskon_penjualan'=>$post['diskon'],
			'tunai'=>$post['tunai'],
			'catatan'=>$post['catatan'],
		];
		$this->db->insert('penjualan', $data);
	}

	public function penjualan_item($post)
	{
		$data = [
			'id_penjualan'=>$post['id_penjualan'],
			'id_item'=>$post['id_item'],
			'jumlah'=>$post['jumlah'],
			'diskon_item'=>$post['diskon_item'],
			'tgl_update_penjualan_item'=>$post['tgl_update_penjualan_template'],
		];
		$this->db->insert('penjualan_item', $data);
	}

	public function penjualan_item_data($id_penjualan=null)
	{
		$this->db->select('*');
		$this->db->from('penjualan_item');
		$this->db->join('item', 'item.id_item=penjualan_item.id_item');
		if($id_penjualan!=null){
			$this->db->where('id_penjualan', $id_penjualan);
		}
		$this->db->order_by('penjualan_item.tgl_update_penjualan_item', 'DESC');
		return $this->db->get();
	}

	public function penjualan_template($id_penjualan)
	{
		$this->db->select('*');
		$this->db->from('penjualan_template');
		$this->db->join('item', 'item.id_item=penjualan_template.id_item');
		$this->db->where('id_penjualan', $id_penjualan);
		$this->db->order_by('penjualan_template.tgl_update_penjualan_template', 'DESC');
		return $this->db->get();
	}

	public function penjualan_template_tambah($post)
	{
		$data = [
			'id_penjualan'=>$post['id_penjualan'],
			'id_item'=>$post['id_item'],
			'jumlah'=>$post['jumlah'],
			'diskon_item'=>0,
			'tgl_update_penjualan_template'=>time(),
		];
		return $this->db->insert('penjualan_template', $data);
	}

	public function penjualan_template_tambah2($post)
	{
		$sql = "UPDATE penjualan_template SET jumlah = jumlah+'".$post['jumlah']."' WHERE id_item = '".$post['id_item']."'";
		return $this->db->query($sql);
	}

	public function penjualan_template_ubah($post)
	{
		$sql = "UPDATE penjualan_template SET jumlah = '".$post['jumlah']."', diskon_item = '".$post['diskon_item']."' WHERE id_item = '".$post['id_item']."'";
		return $this->db->query($sql);
	}

	public function penjualan_template_hapus($post)
	{
		$this->db->where('id_item', $post['id_item_hapus']);
		return $this->db->delete('penjualan_template');
	}

}