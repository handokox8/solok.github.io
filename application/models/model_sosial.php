<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_sosial extends CI_Model
{
	/***************************************************************************
	 * class model setting
	 **************************************************************************/
	private $nama_tabel = 'toko_sosial';
	private $key = 'id';

	/*==========================================================================
		BASIC PACKAGE
	==========================================================================*/
	public function Get_setting($id)
	{
	/***************************************************************************
	 * function untuk mengambil data setting berdasarkan ID
	 **************************************************************************/
		$this->db->where('id',$id);
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Update_setting($key,$post)
	{
	/***************************************************************************
	 * function untuk merubah data setting
	 **************************************************************************/
		$this->db->where('id',$key);
		$query = $this->db->update($this->nama_tabel,$post);
		return $query;
	}
}

/* End of file : model_setting.php */
/* Location : ./application/models/model_setting.php */