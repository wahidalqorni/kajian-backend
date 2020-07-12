<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model','user');
	}

	public function index()
	{
		$this->login->isLoggedIn();
		$data = array('title' => 'Jamaah',
					  'isi'   => 'user_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function tampil() {
		$this->login->isLoggedIn();
		$data = array('title' => 'Jamaah',
					  'isi'   => 'user_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->user->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $user->nama;
			$row[] = $user->alamat;
			$row[] = $user->email;
			$row[] = $user->jk;
			//$row[] = ''.$user->tempat_lahir.', '.date('d-m-Y', strtotime($user->tgl_lahir)).'';
			$row[] = $user->status;
			//$row[] = $user->level;
			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$user->id_user."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$user->id_user."'".')"><i class="fa fa-trash"></i></a>';
				  /*<a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Password" onclick="password('."'".$user->id_user."'".')"><i class="fa fa-trash"></i></a>';*/
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->user->count_all(),
						"recordsFiltered" => $this->user->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_user)
	{
		
		$data = $this->user->get($id_user);
		echo json_encode($data);
	}

	public function password($id_user)
	{
		
		$data = $this->user->get($id_user);
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
			                'rules' => 'required|is_unique[user.email]|valid_email',
			                'errors' => array(
			                        'required' => 'Email tidak boleh kosong !',
			                        'is_unique' => 'Email ini sudah terdaftar !',
			                        'valid_email' => 'Masukan email yang benar !',
		                		),
		           			),
        				array(
			                'field' => 'password',
			                'label' => 'Password',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Password tidak boleh kosong ! !',
		                		),
		           			),
        				array(
			                'field' => 'password2',
			                'label' => 'Ulangi Password',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Masukan kembali password !',
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
			                'label' => 'Status',
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
				'id_user' => $this->user->getkode(),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'jk' => $this->input->post('jk'),
				'no_hp' => $this->input->post('hp'),
				'status' => $this->input->post('status_akun'),
				
			);
		$insert = $this->user->save($data);
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
        				/*array(
			                'field' => 'email',
			                'label' => 'Email',
			                'rules' => 'required|is_unique[user.email]|valid_email',
			                'errors' => array(
			                        'required' => 'Email tidak boleh kosong !',
			                        'is_unique' => 'Email ini sudah terdaftar !',
			                        'valid_email' => 'Masukan email yang benar !',
		                		),
		           			),
        				array(
			                'field' => 'password',
			                'label' => 'Password',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Password tidak boleh kosong ! !',
		                		),
		           			),
        				array(
			                'field' => 'password2',
			                'label' => 'Ulangi Password',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Masukan kembali password !',
		                		),
		           			),*/
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
			                'label' => 'Status',
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
		/*$pw = $this->input->post('password');
		$ver = $this->input->post('password2');
		if ( $pw != '' && $ver !='') {
			if ($pw != $ver) {
				$data['inputerror'][] = 'password2';
				$data['error_string'][] = 'Password tidak cocok !';
				$data['status'] = FALSE;
			}
		}*/

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
				'password' => md5($this->input->post('password')),
				'jk' => $this->input->post('jk'),
				'no_hp' => $this->input->post('hp'),
				'status' => $this->input->post('status_akun'),
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
		$this->user->update(array('id_user' => $this->input->post('id_user')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_user)
	{
		$this->user->delete($id_user);
		echo json_encode(array("status" => TRUE));
	}

	// Mobile

	public function get_kode_register() {
        $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
            $request = json_decode($postdata);
            $angka=range(0,9); 
            shuffle($angka); 
            $ambilangka=array_rand($angka,6);
            $angkastring=implode("",$ambilangka); 
            $code=$angkastring;
            $jumlah = $this->user->cek_email($request->email);
            if ($jumlah == 0) {
                $data = array(
                    'email' => $request->email,
                    'kode' => $code,
                    'tanggal' => date('Y-m-d H:i:s'),
                );
                $this->user->get_kode_register($data);
            } else {
                $data = array(
                    'kode' => $code,
                    'tanggal' => date('Y-m-d H:i:s'),
                );
                $this->user->update_kode_register(array('email' => $request->email), $data);
            }
            $msg = "Pelanggan Yang Terhormat Berikut Kode Verifikasi Anda : $code";
            $msg = wordwrap($msg,70);
            $headers = "From: synapticlinda@gmail.com";
            mail($request->email,"Linda Kosmetik", $msg, $headers);
            echo json_encode(array("status" => TRUE));
        }
        else {
            echo "Not called properly with data parameter!";
        }
    }

    public function register()
    {
        $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
            $request = json_decode($postdata);
            $data = array(
				'id_user' => $this->user->getkode(),
				'email' => $request->email,
				'password' => md5($request->password),
				'nama' => $request->nama,
				'tempat_lahir' => $request->tempat_lahir,
				'tgl_lahir' => $request->tgl_lahir,
				'hp' => $request->hp,
				'token_id' => '',
			);
			$insert = $this->user->save($data);
            echo json_encode(array("status" => TRUE));
        }
        else {
            echo "Not called properly with data parameter!";
        }
    }

    public function update_profil()
    {
        $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
            $request = json_decode($postdata);
            $data = array(
				'nama' => $this->input->post('nama'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'hp' => $this->input->post('hp'),
			);
			$this->user->update(array('id_user' => $this->input->post('id_user')), $data);
            echo json_encode(array("status" => TRUE));
        }
        else {
            echo "Not called properly with data parameter!";
        }
    }

    public function login(){
        $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
            $request = json_decode($postdata);
            $jumlah = $this->user->login($request->email, $request->password);
            $data = array(
                'token_id' => $request->token_id,
            );
            $this->user->update(array('email' => $request->email), $data);
            echo json_encode(array("jumlah" => $jumlah));
        }
        else {
            echo "Not called properly with data parameter!";
        }
    }

    public function cek_kode(){
        $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
            $request = json_decode($postdata);
            $jumlah = $this->user->cek_kode($request->email, $request->kode);
            echo json_encode(array("jumlah" => $jumlah));
        }
        else {
            echo "Not called properly with data parameter!";
        }
    }

    public function ganti_password(){
        $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
            $request = json_decode($postdata);
            $data = array(
                    'password' => md5($request->password),
            );
            $this->user->update(array('email' => $request->email), $data);
            echo json_encode(array("status" => TRUE));
        }
        else {
            echo "Not called properly with data parameter!";
        }
    }

    public function cek_cus(){
        $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
            $request = json_decode($postdata);
            $jumlah = $this->user->cek_cus($request->email);
            echo json_encode(array("jumlah" => $jumlah));
        }
        else {
            echo "Not called properly with data parameter!";
        }
    }

     public function get_cus(){
            $postdata = file_get_contents("php://input");
            if (isset($postdata)) {
                $request = json_decode($postdata);
                $data = $this->user->get_cus($request->email);
                echo json_encode($data);
            }
            else {
                echo "Not called properly with data parameter!";
            }
        }

}

?>