<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_forum extends CI_Model
{
	private $nama_tabel = 'toko_forum';
	private $kunci = 'idForum';

	public function Get_all()
	{	
		$this->db->order_by('tanggal', 'desc');
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
		$query = $this->db->insert($this->nama_tabel,$post);
		return $query;
	}
	public function Get_komen($kode)
	{
		$this->db->where('toko_komen_forum.idForum',$kode);
		$this->db->join('toko_forum','toko_forum.idForum = toko_komen_forum.idForum ');
		$this->db->join('toko_folower','toko_folower.idFolower = toko_komen_forum.idFolower ');
		$query = $this->db->get('toko_komen_forum');
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
		$this->db->where('idForum', $kode);
		$query = $this->db->delete($this->nama_tabel);
	}
	public function Delete_rel($kode)
	{
		$this->db->where('idForum', $kode);
		$query = $this->db->delete('toko_komen_forum');
	}
}