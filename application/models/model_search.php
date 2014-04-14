<?php if ( ! defined('BASEPATH')) exit('No direct access allowed');

class Model_search extends CI_Model
{
	public function Get_news($keyword)
	{	
		$this->db->select('toko_news.idNews,tanggal, title, deskripsi, news, keyword, image, status, counter, jenis');
		$this->db->join('toko_label_relation', 'toko_label_relation.idNews=toko_news.idNews');
		$this->db->join('toko_label_news', 'toko_label_news.idLabel=toko_label_relation.idLabel');
		$this->db->like('label', $keyword);
		$this->db->or_like('news', $keyword);
		$this->db->or_like('title', $keyword);
		$this->db->where('toko_news.status', 'publish');
		$query = $this->db->get('toko_news');
		return $query;
	}
	public function Get_pages($keyword)
	{
		$this->db->like('title', $keyword);
		$this->db->or_like('post', $keyword);
		$this->db->where('status', 'publik');
		$query = $this->db->get('toko_pages');
		return $query;
	}
	
	public function Get_news_pagi($keyword,$perpage,$record)
	{
		$this->db->select('toko_news.idNews,tanggal, title, deskripsi, news, keyword, image, status, counter, jenis');
		$this->db->join('toko_label_relation', 'toko_label_relation.idNews=toko_news.idNews');
		$this->db->join('toko_label_news', 'toko_label_news.idLabel=toko_label_relation.idLabel');
		$this->db->where('toko_news.status', 'publish');
		$this->db->like('label', $keyword);
		$this->db->or_like('news', $keyword);
		$this->db->or_like('title', $keyword);
		$this->db->limit($perpage,$record);
		$this->db->order_by('toko_news.tanggal','DESC');
		$query = $this->db->get('toko_news');
		return $query;
	}
	public function Get_pages_pagi($keyword,$perpage,$record)
	{
		$this->db->like('title', $keyword);
		$this->db->or_like('post', $keyword);
		$this->db->where('status', 'publik');
		$this->db->limit($perpage,$record);
		$this->db->order_by('date','DESC');
		$query = $this->db->get('toko_pages');
		return $query;
	}
}