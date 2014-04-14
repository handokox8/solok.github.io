<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_info extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_info');
	}

	public function Index()
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'Informasi Website';
			$data['content'] = 'info';
			if($this->model_info->get_id('1')->num_rows()==0){
				$data['info_id'] = 'NULL';
			} else {
				$data['info_id'] = $this->model_info->get_id('1')->row();
			}
			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function Edit_info()
	{
	/***************************************************************************
	 * function untuk edit info
	 **************************************************************************/
		if($this->session->userdata('pengguna')){
			// form validation edit info
			$this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim|xss_clean');
			$this->form_validation->set_rules('keyword', 'Keyword', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			// cek form validation
			if($this->form_validation->run()==FALSE){
				// jika form validation bernilai FALSE
				$data['title'] = 'Edit Info';
				$data['content'] = 'info';
				$data['info_id'] = $this->model_info->get_id('1')->row();
				$this->load->view('admin/index', $data);
			} else {
				// jika form validation bernilai TRUE

				// data dari form edit info
				$post = array(
						'title'=>$this->input->post('title'),
						'deskripsi'=>$this->input->post('deskripsi'),
						'keyword'=>$this->input->post('keyword')
					);

				// melakukan perubahan data informasi
				$update = $this->model_info->save_info('1',$post);

				// cek perubahan data informasi
				if($update){
					// jika berhasil
					$this->session->set_flashdata('flashOK', 'your changes has been saved');

					redirect('admin_info/');
				} else {
					// jika gagal
					$this->session->set_flashdata('flashNO', 'your changes can not saved');

					redirect('admin_info/');
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}
}

/* End of file : admin_info.php */
/* Location : ./application/controllers/admin_info.php */