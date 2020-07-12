<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Kecamatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kecamatan_model','kecamatan');
		$this->load->model('Kota_model','kota');
	}

	public function index() {
		$this->login->isLoggedIn();
		$kota = $this->kota->tampil();
		$data = array('title' => 'Kecamatan',
					  'kota' => $kota,
					  'isi'   => 'kecamatan_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->kecamatan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kecamatan) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kecamatan->nama_kota_kab;
			$row[] = $kecamatan->nama_kecamatan;
			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$kecamatan->id_kecamatan."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$kecamatan->id_kecamatan."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kecamatan->count_all(),
						"recordsFiltered" => $this->kecamatan->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_kecamatan)
	{
		$data = $this->kecamatan->get($id_kecamatan);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'id_kota',
			'label' => 'kota kecamatan',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'kota kecamatan tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'nama_kecamatan',
			'label' => 'Nama kecamatan',
			'rules' => 'required|is_unique[kecamatan.nama_kecamatan]',
			'errors' => array(
			        'required' => 'Nama kecamatan tidak boleh kosong !',
			        'is_unique' => 'Nama Kecamatan sudah ada!',
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
			if(form_error('id_kota')!=''){
				$data['inputerror'][] = 'id_kota';
				$data['error_string'][] = form_error('id_kota');
				$data['status'] = FALSE;
			}
			if(form_error('nama_kecamatan')!=''){
				$data['inputerror'][] = 'nama_kecamatan';
				$data['error_string'][] = form_error('nama_kecamatan');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		
		$data = array(
				'id_kecamatan' => $this->kecamatan->getkodekec(),
				'id_kota_kab' => $this->input->post('id_kota'),
				'nama_kecamatan' => $this->input->post('nama_kecamatan'),
			);
		$insert = $this->kecamatan->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
        array(
			'field' => 'id_kota',
			'label' => 'kota kecamatan',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'kota kecamatan tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'nama_kecamatan',
			'label' => 'Nama kecamatan',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama kecamatan tidak boleh kosong !',
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
			if(form_error('id_kota')!=''){
				$data['inputerror'][] = 'id_kota';
				$data['error_string'][] = form_error('id_kota');
				$data['status'] = FALSE;
			}
			if(form_error('nama_kecamatan')!=''){
				$data['inputerror'][] = 'nama_kecamatan';
				$data['error_string'][] = form_error('nama_kecamatan');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		
		$data = array(
				'id_kota_kab' => $this->input->post('id_kota'),
				'nama_kecamatan' => $this->input->post('nama_kecamatan'),
			);
		$this->kecamatan->update(array('id_kecamatan' => $this->input->post('id_kecamatan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_kecamatan)
	{
		$this->kecamatan->delete($id_kecamatan);
		echo json_encode(array("status" => TRUE));
	}

	//mobile
	public function tampil($limit, $offset){
        /*$data = $this->kecamatan->tampil($limit, $offset);
        echo json_encode($data);*/
    }

    public function tampil_perkota($limit, $offset, $id_kota){
        /*$data = $this->kecamatan->tampil_perkota($limit, $offset, $id_kota);
        echo json_encode($data);*/
    }

}

?>