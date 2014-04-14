<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_label_relation extends CI_Model
{
	private $nama_tabel = 'toko_label_relation';

	public function Get_all()
	{
		return $this->db->get($this->nama_tabel);

	}

	public function Get_parent($kode)
	{
		$this->db->from($this->nama_tabel);
		$this->db->join('toko_news', 'toko_news.idNews=toko_label_relation.idNews');
		$this->db->where('idLabel',$kode);
		$query = $this->db->get();
		return $query;
	}

	public function Get_id($kode)
	{
		$this->db->from($this->nama_tabel);
		$this->db->join('toko_label_news', 'toko_label_news.idLabel=toko_label_relation.idLabel');
		$this->db->where('idNews',$kode);
		$query = $this->db->get();
		return $query;
	}

	public function Get_by_label($kode)
	{
		$this->db->from($this->nama_tabel);
		$this->db->join('toko_news', 'toko_news.idNews=toko_label_relation.idNews');
		$this->db->where('idLabel',$kode);
		$query = $this->db->get();
		return $query;
	}

/* custom template sosismahkotadurian.com */
	public function Get_label_limit($kode,$limit)
	{
		$this->db->from($this->nama_tabel);
		$this->db->join('toko_news', 'toko_news.idNews=toko_label_relation.idNews');
		$this->db->where('idLabel',$kode);
		$this->db->order_by('toko_label_relation.idNews','DESC');
		$this->db->where('status', 'publish');
		if($limit == ""){

		} else {
			$this->db->limit($limit);
		}
		$query = $this->db->get();
		return $query;
	}
/* end custom template sosismahkotadurian.com */

	public function Insert($post)
	{
		$query = $this->db->insert($this->nama_tabel,$post);
		return $query;
	}

	public function Insert1($post)
	{
		$query = $this->db->insert($this->nama_tabel,$post);
		return TRUE;
	}

	public function Delete($kode)
	{
		$this->db->where('idLabel', $kode);
		$query = $this->db->delete($this->nama_tabel);
	}

	public function Delete_news($kode)
	{
		$this->db->where('idNews', $kode);
		$query = $this->db->delete($this->nama_tabel);
	}

	public function Delete_relation($kode,$title)
	{
		$this->db->where('idLabel', $kode);
		$this->db->where('idNews', $title);
		$query = $this->db->delete($this->nama_tabel);
	}

	//custom buat edumacs
	public function Get_idnews($kode)
	{	
		$this->db->select('toko_label_relation.idLabel');
		$this->db->from($this->nama_tabel);
		$this->db->join('toko_label_news', 'toko_label_news.idLabel=toko_label_relation.idLabel');
		$this->db->where('idNews',$kode);
		$query = $this->db->get();
		return $query;
	}

	//DYNAMIC KOLOM
	public function Get_dinamic($isiKolom,$limit)
	{
		$this->db->where("toko_label_relation.idLabel",$isiKolom);
		$this->db->join('toko_news', 'toko_news.idNews=toko_label_relation.idNews');
		$this->db->join('toko_label_news', 'toko_label_news.idLabel=toko_label_relation.idLabel');
		$this->db->limit($limit);
		$this->db->where('status','publish');
		$this->db->order_by('toko_label_relation.idNews','DESC');
		$query = $this->db->get($this->nama_tabel);
		return $query->result();
	}
	//PAGINATION NEED
	public function Get_count_template($kode){
		$this->db->where('status','publish');
		$this->db->where('idLabel',$kode);
		$this->db->join('toko_news', 'toko_news.idNews=toko_label_relation.idNews');
		$query = $this->db->get($this->nama_tabel);
		return $query;
	}
	public function Get_all_template($kode,$perpage,$record)
	{
		$this->db->from($this->nama_tabel);
		$this->db->join('toko_news', 'toko_news.idNews=toko_label_relation.idNews');
		$this->db->where('idLabel',$kode);
		$this->db->order_by('toko_news.tanggal','DESC');
		$this->db->where('status', 'publish');
		$this->db->limit($perpage,$record);
		$query = $this->db->get();
		return $query;
	}

}

/* End of file : model_label_relation.php */
/* Location : ./application/models/model_label_relation.php */