<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Label extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_label');
		$this->load->model('model_label_relation');

		$this->load->model('model_setting');
		$this->load->model('model_menu_2');
		$this->load->model('model_feature');
		$this->load->model('model_news');
		$this->load->model('model_client');
		$this->load->model('model_info');
		$this->load->model('model_sosial');
		$this->load->model('model_link');
		$this->load->model('model_widget');
		$this->load->model('model_kolom');

		$this->load->model('model_pages');
	}

	public function Index()
	{
		show_404();
	}

// 	public function Arsip()
// 	{
// 		$data['title'] = 'Semua Lokasi';
// 		/*
// 		 * INFORMASI SEO
// 		 */
// 		$data['info'] = $this->model_info->get_id('1')->row();
// 			$data['keyword'] = $data['info']->keyword;
// 			$data['author'] = $data['info']->title;
// 			$data['description'] = $data['info']->deskripsi;
// 		/*
// 		 * SETTING WEBSITE
// 		 */
// 		$data['setting'] = $this->model_setting->get_id()->row();

// 		/*
// 		 * MENU
// 		 */
// 		if($this->model_menu_2->get_all('menu_order')->num_rows()=='NULL'){
//             $data['gabul'] = 'NULL';
//         } else {
//         	$getMenu = $this->model_menu_2->get_all('menu_order')->result();
// 	        foreach ($getMenu as $row) {
// 	            $d[$row->parent_id][]= $row;
// 	            }
// 	        $data['gabul'] = home_menu($d);
//         }

//         /*
// 		 * FEATURE
// 		 */
//         if($this->model_feature->get_all()->num_rows()==0){
//         	$data['feature'] = 'NULL';
//         } else {
//         	$data['feature'] = $this->model_feature->get_all()->result();
//         }

//         /*
// 		 * NEWS
// 		 * menampilkan Konten menggunakan parameter ('<batasan yang ditampilkan>','<status Konten>')
// 		 */
//         if($this->model_news->get_limit('5','publish')->num_rows()==0){
//         	$data['news'] = 'NULL';
//         } else {
//         	$data['news'] = $this->model_news->get_limit('5','publish')->result();
//         }

//         /*
// 		 * CLIENT
// 		 */
//         if($this->model_client->get_all()->num_rows()==0){
//         	$data['client_all'] = 'NULL';
//         } else {
//         	$data['client_all'] = $this->model_client->get_all()->result();
//         }

//         /*
// 		 * SOSIAL MEDIA
// 		 */
//         $data['sosial'] = $this->model_sosial->get_setting('1')->row();

//         /*
// 		 * LINK
// 		 */
//         if($this->model_link->get_all()->num_rows()==0){
// 			$data['link_all'] = 'NULL';
// 		} else {
// 			$data['link_all'] = $this->model_link->get_all()->result();
// 		}

// 		/*
// 		 * WIDGET
// 		 */
// 		if($this->model_widget->get_active('sidebar1')->num_rows()==0){
// 			$data['widget_satu'] = 'NULL';
// 		} else {
// 			$data['widget_satu'] = $this->model_widget->get_active('sidebar1')->result();
// 		}

// 		if($this->model_widget->get_active('sidebar2')->num_rows()==0){
// 			$data['widget_dua'] = 'NULL';
// 		} else {
// 			$data['widget_dua'] = $this->model_widget->get_active('sidebar2')->result();
// 		}

// /* template custom sosismahkotadurian.com */
// 		/*
// 		 * SHOW LOKASI
// 		 */
// 		if($this->model_label_relation->get_label_limit('1','3')->num_rows()==0){
// 			$data['lokasi_all'] = 'NULL';
// 		} else {
// 			$data['lokasi_all'] = $this->model_label_relation->get_label_limit('1','3')->result();
// 		}

// 		if($this->model_label_relation->get_label_limit('1','')->num_rows()==0){
// 			$data['semua_lokasi'] = 'NULL';
// 		} else {
// 			$data['semua_lokasi'] = $this->model_label_relation->get_label_limit('1','')->result();
// 		}
// /* template custom sosismahkotadurian.com */

// 		$data['content'] = 'arsip';
// 		$this->load->view('template/index', $data);
// 	}

/* template custom sosismahkotadurian.com */
// 	public function Lokasi()
// 	{
// 		$data['title'] = 'Semua Lokasi';
// 		/*
// 		 * INFORMASI SEO
// 		 */
// 		$data['info'] = $this->model_info->get_id('1')->row();
// 			$data['keyword'] = $data['info']->keyword;
// 			$data['author'] = $data['info']->title;
// 			$data['description'] = $data['info']->deskripsi;
// 		/*
// 		 * SETTING WEBSITE
// 		 */
// 		$data['setting'] = $this->model_setting->get_id()->row();

