<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_galery extends CI_Model
{
	private $nama_tabel = 'toko_album';
	private $kunci = 'idAlbum';

	public function Get_all($limit = array())
	{
		$this->db->order_by('idAlbum', 'desc');
		$this->db->limit($limit['perpage'], $limit['offset']);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_id($kode)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_count()
	{
		$this->db->order_by('idAlbum', 'desc');
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Insert($post)
	{
		$query = $this->db->insert($this->nama_tabel,$post);
		return $query;
	}

	public function Update($kode,$post)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->update($this->nama_tabel,$post);
		return $query;
	}

	public function Delete($kode)
	{
		$this->db->where($this->kunci,$kode);
		$query = $this->db->delete($this->nama_tabel);
		return $query;
	}
}

/* End of file : model_galery.php */
/* Location : ./application/models/model_galery.php */