<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Info extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Info_model','info');
	}

	public function index() {
		$this->login->isLoggedIn();
		$data = array('title' => 'Info/Berita',
					  'isi'   => 'info_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->info->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $info) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $info->judul_info;
			//$row[] = $info->deskripsi;
			$row[] = $info->waktu_upload;
			if ($info->gambar != '') {
				$path = 'assets/uploads/info/'.$info->gambar.'';
				if(file_exists($path)){
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/info/'.$info->gambar.'">';
				} else {
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/info/no-promo.png">';
				}
			} else {
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/info/no-promo.png">';
			}
			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit/Detail" onclick="edit('."'".$info->id_info."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$info->id_info."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->info->count_all(),
						"recordsFiltered" => $this->info->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_info)
	{
		
		$data = $this->info->get($id_info);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'judul_info',
			'label' => 'Judul info',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Judul info tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'deskripsi',
			'label' => 'Deskripsi',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Deskripsi tidak boleh kosong !',			       
		            ),
		    ),
     	
        
		);

		$this->form_validation->set_rules($config);
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->form_validation->run()===FALSE)
		{
			if(form_error('judul_info')!=''){
				$data['inputerror'][] = 'judul_info';
				$data['error_string'][] = form_error('judul_info');
				$data['status'] = FALSE;
			}
			if(form_error('deskripsi')!=''){
				$data['inputerror'][] = 'deskripsi';
				$data['error_string'][] = form_error('deskripsi');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

		$nmfile = $this->info->getkodeinfo();
		$config['upload_path'] = './assets/uploads/info/'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['max_size'] = '10240'; 
		$config['max_width']  = '10240'; 
		$config['max_height']  = '10240'; 
		$config['file_name'] = $nmfile; 
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('gambar')){
			$gambar = '';
		} else {
			$gbr = $this->upload->data();
			$gambar = $gbr['file_name'];
		}
        date_default_timezone_set('Asia/Jakarta');
		$waktu_upload = date('Y-m-d h:i:s');
		$data = array(
				'id_info'  =>$this->info->getkodeinfo(),
				'judul_info' => $this->input->post('judul_info'),
				'deskripsi' => $this->input->post('deskripsi'),
				'gambar' => $gambar,
				'waktu_upload' => $waktu_upload,

			);
		$insert = $this->info->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
        	array(
			'field' => 'judul_info',
			'label' => 'Judul info',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Judul info tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'deskripsi',
			'label' => 'Deskripsi',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Deskripsi tidak boleh kosong !',			       
		            ),
		    ),
       
		);
		$this->form_validation->set_rules($config);
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->form_validation->run()===FALSE)
		{
			if(form_error('judul_info')!=''){
				$data['inputerror'][] = 'judul_info';
				$data['error_string'][] = form_error('judul_info');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$nmfile = $this->info->getkodeinfo();
		$config['upload_path'] = './assets/uploads/info/'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['max_size'] = '10240';
		$config['max_width']  = '10240'; 
		$config['max_height']  = '10240'; 
		$config['file_name'] = $nmfile; 
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('gambar')){
			$gbr = $this->info->get($this->input->post('id_info'));
			$gambar = $gbr->gambar;
		} else {
			$gbr = $this->info->get($this->input->post('id_info'));
			if ($gbr->gambar != '') {
			$path = 'assets/uploads/info/'.$gbr->gambar;
			if(file_exists($path)){
	   		unlink($path);
	   		}
	   		}
			$fileupload = $this->upload->data();
			$gambar= $fileupload['file_name'];
		}
		$data = array(
				'judul_info' => $this->input->post('judul_info'),
				'deskripsi' => $this->input->post('deskripsi'),
				'gambar' => $gambar,
			);
		$this->info->update(array('id_info' => $this->input->post('id_info')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_info)
	{
	    $info = $this->info->get($id_info);
		if ($info->gambar != '') {
		$path = 'assets/uploads/info/'.$info->gambar;
		if(file_exists($path)){
	   		unlink($path);
	   	}
	   	}
		$this->info->delete($id_info);
		echo json_encode(array("status" => TRUE));
		/*$this->info->delete($id_info);
		echo json_encode(array("status" => TRUE));*/
	}

	// Mobile
	public function tampil(){
        $data = $this->info->tampil();
        echo json_encode($data);
    }

}

?>