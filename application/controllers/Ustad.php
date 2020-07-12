<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Ustad extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ustad_model','ustad');
	}

	public function index() {
		$this->login->isLoggedIn();
		$data = array('title' => 'Ustad',
					  'isi'   => 'ustad_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->ustad->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $ustad) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $ustad->nama_ustad;
			$row[] = $ustad->alamat;
			$row[] = $ustad->no_hp;
			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$ustad->id_ustad."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$ustad->id_ustad."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ustad->count_all(),
						"recordsFiltered" => $this->ustad->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_ustad)
	{
		
		$data = $this->ustad->get($id_ustad);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'nama_ustad',
			'label' => 'Nama Ustad',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama Ustad tidak boleh kosong !',			       
		            ),
		    ),
        /*array(
			'field' => 'tgl_lahir',
			'label' => 'Tanggal Lahir',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Tanggal Lahir tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'tpt_lahir',
			'label' => 'Tempat Lahir',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Tempat Lahir tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'pendidikan',
			'label' => 'Pendidikan Terakhir',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Pendidikan Terakhir tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'universitas',
			'label' => 'Universitas',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Universitas tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'alamat',
			'label' => 'Alamat',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Alamat tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'no_hp',
			'label' => 'No HP',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'No HP tidak boleh kosong !',			       
		            ),
		    ),*/
        
		);

		$this->form_validation->set_rules($config);
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->form_validation->run()===FALSE)
		{
			if(form_error('nama_ustad')!=''){
				$data['inputerror'][] = 'nama_ustad';
				$data['error_string'][] = form_error('nama_ustad');
				$data['status'] = FALSE;
			}
			/*if(form_error('tgl_lahir')!=''){
				$data['inputerror'][] = 'tgl_lahir';
				$data['error_string'][] = form_error('tgl_lahir');
				$data['status'] = FALSE;
			}
			if(form_error('tpt_lahir')!=''){
				$data['inputerror'][] = 'tpt_lahir';
				$data['error_string'][] = form_error('tpt_lahir');
				$data['status'] = FALSE;
			}
			if(form_error('pendidikan')!=''){
				$data['inputerror'][] = 'pendidikan';
				$data['error_string'][] = form_error('pendidikan');
				$data['status'] = FALSE;
			}
			if(form_error('universitas')!=''){
				$data['inputerror'][] = 'universitas';
				$data['error_string'][] = form_error('universitas');
				$data['status'] = FALSE;
			}
			if(form_error('alamat')!=''){
				$data['inputerror'][] = 'alamat';
				$data['error_string'][] = form_error('alamat');
				$data['status'] = FALSE;
			}
			if(form_error('no_hp')!=''){
				$data['inputerror'][] = 'no_hp';
				$data['error_string'][] = form_error('no_hp');
				$data['status'] = FALSE;
			}*/
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$data = array(
				'id_ustad'  =>$this->ustad->getkodeustad(),
				'nama_ustad' => $this->input->post('nama_ustad'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'tpt_lahir' => $this->input->post('tpt_lahir'),
				'pendidkan' => $this->input->post('pendidikan'),
				'universitas' => $this->input->post('universitas'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_hp'),

			);
		$insert = $this->ustad->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
        	array(
			'field' => 'nama_ustad',
			'label' => 'Nama Ustad',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama Ustad tidak boleh kosong !',			       
		            ),
		    ),
        /*array(
			'field' => 'tgl_lahir',
			'label' => 'Tanggal Lahir',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Tanggal Lahir tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'tpt_lahir',
			'label' => 'Tempat Lahir',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Tempat Lahir tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'pendidikan',
			'label' => 'Pendidikan Terakhir',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Pendidikan Terakhir tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'universitas',
			'label' => 'Universitas',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Universitas tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'alamat',
			'label' => 'Alamat',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Alamat tidak boleh kosong !',			       
		            ),
		    ),
        array(
			'field' => 'no_hp',
			'label' => 'No HP',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'No HP tidak boleh kosong !',			       
		            ),
		    ),*/
       
		);
		$this->form_validation->set_rules($config);
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->form_validation->run()===FALSE)
		{
			if(form_error('nama_ustad')!=''){
				$data['inputerror'][] = 'nama_ustad';
				$data['error_string'][] = form_error('nama_ustad');
				$data['status'] = FALSE;
			}
			/*if(form_error('tgl_lahir')!=''){
				$data['inputerror'][] = 'tgl_lahir';
				$data['error_string'][] = form_error('tgl_lahir');
				$data['status'] = FALSE;
			}
			if(form_error('tpt_lahir')!=''){
				$data['inputerror'][] = 'tpt_lahir';
				$data['error_string'][] = form_error('tpt_lahir');
				$data['status'] = FALSE;
			}
			if(form_error('pendidikan')!=''){
				$data['inputerror'][] = 'pendidikan';
				$data['error_string'][] = form_error('pendidikan');
				$data['status'] = FALSE;
			}
			if(form_error('universitas')!=''){
				$data['inputerror'][] = 'universitas';
				$data['error_string'][] = form_error('universitas');
				$data['status'] = FALSE;
			}
			if(form_error('alamat')!=''){
				$data['inputerror'][] = 'alamat';
				$data['error_string'][] = form_error('alamat');
				$data['status'] = FALSE;
			}
			if(form_error('no_hp')!=''){
				$data['inputerror'][] = 'no_hp';
				$data['error_string'][] = form_error('no_hp');
				$data['status'] = FALSE;
			}*/
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$data = array(
				'nama_ustad' => $this->input->post('nama_ustad'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'tpt_lahir' => $this->input->post('tpt_lahir'),
				'pendidkan' => $this->input->post('pendidikan'),
				'universitas' => $this->input->post('universitas'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_hp'),
			);
		$this->ustad->update(array('id_ustad' => $this->input->post('id_ustad')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_ustad)
	{
		$this->ustad->delete($id_ustad);
		echo json_encode(array("status" => TRUE));
	}

	// Mobile
	public function tampil(){
        $data = $this->ustad->tampil();
        echo json_encode($data);
    }

}

?>