<?php
//error_reporting('E_ALL');
class Game extends Controller {
	
    function __construct()
    {
        parent::__construct();
        //$this->load->model('game_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('game_model');
        $this->load->library('s3server');
        $this->load->library('upload');
        $this->load->model('dashboard/dashboard_model');

    }

    public function index(){
        if($this->session->userdata('id'))
        {         

            $query = $this->db->get('sponser');
            $data['sponser']= $query->result_array(); 
            $data['game']=$this->game_model->game_listing();
            $data['kroo_news']['all_leagues'] = $this->dashboard_model->all_leagues(); 
            $data['main_content']='game_qustionlist_view';
            $this->load->view('layout/admin_template',$data);
        }else{
            $this->load->view('home/home');
        }

 

    }

    public function game_add(){

        $config = array(
            array(
                'field' => 'question',
                'label' => 'question',
                'rules' => 'trim|required' 
            ), 
            array(
                'field' => 'credits',
                'label' => 'credits',
                'rules' => 'trim|required' 
            )

        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE)
        {
            $errors = array();
            foreach ($this->input->post() as $key => $value)
            {
                $errors[$key] = form_error($key);
            }

            $response['errors'] = array_filter($errors);
            $response['status'] = FALSE;    
            header("Content-type: application/json");
            echo json_encode($response);
        }
        else
        { 

            $notified = "0";
            $randNumber=rand();
            $file = ($_FILES['userfiles']['size']>0)?$_FILES['userfiles']['size']:'';
            if(!empty($file)){
                $file = $randNumber.'_'.basename($_FILES['userfiles']['name']);
                $file_destination = 'gameImages/'.$file; 
                
                if (@move_uploaded_file( $_FILES['userfiles']['tmp_name'] , $file_destination )) { 
                    
                }
            }

            $publish_id=$this->input->post('publish_id');
            if($publish_id==3){
                $publish=2;
                $notified = "1";
            }else{
               $publish= $this->input->post('publish_id');
            }                

            $news_id=($this->input->post('news_id'))?$this->input->post('news_id'):'0';

            if($publish_id==3){
                $dateTTP= $this->input->post('NowPublishDate');
                $timeTTP= $this->input->post('NowPublishTime');
                /*$datetimeTTP=$dateTTP." ".$timeTTP; 
                $dt = strtotime("$datetimeTTP GMT");*/
                $timezone = $this->input->post('timezoneoffset') * 60;
                $datetimeTTP=$dateTTP." ".$timeTTP; 
                $dt = strtotime("$datetimeTTP")+($timezone);
                $TTP=date("Y-m-d H:i:s", $dt); 
            }else{

                $dateTTP= $this->input->post('time_to_publish_date');
                $timeTTP= $this->input->post('time_to_publish_time');
                /*$datetimeTTP=$dateTTP." ".$timeTTP; 
                $dt = strtotime("$datetimeTTP GMT");*/
                $timezone = $this->input->post('timezoneoffset') * 60;
                $datetimeTTP=$dateTTP." ".$timeTTP; 
                $dt = strtotime("$datetimeTTP")+($timezone);
                $TTP=date("Y-m-d H:i:s", $dt); 

           }
  
            $hourTTL= $this->input->post('TTL-hour');
            $minuteTTL= $this->input->post('TTL-min'); 
            $TTl= date("H:i:s", strtotime("$hourTTL:$minuteTTL"));
            $hourTTA=00;
            $minTTA= $this->input->post('TTA-min');
            $secTTA= $this->input->post('TTA-sec'); 
            $TTA= date("H:i:s", strtotime("$hourTTA:$minTTA:$secTTA")); 

            $data = array(
            'questions' => $this->input->post('question'),
            'options' => $this->input->post('optradio'),
            'ans_opt1' => $this->input->post('ans_opt1'),
            'ans_opt2' => $this->input->post('ans_opt2'),
            'ans_opt3' => $this->input->post('ans_opt3'),
            'ans_opt4' => $this->input->post('ans_opt4'),
            'credits' => $this->input->post('credits'),
            'explaination' => $this->input->post('exp_answer'),
            'league' => $this->input->post('news_league_id'),
            'team' => $this->input->post('news_team_id'),
            'images' => $this->input->post('news_img'),
            'status' => $publish,
            'notified' => $notified,
            'time_to_live' => $TTl,
            'time_to_answer' => $TTA,
            'time_to_publish' => $TTP,
            'link' => $this->input->post('link'),
            'sponser' => $this->input->post('sponser'),
            'game_type' => $this->input->post('select_game_category'),
            'difficulty' => $this->input->post('select_difficulty'),
            'news_id' => $news_id,
            ); 

            $response['insert_id'] = $this->game_model->form_insert($data);
            $response['status'] = true; 
            if($response['insert_id']>0 && $publish_id==3 ){
                $this->push_notification_game($response['insert_id']);
            }else{
                header("Content-type: application/json");
                echo json_encode($response);
            }


        }
    }


