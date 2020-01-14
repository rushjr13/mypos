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

}