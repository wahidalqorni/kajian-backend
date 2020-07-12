<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

		public function index()
		{
	        $data = array('title' => 'Login Petugas');
			$this->load->view('login_view', $data);
		}
        
        public function logout(){
            $this->session->sess_destroy();
            redirect(base_url());
            exit;
        }
        
        public function login(){
            $email =  $this->input->post('email');
            $password =  $this->input->post('password');
            if($this->login->login($email, $password)){
                echo json_encode(array("status" => TRUE));
            }
            else{
                echo json_encode(array("gagal" => 'sedih'));
            }
        }

}