<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kategori_model','kategori');
	}

	public function index() {
		$this->login->isLoggedIn();
		$data = array('title' => 'Kategori Produk',
					  'isi'   => 'kategori_view');
		$this->load->view('layout/wrapper',$data);
	}

	public function display() {
		$list = $this->kategori->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kategori) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kategori->kategori;

			$row[] = '<a class="btn btn-sm btn-outline-success" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit('."'".$kategori->id_kategori."'".')"><i class="fa fa-pencil"></i></a>
				  <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('."'".$kategori->id_kategori."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kategori->count_all(),
						"recordsFiltered" => $this->kategori->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function edit($id_kategori)
	{
		
		$data = $this->kategori->get($id_kategori);
		echo json_encode($data);
	}

	public function tambah()
	{
		$config = array(
        array(
			'field' => 'kategori',
			'label' => 'Kategori',
			'rules' => 'required|is_unique[kategori.kategori]',
			'errors' => array(
			        'required' => 'Kategori produk tidak boleh kosong !',
			        'is_unique' => 'Kategori ini sudah ada !',
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
			if(form_error('kategori')!=''){
				$data['inputerror'][] = 'kategori';
				$data['error_string'][] = form_error('kategori');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$data = array(
				'kategori' => $this->input->post('kategori'),
			);
		$insert = $this->kategori->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$config = array(
        array(
			'field' => 'kategori',
			'label' => 'Kategori',
			'rules' => 'required',
			'errors' => array(
			        'required' => 'Kategori produk tidak boleh kosong !',
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
			if(form_error('kategori')!=''){
				$data['inputerror'][] = 'kategori';
				$data['error_string'][] = form_error('kategori');
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
		$data = array(
				'kategori' => $this->input->post('kategori'),
			);
		$this->kategori->update(array('id_kategori' => $this->input->post('id_kategori')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id_kategori)
	{
		$this->kategori->delete($id_kategori);
		echo json_encode(array("status" => TRUE));
	}

	// Mobile
	public function tampil(){
        $data = $this->kategori->tampil();
        echo json_encode($data);
    }

}

?>