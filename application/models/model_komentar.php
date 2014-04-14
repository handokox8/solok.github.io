<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_komentar extends CI_Model
{
	public function Get_forum($kode)
	{
		$this->db->where('idForum', $kode);
		$query = $this->db->get('toko_komen_forum');
		return $query;
	}

	public function Insert($post)
	{
		$query = $this->db->insert('toko_komen_forum', $post);
		return $query;
	}
}