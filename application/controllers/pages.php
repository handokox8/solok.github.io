<?php if ( ! defined('BASEPATH')) exit('No script direct access allowed');

class Pages extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_setting');
		$this->load->model('model_menu_2');
		$this->load->model('model_feature');
		$this->load->model('model_news');
		$this->load->model('model_client');
		$this->load->model('model_info');
		$this->load->model('model_sosial');
		$this->load->model('model_link');
		$this->load->model('model_widget');

		$this->load->model('model_pages');

		$this->load->model('model_label');
		$this->load->model('model_label_relation');
	}

	public function Index()
	{
		$kode = $this->uri->segment(3);
		$cek = $this->model_pages->get_id($kode)->row();
		if($kode == "" || $this->uri->segment(4) == ""){
			show_404();
		} 
			
		else if($cek->status=='privat' && !$this->session->userdata('idFolower')){
			redirect('member/login');
		}
		else {
			if($this->model_pages->get_id($kode)->num_rows()==0){
				show_404();
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
				 * PAGES ID
				 */
				$data['pages_id'] = $this->model_pages->get_id($kode)->row();
					$data['title'] = $data['pages_id']->title;
					$data['keyword'] = $data['pages_id']->keyword;
					$data['description'] = $data['pages_id']->deskripsi;
					$data['paragraf'] = $data['pages_id']->post;

				$data['content'] = 'single';
				$this->load->view('template/index', $data);
			}
		}
	}
}

/* End of file : pages.php */
/* Location : ./application/controllers/pages.php */