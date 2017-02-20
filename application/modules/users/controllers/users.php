<?php
class Users extends Controller {
    public function __construct() {
        parent::Controller();
        $this->load->model('users_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        //error_reporting(E_ALL);
    }

    public function index() {
	if($this->session->userdata('is_admin') == 'admin'){
            $responce['users'] = $this->users_model->all_users();
            $k=0;
            foreach($responce['users'] as $users){
                $data['info'][$k]['user_id'] 		= $users['id'];
                $data['info'][$k]['name'] 			= $users['name'];
                $data['info'][$k]['email'] 			= $users['email'];
                $data['info'][$k]['role'] 			= $users['role'];
                $data['info'][$k]['read'] 			= $this->users_model->get_read_by_user($users['id']);
                $data['info'][$k]['edit'] 			= $this->users_model->get_edit_by_user($users['id']);
                $data['info'][$k]['publish'] 		= $this->users_model->get_publish_by_user($users['id']);
                $data['info'][$k]['notify'] 		= $this->users_model->get_notify_by_user($users['id']);
                $data['info'][$k]['delete'] 		= $this->users_model->get_delete_by_user($users['id']);
                $k++;
            }
            $data['main_content']='users';
            $this->load->view('layout/admin_template',$data);
        }
        else{
            redirect(SITEURL.'dashboard/main');
        }
    }
    
    public function register_do(){
        $config = array(
                array(
                        'field' 	=>'user_name',
                        'label'		=>'Name',
                        'rules'		=>'trim|required|max_length[50]'
                        ),
                array(
                        'field'		=>'user_email',
                        'label'		=>'Email',
                        'rules'		=>'trim|required|valid_email|is_unique[admin_users.admin_user_email]'
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
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

            $user_name 	= 	$this->input->post('user_name');
            $email 		= 	$this->input->post('user_email');
            $tmp_password = substr(str_shuffle($chars),0,8);
            $password 	= 	md5($tmp_password);
            $role  		=	$this->input->post('user_role');
            $access_token = md5(uniqid(rand(), true));
            $time		=	time();

            $insert = $this->users_model->register_user($user_name,$email,$password,$role,$access_token,$time);


            $config = Array(
              'protocol' => 'smtp',
              'smtp_host' => 'ssl://smtp.googlemail.com',
              'smtp_port' => 465,
              'smtp_user' => 'thekrooapp@gmail.com', // change it to yours
              'smtp_pass' => 'mTrjw+?jMwM_5L!m', // change it to yours
              'mailtype' => 'html',
              'charset' => 'iso-8859-1',
              'wordwrap' => TRUE );


            $message = '<p>password - '.$tmp_password.'</p><br><a href="'.SITEURL.'users/activate/'.$access_token.'">Activate Your Account</a>';
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('vinayksingh2@gmail.com'); // change it to yours
            $this->email->to($email);// change it to yours
            $this->email->subject('Activation Email ');
            $this->email->message($message);
            if($this->email->send()){
                header("Content-type: application/json");
                        echo json_encode($insert);
            }else{
             show_error($this->email->print_debugger());
            }
        }

    }

    public function activate($access_token){
        $response = $this->users_model->activate($access_token);
        if($response){
            redirect(SITEURL);
        }
    }

    public function delete_user($user_id){
        $response = $this->users_model->delete_user($user_id);
        if($response){
            header("Content-type: application/json");
            echo json_encode($response);
        }
    }

    public function reset_pwd($user_id){

        $config = array(
                array(
                        'field' 	=>'old_password',
                        'label'		=>'Password',
                        'rules'		=>'trim|required|max_length[50]'
                        ),
                array(
                        'field' 	=>'user_password',
                        'label'		=>'Password',
                        'rules'		=>'trim|required|max_length[50]|matches[user_c_password]'
                        ),
                array(
                        'field'		=>'user_c_password',
                        'label'		=>'Confirm Password',
                        'rules'		=>'trim|required|max_length[50]'
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

        }else{

            $user_id = $this->input->post('p_user_id');
            $old_password = md5($this->input->post('old_password'));
            $password = md5($this->input->post('user_password'));

            $check_pwd = $this->users_model->check_old_pwd($user_id,$old_password);
            if($check_pwd){
                $result = $this->users_model->reset_pwd($user_id,$password);

                if($result){
                    header("Content-type: application/json");
                    echo json_encode($result);
                }
            }
            else{
                header("Content-type: application/json");
                echo json_encode(false);
            }

        }
    }

    public function profile($myId){
        $response = $this->users_model->profile($myId);

        foreach($response as $row){
            $data['user_id'] = $row['id'];
            $data['user_name'] = $row['name'];
            $data['user_email'] = $row['email'];
            $data['user_role'] = $row['role'];
            $data['user_mobile'] = $row['mobile'];
            $data['user_address'] = $row['address'];
        }

        //$this->load->view('template/header');
        //$this->load->view('profile',$data);
        //$this->load->view('template/footer');
        $data['main_content']='profile';
        $this->load->view('layout/admin_template',$data);
    }

    public function profile_setting(){

        $user_id = $this->input->post('user_id');
        $name = $this->input->post('user_name');
        $mobile = $this->input->post('user_mobile');
        $role = $this->input->post('user_role');
        $address = $this->input->post('user_address');
        $update_at = time();

        $response = $this->users_model->profile_setting($user_id,$name,$mobile,$role,$address,$update_at);

        if($response){
            header("Content-type: application/json");
            echo json_encode($response);
        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        $this->load->view('home/home');

    }
	
	
}

?>
