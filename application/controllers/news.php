<?php if ( ! defined('BASEPATH')) exit('No direct access script allowed');

class News extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_news');
		$this->load->model('model_label');
		$this->load->model('model_label_relation');

		$this->load->model('model_setting');
		$this->load->model('model_menu_2');
		$this->load->model('model_feature');
		$this->load->model('model_client');
		$this->load->model('model_info');
		$this->load->model('model_sosial');
		$this->load->model('model_link');
		$this->load->model('model_widget');
	}

	public function Index()
	{	
		$kode = $this->uri->segment(3);
		if($this->model_news->get_id($kode,'publish')->num_rows==0){
			show_404();
		}else{
		$cek = $this->model_news->get_id($kode,'publish')->row();
		
		if($cek->status=='privat' && !$this->session->userdata('idFolower')){
			redirect('member/login');
		} else {
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

/* template custom sosismahkotadurian.com */
		/*
		 * SHOW LOKASI
		 */
		if($this->model_news->get_limit('10','publish')->num_rows()==0){
			$data['lokasi_all'] = 'NULL';
		} else {
			$data['lokasi_all'] = $this->model_news->get_limit('10','publish')->result();
		}
/* template custom sosismahkotadurian.com */

		/*
		 * NEWS ID
		 */
		if($this->uri->segment(3) == "" || $this->uri->segment(4) == ""){
			show_404();
		} else {
			if($this->model_news->get_id($this->uri->segment(3),'')->num_rows()==0){
				show_404();
			} else {
				$data['news_id'] = $this->model_news->get_id($this->uri->segment(3),'')->row();
					$data['title'] = $data['news_id']->title;
					$data['description'] = $data['news_id']->deskripsi;
					$data['tanggal'] = $data['news_id']->tanggal;
					$data['keyword'] = $data['news_id']->keyword;
					$data['paragraf'] = $data['news_id']->news;
					
					$data['content'] = 'single';
					$this->load->view('template/index', $data);
			}
			}
		}
			}
	}

	public function All()
	{
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
/* template custom sosismahkotadurian.com */

		// pagination
		$this->load->library('pagination');
		$perpage =1;
		$record = $this->uri->segment(3);
		$count = $this->model_news->get_count_template()->num_rows();
		
	
		$config = array(
			'base_url' => base_url(). 'news/all',
			'total_rows' => $count,
			'per_page' => $perpage,
		);
		
		// style pagination
		$config['uri_segment'] = 3;
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


		/*
		 * ALL NEWS
		 */
		if($this->model_news->get_all_template($perpage,$record)->num_rows()==0){
			$data['news_all'] = 'NULL';
		} else {
			$data['news_all'] = $this->model_news->get_all_template($perpage,$record)->result();
		}

		$data['title'] = 'Semua Konten';
		$data['content'] = 'arsip';
		$this->load->view('template/index', $data);
	}

	public function Get_news($offset = 0)
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'Semua Konten';
			$data['content'] = 'news';

			// pagination
			$this->load->library('pagination');
			$perpage = 10;
			$count = $this->model_news->get_count()->num_rows();
			
		
			$config = array(
				'base_url' => base_url(). 'news/get_news',
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

			if($this->model_news->get_all(array('perpage' => $perpage, 'offset' => $offset))->num_rows()==0){
				$data['news_all'] = 'NULL';
			} else {
				$data['news_all'] = $this->model_news->get_all(array('perpage' => $perpage, 'offset' => $offset))->result();
				$jenis=$data['news_all'];
		        $i=1;
		         foreach ($jenis as $row)  {
		            $data['label'.$i]= $this->model_label_relation->get_id($row->idNews)->result();
		            $i++;
		        }
			}

			/*
			 * Get label
			 */
			if($this->model_label->get_all()->num_rows()==0){
				$data['all_label'] = 'NULL';
			} else {
				$data['all_label'] = $this->model_label->get_all()->result();
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function sort()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('label', 'Label', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				redirect('news/get_news');
			} else {
				$post = $this->input->post('label');

				if($this->model_label_relation->get_by_label($post)->num_rows()==0){
					$data['news_all'] = 'NULL';
				} else {
					$data['news_all'] = $this->model_label_relation->get_by_label($post)->result();
					$jenis=$data['news_all'];
			        $i=1;
			         foreach ($jenis as $row)  {
			            $data['label'.$i]= $this->model_label_relation->get_id($row->idNews)->result();
			            $i++;
			        }
				}

				/*
				 * Get label
				 */
				if($this->model_label->get_all()->num_rows()==0){
					$data['all_label'] = 'NULL';
				} else {
					$data['all_label'] = $this->model_label->get_all()->result();
				}

				$data['title'] = 'Semua Konten';
				$data['content'] = 'news_sort';
				$this->load->view('admin/index', $data);
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Add_news()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Judul Konten', 'required|trim|xss_clean');
			$this->form_validation->set_rules('elm1', 'Konten', 'required|trim');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi Konten', 'trim|xss_clean');
			$this->form_validation->set_rules('keyword', 'Kata Kunci Konten', 'trim|xss_clean');
			// $this->form_validation->set_rules('txtlabel', 'Label', 'trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'tambah konten';
				$data['content'] = 'add_news';

				if($this->model_label->get_all()->num_rows()==0){
					$data['label_all'] = 'NULL';
				} else {
					$data['label_all'] = $this->model_label->get_all()->result();
				}

				$this->load->view('admin/index', $data);
			} else {
				// save data
				//if($this->input->post('txtlabel')==""){
					// txt lable kosong
					/*$label_count = $this->model_label->get_all()->num_rows();
					for ($i=1; $i<=$label_count ; $i++) { 
						echo $anu = $this->input->post('label'.$i);
					}*/

					if($_FILES['tmb']['name']==""){
						// feature image kosong
						if($this->input->post('deskripsi') == ""){
							$deskripsi =  word_limiter(strip_tags($this->input->post('elm1')), 50);
						} else {
							$deskripsi = $this->input->post('deskripsi');
						}
						if($this->input->post('keyword') == ""){
							$keyword = word_limiter(strip_tags(str_replace(" ", ",", $this->input->post('elm1'))), 10);
						} else {
							$keyword = $this->input->post('keyword');
						}
						$postNews = array(
								'tanggal'=>$this->input->post('tahun').'-'.$this->input->post('bulan').'-'.$this->input->post('tanggal'),
								'title'=>$this->input->post('title'),
								'deskripsi'=>$deskripsi,
								'news'=>$this->input->post('elm1'),
								'keyword'=>$keyword,
								'status'=>$this->input->post('status'),
								'jenis'=>$this->input->post('jenis')
							);

						//echo json_encode($postNews);
						$ins_news = $this->model_news->insert($postNews);
						if($ins_news){
							$id = $this->model_news->get_last();
							$jum = $this->input->post('value');
							for ($i=1; $i <= $jum; $i++) { 
								$kd = $this->input->post('label'.$i);
								if(!empty($kd)){
									$post = array(
											'idNews'=>$id,
											'idLabel'=>$kd
										);
									//echo json_encode($post);
									$this->model_label_relation->insert($post);
								}
							}
							$this->session->set_flashdata('flashOK', 'Konten berhasil ditambahkan');
							redirect('news/add_news');
						} else {
							$this->session->set_flashdata('flashNO', 'Konten gagal ditambahkan');
							redirect('news/add_news');
						}
					} else {
						// feature image ada isinya
						$config['upload_path'] = 'assets/uploads/';
						$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
						$config['max_size']	= '1000';
						$config['encrypt_name'] = true;

						$this->load->library('upload', $config);
						if(! $this->upload->do_upload('tmb')){
							// jika gagal
							$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
							redirect('news/add_news');		
						} else {
							$sub_data['result'] = $this->upload->data();
										
							foreach($sub_data['result'] as $item=>$data){
								$items = $sub_data['result']['file_name'];
							}

							$postNews = array(
									'tanggal'=>$this->input->post('tahun').'-'.$this->input->post('bulan').'-'.$this->input->post('tanggal'),
									'title'=>$this->input->post('title'),
									'deskripsi'=>$this->input->post('deskripsi'),
									'news'=>$this->input->post('elm1'),
									'keyword'=>$this->input->post('keyword'),
									'image'=>$items,
									'status'=>$this->input->post('status')
								);

							//echo json_encode($postNews);
							$ins_news = $this->model_news->insert($postNews);
							if($ins_news){
								$id = $this->model_news->get_last();
								$jum = $this->input->post('value');
								for ($i=1; $i <= $jum; $i++) { 
									$kd = $this->input->post('label'.$i);
									if(!empty($kd)){
										$post = array(
												'idNews'=>$id,
												'idLabel'=>$kd
											);
										//echo json_encode($post);
										$this->model_label_relation->insert($post);
									}
								}
								$this->session->set_flashdata('flashOK', 'Konten berhasil ditambahkan');
								redirect('news/add_news');
							} else {
								$this->session->set_flashdata('flashNO', 'Konten gagal ditambahkan');
								redirect('news/add_news');
							}
						}
					}
				// } else {
				// 	// txt label ada isinya
				// 	$postLabel = array(
				// 			'label'=>$this->input->post('txtlabel')
				// 		);
				// 	$checklabel = $this->model_label->get_id_label($this->input->post('txtlabel'))->row();

				// 	if($this->model_label->get_id_label($this->input->post('txtlabel'))->num_rows()==0){
				// 		$ins_label = $this->model_label->save($postLabel);	
				// 	} else {
				// 		$kode = $checklabel->idLabel;
				// 		$up_date = $this->model_label->Update($kode,$postLabel);
				// 	}
				// 	if($ins_label){
				// 		$kd = $this->model_label->get_last();
				// 		if($_FILES['tmb']['name']==""){
				// 			// feature image kosong
				// 			$postNews = array(
				// 					'tanggal'=>$this->input->post('tahun').'-'.$this->input->post('bulan').'-'.$this->input->post('tanggal'),
				// 					'title'=>$this->input->post('title'),
				// 					'deskripsi'=>$this->input->post('deskripsi'),
				// 					'news'=>$this->input->post('elm1'),
				// 					'keyword'=>$this->input->post('keyword'),
				// 					'status'=>$this->input->post('status')
				// 				);

				// 			$ins_news = $this->model_news->insert($postNews);
				// 			if($ins_news){
				// 				$id = $this->model_news->get_last();
				// 				$postLabel = array(
				// 						'idNews'=>$id,
				// 						'idLabel'=>$kd
				// 					);
				// 				$masukkan = $this->model_label_relation->insert($postLabel);
				// 				if($masukkan){
				// 					$this->session->set_flashdata('flashOK', 'Konten berhasil ditambahkan');
				// 					redirect('news/add_news');
				// 				} else {
				// 					$this->session->set_flashdata('flashNO', 'Konten gagal ditambahkan');
				// 					redirect('news/get_news');
				// 				}
				// 			} else {
				// 				$this->session->set_flashdata('flashNO', 'Konten gagal ditambahkan');
				// 				redirect('news/get_news');
				// 			}
				// 		} else {
				// 			// feature image ada isinya
				// 			$config['upload_path'] = 'assets/uploads';
				// 			$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
				// 			$config['max_size']	= '1000';

				// 			$this->load->library('upload', $config);
				// 			if(! $this->upload->do_upload('tmb')){
				// 				// jika gagal
				// 				$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
				// 				redirect('news/add_news');		
				// 			} else {
				// 				$sub_data['result'] = $this->upload->data();
											
				// 				foreach($sub_data['result'] as $item=>$data){
				// 					$items = $sub_data['result']['file_name'];
				// 				}

				// 				$postNews = array(
				// 						'tanggal'=>$this->input->post('tahun').'-'.$this->input->post('bulan').'-'.$this->input->post('tanggal'),
				// 						'title'=>$this->input->post('title'),
				// 						'deskripsi'=>$this->input->post('deskripsi'),
				// 						'news'=>$this->input->post('elm1'),
				// 						'keyword'=>$this->input->post('keyword'),
				// 						'image'=>$items,
				// 						'status'=>$this->input->post('status')
				// 					);

				// 				$ins_news = $this->model_news->insert($postNews);
				// 				if($ins_news){
				// 					$id = $this->model_news->get_last();
				// 					$postLabel = array(
				// 							'idNews'=>$id,
				// 							'idLabel'=>$kd
				// 						);
				// 					$masukkan = $this->model_label_relation->insert($postLabel);
				// 					if($masukkan){
				// 						$this->session->set_flashdata('flashOK', 'Konten berhasil ditambahkan');
				// 						redirect('news/add_news');
				// 					} else {
				// 						$this->session->set_flashdata('flashNO', 'Konten gagal ditambahkan');
				// 						redirect('news/get_news');
				// 					}
				// 				} else {
				// 					$this->session->set_flashdata('flashNO', 'Konten gagal ditambahkan');
				// 					redirect('news/get_news');
				// 				}
				// 			}
				// 		}
				// 	} else {
				// 		echo 'engine label mengalami gangguan';
				// 	}
				// }
			//}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Edit_news()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Judul Konten', 'required|trim|xss_clean');
			$this->form_validation->set_rules('elm1', 'Konten', 'required|trim');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi Konten', 'required|trim|xss_clean');
			$this->form_validation->set_rules('keyword', 'Kata Kunci Beria', 'required|trim|xss_clean');
			// $this->form_validation->set_rules('txtlabel', 'Label', 'trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$kode = $this->uri->segment(3);
				$title = $this->uri->segment(4);
				if($kode == "" || $this->uri->segment(4) == ""){
					show_404();
				} else {
					if($this->model_news->get_id($kode,'')->num_rows()==0){
						show_404();
					} else {
						$data['title'] = 'Ubah Konten';
						$data['content'] = 'edit_news';

						$data['news_id'] = $this->model_news->get_id($kode,'')->row();

						if($this->model_label_relation->get_id($kode)->num_rows()==0){
							$data['label_id'] = 'NULL';
						} else {
							$data['label_id'] = $this->model_label_relation->get_id($kode)->result();
						}

						if($this->model_label_relation->get_idnews($kode)->num_rows()==0){
							$selectid = 0;
							$select = $this->model_label_relation->get_idnews($kode)->result();
							foreach ($select as $row) {
								$selectid[] = $row->idLabel;	
							}
							/*$coba = array('anu','ini','itu' );

							echo json_encode($selectid);
							echo '<br>';
							echo json_encode($coba);*/

							if($this->model_label->get_all_left($selectid)->num_rows()==0){
								$data['label_all'] = 'NULL';
							} else {
								$data['label_all'] = $this->model_label->get_all_left($selectid)->result();
							}

						} else {

							$select = $this->model_label_relation->get_idnews($kode)->result();
							foreach ($select as $row) {
								$selectid[] = $row->idLabel;	
							}
							/*$coba = array('anu','ini','itu' );

							echo json_encode($selectid);
							echo '<br>';
							echo json_encode($coba);*/

							if($this->model_label->get_all_left($selectid)->num_rows()==0){
								$data['label_all'] = 'NULL';
							} else {
								$data['label_all'] = $this->model_label->get_all_left($selectid)->result();
							}
						}
						$this->load->view('admin/index', $data);
					}
				}
			} else {
				// save data

				if($this->input->post('image')){
					$kode = $this->input->post('kdNews');
					$kodeThumb = $this->input->post('tmbOld');
					$kodeTitle = $this->input->post('kdTitle');

					if($_FILES['tmb']['name']==""){
						$this->session->set_flashdata('flashNO', 'tidak ada file gambar dipilih');
						redirect('news/edit_news/'.$kode.'/'.$kodeTitle);
					} else {
						$config['upload_path'] = 'assets/uploads';
						$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
						$config['max_size']	= '1000';
						$config['encrypt_name'] = true;

						$this->load->library('upload', $config);

						if($kodeThumb == ""){
							if(! $this->upload->do_upload('tmb')){
								// jika gagal
								$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
								redirect('news/edit_news/'.$kode.'/'.$title);		
							} else {
								$sub_data['result'] = $this->upload->data();
											
								foreach($sub_data['result'] as $item=>$data){
									$items = $sub_data['result']['file_name'];
								}

								$postNews = array(
										'image'=>$items
									);
								if($this->model_news->update($kode, $postNews)){
									$this->session->set_flashdata('flashOK', 'thumbnail berhasil diubah');
									redirect('news/edit_news/'.$kode.'/'.$kodeTitle);
								} else {
									$this->session->set_flashdata('flashNO', 'terjadi kesalahan');
									redirect('news/edit_news/'.$kode.'/'.$kodeTitle);
								}						
							}
						} else {
							$path = 'assets/uploads/'.$kodeThumb;
							$hapus = unlink($path);
							if($hapus){
								if(! $this->upload->do_upload('tmb')){
									// jika gagal
									$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
									redirect('news/edit_news/'.$kode.'/'.$title);		
								} else {
									$sub_data['result'] = $this->upload->data();
												
									foreach($sub_data['result'] as $item=>$data){
										$items = $sub_data['result']['file_name'];
									}

									$postNews = array(
											'image'=>$items
										);
									if($this->model_news->update($kode, $postNews)){
										$this->session->set_flashdata('flashOK', 'thumbnail berhasil diubah');
										redirect('news/edit_news/'.$kode.'/'.$kodeTitle);
									} else {
										$this->session->set_flashdata('flashNO', 'terjadi kesalahan');
										redirect('news/edit_news/'.$kode.'/'.$kodeTitle);
									}
								}
							} else {
								echo 'gagal hapus file';
							}
						}
					}
				} else {
					/*
					 * save label
					 */
					$kodeNews = $this->input->post('kdNews');
					$kodeTitle = $this->input->post('kdTitle');

					// if($this->input->post('txtlabel') == ""){
						$juml = $this->input->post('jumlah');
						for ($i=1; $i <= $juml; $i++) { 
							$label = $this->input->post('label'.$i);
							if(!empty($label)){
								$postLabel = array(
										'idNews'=>$kodeNews,
										'idLabel'=>$label
									);
								$insert = $this->model_label_relation->insert($postLabel);
							}
						}
					// // } else {
					// 	$post_label = array('label'=>$this->input->post('txtlabel'));
					// 	$ins_label = $this->model_label->save($post_label);
					// 	$kd = $this->model_label->get_last();
					// 	$postLabel = array(
					// 			'idNews'=>$kodeNews,
					// 			'idLabel'=>$kd
					// 		);
					// 	$insert = $this->model_label_relation->insert($postLabel);
					// }
					/*
					 * end save label
					 */

					/*
					 * save POST
					 */
					$postNews = array(
									'tanggal'=>$this->input->post('tahun').'-'.$this->input->post('bulan').'-'.$this->input->post('tanggal'),
									'title'=>$this->input->post('title'),
									'deskripsi'=>$this->input->post('deskripsi'),
									'news'=>$this->input->post('elm1'),
									'keyword'=>$this->input->post('keyword'),
									'status'=>$this->input->post('status'),
									'jenis'=>$this->input->post('jenis')
								);
					if($this->model_news->update($kodeNews, $postNews)){
						$this->session->set_flashdata('flashOK', 'Konten berhasil diubah');
						redirect('news/edit_news/'.$kodeNews.'/'.$kodeTitle);
					} else {
						$this->session->set_flashdata('flashNO', 'Terjadi kegagalan sistem');
						redirect('news/edit_news/'.$kodeNews.'/'.$kodeTitle);
					}
					/*
					 * END SAVE POST
					 */
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	/** Delete permanent **/

	public function Del_news()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			if($kode == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
				if($this->model_news->get_id($kode,'')->num_rows()==0){
					show_404();
				} else {
					$get = $this->model_news->get_id($kode,'')->row();
					if($get->image == ""){
						$hapus = $this->model_news->delete($kode);
						if($hapus){
							$this->model_label_relation->delete_news($kode);
							$this->session->set_flashdata('flashOK', 'Konten berhasil dihapus');
							redirect('news/trash');
						} else {
							$this->session->set_flashdata('flashNO', 'Konten gagal dihapus');
							redirect('news/trash');
						}	
					} else {
						$path = 'assets/uploads/'.$get->image;
						if(unlink($path)){
							$hapus = $this->model_news->delete($kode);
							if($hapus){
								$this->model_label_relation->delete_news($kode);
								$this->session->set_flashdata('flashOK', 'Konten berhasil dihapus');
								redirect('news/trash');
							} else {
								$this->session->set_flashdata('flashNO', 'Konten gagal dihapus');
								redirect('news/trash');
							}
						} else {
							$hapus = $this->model_news->delete($kode);
							if($hapus){
								$this->model_label_relation->delete_news($kode);
								$this->session->set_flashdata('flashOK', 'Konten berhasil dihapus, image gagal dihapus');
								redirect('news/trash');
							} else {
								$this->session->set_flashdata('flashNO', 'Konten gagal dihapus');
								redirect('news/trash');
							}
						}
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	/** Delete to trash **/

	public function trash_news()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			if($kode == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
				if($this->model_news->get_id($kode,'')->num_rows()==0){
					show_404();
				} else {
					$hapus = $this->model_news->update($kode, array('status'=>'deleted'));
					if($hapus){
						$this->session->set_flashdata('flashOK', 'Konten berhasil dipindahkan ke kotak sampah');
						redirect('news/get_news');
					} else {
						$this->session->set_flashdata('flashNO', 'Konten gagal dipindahkan ke kotak sampah');
						redirect('news/get_news');
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function News_search($offset = 0)
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('search', 'kotak pencarian', 'required|min_length[3]|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');
			$this->form_validation->set_message('min_length', '%s minimal 3 karakter!');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'Semua Konten';
				$data['content'] = 'news';

				// pagination
				$this->load->library('pagination');
				$perpage = 10;
				$count = $this->model_news->get_count()->num_rows();
				
			
				$config = array(
					'base_url' => base_url(). 'news/get_news',
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

				if($this->model_news->get_all(array('perpage' => $perpage, 'offset' => $offset))->num_rows()==0){
					$data['news_all'] = 'NULL';
				} else {
					$data['news_all'] = $this->model_news->get_all(array('perpage' => $perpage, 'offset' => $offset))->result();
					$jenis=$data['news_all'];
			        $i=1;
			         foreach ($jenis as $row)  {
			            $data['label'.$i]= $this->model_label_relation->get_id($row->idNews)->result();
			            $i++;
			        }
				}

				/*
				 * Get label
				 */
				if($this->model_label->get_all()->num_rows()==0){
					$data['all_label'] = 'NULL';
				} else {
					$data['all_label'] = $this->model_label->get_all()->result();
				}

				$this->load->view('admin/index', $data);
			} else {
				// save data
				$post = $this->input->post('search');
				
				$data['title'] = 'Semua Konten';
				$data['content'] = 'news_search';

				if($this->model_news->get_like($post,'')->num_rows()==0){
					$data['news_search'] = 'NULL';
				} else {
					$data['news_search'] = $this->model_news->get_like($post,'')->result();
					$jenis=$data['news_search'];
			        $i=1;
			         foreach ($jenis as $row)  {
			            $data['label'.$i]= $this->model_label_relation->get_id($row->idNews)->result();
			            $i++;
			        }
				}

				/*
				 * Get label
				 */
				if($this->model_label->get_all()->num_rows()==0){
					$data['all_label'] = 'NULL';
				} else {
					$data['all_label'] = $this->model_label->get_all()->result();
				}

				$this->load->view('admin/index', $data);
			}
		} else {
			redirect('ngadmin/');
		}
	}


	/* kotak sampah Konten */
	public function Trash()
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'Kotak sampah';
			$data['content'] = 'trash';

			if($this->model_news->get_trash()->num_rows()==0){
				$data['news_all'] = 'NULL';
			} else {
				$data['news_all'] = $this->model_news->get_trash()->result();
				$jenis=$data['news_all'];
		        $i=1;
		         foreach ($jenis as $row)  {
		            $data['label'.$i]= $this->model_label_relation->get_id($row->idNews)->result();
		            $i++;
		        }
			}

			/*
			 * Get label
			 */
			if($this->model_label->get_all()->num_rows()==0){
				$data['all_label'] = 'NULL';
			} else {
				$data['all_label'] = $this->model_label->get_all()->result();
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	/* sort publish or draft */
	public function Sort_status()
	{
		if($this->session->userdata('pengguna')){
			$kode = strtolower($this->uri->segment(3));
			if($kode == ""){
				show_404();
			} else {
				if($this->model_news->get_status($kode)->num_rows()==0){
					$data['news_all'] = 'NULL';
				} else {
					$data['news_all'] = $this->model_news->get_status($kode)->result();
					$jenis=$data['news_all'];
			        $i=1;
			         foreach ($jenis as $row)  {
			            $data['label'.$i]= $this->model_label_relation->get_id($row->idNews)->result();
			            $i++;
			        }
				}

				/*
				 * Get label
				 */
				if($this->model_label->get_all()->num_rows()==0){
					$data['all_label'] = 'NULL';
				} else {
					$data['all_label'] = $this->model_label->get_all()->result();
				}

				$data['title'] = 'Semua Konten';
				$data['content'] = 'news_status';
				$this->load->view('admin/index', $data);
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Update()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			if($kode == "" || $this->uri->segment(4) == "" || $this->uri->segment(5) == ""){
				show_404();
			} else {
				if($this->model_news->get_id($kode,'')->num_rows()==0){
					show_404();
				} else {
					$update = $this->model_news->update($kode, array('status'=>$this->uri->segment(5)));
					if($update){
						$this->session->set_flashdata('flashOK', 'Konten berhasil di ubah ke '.$this->uri->segment(5));
						redirect('news/get_news');
					} else {
						$this->session->set_flashdata('flashNO', 'Konten gagal di ubah ke '.$this->uri->segment(5));
						redirect('news/get_news');
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}
}

/* End of file : news.php */
/* Location : ./application/controllers/news.php */