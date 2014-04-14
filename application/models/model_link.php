<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_link extends CI_Model
{
	private $nama_tabel = 'toko_link';
	private $kunci = 'idLink';

	public function Get_all()
	{
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_id($kode)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Insert($post)
	{
		$query = $this->db->insert($this->nama_tabel, $post);
		return $query;
	}

	public function Update($kode, $post)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->update($this->nama_tabel, $post);
		return $query;
	}

	public function Delete($kode)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->delete($this->nama_tabel);
		return $query;
	}
}

/* End of file : model_link.php */
/* Location : ./application/models/model_link.php */