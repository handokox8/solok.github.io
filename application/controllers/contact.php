<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_controller
{
	/***************************************************************************
	 * class contact
	 **************************************************************************/
	function __construct()
	{
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

	public function Index()
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'Kontak Website';
			$data['content'] = 'contact';
			$data['info'] = $this->model_info->get_id('1')->row();
			$data['pages_id'] = $this->model_pages->get_id('4')->row();
			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function Detail()
	{
	/***************************************************************************
	 * function untuk melihat detail contact
	 **************************************************************************/
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
				$data['description'] = $data['pages_id']->deskripsi;						// description blog
				$data['keyword'] = $data['pages_id']->keyword;							// keyword blog
		}
		$data['content'] = 'contact';
		$this->load->view('template/index', $data);
	}

	public function Edit_contact()
	{
	/***************************************************************************
	 * function untuk merubah contact
	 **************************************************************************/
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean');
			$this->form_validation->set_rules('description', 'Deskripsi', 'required|trim|xss_clean');
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|valid_emails|trim|xss_clean');
			$this->form_validation->set_rules('contact', 'Contact', 'required|trim|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'required|trim|xss_clean');
			$this->form_validation->set_rules('keyword', 'Kata Kunci', 'required|trim|xss_clean');
			$this->form_validation->set_rules('elm1', 'Detail', 'trim');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');
			$this->form_validation->set_message('valid_email', '%s bukan email yang benar!');
			$this->form_validation->set_message('valid_emails', '%s bukan email yang benar!');
			

			if($this->form_validation->run()==FALSE){
				$key = '4';

				$data['title'] = 'Edit Contact';
				$data['content'] = 'edit_contact';
				$data['info'] = $this->model_info->get_id('1')->row();
				$data['pages_id'] = $this->model_pages->get_id($key)->row();
				$this->load->view('admin/index', $data);
			} else {
				$config['upload_path'] = 'assets/gambar/maps/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
				$config['max_size']	= '1000';
				$config['max_width']  = '570';
				$config['max_height']  = '330';
				$config['encrypt_name'] = true;
					
				$this->load->library('upload', $config);
				// save data
				if($_FILES['userfile']['name'] == ""){
					$key1 = '4';
					$key2 = '1';
					$post1 = array(
							'post'=>$this->input->post('elm1'),
							'title'=>$this->input->post('title'),
							'deskripsi'=>$this->input->post('description'),
							'keyword'=>$this->input->post('keyword')
						);
					$update1 = $this->model_pages->update_pages($key1,$post1);
					if($update1){
						$post2 = array(
								'email'=>$this->input->post('email'),
								'address'=>$this->input->post('address'),
								'contact'=>$this->input->post('contact')
							);

						$update2 = $this->model_info->save_info($key2,$post2);
						if($update2){
							$this->session->set_flashdata('flashOK', 'data berhasil diubah');

							redirect('contact/edit_contact');
						} else {
							$this->session->set_flashdata('flashNO', 'data gagal diubah');

							redirect('contact/edit_contact');
						}
					} else {
						$this->session->set_flashdata('flashNO', 'data gagal diubah');

						redirect('admin_info/edit_info');
					}
				} else {
					// save data
					if(! $this->upload->do_upload()){
						$this->session->set_flashdata('flashNO', $sub_data['error'] = $this->upload->display_errors());
						redirect ('contact/edit_contact');
					} else {
						$sub_data['result'] = $this->upload->data();
						
						foreach($sub_data['result'] as $item=>$data){
							$items = $sub_data['result']['file_name'];
						}
						$key1 = '4';
						$key2 = '1';
						$post1 = array(
							'post'=>$this->input->post('elm1'),
							'title'=>$this->input->post('title'),
							'deskripsi'=>$this->input->post('description'),
							'keyword'=>$this->input->post('keyword')
						);
						$post2 = array(
								'maps'=>$items,
								'email'=>$this->input->post('email'),
								'address'=>$this->input->post('address'),
								'contact'=>$this->input->post('contact')
							);
						$url = $this->input->post('value');
						$path = 'assets/gambar/maps/'.$url;

						$delete = unlink($path);
						if($delete){
							$update1 = $this->model_pages->update_pages($key1,$post1);
							if($update1){
								$update2 = $this->model_info->save_info($key2,$post2);
								if($update2){
									$this->session->set_flashdata('flashOK', 'data berhasil diubah');

									redirect('contact/edit_contact');
								} else {
									$this->session->set_flashdata('flashNO', 'data gagal diubah');

									redirect('contact/edit_contact');
								}
							} else {
								$this->session->set_flashdata('flashNO', 'data gagal diubah');

								redirect('contact/edit_contact');
							}
						} else {
							echo 'gagal coy';
						}
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}
}

/* End of file : contact.php */
/* Location : ./application/controllers/contact.php */