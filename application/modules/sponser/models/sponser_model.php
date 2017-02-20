<?php
class Sponser_model extends Model {  


    function __construct() {
    parent::__construct();
    }


    function insert_sponser($data){ 
        $query=$this->db->insert('sponser', $data);
    }



  function update_sponser($data,$id){ 
        $this->db->where('id', $id);
        $this->db->update('sponser', $data);
    }



   function sponser_listing(){ 
        $this->db->select("*");
        $this->db->from('sponser');
        $this->db->order_by("id", "desc");
        $query=$this->db->get(); 
       return $query->result_array();
    }
    
  function sponser_detail($sponser_id){ 
        $this->db->select("*");
        $this->db->from('sponser');
        $this->db->where('id',$sponser_id); 
        $query=$this->db->get(); 
       return $query->result_array();
    }

    function get_sponser_label($label,$sponser_id){ 
        $this->db->select("label");
        $this->db->from('sponser');
        $this->db->where('label',$label);
        $this->db->where('id !=',$sponser_id);
        $query=$this->db->get(); 
       return $query->result_array();
    }

}