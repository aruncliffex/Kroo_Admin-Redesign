<?php

class Users_model extends Model {

    public function all_users(){
        $query = $this->db->query("SELECT * FROM admin_users");
        return $query->result_array();
    }

    public function register_user($user_name,$email,$password,$role,$access_token,$time){
        $query = $this->db->query("INSERT INTO admin_users (name,email,password,role,access_token,time) VALUES ('$user_name','$email','$password','$role','$access_token',$time) ");
        return true;
    }

    public function delete_user($user_id){
        $query = $this->db->query("DELETE FROM admin_users WHERE id='$user_id'");
        return true;
    }

    public function reset_pwd($user_id,$password){
        $query = $this->db->query("UPDATE admin_users SET password='$password' WHERE id = '$user_id'");
        return true;
    }

    public function activate($access_token){
        $query = $this->db->query("UPDATE admin_users SET is_active='1' WHERE access_token='$access_token'");
        return true;
    }

    public function profile($myId){
        $query = $this->db->query("SELECT * FROM admin_users WHERE id='$myId'");
        return $query->result_array();
    }

    public function profile_setting($user_id,$name,$mobile,$role,$address,$update_at){
        $query = $this->db->query("UPDATE admin_users SET name='$name', mobile='$mobile', role='$role', address='$address', updated_at='$update_at' WHERE id='$user_id'");
        return true;
    }

    public function check_old_pwd($user_id,$old_password){
        $query = $this->db->query("SELECT * FROM admin_users WHERE password='$old_password' AND id=$user_id");
        if($query->num_rows() > 0){
        return $query->result();}
        else{return false;}
    }

    public function get_read_by_user($user_id){
        $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_user_id = $user_id AND activity_action ='read' ");
        return $query->num_rows();
    }

    public function get_edit_by_user($user_id){
        $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_user_id = $user_id AND activity_action ='edit' ");
        return $query->num_rows();
    }

    public function get_publish_by_user($user_id){
        $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_user_id = $user_id AND activity_action ='publish' ");
        return $query->num_rows();
    }

    public function get_notify_by_user($user_id){
        $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_user_id = $user_id AND activity_action ='notify' ");
        return $query->num_rows();
    }

    public function get_delete_by_user($user_id){
        $query = $this->db->query("SELECT * FROM admin_activity WHERE activity_user_id = $user_id AND activity_action ='delete' ");
        return $query->num_rows();
    }
}
