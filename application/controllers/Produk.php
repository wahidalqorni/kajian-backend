<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Produk_model','produk');
		$this->load->model('Kategori_model','kategori');
	}

	public function index() {
		$this->login->isLoggedIn();
		$kategori = $this->kategori->tampil();
		$data = array('title' => 'Produk Linda Kosmetik',
					  'kategori' => $kategori,
					  'isi'   => 'produk_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->produk->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $produk) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $produk->kategori;
			$row[] = $produk->nama_produk;
			$row[] = 'Rp '.number_format($produk->harga, 0 , '' , '.' ).'';
			$row[] = ''.$produk->diskon.'%';
			$row[] = $produk->stok;
			if ($produk->gambar != '') {
				$path = 'assets/uploads/produk/'.$produk->gambar.'';
				if(file_exists($path)){
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/produk/'.$produk->gambar.'">';
				} else {
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/produk/no-produk.png">';
				}
			} else {
					$row[] = '<img class="img-responsive img-rounded" style="height:60px;" src="assets/uploads/produk/no-produk.png">';
			}

			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$produk->id_produk."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$produk->id_produk."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->produk->count_all(),
						"recordsFiltered" => $this->produk->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_produk)
	{
		$data = $this->produk->get($id_produk);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'id_kategori',
			'label' => 'Kategori Produk',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Kategori produk tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'nama_produk',
			'label' => 'Nama Produk',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama produk tidak boleh kosong !',
		            ),
		    ),
		array(
			'field' => 'harga',
			'label' => 'Harga',
			'rules' => 'required|numeric',
			'errors' => array(
			        'required' => 'Harga produk tidak boleh kosong !',
			        'integer' => 'Masukan harga hanya dalam format angka !',
		            ),
		    ),
		array(
			'field' => 'diskon',
			'label' => 'Diskon',
			'rules' => 'required|numeric|greater_than[-1]|less_than[101]',
			'errors' => array(
			        'required' => 'Harga produk tidak boleh kosong !',
			        'numeric' => 'Masukan harga hanya dalam format angka !',
			        'greater_than' => 'Minimum diskon 0% !',
			        'less_than' => 'Maksimum diskon 100% !',
		            ),
		    ),
		array(
			'field' => 'stok',
			'label' => 'Stok',
			'rules' => 'required|numeric',
			'errors' => array(
			        'required' => 'Stok tidak boleh kosong !',
			        'numeric' => 'Stok hanya dalam format angka !',
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
			if(form_error('id_kategori')!=''){
				$data['inputerror'][] = 'id_kategori';
				$data['error_string'][] = form_error('id_kategori');
				$data['status'] = FALSE;
			}
			if(form_error('nama_produk')!=''){
				$data['inputerror'][] = 'nama_produk';
				$data['error_string'][] = form_error('nama_produk');
				$data['status'] = FALSE;
			}
			if(form_error('harga')!=''){
				$data['inputerror'][] = 'harga';
				$data['error_string'][] = form_error('harga');
				$data['status'] = FALSE;
			}
			if(form_error('diskon')!=''){
				$data['inputerror'][] = 'diskon';
				$data['error_string'][] = form_error('diskon');
				$data['status'] = FALSE;
			}
			if(form_error('stok')!=''){
				$data['inputerror'][] = 'stok';
				$data['error_string'][] = form_error('stok');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$nmfile = $this->produk->getkode();
		$config['upload_path'] = './assets/uploads/produk/'; 
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
		$data = array(
				'id_produk' => $this->produk->getkode(),
				'id_kategori' => $this->input->post('id_kategori'),
				'nama_produk' => $this->input->post('nama_produk'),
				'harga' => $this->input->post('harga'),
				'diskon' => $this->input->post('diskon'),
				'stok' => $this->input->post('stok'),
				'deskripsi_item' => $this->input->post('deskripsi_item'),
				'gambar' => $gambar,
			);
		$insert = $this->produk->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
        array(
			'field' => 'id_kategori',
			'label' => 'Kategori Produk',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Kategori produk tidak boleh kosong !',
		            ),
		    ),
        array(
			'field' => 'nama_produk',
			'label' => 'Nama Produk',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Nama produk tidak boleh kosong !',
		            ),
		    ),
		array(
			'field' => 'harga',
			'label' => 'Harga',
			'rules' => 'required|numeric',
			'errors' => array(
			        'required' => 'Harga produk tidak boleh kosong !',
			        'integer' => 'Masukan harga hanya dalam format angka !',
		            ),
		    ),
		array(
			'field' => 'diskon',
			'label' => 'Diskon',
			'rules' => 'required|numeric|greater_than[-1]|less_than[101]',
			'errors' => array(
			        'required' => 'Harga produk tidak boleh kosong !',
			        'numeric' => 'Masukan harga hanya dalam format angka !',
			        'greater_than' => 'Minimum diskon 0% !',
			        'less_than' => 'Maksimum diskon 100% !',
		            ),
		    ),
		array(
			'field' => 'stok',
			'label' => 'Stok',
			'rules' => 'required|numeric',
			'errors' => array(
			        'required' => 'Stok tidak boleh kosong !',
			        'numeric' => 'Stok hanya dalam format angka !',
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
			if(form_error('id_kategori')!=''){
				$data['inputerror'][] = 'id_kategori';
				$data['error_string'][] = form_error('id_kategori');
				$data['status'] = FALSE;
			}
			if(form_error('nama_produk')!=''){
				$data['inputerror'][] = 'nama_produk';
				$data['error_string'][] = form_error('nama_produk');
				$data['status'] = FALSE;
			}
			if(form_error('harga')!=''){
				$data['inputerror'][] = 'harga';
				$data['error_string'][] = form_error('harga');
				$data['status'] = FALSE;
			}
			if(form_error('diskon')!=''){
				$data['inputerror'][] = 'diskon';
				$data['error_string'][] = form_error('diskon');
				$data['status'] = FALSE;
			}
			if(form_error('stok')!=''){
				$data['inputerror'][] = 'stok';
				$data['error_string'][] = form_error('stok');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$nmfile = $this->produk->getkode();
		$config['upload_path'] = './assets/uploads/produk/'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['max_size'] = '10240';
		$config['max_width']  = '10240'; 
		$config['max_height']  = '10240'; 
		$config['file_name'] = $nmfile; 
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('gambar')){
			$gbr = $this->produk->get($this->input->post('id_produk'));
			$gambar = $gbr->gambar;
		} else {
			$gbr = $this->produk->get($this->input->post('id_produk'));
			if ($gbr->gambar != '') {
			$path = 'assets/uploads/produk/'.$gbr->gambar;
			if(file_exists($path)){
	   		unlink($path);
	   		}
	   		}
			$fileupload = $this->upload->data();
			$gambar= $fileupload['file_name'];
		}
		$data = array(
				'id_kategori' => $this->input->post('id_kategori'),
				'nama_produk' => $this->input->post('nama_produk'),
				'harga' => $this->input->post('harga'),
				'diskon' => $this->input->post('diskon'),
				'stok' => $this->input->post('stok'),
				'deskripsi_item' => $this->input->post('deskripsi_item'),
				'gambar' => $gambar,
			);
		$this->produk->update(array('id_produk' => $this->input->post('id_produk')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_produk)
	{
		$produk = $this->produk->get($id_produk);
		if ($produk->gambar != '') {
		$path = 'assets/uploads/produk/'.$produk->gambar;
		if(file_exists($path)){
	   		unlink($path);
	   	}
	   	}
		$this->produk->delete($id_produk);
		echo json_encode(array("status" => TRUE));
	}

	//mobile
	public function tampil($limit, $offset){
        $data = $this->produk->tampil($limit, $offset);
        echo json_encode($data);
    }

    public function tampil_perkategori($limit, $offset, $id_kategori){
        $data = $this->produk->tampil_perkategori($limit, $offset, $id_kategori);
        echo json_encode($data);
    }

}

?>