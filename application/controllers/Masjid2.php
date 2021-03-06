<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Masjid2 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Masjid2_model','masjid');
		$this->load->model('Kota_model','kota');
		$this->load->model('Kecamatan_model','kecamatan');
		$this->load->model('Kelurahan_model','kelurahan');
	}

	public function index() {
		$this->login->isLoggedIn();
		$kota = $this->kota->tampil();
		$kecamatan = $this->kecamatan->tampil();
		$kelurahan = $this->kelurahan->tampil();
		$data = array('title' => 'Masjid',
					  'kota' => $kota,
					  'kecamatan' => $kecamatan,
					  'kelurahan' => $kelurahan,
					  'isi'   => 'masjid2_view');
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

	  public function listKelurahan(){
    // Ambil data ID Kota yang dikirim via ajax post
	    $id_kecamatan = $this->input->post('id_kecamatan');
	    
	    $kelurahan = $this->kelurahan->viewByKecamatan($id_kecamatan);
	    
	    // Buat variabel untuk menampung tag-tag option nya
	    // Set defaultnya dengan tag option Pilih
	    $lists = "<option value=''>Pilih</option>";
	    
	    foreach($kelurahan as $data){
	      $lists .= "<option value='".$data->id_kelurahan."'>".$data->nama_kelurahan."</option>"; // Tambahkan tag option ke variabel $lists
	    }
	    
	    $callback = array('list_kelurahan'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
	    echo json_encode($callback); // konversi varibael $callback menjadi JSON
	  }
	//}
	public function display() {
		$list = $this->masjid->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $masjid) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $masjid->nama_masjid;
			$row[] = $masjid->alamat;
			$row[] = $masjid->nama_kota_kab;
			if ($masjid->gambar != '') {
				$path = 'assets/uploads/masjid/'.$masjid->gambar.'';
				if(file_exists($path)){
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/masjid/'.$masjid->gambar.'">';
				} else {
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/masjid/no-produk.png">';
				}
			} else {
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/masjid/no-produk.png">';
			}
			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$masjid->id_masjid."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$masjid->id_masjid."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->masjid->count_all(),
						"recordsFiltered" => $this->masjid->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_masjid)
	{
		$data = $this->masjid->get($id_masjid);
		echo json_encode($data);
	}

	public function tambah()
	{
		/*$config = array(
        array(
			'field' => 'nama_masjid',
			'label' => 'Nama Masjid',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama Masjid tidak boleh kosong !',
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
			'field' => 'kelurahan',
			'label' => 'Kelurahan',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Kelurahan tidak boleh kosong !',
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
			if(form_error('nama_masjid')!=''){
				$data['inputerror'][] = 'nama_masjid';
				$data['error_string'][] = form_error('nama_masjid');
				$data['status'] = FALSE;
			}
			if(form_error('alamat')!=''){
				$data['inputerror'][] = 'alamat';
				$data['error_string'][] = form_error('alamat');
				$data['status'] = FALSE;
			}
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
			if(form_error('kelurahan')!=''){
				$data['inputerror'][] = 'kelurahan';
				$data['error_string'][] = form_error('kelurahan');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}*/
		
		$data = array(
				'id_masjid' => $this->masjid->getkodemasjid(),
				'nama_masjid' => $this->input->post('nama_masjid'),
				'alamat' => $this->input->post('alamat'),
				'id_kota_kab' => $this->input->post('kota'),
				'id_kecamatan' => $this->input->post('kecamatan'),
				'id_kelurahan' => $this->input->post('kelurahan'),
				'deskripsi' => $this->input->post('deskripsi'),
			);
		$insert = $this->masjid->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
        $config = array(
        array(
			'field' => 'nama_masjid',
			'label' => 'Nama Masjid',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama Masjid tidak boleh kosong !',
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
			'field' => 'kelurahan',
			'label' => 'Kelurahan',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Kelurahan tidak boleh kosong !',
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
			if(form_error('nama_masjid')!=''){
				$data['inputerror'][] = 'nama_masjid';
				$data['error_string'][] = form_error('nama_masjid');
				$data['status'] = FALSE;
			}
			if(form_error('alamat')!=''){
				$data['inputerror'][] = 'alamat';
				$data['error_string'][] = form_error('alamat');
				$data['status'] = FALSE;
			}
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
			if(form_error('kelurahan')!=''){
				$data['inputerror'][] = 'kelurahan';
				$data['error_string'][] = form_error('kelurahan');
				$data['status'] = FALSE;
			}
			
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		
		$data = array(
				'nama_masjid' => $this->input->post('nama_masjid'),
				'alamat' => $this->input->post('alamat'),
				'id_kota_kab' => $this->input->post('kota'),
				'id_kecamatan' => $this->input->post('kecamatan'),
				'id_kelurahan' => $this->input->post('kelurahan'),
				'deskripsi' => $this->input->post('deskripsi'),
			);
		$this->masjid->update(array('id_masjid' => $this->input->post('id_masjid')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_masjid)
	{
		$this->masjid->delete($id_masjid);
		echo json_encode(array("status" => TRUE));
	}

	//mobile
	

}

?>