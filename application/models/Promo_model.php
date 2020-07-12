<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Promo_model extends CI_Model {

    var $table = 'promo';
    var $column_order = array(null,'judul','tgl_berakhir'); 
    var $column_search = array('judul'); 
    var $order = array('tgl_berakhir' => 'desc');  

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
        $q = $this->db->query("select max(RIGHT(id_promo, 4)) as idmax from promo where id_promo like '$hariini%'");
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

    public function get($id_promo)
    {
        $this->db->from($this->table);
        $this->db->where('id_promo',$id_promo);
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

    public function delete($id_promo)
    {
        $this->db->where('id_promo', $id_promo);
        $this->db->delete($this->table);
    }

    public function tampil() {
        date_default_timezone_set("Asia/Bangkok");
        $this->db->from('promo');
        $this->db->where('tgl_berakhir >=',date("Y-m-d"));
        $query = $this->db->get();
        return $query->result();  
    }

}

?>