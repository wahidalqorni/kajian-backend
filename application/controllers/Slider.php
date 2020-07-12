<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Slider extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Slider_model','slider');
	}

	public function index() {
		$this->login->isLoggedIn();
		$data = array('title' => 'Slider',
					  'isi'   => 'slider_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->slider->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $slider) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $slider->nama_slider;
			if ($slider->gambar_slider != '') {
				$path = 'assets/uploads/slider/'.$slider->gambar_slider.'';
				if(file_exists($path)){
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/slider/'.$slider->gambar_slider.'">';
				} else {
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/slider/slider.jpg">';
				}
			} else {
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/slider/slider.jpg">';
			}
			$row[] = $slider->ket_slider;
			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$slider->id_slider."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$slider->id_slider."'".')"><i class="fa fa-trash"></i></a>';		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->slider->count_all(),
						"recordsFiltered" => $this->slider->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_slider)
	{
		
		$data = $this->slider->get($id_slider);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'nama_slider',
			'label' => 'Nama Slider',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama Slider tidak boleh kosong !',			       
		            ),
		    ),
        /*array(
			'field' => 'gambar_slider',
			'label' => 'Gambar Slider',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Gambar Slider tidak boleh kosong !',			       
		            ),
		    ),*/
        array(
			'field' => 'tipe_slider',
			'label' => 'Tipe Slider',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Tipe Slider tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'status_slider',
			'label' => 'Status Slider',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Status Slider tidak boleh kosong !',			       
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
			if(form_error('nama_slider')!=''){
				$data['inputerror'][] = 'nama_slider';
				$data['error_string'][] = form_error('nama_slider');
				$data['status'] = FALSE;
			}
			/*if(form_error('gambar_slider')!=''){
				$data['inputerror'][] = 'gambar_slider';
				$data['error_string'][] = form_error('gambar_slider');
				$data['status'] = FALSE;
			}*/
			if(form_error('tipe_slider')!=''){
				$data['inputerror'][] = 'tipe_slider';
				$data['error_string'][] = form_error('tipe_slider');
				$data['status'] = FALSE;
			}
			if(form_error('status_slider')!=''){
				$data['inputerror'][] = 'status_slider';
				$data['error_string'][] = form_error('status_slider');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

		$nmfile = $this->slider->getkodeslider();
		$config['upload_path'] = './assets/uploads/slider/'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['max_size'] = '10240'; 
		$config['max_width']  = '10240'; 
		$config['max_height']  = '10240'; 
		$config['file_name'] = $nmfile; 
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('gambar_slider')){
			$gambar_slider = '';
		} else {
			$gbr = $this->upload->data();
			$gambar_slider = $gbr['file_name'];
		}
		/*date_default_timezone_set('Asia/Jakarta');
		$waktu_upload = date('Y-m-d h:i:s');*/
		$data = array(
				'id_slider'  =>$this->slider->getkodeslider(),
				'nama_slider' => $this->input->post('nama_slider'),
				'gambar_slider' => $gambar_slider,
				'ket_slider' => $this->input->post('ket_slider'),
				'tipe' => $this->input->post('tipe_slider'),
				'status_slider' => $this->input->post('status_slider'),

			);
		$insert = $this->slider->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
    	array(
			'field' => 'nama_slider',
			'label' => 'Nama Slider',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama Slider tidak boleh kosong !',			       
		            ),
		    ),
        /*array(
			'field' => 'gambar_slider',
			'label' => 'Gambar Slider',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Gambar Slider tidak boleh kosong !',			       
		            ),
		    ),*/
        array(
			'field' => 'tipe_slider',
			'label' => 'Tipe Slider',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Tipe Slider tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'status_slider',
			'label' => 'Status Slider',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Status Slider tidak boleh kosong !',			       
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
			if(form_error('nama_slider')!=''){
				$data['inputerror'][] = 'nama_slider';
				$data['error_string'][] = form_error('nama_slider');
				$data['status'] = FALSE;
			}
			/*if(form_error('gambar_slider')!=''){
				$data['inputerror'][] = 'gambar_slider';
				$data['error_string'][] = form_error('gambar_slider');
				$data['status'] = FALSE;
			}*/
			if(form_error('tipe_slider')!=''){
				$data['inputerror'][] = 'tipe_slider';
				$data['error_string'][] = form_error('tipe_slider');
				$data['status'] = FALSE;
			}
			if(form_error('status_slider')!=''){
				$data['inputerror'][] = 'status_slider';
				$data['error_string'][] = form_error('status_slider');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$nmfile = $this->slider->getkodeslider();
		$config['upload_path'] = './assets/uploads/slider/'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['max_size'] = '10240';
		$config['max_width']  = '10240'; 
		$config['max_height']  = '10240'; 
		$config['file_name'] = $nmfile; 
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('gambar_slider')){
			$gbr = $this->slider->get($this->input->post('id_slider'));
			$gambar_slider = $gbr->gambar_slider;
		} else {
			$gbr = $this->slider->get($this->input->post('id_slider'));
			if ($gbr->gambar_slider != '') {
			$path = 'assets/uploads/slider/'.$gbr->gambar_slider;
			if(file_exists($path)){
	   		unlink($path);
	   		}
	   		}
			$fileupload = $this->upload->data();
			$gambar_slider= $fileupload['file_name'];
		}
		$data = array(
				'nama_slider' => $this->input->post('nama_slider'),
				'gambar_slider' => $gambar_slider,
				'ket_slider' => $this->input->post('ket_slider'),
				'tipe' => $this->input->post('tipe_slider'),
				'status_slider' => $this->input->post('status_slider'),
			);
		$this->slider->update(array('id_slider' => $this->input->post('id_slider')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_slider)
	{
		$slider = $this->slider->get($id_slider);
		if ($slider->gambar_slider != '') {
		$path = 'assets/uploads/slider/'.$slider->gambar_slider;
		if(file_exists($path)){
	   		unlink($path);
	   	}
	   	}
		$this->slider->delete($id_slider);
		echo json_encode(array("status" => TRUE));
		/*$this->slider->delete($id_slider);
		echo json_encode(array("status" => TRUE));*/
	}

	// Mobile
	public function tampil(){
        $data = $this->slider->tampil();
        echo json_encode($data);
    }

}

?>