<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_m extends CI_Model {

	public function get()
	{
		$this->db->where('id_pengaturan', 'atur');
		return $this->db->get('pengaturan')->row_array();
	}

	public function ubah($post)
	{
		$data = [
			'nama_aplikasi'=>$post['nama_aplikasi'],
			'nama_alias'=>$post['nama_alias'],
			'url'=>$post['url'],
			'db'=>$post['db'],
			'tgl_update_pengaturan'=>time()
		];
		if($post['icon']!=null){
			$data['icon'] = $post['icon'];
		}
		$this->db->set($data);
		$this->db->where('id_pengaturan','atur');
		return $this->db->update('pengaturan');
	}

}