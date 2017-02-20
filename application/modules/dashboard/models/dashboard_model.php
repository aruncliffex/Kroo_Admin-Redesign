<?php
class Dashboard_model extends Model {
    
    public function kroo_news_list($channelID,$leagueID,$teamID,$newsType,$dateFrom,$dateTo,$news_category=array('2')){
        $this->db->select_max('id');
        $max = $this->db->get('rss_sports_news')->row()->id;
        $maxId=500;
        $this->db->select("rsn.id as rss_sports_id, rsn.team_id as rss_team_id, t.name as rss_team_name, t.logo as rss_team_logo, IF(rsn.news_category = 31 ,lg.id,l.id ) as rss_league_id, IF(rsn.news_category = 31 ,lg.name,l.name ) as rss_league_name, IF(rsn.news_category = 31 ,lg.logo,l.logo ) as rss_league_logo, rsn.title as rss_sports_title,rsn.summary as rss_sports_summary,rsn.news_category, rsn.image as rss_sports_image, FROM_UNIXTIME(rsn.channel_published_at) as rss_sports_created_at, rsn.url as rss_sports_url, rsn.source as rss_sports_source, rsn.is_deleted as rss_sports_is_deleted, sn.source as sports_source,
           sn.id as sports_id,sn.rss_sports_news_id,sn.title as sports_title,sn.summary as sports_summary, sn.image as sports_image, sn.tags, sn.published_at as sports_published_at, 
           sn.updated_at as sports_updated_at, sn.url as sports_url, sn.notified_at as sports_notified_at, sn.edited_by_admin_id as sports_edited_by_admin_id, sn.is_deleted as sports_is_deleted,tm.value as channel_name, g.id as game_id");
        $this->db->from('rss_sports_news rsn');
        $this->db->join('sports_news as sn','sn.rss_sports_news_id = rsn.id','left');
        $this->db->join('teams as t','rsn.team_id=t.id','left');
        $this->db->join('leagues as l','t.league_id=l.id','left');
        $this->db->join('leagues as lg','rsn.league_id=lg.id','left');
        $this->db->join('type_master as tm','rsn.channel = tm.id','left');
        $this->db->join('game as g','g.news_id = rsn.id','left');
        $this->db->where('rsn.content_type !=','26');
        if($channelID > 0){
            $this->db->where('rsn.channel',$channelID);
            $maxId=1000;
        }
        if($leagueID>0){
            $this->db->where('IF(rsn.news_category = 31, `lg`.`id`, `l`.`id` ) = ',$leagueID);
            $maxId+=500;
        }
        if($teamID>0){
            $this->db->where('rsn.team_id',$teamID);
            $maxId=$max;
        }
        if($newsType >= '0'){
            if($newsType == '0')
                $this->db->where('sn.published_at IS NULL', null, false);
            if($newsType == '1')
                 $this->db->where('sn.published_at !=', '0');
            if($newsType == '3')
                $this->db->where('sn.notified_at !=', '0');
            $maxId+=500;
        }
        $lmt=50+$this->input->post('lmt');
        $maxId=($lmt/50)*$maxId;
        $maxId=$max-$maxId;
        $maxId=($maxId>1)?10000:1;

        if(!empty($dateFrom) && !empty($dateTo)){
            $this->db->where("(FROM_UNIXTIME(rsn.channel_published_at) BETWEEN '". $dateFrom . "' AND '" . $dateTo ."')");
        }
        $this->db->where('rsn.id >=',$maxId);
        $this->db->where("rsn.is_deleted !='1'");
        $this->db->where_in("rsn.news_category",$news_category);
        $this->db->order_by("FROM_UNIXTIME(rsn.channel_published_at)","DESC");
        $this->db->limit(50,$this->input->post('lmt'));
        $query=$this->db->get();
        echo $this->db->last_query();
        return $query->result_array();
    }
    

    public function kroo_news_video($channelID,$leagueID,$teamID,$newsType,$dateFrom,$dateTo,$news_category=2,$content_type){
        $this->db->select_max('id');
        $max = $this->db->get('rss_sports_news')->row()->id;
        $maxId=500;
        $this->db->select("rsn.id as rss_sports_id, rsn.team_id as rss_team_id,t.name as rss_team_name,t.logo as rss_team_logo, lg.id as rss_league_id, lg.name as rss_league_name,lg.logo as rss_league_logo, rsn.title as rss_sports_title,rsn.summary as rss_sports_summary, rsn.image as rss_sports_image, FROM_UNIXTIME(rsn.channel_published_at) as rss_sports_created_at, rsn.url as rss_sports_url, rsn.source as rss_sports_source, rsn.is_deleted as rss_sports_is_deleted, sn.source as sports_source,
           sn.id as sports_id,sn.rss_sports_news_id,sn.title as sports_title,sn.summary as sports_summary, sn.image as sports_image, sn.tags, sn.published_at as sports_published_at, 
           sn.updated_at as sports_updated_at, sn.url as sports_url, sn.notified_at as sports_notified_at, sn.edited_by_admin_id as sports_edited_by_admin_id, sn.is_deleted as sports_is_deleted,tm.value as channel_name, g.id as game_id");
        $this->db->from('rss_sports_news rsn');
        $this->db->join('sports_news as sn','sn.rss_sports_news_id = rsn.id','left');
        $this->db->join('teams as t','rsn.team_id=t.id','left');
        $this->db->join('leagues as lg','rsn.league_id=lg.id','left');
        $this->db->join('type_master as tm','rsn.channel = tm.id','left');
        $this->db->join('game as g','g.news_id = rsn.id','left');
        if($channelID > 0){
            $this->db->where('rsn.channel',$channelID);
            $maxId=1000;
        }
        if($leagueID>0){
            $this->db->where('lg.id',$leagueID);
            $maxId+=500;
        }
        if($teamID>0){
            $this->db->where('rsn.team_id',$teamID);
            $maxId=$max;
        }
        if($newsType >= '0'){
            if($newsType == '0')
                $this->db->where('sn.published_at IS NULL', null, false);
            if($newsType == '1')
                 $this->db->where('sn.published_at !=', '0');
            if($newsType == '3')
                $this->db->where('sn.notified_at !=', '0');
            $maxId+=500;
        }
        $lmt=50+$this->input->post('lmt');
        $maxId=($lmt/50)*$maxId;
        $maxId=$max-$maxId;
        $maxId=($maxId>1)?$maxId:1;
        $maxId=($maxId>1 && $news_category==2)?$maxId:1;

        if(!empty($dateFrom) && !empty($dateTo)){
            $this->db->where("(FROM_UNIXTIME(rsn.channel_published_at) BETWEEN '". $dateFrom . "' AND '" . $dateTo ."')");
        }
        //$this->db->where('rsn.id >=',$maxId);
        $this->db->where("( rsn.is_deleted !='1' AND rsn.news_category = $news_category AND rsn.content_type = $content_type)");
        $this->db->order_by('FROM_UNIXTIME(rsn.channel_published_at)','DESC');
        $this->db->limit(50,$this->input->post('lmt'));
        $query=$this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }



    public function kroo_news_search($search_key, $tab_index){    
        $maxId=1;
        if($tab_index == 0){
            $this->db->select("rsn.id as rss_sports_id, rsn.team_id as rss_team_id,t.name as rss_team_name,t.logo as rss_team_logo, l.id as rss_league_id, l.name as rss_league_name, rsn.title as rss_sports_title,rsn.summary as rss_sports_summary, rsn.image as rss_sports_image, FROM_UNIXTIME(rsn.channel_published_at) as rss_sports_created_at, rsn.url as rss_sports_url, rsn.source as rss_sports_source, rsn.is_deleted as rss_sports_is_deleted, sn.source as sports_source,
               sn.id as sports_id,sn.rss_sports_news_id,sn.title as sports_title,sn.summary as sports_summary, sn.image as sports_image, sn.published_at as sports_published_at, 
               sn.updated_at as sports_updated_at, sn.url as sports_url, sn.notified_at as sports_notified_at, sn.edited_by_admin_id as sports_edited_by_admin_id, sn.is_deleted as sports_is_deleted,tm.value as channel_name");
            $this->db->from('rss_sports_news rsn');
            $this->db->join('sports_news as sn','sn.rss_sports_news_id = rsn.id','left');
            $this->db->join('teams as t','rsn.team_id=t.id','left');
            $this->db->join('leagues as l','t.league_id=l.id','left');
            $this->db->join('type_master as tm','rsn.channel = tm.id','left');
            $this->db->where('rsn.content_type !=','26');
            $this->db->where('rsn.id >=',$maxId);
            $this->db->where("( rsn.is_deleted !='1' AND rsn.news_category = 2)");
            $this->db->where("sn.title LIKE '%$search_key%' OR rsn.title LIKE '%$search_key%' ");
            $this->db->order_by('FROM_UNIXTIME(rsn.channel_published_at)','DESC');
            //$this->db->limit(50,$this->input->post('lmt'));
            $query=$this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();
            
        }else if($tab_index == 1){
             $this->db->select("rsn.id as rss_sports_id, rsn.team_id as rss_team_id,t.name as rss_team_name,t.logo as rss_team_logo, l.id as rss_league_id, l.name as rss_league_name, rsn.title as rss_sports_title,rsn.summary as rss_sports_summary, rsn.image as rss_sports_image, FROM_UNIXTIME(rsn.channel_published_at) as rss_sports_created_at, rsn.url as rss_sports_url, rsn.source as rss_sports_source, rsn.is_deleted as rss_sports_is_deleted, sn.source as sports_source,
               sn.id as sports_id,sn.rss_sports_news_id,sn.title as sports_title,sn.summary as sports_summary, sn.image as sports_image, sn.published_at as sports_published_at, 
               sn.updated_at as sports_updated_at, sn.url as sports_url, sn.notified_at as sports_notified_at, sn.edited_by_admin_id as sports_edited_by_admin_id, sn.is_deleted as sports_is_deleted,tm.value as channel_name");
            $this->db->from('rss_sports_news rsn');
            $this->db->join('sports_news as sn','sn.rss_sports_news_id = rsn.id','left');
            $this->db->join('teams as t','rsn.team_id=t.id','left');
            $this->db->join('leagues as l','t.league_id=l.id','left');
            $this->db->join('type_master as tm','rsn.channel = tm.id','left');
            $this->db->where('rsn.content_type !=','26');
            $this->db->where('rsn.id >=',$maxId);
            $this->db->where("( rsn.is_deleted !='1' AND rsn.news_category = 31)");
            $this->db->where("sn.title LIKE '%$search_key%' OR rsn.title LIKE '%$search_key%' ");
            $this->db->order_by('FROM_UNIXTIME(rsn.channel_published_at)','DESC');
            //$this->db->limit(50,$this->input->post('lmt'));
            $query=$this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();

        }else if($tab_index == 2){
            $this->db->select("rpn.id as rss_player_id,rpn.league_id as league_id,l.name as league_name,l.logo as league_logo,t.id as team_id,t.name as team_name,t.logo as team_logo,  rpn.title as rss_player_title, rpn.summary as rss_player_summary,rpn.image as rss_player_image, rpn.team_code as    rss_player_team_code, rpn.name_abbr as rss_player_name_abbr, rpn.created_at as rss_player_created_at, rpn.url as rss_player_url, rpn.source as rss_player_source, rpn.is_deleted as rss_player_is_deleted,pn.id as player_id, pn.rss_player_news_id, pn.title as player_title, pn.summary as player_summary, pn.image as player_image, pn.published_at as player_published_at,pn.url as player_url, pn.source as player_source, pn.notified_at as player_notified_at, pn.edited_by_admin_id as player_edited_by_admin_id, pn.is_deleted as player_is_deleted,tm.value as channel_name 
                FROM rss_player_news as rpn
                LEFT JOIN player_news as pn ON pn.rss_player_news_id= rpn.id
                LEFT JOIN leagues as l on l.id=rpn.league_id
                LEFT JOIN type_master as tm ON rpn.channel = tm.id
                LEFT JOIN teams as t on t.code = rpn.team_code AND t.league_id = rpn.league_id
                LEFT JOIN players as p on p.name_abbr = rpn.name_abbr");
                $this->db->where('rpn.id >=',$maxId);
                $this->db->where("rpn.is_deleted !='1'");
                $this->db->where("pn.title LIKE '%$search_key%' OR rpn.title LIKE '%$search_key%' ");
                $this->db->order_by('FROM_UNIXTIME(rpn.channel_published_at)','DESC');
                $query=$this->db->get();
                echo $this->db->last_query();
                return $query->result_array();

        }else if($tab_index == 3){
            $this->db->select("rwn.id as rss_waiver_id,rwn.league_id as league_id,l.name as league_name,l.logo as league_logo, rwn.title as rss_waiver_title, rwn.summary as rss_waiver_summary, rwn.image as rss_waiver_image, rwn.team_code as    rss_waiver_team_code, rwn.name_abbr as rss_waiver_name_abbr, rwn.created_at as rss_waiver_created_at, rwn.url as rss_waiver_url, rwn.source as rss_waiver_source,rwn.is_deleted as rss_waiver_is_deleted, wn.id as waiver_id, wn.rss_waiver_news_id, wn.title as waiver_title, wn.summary as waiver_summary, wn.image as waiver_image, wn.published_at as waiver_published_at,wn.url as waiver_url, wn.source as waiver_source, wn.notified_at as waiver_notified_at, wn.edited_by_admin_id as waiver_edited_by_admin_id, wn.is_deleted as waiver_is_deleted,tm.value as channel_name
                FROM rss_waiver_news as rwn
                LEFT JOIN waiver_news as wn ON wn.rss_waiver_news_id= rwn.id
                LEFT JOIN leagues as l ON l.id = rwn.league_id
                LEFT JOIN type_master as tm ON rwn.channel = tm.id");
                $this->db->where('rwn.id >=',$maxId);
                $this->db->where("rwn.is_deleted !='1'");
                $this->db->where("wn.title LIKE '%$search_key%' OR rwn.title LIKE '%$search_key%' ");
                $this->db->order_by('FROM_UNIXTIME(rwn.channel_published_at)','DESC');
                $query=$this->db->get();
                //echo $this->db->last_query();
                return $query->result_array();
        }
    }

    public function waiver_news_listing($leagueID,$newsType,$dateFrom,$dateTo){
        $maxId=1;
        $this->db->select("rwn.id as rss_waiver_id,rwn.league_id as league_id,l.name as league_name,l.logo as league_logo, rwn.title as rss_waiver_title, rwn.summary as rss_waiver_summary, rwn.image as rss_waiver_image, rwn.team_code as    rss_waiver_team_code, rwn.name_abbr as rss_waiver_name_abbr, rwn.created_at as rss_waiver_created_at, rwn.url as rss_waiver_url, rwn.source as rss_waiver_source,rwn.is_deleted as rss_waiver_is_deleted, wn.id as waiver_id, wn.rss_waiver_news_id, wn.title as waiver_title, wn.summary as waiver_summary, wn.image as waiver_image, wn.published_at as waiver_published_at,wn.url as waiver_url, wn.source as waiver_source, wn.notified_at as waiver_notified_at, wn.edited_by_admin_id as waiver_edited_by_admin_id, wn.is_deleted as waiver_is_deleted,tm.value as channel_name
            FROM rss_waiver_news as rwn
            LEFT JOIN waiver_news as wn ON wn.rss_waiver_news_id= rwn.id
            LEFT JOIN leagues as l ON l.id = rwn.league_id
            LEFT JOIN type_master as tm ON rwn.channel = tm.id");
        $this->db->where('rwn.id >=',$maxId);
        if($leagueID > 0){
             $this->db->where('rwn.league_id',$leagueID);
        }
        if($newsType >= '0'){
            if($newsType == '0')
                $this->db->where('wn.published_at IS NULL', null, false);
            if($newsType == '1')
                 $this->db->where('wn.published_at !=', '0');
            if($newsType == '3')
                $this->db->where('wn.notified_at !=', '0');
        }
        if(!empty($dateFrom) && !empty($dateTo)){
            $this->db->where("rwn.created_at BETWEEN '". $dateFrom . "' AND '" . $dateTo ."'");
        }
        $this->db->order_by('rwn.created_at','DESC');
        $this->db->limit(50,$this->input->post('lmt'));
        $query = $this->db->get();

        return $query->result_array();
    }

    public function player_news_listing_old($leagueID,$newsType,$dateFrom,$dateTo,$teamID,$name_abbr,$position){
        $maxId=1;
        $this->db->select("rpn.id as rss_player_id,rpn.league_id as league_id,l.name as league_name,l.logo as league_logo,t.id as team_id,t.name as team_name,t.logo as team_logo,  rpn.title as rss_player_title, rpn.summary as rss_player_summary,rpn.image as rss_player_image, rpn.team_code as    rss_player_team_code, rpn.name_abbr as rss_player_name_abbr, rpn.created_at as rss_player_created_at, rpn.url as rss_player_url, rpn.source as rss_player_source, rpn.is_deleted as rss_player_is_deleted,pn.id as player_id, pn.rss_player_news_id, pn.title as player_title, pn.summary as player_summary, pn.image as player_image, pn.published_at as player_published_at,pn.url as player_url, pn.source as player_source, pn.notified_at as player_notified_at, pn.edited_by_admin_id as player_edited_by_admin_id, pn.is_deleted as player_is_deleted,tm.value as channel_name 
                FROM rss_player_news as rpn
                LEFT JOIN player_news as pn ON pn.rss_player_news_id= rpn.id
                LEFT JOIN leagues as l on l.id=rpn.league_id
                LEFT JOIN type_master as tm ON rpn.channel = tm.id
                LEFT JOIN teams as t on t.code = rpn.team_code AND t.league_id = rpn.league_id
                LEFT JOIN players as p on p.name_abbr = rpn.name_abbr");
        //$this->db->where('rpn.id >=',$maxId);
        $this->db->where("p.name_abbr = rpn.name_abbr AND p.league_id=rpn.league_id AND t.code = rpn.team_code");
        if($leagueID > 0){
             $this->db->where('rpn.league_id',$leagueID);
        }
        if($teamID > 0){
            $this->db->where('t.id',$teamID);   
        }
        if($name_abbr != ''){
            $this->db->where('rpn.name_abbr',$name_abbr);
        }
        if($position != ''){
            $this->db->where('p.position',$position);
        }
        if($newsType >= '0'){
            if($newsType == '0')
                $this->db->where('pn.published_at IS NULL', null, false);
            if($newsType == '1')
                 $this->db->where('pn.published_at !=', '0');
            if($newsType == '3')
                $this->db->where('pn.notified_at !=', '0');
        }
        if(!empty($dateFrom) && !empty($dateTo)){
            $this->db->where("rpn.created_at BETWEEN '". $dateFrom . "' AND '" . $dateTo ."'");
        }
        $this->db->order_by('rpn.created_at','DESC');
        $this->db->limit(50,$this->input->post('lmt'));
        $query = $this->db->get();
        echo $this->db->last_query();
        return $query->result_array();
    }


    public function player_news_listing($leagueID,$newsType,$dateFrom,$dateTo,$teamID,$name_abbr,$position){
        $maxId=1;
        $this->db->select("rpn.id as rss_player_id,rpn.league_id as league_id,l.name as league_name,l.logo as league_logo,t.id as team_id,t.name as team_name,t.logo as team_logo,  rpn.title as rss_player_title, rpn.summary as rss_player_summary,rpn.image as rss_player_image, rpn.team_code as    rss_player_team_code, rpn.name_abbr as rss_player_name_abbr, rpn.created_at as rss_player_created_at, rpn.url as rss_player_url, rpn.source as rss_player_source, rpn.is_deleted as rss_player_is_deleted,pn.id as player_id, pn.rss_player_news_id, pn.title as player_title, pn.summary as player_summary, pn.image as player_image, pn.published_at as player_published_at,pn.url as player_url, pn.source as player_source, pn.notified_at as player_notified_at, pn.edited_by_admin_id as player_edited_by_admin_id, pn.is_deleted as player_is_deleted,tm.value as channel_name");
        $this->db->from("rss_player_news as rpn");
        $this->db->join("leagues as l","rpn.league_id=l.id","left");
        $this->db->join("type_master as tm","rpn.channel = tm.id","left");
        $this->db->join("teams as t","rpn.team_code = t.code AND rpn.league_id = t.league_id","left");
        $this->db->join("players as p","rpn.name_abbr=p.name_abbr and rpn.league_id=p.league_id","left");        
        $this->db->join("player_news as pn","rpn.id = pn.rss_player_news_id","left");
        //$this->db->where('rpn.id >=',$maxId);
        //$this->db->where("p.name_abbr = rpn.name_abbr AND p.league_id=rpn.league_id AND t.code = rpn.team_code");
        $this->db->where("p.team_id = t.id");
        if($leagueID > 0){
             $this->db->where('rpn.league_id',$leagueID);
        }
        if($teamID > 0){
            $this->db->where('t.id',$teamID);   
        }
        if($name_abbr != ''){
            $this->db->where('rpn.name_abbr',$name_abbr);
        }
        if($position != ''){
            $this->db->where('p.position',$position);
        }
        if($newsType >= '0'){
            if($newsType == '0')
                $this->db->where('pn.published_at IS NULL', null, false);
            if($newsType == '1')
                 $this->db->where('pn.published_at !=', '0');
            if($newsType == '3')
                $this->db->where('pn.notified_at !=', '0');
        }
        if(!empty($dateFrom) && !empty($dateTo)){
            $this->db->where("rpn.created_at BETWEEN '". $dateFrom . "' AND '" . $dateTo ."'");
        }
        $this->db->order_by('rpn.created_at','DESC');
        $this->db->limit(50,$this->input->post('lmt'));
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }



    public function check_team($news_id,$tab_index){
        if($tab_index==2){
            $query = $this->db->query("SELECT team_id FROM rss_sports_news WHERE id=$news_id");
            if($query->num_rows()>0){
                $row = $query->row();
                $team_id = $row->team_id;
                return $team_id;
            }
        }
    }



    public function get_league_team($news_id){
        $query = $this->db->query("SELECT league_id FROM rss_sports_news WHERE id=$news_id AND news_category = 31");
        if($query->num_rows()>0){
            $row = $query->row();
            $league_id = $row->league_id;
            $query = $this->db->query("SELECT * FROM teams WHERE league_id = $league_id");
            return $query->result_array();
        }else{
            $query = $this->db->query("SELECT * FROM teams");
            return $query->result_array();
        }
        
    }

    public function get_all_channels($news_category){
        $query = $this->db->query("SELECT a.channel,b.value FROM `rss_sports_news` a LEFT join type_master b on a.channel=b.id 
                                    where a.news_category=$news_category group by a.channel");
        return $query->result_array();
    }

    public function copy_news($news_id,$team_id,$news_category){
        $rss_item_id = $this->db->query("SELECT rss_item_id FROM rss_sports_news WHERE id=$news_id");
        foreach($rss_item_id->result() as $row){
            $rss_item_id = $row->rss_item_id;
        }

        if($news_category == 2){
            $check = $this->db->query("SELECT * FROM rss_sports_news WHERE rss_item_id = '$rss_item_id' AND news_category = 31");
            if($check->num_rows() == 0){
                $query = $this->db->query("INSERT INTO rss_sports_news (league_id,title,summary,details,image,channel_published_at,url,image_status,rss_item_id,
                                        source,channel,is_deleted,news_category)
                                        SELECT t.league_id as league_id,rsn.title,rsn.summary,rsn.details,rsn.image,rsn.channel_published_at,rsn.url,rsn.image_status,rsn.rss_item_id,
                                        rsn.source,rsn.channel,rsn.is_deleted,31 FROM rss_sports_news as rsn
                                        LEFT JOIN teams as t on t.id = rsn.team_id
                                        WHERE rsn.id=$news_id ");
                $insert_id_rsn = $this->db->insert_id(); 
                $check_in_sn = $this->db->query("SELECT * FROM sports_news WHERE rss_sports_news_id=$insert_id_rsn AND news_category=31");
                if($check_in_sn->num_rows()== 0){
                    $this->db->query("INSERT INTO sports_news (rss_sports_news_id,title,summary,details,image,published_at,channel_published_at,url,
                                        source,channel,news_category)
                                        SELECT $insert_id_rsn,title,summary,details,image,UNIX_TIMESTAMP(),channel_published_at,url,source,channel,31 FROM rss_sports_news
                                        WHERE id=$news_id ");
                    $insert_id_sn = $this->db->insert_id(); 
                    $league_id = $this->db->query("SELECT t.league_id as league_id FROM rss_sports_news as rsn LEFT JOIN teams as t on t.id = rsn.team_id
                                        WHERE rsn.id=$news_id ");
                    foreach($league_id->result() as $row){
                        $league_id = $row->league_id;
                    }
                    $this->db->query("INSERT INTO sports_news_leagues (news_id,league_id) VALUES ($insert_id_sn,$league_id)");     

                }

                return $query;
            }else{
                return false;
            }
        }else if($news_category == 31){
            $check = $this->db->query("SELECT * FROM rss_sports_news WHERE rss_item_id = '$rss_item_id' AND news_category = 2");
            if($check->num_rows() == 0){
                $query = $this->db->query("INSERT INTO rss_sports_news (team_id,title,summary,details,image,channel_published_at,url,image_status,rss_item_id,
                                        source,channel,is_deleted,news_category)
                                        SELECT $team_id,rsn.title,rsn.summary,rsn.details,rsn.image,rsn.channel_published_at,rsn.url,rsn.image_status,rsn.rss_item_id,
                                        rsn.source,rsn.channel,rsn.is_deleted,2 FROM rss_sports_news as rsn
                                        LEFT JOIN teams as t on t.id = rsn.team_id
                                        WHERE rsn.id=$news_id ");
                $insert_id_rsn = $this->db->insert_id();

                $check_in_sn = $this->db->query("SELECT * FROM sports_news WHERE rss_sports_news_id=$insert_id_rsn AND news_category = 2");
                if($check_in_sn->num_rows()== 0){
                    $this->db->query("INSERT INTO sports_news (rss_sports_news_id,title,summary,details,image,published_at,channel_published_at,url,
                                        source,channel,news_category)
                                        SELECT $insert_id_rsn,title,summary,details,image,UNIX_TIMESTAMP(),channel_published_at,url,source,channel,2 FROM rss_sports_news
                                        WHERE id=$news_id ");
                    $insert_id_sn = $this->db->insert_id();
                    $this->db->query("INSERT INTO sports_news_teams (news_id,team_id) VALUES ($insert_id_sn,$team_id)");    
                }

                return $query;
            }else{
                return false;
            }
        }

        //return $rss_item_id;
    }
    
    public function league_teams($league_id){
        $query = $this->db->query("SELECT * FROM teams WHERE league_id='$league_id' order by name");
        return $query->result_array();
    }

    public function league_players($league_id,$team_id){
        $query = $this->db->query("SELECT DISTINCT name_full,name_abbr,position FROM players WHERE league_id = $league_id AND team_id = $team_id order by name_full");
        return $query->result_array();
    }

    public function player_news(){
        $query = $this->db->query("SELECT rpn.id as rss_player_id, rpn.title as rss_player_title, rpn.summary as rss_player_summary, rpn.image as rss_player_image, rpn.team_code as    rss_player_team_code, rpn.name_abbr as rss_player_name_abbr, rpn.created_at as rss_player_created_at, rpn.url as rss_player_url, rpn.source as rss_player_source,
                pn.id as player_id, pn.rss_player_news_id, pn.title as player_title, pn.summary as player_summary, pn.image as player_image, pn.published_at as player_published_at,pn.url as player_url, pn.source as player_source, pn.notified_at as player_notified_at, pn.edited_by_admin_id as player_edited_by_admin_id, pn.is_deleted as player_is_deleted FROM rss_player_news as rpn
                LEFT JOIN player_news as pn ON pn.rss_player_news_id= rpn.id");
        return $query->result_array();
    }

    public function waiver_news(){
        $query = $this->db->query("SELECT rwn.id as rss_waiver_id, rwn.title as rss_waiver_title, rwn.summary as rss_waiver_summary, rwn.image as rss_waiver_image, rwn.team_code as    rss_waiver_team_code, rwn.name_abbr as rss_waiver_name_abbr, rwn.created_at as rss_waiver_created_at, rwn.url as rss_waiver_url, rwn.source as rss_waiver_source,
                wn.id as waiver_id, wn.rss_waiver_news_id, wn.title as waiver_title, wn.summary as waiver_summary, wn.image as waiver_image, wn.published_at as waiver_published_at,wn.url as waiver_url, wn.source as waiver_source, wn.notified_at as waiver_notified_at, wn.edited_by_admin_id as waiver_edited_by_admin_id, wn.is_deleted as waiver_is_deleted FROM rss_waiver_news as rwn
                LEFT JOIN waiver_news as wn ON wn.rss_waiver_news_id= rwn.id");
        return $query->result_array();
    }


	public function league_team_logo($league_team_id){
		$query = $this->db->query("SELECT logo FROM teams WHERE id=$league_team_id");
		return $query->result();
	}
	public function all_leagues(){
		$query = $this->db->query("SELECT * FROM leagues");
		return $query->result();
	}

    public function sponser(){
        $query = $this->db->query("SELECT * FROM sponser");
        return $query->result();
    }

	public function getNewsSummary() {
        $data = $this->db->query('SELECT  (SELECT COUNT(id) FROM   rss_sports_news) AS total_Feeds, (SELECT COUNT(published_at) FROM   sports_news WHERE published_at != 0) AS total_Published,(SELECT COUNT(notified_at) FROM   sports_news WHERE notified_at != 0) AS total_Notifieds');
        if ($data->num_rows() > 0) {            
            return $data->result();
        } else {
            return null;
        }
    }

    public function getArticleSummary() {
        $data = $this->db->query('SELECT  (SELECT COUNT(id) FROM   rss_waiver_news) AS total_w_feeds, (SELECT COUNT(published_at) FROM   waiver_news WHERE published_at != 0) AS total_w_published');
        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return null;
        }
    }

    public function update_news($news_id,$news_title,$news_summary,$news_url,$edited_by_id,$team_id,$news_source,$edit_news_category,$edit_news_tags){
         $news_querys = $this->db->query("SELECT * FROM rss_sports_news WHERE id='$news_id'");
         $rows = $news_querys->row();
         $content_type = $rows->content_type;
         $image = $rows->image;
        if($edit_news_category == 2){
            $this->db->query("UPDATE rss_sports_news SET team_id='$team_id' WHERE id='$news_id'");    
        }        
    	$query = $this->db->query("SELECT * FROM sports_news WHERE rss_sports_news_id='$news_id'");
        if($query->num_rows() > 0){
            $query = $this->db->query("UPDATE sports_news SET title='$news_title',summary='$news_summary',url= '$news_url',source='$news_source', edited_by_admin_id=$edited_by_id,content_type= '$content_type',`tags`= '$edit_news_tags' WHERE rss_sports_news_id=$news_id");
            return $query;
        }else{
            $news_query = $this->db->query("SELECT * FROM rss_sports_news WHERE id='$news_id'");
            $row = $news_query->row();
            $channel = $row->channel;
            $news_category = $row->news_category;   
            $league_id = $row->league_id;
           // $content_type = $row->content_type;         
            $query = $this->db->query("INSERT INTO sports_news (rss_sports_news_id,title,summary,url,source,edited_by_admin_id,channel_published_at, channel,news_category,content_type,image,`tags`) VALUES ('$news_id', '$news_title', '$news_summary', '$news_url','$news_source','$edited_by_id',UNIX_TIMESTAMP(),'$channel','$news_category','$content_type','$image','$edit_news_tags')");
            $insert_id = $this->db->insert_id();           
            if($edit_news_category == 2){
                $this->db->query("INSERT INTO sports_news_teams (news_id,team_id) VALUES ($insert_id,$team_id)");    
            }else if($edit_news_category == 31){
                $this->db->query("INSERT INTO sports_news_leagues (news_id,league_id) VALUES ($insert_id,$league_id)");    
            }            
            return $query;
        }
        
    }



    public function add_news($tab_index,$news_title,$news_summary,$news_url,$league_id,$team_id,$img){
        if($tab_index == 0 || $tab_index == 1 || $tab_index == 4){
            if($tab_index == 0 || $tab_index == 4){
                $query = $this->db->query("INSERT INTO rss_sports_news (team_id, title, summary, url, image, channel_published_at, channel,news_category) 
                VALUES ($team_id,'$news_title', '$news_summary', '$news_url', '$img',UNIX_TIMESTAMP(),64,2)");                      
                return $query;
            }
            else{
                $query = $this->db->query("INSERT INTO rss_sports_news (league_id, title, summary, url, image, channel_published_at, channel,news_category) 
                VALUES ($league_id,'$news_title', '$news_summary', '$news_url', '$img', UNIX_TIMESTAMP(),64,31)");                      
                return $query;
            }           
        }
    }

    public function newsNotifify($newsIdForNotify){
        
        $sval='1';
        $qry = 'select league_team_id from league_team_news where news_id = ?';
        $data=  $this->db->query($qry,$newsIdForNotify);
        $teamId = $data->result_array()[0]['league_team_id'];
       
        $qryUid = 'select user_id from user_league_teams where league_team_id = ?';
        $data=  $this->db->query($qryUid,$teamId);
        $teamIdAry = $data->result_array();
        
        foreach( $teamIdAry as $key =>$val){
            
            $this->db->query ( 'INSERT INTO `notifications` ( `user_id`, `news_id`, `status`) VALUES (?, ?, ?)',[ $val['user_id'], $newsIdForNotify, $sval] );
        }

        $data = array('publish' => $sval, 'notified' => $sval);
        return $this->db->update('league_team_news', $data, array('news_id' => $newsIdForNotify, 'notified' => 0));
    }

    public function newsPublish($newsIdFor,$user_id,$tab_index){
        $query = $this->db->query("SELECT * FROM sports_news WHERE rss_sports_news_id='$newsIdFor'");
        if($query->num_rows() > 0){
            $this->db->query("UPDATE sports_news SET published_at = UNIX_TIMESTAMP() WHERE rss_sports_news_id='$newsIdFor'");
            return 'update';
        }else{
            $result = $this->db->query("SELECT * FROM rss_sports_news WHERE id='$newsIdFor'");
            return $result->result_array();
        }     
    }

    public function newsPublishNotified($news_id, $user_id){
        $query = $this->db->query("SELECT * FROM sports_news WHERE rss_sports_news_id = $news_id");
        if($query->num_rows() > 0){
            $this->db->query("UPDATE sports_news SET notified_at = UNIX_TIMESTAMP(), published_at = UNIX_TIMESTAMP() WHERE rss_sports_news_id = $news_id");
            return 'update';
        }else{
            $result = $this->db->query("SELECT * FROM rss_sports_news WHERE id= $news_id ");
            return $result->result_array();
        }  
    }

    public function insert_published_news($news_data,$news_id,$team_id,$newsCategory,$league_id){
        if($newsCategory == 2){
            $this->db->insert('sports_news', $news_data); 
            $insert_id = $this->db->insert_id();
            $result = $this->db->query("SELECT * FROM sports_news_teams WHERE news_id=$insert_id AND team_id=$team_id");
            if($result->num_rows() > 0){
                return 'true';
            }else{
                return $this->db->query("INSERT INTO sports_news_teams (news_id, team_id) VALUES ($insert_id,$team_id)");
            }
              
        }else if ($newsCategory == 31){
            $this->db->insert('sports_news', $news_data); 
            $insert_id = $this->db->insert_id();
            $result = $this->db->query("SELECT * FROM sports_news_leagues WHERE news_id=$insert_id AND league_id=$league_id");
            if($result->num_rows() > 0){
                return 'true';
            }else{
                return $this->db->query("INSERT INTO sports_news_leagues (news_id, league_id) VALUES ($insert_id,$league_id)");
            }   
        }
    }

    public function insert_publishedArticle_news($news_data, $tab_index,$league_id){
        if($tab_index == 3){
            $this->db->insert('waiver_news', $news_data); 
            $insert_id = $this->db->insert_id();
            $result = $this->db->query("SELECT * FROM waiver_news_leagues WHERE news_id=$insert_id AND league_id=$league_id");
            if($result->num_rows() > 0){
                return 'true';
            }else{
                return $this->db->query("INSERT INTO waiver_news_leagues (news_id, league_id) VALUES ($insert_id,$league_id)");
            }
            return 'true';
        }else{
            $this->db->insert('player_news', $news_data); 
            $news_id = $news_data['rss_player_news_id'];
            $insert_id = $this->db->insert_id();
            $player = $this->db->query("SELECT rpn.name_abbr,p.id as player_id,p.league_id, p.team_id FROM rss_player_news as rpn 
                                        LEFT JOIN players as p on p.name_abbr = rpn.name_abbr
                                        WHERE rpn.id = $news_id AND p.name_abbr = rpn.name_abbr");
            $row = $player->row();
            $player_id = $row->player_id;
            $league_id = $row->league_id;
            $team_id = $row->team_id;
            $this->db->query("INSERT INTO player_news_teams (news_id,team_id,player_id) VALUES ($insert_id,$team_id,$player_id)");    
            return 'true';
        }
        
    }

    public function getPlayerIdByName($player_name){
        $query = $this->db->query("SELECT player_id FROM players WHERE name_abbr='$player_name'");
        return $query->result();
    }

    public function checkFnpEntry($fnews_id,$player_id){
        $query = $this->db->query("SELECT * FROM fantasy_news_players WHERE fnews_id=$fnews_id AND player_id=$player_id ");

        return $query->result();
       
    }

    public function insert_fnpMapping($fnews_id,$player_id){
        
         return $this->db->query("INSERT INTO fantasy_news_players (fnews_id,player_id) VALUES ($fnews_id, $player_id) ");
    }

    public function update_notify($news_id,$tab_index){
        $query = $this->db->query("SELECT * FROM sports_news WHERE rss_sports_news_id ='$news_id'");
        if($query->num_rows() > 0){
            $this->db->query("UPDATE sports_news SET notified_at = UNIX_TIMESTAMP() WHERE rss_sports_news_id = $news_id ");
            return 'notified';
        }
    }


    function getDeviceInfo($newsIdForNotify, $newsCategory, $level ) {    
        $notilevel="";
        if($level==1){
            $notilevel = " u.notification_level = '1' OR u.notification_level = '2' OR u.notification_level = '3' ";
        }elseif($level==2)   {
            $notilevel = " u.notification_level = '2' OR u.notification_level = '3' ";
        }else{
            $notilevel = " u.notification_level = '3' ";
        }

        if($newsCategory==2){
            /*$qry="SELECT sn.id AS news_id, sn.title, sn.summary, sn.details, sn.image, sn.url, sn.source, sn.author, sn.total_likes, sn.total_comments, sn.total_favourite, sn.total_read, sn.total_shares, sn.channel_published_at,sn.news_category, snt.team_id, utf.user_id as user_id, utf.notification_status as notification_status, u.notification_level as notification_level, d.device_token as device_token, d.os as device_type, d.aws_arn as aws_arn*/
            $qry="SELECT sn.id AS news_id, sn.title, SUBSTRING(sn.summary,0,150) as summary, '' as details, sn.image, sn.url, sn.source, sn.author, sn.total_likes, sn.total_comments, sn.total_favourite, sn.total_read, sn.total_shares, sn.channel_published_at,sn.news_category, snt.team_id, utf.user_id as user_id, utf.notification_status as notification_status, u.notification_level as notification_level, d.device_token as device_token, d.os as device_type, d.aws_arn as aws_arn
                FROM sports_news_teams as snt 
                LEFT JOIN sports_news as sn ON sn.id = snt.news_id 
                LEFT JOIN user_teams_follow as utf ON utf.team_id = snt.team_id
                LEFT JOIN user_devices as ud on (ud.user_id = utf.user_id and ud.is_logged_in = '1')
                LEFT JOIN users as u on (u.id = utf.user_id and utf.notification_status='1')
                LEFT JOIN devices as d on d.id = ud.devices_id
                WHERE sn.rss_sports_news_id = ? AND (". $notilevel .") AND d.device_token IS NOT NULL AND d.device_token != '' GROUP BY device_token ORDER BY news_id ";
                $data = $this->db->query($qry,$newsIdForNotify);
               // echo $this->db->last_query();
            if ($data->num_rows() > 0) {
                return $data->result_array();
            } else {
                return null;
            }
        }elseif($newsCategory==31){
            $qry="SELECT sn.id AS news_id, sn.title, sn.summary, sn.details, sn.image, sn.url, sn.source, sn.author, sn.total_likes, sn.total_comments, sn.total_favourite, sn.total_read, sn.total_shares, sn.channel_published_at,sn.news_category, snl.league_id, ulf.user_id as user_id, ulf.notification_status as notification_status, u.notification_level as notification_level, d.device_token as device_token, d.os as device_type, d.aws_arn as aws_arn
                FROM sports_news_leagues as snl 
                LEFT JOIN sports_news as sn ON sn.id = snl.news_id 
                LEFT JOIN user_leagues_follow as ulf ON ulf.league_id = snl.league_id
                LEFT JOIN user_devices as ud on (ud.user_id = ulf.user_id and ud.is_logged_in = '1')
                LEFT JOIN users as u on (u.id = ulf.user_id and ulf.notification_status = '1')
                LEFT JOIN devices as d on d.id = ud.devices_id
                WHERE sn.rss_sports_news_id = ?  AND (". $notilevel .") AND d.device_token IS NOT NULL AND d.device_token != '' GROUP BY device_token ORDER BY news_id ";
                $data = $this->db->query($qry,$newsIdForNotify);

            if ($data->num_rows() > 0) {
                return $data->result_array();
            } else {
                return null;
            }
        }
        /*elseif($tab_index==2){
            $qry="SELECT pn.id AS news_id, pn.title, pn.summary, pn.details, pn.image, pn.url, pn.source, pn.author, pn.total_likes, pn.total_comments, pn.total_read, pn.total_shares, pn.channel_published_at, pnt.team_id, utf.user_id as user_id , utf.notification_status as notification_status, u.notification_level as notification_level , d.device_token as device_token, d.os as device_type, d.aws_arn as aws_arn, 4 as news_category
                FROM player_news_teams as pnt 
                LEFT JOIN player_news as pn ON pn.id = pnt.news_id 
                LEFT JOIN user_teams_follow as utf ON utf.team_id = pnt.team_id
                LEFT JOIN user_devices as ud on (ud.user_id = utf.user_id and ud.is_logged_in = '1')
                LEFT JOIN users as u on (u.id = utf.user_id and utf.notification_status = '1')
                LEFT JOIN devices as d on d.id = ud.devices_id
                WHERE pn.rss_player_news_id = ? AND (". $notilevel .") AND d.device_token IS NOT NULL AND d.device_token != '' GROUP BY device_token ORDER BY news_id ";
                $data = $this->db->query($qry,$newsIdForNotify);

            if ($data->num_rows() > 0) {
                return $data->result_array();
            } else {
                return null;
            }
        }elseif($tab_index==3){    
            $qry="SELECT wn.id AS news_id, wn.title, wn.summary, wn.details, wn.image, wn.url, wn.source, wn.author, wn.total_likes, wn.total_comments, wn.total_read, wn.total_shares, wn.channel_published_at, wnt.league_id, ulf.user_id as user_id , ulf.notification_status as notification_status, u.notification_level as notification_level , d.device_token as device_token, d.os as device_type, d.aws_arn as aws_arn, 3 as news_category
                FROM waiver_news_leagues as wnt 
                LEFT JOIN waiver_news as wn ON wn.id = wnt.news_id 
                LEFT JOIN user_leagues_follow as ulf ON ulf.league_id = wnt.league_id
                LEFT JOIN user_devices as ud on (ud.user_id = ulf.user_id and ud.is_logged_in = '1')
                LEFT JOIN users as u on (u.id = ulf.user_id and ulf.notification_status = '1')
                LEFT JOIN devices as d on d.id = ud.devices_id
                WHERE wn.rss_waiver_news_id = ?  AND (". $notilevel .") AND d.device_token IS NOT NULL AND d.device_token != '' GROUP BY device_token ORDER BY news_id ";
                $data = $this->db->query($qry,$newsIdForNotify);

            if ($data->num_rows() > 0) {
                return $data->result_array();
            } else {
                return null;
            }
        }*/
        
    }

    public function publishfantasynews($fnews_id){
        $data = array('published' => 1);
        return $this->db->update('fantasy_news', $data, array('fnews_id' => $fnews_id));
    }

    public function notifyfantasynews($fnews_id){
        $data = array('notified' => 1);
        return $this->db->update('fantasy_news', $data, array('fnews_id' => $fnews_id));
    }

    public function check_data_in_notifications($news_id,$user_id){
        $query = $this->db->query("SELECT * FROM notifications WHERE news_id=$news_id");
        return $query->result_array();
    }

    public function insert_data_in_notifications($news_id, $user_id){
        return $this->db->query("INSERT INTO notifications (news_id) VALUES ($news_id) ");
    }

    public function hide_kroo_news($news_id, $tab_index){  
        if($tab_index == 0 || $tab_index == 1){
            $this->db->query("UPDATE rss_sports_news SET is_deleted=1 WHERE id = $news_id");
            $this->db->query("UPDATE sports_news SET is_deleted=1 WHERE rss_sports_news_id = $news_id ");  
            return 'kroo';  
        }
        
    }
   
    public function getNewsByType($tab_index,$news_type){
        if($news_type == 2){
            $query = $this->db->query("SELECT rsn.id as rss_sports_id, rsn.team_id as rss_team_id, rsn.title as rss_sports_title,rsn.summary as rss_sports_summary, rsn.image as rss_sports_image, rsn.created_at as rss_sports_created_at, rsn.url as rss_sports_url,rsn.source as rss_sports_source, sn.source as sports_source,
            sn.id as sports_id,sn.rss_sports_news_id,sn.title as sports_title,sn.summary as sports_summary, sn.image as sports_image, sn.published_at as sports_published_at,
            sn.updated_at as sports_updated_at, sn.url as sports_url, sn.notified_at as sports_notified_at, sn.edited_by_admin_id as sports_edited_by_admin_id, sn.is_deleted as sports_is_deleted FROM rss_sports_news as rsn
            LEFT JOIN sports_news as sn on sn.rss_sports_news_id = rsn.id");
            return $query->result_array();
        }else if($news_type == 1){
            $query = $this->db->query("SELECT rsn.id as rss_sports_id, rsn.team_id as rss_team_id, rsn.title as rss_sports_title,rsn.summary as rss_sports_summary, rsn.image as rss_sports_image, rsn.created_at as rss_sports_created_at, rsn.url as rss_sports_url,rsn.source as rss_sports_source, sn.source as sports_source,
            sn.id as sports_id,sn.rss_sports_news_id,sn.title as sports_title,sn.summary as sports_summary, sn.image as sports_image, sn.published_at as sports_published_at,
            sn.updated_at as sports_updated_at, sn.url as sports_url, sn.notified_at as sports_notified_at, sn.edited_by_admin_id as sports_edited_by_admin_id, sn.is_deleted as sports_is_deleted FROM rss_sports_news as rsn
            LEFT JOIN sports_news as sn on sn.rss_sports_news_id = rsn.id
            WHERE sn.published_at != 0 ");
            return $query->result_array();
        }else if($news_type == 0){
            $query = $this->db->query("SELECT rsn.id as rss_sports_id, rsn.team_id as rss_team_id, rsn.title as rss_sports_title,rsn.summary as rss_sports_summary, rsn.image as rss_sports_image, rsn.created_at as rss_sports_created_at, rsn.url as rss_sports_url,rsn.source as rss_sports_source, sn.source as sports_source,
            sn.id as sports_id,sn.rss_sports_news_id,sn.title as sports_title,sn.summary as sports_summary, sn.image as sports_image, sn.published_at as sports_published_at,
            sn.updated_at as sports_updated_at, sn.url as sports_url, sn.notified_at as sports_notified_at, sn.edited_by_admin_id as sports_edited_by_admin_id, sn.is_deleted as sports_is_deleted FROM rss_sports_news as rsn
            LEFT JOIN sports_news as sn on sn.rss_sports_news_id = rsn.id
            WHERE sn.published_at = 0 ");
            return $query->result_array();
        }else if($news_type == 3){
            $query = $this->db->query("SELECT rsn.id as rss_sports_id, rsn.team_id as rss_team_id, rsn.title as rss_sports_title,rsn.summary as rss_sports_summary, rsn.image as rss_sports_image, rsn.created_at as rss_sports_created_at, rsn.url as rss_sports_url,rsn.source as rss_sports_source, sn.source as sports_source,
            sn.id as sports_id,sn.rss_sports_news_id,sn.title as sports_title,sn.summary as sports_summary, sn.image as sports_image, sn.published_at as sports_published_at,
            sn.updated_at as sports_updated_at, sn.url as sports_url, sn.notified_at as sports_notified_at, sn.edited_by_admin_id as sports_edited_by_admin_id, sn.is_deleted as sports_is_deleted FROM rss_sports_news as rsn
            LEFT JOIN sports_news as sn on sn.rss_sports_news_id = rsn.id
            WHERE sn.notified_at != 0 ");
            return $query->result_array();
        }
    }

    public function mass_publish($news_id,$tab_index){
        if($tab_index == 0){
                $query = $this->db->query("SELECT * FROM sports_news WHERE rss_sports_news_id='$news_id'");
                if($query->num_rows() > 0){
                    $this->db->query("UPDATE sports_news SET published_at = UNIX_TIMESTAMP() WHERE rss_sports_news_id='$news_id'");
                    return 'update';
                }else{
                    $result = $this->db->query("SELECT * FROM rss_sports_news WHERE id='$news_id'");
                    return $result->result_array();
                }  
        }else if($tab_index == 2){
            return $this->db->query("UPDATE fantasy_news SET published =  1 WHERE fnews_id= $news_id ");
        }else if($tab_index == 3){
            return $this->db->query("UPDATE fantasy_news SET published =  1 WHERE fnews_id= $news_id ");
        }
        
    }


    public function league_teams_position($league_id){
        $query = $this->db->query("SELECT player_id,position FROM players WHERE league_id='$league_id'");
        return $query->result();
    }

    public function update_image($news_id,$image_name,$tab_index){
        if($tab_index == 3){
            return $this->db->query("UPDATE waiver_news SET image='$image_name' WHERE rss_waiver_news_id=$news_id");
        }else if($tab_index == 2){
            return $this->db->query("UPDATE player_news SET image='$image_name' WHERE rss_player_news_id=$news_id");
        }else{
            return $this->db->query("UPDATE sports_news SET image='$image_name' WHERE rss_sports_news_id=$news_id");
        }
    }

    public function news_read_activity($news_id, $tab_index, $user_id){

        if($tab_index == 0){

            $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id = $news_id AND activity_user_id=$user_id AND activity_news_type='kroo' AND activity_action='read'");
            if($query->num_rows() == 0 ){
                return $this->db->query("INSERT INTO admin_activity (activity_news_id, activity_user_id, activity_news_type, activity_action) 
                                        VALUES ($news_id, $user_id, 'kroo', 'read') ");
            }
            
        }
        else if($tab_index == 2){

            $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id = $news_id AND activity_user_id=$user_id AND activity_news_type='fantasy'  AND activity_action='read'");
            if($query->num_rows() == 0){
                return $this->db->query("INSERT INTO admin_activity (activity_news_id, activity_user_id, activity_news_type, activity_action) 
                                        VALUES ($news_id, $user_id, 'fantasy', 'read') ");
            }
            
        }
        else{

            $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id = $news_id AND activity_user_id=$user_id AND activity_news_type='waiver' AND activity_action='read'");
            if($query->num_rows() == 0){
                return $this->db->query("INSERT INTO admin_activity (activity_news_id, activity_user_id, activity_news_type, activity_action) 
                                        VALUES ($news_id, $user_id, 'waiver', 'read') ");
            }
            
        }
    }

    public function news_edit_activity($news_id, $tab_index, $user_id){

        if($tab_index == 0 || $tab_index == 4){

            $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id = $news_id AND activity_user_id=$user_id AND activity_news_type='kroo'  AND activity_action='edit'");
            if($query->num_rows() == 0 ){
                return $this->db->query("INSERT INTO admin_activity (activity_news_id, activity_user_id, activity_news_type, activity_action) 
                                        VALUES ($news_id, $user_id, 'kroo', 'edit') ");
            }
            
        }
        else if($tab_index == 2){

            $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id = $news_id AND activity_user_id=$user_id AND activity_news_type='fantasy' AND activity_action='edit'");
            if($query->num_rows() == 0){
                return $this->db->query("INSERT INTO admin_activity (activity_news_id, activity_user_id, activity_news_type, activity_action) 
                                        VALUES ($news_id, $user_id, 'fantasy', 'edit') ");
            }
            
        }
        else{

            $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id = $news_id AND activity_user_id=$user_id AND activity_news_type='waiver' AND activity_action='edit'");
            if($query->num_rows() == 0){
                return $this->db->query("INSERT INTO admin_activity (activity_news_id, activity_user_id, activity_news_type, activity_action) 
                                        VALUES ($news_id, $user_id, 'waiver', 'edit') ");
            }
            
        }
    }

    public function news_publish_activity($news_id, $tab_index, $user_id){

        $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id = $news_id AND activity_user_id=$user_id AND activity_news_type='kroo' AND activity_action='publish'");
        if($query->num_rows() == 0 ){
            return $this->db->query("INSERT INTO admin_activity (activity_news_id, activity_user_id, activity_news_type, activity_action) 
                                    VALUES ($news_id, $user_id, 'kroo', 'publish') ");
        }
    }


    public function news_notify_activity($news_id, $tab_index, $user_id){

        if($tab_index == 0 || $tab_index == 4){

            $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id = $news_id AND activity_user_id=$user_id AND activity_news_type='kroo' AND activity_action='notify'");
            if($query->num_rows() == 0 ){
                return $this->db->query("INSERT INTO admin_activity (activity_news_id, activity_user_id, activity_news_type, activity_action) 
                                        VALUES ($news_id, $user_id, 'kroo', 'notify') ");
            }
            
        }
        else if($tab_index == 1){

            $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id = $news_id AND activity_user_id=$user_id AND activity_news_type='headlines' AND activity_action='notify'");
            if($query->num_rows() == 0 ){
                return $this->db->query("INSERT INTO admin_activity (activity_news_id, activity_user_id, activity_news_type, activity_action) 
                                        VALUES ($news_id, $user_id, 'headlines', 'notify') ");
            }
            
        }
        else if($tab_index == 2){

            $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id = $news_id AND activity_user_id=$user_id AND activity_news_type='fantasy' AND activity_action='notify'");
            if($query->num_rows() == 0){
                return $this->db->query("INSERT INTO admin_activity (activity_news_id, activity_user_id, activity_news_type, activity_action) 
                                        VALUES ($news_id, $user_id, 'fantasy', 'notify') ");
            }
            
        }
        else{

            $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id = $news_id AND activity_user_id=$user_id AND activity_news_type='waiver' AND activity_action='notify'");
            if($query->num_rows() == 0){
                return $this->db->query("INSERT INTO admin_activity (activity_news_id, activity_user_id, activity_news_type, activity_action) 
                                        VALUES ($news_id, $user_id, 'waiver', 'notify') ");
            }
            
        }
    }

    public function news_hide_activity($news_id, $tab_index, $user_id){

        if($tab_index == 0 || $tab_index == 1){

            $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id = $news_id AND activity_user_id=$user_id AND activity_news_type='kroo' AND activity_action='delete'");
            if($query->num_rows() == 0 ){
                return $this->db->query("INSERT INTO admin_activity (activity_news_id, activity_user_id, activity_news_type, activity_action) 
                                        VALUES ($news_id, $user_id, 'kroo', 'delete') ");
            }
            
        }
       
    }

    public function get_news_team_detail($team_id){
        $query = $this->db->query("SELECT t.league_id,l.name FROM teams as t
                                    LEFT JOIN leagues as l on l.id = t.league_id
                                    WHERE t.id=$team_id");
        return $query->result_array();
    }

    public function get_activity_by_news($news_id,$news_type){
        $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_news_id='$news_id' AND activity_news_type= '$news_type'");
        return $query->result_array();
    }

    public function get_username_by_id($user_id){
        $query = $this->db->query("SELECT name FROM admin_users WHERE id='$user_id'");
        return $query->result_array();   
    }

    public function update_news_detail($news_detail,$news_id){
        $query = $this->db->query("SELECT *  FROM sports_news WHERE rss_sports_news_id='$news_id'"); 
        if($query->num_rows() > 0) {
            $query = $this->db->query("UPDATE sports_news SET details='$news_detail' WHERE rss_sports_news_id='$news_id'");
            return $query;
        }else{
                    $query = $this->db->query("UPDATE rss_sports_news SET details='$news_detail' WHERE id='$news_id'");
                    return $query;
        }   
        
    }


    public function get_detail($news_id,$tab_index){
        $query = $this->db->query("SELECT details  FROM sports_news WHERE rss_sports_news_id='$news_id'"); 
        if($query->num_rows()>0){
            return $query->result();
        }else{
            $query = $this->db->query("SELECT *  FROM rss_sports_news WHERE id='$news_id'"); 
            $row = $query->row(); //print_r($row); die;  
            $news_detail = $row->details; 
            $news_title = addslashes($row->title);
            $news_summary = addslashes($row->summary);
            $news_url = $row->url;
            $image = $row->image;
            $news_source = $row->source;
            $channel = $row->channel;
            $news_category = $row->news_category;
            $team_id = $row->team_id;
            $league_id = $row->league_id;
            $this->db->query("INSERT INTO sports_news (rss_sports_news_id,title,image,summary,details,url,source,channel_published_at,channel,news_category) 
            VALUES ('$news_id', '$news_title', '$image', '$news_summary','$news_detail','$news_url','$news_source',UNIX_TIMESTAMP(),'$channel','$news_category')");
             $insert_id = $this->db->insert_id();

            if($tab_index == 0 || $tab_index == 4){
                $this->db->query("INSERT INTO sports_news_teams (news_id,team_id) VALUES ('$insert_id','$team_id')");
            }else if($tab_index == 1){  
                $this->db->query("INSERT INTO sports_news_leagues (news_id,league_id) VALUES ('$insert_id','$league_id')");  
            }
            $query = $this->db->query("SELECT details  FROM sports_news WHERE rss_sports_news_id='$news_id'");
            return $query->result();
        }        
    }

    public function get_rss_news_detail($news_id){
        $query = $this->db->query("SELECT *  FROM rss_sports_news WHERE id='$news_id'"); 
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return array();
        }        
    }

    public function get_news_detail($news_id,$news_category){
        $query = $this->db->query("SELECT *  FROM sports_news WHERE rss_sports_news_id='$news_id' AND news_category='$news_category'"); 
        $num_rows = ($this->num_rows()>0)?1:0;
        $sql="";
        if($news_category==2 && $num_rows==1){
            $sql = $this->db->query("SELECT *  FROM rss_sports_news WHERE id='$news_id' AND news_category='$news_category'"); 
        }elseif($news_category==2 && $num_rows==0){
            $sql = $this->db->query("SELECT *  FROM rss_sports_news WHERE id='$news_id' AND news_category='$news_category'"); 
        }elseif($news_category==31 && $num_rows==1){
            $sql = $this->db->query("SELECT *  FROM rss_sports_news WHERE id='$news_id' AND news_category='$news_category'"); 
        }else{
            $sql = $this->db->query("SELECT *  FROM rss_sports_news WHERE id='$news_id' AND news_category='$news_category'"); 
        }
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return array();
        }        
    }
    
}