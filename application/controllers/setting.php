<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_setting');
		$this->load->model('model_link');
	}

	public function Logo()
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'Pengaturan Logo';
			$data['content'] = 'logo';
			$data['setting_id'] = $this->model_setting->get_id()->row();
			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function Save_logo()
	{
		if($this->session->userdata('pengguna')){
			if($_FILES['userfile']['name'] == ""){
				$this->session->set_flashdata('flashNO', 'Tidak ada file yang dipilih');
				redirect('setting/logo');
			} else {
				$config['upload_path'] = 'assets/gambar/logo/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
				$config['max_size']	= '1000';
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

				// cek upload file
				if(! $this->upload->do_upload()){
					// jika gagal
					$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
					redirect('setting/logo');	
				} else {
					// jika berhasil
					$sub_data['result'] = $this->upload->data();
					
					foreach($sub_data['result'] as $item=>$data){
						$items = $sub_data['result']['file_name'];
					}
					$get['setting'] = $this->model_setting->get_id()->row();
					$path = 'assets/gambar/logo/'.$get['setting']->logoFile;
					$delete = unlink($path);
					if($delete){
						$post = array(
								'logo'=>'assets/gambar/logo/'.$items,
								'logoFile'=>$items
							);
						$update = $this->model_setting->Update($post);
						if($update){
							$this->session->set_flashdata('flashOK', 'perubahan logo berhasil');
							redirect('setting/logo');
						} else {
							$this->session->set_flashdata('flashNO', 'perubahan logo gagal');
							redirect('setting/logo');
						}
					} else {
						$this->session->set_flashdata('flashNO', 'gagal melakukan penghapusan file logo');
						redirect('setting/logo');
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Banner()
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'banner';
			$data['content'] = 'banner';
			$data['setting_id'] = $this->model_setting->get_id()->row();
			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function Save_banner()
	{
		if($this->session->userdata('pengguna')){
			if($_FILES['userfile']['name']==""){
				$post = array(
						'titleBanner'=>$this->input->post('title'),
						'linkBanner'=>$this->input->post('url')
					);

				$update = $this->model_setting->Update($post);
				if($update){
					$this->session->set_flashdata('flashOK', 'perubahan banner berhasil');
					redirect('setting/banner');
				} else {
					$this->session->set_flashdata('flashNO', 'perubahan banner gagal');
					redirect('setting/banner');
				}
			} else {
				$set['setting'] = $this->model_setting->get_id()->row();
				if($set['setting']->banner == ""){
					$config['upload_path'] = 'assets/gambar/logo/';
					$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
					$config['max_size']	= '1000';
					$config['encrypt_name'] = true;

					$this->load->library('upload', $config);

					// cek upload file
					if(! $this->upload->do_upload()){
						// jika gagal
						$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
						redirect('setting/banner');	
					} else {
						// jika berhasil
						$sub_data['result'] = $this->upload->data();
						
						foreach($sub_data['result'] as $item=>$data){
							$items = $sub_data['result']['file_name'];
						}

						$post = array(
								'titleBanner'=>$this->input->post('title'),
								'linkBanner'=>$this->input->post('url'),
								'banner'=>'assets/gambar/logo/'.$items,
								'bannerFile'=>$items
							);

						$update = $this->model_setting->Update($post);
						if($update){
							$this->session->set_flashdata('flashOK', 'perubahan banner berhasil');
							redirect('setting/banner');
						} else {
							$this->session->set_flashdata('flashNO', 'perubahan banner gagal');
							redirect('setting/banner');
						}
					}
				} else {
					$config['upload_path'] = 'assets/gambar/logo/';
					$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
					$config['max_size']	= '1000';
					$config['encrypt_name'] = true;

					$this->load->library('upload', $config);

					// cek upload file
					if(! $this->upload->do_upload()){
						// jika gagal
						$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
						redirect('setting/banner');	
					} else {
						// jika berhasil
						$sub_data['result'] = $this->upload->data();
						
						foreach($sub_data['result'] as $item=>$data){
							$items = $sub_data['result']['file_name'];
						}
						$get['setting'] = $this->model_setting->get_id()->row();
						$path = 'assets/gambar/logo/'.$get['setting']->bannerFile;
						$delete = unlink($path);
						if($delete){
							$post = array(
									'titleBanner'=>$this->input->post('title'),
									'linkBanner'=>$this->input->post('url'),
									'banner'=>'assets/gambar/logo/'.$items,
									'bannerFile'=>$items
								);
							$update = $this->model_setting->Update($post);
							if($update){
								$this->session->set_flashdata('flashOK', 'perubahan banner berhasil');
								redirect('setting/banner');
							} else {
								$this->session->set_flashdata('flashNO', 'perubahan banner gagal');
								redirect('setting/banner');
							}
						} else {
							$this->session->set_flashdata('flashNO', 'gagal melakukan penghapusan file banner');
							redirect('setting/banner');
						}
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Footer()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('footer', 'Isi Footer', 'required|trim');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'Pengaturan Footer';
				$data['content'] = 'edit_footer';
				$data['setting_id'] = $this->model_setting->get_id()->row();
				$this->load->view('admin/index', $data);
			} else {
				// save data
				$post = array(
						'footer'=>$this->input->post('footer')
					);
				$update = $this->model_setting->update($post);
				if($update){
					$this->session->set_flashdata('flashOK', 'footer berhasil diperbaharui');
					redirect('setting/footer');
				} else {
					$this->session->set_flashdata('flashNO', 'footer gagal diperbaharui');
					redirect('setting/footer');
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Link()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Nama Link', 'required|trim|xss_clean');
			$this->form_validation->set_rules('link', 'URL', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'Pengaturan Link';
				$data['content'] = 'add_link';

				if($this->model_link->get_all()->num_rows()==0){
					$data['link_all'] = 'NULL';
				} else {
					$data['link_all'] = $this->model_link->get_all()->result();
				}

				$this->load->view('admin/index', $data);
			} else {
				// save data
				$post = array(
						'title'=>$this->input->post('title'),
						'url'=>$this->input->post('link')
					);
				$insert = $this->model_link->insert($post);
				if($insert){
					$this->session->set_flashdata('flashOK', 'link berhasil ditambahkan');
					redirect('setting/link');
				} else {
					$this->session->set_flashdata('flashNO', 'link gagal ditambahkan');
					redirect('setting/link');
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Edit_link()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Nama Link', 'required|trim|xss_clean');
			$this->form_validation->set_rules('link', 'URL', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$kode = $this->uri->segment(3);
				if($kode == "" || $this->uri->segment(4) == ""){
					show_404();
				} else {
					if($this->model_link->get_id($kode)->num_rows()==0){
						show_404();
					} else {
						$data['title'] = 'ubah link';
						$data['content'] = 'edit_link';
						$data['link_id'] = $this->model_link->get_id($kode)->row();

						if($this->model_link->get_all()->num_rows()==0){
							$data['link_all'] = 'NULL';
						} else {
							$data['link_all'] = $this->model_link->get_all()->result();
						}

						$this->load->view('admin/index', $data);
					}
				}
			} else {
				// save data
				$kode = $this->input->post('kdLink');
				$post = array(
						'title'=>$this->input->post('title'),
						'url'=>$this->input->post('link')
					);
				$ubah = $this->model_link->update($kode,$post);
				if($ubah){
					$this->session->set_flashdata('flashOK', 'link berhasil diubah');
					redirect('setting/edit_link/'.$kode.'/'.$post['title']);
				} else {
					$this->session->set_flashdata('flashNO', 'link gagal diubah');
					redirect('setting/edit_link/'.$kode.'/'.$post['title']);
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Del_link()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			if($kode == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
				if($this->model_link->get_id($kode)->num_rows()==0){
					show_404();
				} else {
					if($this->model_link->delete($kode)){
						$this->session->set_flashdata('flashOK', 'Tautan Berhasil dihapus');
						redirect('setting/link');
					} else {
						$this->session->set_flashdata('flashNO', 'Tautan gagal dihapus');
						redirect('setting/link');
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}
}

/* End of file : setting.php */
/* Location : ./application/controllers/setting.php */