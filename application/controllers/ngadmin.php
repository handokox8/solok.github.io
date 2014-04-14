<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ngadmin extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_users');
		$this->load->model('model_info');
		$this->load->model('model_setting');
		$this->load->model('model_folower');

		$this->load->model('model_news');

	}

	public function Index()
	{
		if($this->session->userdata('pengguna')){
			redirect('ngadmin/dashboard');
		} else {
			/*
			 * option for show logo
			 */
			if($this->model_setting->get_id()->num_rows()==0){
				$data['logo'] = 'NULL';
			} else {
				$get = $this->model_setting->get_id()->row();
				$data['logo'] = $get->logo;
			}

			$data['title'] = 'Akses Login';
			$data['form_load'] = 'myform';
			$this->load->view('admin/login', $data);
		}
	}

	public function Dashboard()
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'Dashboard';
			$data['content'] = 'dashboard';
			if($this->model_info->get_id('1')->num_rows()==0){
				$data['info_id'] = 'NULL';
			} else {
				$data['info_id'] = $this->model_info->get_id('1')->row();
			}

			/*
			 * SHOW Last Konten
			 */
			if($this->model_news->get_limit('10','publish')->num_rows()==0){
	        	$data['news_all'] = 'NULL';
	        } else {
	        	$data['news_all'] = $this->model_news->get_limit('10','publish')->result();
	        }

	        /*
			 * SHOW Last FOLOWER
			 */
			if($this->model_folower->get_status()->num_rows()==0){
	        	$data['folower'] = 'NULL';
	        } else {
	        	$data['folower'] = $this->model_folower->get_status()->result();
	        }

			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

		public function Login()
	{
		if($this->session->userdata('pengguna')){
			redirect('ngadmin/index');
		} else {
			// cek login
			$this->form_validation->set_rules('username', 'Nama Pengguna', 'required|trim|xss_clean');
			$this->form_validation->set_rules('password', 'Kata Kunci', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				/*
				 * option for show logo
				 */
				if($this->model_setting->get_id()->num_rows()==0){
					$data['logo'] = 'NULL';
				} else {
					$get = $this->model_setting->get_id()->row();
					$data['logo'] = $get->logo;
				}
				
				$data['title'] = 'Akses Login';
				$data['form_load'] = 'myform';
				$this->load->view('admin/login', $data);
			} else {
				// cek login
				if ($this->model_users->get_user(strtolower($this->input->post('username')),md5($this->input->post('password')))->num_rows()==0){
					$this->session->set_flashdata('flashNO', 'Nama pengguna dan kata kunci tidak cocok');
					redirect('ngadmin/index');
				} else {
					$data['user'] = $this->model_users->get_user(strtolower($this->input->post('username')),md5($this->input->post('password')))->row();
					
					$this->session->set_userdata('idPengguna',$data['user']->idUser);
					$this->session->set_userdata('pengguna',$data['user']->userName);
					$this->session->set_userdata('akses',$data['user']->akses);
					$this->session->set_userdata('images', $data['user']->photo);
					
					redirect('ngadmin/dashboard');
				}
			}
		}
	}

	public function Logout()
	{
		if($this->uri->segment(3)=="" || $this->uri->segment(4)==""){
			show_404();
		} else {
			$data = array(
					'idPengguna'=>'',
					'pengguna'=>'',
					'akses'=>'',
					'images'=>''
				);

			$this->session->unset_userdata($data);
			//$this->session->sess_destroy();
			redirect('ngadmin/');
		}
	}

	public function Users()
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'Daftar Pengguna';
			$data['content'] = 'users';
			if($this->model_users->get_all()->num_rows()==0){
				$data['user_all'] = 'NULL';
			} else {
				$data['user_all'] = $this->model_users->get_all()->result();
			}
			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/index');
		}
	}

	public function setting_user()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('username', 'Nama Pengguna', 'required|trim|xss_clean');
			$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|trim|xss_clean');
			$this->form_validation->set_rules('address', 'Alamat', 'required|trim|xss_clean');
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|valid_emails|trim|xss_clean');
			$this->form_validation->set_rules('question', 'Pertannyaan Rahasia', 'required|trim|xss_clean');
			$this->form_validation->set_rules('answer', 'Jawaban Rahasia', 'required|trim|xss_clean');
			$this->form_validation->set_rules('newPass', 'Password Baru', 'min_length[4]|trim|xss_clean');
			$this->form_validation->set_rules('confPass', 'Konfirmasi Password', 'min_length[4]|matches[newPass]|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');
			$this->form_validation->set_message('valid_email', '%s e-mail tidak valid!');
			$this->form_validation->set_message('valid_emails', '%s e-mail tidak valid!');
			$this->form_validation->set_message('min_length', '%s minimal 4 karakter!');
			$this->form_validation->set_message('matches', '%s harus sama dengan Password Baru!');

			if($this->form_validation->run()==FALSE){
				$kode = $this->uri->segment(3);
				$data['title'] = 'Perubahan Data User';
				$data['content'] = 'edit_user';
				if($this->model_users->get_user_id($kode)->num_rows()==0){
					$this->session->set_flashdata('flashNO', 'Data user tidak ditemukan');
					redirect('ngadmin/dashboard');
				} else {
					$data['user_id'] = $this->model_users->get_user_id($kode)->row();
					$this->load->view('admin/index', $data);
				}
			} else {
				// save data
				$kode = $this->input->post('kdUser');
				
				$get['user'] = $this->model_users->get_user_id($kode)->row();

				$post1 = array(
						'nama'=>$this->input->post('fullname'),
						'address'=>$this->input->post('address'),
						'email'=>$this->input->post('email'),
						'question'=>$this->input->post('question'),
						'answer'=>$this->input->post('answer')
					);
				$post2 = array(
						'nama'=>$this->input->post('fullname'),
						'address'=>$this->input->post('address'),
						'email'=>$this->input->post('email'),
						'question'=>$this->input->post('question'),
						'answer'=>$this->input->post('answer'),
						'password'=>md5($this->input->post('newPass'))
					);

				if($_FILES['userfile']['name'] == ""){
					// not change picture profile
				} else {
					if($get['user']->photo == ""){
						$config['upload_path'] = 'assets/gambar/profile/';
						$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
						$config['max_size']	= '1000';
						$config['encrypt_name'] = true;

						$this->load->library('upload', $config);

						// cek upload file
						if(! $this->upload->do_upload()){
							// jika gagal
							$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
							redirect('ngadmin/setting_user/'.$kode.'/'.$post1['nama']);		
						} else {
							// jika berhasil
							$sub_data['result'] = $this->upload->data();
							
							foreach($sub_data['result'] as $item=>$data){
								$items = $sub_data['result']['file_name'];
							}
							// insert
							$postImage = array(
								'photo'=>$items
							);
							$insert = $this->model_users->update_user($kode,$postImage);
							if ($insert) {
								$this->session->set_flashdata('flashOK', 'Data Pengguna Berhasil Ditambahkan');
								redirect('ngadmin/setting_user/'.$kode.'/'.$post1['nama']);
							} else {
								$this->session->set_flashdata('flashNO', 'Data Pengguna Gagal Ditambahkan');
								redirect('ngadmin/setting_user/'.$kode.'/'.$post1['nama']);
							}
						}
					} else {
						$path = 'assets/gambar/profile/'.$get['user']->photo;
						if(unlink($path)){
							$config['upload_path'] = 'assets/gambar/profile/';
							$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
							$config['max_size']	= '1000';
							$config['encrypt_name'] = true;

							$this->load->library('upload', $config);

							// cek upload file
							if(! $this->upload->do_upload()){
								// jika gagal
								$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
								redirect('ngadmin/setting_user/'.$kode.'/'.$post1['nama']);		
							} else {
								// jika berhasil
								$sub_data['result'] = $this->upload->data();
								
								foreach($sub_data['result'] as $item=>$data){
									$items = $sub_data['result']['file_name'];
								}
								// insert
								$postImage = array(
									'photo'=>$items
								);
								$insert = $this->model_users->update_user($kode,$postImage);
								if ($insert) {
									$this->session->set_flashdata('flashOK', 'Data Pengguna Berhasil Ditambahkan');
									redirect('ngadmin/setting_user/'.$kode.'/'.$post1['nama']);
								} else {
									$this->session->set_flashdata('flashNO', 'Data Pengguna Gagal Ditambahkan');
									redirect('ngadmin/setting_user/'.$kode.'/'.$post1['nama']);
								}
							}
						} else {
							echo 'enggine is dead !!!';
						}
					}
				}


				if($this->input->post('newPass')=="" && $this->input->post('confPass')==""){
					$update = $this->model_users->update_user($kode,$post1);
					if($update){
						$this->session->set_flashdata('flashOK', 'Data User Berhasil Diperbaharui');
						redirect('ngadmin/setting_user/'.$kode.'/'.$post1['nama']);
					} else {
						$this->session->set_flashdata('flashNO', 'terjadi kesalahan pada sistem.');
						redirect('ngadmin/setting_user/'.$kode.'/'.$post1['nama']);
					}
				} else {
					$update = $this->model_users->update_user($kode,$post2);
					if($update){
						$this->session->set_flashdata('flashOK', 'Data User Berhasil Diperbaharui');
						redirect('ngadmin/setting_user/'.$kode.'/'.$post2['nama']);
					} else {
						$this->session->set_flashdata('flashNO', 'terjadi kesalahan pada sistem.');
						redirect('ngadmin/setting_user/'.$kode.'/'.$post2['nama']);
					}
				}
			}
		} else {
			redirect('ngadmin/index');
		}
	}

	public function Add_user()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('username', 'Nama Pengguna', 'required|trim|xss_clean');
			$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|trim|xss_clean');
			$this->form_validation->set_rules('address', 'Alamat', 'required|trim|xss_clean');
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|valid_emails|trim|xss_clean');
			$this->form_validation->set_rules('question', 'Pertannyaan Rahasia', 'required|trim|xss_clean');
			$this->form_validation->set_rules('answer', 'Jawaban Rahasia', 'required|trim|xss_clean');
			$this->form_validation->set_rules('newPass', 'Password Baru', 'required|min_length[4]|trim|xss_clean');
			$this->form_validation->set_rules('confPass', 'Konfirmasi Password', 'required|min_length[4]|matches[newPass]|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');
			$this->form_validation->set_message('valid_email', '%s e-mail tidak valid!');
			$this->form_validation->set_message('valid_emails', '%s e-mail tidak valid!');
			$this->form_validation->set_message('min_length', '%s minimal 4 karakter!');
			$this->form_validation->set_message('matches', '%s harus sama dengan Password Baru!');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'Tambah Pengguna';
				$data['content'] = 'add_user';
				$this->load->view('admin/index', $data);
			} else {
				// save data
				// cek file upload
				
				if($_FILES['userfile']['name'] == ""){
					// jika file upload kosong

					$cek['user'] = $this->model_users->get_all()->result();

					foreach ($cek['user'] as $cek) {
						// cek username
						if($this->input->post('username') == $cek->userName){
							// jika username sudah ada
							$this->session->set_flashdata('flashNO', 'Nama Pengguna Sudah digunakan');
							redirect('ngadmin/add_user');
						} else {
							// jika username belum ada
							// cek email
							if($this->input->post('email') == $cek->email){
								// jika email sudah ada
								$this->session->set_flashdata('flashNO', 'E-mail Sudah digunakan');
								redirect('ngadmin/add_user');
							} else {
								// jika email belum ada
								$post1 = array(
									'userName'=>$this->input->post('username'),
									'nama'=>$this->input->post('fullname'),
									'address'=>$this->input->post('address'),
									'email'=>$this->input->post('email'),
									'password'=>md5($this->input->post('newPass')),
									'question'=>$this->input->post('question'),
									'answer'=>$this->input->post('answer'),
									'akses'=>$this->input->post('akses')
								);
								// insert data
								$insert = $this->model_users->save_user($post1);
								if ($insert) {
									$this->session->set_flashdata('flashOK', 'Data Pengguna Berhasil Ditambahkan');
									redirect('ngadmin/add_user');
								} else {
									$this->session->set_flashdata('flashNO', 'Data Pengguna Gagal Ditambahkan');
									redirect('ngadmin/add_user');
								}
							}
							// end cek email
						}
						// end cek username
					}
				} else {
					// jika file upload ada

					$cek['user'] = $this->model_users->get_all()->result();

					foreach ($cek['user'] as $cek) {
						// cek username
						if($this->input->post('username') == $cek->userName){
							// jika username sudah ada
							$this->session->set_flashdata('flashNO', 'Nama Pengguna Sudah digunakan');
							redirect('ngadmin/add_user');
						} else {
							// jika username belum ada
							// cek email
							if($this->input->post('email') == $cek->email){
								// jika email sudah ada
								$this->session->set_flashdata('flashNO', 'E-mail Sudah digunakan');
								redirect('ngadmin/add_user');
							} else {
								// jika email belum ada

								$config['upload_path'] = 'assets/gambar/profile/';
								$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
								$config['max_size']	= '1000';
								$config['encrypt_name'] = true;

								$this->load->library('upload', $config);

								// cek upload file
								if(! $this->upload->do_upload()){
									// jika gagal
									$this->session->set_flashdata('flashNOP', $sub_data['error'] = $this->upload->display_errors());
									redirect('ngadmin/add_user');		
								} else {
									// jika berhasil
									$sub_data['result'] = $this->upload->data();
									
									foreach($sub_data['result'] as $item=>$data){
										$items = $sub_data['result']['file_name'];
									}
									// insert
									$post1 = array(
										'userName'=>$this->input->post('username'),
										'nama'=>$this->input->post('fullname'),
										'address'=>$this->input->post('address'),
										'email'=>$this->input->post('email'),
										'password'=>md5($this->input->post('newPass')),
										'question'=>$this->input->post('question'),
										'answer'=>$this->input->post('answer'),
										'akses'=>$this->input->post('akses'),
										'photo'=>$items
									);
									$insert = $this->model_users->save_user($post1);
									if ($insert) {
										$this->session->set_flashdata('flashOK', 'Data Pengguna Berhasil Ditambahkan');
										redirect('ngadmin/add_user');
									} else {
										$this->session->set_flashdata('flashNO', 'Data Pengguna Gagal Ditambahkan');
										redirect('ngadmin/add_user');
									}
								}
								// end cek upload file
							}
							// end cek email
						}
						// end cek username
					}
				}
				// end cek file upload
			}
		} else {
			redirect('ngadmin/index');
		}
	}

	public function Del_user()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			if($this->model_users->get_user_id($kode)->num_rows()==0){
				show_404();
			} else {
				if($kode != '1'){
					$delete = $this->model_users->delete_user($kode);
					if($delete){
						$this->session->set_flashdata('flashOK', 'Data berhasil dihapus');
						redirect('ngadmin/users');
					} else {
						$this->session->set_flashdata('flashNO', 'Data gagal dihapus');
						redirect('ngadmin/users');
					}
				} else {
					$this->session->set_flashdata('flashNO', 'pengguna ini tidak dapat dihapus');
					redirect('ngadmin/users');
				}
			}
		} else {
			redirect('ngadmin/index');
		}
	}

	public function Lupa()
	{
	/***************************************************************************
	 * function untuk menampilkan forgot password
	 **************************************************************************/
		// cek form validation
		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');

		if($this->form_validation->run()==FALSE){
			// jika form validation bernilai FALSE
			$data['title'] = 'Lupa Password';
			$this->load->view('admin/forgot_admin', $data);
		} else {
			// jika form validation bernilai TRUE

			// begin step 1 forgot password process
			$kode = $this->input->post('username');
			// cek data user didalam database
			if($this->model_users->get_user_name($kode)->num_rows()==0){
				// jika data tidak ditemukan didalam database
				$this->session->set_flashdata('flashNO', 'Username Tidak Terdaftar');
				redirect('ngadmin/lupa');
			} else {
				// jika data ditemukan didalam database
				$data['title'] = 'Pertanyaan rahasia';
				$data['user'] = $this->model_users->get_user_name($kode)->row();
				$this->load->view('admin/quest_admin',$data);
			}
		}
	}

	public function Answer()
	{
	/***************************************************************************
	 * function untuk melakukan validasi form forgot password
	 **************************************************************************/
		// form validation answer
		$this->form_validation->set_rules('answer', 'Jawaban', 'required|trim|xss_clean');

		// cek form validation
		if($this->form_validation->run()==FALSE){
			// jika form validation bernilai FALSE
			$this->session->set_flashdata('flashNO', 'Jawaban anda kosong ...');
			redirect('ngadmin/');
		} else {
			// jika form validation bernilai TRUE

			// begin step 2 forgot password answer
			$kode = $this->input->post('username1');
			$post = $this->input->post('answer');
			
			// cek data user didalam database
			if($this->model_users->get_user_name($kode)->num_rows()==0){
				// jika data tidak ditemukan didalam database
				$this->session->set_flashdata('flashNO', 'Username Tidak Terdaftar');
				redirect('ngadmin/lupa');
			} else {
				// jika data ditemukan didalam database
				$data['title'] = 'Kode keamanan';
				$data['user'] = $this->model_users->get_user_name($kode)->row();

				// cek kecocokan jawaban
				if(strtolower($data['user']->answer) == strtolower($post)){
					// jika jawaban cocok
					$this->load->helper('random_char_helper');
					$newKode = acakangkahuruf(10);

					// send mail
					$this->load->library('email');
					
					$data['info'] = $this->model_info->get_id('1')->row();

					$this->email->from("jogjania@jogjania.com");
					$this->email->to($data['user']->email);
					
					$this->email->subject("Reset Password-".base_url());
					$this->email->message("Anda Telah mereset password anda dan kami memberikan password acak untuk anda.\nPassword baru : ".$newKode."\nTerimakasih");	
					
					$send = $this->email->send();
					if($send){
						$update = $this->model_users->update_user($data['user']->idUser,array('password'=>md5($newKode)));
						if($update){
							$this->session->set_flashdata('flashOK', 'Password telah direset silahkan cek e-mail anda');
							redirect('ngadmin/');
						} else {
							$this->session->set_flashdata('flashNO', 'Anda Gagal melakukan reset password, password gagal dirubah');
							redirect('ngadmin/');
						}
					} else {
						$this->session->set_flashdata('flashNO', 'Anda Gagal melakukan reset password, e-mail gagal dikirm');
						redirect('ngadmin/');
					}
				} else {
					// jika jawaban tidak cocok
					$this->session->set_flashdata('flashNO', 'Tidak ada kecocokan jawaban anda');
					redirect('ngadmin/lupa');
				}
			}
		}
	}

}

/* End of file : admin.php */
/* Location : ./application/controllers/ngadmin.php */