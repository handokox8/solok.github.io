<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_controller
{
	/***************************************************************************
	 * class mail/surat
	 **************************************************************************/
	function __construct()
	{
		parent::__construct();
		parent::__construct();
		$this->load->model('model_pages');

		$this->load->model('model_setting');
		$this->load->model('model_menu_2');
		$this->load->model('model_feature');
		$this->load->model('model_news');
		$this->load->model('model_client');
		$this->load->model('model_info');
		$this->load->model('model_sosial');
		$this->load->model('model_link');
		$this->load->model('model_widget');

		$this->load->model('model_slider');
		$this->load->model('model_kolom');

		$this->load->model('model_pages');

		$this->load->model('model_label');
		$this->load->model('model_label_relation');
		
	}

	public function Send_mail()
	{
	/***************************************************************************
	 * function untuk menampilkan form contact
	 **************************************************************************/
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim|xss_clean');
		$this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|valid_emails|xss_clean');
		$this->form_validation->set_rules('subject', 'Subject', 'required|trim|xss_clean');
		$this->form_validation->set_rules('message', 'Pesan', 'required|trim|xss_clean');

		$this->form_validation->set_message('required', '%s tidak boleh kosong!');
		$this->form_validation->set_message('valid_email', '%s bukan email yang benar!');
		$this->form_validation->set_message('valid_emails', '%s bukan email yang benar!');

		
		if($this->form_validation->run()==FALSE){
			$key = '4';
			/*
			 * INFORMASI SEO
			 */
			$data['info'] = $this->model_info->get_id('1')->row();
				$data['author'] = $data['info']->title;
			/*
			 * SETTING WEBSITE
			 */
			$data['setting'] = $this->model_setting->get_id()->row();
	
			/*
			 * MENU
			 */
			if($this->model_menu_2->get_all('menu_order')->num_rows()=='NULL'){
	            $data['gabul'] = 'NULL';
	        } else {
	        	$getMenu = $this->model_menu_2->get_all('menu_order')->result();
		        foreach ($getMenu as $row) {
		            $d[$row->parent_id][]= $row;
		            }
		        $data['gabul'] = home_menu($d);
	        }
	
	
	        /*
			 * FEATURE
			 */
	        if($this->model_feature->get_all()->num_rows()==0){
	        	$data['feature'] = 'NULL';
	        } else {
	        	$data['feature'] = $this->model_feature->get_all()->result();
	        }
	
	        /*
			 * NEWS
			 * menampilkan Konten menggunakan parameter ('<batasan yang ditampilkan>','<status Konten>')
			 */
	        if($this->model_news->get_limit('5','publish')->num_rows()==0){
	        	$data['news'] = 'NULL';
	        } else {
	        	$data['news'] = $this->model_news->get_limit('5','publish')->result();
	        }
	
	        /*
			 * CLIENT
			 */
	        if($this->model_client->get_all()->num_rows()==0){
	        	$data['client_all'] = 'NULL';
	        } else {
	        	$data['client_all'] = $this->model_client->get_all()->result();
	        }
	
	        /*
			 * SOSIAL MEDIA
			 */
	        $data['sosial'] = $this->model_sosial->get_setting('1')->row();
	
	        /*
			 * LINK
			 */
	        if($this->model_link->get_all()->num_rows()==0){
				$data['link_all'] = 'NULL';
			} else {
				$data['link_all'] = $this->model_link->get_all()->result();
			}
	
			/*
			 * WIDGET
			 */
			if($this->model_widget->get_active('sidebar1')->num_rows()==0){
				$data['widget_satu'] = 'NULL';
			} else {
				$data['widget_satu'] = $this->model_widget->get_active('sidebar1')->result();
			}
	
			if($this->model_widget->get_active('sidebar2')->num_rows()==0){
				$data['widget_dua'] = 'NULL';
			} else {
				$data['widget_dua'] = $this->model_widget->get_active('sidebar2')->result();
			}

			/*
			 * CONTACT
			 */
			if($this->model_pages->get_id($key)->num_rows()==0){
				show_404();
			} else {
				$data['pages_id'] = $this->model_pages->get_id($key)->row();

					$data['title'] = $data['pages_id']->title;	// title blog
					$data['paragraf'] = $data['pages_id']->post;
					$data['description'] = $data['pages_id']->deskripsi;					// description blog
					$data['keyword'] = $data['pages_id']->keyword;							// keyword blog
			}
			$data['content'] = 'contact';
			$this->load->view('template/index', $data);
		} else {
			/***************************************************************************
			 * function untuk mengirim mail/surat
			 **************************************************************************/
			// send mail from other form
			$this->load->library('email');
			
			/*
			 * INFORMASI SEO
			 */
			$data['info'] = $this->model_info->get_id('1')->row();
				$data['author'] = $data['info']->title;

			$this->email->from($this->input->post('email'), $this->input->post('name'));
			$this->email->to($data['info']->email);
			//$this->email->cc('gojin.sp10@gmail.com'); 
			
			$this->email->subject($this->input->post('subject'));
			$message = 'Pesan ini dikirm melalui website : '.base_url()."\n".'**************************************************************************'."\n".'Pesan :'."\n".$this->input->post('message')."\n".'**************************************************************************'."\n".'Terimakasih';
			$this->email->message($message);	
			
			$send = $this->email->send();
			if($send){
				$this->session->set_flashdata('flashOK', 'Pesan anda telah terkirim');
				redirect('mail/send_mail');
			} else {
				$this->session->set_flashdata('flashNO', 'Pesan anda gagal dikirim');
				redirect('mail/send_mail');
			}
		}	
	}

	public function mail_send()
	{
	/***************************************************************************
	 * function untuk mengirim mail/surat
	 **************************************************************************/
		// send mail from other form
		$this->load->library('email');
		
		$data['info'] = $this->model_info->get_id('1')->row();

		$this->email->from($this->input->post('email'), $this->input->post('name'));
		$this->email->to($data['info']->email);
		
		$this->email->subject($this->input->post('subject'));
		$this->email->message($this->input->post('message'));	
		
		$send = $this->email->send();
		if($send){
			$this->session->set_flashdata('flashOK', 'Pesan anda telah terkirim');
			redirect('mail/send_mail');
		} else {
			$this->session->set_flashdata('flashNO', 'Pesan anda gagal dikirim');
			redirect('mail/send_mail');
		}
	}
}

/* End of file : mail.php */
/* Location : ./application/controllers/mail.php */