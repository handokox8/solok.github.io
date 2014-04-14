<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_feature extends CI_Model
{
	private $nama_tabel = 'toko_feature';
	private $kunci = 'idFeature';

	public function Get_all()
	{
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Insert($post)
	{
		$query = $this->db->insert($this->nama_tabel, $post);
		return $query;
	}

	public function Get_id($kode)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Update($kode,$data)
	{
		$this->db->where($this->kunci,$kode);
		$query = $this->db->update($this->nama_tabel, $data);
	}

	public function Delete($kode)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->delete($this->nama_tabel);
		return $query;
	}

	//DYNAMIC KOLOM
	public function Get_dinamic($isiKolom,$limit)
	{
		$this->db->where("idFeature",$isiKolom);
		$query = $this->db->get($this->nama_tabel);
		return $query->result();
	}
}

/* End of file : model_feature.php */
/* Location : ./application/models/model_feature.php */