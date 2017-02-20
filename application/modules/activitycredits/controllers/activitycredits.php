<?php
//error_reporting('E_ALL');
class activitycredits extends Controller {
	
    function __construct()
    {
        parent::__construct();
        //$this->load->model('game_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('activity_credits_model');


    }

 

    public function index(){ 
        if($this->session->userdata('id'))
        {           

            $data['activity']=$this->activity_credits_model->activity_credits_listing(); 
            $data['main_content']='activity_credits_listing';
            $this->load->view('layout/admin_template',$data);
        }else{
            $this->load->view('home/home');
        }   

    }

    public function insert_activity_credits(){

        $data = array(
            'points_start'    => $this->input->post('points_start'),
            'points_end'      => $this->input->post('points_end'),
            'multiplied'       => $this->input->post('multiplied'),
            'credits'          => $this->input->post('credits'),

        ); 

        $this->activity_credits_model->insert_activity_credits($data);
        $response['status'] = true; 
        header("Content-type: application/json");
        echo json_encode($responce);

    }


    public function update_activity_credits(){
        $id= $this->input->post('id');
        $data = array(
            'points_start'    => $this->input->post('points_start'),
            'points_end'      => $this->input->post('points_end'),
            'multiplied'       => $this->input->post('multiplied'),
            'credits'          => $this->input->post('credits'),

        ); 

        $this->activity_credits_model->update_activity_credits($data,$id);
        $response['status'] = true; 
        header("Content-type: application/json");
        echo json_encode($responce);

    }



   public function acititycredits_detail($ac_id){
 
        $responce=$this->activity_credits_model->acititycredits_detail($ac_id);
        header("Content-type: application/json");
        echo json_encode($responce);

    }  



	
}
