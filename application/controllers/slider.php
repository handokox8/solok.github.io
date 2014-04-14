<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_slider');
	}

/***************************************************************************
 * ADMIN PANEL
 **************************************************************************/
	public function Index()
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'tambah slider';
			$data['content'] = 'slider';
			if($this->model_slider->get_all()->num_rows()==0){
				$data['slider_all'] = "NULL";
			} else {
				$data['slider_all'] = $this->model_slider->get_all()->result();
			}
			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function Add_slider()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Title Slider', 'required|trim|xss_clean|encode_php_tags|strip_tags');
			$this->form_validation->set_rules('url', 'URL', 'trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'tambah slider';
				$data['content'] = 'slider';
				if($this->model_slider->get_all()->num_rows()==0){
					$data['slider_all'] = "NULL";
				} else {
					$data['slider_all'] = $this->model_slider->get_all()->result();
				}
				$this->load->view('admin/index', $data);
			} else {
				// save data
				if($this->model_slider->get_all()->num_rows()>=5){
					$this->session->set_flashdata('flashNO', 'Jumlah slider sudah melebihi kapasitas. Max. 5 slider !!!');
					redirect('slider/');
				} else {
					$config['upload_path'] = 'assets/gambar/slider/';
					$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
					$config['max_size']	= '1000';
					$config['encrypt_name'] = true;

					$this->load->library('upload', $config);
					if(! $this->upload->do_upload()){
						$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
						redirect ('slider/');
					} else {
						$sub_data['result'] = $this->upload->data();
						
						foreach($sub_data['result'] as $item=>$data){
							$items = $sub_data['result']['file_name'];
						}

						$post = array(
								'filename'=>$items,
								'alt'=>$this->input->post('title'),
								'url'=>$this->input->post('url')
							);
						$insert = $this->model_slider->add_slider($post);
						if($insert){
							$this->session->set_flashdata('flashOK', 'Data berhasil ditambahkan');
							redirect('slider/');
						} else {
							$this->session->set_flashdata('flashNO', 'data gagal ditambahkan');
							redirect('slider/');
						}
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Edit_slider()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			if($this->uri->segment(3) == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
				if($this->model_slider->get_id($kode)->num_rows()==0){
					show_404();
				} else {
					$data['title'] = 'Ubah Slider';
					$data['slider_id'] = $this->model_slider->get_id($kode)->row();
					$data['content'] = 'edit_slider';
					$this->load->view('admin/index', $data);
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Simpan_Ubah()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Altrenatif Text', 'required|trim|xss_clean|encode_php_tags|strip_tags');
			$this->form_validation->set_rules('url', 'URL', 'trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				show_404();
			} else {
				if($_FILES['userfile']['name'] == ""){
					// save no image
					$kode = $this->input->post('value');
					$post = array(
							'alt'=>$this->input->post('title'),
							'url'=>$this->input->post('url')
						);
					$update = $this->model_slider->update($kode,$post);
					if($update){
						$get['slider_id'] = $this->model_slider->get_id($kode)->row();
						$this->session->set_flashdata('flashOK', 'Data berhasil diubah');
						redirect('slider/edit_slider/'.$kode.'/'.$get['slider_id']->filename);
					} else {
						$this->session->set_flashdata('flashNO', 'Data gagal diubah');
						$data['title'] = 'Ubah Slider';
						$data['slider_id'] = $this->model_slider->get_id($kode)->row();
						$data['content'] = 'edit_slider';
						$this->load->view('admin/index', $data);
					}
				} else {
					// save images
					$config['upload_path'] = 'assets/gambar/slider/';
					$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
					$config['max_size']	= '1000';
					$config['encrypt_name'] = true;

					$this->load->library('upload', $config);
					if(! $this->upload->do_upload()){
						$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
						redirect ('slider/add_slider');
					} else {
						$sub_data['result'] = $this->upload->data();
						
						foreach($sub_data['result'] as $item=>$data){
							$items = $sub_data['result']['file_name'];
						}

						$kode = $this->input->post('value');
						$post = array(
								'filename'=>$items,
								'alt'=>$this->input->post('title'),
								'url'=>$this->input->post('url')
							);

						$get['slider_id'] = $this->model_slider->get_id($kode)->row();
						$path = 'assets/gambar/slider/'.$get['slider_id']->filename;

						if(file_exists($path)){
							unlink($path);

							$update = $this->model_slider->update($kode,$post);
							if($update){
								$this->session->set_flashdata('flashOK', 'Data berhasil diubah');
								redirect('slider/edit_slider/'.$kode.'/'.$get['slider_id']->filename);
							} else {
								$this->session->set_flashdata('flashNO', 'Data gagal diubah');
								redirect('slider/edit_slider/'.$kode.'/'.$get['slider_id']->filename);
							}
						} else {
							$update = $this->model_slider->update($kode,$post);
							if($update){
								$this->session->set_flashdata('flashOK', 'Data berhasil diubah');
								redirect('slider/edit_slider/'.$kode.'/'.$get['slider_id']->filename);
							} else {
								$this->session->set_flashdata('flashNO', 'Data gagal diubah');
								redirect('slider/edit_slider/'.$kode.'/'.$get['slider_id']->filename);
							}
						}
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Del_slider()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			if($this->uri->segment(3) == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
				if($this->model_slider->get_id($kode)->num_rows()==0){
					show_404();
				} else {
					$slider['slider_id'] = $this->model_slider->get_id($kode)->row();
					$path = 'assets/gambar/slider/'.$slider['slider_id']->filename;

					if(file_exists($path)){
						unlink($path);

						$delete = $this->model_slider->delete($kode);
						if($delete){
							$this->session->set_flashdata('flashOK', 'Data berhasil dihapus');
							redirect('slider/');
						} else {
							$this->session->set_flashdata('flashNO', 'data gagal dihapus');
							redirect('slider/');
						}
					} else {
						$delete = $this->model_slider->delete($kode);
						if($delete){
							$this->session->set_flashdata('flashOK', 'Data berhasil dihapus');
							redirect('slider/');
						} else {
							$this->session->set_flashdata('flashNO', 'data gagal dihapus');
							redirect('slider/');
						}
					}
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

/* End of file : slider.php */
/* Location : ./application/controllers/slider.php */