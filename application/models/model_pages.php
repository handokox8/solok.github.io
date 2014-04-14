<?php if ( ! defined('BASEPATH')) exit('No direct access allowed');

class Model_pages extends CI_Model
{
	private $nama_tabel = 'toko_pages';
	private $kunci = 'idPages';

	public function Get_all($limit = array())
	{
		$this->db->where('idPages !=','4');
		$this->db->order_by('idPages', 'desc');
		if(empty($limit)){

		} else {
			$this->db->limit($limit['perpage'], $limit['offset']);
		}
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_count(){
		$this->db->where('idPages !=','4');
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_like($post)
	{
		$this->db->like('title', $post);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Get_id($id)
	{
	/***************************************************************************
	 * function untuk mengambil data pages berdasarkan ID
	 **************************************************************************/
		$this->db->where('idPages',$id);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Update_pages($key,$post)
	{
	/***************************************************************************
	 * function untuk melakukan perubahan data pages
	 **************************************************************************/
		$this->db->where('idPages',$key);
		$query = $this->db->update($this->nama_tabel,$post);
		return $query;
	}

	public function Insert_pages($post)
	{
	/***************************************************************************
	 * function untuk menambah halaman pages
	 **************************************************************************/
		$query = $this->db->insert($this->nama_tabel,$post);
		return $query;
	}

	public function Delete_pages($kode)
	{
	/***************************************************************************
	 * function untuk menghapus data pages
	 **************************************************************************/
		$this->db->where($this->kunci,$kode);
		$query = $this->db->delete($this->nama_tabel);
		return $query;
	}

	public function Get_all_pages()
	{	
		$this->db->where_not_in('idPages','4');
		$this->db->order_by('title', 'asc');
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}
	
}

/* End of file : model_pages.php */
/* Location : ./application/models/model_pages.php */