<?php
class Apipage extends Controller {
    public function __construct() {
        parent::Controller();
        $this->load->model('apipage_model');
        //error_reporting(E_ALL);
    }

    public function index()
    {
        echo '<h1>Invalid Url!</h1>';
    }



    public function newsdetails($newstype, $newsid)
    {
        if($newstype==3){
            $data['folder'] = "articleimage/";
        }else{
            $data['folder'] = "newsimages/";
        }
        if($newstype > 0 && $newsid > 0){
            $data['content'] = $this->apipage_model->newsdetails($newstype, $newsid);
            if($data['content']['content_type']=='26'){
                $this->load->view('video_pages',$data);
            }elseif(strlen($data['content']['details'])>0){
                //$data['content']['postCKEDITOR'] = $this->input->post('editor1');
                $this->load->view('pages',$data);
            }else{
                redirect($data['content']['url']);
            }

        }
        else{
            echo '<h1>Invalid Parameters!</h1>';
        }
    }
    
	
}

?>
