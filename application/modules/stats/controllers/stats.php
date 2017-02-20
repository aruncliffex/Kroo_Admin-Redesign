<?php
class Stats extends Controller {
    public function __construct() {
        parent::Controller();
        $this->load->model('stats_model');
        $this->load->model('dashboard/dashboard_model');
        //error_reporting(E_ALL);
    }

    public function index()
    {
        if($this->session->userdata('is_admin') == 'admin'){
            $responce['url'] = $this->stats_model->crone_stats();
            $k=0;
            foreach($responce['url'] as $cron){
                    $data['info'][$k]['id'] 		= $cron['id'];
                    $data['info'][$k]['success'] 	= $cron['success'];
                    $data['info'][$k]['failure'] 	= $cron['failure'];
                    $data['info'][$k]['copied'] 	= $cron['copied'];
                    $data['info'][$k]['totalUrls'] 	= $cron['totalUrls'];
                    $data['info'][$k]['type'] 		= $cron['type'];
                    $data['info'][$k]['date'] 		= $cron['date'];

                    $k++;
            }
            $data['main_content']='crone_stats';
            $this->load->view('layout/admin_template',$data);

        }
        else{
            redirect(SITEURL.'dashboard/main');
        }
        // header("Content-type: application/json");
        // echo json_encode($data);
    }



    public function url()
    {

        if($this->session->userdata('is_admin') == 'admin'){
            $responce['url'] = $this->stats_model->failure_url();
            $k=0;
            foreach($responce['url'] as $url){
                    $data['info'][$k]['url_id'] 	= $url['id'];
                    $data['info'][$k]['url'] 		= $url['url'];
                    $data['info'][$k]['parent_url'] 	= $url['parent'];
                    $data['info'][$k]['url_type'] 	= $url['type'];
                    $data['info'][$k]['failure_date'] 	= $url['date'];

                    $k++;
            }
            $data['main_content']='failure_url';
            $this->load->view('layout/admin_template',$data);

        }
        else{
            redirect(SITEURL.'dashboard/main');
        }
        // header("Content-type: application/json");
        // echo json_encode($data);
    }

    public function news_stats(){
        if($this->session->userdata('is_admin') == 'admin'){
            $data['header'] = "News | Kroo Admin";
            $data['leagues']['all_leagues'] = $this->dashboard_model->all_leagues();          
            $data['main_content']='news_stats';
            $this->load->view('layout/admin_template',$data);
        }
        else{
            redirect(SITEURL.'dashboard/main');
        }
    }

    public function kroo_stats(){
            $leagueID  = ($this->input->post('leagueId'))?$this->input->post('leagueId'):'';
            $fltr['dateFrom']   =($this->input->post('from_date'))?$this->input->post('from_date'):'';
            $tab_index = 'stats'.$this->input->post('tab_index');
            $data['result'] = $this->stats_model->$tab_index($leagueID,$fltr['dateFrom']);
            $this->load->view('stats_listing',$data);
    }
    
    public function league_stats(){
        $leagueID  = ($this->input->post('leagueId'))?$this->input->post('leagueId'):'';
        $dateFrom  =($this->input->post('from_date'))?$this->input->post('from_date'):'';
        $tab_index = 'cr_stats'.$this->input->post('tab_index');
        $data = $this->stats_model->$tab_index($leagueID, $dateFrom);
        echo json_encode($data);
    }
    
    public function getty()
    {

        $data['main_content']='gettyimg';
        $this->load->view('layout/admin_template',$data);       
        // header("Content-type: application/json");
        // echo json_encode($data);
    }

	
}

?>
