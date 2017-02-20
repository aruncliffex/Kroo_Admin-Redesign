<?php
class Game_model extends Model {


    function __construct() {
    parent::__construct();
    }


    function form_insert($data){ 
        $this->db->insert('game', $data);
        return $this->db->insert_id();
    }

    function table_insert($table,$data){ 
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function insert_store($data){ 
        $query=$this->db->insert('store', $data);
    }

    function form_update($data,$id){ 
        $this->db->where('id', $id);
        $this->db->update('game', $data);
        return $id;
    }

    function table_update($table, $data, $fid, $id){ 
        $this->db->where($fid, $id);
        $this->db->update($table, $data);
        return $id;
    }

    function update_store($data,$id){ 
        $this->db->where('id', $id);
        $this->db->update('store', $data);
    }


    function update_tickets($data,$id){ 
        $this->db->where('id', $id);
        $this->db->update('user_tickets', $data);
    }    
    
    function qustion_delete($qustion_id,$data){ 
        $this->db->where('id', $qustion_id);
        $this->db->update('game',$data);
    }


    function get_news_id($news_id){ 
        $this->db->select("*");
        $this->db->from('game');
        $this->db->where('news_id', $news_id);
        $query=$this->db->get();
        return $query->result_array();
    }

    function get_league($news_id){ 
        $this->db->select("league_id");
        $this->db->from('rss_sports_news');
        $this->db->where('id', $news_id);
        $query=$this->db->get();
        return $query->row_array();
    }

    function get_news($news_id){ 
        $this->db->select("*");
        $this->db->from('game');
        $this->db->where('news_id', $news_id);
        $query=$this->db->get();
        return $query->result_array();
        
    }

    function get_hints($game_id){ 
        $this->db->select("*");
        $this->db->from('game_levelup_hint');
        $this->db->where('game_id', $game_id);
        $query=$this->db->get();
        return $query->result_array();
        
    }

    function game_detail($game_id){ 
        $this->db->select("g.*");
        $this->db->from('game as g');
        $this->db->where('id', $game_id);
        $query=$this->db->get();
        return $query->result_array();
        
    }

    function store_detail($store_id){ 
        $this->db->select("*");
        $this->db->from('store');
        $this->db->where('id',$store_id);
        $query=$this->db->get();
        return $query->result_array();
        
    }



    function game_listing(){ 
        /*$query=$this->db->query("SELECT a.*,t.name as tname,l.name as lname ,count(ug0.id) as not_played,count(ug1.id) as won,count(ug2.id) as lost,count(ug3.id) as timeout,count(ug4.id) as playing FROM `game` a LEFT join user_game ug0 on a.id=ug0.game_id and ug0.status='0' LEFT join user_game ug1 on a.id=ug1.game_id and ug1.status='1' LEFT join user_game ug2 on a.id=ug2.game_id and ug2.status='2' LEFT join user_game ug3 on a.id=ug3.game_id and ug3.status='3' LEFT join user_game ug4 on a.id=ug4.game_id and ug4.status='4' LEFT join teams as t on a.team=t.id LEFT join leagues as l on t.league_id=l.id where a.status='0' OR a.status='2'  group by a.id");*/
        $query=$this->db->query("SELECT a.*,if(t.name is null,'All Teams',t.name) as tname,l.name as lname ,count(ug0.id) as not_played,count(ug1.id) as won,count(ug2.id) as lost,count(ug3.id) as timeout,count(ug4.id) as playing FROM `game` a LEFT join user_game ug0 on a.id=ug0.game_id and ug0.status='0' LEFT join user_game ug1 on a.id=ug1.game_id and ug1.status='1' LEFT join user_game ug2 on a.id=ug2.game_id and ug2.status='2' LEFT join user_game ug3 on a.id=ug3.game_id and ug3.status='3' LEFT join user_game ug4 on a.id=ug4.game_id and ug4.status='4' LEFT join teams as t on a.team=t.id LEFT join leagues as l on a.league=l.id where a.status='0' OR a.status='2'  group by a.id");

        $result = $query->result_array();
        return $result;

    }


    function store_listing(){ 
        $query=$this->db->query("SELECT s.*,t1.name as team1,t2.name as team2,SUM(IF(tk1.status = 'pending',1,0))   AS pending,SUM(IF(tk1.status = 'Approved',1,0 ) )AS approved,SUM(IF(tk1.status = 'Rejected',1,0 )) AS rejected FROM store   AS s LEFT JOIN user_tickets AS tk1 ON (s.id = tk1.store_id) LEFT join teams t1 on s.team1=t1.id LEFT join teams t2 on s.team2=t2.id GROUP BY s.id");

        $result = $query->result_array(); 
        return $result;

    }
  

    function tickets_listing(){ 
        $this->db->select("ut.id as id, ut.store_id as store_id,ut.user_id as user_id,ut.tickets as tickets,ut.total_credits as total_credits,ut.status as status,ut.update_date as update_date,ut.message as msg,u.name as name,u.email as email,tm.name as t1name,t.name as t2name,s.venue as venue,c.name as country,s.date as date,s.time as time,ut.date as tdate");
        $this->db->from('user_tickets ut');
        $this->db->join('users as u','ut.user_id=u.id','left');
        $this->db->join('store as s','ut.store_id=s.id','left');
        $this->db->join('teams as tm','s.team1=tm.id','left');
        $this->db->join('teams as t','s.team2=t.id','left');
        $this->db->join('country as c','s.country=c.id','left');
        $this->db->order_by('ut.id','asc');
        $query=$this->db->get();  
       return $query->result_array();
    }

    function getGamePointsForUser($credits){
        $qry = "select points_start, points_end from activity_credits where credits >= $credits order by credits asc limit 1";
        $data = $this->db->query($qry);
       // echo $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            return null;
        }
    }

