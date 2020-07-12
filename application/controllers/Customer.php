<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Customer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Customer_model','customer');
	}

	public function index()
	{
		$this->login->isLoggedIn();
		$data = array('title' => 'Customer Linda Kosmetik',
					  'isi'   => 'customer_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function tampil() {
		$this->login->isLoggedIn();
		$data = array('title' => 'Customer Linda Kosmetik',
					  'isi'   => 'customer_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->customer->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customer) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $customer->email;
			$row[] = $customer->nama;
			$row[] = ''.$customer->tempat_lahir.', '.date('d-m-Y', strtotime($customer->tgl_lahir)).'';
			$row[] = $customer->hp;

			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$customer->id_customer."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$customer->id_customer."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->customer->count_all(),
						"recordsFiltered" => $this->customer->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_customer)
	{
		
		$data = $this->customer->get($id_customer);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        				array(
			                'field' => 'email',
			                'label' => 'Email',
			                'rules' => 'required|is_unique[customer.email]|valid_email',
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
			                'field' => 'nama',
			                'label' => 'Nama Lengkap',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Nama tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'tempat_lahir',
			                'label' => 'Tempat Lahir',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Tempat Lahir tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'tgl_lahir',
			                'label' => 'Tanggal Lahir',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Tanggal Lahir tidak boleh kosong !',
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
		);
		$this->form_validation->set_rules($config);
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->form_validation->run()===FALSE)
		{
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
			if(form_error('nama')!=''){
				$data['inputerror'][] = 'nama';
				$data['error_string'][] = form_error('nama');
				$data['status'] = FALSE;
			}
			if(form_error('tempat_lahir')!=''){
				$data['inputerror'][] = 'tempat_lahir';
				$data['error_string'][] = form_error('tempat_lahir');
				$data['status'] = FALSE;
			}
			if(form_error('tempat_lahir')!=''){
				$data['inputerror'][] = 'tempat_lahir';
				$data['error_string'][] = form_error('tempat_lahir');
				$data['status'] = FALSE;
			}
			if(form_error('tgl_lahir')!=''){
				$data['inputerror'][] = 'tgl_lahir';
				$data['error_string'][] = form_error('tgl_lahir');
				$data['status'] = FALSE;
			}
			if(form_error('hp')!=''){
				$data['inputerror'][] = 'hp';
				$data['error_string'][] = form_error('hp');
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
				'id_customer' => $this->customer->getkode(),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'nama' => $this->input->post('nama'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'hp' => $this->input->post('hp'),
			);
		$insert = $this->customer->save($data);
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
			                'field' => 'tempat_lahir',
			                'label' => 'Tempat Lahir',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Tempat Lahir tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'tgl_lahir',
			                'label' => 'Tanggal Lahir',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Tanggal Lahir tidak boleh kosong !',
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
			if(form_error('tempat_lahir')!=''){
				$data['inputerror'][] = 'password';
				$data['error_string'][] = form_error('tempat_lahir');
				$data['status'] = FALSE;
			}
			if(form_error('tempat_lahir')!=''){
				$data['inputerror'][] = 'tempat_lahir';
				$data['error_string'][] = form_error('tempat_lahir');
				$data['status'] = FALSE;
			}
			if(form_error('tgl_lahir')!=''){
				$data['inputerror'][] = 'tgl_lahir';
				$data['error_string'][] = form_error('tgl_lahir');
				$data['status'] = FALSE;
			}
			if(form_error('hp')!=''){
				$data['inputerror'][] = 'hp';
				$data['error_string'][] = form_error('hp');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$data = array(
				'nama' => $this->input->post('nama'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'hp' => $this->input->post('hp'),
			);
		$this->customer->update(array('id_customer' => $this->input->post('id_customer')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_customer)
	{
		$this->customer->delete($id_customer);
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
            $jumlah = $this->customer->cek_email($request->email);
            if ($jumlah == 0) {
                $data = array(
                    'email' => $request->email,
                    'kode' => $code,
                    'tanggal' => date('Y-m-d H:i:s'),
                );
                $this->customer->get_kode_register($data);
            } else {
                $data = array(
                    'kode' => $code,
                    'tanggal' => date('Y-m-d H:i:s'),
                );
                $this->customer->update_kode_register(array('email' => $request->email), $data);
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
				'id_customer' => $this->customer->getkode(),
				'email' => $request->email,
				'password' => md5($request->password),
				'nama' => $request->nama,
				'tempat_lahir' => $request->tempat_lahir,
				'tgl_lahir' => $request->tgl_lahir,
				'hp' => $request->hp,
				'token_id' => '',
			);
			$insert = $this->customer->save($data);
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
			$this->customer->update(array('id_customer' => $this->input->post('id_customer')), $data);
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
            $jumlah = $this->customer->login($request->email, $request->password);
            $data = array(
                'token_id' => $request->token_id,
            );
            $this->customer->update(array('email' => $request->email), $data);
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
            $jumlah = $this->customer->cek_kode($request->email, $request->kode);
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
            $this->customer->update(array('email' => $request->email), $data);
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
            $jumlah = $this->customer->cek_cus($request->email);
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
                $data = $this->customer->get_cus($request->email);
                echo json_encode($data);
            }
            else {
                echo "Not called properly with data parameter!";
            }
        }

}

?>