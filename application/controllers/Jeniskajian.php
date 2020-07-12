<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Jeniskajian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jeniskajian_model','jeniskajian');
	}

	public function index() {
		$this->login->isLoggedIn();
		$data = array('title' => 'Jenis Kajian',
					  'isi'   => 'jeniskajian_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->jeniskajian->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $jeniskajian) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $jeniskajian->jenis_kajian;

			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$jeniskajian->id_jenis_kajian."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$jeniskajian->id_jenis_kajian."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->jeniskajian->count_all(),
						"recordsFiltered" => $this->jeniskajian->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_jeniskajian)
	{
		
		$data = $this->jeniskajian->get($id_jeniskajian);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'jeniskajian',
			'label' => 'jeniskajian',
			'rules' => 'required|is_unique[jenis_kajian.jenis_kajian]',
			'errors' => array(
			        'required' => 'Jenis kajian tidak boleh kosong !',
			        'is_unique' => 'Jenis kajian ini sudah ada !',
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
			if(form_error('jeniskajian')!=''){
				$data['inputerror'][] = 'jeniskajian';
				$data['error_string'][] = form_error('jeniskajian');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$data = array(
				'id_jenis_kajian'  =>$this->jeniskajian->getkodejeniskajian(),
				'jenis_kajian' => $this->input->post('jeniskajian'),
			);
		$insert = $this->jeniskajian->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
        array(
			'field' => 'jeniskajian',
			'label' => 'jeniskajian',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'jeniskajian produk tidak boleh kosong !',
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
			if(form_error('jeniskajian')!=''){
				$data['inputerror'][] = 'jeniskajian';
				$data['error_string'][] = form_error('jeniskajian');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$data = array(
				'jenis_kajian' => $this->input->post('jeniskajian'),
			);
		$this->jeniskajian->update(array('id_jenis_kajian' => $this->input->post('id_jeniskajian')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_jeniskajian)
	{
		$this->jeniskajian->delete($id_jeniskajian);
		echo json_encode(array("status" => TRUE));
	}

	// Mobile
	public function tampil(){
        $data = $this->jeniskajian->tampil();
        echo json_encode($data);
    }

}

?>