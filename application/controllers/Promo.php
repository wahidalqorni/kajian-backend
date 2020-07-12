<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Promo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Promo_model','promo');
		$this->load->model('Customer_model','customer');
	}

	public function index() {
		$this->login->isLoggedIn();
		$data = array('title' => 'Promo Linda Kosmetik',
					  'isi'   => 'Promo_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		date_default_timezone_set("Asia/Bangkok");
		$list = $this->promo->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $promo) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $promo->judul;
			$row[] = date('d-m-Y', strtotime($promo->tgl_berakhir));
			if ($promo->tgl_berakhir < date("Y-m-d")) {
				$row[] = '<b style="color:red;">Expired</b>';
			} else {
				$row[] = '<b style="color:green;">Berlaku</b>';
			}
			if ($promo->gambar != '') {
				$path = 'assets/uploads/promo/'.$promo->gambar.'';
				if(file_exists($path)){
					$row[] = '<img class="img-responsive img-rounded" style="height:100px;" src="assets/uploads/promo/'.$promo->gambar.'">';
				} else {
					$row[] = '<img class="img-responsive img-rounded" style="height:100px;" src="assets/uploads/promo/no-promo.png">';
				}
			} else {
					$row[] = '<img class="img-responsive img-rounded" style="height:100px;" src="assets/uploads/promo/no-promo.png">';
			}

			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$promo->id_promo."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$promo->id_promo."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->promo->count_all(),
						"recordsFiltered" => $this->promo->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_promo)
	{
		$data = $this->promo->get($id_promo);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'judul',
			'label' => 'Judul Promo',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Judul promo tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'tgl_berakhir',
			'label' => 'Batas Promo',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Batas promo tidak boleh kosong !',
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
			if(form_error('judul')!=''){
				$data['inputerror'][] = 'judul';
				$data['error_string'][] = form_error('judul');
				$data['status'] = FALSE;
			}
			if(form_error('tgl_berakhir')!=''){
				$data['inputerror'][] = 'tgl_berakhir';
				$data['error_string'][] = form_error('tgl_berakhir');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$nmfile = $this->promo->getkode();
		$config['upload_path'] = './assets/uploads/promo/'; 
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
		$promo = $this->input->post('judul');
		$data = array(
				'id_promo' => $this->promo->getkode(),
				'judul' => $this->input->post('judul'),
				'tgl_berakhir' => $this->input->post('tgl_berakhir'),
				'deskripsi' => $this->input->post('deskripsi'),
				'gambar' => $gambar,
			);
		$insert = $this->promo->save($data);
		define( 'API_ACCESS_KEY', 'AAAAmriJWnA:APA91bEOQWxW33rkvTfDu6TJ-vDYbJ2js_bsXaitGVElHbN7NjLAe8KtXliEFdTVa2Y_PwjHenOGGtrZ-VqJX52oSP5MjZLXSsC4tH4nn9BTOUwePUPMYK1bHU0TAZQdwHfd8vLq-YdC');
        $msg = array
        (
            'body'   => ''.$promo.'',
            'vibrate'   => 'default',
            'sound'     => 'default',
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon',
            'status' => TRUE,
        );

        $data_token = $this->customer->get_all_token();
    	$token = array();
    	foreach ($data_token as $row) {
    		$token[] = $row->token_id;
		}

        $fields = array
        (
            'registration_ids' => $token,
            'priority' => 'high',
            'notification'  => $msg
        );
            
        $headers = array
            (
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );   
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
        array(
			'field' => 'judul',
			'label' => 'Judul Promo',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Judul promo tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'tgl_berakhir',
			'label' => 'Batas Promo',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Batas promo tidak boleh kosong !',
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
			if(form_error('judul')!=''){
				$data['inputerror'][] = 'judul';
				$data['error_string'][] = form_error('judul');
				$data['status'] = FALSE;
			}
			if(form_error('tgl_berakhir')!=''){
				$data['inputerror'][] = 'tgl_berakhir';
				$data['error_string'][] = form_error('tgl_berakhir');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$nmfile = $this->promo->getkode();
		$config['upload_path'] = './assets/uploads/promo/'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['max_size'] = '10240';
		$config['max_width']  = '10240'; 
		$config['max_height']  = '10240'; 
		$config['file_name'] = $nmfile; 
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('gambar')){
			$gbr = $this->promo->get($this->input->post('id_promo'));
			$gambar = $gbr->gambar;
		} else {
			$gbr = $this->promo->get($this->input->post('id_promo'));
			if ($gbr->gambar != '') {
			$path = 'assets/uploads/promo/'.$gbr->gambar;
			if(file_exists($path)){
	   		unlink($path);
	   		}
	   		}
			$fileupload = $this->upload->data();
			$gambar= $fileupload['file_name'];
		}
		$data = array(
				'judul' => $this->input->post('judul'),
				'tgl_berakhir' => $this->input->post('tgl_berakhir'),
				'deskripsi' => $this->input->post('deskripsi'),
				'gambar' => $gambar,
			);
		$this->promo->update(array('id_promo' => $this->input->post('id_promo')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_promo)
	{
		$promo = $this->promo->get($id_promo);
		if ($promo->gambar != '') {
		$path = 'assets/uploads/promo/'.$promo->gambar;
		if(file_exists($path)){
	   		unlink($path);
	   	}
	   	}
		$this->promo->delete($id_promo);
		echo json_encode(array("status" => TRUE));
	}

	// Mobile
	public function tampil(){
        $data = $this->promo->tampil();
        echo json_encode($data);
    }
}

?>