<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_info extends CI_Model
{
	/***************************************************************************
	 * class model info
	 **************************************************************************/
	private $nama_tabel = 'toko_info';
	private $key = 'idInfo';

	public function Get_id($key)
	{
	/***************************************************************************
	 * function untuk mengambil data info berdasarkan ID
	 **************************************************************************/
		$this->db->where('idInfo',$key);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function save_info($key,$post)
	{
	/***************************************************************************
	 * function untuk melakukan perubahan data info berdasarkan ID
	 **************************************************************************/
		$this->db->where('idInfo',$key);
		$query = $this->db->update($this->nama_tabel,$post);
		return $query;
	}
}

/* End of file : model_info.php */
/* Location : ./application/models/model_info.php */