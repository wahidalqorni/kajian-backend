<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login {
	
	var $CI = NULL;
	public function __construct() {
		$this->CI =& get_instance();
	}
	
	
 	public function login($email, $password){
        $password1 = md5($password);
        $this->CI->db->where('email',$email);
        $this->CI->db->where('password',$password1);
        $query = $this->CI->db->get('administrator');
        if($query->num_rows()==1){
            foreach ($query->result() as $row){
                $data = array(
                            'email'=> $row->email,
                            'level'=> $row->level,
                            'nama'=> $row->nama,
                            'logged_in'=>TRUE
                        );
            }
            $this->CI->session->set_userdata($data);
            return TRUE;
        } 
        else{
            return FALSE;
        }   
    }

    public function isLoggedIn(){
            $is_logged_in = $this->CI->session->userdata('logged_in');

            if(!isset($is_logged_in) || $is_logged_in!==TRUE)
            {
                redirect(base_url('auth'));
                exit;
            }
    }
	
}