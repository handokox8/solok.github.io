<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_kolom extends CI_Model
{

/***************************************************************************
	 * class model kolom
**************************************************************************/
	private $nama_tabel = 'toko_kolom';
	private $key = 'idKolom';

	public function Get_all()
	{
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Save($post)
	{
		$query = $this->db->insert($this->nama_tabel, $post);
		return $query;
	}

	public function Update($kode,$post)
	{
		$this->db->where($this->key,$kode);
		$query = $this->db->update($this->nama_tabel,$post);
		return $query;
	}

	public function Get_id($kode)
	{
		$this->db->where('idKolom',$kode);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_isi($jenis,$kode)
	{	

		$this->db->where('jenisKolom',$jenis);
		$this->db->where('isiKolom',$kode);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}


}

/* End of file : model_kolom.php */
/* Location : ./application/models/model_kolom.php */