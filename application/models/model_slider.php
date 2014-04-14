<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_slider extends CI_model
{
	private $nama_tabel = 'toko_slider';
	private $kunci = 'idSlider';

	public function Add_slider($post)
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

	public function Update($kode,$post)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->update($this->nama_tabel, $post);
		return $query;
	}

	public function Get_all()
	{
		$this->db->order_by('sort', 'asc');
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Delete($kode)
	{
		$this->db->where($this->kunci, $kode);
		$query = $this->db->delete($this->nama_tabel);
		return $query;
	}
}

/* End of file : model_slider.php */
/* Location : ./application/models/model_slider.php */