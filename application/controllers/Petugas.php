<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Petugas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Petugas_model','petugas');
	}

	public function index()
	{
		$this->login->isLoggedIn();
		$data = array('title' => 'Kajian Sunnah Sumsel',
					  'isi'   => 'layout/beranda');
		$this->load->view('layout/wrapper',$data);
	}

	public function tampil() {
		$this->login->isLoggedIn();
		$data = array('title' => 'Kajian Sunnah Sumsel|Petugas',
					  'isi'   => 'petugas_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->petugas->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $petugas) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $petugas->nama;
			$row[] = $petugas->alamat;
			//$row[] = ''.$petugas->tempat_lahir.', '.date('d-m-Y', strtotime($petugas->tgl_lahir)).'';
			$row[] = $petugas->email;
			$row[] = $petugas->no_hp;
			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$petugas->id_admin."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$petugas->id_admin."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->petugas->count_all(),
						"recordsFiltered" => $this->petugas->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_petugas)
	{
		
		$data = $this->petugas->get($id_petugas);
		echo json_encode($data);
	}

	public function tambah()
	{
		
		$config = array(
						array(
			                'field' => 'nama',
			                'label' => 'Nama Lengkap',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Nama tidak boleh kosong !',
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
			                'field' => 'email',
			                'label' => 'Email',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Email tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'password',
			                'label' => 'Password',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Password tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'password2',
			                'label' => 'Ulangi Password',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Masukkan Kembali Password !',
		                		),
		           			),
        				array(
			                'field' => 'jk',
			                'label' => 'Jenis Kelamin',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Jenis Kelamin tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'hp',
			                'label' => 'Handphone',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Nomor handphone tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'status_akun',
			                'label' => 'Status Akun',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Status Akun tidak boleh kosong !',
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
			if(form_error('nama')!=''){
				$data['inputerror'][] = 'nama';
				$data['error_string'][] = form_error('nama');
				$data['status'] = FALSE;
			}
			if(form_error('alamat')!=''){
				$data['inputerror'][] = 'alamat';
				$data['error_string'][] = form_error('alamat');
				$data['status'] = FALSE;
			}
			if(form_error('email')!=''){
				$data['inputerror'][] = 'email';
				$data['error_string'][] = form_error('email');
				$data['status'] = FALSE;
			}
			if(form_error('password')!=''){
				$data['inputerror'][] = 'password';
				$data['error_string'][] = form_error('password');
				$data['status'] = FALSE;
			}
			if(form_error('password2')!=''){
				$data['inputerror'][] = 'password2';
				$data['error_string'][] = form_error('password2');
				$data['status'] = FALSE;
			}
			if(form_error('jk')!=''){
				$data['inputerror'][] = 'jk';
				$data['error_string'][] = form_error('jk');
				$data['status'] = FALSE;
			}
			if(form_error('hp')!=''){
				$data['inputerror'][] = 'hp';
				$data['error_string'][] = form_error('hp');
				$data['status'] = FALSE;
			}
			if(form_error('status_akun')!=''){
				$data['inputerror'][] = 'status_akun';
				$data['error_string'][] = form_error('status_akun');
				$data['status'] = FALSE;
			}
			
		}

		$pw = $this->input->post('password');
		$ver = $this->input->post('password2');
		if ( $pw != '' && $ver !='') {
			if ($pw != $ver) {
				$data['inputerror'][] = 'password2';
				$data['error_string'][] = 'Password tidak cocok !';
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$data = array(
				'id_admin' => $this->petugas->getkode(),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'jk' => $this->input->post('jk'),
				'no_hp' => $this->input->post('hp'),
				'status' => $this->input->post('status_akun'),
			);
		$insert = $this->petugas->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
				$config = array(
        				array(
			                'field' => 'nama',
			                'label' => 'Nama Lengkap',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Nama tidak boleh kosong !',
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
			                'field' => 'email',
			                'label' => 'Email',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Email tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'jk',
			                'label' => 'Jenis Kelamin',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Jenis Kelamin tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'hp',
			                'label' => 'Handphone',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Nomor handphone tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'status_akun',
			                'label' => 'Status Akun',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Status Akun tidak boleh kosong !',
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
			if(form_error('nama')!=''){
				$data['inputerror'][] = 'nama';
				$data['error_string'][] = form_error('nama');
				$data['status'] = FALSE;
			}
			if(form_error('alamat')!=''){
				$data['inputerror'][] = 'alamat';
				$data['error_string'][] = form_error('alamat');
				$data['status'] = FALSE;
			}
			if(form_error('email')!=''){
				$data['inputerror'][] = 'email';
				$data['error_string'][] = form_error('email');
				$data['status'] = FALSE;
			}
			if(form_error('jk')!=''){
				$data['inputerror'][] = 'jk';
				$data['error_string'][] = form_error('jk');
				$data['status'] = FALSE;
			}
			if(form_error('hp')!=''){
				$data['inputerror'][] = 'hp';
				$data['error_string'][] = form_error('hp');
				$data['status'] = FALSE;
			}
			if(form_error('status_akun')!=''){
				$data['inputerror'][] = 'status_akun';
				$data['error_string'][] = form_error('status_akun');
				$data['status'] = FALSE;
			}
		}
		$pw = $this->input->post('password');
		$ver = $this->input->post('password2');
		if ( $pw != '' && $ver !='') {
			if ($pw != $ver) {
				$data['inputerror'][] = 'password2';
				$data['error_string'][] = 'Password tidak cocok !';
				$data['status'] = FALSE;
			}
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$password = $this->input->post('password');
		if($password != ''){
			$data = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'email' => $this->input->post('email'),
				'jk' => $this->input->post('jk'),
				'no_hp' => $this->input->post('hp'),
				'status' => $this->input->post('status_akun'),
				'password' => md5($this->input->post('password')),
			);
		} else {
			$data = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'email' => $this->input->post('email'),
				'jk' => $this->input->post('jk'),
				'no_hp' => $this->input->post('hp'),
				'status' => $this->input->post('status_akun'),
			);
		
		}
		
		$this->petugas->update(array('id_admin' => $this->input->post('id_admin')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_petugas)
	{
		$this->petugas->delete($id_petugas);
		echo json_encode(array("status" => TRUE));
	}

}

?>