// 		/*
// 		 * MENU
// 		 */
// 		if($this->model_menu_2->get_all('menu_order')->num_rows()=='NULL'){
//             $data['gabul'] = 'NULL';
//         } else {
//         	$getMenu = $this->model_menu_2->get_all('menu_order')->result();
// 	        foreach ($getMenu as $row) {
// 	            $d[$row->parent_id][]= $row;
// 	            }
// 	        $data['gabul'] = home_menu($d);
//         }

//         /*
// 		 * FEATURE
// 		 */
//         if($this->model_feature->get_all()->num_rows()==0){
//         	$data['feature'] = 'NULL';
//         } else {
//         	$data['feature'] = $this->model_feature->get_all()->result();
//         }

//         /*
// 		 * NEWS
// 		 */
//         if($this->model_news->get_limit('5','publish')->num_rows()==0){
//         	$data['news'] = 'NULL';
//         } else {
//         	$data['news'] = $this->model_news->get_limit('5','publish')->result();
//         }

//         /*
// 		 * CLIENT
// 		 */
//         if($this->model_client->get_all()->num_rows()==0){
//         	$data['client_all'] = 'NULL';
//         } else {
//         	$data['client_all'] = $this->model_client->get_all()->result();
//         }

//         /*
// 		 * SOSIAL MEDIA
// 		 */
//         $data['sosial'] = $this->model_sosial->get_setting('1')->row();

//         /*
// 		 * LINK
// 		 */
//         if($this->model_link->get_all()->num_rows()==0){
// 			$data['link_all'] = 'NULL';
// 		} else {
// 			$data['link_all'] = $this->model_link->get_all()->result();
// 		}

// 		/*
// 		 * WIDGET
// 		 */
// 		if($this->model_widget->get_active('sidebar1')->num_rows()==0){
// 			$data['widget_satu'] = 'NULL';
// 		} else {
// 			$data['widget_satu'] = $this->model_widget->get_active('sidebar1')->result();
// 		}

// 		if($this->model_widget->get_active('sidebar2')->num_rows()==0){
// 			$data['widget_dua'] = 'NULL';
// 		} else {
// 			$data['widget_dua'] = $this->model_widget->get_active('sidebar2')->result();
// 		}

// /* template custom sosismahkotadurian.com */
// 		/*
// 		 * SHOW LOKASI
// 		 */
// 		if($this->model_label_relation->get_label_limit('1','3')->num_rows()==0){
// 			$data['lokasi_all'] = 'NULL';
// 		} else {
// 			$data['lokasi_all'] = $this->model_label_relation->get_label_limit('1','3')->result();
// 		}

// 		if($this->model_label_relation->get_label_limit('1','')->num_rows()==0){
// 			$data['semua_lokasi'] = 'NULL';
// 		} else {
// 			$data['semua_lokasi'] = $this->model_label_relation->get_label_limit('1','')->result();
// 		}
// /* template custom sosismahkotadurian.com */

