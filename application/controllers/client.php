<?php if ( ! defined('BASEPATH')) exit('No script access allowed');

class Client extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_client');
	}

	public function Index()
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'Tambah klien';
			$data['content'] = 'client';
			if($this->model_client->get_all()->num_rows()==0){
				$data['client_all'] = 'NULL';
			} else {
				$data['client_all'] = $this->model_client->get_all()->result();
			}
			$this->load->view('admin/index',$data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function Add_client()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('nama', 'Nama Klien', 'required|trim|xss_clean');
			$this->form_validation->set_rules('detail', 'Rincian Klien', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'tambah klien';
				$data['content'] = 'client';
				if($this->model_client->get_all()->num_rows()==0){
					$data['client_all'] = 'NULL';
				} else {
					$data['client_all'] = $this->model_client->get_all()->result();
				}
				$this->load->view('admin/index',$data);
			} else {
				// save data
				$config['upload_path'] = 'assets/gambar/client/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
				$config['max_size']	= '2000';
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('logo')){
					// jika gagal
					$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
					redirect('client/');		
				} else {
					$sub_data['result'] = $this->upload->data();
								
					foreach($sub_data['result'] as $item=>$data){
						$items = $sub_data['result']['file_name'];
					}
					$post = array(
							'namaClient'=>$this->input->post('nama'),
							'detail'=>$this->input->post('detail'),
							'image'=>$items
						);

					$insert = $this->model_client->insert($post);
					if($insert){
						$this->session->set_flashdata('flashOK', 'klient berhasil ditambahkan');
						redirect('client/');
					} else {
						$this->session->set_flashdata('flashNO', 'klient gagal ditambahkan');
						redirect('client/');
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Edit_client()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('nama', 'Nama Klien', 'required|trim|xss_clean');
			$this->form_validation->set_rules('detail', 'Rincian Klien', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$kode = $this->uri->segment(3);

				$data['title'] = 'Edit klien';
				$data['content'] = 'edit_client';

				if($this->model_client->get_all()->num_rows()==0){
					$data['client_all'] = 'NULL';
				} else {
					$data['client_all'] = $this->model_client->get_all()->result();
				}

				if($this->model_client->get_id($kode)->num_rows()==0){
					show_404();
				} else {
					$data['client_id'] = $this->model_client->get_id($kode)->row();
				}

				$this->load->view('admin/index',$data);
			} else {
				// sava data
				$kodeID = $this->input->post('kdClient');
				$kodeTitle = $this->input->post('kdTitle');

				if($_FILES['logo']['name']==""){
					$post = array(
							'namaClient'=>$this->input->post('nama'),
							'detail'=>$this->input->post('detail')
						);
					$ubah = $this->model_client->update($kodeID, $post);
					if($ubah){
						$this->session->set_flashdata('flashOK', 'klien berhasil diubah');
						redirect('client/edit_client/'.$kodeID.'/'.$kodeTitle);
					} else {
						$this->session->set_flashdata('flashNO', 'klien gagal diubah');
						redirect('client/edit_client/'.$kodeID.'/'.$kodeTitle);
					}
				} else {
					if($this->input->post('kdImage')==""){
						show_404();
					} else {
						$path = 'assets/gambar/client/'.$this->input->post('kdImage');
						if(file_exists($path)){
							$hapus = unlink($path);
							if($hapus){
								$config['upload_path'] = 'assets/gambar/client/';
								$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
								$config['max_size']	= '2000';
								$config['encrypt_name'] = true;

								$this->load->library('upload', $config);
								if(! $this->upload->do_upload('logo')){
									// jika gagal
									$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
									redirect('client/');		
								} else {
									$sub_data['result'] = $this->upload->data();
												
									foreach($sub_data['result'] as $item=>$data){
										$items = $sub_data['result']['file_name'];
									}
									$post = array(
											'namaClient'=>$this->input->post('nama'),
											'detail'=>$this->input->post('detail'),
											'image'=>$items
										);
									$ubah = $this->model_client->update($kodeID, $post);
									if($ubah){
										$this->session->set_flashdata('flashOK', 'klien berhasil diubah');
										redirect('client/edit_client/'.$kodeID.'/'.$kodeTitle);
									} else {
										$this->session->set_flashdata('flashNO', 'klien gagal diubah');
										redirect('client/edit_client/'.$kodeID.'/'.$kodeTitle);
									}
								}
							} else {
								$this->session->set_flashdata('flashNO', 'terjadi kesalahan pada engin client');
								redirect('client/edit_client/'.$kodeID.'/'.$kodeTitle);
							}
						} else {
							$config['upload_path'] = 'assets/gambar/client/';
							$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
							$config['max_size']	= '2000';
							$config['encrypt_name'] = true;

							$this->load->library('upload', $config);
							if(! $this->upload->do_upload('logo')){
								// jika gagal
								$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
								redirect('client/');		
							} else {
								$sub_data['result'] = $this->upload->data();
											
								foreach($sub_data['result'] as $item=>$data){
									$items = $sub_data['result']['file_name'];
								}
								$post = array(
										'namaClient'=>$this->input->post('nama'),
										'detail'=>$this->input->post('detail'),
										'image'=>$items
									);
								$ubah = $this->model_client->update($kodeID, $post);
								if($ubah){
									$this->session->set_flashdata('flashOK', 'klien berhasil diubah');
									redirect('client/edit_client/'.$kodeID.'/'.$kodeTitle);
								} else {
									$this->session->set_flashdata('flashNO', 'klien gagal diubah');
									redirect('client/edit_client/'.$kodeID.'/'.$kodeTitle);
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

	public function Del_client()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			if($this->model_client->get_id($kode)->num_rows()==0){
				show_404();
			} else {
				$hapus = $this->model_client->delete($kode);
				if($hapus){
					$this->session->set_flashdata('flashOK', 'klien berhasil dihapus');
					redirect('client/');
				} else {
					$this->session->set_flashdata('flashNO', 'klien gagal dihapus');
					redirect('client/');
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}
}

/* End of file : client.php */
/* Location : ./application/controllers/client.php */