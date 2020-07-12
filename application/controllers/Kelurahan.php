<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Kelurahan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kelurahan_model','kelurahan');
		$this->load->model('Kota_model','kota');
		$this->load->model('Kecamatan_model','kecamatan');
	}

	public function index() {
		$this->login->isLoggedIn();
		$kota = $this->kota->tampil();
		$kecamatan = $this->kecamatan->tampil();
		$data = array('title' => 'Kelurahan',
					  'kota' => $kota,
					  'kecamatan' => $kecamatan,
					  'isi'   => 'kelurahan_view');
		$this->load->view('layout/wrapper',$data);
	}
	public function listKecamatan(){
    // Ambil data ID Kota yang dikirim via ajax post
	    $id_kota = $this->input->post('id_kota');
	    
	    $kecamatan = $this->kecamatan->viewByKota($id_kota);
	    
	    // Buat variabel untuk menampung tag-tag option nya
	    // Set defaultnya dengan tag option Pilih
	    $lists = "<option value=''>Pilih</option>";
	    
	    foreach($kecamatan as $data){
	      $lists .= "<option value='".$data->id_kecamatan."'>".$data->nama_kecamatan."</option>"; // Tambahkan tag option ke variabel $lists
	    }
	    
	    $callback = array('list_kecamatan'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
	    echo json_encode($callback); // konversi varibael $callback menjadi JSON
	  }
	//}
	public function display() {
		$list = $this->kelurahan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kelurahan) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kelurahan->nama_kota_kab;
			$row[] = $kelurahan->nama_kecamatan;
			$row[] = $kelurahan->nama_kelurahan;
			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$kelurahan->id_kelurahan."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$kelurahan->id_kelurahan."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kelurahan->count_all(),
						"recordsFiltered" => $this->kelurahan->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_kelurahan)
	{
		$data = $this->kelurahan->get($id_kelurahan);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'kota',
			'label' => 'Kota',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Kota tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'kecamatan',
			'label' => 'Kecamatan',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Kecamatan tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'nama_kelurahan',
			'label' => 'Nama kelurahan',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama kelurahan tidak boleh kosong !',
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
			if(form_error('kecamatan')!=''){
				$data['inputerror'][] = 'kecamatan';
				$data['error_string'][] = form_error('kecamatan');
				$data['status'] = FALSE;
			}
			if(form_error('nama_kelurahan')!=''){
				$data['inputerror'][] = 'nama_kelurahan';
				$data['error_string'][] = form_error('nama_kelurahan');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		
		$data = array(
				'id_kelurahan' => $this->kelurahan->getkodekel(),
				'id_kota_kab' => $this->input->post('kota'),
				'id_kecamatan' => $this->input->post('kecamatan'),
				'nama_kelurahan' => $this->input->post('nama_kelurahan'),
			);
		$insert = $this->kelurahan->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
        array(
			'field' => 'kota',
			'label' => 'Kecamatan',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'kota kelurahan tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'kecamatan',
			'label' => 'Kecamatan',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'kecamatan kelurahan tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'nama_kelurahan',
			'label' => 'Nama kelurahan',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama kelurahan tidak boleh kosong !',
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
			if(form_error('kecamatan')!=''){
				$data['inputerror'][] = 'kecamatan';
				$data['error_string'][] = form_error('kecamatan');
				$data['status'] = FALSE;
			}
			if(form_error('nama_kelurahan')!=''){
				$data['inputerror'][] = 'nama_kelurahan';
				$data['error_string'][] = form_error('nama_kelurahan');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		
		$data = array(
				'id_kota_kab' => $this->input->post('kota'),
				'id_kecamatan' => $this->input->post('kecamatan'),
				'nama_kelurahan' => $this->input->post('nama_kelurahan'),
			);
		$this->kelurahan->update(array('id_kelurahan' => $this->input->post('id_kelurahan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_kelurahan)
	{
		$this->kelurahan->delete($id_kelurahan);
		echo json_encode(array("status" => TRUE));
	}

	//mobile
	

}

?>