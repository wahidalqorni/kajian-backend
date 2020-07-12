<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Kota extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kota_model','kota');
	}

	public function index() {
		$this->login->isLoggedIn();
		$data = array('title' => 'Kota/Kabupaten',
					  'isi'   => 'kota_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->kota->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kota) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kota->nama_kota_kab;

			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$kota->id_kota_kab."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$kota->id_kota_kab."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kota->count_all(),
						"recordsFiltered" => $this->kota->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_kota)
	{
		
		$data = $this->kota->get($id_kota);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'kota',
			'label' => 'Kota',
			'rules' => 'required|is_unique[kota_kab.nama_kota_kab]',
			'errors' => array(
			        'required' => 'kota tidak boleh kosong !',
			        'is_unique' => 'kota ini sudah ada !',
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
			if(form_error('kota')!=''){
				$data['inputerror'][] = 'kota';
				$data['error_string'][] = form_error('kota');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$data = array(
				'id_kota_kab'  =>$this->kota->getkodekota(),
				'nama_kota_kab' => $this->input->post('kota'),
			);
		$insert = $this->kota->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
        array(
			'field' => 'kota',
			'label' => 'kota',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'kota produk tidak boleh kosong !',
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
			if(form_error('kota')!=''){
				$data['inputerror'][] = 'kota';
				$data['error_string'][] = form_error('kota');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$data = array(
				'nama_kota_kab' => $this->input->post('kota'),
			);
		$this->kota->update(array('id_kota_kab' => $this->input->post('id_kota')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_kota)
	{
		$this->kota->delete($id_kota);
		echo json_encode(array("status" => TRUE));
	}

	// Mobile
	public function tampil(){
        $data = $this->kota->tampil();
        echo json_encode($data);
    }

}

?>