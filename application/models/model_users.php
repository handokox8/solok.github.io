<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_users extends CI_Model
{
	private $nama_tabel = 'toko_users';
	private $kunci = 'idUser';

	public function Get_all()
	{
		return $this->db->get($this->nama_tabel);
	}

	public function Get_user($username,$password)
	{
		$this->db->where('userName',$username);
		$this->db->where('password',$password);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_user_id($kode)
	{
		$this->db->where('idUser',$kode);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_user_name($kode)
	{
		$this->db->where('userName',$kode);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Update_user($kode,$post)
	{
		$this->db->where('idUser',$kode);
		$query = $this->db->update($this->nama_tabel,$post);
		return $query;
	}

	public function Save_user($data)
	{
		return $this->db->insert($this->nama_tabel,$data);
	}

	public function Delete_user($kode)
	{
		$this->db->where('idUser',$kode);
		$query = $this->db->delete($this->nama_tabel);
		return $query;
	}
}

/* End of file model_users.php */
/* Location : ./application/models/model_users.php */