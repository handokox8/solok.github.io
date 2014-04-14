<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galery extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_galery');

		$this->load->model('model_pages');

		$this->load->model('model_setting');
		$this->load->model('model_menu');
		$this->load->model('model_feature');
		$this->load->model('model_news');
		$this->load->model('model_client');
		$this->load->model('model_info');
		$this->load->model('model_sosial');
		$this->load->model('model_link');
		$this->load->model('model_widget');

		$this->load->model('model_label_relation');
	}

	public function Index($offset = 0)
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'semua galeri';
			$data['content'] = 'galery';

			// pagination
			$this->load->library('pagination');
			$perpage = 15;
			$count = $this->model_galery->get_count()->num_rows();
			
		
			$config = array(
				'base_url' => base_url(). 'galery/index/',
				'total_rows' => $count,
				'per_page' => $perpage,
			);
			
			// style pagination
			$config['full_tag_open'] = '<div class="pagination">';
			$config['full_tag_close'] = '</div>';
			$config['next_link']  = '<div class="digit">Next &rsaquo;</div>';
			$config['prev_link']   = '<div class="digit">&lsaquo; Prev</div>';
			$config['num_tag_open'] = '<div class="digit">';
			$config['num_tag_close'] = '</div>';
			$config['cur_tag_open'] = '<div class="digit current">';
			$config['cur_tag_close'] = '</div>';
			$config['num_links'] = 1;
			$config['last_link'] = '<div class="digit">Last &raquo;</div>';
			$config['first_link'] = '<div class="digit">&laquo; First</div>';
			
			$this->pagination->initialize($config);
			
			// end pagination

			if($this->model_galery->get_all(array('perpage' => $perpage, 'offset' => $offset))->num_rows()==0){
				$data['galery_all'] = 'NULL';
			} else {
				$data['galery_all'] = $this->model_galery->get_all(array('perpage' => $perpage, 'offset' => $offset))->result();
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	/*** display galeri ***/
	public function All($offset = 0)
	{
		$data['title'] = 'Galeri';
		$data['content'] = 'galery';

		/*
		 * INFORMASI SEO
		 */
		$data['info'] = $this->model_info->get_id('1')->row();
			$data['keyword'] = $data['info']->keyword;
			$data['author'] = $data['info']->title;
			$data['description'] = $data['info']->deskripsi;
		/*
		 * SETTING WEBSITE
		 */
		$data['setting'] = $this->model_setting->get_id()->row();

		/*
		 * MENU
		 */
		if($this->model_menu->get_parent('header')->num_rows()==0){
			$data['parent_head'] = 'NULL';
		} else {
			$data['parent_head']= $this->model_menu->get_parent('header')->result();
	        $jenis=$data['parent_head'];
	        $i=1;
	         foreach ($jenis as $row)  {
	            $data['child_head'.$i]= $this->model_menu->get_child($row->idMenus)->result();
	            $i++;
	        }
		}

        if($this->model_menu->get_parent('sidebar')->num_rows()==0){
			$data['parent_side'] = 'NULL';
		} else {
			$data['parent_side']= $this->model_menu->get_parent('sidebar')->result();
	        $jenis=$data['parent_side'];
	        $i=1;
	         foreach ($jenis as $row)  {
	            $data['child_side'.$i]= $this->model_menu->get_child($row->idMenus)->result();
	            $i++;
	        }	
		}

        if($this->model_menu->get_parent('footer')->num_rows()==0){
			$data['parent_foot'] = 'NULL';
		} else {
			$data['parent_foot']= $this->model_menu->get_parent('footer')->result();
	        $jenis=$data['parent_foot'];
	        $i=1;
	         foreach ($jenis as $row)  {
	            $data['child_foot'.$i]= $this->model_menu->get_child($row->idMenus)->result();
	            $i++;
	        }	
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
		if($this->model_widget->get_active()->num_rows()==0){
			$data['widget_all'] = 'NULL';
		} else {
			$data['widget_all'] = $this->model_widget->get_active()->result();
		}

		/*
		 * Galery
		 */
		// pagination
		$this->load->library('pagination');
		$perpage = 6;
		$count = $this->model_galery->get_count()->num_rows();
		
	
		$config = array(
			'base_url' => base_url(). 'galery/all/',
			'total_rows' => $count,
			'per_page' => $perpage,
		);
		
		// style pagination
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['next_link']  = '<div class="digit">Next &rsaquo;</div>';
		$config['prev_link']   = '<div class="digit">&lsaquo; Prev</div>';
		$config['num_tag_open'] = '<div class="digit">';
		$config['num_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<div class="digit current">';
		$config['cur_tag_close'] = '</div>';
		$config['num_links'] = 1;
		$config['last_link'] = '<div class="digit">Last &raquo;</div>';
		$config['first_link'] = '<div class="digit">&laquo; First</div>';
		
		$this->pagination->initialize($config);
		
		// end pagination

		if($this->model_galery->get_all(array('perpage' => $perpage, 'offset' => $offset))->num_rows()==0){
			$data['galery_all'] = 'NULL';
		} else {
			$data['galery_all'] = $this->model_galery->get_all(array('perpage' => $perpage, 'offset' => $offset))->result();
		}

		$this->load->view('template/index', $data);
	}
	/*** display galeri ***/

	public function Add_galery($offset = 0)
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Judul Galery', 'required|trim|xss_clean');
			$this->form_validation->set_rules('alt', 'Alternatif Text', 'required|trim|xss_clean');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'semua galeri';
				$data['content'] = 'galery';

				// pagination
				$this->load->library('pagination');
				$perpage = 15;
				$count = $this->model_galery->get_count()->num_rows();
				
			
				$config = array(
					'base_url' => base_url(). 'galery/index/',
					'total_rows' => $count,
					'per_page' => $perpage,
				);
				
				// style pagination
				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';
				$config['next_link']  = '<div class="digit">Next &rsaquo;</div>';
				$config['prev_link']   = '<div class="digit">&lsaquo; Prev</div>';
				$config['num_tag_open'] = '<div class="digit">';
				$config['num_tag_close'] = '</div>';
				$config['cur_tag_open'] = '<div class="digit current">';
				$config['cur_tag_close'] = '</div>';
				$config['num_links'] = 1;
				$config['last_link'] = '<div class="digit">Last &raquo;</div>';
				$config['first_link'] = '<div class="digit">&laquo; First</div>';
				
				$this->pagination->initialize($config);
				
				// end pagination

				if($this->model_galery->get_all(array('perpage' => $perpage, 'offset' => $offset))->num_rows()==0){
					$data['galery_all'] = 'NULL';
				} else {
					$data['galery_all'] = $this->model_galery->get_all(array('perpage' => $perpage, 'offset' => $offset))->result();
				}

				$this->load->view('admin/index', $data);
			} else {
				$config['upload_path'] = 'assets/gambar/galery/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
				$config['max_size']	= '2000';
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('galery')){
					// jika gagal
					$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
					redirect('galery/add_galery');		
				} else {
					$sub_data['result'] = $this->upload->data();
								
					foreach($sub_data['result'] as $item=>$data){
						$items = $sub_data['result']['file_name'];
					}

					$post = array(
							'title'=>$this->input->post('title'),
							'file'=>$items,
							'alt'=>$this->input->post('alt'),
							'deskripsi'=>$this->input->post('deskripsi')
						);
					$insert = $this->model_galery->insert($post);
					if($insert){
						$this->session->set_flashdata('flashOK', 'galery berhasil ditambahkan');
						redirect('galery/add_galery');
					} else {
						$this->session->set_flashdata('flashNO', 'galery gagal ditambahkan');
						redirect('galery/add_galery');
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Edit_galery()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Judul Galery', 'required|trim|xss_clean');
			$this->form_validation->set_rules('alt', 'Alternatif Text', 'required|trim|xss_clean');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$kode = $this->uri->segment(3);
				if($this->model_galery->get_id($kode)->num_rows()==0){
					show_404();
				} else {
					$data['title'] = 'perubahan galery';
					$data['content'] = 'edit_galery';

					// pagination
					$this->load->library('pagination');
					if($this->uri->segment(5) == ""){
						$offset = 0;
					}
					$perpage = 15;
					$count = $this->model_galery->get_count()->num_rows();
					
				
					$config = array(
						'base_url' => base_url(). 'galery/index/',
						'total_rows' => $count,
						'per_page' => $perpage,
					);
					
					// style pagination
					$config['full_tag_open'] = '<div class="pagination">';
					$config['full_tag_close'] = '</div>';
					$config['next_link']  = '<div class="digit">Next &rsaquo;</div>';
					$config['prev_link']   = '<div class="digit">&lsaquo; Prev</div>';
					$config['num_tag_open'] = '<div class="digit">';
					$config['num_tag_close'] = '</div>';
					$config['cur_tag_open'] = '<div class="digit current">';
					$config['cur_tag_close'] = '</div>';
					$config['num_links'] = 1;
					$config['last_link'] = '<div class="digit">Last &raquo;</div>';
					$config['first_link'] = '<div class="digit">&laquo; First</div>';
					
					$this->pagination->initialize($config);
					
					// end pagination

					if($this->model_galery->get_all(array('perpage' => $perpage, 'offset' => $offset))->num_rows()==0){
						$data['galery_all'] = 'NULL';
					} else {
						$data['galery_all'] = $this->model_galery->get_all(array('perpage' => $perpage, 'offset' => $offset))->result();
					}

					$data['galery_id'] = $this->model_galery->get_id($kode)->row();
					$this->load->view('admin/index', $data);
				}
			} else {
				// save data
				$kode = $this->input->post('kdAlbum');
				$title = $this->input->post('kdTitle');

				if($_FILES['galery']['name']==""){
					$post = array(
							'title'=>$this->input->post('title'),
							'alt'=>$this->input->post('alt'),
							'deskripsi'=>$this->input->post('deskripsi')
						);

					$update = $this->model_galery->update($kode,$post);
					if($update){
						$this->session->set_flashdata('flashOK', 'galery berhasil diubah');
						redirect('galery/edit_galery/'.$kode.'/'.$title);
					} else {
						$this->session->set_flashdata('flashNO', 'galery gagal diubah');
						redirect('galery/edit_galery/'.$kode.'/'.$title);
					}
				} else {
					$get['album_id'] = $this->model_galery->get_id($kode)->row();
					$path = 'assets/gambar/galery/'.$get['album_id']->file;
					$delete = unlink($path);
					if($delete){
						$config['upload_path'] = 'assets/gambar/galery/';
						$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
						$config['max_size']	= '2000';
						$config['encrypt_name'] = true;

						$this->load->library('upload', $config);
						if(! $this->upload->do_upload('galery')){
							// jika gagal
							$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
							redirect('galery/edit_galery/'.$kode.'/'.$title);		
						} else {
							$sub_data['result'] = $this->upload->data();
										
							foreach($sub_data['result'] as $item=>$data){
								$items = $sub_data['result']['file_name'];
							}

							$post = array(
									'title'=>$this->input->post('title'),
									'file'=>$items,
									'alt'=>$this->input->post('alt'),
									'deskripsi'=>$this->input->post('deskripsi')
								);

							$update = $this->model_galery->update($kode,$post);
							if($update){
								$this->session->set_flashdata('flashOK', 'galery berhasil diubah');
								redirect('galery/edit_galery/'.$kode.'/'.$title);
							} else {
								$this->session->set_flashdata('flashNO', 'galery gagal diubah');
								redirect('galery/edit_galery/'.$kode.'/'.$title);
							}
						}
					} else {
						echo 'gagal menghapus file';
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Del_galery()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			if($this->model_galery->get_id($kode)->num_rows()==0){
				show_404();
			} else {
				$get['album_id'] = $this->model_galery->get_id($kode)->row();
				$path = 'assets/gambar/galery/'.$get['album_id']->file;
				$delete = unlink($path);
				if($delete){
					$hapus = $this->model_galery->delete($kode);
					if($hapus){
						$this->session->set_flashdata('flashOK', 'galery berhasil dihapus');
						redirect('galery/');
					} else {
						$this->session->set_flashdata('flashNO', 'galery gagal dihapus');
						redirect('galery/');
					}
				} else {
					echo 'gagal menghapus file';
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}
}

/* End of file : galery.php */
/* Location : ./application/controllers/galery.php */