<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_folower extends CI_Model
{
	private $nama_tabel = 'toko_folower';
	private $kunci = 'idFolower';

	public function Insert($post)
	{
		$query = $this->db->insert($this->nama_tabel, $post);
		return $query;
	}

	public function Get_all()
	{
		return $this->db->get($this->nama_tabel);
	}

	public function Get_username($username,$email)
	{
		$this->db->where('usernameFolower',$username);
		$this->db->or_where('emailFolower',$email);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}
	public function Get_folower($username,$password)
	{
		$this->db->where('usernameFolower',$username);
		$this->db->where('passwordFolower',$password);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}
	public function Get_status()
	{	
		$this->db->where('status','pending');
		$this->db->limit('10');
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
		$this->db->where($this->kunci,$kode);
		$query = $this->db->delete($this->nama_tabel);
		return $query;
	}
}

/* End of file : model_folower.php */
/* Location : ./application/models/model_folower.php */