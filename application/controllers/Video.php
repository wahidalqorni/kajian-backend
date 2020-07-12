<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Video extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Video_model','video');
		$this->load->model('Ustad_model','ustad');
	}

	public function index() {
		$this->login->isLoggedIn();
		$ustad = $this->ustad->tampil();
		$data = array('title' => 'Video',
					  'ustad' => $ustad,
					  'isi'   => 'video_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->video->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $video) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $video->judul;
			$row[] = $video->nama_ustad;
			$row[] = '<a href="'."$video->url".'"">'."$video->url".'</a>'; 
			$row[] = $video->deskripsi;
			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$video->id_video."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$video->id_video."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->video->count_all(),
						"recordsFiltered" => $this->video->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_video)
	{
		$data = $this->video->get($id_video);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'judul_video',
			'label' => 'Judul Video',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Judul video tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'ustad',
			'label' => 'Nama Ustad',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama Ustad tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'url',
			'label' => 'URL',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'URL tidak boleh kosong !',
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
			if(form_error('judul_video')!=''){
				$data['inputerror'][] = 'judul_video';
				$data['error_string'][] = form_error('judul_video');
				$data['status'] = FALSE;
			}
			if(form_error('ustad')!=''){
				$data['inputerror'][] = 'ustad';
				$data['error_string'][] = form_error('ustad');
				$data['status'] = FALSE;
			}
			if(form_error('url')!=''){
				$data['inputerror'][] = 'url';
				$data['error_string'][] = form_error('url');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		
		$data = array(
				'id_video' => $this->video->getkodevideo(),
				'judul' => $this->input->post('judul_video'),
				'id_ustad' => $this->input->post('ustad'),
				'url' => $this->input->post('url'),
				'deskripsi' => $this->input->post('deskripsi'),
			);
		$insert = $this->video->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
         array(
			'field' => 'judul_video',
			'label' => 'Judul Video',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Judul video tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'ustad',
			'label' => 'Nama Ustad',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama Ustad tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'url',
			'label' => 'URL',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'URL tidak boleh kosong !',
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
			if(form_error('judul_video')!=''){
				$data['inputerror'][] = 'judul_video';
				$data['error_string'][] = form_error('judul_video');
				$data['status'] = FALSE;
			}
			if(form_error('ustad')!=''){
				$data['inputerror'][] = 'ustad';
				$data['error_string'][] = form_error('ustad');
				$data['status'] = FALSE;
			}
			if(form_error('url')!=''){
				$data['inputerror'][] = 'url';
				$data['error_string'][] = form_error('url');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		
		$data = array(
				'judul' => $this->input->post('judul_video'),
				'id_ustad' => $this->input->post('ustad'),
				'url' => $this->input->post('url'),
				'deskripsi' => $this->input->post('deskripsi'),
			);
		$this->video->update(array('id_video' => $this->input->post('id_video')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_video)
	{
		$this->video->delete($id_video);
		echo json_encode(array("status" => TRUE));
	}

	//mobile
	public function tampil($limit, $offset){
        /*$data = $this->video->tampil($limit, $offset);
        echo json_encode($data);*/
    }

    public function tampil_perjenisvideo($limit, $offset, $id_jenisvideo){
        /*$data = $this->video->tampil_perjenisvideo($limit, $offset, $id_jenisvideo);
        echo json_encode($data);*/
    }

}

?>