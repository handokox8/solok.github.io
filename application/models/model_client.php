<?php if ( ! defined('BASEPATH')) exit ('No Direct Srcipt Access Allowd');

class Model_client extends CI_Model
{
	private $nama_table='toko_client';
	private $kunci='idClient';

	public function Get_all() 
	{
		$query = $this->db->get($this->nama_table);
		return $query;
	}

	public function Get_id($kode)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->get($this->nama_table);
		return $query;
	}

	public function Insert($post)
	{
		$query = $this->db->insert($this->nama_table,$post);
		return $query;
	}

	public function Update($kode, $post)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->update($this->nama_table, $post);
		return $query;
	}

	public function Delete($kode)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->delete($this->nama_table);
		return $query;
	}
}

/* end file : model_client.php */
/* location : ./aplication/models/model_client.php */