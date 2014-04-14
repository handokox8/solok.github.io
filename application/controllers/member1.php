<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		parent::__construct();
		$this->load->model('model_news');
		$this->load->model('model_label');
		$this->load->model('model_pages');
		$this->load->model('model_label_relation');
		$this->load->model('model_setting');
		$this->load->model('model_menu_2');
		$this->load->model('model_client');
		$this->load->model('model_info');
		$this->load->model('model_sosial');
		$this->load->model('model_link');
		$this->load->model('model_widget');
		$this->load->model('model_feature');
		$this->load->model('model_kolom');
		$this->load->model('model_folower');
	}

	public function index()
	{
		show_404();
	}

	/***************************************************************************
	 * function untuk melakukan registrasi
	 **************************************************************************/
	public function registrasi()
	{
		$setting = $this->model_setting->get_id()->row();
		if($setting->register == 'yes'){
			/*
			 * option for show logo
			 */
			if($this->model_setting->get_id()->num_rows()==0){
				$data['logo'] = 'NULL';
			} else {
				$get = $this->model_setting->get_id()->row();
				$data['logo'] = $get->logo;
			}

			$data['title'] = 'Akses Login';
			$data['form_load'] = 'myform';
			$this->load->view('template/registrasi', $data);
			
		}else{
			show_404();
		}
	}

	public function Daftar()
	{
		$setting = $this->model_setting->get_id()->row();
		if($setting->register == 'yes'){
				$this->form_validation->set_rules('nama', 'Nama Pengguna', 'required|trim|xss_clean|strip_tags|encode_php_tags');
				$this->form_validation->set_rules('username', 'username', 'required|trim|xss_clean|strip_tags|encode_php_tags');
				$this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|xss_clean|strip_tags|encode_php_tags|valid_email|valid_emails');
				$this->form_validation->set_rules('password', 'Kata Kunci', 'required|trim|xss_clean|strip_tags|encode_php_tags|min_length[4]');
				$this->form_validation->set_rules('password2', 'Kata Kunci 2', 'required|trim|xss_clean|strip_tags|encode_php_tags|matches[password]|min_length[4]');

				$this->form_validation->set_message('required', '%s tidak boleh kosong!');
				$this->form_validation->set_message('valid_email', '%s e-mail tidak valid!');
				$this->form_validation->set_message('valid_emails', '%s e-mail tidak valid!');
				$this->form_validation->set_message('min_length', '%s minimal 4 karakter!');
				$this->form_validation->set_message('matches', '%s harus sama dengan Kata Kunci!');

				$this->form_validation->set_error_delimiters('<div class="error"><p><span><i class="icon-exclamation-sign icon-large"></i></span> ', '</div>');

				if($this->form_validation->run()==FALSE){
					if($this->model_setting->get_id()->num_rows()==0){
						$data['logo'] = 'NULL';
					} else {
						$get = $this->model_setting->get_id()->row();
						$data['logo'] = $get->logo;
					}

					$data['title'] = 'Akses Login';
					$data['form_load'] = 'myform';
					$this->load->view('template/registrasi', $data);
				} else {
					$text = $this->input->post('username');
					$a = explode(" ", $text);

					if(count($a) > 1){
						$this->session->set_flashdata('flashNO','Username tidak boleh menggunakan spasi');
						redirect('member/registrasi');
					} else {

						$username = $this->input->post('username');
						$email = $this->input->post('email');

						if($this->model_folower->get_username($username,$email)->num_rows()==0){
							$post = array(

										'namaFolower' => $this->input->post('nama') ,
										'usernameFolower' => $this->input->post('username') ,
										'emailFolower' => $this->input->post('email') ,
										'passwordFolower' => md5($this->input->post('password'))

							 				);
							$insert = $this->model_folower->insert($post);

							if($insert){
								$this->session->set_flashdata('flashOK','Berhasil Melakukan Registrasi');
								redirect('member/login');
							}
						} else {
							$this->session->set_flashdata('flashNO','Email atua Username telah digunakan');
							redirect('member/registrasi');
						}
					}
				}
			
		}else{
			show_404();
		}
	}

	public function Login()
	{
		$setting = $this->model_setting->get_id()->row();
		if($setting->register == 'yes'){
			// cek login
			$this->form_validation->set_rules('username', 'Nama Pengguna', 'required|trim|xss_clean');
			$this->form_validation->set_rules('password', 'Kata Kunci', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				/*
				 * option for show logo
				 */
				if($this->model_setting->get_id()->num_rows()==0){
					$data['logo'] = 'NULL';
				} else {
					$get = $this->model_setting->get_id()->row();
					$data['logo'] = $get->logo;
				}
				
				$data['title'] = 'Akses Login';
				$data['form_load'] = 'myform';
				$this->load->view('template/login', $data);
			} else {
				// cek login
				if ($this->model_folower->get_folower(/*strtolower(*/$this->input->post('username')/*)*/,md5($this->input->post('password')))->num_rows()==0){
					$this->session->set_flashdata('flashNO', 'Nama pengguna dan kata kunci tidak cocok');
					redirect('member/login');
				} else {
					$data['user'] = $this->model_folower->get_folower(/*strtolower(*/$this->input->post('username')/*)*/,md5($this->input->post('password')))->row();
					
					$this->session->set_userdata('idFolower',$data['user']->idFolower);
					$this->session->set_userdata('folower',$data['user']->usernameFolower);
					$this->session->set_flashdata('flashOK', 'Berhasil Login');
					redirect('member/login');
				}
			}
		}else{
			show_404();
		}
	}

}

/* End of file : registrasi.php */
/* Location : ./application/controllers/registrasi.php */
