<?php if ( ! defined('BASEPATH')) exit('No direct script access alowed');

class Menu extends CI_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_menu_2'); 
        $this->load->model('model_pages');  
        $this->load->model('model_label');
    }

/***************************************************************************
 * ADMIN PANEL
 **************************************************************************/

    public function Index()
    {
            if($this->session->userdata('pengguna')){
            $data['title'] = 'Pengaturan Menu';
            $data['content'] = 'menu';
            $data['path'] = 'menu/add_menu';
            $data['url'] = '';
            $data['label'] = '';
            $data['urut'] = '';
            $data['idmenu'] = '';

            if($this->model_menu_2->get_all('title')->num_rows()==0){
                $data['parent_head'] = 'NULL';
            } else {
                $data['parent_head']= $this->model_menu_2->get_all('title')->result();
            }
            if($this->model_menu_2->get_all('menu_order')->num_rows()=='NULL'){
                $data['menu'] = NULL;
            } else {
            $getMenu = $this->model_menu_2->get_all('menu_order')->result();
            foreach ($getMenu as $row) {
                $d[$row->parent_id][]= $row;
                }
            $data['menu'] = get_menu($d);
            }
            //menu add pages
            if($this->model_pages->get_all_pages()->num_rows==0){
                $data['add_halaman'] = 'NULL';
            } else {
                $data['add_halaman'] = $this->model_pages->get_all_pages()->result();
            }
             //menu add labels
            if($this->model_label->get_all()->num_rows==0){
                $data['add_label'] = 'NULL';
            } else {
                $data['add_label'] = $this->model_label->get_all()->result();
            }
            
            $this->load->view('admin/index', $data);
        } else {
        redirect('ngadmin/');
        }
    }

    public function Add_menu()
    {
        if($this->session->userdata('pengguna')){
            $this->form_validation->set_rules('url', 'URL', 'required|trim|xss_clean');
            $this->form_validation->set_rules('label', 'Label', 'required|trim|xss_clean');
            $this->form_validation->set_rules('urut', 'Urutan', 'required|trim|xss_clean|numeric');

            $this->form_validation->set_message('required', '%s tidak boleh kosong!');
            $this->form_validation->set_message('numeric', '%s Harus angka!');
            if($this->form_validation->run()==FALSE){
            $data['title'] = 'Pengaturan Menu';
            $data['content'] = 'menu';
            $data['path'] = 'menu/add_menu';
            $data['url'] = $this->input->post('url');
            $data['label'] = $this->input->post('label');
            $data['urut'] = $this->input->post('urut');
            $data['idmenu'] = $this->input->post('parent');

            if($this->model_menu_2->get_all('title')->num_rows()==0){
                $data['parent_head'] = 'NULL';
            } else {
                $data['parent_head']= $this->model_menu_2->get_all('title')->result();
            }
            if($this->model_menu_2->get_all('menu_order')->num_rows()=='NULL'){ 
                $data['menu'] = 'NULL';
            } else {
            $getMenu = $this->model_menu_2->get_all('menu_order')->result();
            foreach ($getMenu as $row) {
                $d[$row->parent_id][]= $row;
                }
            $data['menu'] = get_menu($d);
            }
             //menu add pages
            if($this->model_pages->get_all_pages()->num_rows==0){
                $data['add_halaman'] = 'NULL';
            } else {
                $data['add_halaman'] = $this->model_pages->get_all_pages()->result();
            }
             //menu add labels
            if($this->model_label->get_all()->num_rows==0){
                $data['add_label'] = 'NULL';
            } else {
                $data['add_label'] = $this->model_label->get_all()->result();
            }
            
            $this->load->view('admin/index', $data);
            } else {
                $post= array(
                                'parent_id' =>$this->input->post('parent'),
                                'title' =>$this->input->post('label'),
                                'url' =>$this->input->post('url'),
                                'menu_order' =>$this->input->post('urut'),

                             );
                $insert = $this->model_menu_2->insert($post);
                if($insert){
                    $this->session->set_flashdata('flashOK', 'Menu berhasil ditambah');
                    redirect('menu/');
                } else {
                    $this->session->set_flashdata('flashNO', 'Menu gagal ditambah');
                    redirect('menu/');
                }
                redirect('menu/');
            }

        } else {
            redirect('ngadmin/');
        }
    }


    public function Edit_menu()
    {

        if($this->session->userdata('pengguna')){
            $this->form_validation->set_rules('url', 'URL', 'required|trim|xss_clean');
            $this->form_validation->set_rules('label', 'Label', 'required|trim|xss_clean');
            $this->form_validation->set_rules('urut', 'Urutan', 'required|trim|xss_clean|numeric');

            $this->form_validation->set_message('required', '%s tidak boleh kosong!');
            $this->form_validation->set_message('numeric', '%s Harus angka!');
            
            if($this->form_validation->run()==FALSE){
                $kode = $this->uri->segment(3);
                $data['title'] = 'Pengaturan Menu';
                $data['content'] = 'menu';
                $data['path'] = 'menu/edit_menu/'.$kode;
                $dataEdit = $this->model_menu_2->get_id($kode)->row();
                $data['url'] = $dataEdit->url;
                $data['label'] = $dataEdit->title;
                $data['urut'] = $dataEdit->menu_order;
                $data['idmenu'] = $dataEdit->parent_id;

                if($this->model_menu_2->get_all_no($kode,'title')->num_rows()==0){
                    $data['parent_head'] = 'NULL';
                } else {
                    $data['parent_head']= $this->model_menu_2->get_all_no($kode,'title')->result();
                }
                if($this->model_menu_2->get_all('menu_order')->num_rows()=='NULL'){
                    $data['menu'] = 'NULL';
                } else {
                $getMenu = $this->model_menu_2->get_all('menu_order')->result();
                foreach ($getMenu as $row) {
                    $d[$row->parent_id][]= $row;
                    }
                $data['menu'] = get_menu($d);
                }

                //menu add pages
                if($this->model_pages->get_all_pages()->num_rows==0){
                    $data['add_halaman'] = 'NULL';
                } else {
                    $data['add_halaman'] = $this->model_pages->get_all_pages()->result();
                }
                 //menu add labels
                if($this->model_label->get_all()->num_rows==0){
                    $data['add_label'] = 'NULL';
                } else {
                    $data['add_label'] = $this->model_label->get_all()->result();
                }
                
                $this->load->view('admin/index', $data);    
            } else {
                $kode = $this->uri->segment(3);
                $post= array(
                                'parent_id' =>$this->input->post('parent'),
                                'title' =>$this->input->post('label'),
                                'url' =>$this->input->post('url'),
                                'menu_order' =>$this->input->post('urut'),

                             );
                $update = $this->model_menu_2->update($kode,$post);
                if($update){
                    $this->session->set_flashdata('flashOK', 'menu berhasil diubah');
                    redirect('menu/');
                } else {
                    $this->session->set_flashdata('flashNO', 'menu gagal diubah');
                    redirect('menu/');
                }
                redirect('menu/');
            }
            
        } else {
            redirect('ngadmin/');
        }
    }

    public function Del_menu()
    {
        if($this->session->userdata('pengguna')){
            if($this->uri->segment(3) == "" || $this->uri->segment(4) == ""){
                show_404();
            } else {    
                        $kode = $this->uri->segment(3);
                        $delete = $this->model_menu_2->delete($kode);
                        $post = array('parent_id' => '0');
                        $update = $this->model_menu_2->update_parent($kode,$post);
                        if($delete && $update){
                            $this->session->set_flashdata('flashOK', 'menu berhasil dihapus');
                            redirect('menu/');
                        } else {
                            $this->session->set_flashdata('flashNO', 'menu gagal dihapus');
                            redirect('menu/');
                        }
                    }

        } else {
            redirect('ngadmin/');
        }
    }

    public function add_halaman()
    {
        if( ! $this->input->post('jumHal')){
            show_404();
        } else {
            $jum = $this->input->post('jumHal');
                $a = 0;
                for($i=1;$i<=$jum;$i++){
                    $kode = $this->input->post('halaman'.$i);
                    if($kode==''){
                        $a++;
                    }else{
                    $select=$this->model_pages->get_id($kode)->row();
                    $title = $select->title;
                    $url = base_url().'pages/index/'.$kode.'/'.preg_replace("![^a-z0-9]+!i", "-", $title);
                    $max = $this->model_menu_2->max('menu_order')->row();
                    $menu_order = $max->menu_order+1;

                    $post= array(
                                'parent_id' =>'0',
                                'title' =>$title,
                                'url' =>$url,
                                'menu_order' =>$menu_order

                             );
                    $insert = $this->model_menu_2->insert($post);
                    }

                } 
                if($a >= $jum){
                         $this->session->set_flashdata('flashNO', 'Pilih Halaman Dulu');
                         redirect('menu/');
                }else{
                     $this->session->set_flashdata('flashOK', 'Halaman Berhasil ditambahkan ke menu');
                     redirect('menu/');
                    }
               
        }
    }

    public function add_label()
    {
        if( ! $this->input->post('jumLab')){
            show_404();
        } else {
            $jum = $this->input->post('jumLab');
                $a = 0;
                for($i=1;$i<=$jum;$i++){
                    $kode = $this->input->post('label'.$i);
                    if($kode==''){
                        $a++;
                    }else{
                    $select=$this->model_label->get_id($kode)->row();
                    $title = $select->label;
                    $url = base_url().'label/get_news/'.$kode.'/'.preg_replace("![^a-z0-9]+!i", "-", $title);
                    $max = $this->model_menu_2->max('menu_order')->row();
                    $menu_order = $max->menu_order+1;

                    $post= array(
                                'parent_id' =>'0',
                                'title' =>$title,
                                'url' =>$url,
                                'menu_order' =>$menu_order

                             );
                    $insert = $this->model_menu_2->insert($post);
                    }

                } 
                if($a >= $jum){
                         $this->session->set_flashdata('flashNO', 'Pilih Label Dulu');
                         redirect('menu/');
                }else{
                     $this->session->set_flashdata('flashOK', 'Label Berhasil ditambahkan ke menu');
                     redirect('menu/');
                    }
        }
    }
/***************************************************************************
 * END ADMIN PANEL
 **************************************************************************/
}

// /* End of file : menu.php */
// /* Location : ./application/controllers/menu.php */