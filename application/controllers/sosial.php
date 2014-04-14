<?php if ( ! defined('BASEPATH')) exit('No script direct access allowed');

class Sosial extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_sosial');
	}

	public function Setting_acount()
	{
	/***************************************************************************
	 * function untuk merubah account setting
	 **************************************************************************/
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('facebook', 'facebook', 'trim|xss_clean');
			$this->form_validation->set_rules('twitter', 'twitter', 'trim|xss_clean');
			$this->form_validation->set_rules('ym', 'ym', 'trim|xss_clean');
			$this->form_validation->set_rules('linkedin', 'linkedin', 'trim|xss_clean');
			$this->form_validation->set_rules('flikr', 'flikr', 'trim|xss_clean');

			$data['title'] = 'Edit Acount';
			$data['content'] = 'edit_acount';
			if($this->form_validation->run()==FALSE){
				if($this->model_sosial->get_setting('1')->num_rows()==0){
					echo "no data";
				} else {
					$data['setting_id'] = $this->model_sosial->get_setting('1')->row();
				}
				$this->load->view('admin/index',$data);
			} else {
				// save data
				$key = '1';
				$post = array(
						'facebook'=>$this->input->post('facebook'),
						'twitter'=>$this->input->post('twitter'),
						'ym'=>$this->input->post('ym'),
						'linkedin'=>$this->input->post('linkedin'),
						'flikr'=>$this->input->post('flikr')
					);
				$update = $this->model_sosial->update_setting($key,$post);
				if($update){
					$this->session->set_flashdata('flashOK', 'Setting has been change');

					redirect('sosial/setting_acount');
				} else {
					$this->session->set_flashdata('flashNO','Your changes can not saved');
					
					redirect('sosial/setting_acount');
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}
}

/* End of file : sosial.php */
/* Location : ./application/controllers/sosial.php */