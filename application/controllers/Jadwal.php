<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Jadwal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jadwal_model','jadwal');
		$this->load->model('Masjid_model','masjid');
		//$this->load->model('Masjid_model','masjid2');
		$this->load->model('Kelurahan_model','kelurahan');
		//$this->load->model('Kelurahan_model','kelurahan2');
		$this->load->model('Ustad_model','ustad');
		$this->load->model('Jeniskajian_model','jeniskajian');
	}

	public function index()
	{
		$this->login->isLoggedIn();
		$masjid = $this->masjid->tampil();
		//$masjid2 = $this->masjid2->tampildatamasjid();
		$kelurahan = $this->kelurahan->tampil();
		//$kelurahan2 = $this->kelurahan2->tampilkelurahanmasjid();
		$ustad = $this->ustad->tampil();
		$jeniskajian = $this->jeniskajian->tampil();
		$data = array('title' => 'Jadwal Kajian',
					  'kelurahan' => $kelurahan,
					  //'kelurahan' => $kelurahan2,
					  'masjid' => $masjid,
					  //'masjid2' => $masjid2,
					  'ustad' => $ustad,
					  'jeniskajian' => $jeniskajian,
					  'isi'   => 'jadwal_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function tampil() {
		$this->login->isLoggedIn();
		$data = array('title' => 'Jadwal Kajian',
					  'isi'   => 'jadwal_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->jadwal->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $jadwal) {
		    $waktu_kajian= date('l, d-m-Y', strtotime($jadwal->waktu_kajian));
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $jadwal->judul_kajian;
			$row[] = $jadwal->jenis_kajian;
			//$row[] = $jadwal->nama_masjid;
			$row[] = ''.$jadwal->nama_masjid.' || '.$jadwal->alamat.'';
			$row[] = $jadwal->nama_ustad;
			$row[] = $waktu_kajian;
			//$row[] = ''.$jadwal->tempat_lahir.', '.date('d-m-Y', strtotime($jadwal->tgl_lahir)).'';
			$row[] = $jadwal->kelompok;
			if ($jadwal->gambar != '') {
				$path = 'assets/uploads/jadwal/'.$jadwal->gambar.'';
				if(file_exists($path)){
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/jadwal/'.$jadwal->gambar.'">';
				} else {
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/jadwal/ngaji.jpg">';
				}
			} else {
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/jadwal/ngaji.jpg">';
			}
			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$jadwal->id_jadwal."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$jadwal->id_jadwal."'".')"><i class="fa fa-trash"></i></a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->jadwal->count_all(),
						"recordsFiltered" => $this->jadwal->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_jadwal)
	{
		
		$data = $this->jadwal->get($id_jadwal);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
						array(
			                'field' => 'judul_kajian',
			                'label' => 'Judul Kajian',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Judul Kajian tidak boleh kosong !',
		                		),
		           			),
						array(
			                'field' => 'jenis_kajian',
			                'label' => 'Jenis Kajian',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Jenis Kajian tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'masjid',
			                'label' => 'Masjid',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Masjid tidak boleh kosong ! !',
		                		),
		           			),
        				
        				array(
			                'field' => 'ustad',
			                'label' => 'Ustad',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Ustad tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'waktu_kajian',
			                'label' => 'Waktu Kajian',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Waktu Kajian tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'kelompok',
			                'label' => 'Kelompok',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Kelompok Akun tidak boleh kosong !',
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
			if(form_error('judul_kajian')!=''){
				$data['inputerror'][] = 'judul_kajian';
				$data['error_string'][] = form_error('judul_kajian');
				$data['status'] = FALSE;
			}
			if(form_error('jenis_kajian')!=''){
				$data['inputerror'][] = 'jenis_kajian';
				$data['error_string'][] = form_error('jenis_kajian');
				$data['status'] = FALSE;
			}
			if(form_error('masjid')!=''){
				$data['inputerror'][] = 'masjid';
				$data['error_string'][] = form_error('masjid');
				$data['status'] = FALSE;
			}
			if(form_error('ustad')!=''){
				$data['inputerror'][] = 'ustad';
				$data['error_string'][] = form_error('ustad');
				$data['status'] = FALSE;
			}
			if(form_error('waktu_kajian')!=''){
				$data['inputerror'][] = 'waktu_kajian';
				$data['error_string'][] = form_error('waktu_kajian');
				$data['status'] = FALSE;
			}
			
			if(form_error('kelompok')!=''){
				$data['inputerror'][] = 'kelompok';
				$data['error_string'][] = form_error('kelompok');
				$data['status'] = FALSE;
			}
		}
		
		$waktu_kajian = date('Y-m-d H:i', strtotime($this->input->post('waktu_kajian')));
		if ( $waktu_kajian < date("Y-m-d") ) {
				$data['inputerror'][] = 'waktu_kajian';
				$data['error_string'][] = 'Waktu Kajian Minimal Hari ini!';
				$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$nmfile = $this->jadwal->getkodejadwal();
		$config['upload_path'] = './assets/uploads/jadwal/'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['max_size'] = '10240'; 
		$config['max_width']  = '10240'; 
		$config['max_height']  = '10240'; 
		$config['file_name'] = $nmfile; 
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('gambar')){
			$gambar = '';
		} else {
			$gbr = $this->upload->data();
			$gambar = $gbr['file_name'];
		}
		$hariini = date("Ymd");
		$waktu_kajian = date('Y-m-d H:i', strtotime($this->input->post('waktu_kajian')));
		$data = array(
				'id_jadwal' => $this->jadwal->getkodejadwal(),
				'judul_kajian' => $this->input->post('judul_kajian'),
				'id_jenis_kajian' => $this->input->post('jenis_kajian'),
				'id_masjid' => $this->input->post('masjid'),
				'id_ustad' => $this->input->post('ustad'),
				'waktu_kajian' => $waktu_kajian,
				'bada' => $this->input->post('bada'),
				'tgl_upload' => $hariini,
				'deskripsi_kajian' => $this->input->post('deskripsi'),
				'kelompok' => $this->input->post('kelompok'),
				'gambar' => $gambar,
				'video_url' => $this->input->post('url_video'),

				
			);
		$insert = $this->jadwal->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
				$config = array(
        				array(
			                'field' => 'judul_kajian',
			                'label' => 'Judul Kajian',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Judul Kajian tidak boleh kosong !',
		                		),
		           			),
						array(
			                'field' => 'jenis_kajian',
			                'label' => 'Jenis Kajian',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Jenis Kajian tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'masjid',
			                'label' => 'Masjid',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Masjid tidak boleh kosong ! !',
		                		),
		           			),
        				
        				array(
			                'field' => 'ustad',
			                'label' => 'Ustad',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Ustad tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'waktu_kajian',
			                'label' => 'Waktu Kajian',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Waktu Kajian tidak boleh kosong !',
		                		),
		           			),
        				array(
			                'field' => 'kelompok',
			                'label' => 'Kelompok',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'Kelompok Akun tidak boleh kosong !',
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
			if(form_error('judul_kajian')!=''){
				$data['inputerror'][] = 'judul_kajian';
				$data['error_string'][] = form_error('judul_kajian');
				$data['status'] = FALSE;
			}
			if(form_error('jenis_kajian')!=''){
				$data['inputerror'][] = 'jenis_kajian';
				$data['error_string'][] = form_error('jenis_kajian');
				$data['status'] = FALSE;
			}
			if(form_error('masjid')!=''){
				$data['inputerror'][] = 'masjid';
				$data['error_string'][] = form_error('masjid');
				$data['status'] = FALSE;
			}
			if(form_error('ustad')!=''){
				$data['inputerror'][] = 'ustad';
				$data['error_string'][] = form_error('ustad');
				$data['status'] = FALSE;
			}
			if(form_error('waktu_kajian')!=''){
				$data['inputerror'][] = 'waktu_kajian';
				$data['error_string'][] = form_error('waktu_kajian');
				$data['status'] = FALSE;
			}
			
			if(form_error('kelompok')!=''){
				$data['inputerror'][] = 'kelompok';
				$data['error_string'][] = form_error('kelompok');
				$data['status'] = FALSE;
			}
		}
		
		$waktu_kajian = date('Y-m-d H:i', strtotime($this->input->post('waktu_kajian')));
		if ( $waktu_kajian < date("Y-m-d") ) {
				$data['inputerror'][] = 'waktu_kajian';
				$data['error_string'][] = 'Waktu Kajian Minimal Hari ini!';
				$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$nmfile = $this->jadwal->getkodejadwal();
		$config['upload_path'] = './assets/uploads/jadwal/'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['max_size'] = '10240';
		$config['max_width']  = '10240'; 
		$config['max_height']  = '10240'; 
		$config['file_name'] = $nmfile; 
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('gambar')){
			$gbr = $this->jadwal->get($this->input->post('id_jadwal'));
			$gambar = $gbr->gambar;
		} else {
			$gbr = $this->jadwal->get($this->input->post('id_jadwal'));
			if ($gbr->gambar != '') {
			$path = 'assets/uploads/jadwal/'.$gbr->gambar;
			if(file_exists($path)){
	   		unlink($path);
	   		}
	   		}
			$fileupload = $this->upload->data();
			$gambar= $fileupload['file_name'];
		}
		$waktu_kajian = date('Y-m-d H:i', strtotime($this->input->post('waktu_kajian')));
		$data = array(
				'judul_kajian' => $this->input->post('judul_kajian'),
				'id_jenis_kajian' => $this->input->post('jenis_kajian'),
				'id_masjid' => $this->input->post('masjid'),
				'id_ustad' => $this->input->post('ustad'),
				'waktu_kajian' => $waktu_kajian,
				'bada' => $this->input->post('bada'),
				'deskripsi_kajian' => $this->input->post('deskripsi'),
				'kelompok' => $this->input->post('kelompok'),
				'gambar' => $gambar,
				'video_url' => $this->input->post('url_video'),
			);
		$this->jadwal->update(array('id_jadwal' => $this->input->post('id_jadwal')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_jadwal)
	{
	    $jadwal = $this->jadwal->get($id_jadwal);
		if ($jadwal->gambar != '') {
		$path = 'assets/uploads/jadwal/'.$jadwal->gambar;
		if(file_exists($path)){
	   		unlink($path);
	   	}
	   	}
		$this->jadwal->delete($id_jadwal);
		echo json_encode(array("status" => TRUE));
	}
	
	// Mobile
	public function tampilbatas(){
        $data = $this->jadwal->tampilbatas();
        echo json_encode($data);
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
            $jumlah = $this->jadwal->cek_email($request->email);
            if ($jumlah == 0) {
                $data = array(
                    'email' => $request->email,
                    'kode' => $code,
                    'tanggal' => date('Y-m-d H:i:s'),
                );
                $this->jadwal->get_kode_register($data);
            } else {
                $data = array(
                    'kode' => $code,
                    'tanggal' => date('Y-m-d H:i:s'),
                );
                $this->jadwal->update_kode_register(array('email' => $request->email), $data);
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
				'id_jadwal' => $this->jadwal->getkode(),
				'email' => $request->email,
				'password' => md5($request->password),
				'nama' => $request->nama,
				'tempat_lahir' => $request->tempat_lahir,
				'tgl_lahir' => $request->tgl_lahir,
				'hp' => $request->hp,
				'token_id' => '',
			);
			$insert = $this->jadwal->save($data);
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
			$this->jadwal->update(array('id_jadwal' => $this->input->post('id_jadwal')), $data);
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
            $jumlah = $this->jadwal->login($request->email, $request->password);
            $data = array(
                'token_id' => $request->token_id,
            );
            $this->jadwal->update(array('email' => $request->email), $data);
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
            $jumlah = $this->jadwal->cek_kode($request->email, $request->kode);
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
            $this->jadwal->update(array('email' => $request->email), $data);
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
            $jumlah = $this->jadwal->cek_cus($request->email);
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
                $data = $this->jadwal->get_cus($request->email);
                echo json_encode($data);
            }
            else {
                echo "Not called properly with data parameter!";
            }
        }

}

?>