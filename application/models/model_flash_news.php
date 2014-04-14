<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_flash_news extends CI_Model
{
	private $nama_tabel = 'toko_flash_news';
	private $kunci = 'idFlash';

	public function Get_id()
	{
		$this->db->where($this->kunci, '1');
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Update($post)
	{
		$this->db->where($this->kunci,'1');
		$query = $this->db->Update($this->nama_tabel, $post);
		return $query;
	}
}

/* End of file : model_link.php */
/* Location : ./application/models/model_link.php */