// 		$data['content'] = 'arsip';
// 		$this->load->view('template/index', $data);
// 	}
// /* template custom sosismahkotadurian.com */

	public function Get_label()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('label', 'Label', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'Tambah label';
				$data['content'] = 'label';
				if($this->model_label->get_all()->num_rows()==0){
					$data['label_all'] = 'NULL';
				} else {
					$data['label_all'] = $this->model_label->get_all()->result();
				}
				$this->load->view('admin/index', $data);
			} else {

				if($this->model_label->get_all()->num_rows()==0){

				} else {
					$get = $this->model_label->get_all()->result();
				}

				// save data
				$post = array(
						'label'=>$this->input->post('label')
					);

				$label = $this->input->post('label');

				foreach ($get as $row) {
					if(strtolower($label) == strtolower($row->label)){
						$this->session->set_flashdata('flashNO', 'Label '.$post['label'].' sudah ada');
						redirect('label/get_label');
					}else{

					}
				}

				$insert = $this->model_label->save($post);
				if($insert){
					$this->session->set_flashdata('flashOK', 'label berhasil ditambahkan');
					redirect('label/get_label');
				} else {
					$this->session->set_flashdata('flashNO', 'label gagal ditambahkan');
					redirect('label/get_label');
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Edit_label()
	{
		if($this->session->userdata('pengguna')){
			if($this->uri->segment(3) == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
				$kode = $this->uri->segment(3);
				if($this->model_label->get_id($kode)->num_rows()==0){
					show_404();
				} else {
					$this->form_validation->set_rules('label', 'Label', 'required|trim|xss_clean');

					$this->form_validation->set_message('required', '%s tidak boleh kosong!');
					
					if($this->form_validation->run()==FALSE){
						$data['title'] = 'semua label';
						$data['content'] = 'edit_label';
						if($this->model_label->get_all()->num_rows()==0){
							$data['label_all'] = 'NULL';
						} else {
							$data['label_all'] = $this->model_label->get_all()->result();
						}
						$data['label_id'] = $this->model_label->get_id($kode)->row();
						$this->load->view('admin/index', $data);
					} else {
						// save data
						$kd = $this->input->post('value');
						$post = array(
								'label'=>$this->input->post('label')
							);
						$update = $this->model_label->update($kd,$post);
						if($update){
							$this->session->set_flashdata('flashOK', 'label berhasil diubah');
							redirect('label/edit_label/'.$kd.'/'.$post['label']);
						} else {
							$this->session->set_flashdata('flashNO', 'label gagal diubah');
							redirect('label/edit_label/'.$kd.'/'.$post['label']);
						}
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Del_label()
	{
		if($this->session->userdata('pengguna')){
			if($this->uri->segment(3) == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
				$kode = $this->uri->segment(3);
				if($this->model_label->get_id($kode)->num_rows()==0){
					show_404();
				} else {

					if($this->model_kolom->get_isi('model_label_relation',$kode)->num_rows > 0){

						$this->session->set_flashdata('flashNO', 'label label tidak dapat di hapus karena digunakan pada kolom tema');
						redirect('label/get_label');
						
						
						
					} else {
						$delete = $this->model_label->delete($kode);
						if($delete){
							$this->session->set_flashdata('flashOK', 'label berhasil dihapus');
							redirect('label/get_label');
						} else {
							$this->session->set_flashdata('flashNO', 'label gagal dihapus');
							redirect('label/get_label');
						}
					}
					
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Del_label_rel()
	{
		$kode = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$title = $this->uri->segment(5);
 		$this->model_label_relation->delete_relation($kode,$id);

 		redirect('news/edit_news/'.$id.'/'.$title);
	}


	public function Get_news()
	{
		if($this->uri->segment(3)==""){
			show_404();
		} else {

			$kode = $this->uri->segment(3);
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

	/* template custom sosismahkotadurian.com */
			/*
			 * SHOW LOKASI
			 */
			if($this->model_news->get_limit('10','publish')->num_rows()==0){
				$data['lokasi_all'] = 'NULL';
			} else {
				$data['lokasi_all'] = $this->model_news->get_limit('10','publish')->result();
			}
// pagination
			$this->load->library('pagination');
			$perpage = 10;
			$record = $this->uri->segment(5);
			$count = $this->model_label_relation->get_count_template($kode)->num_rows();
			
		
			$config = array(
				'base_url' => base_url(). 'label/get_news/'.$this->uri->segment(3).'/'.$this->uri->segment(4),
				'total_rows' => $count,
				'per_page' => $perpage,
			);
			
			// style pagination
			$config['uri_segment'] = 5;
			$config['full_tag_open'] = '<div class="halaman">';
			$config['full_tag_close'] = '</div>';
			$config['next_link']  = '<div class="digit prev">Next &rsaquo;</div>';
			$config['prev_link']   = '<div class="digit next">&lsaquo; Prev</div>';
			$config['num_tag_open'] = '<div class="digit digit-all">';
			$config['num_tag_close'] = '</div>';
			$config['cur_tag_open'] = '<div class="digit current">';
			$config['cur_tag_close'] = '</div>';
			$config['num_links'] = 1;
			$config['last_link'] = '<div class="digit next">Last &raquo;</div>';
			$config['first_link'] = '<div class="digit prev">&laquo; First</div>';
			
			$this->pagination->initialize($config);

			if($this->model_label_relation->get_all_template($kode,$perpage,$record)->num_rows()==0){
				$data['semua_lokasi'] = NULL;
			} else {
				$data['semua_lokasi'] = $this->model_label_relation->get_all_template($kode,$perpage,$record)->result();
			}
	/* template custom sosismahkotadurian.com */

			$label = $this->model_label->get_id($kode);
			if($label->num_rows==0){

			} else {
				$label = $this->model_label->get_id($kode)->row();
			}

			$data['title'] = 'Semua '.$label->label;	
			$data['content'] = 'arsip';

			$this->load->view('template/index', $data);
		}
	}
/* template custom sosismahkotadurian.com */

}

/* End of file : label.php */
/* Location : ./application/controllers/label.php */