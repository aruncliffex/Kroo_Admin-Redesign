<?php
class Apipage_model extends Model {

    public function newsdetails($newstype, $newsid){
        //echo $newstype;
        if($newstype == 2 || $newstype==31){
            $this->db->select('a.title, a.summary, a.details, a.image, a.channel_published_at, a.url, a.author, a.content_type, b.value as channel_value');
            $this->db->from('sports_news a');
            $this->db->join('type_master b','a.channel=b.id');
            $this->db->where('a.id',$newsid);
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->row_array();
        }elseif($newstype==3){
            $query = $this->db->query('select title, summary, details, image, channel_published_at, url, content_type, author, concat(source,"_news") as channel_value from waiver_news where id = '. $newsid);
            //echo $this->db->last_query();
            return $query->row_array();
        }elseif($newstype==4){
            $query = $this->db->query('select title, summary, details, image, channel_published_at, url, author, content_type, concat(source,"_news") as channel_value from player_news where id = '. $newsid);
            //echo $this->db->last_query();
            return $query->row_array();
        }
        
    }

   
}
