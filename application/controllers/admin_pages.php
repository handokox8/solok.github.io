<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_pages extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_pages');
	}

	public function Index($offset = 0)
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'Semua Halaman';
			$data['content'] = 'pages';

			// pagination
			$this->load->library('pagination');
			$perpage = 10;
			$count = $this->model_pages->get_count()->num_rows();
			
		
			$config = array(
				'base_url' => base_url(). 'admin_pages/index',
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

			if($this->model_pages->get_all(array('perpage' => $perpage, 'offset' => $offset))->num_rows()==0){
				$data['pages_all'] = 'NULL';
			} else {
				$data['pages_all'] = $this->model_pages->get_all(array('perpage' => $perpage, 'offset' => $offset))->result();
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function Edit_pages()
	{
	/***************************************************************************
	 * function untuk mengedit pages
	 **************************************************************************/
		if($this->session->userdata('pengguna')){
			// form validation edit pages
			$this->form_validation->set_rules('title', 'required|trim|xss_clean');
			$this->form_validation->set_rules('deskripsi', 'required|trim');
			$this->form_validation->set_rules('keyword', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			// cek form validation
			if($this->form_validation->run()==FALSE){
				// jika form validation bernilai FALSE
				$kode = $this->uri->segment(3);

				$data['title'] = 'Edit Pages';
				$data['content'] = 'edit_pages';
				if($this->model_pages->get_id($kode)->num_rows()==0){
					show_404();
				} else {
					$data['pages_id'] = $this->model_pages->get_id($kode)->row();
				}
				$this->load->view('admin/index', $data);
			} else {
				// jika form validation bernilai TRUE
				$key = $this->input->post('id');

				// data dari form edit info
				$post = array(
						'title' => $this->input->post('title'),
						'deskripsi' => $this->input->post('deskripsi'),
						'post' => $this->input->post('elm1'),
						'status' => $this->input->post('jenis'),
						'keyword' => $this->input->post('keyword')
					);

				// melakukan perubahan data pages
				$update = $this->model_pages->update_pages($key,$post);

				// cek perubahan data peges
				if($update){
					// jiak berhasil
					$this->session->set_flashdata('flashOK', 'Perubahan berhasil disimpan');
					redirect('admin_pages/edit_pages/'.$key);
				} else {
					// jika gagal
					echo 'gagal';
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Add_pages()
	{
	/***************************************************************************
	 * function untuk menambah pages
	 **************************************************************************/
		if($this->session->userdata('pengguna')){
			// form validation tambah pages
			$this->form_validation->set_rules('title', 'title', 'required|trim|xss_clean');
			$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required|trim|xss_clean');
			$this->form_validation->set_rules('keyword', 'keyword', 'required|trim|xss_clean');
			$this->form_validation->set_rules('elm1', 'Posting', 'required|trim');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			// cek form validation
			if($this->form_validation->run()==FALSE){
				// jika form validation bernilai FALSE
				$data['title'] = 'Tambah Halaman';
				$data['content'] = 'add_pages';
				$this->load->view('admin/index', $data);
			} else {
				// jika form validation bernilai TRUE

				// data dari form tambah pages
				$post = array(
						'date'=>date('Y-m-d'),
						'title' => $this->input->post('title'),
						'deskripsi' => $this->input->post('deskripsi'),
						'post' => $this->input->post('elm1'),
						'status' => $this->input->post('jenis'),
						'keyword' => $this->input->post('keyword')
					);

				// melakukan penambahan pages
				$insert = $this->model_pages->insert_pages($post);

				// cek penambahan pages
				if($insert){
					// jika berhasil
					$this->session->set_flashdata('flashOK', 'Berhasil menambahkan Pages');
					redirect('admin_pages/add_pages');
				} else {
					// jika gagal
					$this->session->set_flashdata('flashNO', 'Gagal menambahkan Pages');
					redirect('admin_pages/add_pages');
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Pages_search($offset = 0)
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('search', 'Kotak Pencarian', 'required|min_length[3]|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');
			$this->form_validation->set_message('min_length', '%s minimal 3 karakter!');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'Semua Halaman';
				$data['content'] = 'pages';

				// pagination
				$this->load->library('pagination');
				$perpage = 10;
				$count = $this->model_pages->get_count()->num_rows();
				
			
				$config = array(
					'base_url' => base_url(). 'admin_pages/index',
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

				if($this->model_pages->get_all(array('perpage' => $perpage, 'offset' => $offset))->num_rows()==0){
					$data['pages_all'] = 'NULL';
				} else {
					$data['pages_all'] = $this->model_pages->get_all(array('perpage' => $perpage, 'offset' => $offset))->result();
				}

				$this->load->view('admin/index', $data);
			} else {
				$data['title'] = 'Semua Halaman';
				$data['content'] = 'pages_search';

				$post = $this->input->post('search');

				if($this->model_pages->get_like($post)->num_rows()==0){
					$data['pages_all'] = 'NULL';
				} else {
					$data['pages_all'] = $this->model_pages->get_like($post)->result();
				}

				$this->load->view('admin/index', $data);
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Del_pages()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			if($kode != '4'){
				$delete = $this->model_pages->delete_pages($kode);
				if($delete){
					$this->session->set_flashdata('flashOK', 'data halaman berhasil dihapus');
					redirect('admin_pages/');
				} else {
					$this->session->set_flashdata('flashNO', 'data halaman gagal dihapus');
					redirect('admin_pages/');
				}
			} else {
				$this->session->set_flashdata('flashNO', 'halaman ini tidak diizinkan untuk dihapus');
				redirect('admin_pages');
			}
		} else {
			redirect('ngadmin/');
		}
	}
}

/* End of file : admin_pages.php */
/* Location : ./application/controllers/admin_pages.php */