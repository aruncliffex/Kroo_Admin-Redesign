<?php
//error_reporting('E_ALL');
class sponser extends Controller {
	
    function __construct()
    {
        parent::__construct();
        //$this->load->model('game_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('s3server');
        $this->load->model('sponser_model');


    }

 

    public function index(){ 
        if($this->session->userdata('id'))
        {           
            $data['sponser']=$this->sponser_model->sponser_listing(); 
            //echo "<pre>"; print_r($data['sponser']); die;
            $data['main_content']='sponser_listing';
            $this->load->view('layout/admin_template',$data);
        }else{
            $this->load->view('home/home');
        }   
    }

    public function insert_sponser(){

        $file='';
        $downloadfile='';

        $config['upload_path'] = 'uploads/sponser/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_width']     = 60;
        $config['max_height']    = 60;

        $this->load->library('upload');
        $this->upload->initialize($config);
        if($this->upload->do_upload('userfile')==true){
            $data=$this->upload->data();
            $file=$data['file_name'];

            if(!empty($file)){
                $downloadfile = $file;
                $this->s3server->uploadons3('uploads/sponser/'.$file,$file,"sponsers");
            }
            $data = array(
                'label'    => $this->input->post('label'),
                'logo'     => $file,
                'link'    => $this->input->post('link'),
            ); 
            $this->sponser_model->insert_sponser($data);

        }else{ 
             $responce['error'] = array('error' => $this->upload->display_errors());
        }


        header("Content-type: application/json");
        echo json_encode($responce);

    }


    public function update_sponser(){
        $id= $this->input->post('id');
        $filename=($_FILES['userfile']['name']); 
        if($filename !=""){

            $file='';
            $downloadfile='';
            $config['upload_path'] = 'uploads/sponser/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_width']     = 60;
            $config['max_height']    = 60;

            $this->load->library('upload');
            $this->upload->initialize($config);
            if($this->upload->do_upload('userfile')==true){ 

                $data=$this->upload->data();
                $file=$data['file_name'];
                //$responce['filename']=$file;

                if(!empty($file)){
                    $file = $file;
                    //$responce['s3']=$this->s3server->uploadons3('uploads/sponser/'.$file,$file,"sponsers");
                    $this->s3server->uploadons3('uploads/sponser/'.$file,$file,"sponsers");
                }
                $data = array(
                    'label'    => $this->input->post('label'),
                    'logo'     => $file,
                    'link'     => $this->input->post('link'),
                ); 

               $this->sponser_model->update_sponser($data,$id);
               header("Content-type: application/json");
               echo json_encode($responce);               

            }else{ 
                $responce['error'] = array('error' => $this->upload->display_errors());
                header("Content-type: application/json");
                echo json_encode($responce);
            }

        }else{
            $file=$this->input->post('logo');           
            $data = array(
                'label'    => $this->input->post('label'),
                'logo'     => $file,
                'link'     => $this->input->post('link'),
            ); 
            $this->sponser_model->update_sponser($data,$id);
            header("Content-type: application/json");
            echo json_encode($responce);
        }
    }

    public function upload_sponser($img){
        $responce['s3']=$this->s3server->uploadons3('uploads/sponser/'.$img,$img,"sponsers");
        header("Content-type: application/json");
        echo json_encode($responce);
    }

    public function sponser_detail($sponser_id){
 
        $responce=$this->sponser_model->sponser_detail($sponser_id);
        header("Content-type: application/json");
        echo json_encode($responce);

    }  

   public function get_sponser_label($label,$sponser_id){
 
        $responce=$this->sponser_model->get_sponser_label($label,$sponser_id);
        header("Content-type: application/json");
        echo json_encode($responce);

    }  

	
}
