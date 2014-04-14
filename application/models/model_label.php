<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_label extends CI_Model
{
	private $nama_tabel = 'toko_label_news';
	private $kunci = 'idLabel';

	public function Get_all()
	{
		$this->db->order_by('label', 'asc');
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_id($kode)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_last()
	{
		$query = $this->db->insert_id();
		return $query;
	}

	public function Save($post)
	{
		$query = $this->db->insert($this->nama_tabel, $post);
		return $query;
	}

	public function Update($kode,$post)
	{
		$this->db->where($this->kunci,$kode);
		$query = $this->db->update($this->nama_tabel,$post);
		return $query;
	}

	public function Delete($kode)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->delete($this->nama_tabel);
		return $query;
	}
	public function Get_id_label($label)
	{	
		$this->db->where('label',$label);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_all_left($idNews)
	{
		//$this->db->where('toko_label_relation.idNews',$kode);
		$this->db->where_not_in('idLabel',$idNews);
		// $this->db->order_by('label', 'asc');
		// $this->db->join('toko_label_relation','toko_label_relation.idLabel=toko_label_news.idLabel');
		// $this->db->group_by('label');
		$query = $this->db->get('toko_label_news');
		return $query;
	}
}

/* End of file : model_label.php */
/* Location : ./application/models/model_label.php */