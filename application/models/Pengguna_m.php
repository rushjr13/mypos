<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_m extends CI_Model {


	public function masuk($post)
	{
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->join('level', 'level.id_level=pengguna.level');
		$this->db->where('username', $post['username']);
		$this->db->where('password', $post['password']);
		return $this->db->get();
	}

	public function get($username=null)
	{
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->join('level', 'level.id_level=pengguna.level');
		if($username!=null){
			$this->db->where('username', $username);
		}
		return $this->db->get();
	}

	public function tambah($post)
	{
		$data = [
			'username'=>$post['username'],
			'password'=>$post['password'],
			'nama_lengkap'=>$post['nama_lengkap'],
			'jk'=>$post['jk'],
			'email'=>$post['email'],
			'alamat'=>$post['alamat'],
			'level'=>$post['level'],
			'status_pengguna'=>'Tidak Aktif',
			'foto'=>null,
			'tgl_masuk'=>time()
		];
		return $this->db->insert('pengguna', $data);
	}

	public function ubah($post)
	{
		$data = [
			'password'=>$post['password'],
			'nama_lengkap'=>$post['nama_lengkap'],
			'jk'=>$post['jk'],
			'email'=>$post['email'],
			'alamat'=>$post['alamat'],
			'level'=>$post['level']
		];
		$this->db->set($data);
		$this->db->where('username', $post['username']);
		return $this->db->update('pengguna');
	}

	public function status($username, $status_pengguna)
	{
		$this->db->set('status_pengguna', $status_pengguna);
		$this->db->where('username', $username);
		return $this->db->update('pengguna');
	}

	public function hapus($username)
	{
		$this->db->where('username', $username);
		return $this->db->delete('pengguna');
	}

}