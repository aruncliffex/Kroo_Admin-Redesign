<?php
class Home extends Controller 
{
    public function __construct()
    {
        parent::Controller();
        $this->load->model('user_login');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        if($this->session->userdata('id')){
            redirect(SITEURL.'dashboard/main');
        }else{
            $this->load->view('home');
        }
    }

    public function user_login()
    {
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
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

            $login = array(
                'username' =>$this->input->post('username'),
                'password' =>md5($this->input->post('password'))
            );

            $response = json_decode(json_encode($this->user_login->login_check($login)),true);

            $response = $response[0];

            $sess_data = array(
                    'id' 		     => $response['id'],
                    'email' 	     => $response['email'],
                    'name'		     => $response['name'],
                    'is_admin'	     => $response['role'],
                    'timezoneoffset' => $this->input->post('timezoneoffset')
                    );
            $this->session->set_userdata($sess_data);

            if($response)
            {
                    echo "1";
            }
            else
            {
                    echo "0";
            }
        }


    }

    public function logout()
    {

        $this->session->sess_destroy();
        $this->load->view('home');

    }

    public function reset_pwd(){

        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|email' 
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
            $email = $this->input->post('email');
            $check_email = $this->user_login->check_email($email);

            if($check_email){

                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $tmp_password = substr(str_shuffle($chars),0,8);
                $password 	= 	md5($tmp_password);
                $this->user_login->update_password($password,$email);
                $config = Array(
                  'protocol' => 'smtp',
                  'smtp_host' => 'ssl://smtp.googlemail.com',
                  'smtp_port' => 465,
                  'smtp_user' => 'vinayksingh2@gmail.com', // change it to yours
                  'smtp_pass' => 'Cliffex@2015', // change it to yours
                  'mailtype' => 'html',
                  'charset' => 'iso-8859-1',
                  'wordwrap' => TRUE );


                $message = '<p>Temporary password - '.$tmp_password.'</p><br><a href="'.SITEURL.'">Click here to login</a>';
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from('vinayksingh2@gmail.com'); // change it to yours
                $this->email->to($email);// change it to yours
                $this->email->subject('Temporary Password');
                $this->email->message($message);
                if($this->email->send()){
                    header("Content-type: application/json");
                    echo json_encode(true);
                }else{
                    show_error($this->email->print_debugger());
                }

            }else{
                header("Content-type: application/json");
                echo json_encode(false);
            }
        }


    }
	
}
