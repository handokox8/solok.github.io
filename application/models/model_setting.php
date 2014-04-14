<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_setting extends CI_Model
{
	private $nama_tabel = 'toko_setting';
	private $kunci = 'idSetting';

	public function Get_id()
	{
		$this->db->where($this->kunci, '1');
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}

	public function Update($post)
	{
		$this->db->where($this->kunci, '1');
		$query = $this->db->update($this->nama_tabel, $post);
		return $query;
	}
}

/* End of file : model_setting.php */
/* Location : ./application/models/model_setting.php */