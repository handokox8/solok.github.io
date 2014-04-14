<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_search');
		
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
		$this->form_validation->set_rules('s', 'pencarian', 'required|trim|xss_clean');
		
		if($this->form_validation->run()==FALSE){
			if($this->uri->segment(3)!=""){
			
		$data['title'] = 'Home';
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
		// pagination
			
		$keyword = $this->uri->segment(3);
		$kode = str_replace("-", " ", $keyword);
		$this->load->library('pagination');
		$perpage =3;
		$record = $this->uri->segment(4);
		if($this->model_search->get_news($kode)->num_rows() > $this->model_search->get_pages($kode)->num_rows()){
			$count = $this->model_search->get_news($kode)->num_rows();
		} else {
			$count = $this->model_search->get_pages($kode)->num_rows();
		}
		$config = array(
			'base_url' => base_url(). 'search/index/'.$kode,
			'total_rows' => $count,
			'per_page' => $perpage,
		);
		
		// style pagination
		$config['uri_segment'] = 4;
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

			// cari data news
			$keyword = $this->input->post('s');
			if($this->model_search->get_news_pagi($kode,$perpage,$record)->num_rows()==0){
				$data['news_all'] = 'NULL';
			} else {
				$data['news_all'] = $this->model_search->get_news_pagi($kode,$perpage,$record)->result();
			}
			// cari data pages
			$keyword = $this->input->post('s');
			if($this->model_search->get_pages_pagi($kode,$perpage,$record)->num_rows()==0){
				$data['pages_all'] = 'NULL';
			} else {
				$data['pages_all'] = $this->model_search->get_pages_pagi($kode,$perpage,$record)->result();
			}
		
		
			
			$data['content'] = 'search';
			$this->load->view('template/index', $data);
			
			} else {
			echo 'gagal';
			}
				
		} else {
		
		$data['title'] = 'Home';
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
		// pagination
			
		$keyword = $this->input->post('s');
		$kode = preg_replace("![^a-z0-9]+!i", "-", $keyword);
		$this->load->library('pagination');
		$perpage =3;
		$record = $this->uri->segment(4);
		if($this->model_search->get_news($keyword)->num_rows() > $this->model_search->get_pages($keyword)->num_rows()){
			$count = $this->model_search->get_news($keyword)->num_rows();
		} else {
			$count = $this->model_search->get_pages($keyword)->num_rows();
		}
	
		$config = array(
			'base_url' => base_url(). 'search/index/'.$kode,
			'total_rows' => $count,
			'per_page' => $perpage,
		);
		
		// style pagination
		$config['uri_segment'] = 4;
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

			// cari data news
			$keyword = $this->input->post('s');
			if($this->model_search->get_news_pagi($keyword,$perpage,$record)->num_rows()==0){
				$data['news_all'] = 'NULL';
			} else {
				$data['news_all'] = $this->model_search->get_news_pagi($keyword,$perpage,$record)->result();
			}
			// cari data pages
			$keyword = $this->input->post('s');
			if($this->model_search->get_pages_pagi($keyword,$perpage,$record)->num_rows()==0){
				$data['pages_all'] = 'NULL';
			} else {
				$data['pages_all'] = $this->model_search->get_pages_pagi($keyword,$perpage,$record)->result();
			}
		
		
			
			$data['content'] = 'search';
			$this->load->view('template/index', $data);
		}
	}
}