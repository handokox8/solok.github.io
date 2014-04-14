<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tema extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		parent::__construct();
		$this->load->model('model_news');
		$this->load->model('model_label');
		$this->load->model('model_pages');
		$this->load->model('model_label_relation');

		$this->load->model('model_setting');
		$this->load->model('model_menu_2');
		$this->load->model('model_client');
		$this->load->model('model_info');
		$this->load->model('model_sosial');
		$this->load->model('model_link');
		$this->load->model('model_widget');
		$this->load->model('model_feature');
		$this->load->model('model_kolom');
		$this->load->model('model_folower');
	}

	public function Index()
	{
		if($this->session->userdata('pengguna')){

			$kolom = $this->model_kolom->get_all()->result();

			$i=1;
			foreach ($kolom as $kolom) {
				$data['judul'.$i] = $kolom->judulKolom;
				$data['limit'.$i] = $kolom->jumlahLimit;
				$data['jenis'.$i] = $kolom->jenisKolom;
				$data['isi'.$i] = $kolom->isiKolom;

				$i++;
			}

			$data['title'] = 'Pengaturan Kolom';
			$data['content'] = 'admin_column';
			$this->load->view('admin/index', $data);
		} else {
			show_404();
		}
	}

	public function ambil_kolom()
	{
		if($this->session->userdata('pengguna')){
		$jum = 3;
		for($i=1;$i<=$jum;$i++){
			$jenis = $this->input->post('ambilValueJenis'.$i);

			if($jenis == 'model_label_relation'){
				if($this->model_label->Get_all()->num_rows()==0){
					echo '<option value="0"> Belum ada label</option>' ;
				} else {

					$label = $this->model_label->Get_all()->result();
					foreach ($label as $label) {
						echo '<option value='.'"'.$label->idLabel.'"'.'>'.$label->label.'</option>' ;
					}
				}
			} else if($jenis == 'model_widget'){
				if($this->model_widget->Get_all_widget()->num_rows()==0){
					echo '<option value="0"> Belum ada Widget</option>';
				} else {
					$widget = $this->model_widget->Get_all_widget()->result();
					foreach ($widget as $widget) {
						echo '<option value='.'"'.$widget->idWidget.'"'.'>'.$widget->title.'</option>' ;
					}
				}
			} else if($jenis == 'model_feature'){
				if($this->model_feature->Get_all()->num_rows()==0){
					echo '<option value="0"> Belum ada fitur</option>';
				} else {
					$fitur = $this->model_feature->Get_all()->result();
					foreach ($fitur as $fitur) {
						echo '<option value='.'"'.$fitur->idFeature.'"'.'>'.$fitur->title.'</option>' ;
					}
				}
			} else if($jenis == 'model_news'){
				// if($this->model_news->Get_all()->num_rows()==0){
				// 	echo '<option value="0"> Belum ada fitur yang tersedia </option>';
				// } else {
				// 	$fitur = $this->model_feature->Get_all()->result();
				// 	foreach ($fitur as $fitur) {
						echo '<option value='.'"'.'0'.'"'.'>'.'Semua Konten ditampilkan'.'</option>' ;
				// 	}
				// }
			}

		}
		} else {
			redirect('ngadmin/');
		}
	}

	public function save()
	{
		if($this->session->userdata('pengguna')){

		$jum = 3;
		for($i=1;$i<=$jum;$i++){

			$this->form_validation->set_rules('judul'.$i, 'Judul Kolom '.$i, 'required|trim|xss_clean');
			$this->form_validation->set_rules('limit'.$i, 'Jumlah Kolom '.$i, 'required|trim|xss_clean');
			$this->form_validation->set_rules('jenis'.$i, 'Jenis Kolom '.$i, 'required|trim|xss_clean');
			$this->form_validation->set_rules('isi'.$i, 'Isi Kolom '.$i, 'required|trim|xss_clean');
		}
			$this->form_validation->set_message('required', '%s tidak boleh kosong!');

			if($this->form_validation->run()==FALSE) {
				$data['title'] = 'Pengaturan Kolom';
				$data['content'] = 'admin_column';
				$this->load->view('admin/index', $data);	
			} else {
				$jum = 3;
				for($i=1;$i<=$jum;$i++){
					if($this->input->post('jenis'.$i)=='model_news'){
						$jumlahLimit = $this->input->post('limit'.$i);	
						$namaDeskripsi = 'news';
						$namaThumb = 'image';
					} else if($this->input->post('jenis'.$i)=='model_label_relation'){	
						$jumlahLimit = $this->input->post('limit'.$i);	
						$namaDeskripsi = 'news';
						$namaThumb = 'image';
					} else if($this->input->post('jenis'.$i)=='model_widget'){	
						$jumlahLimit = '1';	
						$namaDeskripsi = 'widget';
						$namaThumb = 'image';
						if($this->input->post('limit'.$i)>1){
							$this->session->set_flashdata('flashNO'.$i,'Widget hanya dapat menampilkan 1 produk');
						}
					} else if($this->input->post('jenis'.$i)=='model_feature'){	
						$jumlahLimit = '1';
						$namaDeskripsi = 'deskripsi';
						$namaThumb = 'icon';
						if($this->input->post('limit'.$i)>1){
							$this->session->set_flashdata('flashNO'.$i,'Fitur hanya dapat menampilkan 1 produk');
						}
					}

					$kode =$i;
					$post = array(
									'judulKolom' => $this->input->post('judul'.$i),
									'jumlahLimit' => $jumlahLimit,
									'jenisKolom' => $this->input->post('jenis'.$i),
									'isiKolom' => $this->input->post('isi'.$i), 
									'namaDeskripsi' => $namaDeskripsi,
									'namaThumb' => $namaThumb
									);
					$this->model_kolom->Update($kode,$post);
				}
				$this->session->set_flashdata('flashOK','Berhasil Update');
				redirect('tema/');
			}

		} else {
			redirect('ngadmin/');
		}
	}

	public function ambil_checked()
	{
		if($this->session->userdata('pengguna')){ 

			$kolom1 = $this->model_kolom->get_id('1')->row();
			$kolom2 = $this->model_kolom->get_id('2')->row();
			$kolom3 = $this->model_kolom->get_id('3')->row();

				$data['isi1'] = $kolom1->isiKolom;
				$data['isi2'] = $kolom2->isiKolom;
				$data['isi3'] = $kolom3->isiKolom;

				echo json_encode($data);



		} else {
			redirect('ngadmin/');
		}
	}



	
}

/* End of file : tema.php */
/* Location : ./application/controllers/tema.php */