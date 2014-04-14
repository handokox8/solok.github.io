<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_attachment');
	}

	public function Index()
	{
		if($this->session->userdata('pengguna')){
			if($data['media'] = $this->m_attachment->get_all()->num_rows()==0){
				$data['media_all'] = 'NULL';
			} else {
				$data['media_all'] = $this->m_attachment->get_all()->result();
				$data['year_month']= $this->m_attachment->get_year_month()->result();
			}
			$data['title'] = 'Media';
			$data['content'] = 'media';
			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function Del_media()
	{
		if($this->session->userdata('pengguna')){

			$id = $this->uri->segment(3);
            $this->m_attachment->edit_attachment($id,array('status'=>'deleted'));
            $ndata['nama'] = $this->m_attachment->get_attachment($id = $id);
            $path1 = 'assets/uploads/'.$ndata['nama']->file;
            if(file_exists($path1)){
            	unlink($path1);
            		$this->session->set_flashdata('flashOK', 'media berhasil dihapus');
            		redirect('media/');
            } else {
            	$this->session->set_flashdata('flashNO', 'media 1 gagal dihapus');
            	redirect('media/');
            }

		} else {
			redirect('ngadmin/');
		}
	}

	public function Sort_media()
	{
		if($this->session->userdata('pengguna')){
			$m = $this->input->post('m')?$this->input->post('m') : '';
            $year='';
            $month ='';
            if($m !=''):
                $i = explode('-', $m);
                $year = $i[0];
                $month = $i[1];
            endif;
            
            if($this->m_attachment->get_sort('published',$year,$month)->num_rows()==0){
            	$data['media_all'] = 'NULL';
            } else {
            	$data['year_month'] = $this->m_attachment->get_year_month()->result();
            	$data['media_all'] = $this->m_attachment->get_sort('published',$year,$month)->result();
            }

			$data['title'] = 'Media';
			$data['content'] = 'media_sort';
			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}
}

/* End of file : media.php */
/* Location : ./application/controllers/media.php */