    public function game_qustions_update(){
        $id = $this->input->post('id');
        $notified = "0";
        $randNumber=rand();
        $file = ($_FILES['userfiles']['size']>0)?$_FILES['userfiles']['size']:'';
            if(!empty($file)){
                $file = $randNumber.'_'.basename($_FILES['userfiles']['name']);
                $file_destination = 'gameImages/'.$file; 
                
                if (@move_uploaded_file( $_FILES['userfiles']['tmp_name'] , $file_destination )) { 

                }

        }

        $publish_id=$this->input->post('publish_id');
        if($publish_id==3){
            $publish=2;
            $notified="1";
        }else{
             $publish= $this->input->post('publish_id');
        }        

            if($publish_id==3){
                $dateTTP= $this->input->post('NowPublishDate');
                $timeTTP= $this->input->post('NowPublishTime');
                $timezone = $this->input->post('timezoneoffset') * 60;
                $datetimeTTP=$dateTTP." ".$timeTTP; 
                $dt = strtotime("$datetimeTTP")+($timezone);
                $TTP=date("Y-m-d H:i:s", $dt); 
           }else{

                $dateTTP= $this->input->post('time_to_publish_date');
                $timeTTP= $this->input->post('time_to_publish_time');
                $timezone = $this->input->post('timezoneoffset') * 60;
                $datetimeTTP=$dateTTP." ".$timeTTP; 
                $dt = strtotime("$datetimeTTP")+($timezone);
                $TTP=date("Y-m-d H:i:s", $dt); 

           }

        $hourTTL= $this->input->post('TTL-hour');
        $minuteTTL= $this->input->post('TTL-min'); 
        $TTl= date("H:i:s", strtotime("$hourTTL:$minuteTTL"));
        $hourTTA=00;
        $minTTA= $this->input->post('TTA-min');
        $secTTA= $this->input->post('TTA-sec'); 
        $TTA= date("H:i:s", strtotime("$hourTTA:$minTTA:$secTTA")); 


        $data = array(
            'questions' => $this->input->post('question'),
            'ans_opt1' => $this->input->post('ans_opt1'),
            'ans_opt2' => $this->input->post('ans_opt2'),
            'ans_opt3' => $this->input->post('ans_opt3'),
            'ans_opt4' => $this->input->post('ans_opt4'),
            'credits' => $this->input->post('credits'),
            'options' => $this->input->post('optradio'),
            'explaination' => $this->input->post('exp_answer'),
            'league' => $this->input->post('news_league_id'),
            'team' => $this->input->post('news_team_id'),
            'status' => $publish,
            'notified' => $notified,
            'time_to_live' => $TTl,
            'time_to_answer' => $TTA,
            'time_to_publish' => $TTP,
            'link' => $this->input->post('link'),
            'sponser' => $this->input->post('sponser'),
            'game_type' => $this->input->post('select_game_category'),
            'difficulty' => $this->input->post('select_difficulty'),
            'images' => $this->input->post('news_img'),
        ); 
         //echo json_encode($data); exit;
       $response['insert_id']= $this->game_model->form_update($data,$id);
       if($response['insert_id']>0 && $publish_id==3 ){
            $this->push_notification_game($response['insert_id']);
        }else{
            header("Content-type: application/json");
            echo json_encode($response);
         }

    }

    public function game_qustions_delete($qustion_id){
        $status=1;
        $data = array(
            'status' =>$status
        ); 

        $this->game_model->qustion_delete($qustion_id,$data);

    }


