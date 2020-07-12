<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Jadwal_model extends CI_Model {

    var $table = 'jadwal';
    var $column_order = array(null,null,'waktu_kajian'); 
    var $column_search = array('judul_kajian','waktu_kajian'); 
    var $order = array('id_jadwal' => 'DESC');  

    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from('jadwal a'); 
        $this->db->join('masjid b','b.id_masjid=a.id_masjid');
        $this->db->join('ustad c','c.id_ustad=a.id_ustad');
        $this->db->join('jenis_kajian d','d.id_jenis_kajian=a.id_jenis_kajian');
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
    
    public function get_jadwal( $cond = '' ) {

        $this->db->select( '*, jadwal.gambar AS thumbnail' );
        $this->db->from( $this->table );
        $this->db->join( 'jenis_kajian', $this->table . '.id_jenis_kajian = jenis_kajian.id_jenis_kajian' );
        $this->db->join( 'ustad', $this->table . '.id_ustad = ustad.id_ustad' );
        $this->db->join( 'masjid', $this->table . '.id_masjid = masjid.id_masjid' );

        if ( is_string( $cond ) && strlen( $cond ) >= 3 or is_array( $cond ) && count( $cond ) > 0 )
            $this->db->where( $cond );

        $this->db->order_by( $this->table . '.id_jadwal', 'DESC' );
        $query = $this->db->get();
        return $query->result();

    }

    public function tampil() {
        $this->db->from($this->table);
        $this->db->order_by('judul_kajian','ASC');
        $query = $this->db->get();
        return $query->result();  
    }
    
    public function tampilbatas() {
        date_default_timezone_set("Asia/Bangkok");
        $this->db->from('jadwal');
        $this->db->where('waktu_kajian >=',date("Y-m-d"));
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

    public function getkodejadwal() {
        $q = $this->db->query("select max(RIGHT(id_jadwal, 5)) as idmax from jadwal");
        $kd = "";
        if ($q->num_rows()>0){
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->idmax)+1;
                $kd = sprintf("%05s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        $kar = "Jadwal_";
        return $kar.$kd;
    }

    public function get($id_jadwal)
    {
        $this->db->from($this->table);
        $this->db->where('id_jadwal',$id_jadwal);
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

    public function delete($id_jadwal)
    {
        $this->db->where('id_jadwal', $id_jadwal);
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