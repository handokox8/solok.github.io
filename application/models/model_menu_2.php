<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_menu_2 extends CI_Model
{
    private $nama_tabel = 'toko_menu';
    private $kunci = 'id_menu';

    public function Get_all($order)
    {   
        $this->db->order_by($order);
        $query = $this->db->get($this->nama_tabel);
        return $query;
    }
    public function insert($post)
    {
        $query = $this->db->insert($this->nama_tabel, $post);
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
        $this->db->where($this->kunci, $kode);
        $query = $this->db->delete($this->nama_tabel);
        return $query;
    }
    public function Get_id($kode)
    {
        $this->db->where($this->kunci,$kode);
        $query = $this->db->get($this->nama_tabel);
        return $query;
    }
    public function Update_parent($kode,$post)
    {
        $this->db->where('parent_id',$kode);
        $query = $this->db->update($this->nama_tabel,$post);
        return $query;
    }
    public function max($keyword)
    {
        $this->db->select_max($keyword);
        $query = $this->db->get($this->nama_tabel);
        return $query;
    }

        public function Get_all_no($kode,$order)
    {
        $this->db->where_not_in('id_menu',$kode);
        $this->db->order_by($order);
        $query = $this->db->get($this->nama_tabel);
        return $query;
    }
}

/* End of file : model_menu_2.php */
/* Location : ./application/models/model_menu_2.php */