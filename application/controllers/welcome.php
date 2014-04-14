<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

		$this->load->model('model_slider');
		$this->load->model('model_kolom');

		$this->load->model('model_pages');

		$this->load->model('model_label');
		$this->load->model('model_label_relation');
	}

	public function index()
	{
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

/* template custom sosismahkotadurian.com */
		/*
		 * SHOW LOKASI
		 */
		if($this->model_label_relation->get_label_limit('1','4')->num_rows()==0){
			$data['lokasi_all'] = 'NULL';
		} else {
			$data['lokasi_all'] = $this->model_label_relation->get_label_limit('1','4')->result();
		}
/* template custom sosismahkotadurian.com */
		
		/*
		 * DYNAMIC CONTENT
		 */

		

		$jum =3;
		for($i=1;$i<=$jum;$i++){
			${'kolom'.$i} = $this->model_kolom->Get_id($i)->row();
			${'namaModel'.$i} = ${'kolom'.$i}->jenisKolom;
			${'jlmlimit'.$i} = ${'kolom'.$i}->jumlahLimit;
			${'isiKolom1'.$i} = ${'kolom'.$i}->isiKolom;	

			$data['namaModel'.$i] = ${'kolom'.$i}->jenisKolom;
			$data['isianKolom'.$i] = ${'kolom'.$i}->isiKolom;

			$data['getkolom'.$i] = $this->${'namaModel'.$i}->get_dinamic(${'isiKolom1'.$i},${'jlmlimit'.$i});

			$data['judulKolom'.$i] = ${'kolom'.$i}->judulKolom;
			$data['Djudul'.$i] = ${'kolom'.$i}->namaJudul;
			$data['Ddeskripsi'.$i] = ${'kolom'.$i}->namaDeskripsi;
			$data['Dthumb'.$i] = ${'kolom'.$i}->namaThumb;
		}

        
		$this->load->view('template/home', $data);
	}

	public function Sitemap()
	{
		/*
		 * INFORMASI SEO
		 */
		$data['info'] = $this->model_info->get_id('1')->row();
			$data['keyword'] = 'sitemap,bprs,hik,keuangan,tabungan';
			$data['author'] = $data['info']->title;
			$data['description'] = 'sitemap website '.$data['author'];
		/*
		 * SETTING WEBSITE
		 */
		$data['setting'] = $this->model_setting->get_id()->row();

		/*
		 * MENU
		 */
		$data['parent']= $this->model_menu->get_parent()->result();
        $jenis=$data['parent'];
        $i=1;
         foreach ($jenis as $row)  {
            $data['child'.$i]= $this->model_menu->get_child($row->idMenus)->result();
            $i++;
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
        if($this->model_news->get_limit('','')->num_rows()==0){
        	$data['news'] = 'NULL';
        } else {
        	$data['news'] = $this->model_news->get_limit('','')->result();
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
		 * Konten FOR SITEMAP
		 */
		$data['all_label']= $this->model_label->get_all()->result();
        $jenis=$data['all_label'];
        $i=1;
         foreach ($jenis as $row)  {
            $data['child_label'.$i] = $this->model_label_relation->get_parent($row->idLabel)->result();
        $i++;
        }

        /*
		 * PAGES
		 */
        if($this->model_pages->get_all()->num_rows()==0){
			$data['pages_all'] = 'NULL';
		} else {
			$data['pages_all'] = $this->model_pages->get_all()->result();
		}



        $data['title'] = 'sitemap';
        $data['content'] = 'sitemap';
        $this->load->view('template/index',$data);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */