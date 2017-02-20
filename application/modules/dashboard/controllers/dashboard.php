<?php
//error_reporting('E_ALL');
class Dashboard extends Controller {
	
    function __construct()
    {
        parent::__construct();
        $this->apiKey = "e9mggbacu8jee2sb7ahy53uk";
        $this->apiSecret = "6nUUnHkTZUqz5Qf5hDXnYTeZG4VtJ75D4SNF5pBPWKqM2";
        $this->token='';
        $this->tokenType='';
        $this->load->model('dashboard_model');
        $this->load->helper('getty_helper');
    }

    function index()
    {
        $this->main();
    }
	
    public function main()
    {
        if($this->session->userdata('id'))
        {           

            $data['header'] = "News | Kroo Admin";
            $data['kroo_news']['all_leagues'] = $this->dashboard_model->all_leagues();
            $data['kroo_news']['sponser'] = $this->dashboard_model->sponser();                              
            $data['getNewsSummary'] = $this->dashboard_model->getNewsSummary(); 
            //$data['getFantasySummary'] = $this->dashboard_model->getFantasySummary();
            //$data['getArticleSummary'] = $this->dashboard_model->getArticleSummary();
            $data['main_content']='dashboard';

            $ch_fltr2 = $this->dashboard_model->get_all_channels(2);            
            $full_name = '';
            $i=0;
            foreach($ch_fltr2 as $row){
                $ch_name = explode("_",$row['value']);                
                foreach($ch_name as $col){
                    $name = strtoupper($col);
                    $full_name = $full_name.$name.' ';
                }
                $data['channel2'][$i]['id'] = $row['channel'];
                $data['channel2'][$i]['name'] = $full_name;
                $i++;
                $full_name = '';
            }

            $ch_fltr31 = $this->dashboard_model->get_all_channels(31);            
            $full_name = '';
            $j=0;
            foreach($ch_fltr31 as $row){
                $ch_name = explode("_",$row['value']);                
                foreach($ch_name as $col){
                    $name = strtoupper($col);
                    $full_name = $full_name.$name.' ';
                }
                $data['channel31'][$j]['id'] = $row['channel'];
                $data['channel31'][$j]['name'] = $full_name;
                $j++;
                $full_name = '';
            }

            $this->load->view('layout/admin_template',$data);
            //header("Content-type: application/json");
            //echo json_encode($data);
        }
        else{

            $this->load->view('home/home');
            //redirect(SITEURL);
        }
    }
        
               
        // Get the news listing
    public function kroo_news_listing()
    {
        $fltr['channelID']   =($this->input->post('channelID'))?$this->input->post('channelID'):'';
        $fltr['leagueID']   =($this->input->post('leagueId'))?$this->input->post('leagueId'):'';
        $fltr['teamID']     =($this->input->post('teamId'))?$this->input->post('teamId'):'';
        $fltr['newsType']   =($this->input->post('news_type')!='')?$this->input->post('news_type'):'';
        $fltr['dateFrom']   =($this->input->post('from_date'))?$this->input->post('from_date'):'';
        $fltr['dateTo']     =($this->input->post('to_date'))?$this->input->post('to_date'):'';
        $fltr['news_category']     = array();
        if($this->input->post('newsCategory')){
            $fltr['news_category'][] = $this->input->post('newsCategory');
        }
        if($this->input->post('newsCategory2')){
            $fltr['news_category'][] = $this->input->post('newsCategory2');
        }
        $kroo['kroo_news']=$this->dashboard_model->kroo_news_list($fltr['channelID'],$fltr['leagueID'],$fltr['teamID'],$fltr['newsType'],$fltr['dateFrom'],$fltr['dateTo'],$fltr['news_category']);
        $k=0;
        if(count($kroo['kroo_news'])>0){
            foreach($kroo['kroo_news'] as $knews){

                $dd = strtotime($knews['rss_sports_created_at']);

                $data['kroo_news'][$k]['rss_sports_id']             = $knews['rss_sports_id'];
                $data['kroo_news'][$k]['league_team_id']            = $knews['rss_team_id'];
                $data['kroo_news'][$k]['rss_sports_title']          = $knews['rss_sports_title'];
                $data['kroo_news'][$k]['rss_sports_summary']        = $knews['rss_sports_summary'];
                $data['kroo_news'][$k]['rss_sports_image']          = $knews['rss_sports_image'];
                $data['kroo_news'][$k]['rss_sports_url']            = $knews['rss_sports_url'];
                $data['kroo_news'][$k]['rss_sports_created_at']     = date('D d M, Y  g:i a',$dd);
                $source =  explode('.com', $knews['rss_sports_url']);                           
                $data['kroo_news'][$k]['rss_sports_source']         = str_replace('http://','',$source[0].'.com');  
                $data['kroo_news'][$k]['rss_sports_is_deleted']     = $knews['rss_sports_is_deleted'];

                $source =  explode('.com', $knews['sports_url']);
                $data['kroo_news'][$k]['sports_source']             = str_replace('http://','',$source[0].'.com');                
                $data['kroo_news'][$k]['sports_id']                 = $knews['sports_id'];  
                $data['kroo_news'][$k]['rss_sports_news_id']        = $knews['rss_sports_news_id'];              
                $data['kroo_news'][$k]['sports_title']              = $knews['sports_title'];
                $data['kroo_news'][$k]['sports_summary']            = $knews['sports_summary'];
                $data['kroo_news'][$k]['sports_image']              = $knews['sports_image'];
                $data['kroo_news'][$k]['sports_url']                = $knews['sports_url'];

                $data['kroo_news'][$k]['sports_published_at']       = $knews['sports_published_at'];
                $data['kroo_news'][$k]['sports_notified_at']        = $knews['sports_notified_at'];
                $data['kroo_news'][$k]['sports_is_deleted']         = $knews['sports_is_deleted'];
                $data['kroo_news'][$k]['sports_edited_by_admin_id'] = $knews['sports_edited_by_admin_id']; 

                $data['kroo_news'][$k]['rss_team_name']             = $knews['rss_team_name'];            
                $data['kroo_news'][$k]['rss_league_name']           = $knews['rss_league_name'];              
                $data['kroo_news'][$k]['league_team_logo']          = ($fltr['news_category']==2)? $knews['rss_team_logo']:$knews['rss_league_logo'];  
                $channel                                            = explode('_', $knews['channel_name']);
                $data['kroo_news'][$k]['channel_name']              = strtoupper($channel[0]);  
                $data['kroo_news'][$k]['news_category']             = $knews['news_category'];
                $data['kroo_news'][$k]['game_id']                   = $knews['game_id'];
                $data['kroo_news'][$k]['tags']                      = $knews['tags'];
               
                $news_type = 'kroo';
                $admin_activity = $this->dashboard_model->get_activity_by_news($knews['rss_sports_id'],$news_type);
                $x=0;
                foreach($admin_activity as $val){
                    $data['kroo_news'][$k]['activity'][$x]['activity_user']     = $this->dashboard_model->get_username_by_id($val['activity_user_id']);
                    $data['kroo_news'][$k]['activity'][$x]['activity_action']   = $val['activity_action']; 
                    $x++;                
                }

                $k++;
            }
            //echo '<pre>'; var_dump($data); echo '</pre>'; exit;
            $this->load->view('listing',$data);
        }else{
            echo "END";
        }
    }


    public function kroo_news_video()
    {      
        $fltr['channelID']   =($this->input->post('channelID'))?$this->input->post('channelID'):'';
        $fltr['leagueID']   =($this->input->post('leagueId'))?$this->input->post('leagueId'):'';
        $fltr['teamID']     =($this->input->post('teamId'))?$this->input->post('teamId'):'';
        $fltr['newsType']   =($this->input->post('news_type')!='')?$this->input->post('news_type'):'';
        $fltr['dateFrom']   =($this->input->post('from_date'))?$this->input->post('from_date'):'';
        $fltr['dateTo']     =($this->input->post('to_date'))?$this->input->post('to_date'):'';
        $fltr['news_category']     = ($this->input->post('newsCategory'))?$this->input->post('newsCategory'):'';
        $fltr['content_type']     = ($this->input->post('contentType'))?$this->input->post('contentType'):'';
        $kroo['kroo_news']=$this->dashboard_model->kroo_news_video($fltr['channelID'],$fltr['leagueID'],$fltr['teamID'],$fltr['newsType'],$fltr['dateFrom'],$fltr['dateTo'],$fltr['news_category'],$fltr['content_type']);
        $k=0;
        if(count($kroo['kroo_news'])>0){
            foreach($kroo['kroo_news'] as $knews){

                $dd = strtotime($knews['rss_sports_created_at']);

                $data['kroo_news'][$k]['rss_sports_id']             = $knews['rss_sports_id'];
                $data['kroo_news'][$k]['league_team_id']            = $knews['rss_team_id'];
                $data['kroo_news'][$k]['rss_league_id']             = $knews['rss_league_id'];
                $data['kroo_news'][$k]['rss_sports_title']          = $knews['rss_sports_title'];
                $data['kroo_news'][$k]['rss_sports_summary']        = $knews['rss_sports_summary'];
                $data['kroo_news'][$k]['rss_sports_image']          = $knews['rss_sports_image'];
                $data['kroo_news'][$k]['rss_sports_url']            = $knews['rss_sports_url'];
                $data['kroo_news'][$k]['rss_sports_created_at']     = date('D d M, Y  g:i a',$dd);
                $source =  explode('.com', $knews['rss_sports_url']);                           
                $data['kroo_news'][$k]['rss_sports_source']         = str_replace('http://','',$source[0].'.com');  
                $data['kroo_news'][$k]['rss_sports_is_deleted']     = $knews['rss_sports_is_deleted'];

                $source =  explode('.com', $knews['sports_url']);
                $data['kroo_news'][$k]['sports_source']             = str_replace('http://','',$source[0].'.com');                
                $data['kroo_news'][$k]['sports_id']                 = $knews['sports_id'];  
                $data['kroo_news'][$k]['rss_sports_news_id']        = $knews['rss_sports_news_id'];              
                $data['kroo_news'][$k]['sports_title']              = $knews['sports_title'];
                $data['kroo_news'][$k]['sports_summary']            = $knews['sports_summary'];
                $data['kroo_news'][$k]['sports_image']              = $knews['sports_image'];
                $data['kroo_news'][$k]['sports_url']                = $knews['sports_url'];

                $data['kroo_news'][$k]['sports_published_at']       = $knews['sports_published_at'];
                $data['kroo_news'][$k]['sports_notified_at']        = $knews['sports_notified_at'];
                $data['kroo_news'][$k]['sports_is_deleted']         = $knews['sports_is_deleted'];
                $data['kroo_news'][$k]['sports_edited_by_admin_id'] = $knews['sports_edited_by_admin_id']; 

                $data['kroo_news'][$k]['rss_team_name']             = $knews['rss_team_name'];            
                $data['kroo_news'][$k]['rss_league_name']           = $knews['rss_league_name'];              
                $data['kroo_news'][$k]['league_team_logo']          = ($fltr['news_category']==2)? $knews['rss_team_logo']:$knews['rss_league_logo'];  
                $channel                                            = explode('_', $knews['channel_name']);
                $data['kroo_news'][$k]['channel_name']              = strtoupper($channel[0]);  
                $data['kroo_news'][$k]['news_category']             = $fltr['news_category'];
                $data['kroo_news'][$k]['game_id']                   = $knews['game_id'];
                $data['kroo_news'][$k]['tags']                      = $knews['tags'];

               
                $news_type = 'kroo';
                $admin_activity = $this->dashboard_model->get_activity_by_news($knews['rss_sports_id'],$news_type);
                $x=0;
                foreach($admin_activity as $val){
                    $data['kroo_news'][$k]['activity'][$x]['activity_user']     = $this->dashboard_model->get_username_by_id($val['activity_user_id']);
                    $data['kroo_news'][$k]['activity'][$x]['activity_action']   = $val['activity_action']; 
                    $x++;                
                }

                $k++;
            }
            $this->load->view('video_listing',$data);
        }else{
            echo "END";
        }
    }

    

    public function get_team($league_id){
        $league_teams = $this->dashboard_model->league_teams($league_id);
        $data =  array();
        $i=0;
        foreach($league_teams as $league_teams){

            $data[$i]['league_team_id']     = $league_teams['id'];
            $data[$i]['league_team_name']   = $league_teams['name'];
            $data[$i]['league_team_logo']   = $league_teams['logo'];
            $i++;
        }
        echo json_encode($data);
    }

    public function get_player($league_id,$team_id){
        $league_players = $this->dashboard_model->league_players($league_id,$team_id);
        $data =  array();
        $i=0;
        foreach($league_players as $league_players){
          
            $data[$i]['player_name']        = $league_players['name_full'];
            $data[$i]['player_name_abbr']   = $league_players['name_abbr'];
            $data[$i]['player_position']    = $league_players['position'];
            $i++;
        }
        echo json_encode($data);
    }
        
    public function kroo_news_search(){

        $search_key = $this->input->post('search_key');
        $tab_index = $this->input->post('tab_index');

        $responce['news'] = $this->dashboard_model->kroo_news_search($search_key, $tab_index);
        $k=0;
        if(count($responce['news'])>0){

            if($tab_index == 0 || $tab_index ==1){

                foreach($responce['news'] as $knews){

                    $dd = strtotime($knews['rss_sports_created_at']);
                    
                    $data['kroo_news'][$k]['rss_sports_id']             = $knews['rss_sports_id'];
                    $data['kroo_news'][$k]['league_team_id']            = $knews['rss_team_id'];
                    $data['kroo_news'][$k]['rss_sports_title']          = $knews['rss_sports_title'];
                    $data['kroo_news'][$k]['rss_sports_summary']        = $knews['rss_sports_summary'];
                    $data['kroo_news'][$k]['rss_sports_image']          = $knews['rss_sports_image'];
                    $data['kroo_news'][$k]['rss_sports_url']            = $knews['rss_sports_url'];
                    $data['kroo_news'][$k]['rss_sports_created_at']     = date('D d M, Y  g:i a',$dd);
                    $source =  explode('.com', $knews['rss_sports_url']);                           
                    $data['kroo_news'][$k]['rss_sports_source']         = str_replace('http://','',$source[0].'.com'); 
                    $data['kroo_news'][$k]['rss_sports_is_deleted']     = $knews['rss_sports_is_deleted'];

                    $source =  explode('.com', $knews['sports_url']);
                    $data['kroo_news'][$k]['sports_source']             = str_replace('http://','',$source[0].'.com');                   
                    $data['kroo_news'][$k]['sports_id']                 = $knews['sports_id'];  
                    $data['kroo_news'][$k]['rss_sports_news_id']        = $knews['rss_sports_news_id'];              
                    $data['kroo_news'][$k]['sports_title']              = $knews['sports_title'];
                    $data['kroo_news'][$k]['sports_summary']            = $knews['sports_summary'];
                    $data['kroo_news'][$k]['sports_image']              = $knews['sports_image'];
                    $data['kroo_news'][$k]['sports_url']                = $knews['sports_url'];

                    $data['kroo_news'][$k]['sports_published_at']       = $knews['sports_published_at'];
                    $data['kroo_news'][$k]['sports_notified_at']        = $knews['sports_notified_at'];
                    $data['kroo_news'][$k]['sports_is_deleted']         = $knews['sports_is_deleted'];
                    $data['kroo_news'][$k]['sports_edited_by_admin_id'] = $knews['sports_edited_by_admin_id'];               

                    $data['kroo_news'][$k]['rss_team_name']             = $knews['rss_team_name'];            
                    $data['kroo_news'][$k]['rss_league_name']           = $knews['rss_league_name'];              
                    $data['kroo_news'][$k]['league_team_logo']          = $knews['rss_team_logo'];  
                    $channel                                            = explode('_', $knews['channel_name']);
                    $data['kroo_news'][$k]['channel_name']              = strtoupper($channel[0]);                

                   

                    $news_type = 'kroo';
                    $admin_activity = $this->dashboard_model->get_activity_by_news($knews['rss_sports_id']);
                    $x=0;
                    foreach($admin_activity as $val){
                        $data['kroo_news'][$k]['activity'][$x]['activity_user']     = $this->dashboard_model->get_username_by_id($val['activity_user_id']);
                        $data['kroo_news'][$k]['activity'][$x]['activity_action']   = $val['activity_action']; 
                        $x++;                
                    }

                    $k++;
                }
                $this->load->view('listing',$data);

            }else if($tab_index == 2){

                foreach($responce['news'] as $pnews){

                    $dd = strtotime($pnews['rss_player_created_at']);

                    $data['player_news'][$k]['rss_player_id']             = $pnews['rss_player_id'];               
                    $data['player_news'][$k]['rss_player_title']          = $pnews['rss_player_title'];
                    $data['player_news'][$k]['rss_player_summary']        = $pnews['rss_player_summary'];
                    $data['player_news'][$k]['rss_player_image']          = $pnews['rss_player_image'];
                    $data['player_news'][$k]['rss_player_url']            = $pnews['rss_player_url'];
                    $data['player_news'][$k]['rss_player_created_at']     = date('D d M, Y  g:i a',$dd);                                          
                    $data['player_news'][$k]['rss_player_source']         = $pnews['rss_player_source'];
                    $data['player_news'][$k]['rss_player_is_deleted']     = $pnews['rss_player_is_deleted'];

                    
                    $data['player_news'][$k]['player_source']             = $pnews['rss_player_source'];
                    $data['player_news'][$k]['player_id']                 = $pnews['player_id'];  
                    $data['player_news'][$k]['rss_player_news_id']        = $pnews['rss_player_news_id'];              
                    $data['player_news'][$k]['player_title']              = $pnews['player_title'];
                    $data['player_news'][$k]['player_summary']            = $pnews['player_summary'];
                    $data['player_news'][$k]['player_image']              = $pnews['player_image'];
                    $data['player_news'][$k]['player_url']                = $pnews['player_url'];

                    $data['player_news'][$k]['player_published_at']       = $pnews['player_published_at'];
                    $data['player_news'][$k]['player_notified_at']        = $pnews['player_notified_at'];
                    $data['player_news'][$k]['player_is_deleted']         = $pnews['player_is_deleted'];
                    $data['player_news'][$k]['player_edited_by_admin_id'] = $pnews['player_edited_by_admin_id']; 

                    $data['player_news'][$k]['league_id']                 = $pnews['league_id'];            
                    $data['player_news'][$k]['league_name']               = $pnews['league_name'];              
                    $data['player_news'][$k]['league_logo']               = $pnews['league_logo'];

                    $data['player_news'][$k]['team_id']                   = $pnews['team_id'];            
                    $data['player_news'][$k]['team_name']                 = $pnews['team_name'];              
                    $data['player_news'][$k]['team_logo']                 = $pnews['team_logo'];
                    
                    $data['player_news'][$k]['channel_name']              = $pnews['channel_name'];
                    //$data['player_news'][$k]['news_category']              = $fltr['news_category'];


                   
                    $news_type = 'player';
                    $admin_activity = $this->dashboard_model->get_activity_by_news($pnews['rss_player_id'],$news_type);
                    $x=0;
                    foreach($admin_activity as $val){
                        $data['player_news'][$k]['activity'][$x]['activity_user']     = $this->dashboard_model->get_username_by_id($val['activity_user_id']);
                        $data['player_news'][$k]['activity'][$x]['activity_action']   = $val['activity_action']; 
                        $x++;                
                    }

                    $k++;
                }
                $this->load->view('player_listing',$data);
            }
            else if($tab_index == 3){

                foreach($responce['news'] as $wnews){

                    $dd = strtotime($wnews['rss_waiver_created_at']);

                    $data['waiver_news'][$k]['rss_waiver_id']             = $wnews['rss_waiver_id'];               
                    $data['waiver_news'][$k]['rss_waiver_title']          = $wnews['rss_waiver_title'];
                    $data['waiver_news'][$k]['rss_waiver_summary']        = $wnews['rss_waiver_summary'];
                    $data['waiver_news'][$k]['rss_waiver_image']          = $wnews['rss_waiver_image'];
                    $data['waiver_news'][$k]['rss_waiver_url']            = $wnews['rss_waiver_url'];
                    $data['waiver_news'][$k]['rss_waiver_created_at']     = date('D d M, Y  g:i a',$dd);                                          
                    $data['waiver_news'][$k]['rss_waiver_source']         = $wnews['rss_waiver_source'];
                    $data['waiver_news'][$k]['rss_waiver_is_deleted']     = $wnews['rss_waiver_is_deleted'];

                    
                    $data['waiver_news'][$k]['waiver_source']             = $wnews['rss_waiver_source'];
                    $data['waiver_news'][$k]['waiver_id']                 = $wnews['waiver_id'];  
                    $data['waiver_news'][$k]['rss_waiver_news_id']        = $wnews['rss_waiver_news_id'];              
                    $data['waiver_news'][$k]['waiver_title']              = $wnews['waiver_title'];
                    $data['waiver_news'][$k]['waiver_summary']            = $wnews['waiver_summary'];
                    $data['waiver_news'][$k]['waiver_image']              = $wnews['waiver_image'];
                    $data['waiver_news'][$k]['waiver_url']                = $wnews['waiver_url'];

                    $data['waiver_news'][$k]['waiver_published_at']       = $wnews['waiver_published_at'];
                    $data['waiver_news'][$k]['waiver_notified_at']        = $wnews['waiver_notified_at'];
                    $data['waiver_news'][$k]['waiver_is_deleted']         = $wnews['waiver_is_deleted'];
                    $data['waiver_news'][$k]['waiver_edited_by_admin_id'] = $wnews['waiver_edited_by_admin_id']; 

                    $data['waiver_news'][$k]['league_id']                 = $wnews['league_id'];            
                    $data['waiver_news'][$k]['league_name']               = $wnews['league_name'];              
                    $data['waiver_news'][$k]['league_logo']               = $wnews['league_logo'];
                    
                    $data['waiver_news'][$k]['channel_name']              = $wnews['channel_name'];
                    //$data['waiver_news'][$k]['news_category']              = $fltr['news_category'];


                   
                    $news_type = 'waiver';
                    $admin_activity = $this->dashboard_model->get_activity_by_news($wnews['rss_waiver_id'],$news_type);
                    $x=0;
                    foreach($admin_activity as $val){
                        $data['waiver_news'][$k]['activity'][$x]['activity_user']     = $this->dashboard_model->get_username_by_id($val['activity_user_id']);
                        $data['waiver_news'][$k]['activity'][$x]['activity_action']   = $val['activity_action']; 
                        $x++;                
                    }

                    $k++;
                }            
                $this->load->view('waiver_listing',$data);
            }


        }else{
            echo "END";
        }
    }


    public function waiver_news_listing(){
        $fltr['leagueID']   =($this->input->post('leagueId'))?$this->input->post('leagueId'):'';
        //$fltr['teamID']     =($this->input->post('teamId'))?$this->input->post('teamId'):'';
        $fltr['newsType']   =($this->input->post('news_type')!='')?$this->input->post('news_type'):'';
        $fltr['dateFrom']   =($this->input->post('from_date'))?$this->input->post('from_date'):'';
        $fltr['dateTo']     =($this->input->post('to_date'))?$this->input->post('to_date'):'';
        //$fltr['news_category']     = ($this->input->post('newsCategory'))?$this->input->post('newsCategory'):'';
        $kroo['waiver_news']=$this->dashboard_model->waiver_news_listing($fltr['leagueID'],$fltr['newsType'],$fltr['dateFrom'],$fltr['dateTo']);

        $k=0;
        if(count($kroo['waiver_news'])>0){
            foreach($kroo['waiver_news'] as $wnews){

                $dd = strtotime($wnews['rss_waiver_created_at']);

                $data['waiver_news'][$k]['rss_waiver_id']             = $wnews['rss_waiver_id'];               
                $data['waiver_news'][$k]['rss_waiver_title']          = $wnews['rss_waiver_title'];
                $data['waiver_news'][$k]['rss_waiver_summary']        = $wnews['rss_waiver_summary'];
                $data['waiver_news'][$k]['rss_waiver_image']          = $wnews['rss_waiver_image'];
                $data['waiver_news'][$k]['rss_waiver_url']            = $wnews['rss_waiver_url'];
                $data['waiver_news'][$k]['rss_waiver_created_at']     = date('D d M, Y  g:i a',$dd);                                          
                $data['waiver_news'][$k]['rss_waiver_source']         = $wnews['rss_waiver_source'];
                $data['waiver_news'][$k]['rss_waiver_is_deleted']     = $wnews['rss_waiver_is_deleted'];

                
                $data['waiver_news'][$k]['waiver_source']             = $wnews['rss_waiver_source'];
                $data['waiver_news'][$k]['waiver_id']                 = $wnews['waiver_id'];  
                $data['waiver_news'][$k]['rss_waiver_news_id']        = $wnews['rss_waiver_news_id'];              
                $data['waiver_news'][$k]['waiver_title']              = $wnews['waiver_title'];
                $data['waiver_news'][$k]['waiver_summary']            = $wnews['waiver_summary'];
                $data['waiver_news'][$k]['waiver_image']              = $wnews['waiver_image'];
                $data['waiver_news'][$k]['waiver_url']                = $wnews['waiver_url'];

                $data['waiver_news'][$k]['waiver_published_at']       = $wnews['waiver_published_at'];
                $data['waiver_news'][$k]['waiver_notified_at']        = $wnews['waiver_notified_at'];
                $data['waiver_news'][$k]['waiver_is_deleted']         = $wnews['waiver_is_deleted'];
                $data['waiver_news'][$k]['waiver_edited_by_admin_id'] = $wnews['waiver_edited_by_admin_id']; 

                $data['waiver_news'][$k]['league_id']                 = $wnews['league_id'];            
                $data['waiver_news'][$k]['league_name']               = $wnews['league_name'];              
                $data['waiver_news'][$k]['league_logo']               = $wnews['league_logo'];
                
                $data['waiver_news'][$k]['channel_name']              = $wnews['channel_name'];
                //$data['waiver_news'][$k]['news_category']              = $fltr['news_category'];


               
                $news_type = 'waiver';
                $admin_activity = $this->dashboard_model->get_activity_by_news($wnews['rss_waiver_id'],$news_type);
                $x=0;
                foreach($admin_activity as $val){
                    $data['waiver_news'][$k]['activity'][$x]['activity_user']     = $this->dashboard_model->get_username_by_id($val['activity_user_id']);
                    $data['waiver_news'][$k]['activity'][$x]['activity_action']   = $val['activity_action']; 
                    $x++;                
                }

                $k++;
            }            
            $this->load->view('waiver_listing',$data);
        }else{
            echo "END";
        }


        // header("Content-type: application/json");
        // echo json_encode($data['waiver_news']);

    }

    public function player_news_listing(){
        $fltr['leagueID']   =($this->input->post('leagueId'))?$this->input->post('leagueId'):'';
        $fltr['teamID']     =($this->input->post('teamId'))?$this->input->post('teamId'):'';
        $fltr['newsType']   =($this->input->post('news_type')!='')?$this->input->post('news_type'):'';
        $fltr['dateFrom']   =($this->input->post('from_date'))?$this->input->post('from_date'):'';
        $fltr['dateTo']     =($this->input->post('to_date'))?$this->input->post('to_date'):'';
        $fltr['name_abbr']  =($this->input->post('name_abbr'))?$this->input->post('name_abbr'):'';
        $fltr['position']  =($this->input->post('position'))?$this->input->post('position'):'';
        //$fltr['news_category']     = ($this->input->post('newsCategory'))?$this->input->post('newsCategory'):'';
        $kroo['player_news']=$this->dashboard_model->player_news_listing($fltr['leagueID'],$fltr['newsType'],$fltr['dateFrom'],$fltr['dateTo'],$fltr['teamID'],$fltr['name_abbr'],$fltr['position'] );

        $k=0;
        if(count($kroo['player_news'])>0){
            foreach($kroo['player_news'] as $pnews){

                $dd = strtotime($pnews['rss_player_created_at']);

                $data['player_news'][$k]['rss_player_id']             = $pnews['rss_player_id'];               
                $data['player_news'][$k]['rss_player_title']          = $pnews['rss_player_title'];
                $data['player_news'][$k]['rss_player_summary']        = $pnews['rss_player_summary'];
                $data['player_news'][$k]['rss_player_image']          = $pnews['rss_player_image'];
                $data['player_news'][$k]['rss_player_url']            = $pnews['rss_player_url'];
                $data['player_news'][$k]['rss_player_created_at']     = date('D d M, Y  g:i a',$dd);                                          
                $data['player_news'][$k]['rss_player_source']         = $pnews['rss_player_source'];
                $data['player_news'][$k]['rss_player_is_deleted']     = $pnews['rss_player_is_deleted'];

                
                $data['player_news'][$k]['player_source']             = $pnews['rss_player_source'];
                $data['player_news'][$k]['player_id']                 = $pnews['player_id'];  
                $data['player_news'][$k]['rss_player_news_id']        = $pnews['rss_player_news_id'];              
                $data['player_news'][$k]['player_title']              = $pnews['player_title'];
                $data['player_news'][$k]['player_summary']            = $pnews['player_summary'];
                $data['player_news'][$k]['player_image']              = $pnews['player_image'];
                $data['player_news'][$k]['player_url']                = $pnews['player_url'];

                $data['player_news'][$k]['player_published_at']       = $pnews['player_published_at'];
                $data['player_news'][$k]['player_notified_at']        = $pnews['player_notified_at'];
                $data['player_news'][$k]['player_is_deleted']         = $pnews['player_is_deleted'];
                $data['player_news'][$k]['player_edited_by_admin_id'] = $pnews['player_edited_by_admin_id']; 

                $data['player_news'][$k]['league_id']                 = $pnews['league_id'];            
                $data['player_news'][$k]['league_name']               = $pnews['league_name'];              
                $data['player_news'][$k]['league_logo']               = $pnews['league_logo'];

                $data['player_news'][$k]['team_id']                   = $pnews['team_id'];            
                $data['player_news'][$k]['team_name']                 = $pnews['team_name'];              
                $data['player_news'][$k]['team_logo']                 = $pnews['team_logo'];
                
                $data['player_news'][$k]['channel_name']              = $pnews['channel_name'];
                //$data['player_news'][$k]['news_category']              = $fltr['news_category'];


               
                $news_type = 'player';
                $admin_activity = $this->dashboard_model->get_activity_by_news($pnews['rss_player_id'],$news_type);
                $x=0;
                foreach($admin_activity as $val){
                    $data['player_news'][$k]['activity'][$x]['activity_user']     = $this->dashboard_model->get_username_by_id($val['activity_user_id']);
                    $data['player_news'][$k]['activity'][$x]['activity_action']   = $val['activity_action']; 
                    $x++;                
                }

                $k++;
            }
            $this->load->view('player_listing',$data);
        }else{
            echo "END";
        }

        // header("Content-type: application/json");
        // echo json_encode($data['player_news']);

    }
        
    // End of My code


    public function update_news(){ 

        $image_name = $this->input->post('news_img');		
        $tab_index = $this->input->post('edit_tab_index');
        $edit_news_category = $this->input->post('edit_news_category');
        $news_id = $this->input->post('edit_news_id');
        $news_title =  addslashes($this->input->post('edit_news_title'));
        $news_summary = addslashes($this->input->post('edit_news_summary'));
        $news_url = $this->input->post('edit_news_url');
        $edited_by_id = $this->session->userdata('id');
        $news_image_url = $this->input->post('news_image_url');
        $news_source = $this->input->post('edit_news_source');
        $team_id = $this->input->post('news_league_id');
        $edit_news_tags = $this->input->post('edit_news_tags');

        $responce = $this->dashboard_model->update_news($news_id,$news_title,$news_summary,$news_url,$edited_by_id,$team_id,$news_source,$edit_news_category,$edit_news_tags);    

        $user_id = $this->session->userdata("id");
        $this->dashboard_model->news_edit_activity($news_id, $tab_index, $user_id);
        
        if(!empty(trim($image_name))){
            $this->dashboard_model->update_image($news_id,$image_name,$tab_index);

            if($tab_index==3){
                echo articleimage.$image_name; 
                //$image_url = 'https://kroo-images.s3.amazonaws.com/articleimage/'.$image_name;
            }
            else{
                echo newsimage.$image_name; 
                //$image_url = 'https://kroo-images.s3.amazonaws.com/newsimages/'.$image_name;
            }

            /*$ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $image_url);
            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);*/

        }else{
            echo 'false';  // false for not updating image
        }
    }

    public function add_news($tab_index){
        $news_title =  addslashes($this->input->post('news_title'));
        $news_summary = addslashes($this->input->post('news_summary'));
        $news_url = ($this->input->post('news_url'))?$this->input->post('news_url'):'';
        $league_id =($this->input->post('news_league_id'))? $this->input->post('news_league_id'):0;
        $team_id = ($this->input->post('news_team_id'))?$this->input->post('news_team_id'):0;
        $img = ($this->input->post('news_img'))?$this->input->post('news_img'):'';
        $responce = $this->dashboard_model->add_news($tab_index,$news_title,$news_summary,$news_url,$league_id,$team_id,$img);

        header("Content-type: application/json");
        echo json_encode($responce);
    }

    public function add_player_news($tab_index){
        $news_title =  addslashes($this->input->post('news_title'));
        $news_summary = addslashes($this->input->post('news_summary'));
        $news_url = $this->input->post('news_url');
        $league_id = $this->input->post('news_league_id');
        $player_name = $this->input->post('txt_player_name');
        $team_code = $this->input->post('txt_player_code');
        $name_abbr = strtolower(str_replace(" ","-",$player_name));
        $img = ($this->input->post('news_img'))?$this->input->post('news_img'):'';

        $responce = $this->dashboard_model->add_player_news($tab_index,$news_title,$news_summary,$news_url,$league_id,$name_abbr,$team_code,$img);

        header("Content-type: application/json");
        echo json_encode($responce);
    }

    public function get_player_suggestion(){
        $keyword = $this->input->post('keyword');
        $responce = $this->dashboard_model->get_player_suggestion($keyword);

        header("Content-type: application/json");
        echo json_encode($responce);
    }

    public function update_fantasy_news(){
        $news_id = $this->input->post('edit_news_id');
        $news_title =  addslashes($this->input->post('edit_news_title'));
        $news_summary = addslashes($this->input->post('edit_news_summary'));
        $news_url = $this->input->post('edit_news_url');
        $edited_by_id = $this->session->userdata('id');
        $responce = $this->dashboard_model->update_fantasy_news($news_id,$news_title,$news_summary,$news_url,$edited_by_id);

        header("Content-type: application/json");
        echo json_encode($responce);
    }

    public function newspublished($news_id,$tab_index){		                   
        $user_id = $this->session->userdata('id');
        $this->dashboard_model->news_publish_activity($news_id, $tab_index, $user_id);
        $result = $this->dashboard_model->newsPublish($news_id,$user_id);
        if($result != 'update'){
            foreach($result as $val){ 
                $team_id = $val['team_id']; 
                $league_id = $val['league_id']; 
                $newsCategory = $val['news_category'];
                $news_data = array(                        
                        'rss_sports_news_id'    => $val['id'],
                        'title'                 => $val['title'],
                        'summary'       => $val['summary'],
                        'details' => $val['details'],
                        'image' => $val['image'],
                        'published_at' => time(),
                        'channel_published_at' =>$val['channel_published_at'],
                        'url' => $val['url'],
                        'source' => $val['source'],
                        'channel' => $val['channel'],
                        'news_category' => $val['news_category']
                    );
                $result = $this->dashboard_model->insert_published_news($news_data,$news_id,$team_id,$newsCategory,$league_id);     	
            }            
        }

        header("Content-type: application/json");
        echo json_encode($result);  
    }

    public function hide_kroo_news($news_id,$tab_index){ //1282  
        $user_id = $this->session->userdata('id');
        $this->dashboard_model->news_hide_activity($news_id, $tab_index, $user_id);
        $result = $this->dashboard_model->hide_kroo_news($news_id, $tab_index);
        //$result = "kroo";
        header("Content-type: application/json");
        echo json_encode($result);
    }

    public function get_league_team($news_id){
        $result = $this->dashboard_model->get_league_team($news_id);

        header("Content-type: application/json");
        echo json_encode($result);
    }

    public function copy_news(){
        $news_id = $this->input->post('news_id');
        $team_id = $this->input->post('team_id');
        $news_category = $this->input->post('news_category');

        $result = $this->dashboard_model->copy_news($news_id,$team_id,$news_category);

        header("Content-type: application/json");
        echo json_encode($result);
    }

   

   public function check_team($news_id, $tab_index){

        $result = $this->dashboard_model->check_team($news_id,$tab_index);
        header("Content-type: application/json");
        echo json_encode($result);

   }

    public function push_content($news_id, $tab_index=0,$level){	
        //$tab_index =0;
        $user_id = $this->session->userdata('id');
        $this->dashboard_model->news_notify_activity($news_id, $tab_index, $user_id);
        $newsIdForNotify = $news_id;
        $publish = $this->dashboard_model->newsPublishNotified($news_id, $user_id);
        $newsCategory = 0;
        if($publish != 'update'){
            $val= $publish[0];
            $team_id = $val['team_id'];
            $league_id = $val['league_id'];   
            $newsCategory = $val['news_category'];
            $news_data = array(                        
                    'rss_sports_news_id'    => $val['id'],
                    'title'                 => $val['title'],
                    'summary'       => $val['summary'],
                    'details' => $val['details'],
                    'image' => $val['image'],
                    'published_at' => time(),
                    'notified_at' => time(),
                    'url' => $val['url'],
                    'channel_published_at' =>$val['channel_published_at'],
                    'source' => $val['source'],
                    'channel' => $val['channel'],
                    'news_category' => $val['news_category']
                ); 
            $this->dashboard_model->insert_published_news($news_data,$news_id,$team_id,$newsCategory,$league_id);
        }
        
        $this->dashboard_model->update_notify($newsIdForNotify, $tab_index);

        $contentAry = $this->dashboard_model->getDeviceInfo($newsIdForNotify, $newsCategory,$level);      
//echo "Hell44o"; exit;
        $androidDeviceidAry = [];
        $iosDeviceidAry = [];
        foreach ($contentAry as $key => $value) {                       

            if($value['device_type'] == 'Android' && $value['notification_status'] == 1){

                $androidDeviceidAry[] = $value['device_token'];   
            } elseif ($value['device_type'] == 'ios' && $value['notification_status'] == 1) {
                if(!empty(trim($value['aws_arn']))){
                    $iosDeviceidAry[] = $value['aws_arn'];
                    unset($contentAry[$key]['aws_arn']);
                    unset($contentAry[$key]['device_token']);
                }
            }
        }
        
        $contentAry[0]['details'] = substr(strip_tags($contentAry[0]['details']),0,100);
        $android_res = null;
        if (count($androidDeviceidAry)>1110) {
            
            $registrationIds = array();
            foreach ($contentAry as $key => $value) {
                if($value['device_type'] == 'Android' ){
                    $registrationIds[] = $value['device_token'];
                    unset($contentAry[$key]['device_token']);
                }
            }

            $msg = array(
                'title' => $contentAry[0]['title'],
                'data' => $contentAry[0],
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

        $ios_res=null;
        $response['content'] = $contentAry[0];
        $response['ios_arn'] = $iosDeviceidAry;
        if(count($iosDeviceidAry)>1110){
            $CurlConnect = curl_init();
            $req = json_encode(array('ios_arn_arr'=>$response['ios_arn'],'ios_content'=>$response['content']));
            curl_setopt($CurlConnect, CURLOPT_URL, NOTIFICATION_API_PATH.'ios_push');
            curl_setopt($CurlConnect, CURLOPT_POST,   1);
            curl_setopt($CurlConnect, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt($CurlConnect, CURLOPT_POSTFIELDS, $req);

            curl_setopt($CurlConnect, CURLOPT_HTTPHEADER, array(                                                                          
               'Content-Type: application/json',                                                                                
               'Content-Length: ' . strlen($req))                                                                       
            );

            $Result = curl_exec($CurlConnect);
            $ios_res = json_decode($Result);
        }
        
        $data['contentAry'] = $contentAry;
        $data['android_res'] = $android_res;
        $data['ios_res'] = $ios_res;


        header("Content-type: application/json");
        echo json_encode($data);   

    }


    public function checkAppleErrorResponse($fp) {

        $apple_error_response = fread($fp, 6);

        if ($apple_error_response) {

                $error_response = unpack('Ccommand/Cstatus_code/Nidentifier', $apple_error_response); 

                if ($error_response['status_code'] == '0') {
                $error_response['status_code'] = '0-No errors encountered';

                } else if ($error_response['status_code'] == '1') {
                $error_response['status_code'] = '1-Processing error';

                } else if ($error_response['status_code'] == '2') {
                $error_response['status_code'] = '2-Missing device token';

                } else if ($error_response['status_code'] == '3') {
                $error_response['status_code'] = '3-Missing topic';

                } else if ($error_response['status_code'] == '4') {
                $error_response['status_code'] = '4-Missing payload';

                } else if ($error_response['status_code'] == '5') {
                $error_response['status_code'] = '5-Invalid token size';

                } else if ($error_response['status_code'] == '6') {
                $error_response['status_code'] = '6-Invalid topic size';

                } else if ($error_response['status_code'] == '7') {
                $error_response['status_code'] = '7-Invalid payload size';

                } else if ($error_response['status_code'] == '8') {
                $error_response['status_code'] = '8-Invalid token';

                } else if ($error_response['status_code'] == '255') {
                $error_response['status_code'] = '255-None (unknown)';

                } else {
                $error_response['status_code'] = $error_response['status_code'].'-Not listed';

                }

                echo 'Response Command:- ' . $error_response['command'] . ', Identifier:- ' . $error_response['identifier'] . ', Status:<b>' . $error_response['status_code'] . '';

                return true;
        }

        return false;
    }

    public function mass_publish(){
        $ids = $this->input->post('ids');
        $tab_index = $this->input->post('tab_index');
        $user_id = $this->session->userdata('id');
        foreach($ids as $news_id){              

            $this->dashboard_model->news_publish_activity($news_id, $tab_index, $user_id);
            $result = $this->dashboard_model->newsPublish($news_id,$user_id,$tab_index);
            if($result != 'update'){
                foreach($result as $val){ 
                    $team_id = $val['team_id']; 
                    $league_id = $val['league_id'];   
                    $newsCategory = $val['news_category'];
                    $news_data = array(                        
                    'rss_sports_news_id'    => $val['id'],
                    'title'                 => $val['title'],
                    'summary'       => $val['summary'],
                    'details' => $val['details'],
                    'image' => $val['image'],
                    'published_at' => time(),
                    'channel_published_at' =>$val['channel_published_at'],
                    'url' => $val['url'],
                    'source' => $val['source'],
                    'news_category' => $val['news_category'],
                    'channel' => $val['channel']
                    );
                    $result = $this->dashboard_model->insert_published_news($news_data,$news_id,$team_id,$newsCategory,$league_id);       
                }          
            }       
        }           

       if(!empty($ids)){

            header("Content-type: application/json");
            echo json_encode(true);
       }else{
            header("Content-type: application/json");
            echo json_encode(false);
       }

    }

    public function news_read_activity(){
        $news_id = $this->input->post('news_id');
        $tab_index = $this->input->post('tab_index');
        $user_id = $this->session->userdata('id');

        $result = $this->dashboard_model->news_read_activity($news_id, $tab_index, $user_id);

        header("Content-type: application/json");
        echo json_encode($result);
    }

    public function get_news_team_detail($team_id){           

        $responce = $this->dashboard_model->get_news_team_detail($team_id);
        $k=0;
        foreach($responce as $val){
            $data['league_id'] = $val['league_id'];
            $data['league_name'] = $val['name'];
            $responce['league_teams'] = $this->dashboard_model->league_teams($val['league_id']);
                $i=0;
                foreach($responce['league_teams'] as $league_teams){
                    $data['team'][$i]['league_team_id']     = $league_teams['id'];
                    $data['team'][$i]['league_team_name']   = $league_teams['name'];
                    $data['team'][$i]['league_team_logo']   = $league_teams['logo'];
                    $i++;
                }
            $k++;
        }

        header("Content-type: application/json");
        echo json_encode($data);

    }

    public function select_news_league($league_id){
        $responce['league_teams'] = $this->dashboard_model->league_teams($league_id);
        $i=0;
        foreach($responce['league_teams'] as $league_teams){
            $data['team'][$i]['league_team_id']     = $league_teams['id'];
            $data['team'][$i]['league_team_name']   = $league_teams['name'];
            $data['team'][$i]['league_team_logo']   = $league_teams['logo'];
            $i++;
        }

        header("Content-type: application/json");
        echo json_encode($data);            
    }

    public function getrssdata(){

        $xml=("http://espn.go.com/espn/rss/nfl/news");
        $xmlDoc = new DOMDocument();
        $xmlDoc->load($xml);
        $channel=$xmlDoc->getElementsByTagName('item');
        $news_count = $channel->length;           
       // echo $news_count;            
       for($i=0;$i<$news_count;$i++){
            $channel=$xmlDoc->getElementsByTagName('item')->item($i);

            $data[$i]['title']      = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
            $data[$i]['link']         = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
            $data[$i]['description']       = $channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
            $data[$i]['publish_at']     = $channel->getElementsByTagName('pubDate')->item(0)->childNodes->item(0)->nodeValue;
            $data[$i]['rss_news_id']     = $channel->getElementsByTagName('guid')->item(0)->childNodes->item(0)->nodeValue;
       }       

        header("Content-type: application/json");
        echo json_encode($data);   
    }

    /* Getty Image */
    public function gettyauth(){
        /**
        * Authenticate with the OAuth2 client credentials flow
        */

        $endpoint = "https://api.gettyimages.com/oauth2/token";
        $curl = getCurlForFormPost($endpoint);
        setFormData($curl, array("grant_type" => "client_credentials",
                                 "client_id" => $this->apiKey,
                                 "client_secret" => $this->apiSecret));

        $resultObj = executeCurl($curl);
        $response = json_decode($resultObj['body'],true);

        $this->token = $response["access_token"];
        $this->tokenType = $response["token_type"];
    }

    public function searchgetty($search_text){  
        if($search_text==''){
            echo json_encode(array('responseText' => "Search Text Empty!" ));  
            exit;
        }
        $endpoint = "https://api.gettyimages.com/v3/search/images/editorial";
        $queryParams = array("phrase" => $search_text,"fields"=>"detail_set");
        //$queryParams = array("phrase" => $search_text,"editorial_segments" => "sport","fields" => "product_types,editorial_segments,asset_family,call_for_image,caption, collection_code,collection_id,collection_name, copyright,date_created,editorial_segments,event_ids,title,uri_oembed");
        $endpoint = $endpoint. (strpos($endpoint, '?') === FALSE ? '?' : ''). http_build_query($queryParams);

        $curl = getCurl($endpoint);
        curl_setopt($curl,CURLOPT_HTTPHEADER,array("Api-Key:".$this->apiKey));

        $response = json_decode(executeCurl($curl)['body'],true);
        echo json_encode(array('payload'=>$response));
    }

    public function downloadImage($imageIdToGet) {
        if($imageIdToGet==''){
            echo json_encode(array('responseText' => "Invalid Download!"));  
            exit;
        }

        $this->gettyauth(); // reset the token and tokenType

        $endpoint = "https://api.gettyimages.com/v3/downloads/images/$imageIdToGet?height=2000&auto_download=false";

        $headersToSend = array(CURLOPT_HTTPHEADER => array("Api-Key:".$this->apiKey,
                               "Authorization: ".$this->tokenType." ".$this->token,"Content-Type:"),
                                CURLOPT_FOLLOWLOCATION => TRUE); //this lets curl follow the 303

        $curl = getCurlForPost($endpoint,$headersToSend);
        $response = executeCurl($curl);

        $filename  = 'uploads/'. $imageIdToGet .'.jpg';
        file_put_contents($filename, json_decode($response['body'])->uri);
         echo json_encode(array('responseText' => "Downloaded successfully!"));
    }

    public function update_news_detail(){ 
        $news_detail = $this->input->post('editor1');      
        $news_id = $this->input->post('detail_id'); //echo $news_detail.$news_id ; die; 
        $responce = $this->dashboard_model->update_news_detail($news_detail,$news_id); 

            header("Content-type: application/json");
            echo json_encode($responce);
    }

    // get news details field for edit/ update details
    public function get_detail($news_id,$tab_index){
        $result = $this->dashboard_model->get_detail($news_id,$tab_index);

        header("Content-type: application/json");
        echo json_encode($result);
   }
   // get news row
   public function get_rss_news_detail($news_id){
        $result = $this->dashboard_model->get_rss_news_detail($news_id);

        header("Content-type: application/json");
        echo json_encode($result);
   }

   // get news row
   public function get_news_detail($news_id,$news_category=2){
        $result = $this->dashboard_model->get_news_detail($news_id,$news_category);

        header("Content-type: application/json");
        echo json_encode($result);
   }
	
}
