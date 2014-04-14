<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_widget extends CI_Model
{
	private $nama_tabel = 'toko_widget';
	private $kunci = 'idWidget';

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

	public function Get_all($posisi)
	{
		if($posisi == ''){

		} else {
			$this->db->where('location',$posisi);
		}
		$this->db->where_not_in('idWidget','1');
		$this->db->where_not_in('idWidget','2');
		$this->db->order_by('sort', 'asc');
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_active($posisi)
	{
		$this->db->where('status', 'active');
		$this->db->where('location',$posisi);
		$this->db->order_by('sort', 'asc');
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}
	public function Get_active_limit($posisi,$limit)
	{
		$this->db->where('status', 'active');
		$this->db->where('location',$posisi);
		$this->db->order_by('sort', 'asc');
		$this->db->limit($limit);
		$query = $this->db->get($this->nama_tabel);
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

	public function Get_all_widget()
	{	
		$this->db->where('status','active');
		$this->db->where_not_in('idWidget','1');
		$this->db->where_not_in('idWidget','2');
		$this->db->order_by('title', 'asc');
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

		//DYNAMIC KOLOM
	public function Get_dinamic($isiKolom,$limit)
	{
		$this->db->where("idWidget",$isiKolom);
		$this->db->limit('1');
		$this->db->order_by('idWidget','DESC');
		$query = $this->db->get($this->nama_tabel);
		return $query->result();
	}
}

/* End of file : model_widget.php */
/* Location : ./application/models/model_widget.php */