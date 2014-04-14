<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_controller
{
	/***************************************************************************
	 * class forum
	 **************************************************************************/
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_forum');
		$this->load->model('model_komentar');

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
		if($this->session->userdata('idFolower')){
			$data['title'] = 'Daftar Forum';
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
	        if($this->model_news->get_limit('4','publish')->num_rows()==0){
	        	$data['news'] = 'NULL';
	        } else {
	        	$data['news'] = $this->model_news->get_limit('4','publish')->result();
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
			if($this->model_widget->get_active_limit('sidebar1','1')->num_rows()==0){
				$data['widget_satu_limit'] = 'NULL';
			} else {
				$data['widget_satu_limit'] = $this->model_widget->get_active_limit('sidebar1','1')->result();
			}

			if($this->model_widget->get_active_limit('sidebar2','1')->num_rows()==0){
				$data['widget_dua_limit'] = 'NULL';
			} else {
				$data['widget_dua_limit'] = $this->model_widget->get_active_limit('sidebar2','1')->result();
			}

			/*
			 * Slider
			 */
			if($this->model_slider->get_all()->num_rows()==0){
				$data['slider_all'] = 'NULL';
			} else {
				$data['slider_all'] = $this->model_slider->get_all()->result();
			}

	/* template custom sosismahkotadurian.com */
			/*
			 * SHOW LOKASI
			 */
			if($this->model_label_relation->get_label_limit('1','4')->num_rows()==0){
				$data['lokasi_all'] = 'NULL';
			} else {
				$data['lokasi_all'] = $this->model_label_relation->get_label_limit('1','4')->result();
			}

			if($this->model_forum->get_all()->num_rows()==0){
				$data['forum_all'] = 'NULL';
			} else {
				$data['forum_all'] = $this->model_forum->get_all()->result();
			}

			$data['content'] = 'forum';
			$this->load->view('template/index', $data);


		} else {
			redirect('member/login');
		}
	}

	public function Detil()
	{
		if($this->session->userdata('idFolower')){
			if($this->uri->segment(3) == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
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
		        if($this->model_news->get_limit('4','publish')->num_rows()==0){
		        	$data['news'] = 'NULL';
		        } else {
		        	$data['news'] = $this->model_news->get_limit('4','publish')->result();
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
				if($this->model_widget->get_active_limit('sidebar1','1')->num_rows()==0){
					$data['widget_satu_limit'] = 'NULL';
				} else {
					$data['widget_satu_limit'] = $this->model_widget->get_active_limit('sidebar1','1')->result();
				}

				if($this->model_widget->get_active_limit('sidebar2','1')->num_rows()==0){
					$data['widget_dua_limit'] = 'NULL';
				} else {
					$data['widget_dua_limit'] = $this->model_widget->get_active_limit('sidebar2','1')->result();
				}

				/*
				 * Slider
				 */
				if($this->model_slider->get_all()->num_rows()==0){
					$data['slider_all'] = 'NULL';
				} else {
					$data['slider_all'] = $this->model_slider->get_all()->result();
				}

		/* template custom sosismahkotadurian.com */
				/*
				 * SHOW LOKASI
				 */
				if($this->model_label_relation->get_label_limit('1','4')->num_rows()==0){
					$data['lokasi_all'] = 'NULL';
				} else {
					$data['lokasi_all'] = $this->model_label_relation->get_label_limit('1','4')->result();
				}

				$kode = $this->uri->segment(3);
				if($this->model_forum->get_id($kode)->num_rows()==0){
					show_404();
				} else {
					$data['forum_id'] = $this->model_forum->get_id($kode)->row();
						if($this->model_komentar->get_forum($data['forum_id']->idForum)->num_rows()==0){
							$data['komentar'] = 'NULL';
						} else {
							$data['komentar'] = $this->model_komentar->get_forum($data['forum_id']->idForum)->result();
						}
						if($this->model_forum->get_komen($kode)->num_rows()==0){
							$data['komen_all'] = 'NULL';
						} else {
							$data['komen_all'] = $this->model_forum->get_komen($kode)->result();
						}
					$data['title'] = $data['forum_id']->title;
					$data['paragraf'] = $data['forum_id']->post;
				}

				$data['content'] = 'single_forum';
				$this->load->view('template/index', $data);
			}
		} else {
			redirect('member/login');
		}
	}

	public function Komentar()
	{
		if($this->session->userdata('idFolower')){
			$this->form_validation->set_rules('komen', 'Komentar', 'required|trim|xss_clean');

			$kodeUrl = $this->input->post('kdUrl');
			$kodeForum = $this->input->post('kdForum');

			if($this->form_validation->run()==FALSE){
				redirect($kodeUrl);
			} else {
				// save data
				$post = array(
						'idForum'=>$kodeForum,
						'idFolower'=>$this->session->userdata('idFolower'),
						'tanggal'=>date("Y-m-d H:i:s"),
						'komentar'=>$this->input->post('komen')
					);
				if($this->model_komentar->insert($post)){
					redirect($kodeUrl);
				} else {
					redirect($kodeUrl);
				}
			}
		} else {
			redirect('member/login');
		}
	}

	public function Get_forum()
	{
		if($this->session->userdata('pengguna')){
			if($this->model_forum->get_all()->num_rows()==0){
				$data['forum_all'] = 'NULL';
			} else {
				$data['forum_all'] = $this->model_forum->get_all()->result();

			}

			$data['title'] = 'Daftar Forum';
			$data['content'] = 'forum';

			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function Add_forum()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Judul Forum', 'required|trim|xss_clean');
			$this->form_validation->set_rules('elm1', 'Isi Forum', 'required|trim');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|xss_clean');
			$this->form_validation->set_rules('keyword', 'Keyword', 'trim|xss_clean');
			$this->form_validation->set_rules('titleSeo', 'Judul SEO Forum', 'trim|xss_clean');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'Tambah Forum';
				$data['content'] = 'add_forum';

				$this->load->view('admin/index', $data);
			} else {
				// save data
				$post = array(
						'title'=>$this->input->post('title'),
						'tanggal'=>date("Y-m-d H:i:s"),
						'titleSeo'=>$this->input->post('titleSeo'),
						'post'=>$this->input->post('elm1'),
						'deskripsi'=>$this->input->post('deskripsi'),
						'keyword'=>$this->input->post('keyword')
					);
				if($this->model_forum->insert($post)){
					$this->session->set_flashdata('flashOK', 'forum berhasil ditambahkan');
					redirect('forum/add_forum');
				} else {
					$this->session->set_flashdata('flashNO', 'forum gagal ditambahkan');
					redirect('forum/add_forum');
				}
			}			
		} else {
			redirect('ngadmin/');
		}
	}
	public function Edit()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Judul Forum', 'required|trim|xss_clean');
			$this->form_validation->set_rules('elm1', 'Isi Forum', 'required|trim');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|xss_clean');
			$this->form_validation->set_rules('keyword', 'Keyword', 'trim|xss_clean');
			$this->form_validation->set_rules('titleSeo', 'Judul SEO Forum', 'trim|xss_clean');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'Edit Forum';
				$data['content'] = 'edit_forum';
				$kode = $this->uri->segment(3);
				if($this->model_forum->get_id($kode)->num_rows()==0){
					show_404();
				} else {
					$data['forum_id'] = $this->model_forum->get_id($kode)->row();
				$this->load->view('admin/index', $data);
				}
			} else {
				$kode = $this->uri->segment(3);
				// save data
				$post = array(
						'title'=>$this->input->post('title'),
						'tanggal'=>date("Y-m-d H:i:s"),
						'titleSeo'=>$this->input->post('titleSeo'),
						'post'=>$this->input->post('elm1'),
						'deskripsi'=>$this->input->post('deskripsi'),
						'keyword'=>$this->input->post('keyword')
					);
				if($this->model_forum->update($kode,$post)){
					$this->session->set_flashdata('flashOK', 'forum berhasil diubah');
					redirect('forum/edit/'.$this->uri->segment(3));
				} else {
					$this->session->set_flashdata('flashNO', 'forum gagal diubah');
					redirect('forum/edit/'.$this->uri->segment(3));
				}
			}			
		} else {
			redirect('ngadmin/');
		}
		
	}
		public function trash()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			$delete = $this->model_forum->delete($kode);
			$delete_rel = $this->model_forum->delete_rel($kode);
			
				
					$this->session->set_flashdata('flashOK', 'data forum berhasil dihapus');
					redirect('forum/get_forum');
				
				
			
		} else {
			redirect('ngadmin/');
		}
	}


}