<?php
class Activity_credits_model extends Model {


    function __construct() {
    parent::__construct();
    }


    function insert_activity_credits($data){ 
        $query=$this->db->insert('activity_credits', $data);
    }



  function update_activity_credits($data,$id){ 
        $this->db->where('id', $id);
        $this->db->update('activity_credits', $data);
    }



   function activity_credits_listing(){ 
        $this->db->select("*");
        $this->db->from('activity_credits');
        $query=$this->db->get(); 
       return $query->result_array();
    }
    
 function acititycredits_detail($ac_id){ 
        $this->db->select("*");
        $this->db->from('activity_credits');
        $this->db->where('id', $ac_id);
        $query=$this->db->get(); 
       return $query->result_array();
    }



}