    function getGameDesciption($id){
        $qry="SELECT g.id as game_id, team, credits, 'New Game Arrived' as title from game as g where g.id=".$id;
        $data = $this->db->query($qry);
       // echo $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            return null;
        }
    }

    function getDeviceInfoIOS($team=0, $points=array(), $user_id='') {    
        //SELECT ud.id,ud.user_id,d.*,u.notification_level FROM `user_devices` ud left join `devices` d on ud.devices_id=d.id left join users u on u.id=ud.user_id WHERE d.aws_arn!='' and ud.is_logged_in='1'
        $notilevel=" d.os='ios' ";
        if($team > 0){
            $notilevel=" utf.team_id = ". $team;
        }

        if($user_id !='' && $user_id > 0){
            $notilevel .= " AND u.id = $user_id ";
        }
        
        if(count($points) > 0){
            $notilevel .=" AND u.points >= ".$points['points_start'];
        }elseif($user_id > 0){

        }else{
            return null;
        }
        
        //$qry="SELECT aws_arn  FROM user_devices as ud 
        $qry="SELECT ud.id as user_device_id,ud.user_id as user_id,ud.is_logged_in,u.id as uid,d.* ,u.notification_level
            FROM user_devices as ud 
            LEFT JOIN `devices` d on ud.devices_id=d.id
            LEFT JOIN users u on u.id=ud.user_id
            LEFT JOIN user_teams_follow utf on u.id=utf.user_id
            WHERE ". $notilevel ." AND d.aws_arn IS NOT NULL AND d.aws_arn != '' AND ud.is_logged_in='1' GROUP BY aws_arn";
            //return $sql; exit;
            $data = $this->db->query($qry);
            //echo $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return null;
        }
    }

    function getDeviceInfoAndroid($team=0, $points=array(), $user_id='') {    
        //SELECT ud.id,ud.user_id,d.*,u.notification_level FROM `user_devices` ud left join `devices` d on ud.devices_id=d.id left join users u on u.id=ud.user_id WHERE d.device_token!='' and ud.is_logged_in='1'
        $notilevel=" d.os='Android' ";
        if($team > 0){
            $notilevel=" utf.team_id = ". $team;
        }

        if($user_id !='' && $user_id > 0){
            $notilevel .= " AND u.id = $user_id ";
        }

        if(count($points) > 0){
            $notilevel .=" AND u.points >= ".$points['points_start'];
        }elseif($user_id > 0){

        }else{
            return null;
        }

        $qry="SELECT ud.id as user_device_id,ud.user_id as user_id ,d.* ,u.notification_level
            FROM user_devices as ud 
            LEFT JOIN `devices` d on ud.devices_id=d.id
            LEFT JOIN users u on u.id=ud.user_id
            LEFT JOIN user_teams_follow utf on u.id=utf.user_id
            WHERE ". $notilevel ." AND d.device_token IS NOT NULL AND d.device_token != '' AND ud.is_logged_in='1' GROUP BY device_token";
            $data = $this->db->query($qry);
           // echo $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return null;
        } 
    }

    function getDeviceInfoIOSTest($user_id='') {    
        //SELECT ud.id,ud.user_id,d.*,u.notification_level FROM `user_devices` ud left join `devices` d on ud.devices_id=d.id left join users u on u.id=ud.user_id WHERE d.aws_arn!='' and ud.is_logged_in='1'
        $notilevel="";
        if($user_id !=''){
            $notilevel .= " u.id in ($user_id) AND ";
        }

        //$qry="SELECT aws_arn  FROM user_devices as ud 
        $qry="SELECT ud.id as user_device_id,ud.user_id as user_id,ud.is_logged_in,u.id as uid,d.* ,u.notification_level
            FROM user_devices as ud 
            LEFT JOIN `devices` d on ud.devices_id=d.id
            LEFT JOIN users u on u.id=ud.user_id
            WHERE ". $notilevel ." d.os='ios' AND d.aws_arn IS NOT NULL AND d.aws_arn != '' AND ud.is_logged_in='1' GROUP BY aws_arn";
            //return $sql; exit;
            $data = $this->db->query($qry);
            //echo $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return null;
        }
    }

    function getDeviceInfoAndroidTest($user_id='') {    
        //SELECT ud.id,ud.user_id,d.*,u.notification_level FROM `user_devices` ud left join `devices` d on ud.devices_id=d.id left join users u on u.id=ud.user_id WHERE d.device_token!='' and ud.is_logged_in='1'
        $notilevel="";
        if($user_id !=''){
            $notilevel .= " u.id in ($user_id) AND ";
        }

        $qry="SELECT ud.id as user_device_id,ud.user_id as user_id ,d.* ,u.notification_level
            FROM user_devices as ud 
            LEFT JOIN `devices` d on ud.devices_id=d.id
            LEFT JOIN users u on u.id=ud.user_id
            WHERE ". $notilevel ." d.os='Android' AND d.device_token IS NOT NULL AND d.device_token != '' AND ud.is_logged_in='1' GROUP BY device_token";
            $data = $this->db->query($qry);
           // echo $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            return null;
        } 
    }

    function getTicketStatus($userTicketid){
        $qry="SELECT id as user_ticket_id,concat('Your ticket has been ',status,' by Admin') as title,user_id FROM `user_tickets` where id=".$userTicketid;
            $data = $this->db->query($qry);
           // echo $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            return null;
        }
    }

    function getMaxCredit(){
        $qry="SELECT credits FROM `activity_credits` order by credits desc limit 1";
        $data = $this->db->query($qry);
        $data = $data->row_array();
        return $data['credits'];
    }

    function update_ticket_user($ticketid){
        $this->db->where('id',$ticketid);
        $query = $this->db->get('user_tickets');
        $row = $query->row_array();
        $sql = "update users set points = points + ". $row['total_credits'] . " where id='". $row['user_id'] ."'";
        $this->db->query($sql);
    }

}