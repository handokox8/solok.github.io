<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_gallery extends CI_Model
{
	private $nama_tabel = 'toko_album';
	private $kunci = 'idAlbum';
	private $tabel_image = 'toko_album_image';

	public function Get_album()
	{
		return $this->db->get($this->nama_tabel);
	}

	public function Get_album_id($kode)
	{
		$this->db->where('idAlbum', $kode);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_image($kode)
	{
		if($kode == ""){

		} else {
			$this->db->where('idAlbum',$kode);
		}
		return $this->db->get($this->tabel_image);
	}

	public function Get_per_album($kode)
	{
		$this->db->from($this->nama_tabel);
		$this->db->join($this->tabel_image, 'toko_album_image.idAlbum=toko_album.idAlbum');
		$this->db->where('toko_album.idAlbum',$kode);
		return $this->db->get();
	}

	public function Last_album()
	{
		$query = $this->db->insert_id();
		return $query;
	}

	public function Get_image_limit($kode,$limit)
	{
		$this->db->where('idAlbum',$kode);
		$this->db->limit($limit);
		return $this->db->get($this->tabel_image);
	}

	public function Get_image_id($kode)
	{
		$this->db->where('idImage', $kode);
		$query = $this->db->get($this->tabel_image);
		return $query;
	}

	public function Insert_image($post)
	{
		$query = $this->db->insert($this->tabel_image,$post);
		return $query;
	}

	public function Insert_album($post)
	{
		$query = $this->db->insert($this->nama_tabel,$post);
		return $query;
	}

	public function Update_image($kode,$post)
	{
		$this->db->where('idImage', $kode);
		$query = $this->db->update($this->tabel_image, $post);
		return $query;
	}

	public function Delete_image($kode)
	{
		$this->db->where('idImage', $kode);
		$query = $this->db->delete($this->tabel_image);
		return $query;
	}

	public function Delete_album($kode)
	{
		$this->db->where('idAlbum', $kode);
		$query = $this->db->delete($this->nama_tabel);
		return $query;
	}
	public function Get_album_image()
	{
		$this->db->distinct();
		$this->db->join($this->nama_tabel, 'toko_album.idAlbum=toko_album_image.idAlbum');
		$this->db->group_by('toko_album_image.idAlbum');
		return $this->db->get($this->tabel_image);
	}
	
}

/* End of file : model_galery.php */
/* Location : ./application/models/model_galery.php */