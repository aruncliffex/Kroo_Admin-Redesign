<?php
class Stats_model extends Model {

    public function failure_url(){
        $query = $this->db->query("SELECT * FROM failure_url where `type`!='image' ORDER BY date DESC");
        return $query->result_array();
    }

    public function crone_stats(){
        $today = date("Y-m-d");
        //$query = $this->db->query("SELECT * FROM cron_stats WHERE date LIKE '%$today%' ORDER BY date DESC");
         $query = $this->db->query("SELECT * FROM cron_stats ORDER BY date DESC limit 100");
        return $query->result_array();
    }

    public function stats0($leagueId,$date_from){
        $this->db->select('a.`id`,a.`team_id`,b.`league_id`, b.name as team_name, b.logo as team_logo, l.name as league_name,l.logo as league_logo,a.`title`,a.`summary`,a.`details`,a.`channel_published_at`,date(FROM_UNIXTIME(a.`channel_published_at`)) as channel_date,a.`news_category`, COUNT(a.id) as count');
        $this->db->from('rss_sports_news a');
        $this->db->join('teams b','a.team_id=b.id','left');
        $this->db->join('leagues l','b.league_id=l.id','left');
        $this->db->where('a.news_category',2);
        $this->db->where('b.league_id is not null');
        if($leagueId>0){
                $this->db->where('b.league_id',$leagueId);	
        }
        if($date_from != ''){
            $this->db->where('date(FROM_UNIXTIME(a.`channel_published_at`))',$date_from);
        }   
        $this->db->group_by('a.team_id,channel_date');
        $this->db->order_by('channel_date desc,team_id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function stats1($leagueId,$date_from){
        $this->db->select("a.`id`,a.`team_id`,a.`league_id`, '' as team_name, '' as team_logo, l.name as league_name, l.logo as league_logo, a.`title`,a.`summary`,a.`details`,a.`channel_published_at`,date(FROM_UNIXTIME(a.`channel_published_at`)) as channel_date,a.`news_category`, COUNT(a.id) as count",false);
        $this->db->from('rss_sports_news a');
        //$this->db->join('teams b','a.team_id=b.id','left');
        //$this->db->join('leagues l','a.league_id=l.id','left');
        $this->db->join('leagues l','a.league_id=l.id','left');
        $this->db->where('a.news_category',31);
        $this->db->where('a.league_id is not null');
        if($leagueId>0){
                $this->db->where('a.league_id',$leagueId);	
        }
         if($date_from != ''){
            $this->db->where('date(FROM_UNIXTIME(a.`channel_published_at`))',$date_from);
        } 
        $this->db->group_by('a.league_id, channel_date');
        $this->db->order_by('channel_date desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function stats2($leagueId,$date_from){
        $this->db->select("a.`id`, b.`league_id`, b.name as team_name, b.logo as team_logo, l.name as league_name,l.logo as league_logo, a.`title`,a.`summary`,date(a.`created_at`) as channel_date, COUNT(a.id) as count");
        $this->db->from('rss_player_news a');
        $this->db->join('teams b','a.team_code=b.code','left');
        //$this->db->join('leagues l','a.league_id=l.id','left');		
        $this->db->join('leagues l','b.league_id=l.id','left');
        $this->db->where('b.league_id is not null');
        if($leagueId>0){
                $this->db->where('b.league_id',$leagueId);	
        }
        if($date_from != ''){
            $this->db->where('date(a.`created_at`)',$date_from);
        } 
        $this->db->group_by('b.league_id, channel_date');
        $this->db->order_by('channel_date desc,league_id');
        $query = $this->db->get();		
        $array = $query->result_array();
        $news_arr = array();
        foreach($array as $key=>$row){
                $news_arr[$key] = $row;
                $news_arr[$key]['team_id'] = 0;

        }
        //echo $this->db->last_query();
        return $news_arr;
    }

    public function stats3($leagueId,$date_from){
        $this->db->select("a.`id`, b.`league_id`, b.name as team_name, b.logo as team_logo, l.name as league_name, l.logo as league_logo, a.`title`,a.`summary`,date(a.`created_at`) as channel_date, COUNT(a.id) as count");
        $this->db->from('rss_waiver_news a');	
        $this->db->join('teams b','a.team_code=b.code','left');
        //$this->db->join('leagues l','a.league_id=l.id','left');	
        $this->db->join('leagues l','a.league_id=l.id','left');
        $this->db->where('a.league_id is not null');
        if($leagueId>0){
                $this->db->where('a.league_id',$leagueId);	
        }
        if($date_from != ''){
            $this->db->where('date(a.`created_at`)',$date_from);
        } 
        $this->db->group_by('a.league_id, channel_date');
        $this->db->order_by('channel_date desc,league_id');
        $query = $this->db->get();		
        $array = $query->result_array();
        $news_arr = array();
        foreach($array as $key=>$row){
                $news_arr[$key] = $row;
                $news_arr[$key]['team_id'] = 0;

        }
        return $news_arr;
    }
    
    public function cr_stats0($leagueId,$date_from){
        //SELECT `b`.`league_id`, `l`.`name` as league_name, date(FROM_UNIXTIME(a.`channel_published_at`)) as channel_date, `a`.`news_category`, COUNT(a.id) as  count FROM (`rss_sports_news` a) LEFT JOIN `teams` b ON `a`.`team_id`=`b`.`id` LEFT JOIN `leagues` l ON `b`.`league_id`=`l`.`id` WHERE `a`.`news_category` = 2 GROUP BY `b`.`league_id` ORDER BY `channel_date` desc, `league_id`
        $this->db->select('`b`.`league_id`, `l`.`name` as league_name, date(FROM_UNIXTIME(a.`channel_published_at`)) as channel_date, `a`.`news_category`, COUNT(a.id) as  count');
        $this->db->from('rss_sports_news a');
        $this->db->join('teams b','a.team_id=b.id','left');
        $this->db->join('leagues l','b.league_id=l.id','left');
        $this->db->where('a.news_category',2);
        $this->db->where('b.league_id is not null');
        if($leagueId>0){
                $this->db->where('b.league_id',$leagueId);	
        }
        if($date_from != ''){
            $this->db->where('date(FROM_UNIXTIME(a.`channel_published_at`))',$date_from);
        }   
        $this->db->group_by('`b`.`league_id`');
        $this->db->order_by('channel_date desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        $array = $query->result_array();
        $news_arr = array();
        $str = '<ul>';
        foreach($array as $key=>$row){
                $news_arr[$row['league_name']] = $row['count'];
                $str .= '<li><b>'.$row['league_name'].'</b> : '.$row['count'] .' </li>';
        }
        $str .= '</ul>';
        //echo $this->db->last_query();
        return $str;
    }

    public function cr_stats1($leagueId,$date_from){

        $this->db->select('`a`.`league_id`, `l`.`name` as league_name, date(FROM_UNIXTIME(a.`channel_published_at`)) as channel_date, `a`.`news_category`, COUNT(a.id) as count');
        $this->db->from('rss_sports_news a');
        //$this->db->join('teams b','a.team_id=b.id','left');
        $this->db->join('leagues l','a.league_id=l.id','left');
        $this->db->where('a.news_category',31);
        $this->db->where('a.league_id is not null');
        if($leagueId>0){
                $this->db->where('a.league_id',$leagueId);	
        }
        if($date_from != ''){
            $this->db->where('date(FROM_UNIXTIME(a.`channel_published_at`))',$date_from);
        }   
        $this->db->group_by('`a`.`league_id`');
        $this->db->order_by('channel_date desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        $array = $query->result_array();
        $news_arr = array();
        $str = '<ul>';
        foreach($array as $key=>$row){
                $news_arr[$row['league_name']] = $row['count'];
                $str .= '<li><b>'.$row['league_name'].'</b> : '.$row['count'] .' </li>';
        }
        $str .= '</ul>';
        //echo $this->db->last_query();
        return $str;
    }

    public function cr_stats2($leagueId,$date_from){
        $this->db->select("`b`.`league_id`, `l`.`name` as league_name, date(a.`created_at`) as channel_date, COUNT(a.id) as count");
        $this->db->from('rss_player_news a');
        $this->db->join('teams b','a.team_code=b.code','left');
        //$this->db->join('leagues l','a.league_id=l.id','left');		
        $this->db->join('leagues l','b.league_id=l.id','left');
        $this->db->where('b.league_id is not null');
        if($leagueId>0){
            $this->db->where('b.league_id',$leagueId);	
        }
        if($date_from != ''){
            $this->db->where('date(a.`created_at`)',$date_from);
        } 
        $this->db->group_by('b.league_id');
        $this->db->order_by('b.league_id');
        $query = $this->db->get();		
        $array = $query->result_array();
        $news_arr = array();
        $str = '<ul>';
        foreach($array as $key=>$row){
            $news_arr[$row['league_name']] = $row['count'];
            $str .= '<li><b>'.$row['league_name'].'</b> : '.$row['count'] .' </li>';
        }
        $str .= '</ul>';
        //echo $this->db->last_query();
        return $str;
    }

    public function cr_stats3($leagueId,$date_from){
        $this->db->select("`a`.`league_id`, `l`.`name` as league_name, date(a.`created_at`) as channel_date, COUNT(a.id) as count");
        $this->db->from('rss_waiver_news a');	
        //$this->db->join('teams b','a.team_code=b.code','left');
        //$this->db->join('leagues l','a.league_id=l.id','left');	
        $this->db->join('leagues l','a.league_id=l.id','left');
        $this->db->where('a.league_id is not null');
        if($leagueId>0){
                $this->db->where('a.league_id',$leagueId);	
        }
        if($date_from != ''){
            $this->db->where('date(a.`created_at`)',$date_from);
        } 
        $this->db->group_by('a.league_id');
        $this->db->order_by('a.league_id');
        $query = $this->db->get();		
        $array = $query->result_array();
        $news_arr = array();
        $str = '<ul>';
        foreach($array as $key=>$row){
                $news_arr[$row['league_name']] = $row['count'];
                $str .= '<li><b>'.$row['league_name'].'</b> : '.$row['count'] .' </li>';
        }
        $str .= '</ul>';
        //echo $this->db->last_query();
        return $str;
    }
}
