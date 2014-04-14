<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_widget');
	}

/***************************************************************************
 * ADMIN PANEL
 **************************************************************************/
	public function Index()
	{
		if($this->session->userdata('pengguna')){
			$data['title'] = 'Pengaturan widget';
			$data['content'] = 'widget';
			
			if($this->model_widget->get_all('sidebar1')->num_rows()==0){
				$data['widget_satu'] = 'NULL';
			} else {
				$data['widget_satu'] = $this->model_widget->get_all('sidebar1')->result();
			}

			if($this->model_widget->get_all('sidebar2')->num_rows()==0){
				$data['widget_dua'] = 'NULL';
			} else {
				$data['widget_dua'] = $this->model_widget->get_all('sidebar2')->result();
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('ngadmin/');
		}
	}

	public function Save_widget()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean');
			$this->form_validation->set_rules('widget', 'Widget', 'required|trim');
			$this->form_validation->set_rules('sort', 'Urutan', 'required|trim|xss_clean');
			$this->form_validation->set_rules('position', 'Posisi', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$data['title'] = 'Pengaturan widget';
				$data['content'] = 'widget';

				if($this->model_widget->get_all('sidebar1')->num_rows()==0){
					$data['widget_satu'] = 'NULL';
				} else {
					$data['widget_satu'] = $this->model_widget->get_all('sidebar1')->result();
				}

				if($this->model_widget->get_all('sidebar2')->num_rows()==0){
					$data['widget_dua'] = 'NULL';
				} else {
					$data['widget_dua'] = $this->model_widget->get_all('sidebar2')->result();
				}
				
				$this->load->view('admin/index', $data);
			} else {
				// save data
				$post = array(
						'title'=>$this->input->post('title'),
						'widget'=>$this->input->post('widget'),
						'sort'=>$this->input->post('sort'),
						'location'=>$this->input->post('position')
					);

				$insert = $this->model_widget->insert($post);
				if($insert){
					$this->session->set_flashdata('flashOK', 'widget berhasil ditambahkan, silahkan aktifkan widget anda');
					redirect('widget/');
				} else {
					$this->session->set_flashdata('flashOK', 'widget gagal ditambahkan');
					redirect('widget/');
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Edit_widget()
	{
		if($this->session->userdata('pengguna')){
			$this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean');
			$this->form_validation->set_rules('widget', 'Widget', 'required|trim');
			$this->form_validation->set_rules('sort', 'Urutan', 'required|trim|xss_clean');
			$this->form_validation->set_rules('position', 'Posisi', 'required|trim|xss_clean');

			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE){
				$kode = $this->uri->segment(3);

				$data['title'] = 'Perubahan widget';
				$data['content'] = 'edit_widget';
				if($this->model_widget->get_id($kode)->num_rows()==0){
					show_404();                                        
				} else {
					$data['widget_id'] = $this->model_widget->get_id($kode)->row();
				}

				if($this->model_widget->get_all('sidebar1')->num_rows()==0){
					$data['widget_satu'] = 'NULL';
				} else {
					$data['widget_satu'] = $this->model_widget->get_all('sidebar1')->result();
				}

				if($this->model_widget->get_all('sidebar2')->num_rows()==0){
					$data['widget_dua'] = 'NULL';
				} else {
					$data['widget_dua'] = $this->model_widget->get_all('sidebar2')->result();
				}

				$this->load->view('admin/index', $data);
			} else {
				// save data
				$kode = $this->input->post('value');
				$post = array(
						'title'=>$this->input->post('title'),
						'widget'=>$this->input->post('widget'),
						'sort'=>$this->input->post('sort'),
						'location'=>$this->input->post('position')
					);
				$update = $this->model_widget->update($kode, $post);
				if($update){
					$this->session->set_flashdata('flashOK', 'widget berhasil diubah');
					redirect('widget/edit_widget/'.$kode);
				} else {
					$this->session->set_flashdata('flashNO', 'widget gagal diubah');
					redirect('widget/edit_widget/'.$kode);
				}
			}
		} else {
			redirect('ngadmin/');
		}

	}

	public function Setting()
	{
		if($this->session->userdata('pengguna')){
			if($this->uri->segment(3)=="" || $this->uri->segment(4)=="" || $this->uri->segment(5)==""){
				show_404();
			} else {
				$kode = $this->uri->segment(3);
				if($this->model_widget->get_id($kode)->num_rows()==0){
					show_404();
				} else {
					if(strtolower($this->uri->segment(5))=="active"){
						$act = array(
								'status'=>'active'
							);
						$update = $this->model_widget->update($kode, $act);
						if($update){
							$this->session->set_flashdata('flashOK', 'widget telah diaktifkan');
							redirect('widget/');
						} else {
							$this->session->set_flashdata('flashNO', 'widget gagal diaktifkan');
							redirect('widget/');
						}
					} else if(strtolower($this->uri->segment(5))=="deactive") {
						$act = array(
								'status'=>'deactive'
							);
						$update = $this->model_widget->update($kode, $act);
						if($update){
							$this->session->set_flashdata('flashOK', 'widget telah dinon-aktifkan');
							redirect('widget/');
						} else {
							$this->session->set_flashdata('flashNO', 'widget gagal dinon-aktifkan');
							redirect('widget/');
						}
					} else {
						show_404();
					}
				}
			}
		} else {
			redirect('ngadmin/');
		}
	}

	public function Sorting()
	{
		if($this->session->userdata('pengguna')){
			$juml = $this->input->post('juml');
			for($i=1;$i<=$juml;$i++){
				$kode = $this->input->post('kode'.$i);
				$post = array(
							'sort'=>$this->input->post('sort'.$i)
						);
				$update = $this->model_widget->update($kode,$post);
			}
			$this->session->set_flashdata('flashOK', 'perubahan berhasil disimpan');
			redirect('widget/');
		} else {
			redirect('ngadmin/');
		}
	}

	public function Del_widget()
	{
		if($this->session->userdata('pengguna')){
			$kode = $this->uri->segment(3);
			if($kode == "" || $this->uri->segment(4) == ""){
				show_404();
			} else {
				if($this->model_widget->get_id($kode)->num_rows()==0){
					show_404();
				} else {
					if($this->model_widget->delete($kode)){
						$this->session->set_flashdata('flashOK', 'widget berhasil dihapus.');
						redirect('widget/');
					} else {
						$this->session->set_flashdata('flashNO', 'widget gagal dihapus.');
						redirect('widget/');
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

/* End of file : widget.php */
/* Location : ./application/controllers/widget.php */