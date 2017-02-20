<?php

class User_login extends Model {
    public function login_check($login)
    {

            $username = $login['username'];
            $password = $login['password'];

            $query = $this->db->query("SELECT * from admin_users WHERE email='$username' AND password= '$password' AND is_active='1' ");
            if($query->num_rows() > 0){
            return $query->result();}
            else{return false;}
    }

    public function check_email($email){
            $query = $this->db->query("SELECT * FROM admin_users WHERE email='$email'");
            if($query->num_rows() > 0){
            return $query->result();}
            else{return false;}
    }

    public function update_password($password,$email){
            return $this->db->query("UPDATE admin_users SET password='$password' WHERE email='$email'");
    }
    
}
