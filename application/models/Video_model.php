<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Video_model extends CI_Model {

    var $table = 'video';
    var $column_order = array(null,'judul'); 
    var $column_search = array('judul'); 
    var $order = array('judul' => 'ASC');  

    private function _get_datatables_query()
    {
        $this->db->select('video.*, ustad.nama_ustad');
        $this->db->from($this->table);
        $this->db->join('ustad','ustad.id_ustad = video.id_ustad');
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

    public function getkodevideo() {
        $q = $this->db->query("select max(right(id_video,5)) as idmax from video");
        $kd = "";
        if ($q->num_rows()>0){
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->idmax)+1;
                $kd = sprintf("%05s", $tmp);
            }
        } else {
            $kd = "00001";
        }
        $kar = "Video_";
        return $kar.$kd;
    }

    public function get($id_video)
    {
        $this->db->from($this->table);
        $this->db->where('id_video',$id_video);
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

    public function delete($id_kajian)
    {
        $this->db->where('id_kajian', $id_kajian);
        $this->db->delete($this->table);
    }

    public function tampil1($limit, $offset) {
        /*$this->db->from($this->table);
        $this->db->limit($limit, $offset);
        $this->db->order_by('id_kategori','ASC');
        $query = $this->db->get();
        return $query->result();  */
    }

    public function tampil_perkategori($limit, $offset, $id_kategori) {
        /*$this->db->from($this->table);
        $this->db->where('id_kategori', $id_kategori);
        $this->db->limit($limit, $offset);
        $this->db->order_by('id_kategori','ASC');
        $query = $this->db->get();
        return $query->result();  */
    }


}

?>