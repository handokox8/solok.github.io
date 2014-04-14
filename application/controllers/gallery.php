<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_gallery');

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

		$this->load->model('model_label_relation');
	}

/***************************************************************************
 * TEMPLATE SYSTEM
 **************************************************************************/
	/*** display photo album ***/
	public function Photos()
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

		/*
		 * Galery
		 */
		$kode = $this->uri->segment(3);
		if($this->model_gallery->get_per_album($kode)->num_rows()==0){
			$data['gallery_all'] = 'NULL';
			$data['title'] = 'Galeri';
		} else {
			$data['gallery_all'] = $this->model_gallery->get_per_album($kode)->result();
			$get['album'] = $this->model_gallery->get_album_id($kode)->row();
			$data['title'] = 'Galeri '.$get['album']->title;
		}

		$data['content'] = 'gallery';

		$this->load->view('template/index', $data);
	}
	/*** display photo album ***/
/***************************************************************************
 * END TEMPLATE SYSTEM
 **************************************************************************/

/***************************************************************************
 * ADMIN PANEL
 **************************************************************************/
	public function Index()
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'semua Galery';
			$data['content'] = 'galery';

			// if($this->model_galery->get_all()->num_rows()==0){
			// 	$data['galery_all'] = 'NULL';
			// } else {
			// 	$data['galery_all'] = $this->model_galery->get_all()->result();
			// }

			if($this->model_gallery->get_album()->num_rows()==0){
				$data['album_all'] = 'NULL';
			} else {
				$data['album_all'] = $this->model_gallery->get_album_image()->result();
				
				//$data['album_image'] = $this->model_gallery->get_image_limit($row->idAlbum,1)->result();
				// $jenis = $data['album_all'];
				// $i=1;
				// foreach ($jenis as $row) {
				// 	$data['album_image'.$i] = $this->model_gallery->get_image_limit($row->idAlbum,1)->result();
				// $i++;
				// }
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function Add_gallery()
	{
		$this->form_validation->set_rules('title', 'Judul Galeri', 'required|trim|xss_clean');

		if($this->form_validation->run()==FALSE){
			$data['title'] = 'Tambah Album';
			$data['content'] = 'add_gallery';

			$this->load->view('admin/index', $data);
		} else {
			//save data
			//echo $this->input->post('title');
			$post1 = array(
					'title'=>$this->input->post('title')
				);
			$this->model_gallery->insert_album($post1);

			$last_prod = $this->model_gallery->last_album();

			// insert galeri
			$config['upload_path'] = 'assets/gambar/galery/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
			$config['max_size']	= '2000';
			$config['encrypt_name'] = true;
			

			for($g=0;$g<=10;$g++){
				$this->load->library('upload', $config);
				$unggah = $this->upload->do_upload('image'.$g);
				if($unggah === FALSE) continue;
				$image_data = $this->upload->data();
				$image_file = $image_data['file_name'];

				$post3 = array(
						'idAlbum'=>$last_prod,
						'file'=>$image_file,
						'deskripsi'=>$this->input->post('alt'.$g)
					);
				//echo json_encode($post3);
				//echo "<br>";
				$this->model_gallery->insert_image($post3);
				
			}

			$this->session->set_flashdata('flashOK', 'galeri berhasil ditambahkan');
			redirect('gallery/');
		}
	}

	public function Edit_album()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);

			if($this->uri->segment(3) == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
				if($this->model_gallery->get_album_id($kode)->num_rows()==0){
					show_404();
				} else {
					$data['album_id'] = $this->model_gallery->get_album_id($kode)->row();
						$data['image_all'] = $this->model_gallery->get_image($kode)->result();

					$data['title'] = 'Perubahan Album '.$data['album_id']->title;
					$data['content'] = 'edit_gallery';

					$this->load->view('admin/index', $data);
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Add_image()
	{
		if($this->session->userdata('pengguna')){
			// insert galeri
			$config['upload_path'] = 'assets/gambar/galery/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
			$config['max_size']	= '2000';
			$config['encrypt_name'] = true;
			

			for($g=0;$g<=10;$g++){
				$this->load->library('upload', $config);
				$unggah = $this->upload->do_upload('image'.$g);
				if($unggah === FALSE) continue;
				$image_data = $this->upload->data();
				$image_file = $image_data['file_name'];

				$post3 = array(
						'idAlbum'=>$this->input->post('kdAlbum'),
						'file'=>$image_file,
						'deskripsi'=>$this->input->post('alt'.$g)
					);
				//echo json_encode($post3);
				//echo "<br>";
				$this->model_gallery->insert_image($post3);
			}

			$this->session->set_flashdata('flashOK', 'berhasil menambahkan gambar');
			redirect($this->input->post('kdUrl'));
		} else {
			redirect('ngadmin/');
		}
	}

	public function Edit_image()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('alt', 'Deskripsi', 'required|trim|xss_clean');
			$this->form_validation->set_rules('kdUrl', 'Kodel URL', 'required|trim|xss_clean');
			$this->form_validation->set_rules('kdImage', 'Kode Image', 'required|trim|xss_clean');

			if($this->form_validation->run()==FALSE){
				redirect($this->input->post('kdUrl'));
			} else {
				// save data update image
				$kode = $this->input->post('kdImage');
				$post = array(
						'deskripsi'=>$this->input->post('alt')
					);

				if($this->model_gallery->update_image($kode,$post)){
					$this->session->set_flashdata('flashOK', 'berhasil malakukan perubahan data gambar');
					redirect($this->input->post('kdUrl'));
				} else {
					$this->session->set_flashdata('flashNO', 'gagal melakukan perubahan data gambar');
					redirect($this->input->post('kdUrl'));
				}

			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Del_image()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('kdUrl', 'Kodel URL', 'required|trim|xss_clean');
			$this->form_validation->set_rules('kdImage', 'Kode Image', 'required|trim|xss_clean');

			if($this->form_validation->run()==FALSE){
				show_404();
			} else {
				$kode = $this->input->post('kdImage');
				if($this->model_gallery->get_image_id($kode)->num_rows()==0){
					show_404();
				} else {
					$get['image'] = $this->model_gallery->get_image_id($kode)->row();
					$path = 'assets/gambar/galery/'.$get['image']->file;
					if(unlink($path)){
						if($this->model_gallery->delete_image($kode)){
							$this->session->set_flashdata('flashOK', 'berhasil menghapus gambar');
							redirect($this->input->post('kdUrl'));
						} else {
							$this->session->set_flashdata('flashNO', 'engine database error');
							redirect($this->input->post('kdUrl'));
						}
					} else {
						if($this->model_gallery->delete_image($kode)){
							$this->session->set_flashdata('flashOK', 'engine server error, data sudah dihapus');
							redirect($this->input->post('kdUrl'));
						} else {
							$this->session->set_flashdata('flashNO', 'engine server and engine database error');
							redirect($this->input->post('kdUrl'));
						}
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Del_album()
	{
		if($this->session->userdata('pengguna')){
			if($this->uri->segment(3) == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
				$kode = $this->uri->segment(3);
				if($this->model_gallery->get_album_id($kode)->num_rows()==0){
					show_404();
				} else {
					$get['image'] = $this->model_gallery->get_image($kode)->result();
					$jenis = $get['image'];

					foreach ($jenis as $image) {
						$path = 'assets/gambar/galery/'.$image->file;
						if(unlink($path) === FALSE) continue;
						$this->model_gallery->delete_image($image->idImage);
					}
					$this->model_gallery->delete_album($kode);
					$this->session->set_flashdata('flashOK', 'berhasil menghapus album');
					redirect('gallery/');
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}


/***************************************************************************
 * END ADMIN PANEL
 **************************************************************************/
}

/* End of file : galery.php */
/* Location : ./application/controllers/galery.php */