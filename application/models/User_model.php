<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class User_model extends CI_Model {

    var $table = 'user';
    var $column_order = array(null,null,'nama','tgl_lahir'); 
    var $column_search = array('email','nama','level','alamat'); 
    var $order = array('nama' => 'ASC');  

    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) 
        {
            if($_POST['search']['value'])
            {
                
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
        
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function tampil() {
        $this->db->from($this->table);
        $this->db->order_by('nama','ASC');
        $query = $this->db->get();
        return $query->result();  
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getkode() {
        $hariini = date("Ymd");
        $q = $this->db->query("select max(RIGHT(id_user, 4)) as idmax from user where id_user like '$hariini%'");
        $kd = "";
        if ($q->num_rows()>0){
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->idmax)+1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        $kar = $hariini;
        return $kar.$kd;
    }

    public function get($id_user)
    {
        $this->db->from($this->table);
        $this->db->where('id_user',$id_user);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    
    public function edit($pk, $data) {
        
        $this->db->where([ 'id_user' => $pk ]);
        return $this->db->update($this->table, $data);
        
    }

    public function delete($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete($this->table);
    }

    public function cek_email($email)
    {
        $this->db->from('kode_verifikasi');
        $this->db->where('email',$email);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_kode_register($data) {
        $this->db->insert('kode_verifikasi', $data);
        return $this->db->insert_id();
    }

    public function update_kode_register($where, $data) {
        $this->db->update('kode_verifikasi', $data, $where);
        return $this->db->affected_rows();
    }

    public function login($email, $password)
    {
        $this->db->from($this->table);
        $this->db->where('email',$email);
        $this->db->where('password',md5($password));
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function sign_in($email, $password) {
        
        $this->db->from($this->table);
        $this->db->where('email',$email);
        $this->db->where('password',md5($password));
        $query = $this->db->get();
        return $query->row();
        
    }

    public function cek_kode($email, $kode)
    {
        $this->db->from('kode_verifikasi');
        $this->db->where('email',$email);
        $this->db->where('kode',$kode);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function cek_cus($email)
    {
        $this->db->from($this->table);
        $this->db->where('email',$email);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_cus($email)
    {
        $this->db->from($this->table);
        $this->db->where('email',$email);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_all_token() {
        $this->db->select('token_id');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }
}

?>