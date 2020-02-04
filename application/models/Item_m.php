<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('*');
		$this->db->from('item');
		$this->db->join('kategori', 'kategori.id_kategori=item.id_kategori');
		$this->db->join('unit', 'unit.id_unit=item.id_unit');
		if($id!=null){
			$this->db->where('id_item', $id);
		}
		$this->db->order_by('item.id_kategori', 'ASC');
		$this->db->order_by('tgl_update_item', 'DESC');
		return $this->db->get();
	}

	public function getjual()
	{
		$this->db->select('*');
		$this->db->from('item');
		$this->db->join('kategori', 'kategori.id_kategori=item.id_kategori');
		$this->db->join('unit', 'unit.id_unit=item.id_unit');
		$this->db->where('stok !=', 0);
		$this->db->order_by('item.id_kategori', 'ASC');
		$this->db->order_by('tgl_update_item', 'DESC');
		return $this->db->get();
	}

	public function tambah($post)
	{
		$data = [
			'id_item'=>$post['id_item'],
			'id_kategori'=>$post['id_kategori'],
			'id_unit'=>$post['id_unit'],
			'nama_item'=>$post['nama_item'],
			'harga_jual'=>$post['harga_jual'],
			'gambar_item'=>$post['gambar_item'],
			'tgl_update_item'=>time()
		];
		return $this->db->insert('item', $data);
	}

	public function ubah($post)
	{
		$data = [
			'id_kategori'=>$post['id_kategori'],
			'id_unit'=>$post['id_unit'],
			'nama_item'=>$post['nama_item'],
			'harga_jual'=>$post['harga_jual'],
			'tgl_update_item'=>time()
		];
		if($post['gambar_item']!=null){
			$data['gambar_item'] = $post['gambar_item'];
		}
		$this->db->set($data);
		$this->db->where('id_item', $post['id_item']);
		return $this->db->update('item');
	}

	public function hapus($id)
	{
		$this->db->where('id_item', $id);
		return $this->db->delete('item');
	}

	public function stok_masuk_update($post)
	{
		$id_item = $post['id_item'];
		$jumlah = $post['jumlah'];
		$sql = "UPDATE item SET stok = stok + '$jumlah' WHERE id_item = '$id_item'";
		return $this->db->query($sql);
	}

	public function stok_keluar_update($post)
	{
		$id_item = $post['id_item'];
		$jumlah = $post['jumlah'];
		$sql = "UPDATE item SET stok = stok - '$jumlah' WHERE id_item = '$id_item'";
		return $this->db->query($sql);
	}

}