    public function get_news_id($news_id){
 
         $responce=$this->game_model->get_news_id($news_id);
         $ptime=strtotime($responce[0]['time_to_publish']) + ($this->session->userdata('timezoneoffset')*60*-1);
         $responce[0]['max_credits']=$this->game_model->getMaxCredit();
         $responce[0]['news_id']=$responce[0]['news_id'];
         $responce[0]['pdate'] = date('Y-m-d',$ptime);
         $responce[0]['ptime'] = date('g:i a',$ptime);
         
         header("Content-type: application/json");
         echo json_encode($responce);
    }

    public function get_league_team($news_id){
 
        $league = $this->game_model->get_league($news_id);
        $teams = $this->dashboard_model->league_teams($league['league_id']);
        $data['league_id'] = $league['league_id'];
        $i=0;
        foreach($teams as $league_teams){
            $data['team'][$i]['league_team_id']     = $league_teams['id'];
            $data['team'][$i]['league_team_name']   = $league_teams['name'];
            $data['team'][$i]['league_team_logo']   = $league_teams['logo'];
            $i++;
        }
         
         header("Content-type: application/json");
         echo json_encode($data);
    }


    public function get_news($news_id){
 
         $responce=$this->game_model->get_news($news_id);       
         header("Content-type: application/json");
         echo json_encode($responce);

    }



     public function game_detail($game_id){
 
         $responce=$this->game_model->game_detail($game_id);
         $ptime=strtotime($responce[0]['time_to_publish']) + ($this->session->userdata('timezoneoffset')*60*-1);
         $responce[0]['pdate'] = date('Y-m-d',$ptime);
         $responce[0]['ptime'] = date('g:i a',$ptime);

         header("Content-type: application/json");
         echo json_encode($responce);

    }


    public function store_detail($store_id){
 
        $responce=$this->game_model->store_detail($store_id);
        $ptime=strtotime($responce[0]['time']);
        $responce[0]['time'] = date('g:i a',$ptime);
        header("Content-type: application/json");
        echo json_encode($responce);
                 
         

    }   


    public function game_store(){ 
        if($this->session->userdata('id'))
        {           
            $query = $this->db->get('country');
            $data['country']= $query->result_array();
            $query = $this->db->get('teams');
            $data['teams']= $query->result_array();  
            $data['store']=$this->game_model->store_listing(); 
            $data['kroo_news']['all_leagues'] = $this->dashboard_model->all_leagues();
            $data['main_content']='game_store_listing';
            $this->load->view('layout/admin_template',$data);
        }else{
            $this->load->view('home/home');
        }   

    }

    public function insert_store(){
        $storeDate= $this->input->post('date');
        $dt = strtotime("$storeDate");
        $dateStore=date("Y-m-d", $dt); 
        $storeTime= $this->input->post('time'); 
        $timeStore= date("H:i:s", strtotime("$storeTime"));
        $channel_published_at=  date("Y-m-d H:i:s");


        $data = array(
            'league'               => $this->input->post('news_league_id'),
            'team1'                => $this->input->post('add_store_team1'),
            'team2'                => $this->input->post('add_store_team2'),
            'venue'                => $this->input->post('venue'),
            'country'              => $this->input->post('country'),
            'points'               => $this->input->post('points'),
            'date'                 => $dateStore,
            'time'                 => $timeStore,
            'channel_published_at' => $channel_published_at,
        ); 

        $this->game_model->insert_store($data);
        header("Content-type: application/json");
        echo json_encode($responce);

    }



    public function update_store(){
        $id= $this->input->post('id');
        $storeDate= $this->input->post('date');
        $dt = strtotime("$storeDate");
        $dateStore=date("Y-m-d", $dt); 
        $storeTime= $this->input->post('time'); 
        $timeStore= date("H:i:s", strtotime("$storeTime"));
        $channel_published_at=  date("Y-m-d H:i:s");

        $data = array(
            'league'               => $this->input->post('news_league_id'),
            'team1'                => $this->input->post('add_store_team1'),
            'team2'                => $this->input->post('add_store_team2'),
            'venue'                => $this->input->post('venue'),
            'country'              => $this->input->post('country'),
            'points'               => $this->input->post('points'),
            'date'                 => $dateStore,
            'time'                 => $timeStore,
            'channel_published_at' => $channel_published_at,
        ); 

        $this->game_model->update_store($data,$id);
        header("Content-type: application/json");
        echo json_encode($responce);

    }


