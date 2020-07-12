<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Kajian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kajian_model','kajian');
		$this->load->model('Jeniskajian_model','jeniskajian');
	}

	public function index() {
		$this->login->isLoggedIn();
		$jeniskajian = $this->jeniskajian->tampil();
		$data = array('title' => 'Kajian',
					  'jeniskajian' => $jeniskajian,
					  'isi'   => 'kajian_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->kajian->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kajian) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kajian->jenis_kajian;
			$row[] = $kajian->judul_kajian;
			$row[] = $kajian->deskripsi;
			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$kajian->id_kajian."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$kajian->id_kajian."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kajian->count_all(),
						"recordsFiltered" => $this->kajian->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_kajian)
	{
		$data = $this->kajian->get($id_kajian);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'id_jeniskajian',
			'label' => 'jeniskajian kajian',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'jenis kajian kajian tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'judul_kajian',
			'label' => 'Judul kajian',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama kajian tidak boleh kosong !',
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
			if(form_error('id_jeniskajian')!=''){
				$data['inputerror'][] = 'id_jeniskajian';
				$data['error_string'][] = form_error('id_jeniskajian');
				$data['status'] = FALSE;
			}
			if(form_error('judul_kajian')!=''){
				$data['inputerror'][] = 'judul_kajian';
				$data['error_string'][] = form_error('judul_kajian');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		
		$data = array(
				'id_kajian' => $this->kajian->getkodekec(),
				'id_jenis_kajian' => $this->input->post('id_jeniskajian'),
				'judul_kajian' => $this->input->post('judul_kajian'),
				'deskripsi' => $this->input->post('deskripsi'),
			);
		$insert = $this->kajian->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
        array(
			'field' => 'id_jeniskajian',
			'label' => 'jeniskajian kajian',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'jeniskajian kajian tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'judul_kajian',
			'label' => 'Nama kajian',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama kajian tidak boleh kosong !',
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
			if(form_error('id_jeniskajian')!=''){
				$data['inputerror'][] = 'id_jeniskajian';
				$data['error_string'][] = form_error('id_jeniskajian');
				$data['status'] = FALSE;
			}
			if(form_error('judul_kajian')!=''){
				$data['inputerror'][] = 'judul_kajian';
				$data['error_string'][] = form_error('judul_kajian');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		
		$data = array(
				'id_jenis_kajian' => $this->input->post('id_jeniskajian'),
				'judul_kajian' => $this->input->post('judul_kajian'),
				'deskripsi' => $this->input->post('deskripsi'),
			);
		$this->kajian->update(array('id_kajian' => $this->input->post('id_kajian')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_kajian)
	{
		$this->kajian->delete($id_kajian);
		echo json_encode(array("status" => TRUE));
	}

	//mobile
	public function tampil($limit, $offset){
        /*$data = $this->kajian->tampil($limit, $offset);
        echo json_encode($data);*/
    }

    public function tampil_perjeniskajian($limit, $offset, $id_jeniskajian){
        /*$data = $this->kajian->tampil_perjeniskajian($limit, $offset, $id_jeniskajian);
        echo json_encode($data);*/
    }

}

?>