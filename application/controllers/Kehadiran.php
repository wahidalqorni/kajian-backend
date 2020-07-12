<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Kehadiran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kehadiran_model','kehadiran');
		$this->load->model('User_model','user');
		$this->load->model('Jadwal_model','jadwal');
	}

	public function index() {
		$this->login->isLoggedIn();
		$user = $this->user->tampil();
		$jadwal = $this->jadwal->tampil();
		$data = array('title' => 'Kehadiran',
					  'user' => $user,
					  'jadwal' => $jadwal,
					  'isi'   => 'kehadiran_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->kehadiran->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kehadiran) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kehadiran->nama;
			$row[] = $kehadiran->judul_kajian;
			$row[] = $kehadiran->konfirmasi;
			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$kehadiran->id_konfir."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$kehadiran->id_konfir."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kehadiran->count_all(),
						"recordsFiltered" => $this->kehadiran->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_kehadiran)
	{
		$data = $this->kehadiran->get($id_kehadiran);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'id_user',
			'label' => 'User',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'User tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'id_jadwal',
			'label' => 'Kajian',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Kajian tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'konfirmasi',
			'label' => 'Konfirmasi',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Konfirmasi tidak boleh kosong !',
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
			if(form_error('id_user')!=''){
				$data['inputerror'][] = 'id_user';
				$data['error_string'][] = form_error('id_user');
				$data['status'] = FALSE;
			}
			if(form_error('id_jadwal')!=''){
				$data['inputerror'][] = 'id_jadwal';
				$data['error_string'][] = form_error('id_jadwal');
				$data['status'] = FALSE;
			}
			if(form_error('konfirmasi')!=''){
				$data['inputerror'][] = 'konfirmasi';
				$data['error_string'][] = form_error('konfirmasi');
				$data['status'] = FALSE;
			}
			
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		} 
		
		$data = array(
				'id_konfir' => $this->kehadiran->getkode(),
				'id_user' => $this->input->post('id_user'),
				'id_jadwal' => $this->input->post('id_jadwal'),
				'konfirmasi' => $this->input->post('konfirmasi'),
			);
		$insert = $this->kehadiran->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
        array(
			'field' => 'id_user',
			'label' => 'User',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'User tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'id_jadwal',
			'label' => 'Kajian',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Kajian tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'konfirmasi',
			'label' => 'Konfirmasi',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Konfirmasi tidak boleh kosong !',
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
			if(form_error('id_user')!=''){
				$data['inputerror'][] = 'id_user';
				$data['error_string'][] = form_error('id_user');
				$data['status'] = FALSE;
			}
			if(form_error('id_jadwal')!=''){
				$data['inputerror'][] = 'id_jadwal';
				$data['error_string'][] = form_error('id_jadwal');
				$data['status'] = FALSE;
			}
			if(form_error('konfirmasi')!=''){
				$data['inputerror'][] = 'konfirmasi';
				$data['error_string'][] = form_error('konfirmasi');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

		$data = array(
				'id_user' => $this->input->post('id_user'),
				'id_jadwal' => $this->input->post('id_jadwal'),
				'konfirmasi' => $this->input->post('konfirmasi'),
			);
		$this->kehadiran->update(array('id_konfir' => $this->input->post('id_kehadiran')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_kehadiran)
	{
		$this->kehadiran->delete($id_kehadiran);
		echo json_encode(array("status" => TRUE));
	}

	//mobile
	public function tampil($limit, $offset){
        /*$data = $this->kehadiran->tampil($limit, $offset);
        echo json_encode($data);*/
    }

    public function tampil_perkota($limit, $offset, $id_kota){
        /*$data = $this->kehadiran->tampil_perkota($limit, $offset, $id_kota);
        echo json_encode($data);*/
    }

}

?>