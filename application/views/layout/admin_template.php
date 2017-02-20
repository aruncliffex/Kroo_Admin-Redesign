<?php 
if(strstr($_SERVER['REQUEST_URI'],'dashboard')!==false){
    $this->load->view('layout/dashboard_header'); 
}else{
    $this->load->view('layout/admin_header'); 
}

$this->load->view($main_content); 

if(strstr($_SERVER['REQUEST_URI'],'dashboard')!==false){
    $this->load->view('layout/dashboard_footer'); 
}else{
    $this->load->view('layout/admin_footer'); 
}

?>