    public function tickets(){ 
         if($this->session->userdata('id'))
         {

            $responce=$this->game_model->tickets_listing(); 
                $k=0;
                foreach($responce as $ticket){ 
                        $data['info'][$k]['id']             = $ticket['id'];
                        $data['info'][$k]['store_id']       = $ticket['store_id'];
                        $data['info'][$k]['user_id']        = $ticket['user_id'];
                        $data['info'][$k]['tickets']        = $ticket['tickets'];
                        $data['info'][$k]['total_credits']  = $ticket['total_credits'];
                        $data['info'][$k]['status']         = $ticket['status'];
                        $data['info'][$k]['update_date']    = $ticket['update_date'];
                        $data['info'][$k]['msg']            = $ticket['msg'];
                        $data['info'][$k]['name']           = $ticket['name'];
                        $data['info'][$k]['t1name']         = $ticket['t1name'];
                        $data['info'][$k]['t2name']         = $ticket['t2name'];
                        $data['info'][$k]['venue']          = $ticket['venue'];
                        $data['info'][$k]['country']        = $ticket['country'];
                        $data['info'][$k]['date']           = $ticket['date'];
                        $data['info'][$k]['time']           = $ticket['time'];
                        $data['info'][$k]['email']          = $ticket['email'];
                        $data['info'][$k]['tdate']           = $ticket['tdate'];


                        $k++;
                }


            $data['main_content']='game_tickets_listing';
            $this->load->view('layout/admin_template',$data);

       }else{
            $this->load->view('home/home');
        }
    }

    public function mail_trial(){ 
            $message='<table style="min-width:600px;background-color: #fff;margin:0 auto;border-collapse: collapse;" border="0" cellspacing="0">
            <tbody>
            <tr style="background-color: #005adc;">
                <td style="width:30%;">
                    <img src="'.ADMIN_PATH.'assets/logo.png" alt="" style="margin:0 auto;display: block;">
                </td>
                <td style="width:70%;">
                    <h1 style="color:#fff;font-weight: 700;padding:10% 60px 8% 60px; font-size:2.5em">The Kroo</h1>
                </td>
            </tr>
            <tr style="background-color: #fff;">
                <td colspan="2" align="center">';


            $message.='<p style="color:#8C95A1;font-weight: 500;text-align: left; margin-left: 25px; font-size:1.2em;">Dear User, </p> 
            <p style="color:#8C95A1;font-weight: 500;text-align: center; font-size:1.2em;"> You ticket has been <b>Approved</b> from admin.';
            $message.='<br><br>Regards<br><b>Kroo Games Team</b></p>';

            $message.='</td>
            </tr>
            <tr style="text-align: center;background-color: #e1e4e9;">
                <td colspan="2">
                    <p style="color:#A0A5B4;font-size: 1.2em; padding:6%;font-weight: 400;">
                    Kroo helps you to re-connect with your favourite<br>teams,
                    players and fans ever you met.<br>@2016 The Kroo</p> 
                </td>
            </tr>
                </tbody>
            </table>';
            
            $from_email = "kroogames@kroo.com"; 
            //$to_email = $this->input->post('email'); 
            $to_email = 'vikram.jaiswal@cliffex.com';
               
            $this->load->library('email');
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'thekrooapp@gmail.com';
            $config['smtp_pass']    = 'mTrjw+?jMwM_5L!m';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not      


            /*$config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;*/

            $this->email->initialize($config);
            $this->email->from($from_email, 'Kroo Games');
            $this->email->to($to_email); 
            //$this->email->cc('manishpanwarthakur@gmail.com'); 
            //$this->email->bcc('manishpanwarthakur@gmail.com'); 
            $this->email->subject('Ticket status');
            $this->email->message($message);  
            $stt = $this->email->send();
            var_dump($stt);
            echo $this->email->print_debugger();
            $to = $to_email;
            $subject = "HTML email";

            $message = "
            <html>
            <head>
            <title>HTML email</title>
            </head>
            <body>
            <p>This email contains HTML Tags!</p>
            <table>
            <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            </tr>
            <tr>
            <td>John</td>
            <td>Doe</td>
            </tr>
            </table>
            </body>
            </html>
            ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <admin@thekroo.com>' . "\r\n";

            mail($to,$subject,$message,$headers);
    }

