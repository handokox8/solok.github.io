<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feature extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_feature');
	}

	public function Index()
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'Feature';
			if($this->model_feature->get_all()->num_rows()==0){
				$data['feature'] = 'NULL';
			} else {
				$data['feature'] = $this->model_feature->get_all()->result();
			}
			$data['content'] = 'feature';
			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function Add_feature()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('url', 'URL', 'required|trim|xss_clean');
			$this->form_validation->set_rules('title', 'Title feature', 'required|trim|xss_clean');
			$this->form_validation->set_rules('deskripsi', 'deskripsi feature', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'Feature';
				if($this->model_feature->get_all()->num_rows()==0){
					$data['feature'] = 'NULL';
				} else {
					$data['feature'] = $this->model_feature->get_all()->result();
				}
				$data['content'] = 'feature';
				$this->load->view('admin/index', $data);
			} else {
				// save data
				if($_FILES['ikon']['name'] == ""){
					$post = array(
						'title'=>$this->input->post('title'),
						'deskripsi'=>$this->input->post('deskripsi'),
						'link'=>$this->input->post('url')
					);

					$insert = $this->model_feature->insert($post);
					if($insert){
						$this->session->set_flashdata('flashOK', 'feature berhasil ditambahkan');
						redirect('feature/');
					} else {
						$this->session->set_flashdata('flashNO', 'feature gagal ditambahkan');
						redirect('feature/');
					}
				} else {
					$config['upload_path'] = 'assets/gambar/feature/';
					$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
					$config['max_size']	= '1000';
					$config['encrypt_name'] = true;

					$this->load->library('upload', $config);
					if(! $this->upload->do_upload('ikon')){
						// jika gagal
						$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
						redirect('feature/');		
					} else {
						$sub_data['result'] = $this->upload->data();
									
						foreach($sub_data['result'] as $item=>$data){
							$items = $sub_data['result']['file_name'];
						}

						$post = array(
								'title'=>$this->input->post('title'),
								'deskripsi'=>$this->input->post('deskripsi'),
								'icon'=>$items,
								'link'=>$this->input->post('url')
							);
						$insert = $this->model_feature->insert($post);
						if($insert){
							$this->session->set_flashdata('flashOK', 'feature berhasil ditambahkan');
							redirect('feature/');
						} else {
							$this->session->set_flashdata('flashNO', 'feature gagal ditambahkan');
							redirect('feature/');
						}
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Edit_feature()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			if($kode == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
				$this->form_validation->set_rules('url', 'URL', 'required|trim|xss_clean');
				$this->form_validation->set_rules('title', 'Title feature', 'required|trim|xss_clean');
				$this->form_validation->set_rules('deskripsi', 'deskripsi feature', 'required|trim|xss_clean');

				$this->form_validation->set_message('required', '%s tidak boleh dikosongkan');

				if($this->form_validation->run()==FALSE){
					$data['title'] = 'ubah feature';
					$data['content'] = 'edit_feature';
					if($this->model_feature->get_id($kode)->num_rows()==0){
						show_404();
					} else {
						$data['feature_id'] = $this->model_feature->get_id($kode)->row();
					}
					$this->load->view('admin/index', $data);
				} else {
					// save data
					$get['feature_id'] = $this->model_feature->get_id($kode)->row();
					if($get['feature_id']->icon == ""){
						// icon in database empty
						if($_FILES['ikon']['name'] == ""){
							// icon in form empty
							$post = array(
									'title'=>$this->input->post('title'),
									'deskripsi'=>$this->input->post('deskripsi'),
									'link'=>$this->input->post('url')
								);
							$update = $this->model_feature->update($kode,$post);
							$this->session->set_flashdata('flashOK', 'feature berhasil diubah');
							redirect('feature/edit_feature/'.$kode.'/'.$post['title']);
						} else {
							// icon in form not empty
							$config['upload_path'] = 'assets/gambar/feature/';
							$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
							$config['max_size']	= '1000';
							$config['encrypt_name'] = true;


							$this->load->library('upload', $config);
							if(! $this->upload->do_upload('ikon')){
								// jika gagal
								$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
								redirect('feature/edit_feature/'.$kode.'/'.$get['feature_id']->title);	
							} else {
								// jika berhasil
								$sub_data['result'] = $this->upload->data();
								
								foreach($sub_data['result'] as $item=>$data){
									$items = $sub_data['result']['file_name'];
								}

								$post = array(
										'title'=>$this->input->post('title'),
										'deskripsi'=>$this->input->post('deskripsi'),
										'icon'=>$items,
										'link'=>$this->input->post('url')
									);
								$update = $this->model_feature->update($kode,$post);
								$this->session->set_flashdata('flashOK', 'feature berhasil diubah');
								redirect('feature/edit_feature/'.$kode.'/'.$post['title']);
							}
						}
					} else {
						// icon in database not empty
						if($_FILES['ikon']['name'] == ""){
							// icon in form empty
							$post = array(
									'title'=>$this->input->post('title'),
									'deskripsi'=>$this->input->post('deskripsi'),
									'link'=>$this->input->post('url')
								);
							$update = $this->model_feature->update($kode,$post);
							$this->session->set_flashdata('flashOK', 'feature berhasil diubah');
							redirect('feature/edit_feature/'.$kode.'/'.$post['title']);
						} else {
							// icon in form not empty
							$path = 'assets/gambar/feature/'.$get['feature_id']->icon;
							
							if(file_exists($path)){
								
								$config['upload_path'] = 'assets/gambar/feature/';
								$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
								$config['max_size']	= '1000';
								$config['encrypt_name'] = true;

								$this->load->library('upload', $config);
								if(! $this->upload->do_upload('ikon')){
									// jika gagal
									$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
									redirect('feature/edit_feature/'.$kode.'/'.$get['feature_id']->title);	
								} else {
									// jika berhasil
									$sub_data['result'] = $this->upload->data();
									
									foreach($sub_data['result'] as $item=>$data){
										$items = $sub_data['result']['file_name'];
									}

									unlink($path);


									$post = array(
											'title'=>$this->input->post('title'),
											'deskripsi'=>$this->input->post('deskripsi'),
											'icon'=>$items,
											'link'=>$this->input->post('url')
										);
									$update = $this->model_feature->update($kode,$post);
									$this->session->set_flashdata('flashOK', 'feature berhasil diubah');
									redirect('feature/edit_feature/'.$kode.'/'.$post['title']);
								}
							} else {
								$config['upload_path'] = 'assets/gambar/feature/';
								$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
								$config['max_size']	= '1000';
								$config['encrypt_name'] = true;

								$this->load->library('upload', $config);
								if(! $this->upload->do_upload('ikon')){
									// jika gagal
									$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
									redirect('feature/edit_feature/'.$kode.'/'.$get['feature_id']->title);	
								} else {
									// jika berhasil
									$sub_data['result'] = $this->upload->data();
									
									foreach($sub_data['result'] as $item=>$data){
										$items = $sub_data['result']['file_name'];
									}

									$post = array(
											'title'=>$this->input->post('title'),
											'deskripsi'=>$this->input->post('deskripsi'),
											'icon'=>$items,
											'link'=>$this->input->post('url')
										);
									$update = $this->model_feature->update($kode,$post);
									$this->session->set_flashdata('flashOK', 'feature berhasil diubah');
									redirect('feature/edit_feature/'.$kode.'/'.$post['title']);
								}
							}
						}
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Del_feature()
	{
		if($this->session->userdata('pengguna')){
			if($this->uri->segment(3) == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
				if($this->model_feature->get_id($this->uri->segment(3))->num_rows()==0){
					show_404();
				} else {
					$get['feature'] = $this->model_feature->get_id($this->uri->segment(3))->row();
					$path = 'assets/gambar/feature/'.$get['feature']->icon;
					if($get['feature']->icon == ""){
						$hapus = $this->model_feature->delete($this->uri->segment(3));
						if($hapus){
							$this->session->set_flashdata('flashOK', 'feature berhasil dihapus');
							redirect('feature/');
						} else {
							$this->session->set_flashdata('flashNO', 'feature gagal dihapus');
							redirect('feature/');
						}
					} else {
						$busak = unlink($path);
						if($busak){
							$hapus = $this->model_feature->delete($this->uri->segment(3));
							if($hapus){
								$this->session->set_flashdata('flashOK', 'feature berhasil dihapus');
								redirect('feature/');
							} else {
								$this->session->set_flashdata('flashNO', 'feature gagal dihapus');
								redirect('feature/');
							}
						} else {
							$this->session->set_flashdata('flashNO', 'image feature gagal dihapus');
							redirect('feature/');
						}
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}
}

/* End of file : feature.php */
/* Location : ./application/controlles/feature.php */