    public function update_tickets(){ 
        $id=$this->input->post('id');
        $date = date('Y-m-d H:i:s');
        $status=$this->input->post('status');
        $file='';
        $downloadfile='';
        if($status=="Approved"){
            $config = array(
                      'upload_path'     => "uploads/tickets/",
                      'allowed_types'   => "pdf",
                      'overwrite'       => false 
                    );

            $this->upload->initialize($config);
            $upld = $this->upload->do_upload('userfile');
            if($upld==true){
                $data=$this->upload->data();
                $file=$data['file_name'];
                $downloadfile = md5($file);
                $this->s3server->uploadons3('uploads/tickets/'.$file,$file,"usertickets");
            }else{
                $response['error']=strip_tags($this->upload->display_errors());
                $response['upload_data']=$this->upload->data();
                $response['config']=$config;
                $response['status'] = false;
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
            $message='<table style="min-width:600px;background-color: #fff;margin:0 auto;border-collapse: collapse;" border="0" cellspacing="0">
            <tbody>
            <tr style="background-color: #005adc;">
                <td style="width:30%;">
                    <img src="'.ADMIN_PATH.'assets/logo.png" alt="" style="margin:0 auto;display: block;">
                </td>
                <td style="width:70%;">
                    <h1 style="color:#fff;font-weight: 700;padding:10% 60px 8% 60px; font-size:2.5em">The Kroo</h1>
                </td>
            </tr>
            <tr style="background-color: #fff;">
                <td colspan="2" align="center">';


            $message.='<p style="color:#8C95A1;font-weight: 500;text-align: left; margin-left: 25px; font-size:1.2em;">Dear User, </p> 
            <p style="color:#8C95A1;font-weight: 500;text-align: center; font-size:1.2em;"> You ticket has been <b>'.strtoupper($this->input->post('status')).'</b> from admin.';
            if($this->input->post('status')=='Approved' && $downloadfile!=''){
                $message.='<br><br>Kindly download the ticket by clicking the the given link:';
                $message.='<br><br><a href="'.NOTIFICATION_API_PATH.'downloadticket/'.$downloadfile.'">Click Here</a>';
            }elseif($this->input->post('status')=='Approved'){
                $message.='<br><br>Kindly download the ticket from app download ticket section.';
            }
            $message.='<br><br>Regards<br><b>Kroo Games Team</b></p>';

            $message.='</td>
            </tr>
            <tr style="text-align: center;background-color: #e1e4e9;">
                <td colspan="2">
                    <p style="color:#A0A5B4;font-size: 1.2em; padding:6%;font-weight: 400;">
                    Kroo helps you to re-connect with your favourite<br>teams,
                    players and fans ever you met.<br>@2016 The Kroo</p> 
                </td>
            </tr>
                </tbody>
            </table>';
            
            $from_email = "kroogames@kroo.com"; 
            $to_email = $this->input->post('email'); 
            //$to_email = 'vikram.jaiswal@cliffex.com';
               
            $this->load->library('email');
            /*$config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;*/
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'thekrooapp@gmail.com';
            $config['smtp_pass']    = 'mTrjw+?jMwM_5L!m';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not   

            $this->email->initialize($config);
            $this->email->from($from_email, 'Kroo Games');
            $this->email->to($to_email); 
            //$this->email->cc('manishpanwarthakur@gmail.com'); 
            //$this->email->bcc('manishpanwarthakur@gmail.com'); 
            $this->email->subject('Ticket status');
            $this->email->message($message);  
            $this->email->send();
       }

        $data = array(
            'message'      => $this->input->post('message'),
            'status'       => $this->input->post('status'),
            'ticket_image' => $file,
            'update_date'  => $date,
        ); 
         

        $this->game_model->update_tickets($data,$id);

        if($this->input->post('status')=="Rejected"){
            $this->game_model->update_ticket_user($id);
        }

        //$response['status'] = true; 
        //header("Content-type: application/json");
        //echo json_encode($response);
        $this->push_notification_ticket($id,'1');
    }

    public function push_notification_game($gameid){
        if($_SERVER['HTTP_HOST']=='live.krooadmin.com' || $_SERVER['HTTP_HOST']=='test.krooadmin.com'){
            echo "localhost";
            exit;
        }
        $contentAry = $this->game_model->getGameDesciption($gameid);
        $points = $this->game_model->getGamePointsForUser($contentAry['credits']);

        //get ios devices
        $iosarn = $this->game_model->getDeviceInfoIOS($contentAry['team'], $points);
        $iosDeviceidAry = array();
        $ios_res = '';
        foreach($iosarn as $arn){
            $iosDeviceidAry[]=$arn['aws_arn'];
        }

        //get android devices
        $androidDeviceidAry = $this->game_model->getDeviceInfoAndroid($contentAry['team'], $points);
        $registrationIds = array();
        $android_res = '';
        foreach($androidDeviceidAry as $value){
            $registrationIds[] = $value['device_token'];
        }
        //print_r($registrationIds); exit;
        if ( count($registrationIds)>0) {
            $msg = array(
                'title' => $contentAry['title'],
                'data' => $contentAry,
                'vibrate' => 1,
                'sound' => 1,
                'largeIcon' => 'large_icon',
                'image_url'=>'image_url',
                'description'=>'news_description',
                'smallIcon' => 'small_icon'
            );

            $fields = array(
                'registration_ids' => $registrationIds,
                'data' => $msg
            );

            $headers = array(
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);

            $android_res = json_decode($result);

        }

        if(count($iosDeviceidAry)>0){
            $CurlConnect = curl_init();
            $req = json_encode(array('ios_arn_arr'=>$iosDeviceidAry,'ios_content'=>$contentAry));
            curl_setopt($CurlConnect, CURLOPT_URL, NOTIFICATION_API_PATH.'ios_push');
            curl_setopt($CurlConnect, CURLOPT_POST,   1);
            curl_setopt($CurlConnect, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt($CurlConnect, CURLOPT_POSTFIELDS, $req);

            curl_setopt($CurlConnect, CURLOPT_HTTPHEADER, array(                                                                          
               'Content-Type: application/json',                                                                                
               'Content-Length: ' . strlen($req))                                                                       
            );

            $Result = curl_exec($CurlConnect);
            $ios_res = $Result;
        }
        
        $data['contentAry']     = $contentAry;
        $data['android_res']    = $android_res;
        $data['ios_res']        = $ios_res;

        header("Content-type: application/json");
        echo json_encode($data);   
    }

    public function push_notification_ticket($ticketid,$level){
        $contentAry = $this->game_model->getTicketStatus($ticketid);
        $user_id=$contentAry['user_id'];
        //print_r($contentAry); exit;
        $iosarn = $this->game_model->getDeviceInfoIOS(0,array(),$user_id);
        $iosDeviceidAry = array();
        $ios_res = '';
        //print_r($iosarn); exit;
        foreach($iosarn as $arn){
            $iosDeviceidAry[]=$arn['aws_arn'];
        }
        $androidDeviceidAry = $this->game_model->getDeviceInfoAndroid(0,array(),$user_id);
        $registrationIds = array();
        $android_res = '';
        foreach($androidDeviceidAry as $value){
            $registrationIds[] = $value['device_token'];
        }
        //print_r($registrationIds); exit;
        if ( count($registrationIds)>0) {

            $msg = array(
                'title' => $contentAry['title'],
                'data' => $contentAry,
                'vibrate' => 1,
                'sound' => 1,
                'largeIcon' => 'large_icon',
                'image_url'=>'image_url',
                'description'=>'news_description',
                'smallIcon' => 'small_icon'
            );

            $fields = array(
                'registration_ids' => $registrationIds,
                'data' => $msg
            );

            $headers = array(
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);

            $android_res = json_decode($result);
        }

        if(count($iosDeviceidAry)>0){
            $CurlConnect = curl_init();
            $req = json_encode(array('ios_arn_arr'=>$iosDeviceidAry,'ios_content'=>$contentAry));
            curl_setopt($CurlConnect, CURLOPT_URL, NOTIFICATION_API_PATH.'ios_push');
            curl_setopt($CurlConnect, CURLOPT_POST,   1);
            curl_setopt($CurlConnect, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt($CurlConnect, CURLOPT_POSTFIELDS, $req);

            curl_setopt($CurlConnect, CURLOPT_HTTPHEADER, array(                                                                          
               'Content-Type: application/json',                                                                                
               'Content-Length: ' . strlen($req))                                                                       
            );

            $Result = curl_exec($CurlConnect);
            $ios_res = $Result;
        }
        
        $data['contentAry']     = $contentAry;
        $data['android_res']    = $android_res;
        $data['ios_res']        = $ios_res;

        header("Content-type: application/json");
        echo json_encode($data);   
    }

    public function getmaxcredit(){
        $str = $this->game_model->getMaxCredit();
        echo ($str>0)?$str:0;
    }
	
}
