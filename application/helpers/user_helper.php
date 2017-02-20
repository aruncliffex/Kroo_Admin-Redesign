<?php if ( ! defined ( 'BASEPATH' ) ) {

    exit( 'No direct script access allowed' );
}

/**
 * Log In User
 * @access public
 * @param $email_address Email address
 * @return bool
 */
if (!function_exists('helper_user_login')) {

    function helper_user_login($email_address) {

        $CI = & get_instance();
        $CI->load->model('User_model');
        $user_id = $CI->User_model->get_user_id($email_address);
        if (is_numeric($user_id)) {
            $CI->session->set_userdata([ 'user_email' => $email_address]);
            $CI->session->set_userdata([ 'user_id' => $user_id]);
            $CI->session->set_userdata([ 'is_logged_in' => 1]);
            return TRUE;
        } else {
            return FALSE;
        }
    }

}


/**
 * Check If User Is Logged In
 * @access public
 * @return bool
 */
if (!function_exists('helper_user_is_user_logged_in')) {

    function helper_user_is_user_logged_in() {
        $CI = & get_instance();
        if ($CI->session->userdata('is_logged_in') == 1 && !empty($CI->session->userdata('user_email'))) {
            return TRUE;
        }
        return FALSE;
    }

}

/**
 * Redirect User To Home Page
 *
 * @access public
 * @return bool
 */
if ( ! function_exists ( 'helper_user_redirect_home' ) ) {
    function helper_user_redirect_home () {
        redirect ( base_url () . 'dashboard' );
    }
}



/**
 * Check If Email Is cliffex Email
 * @access public
 * @param $email_address string Email ID.
 * @return bool
 */
if (!function_exists('helper_user_email_is_loudcell')) {

    function helper_user_email_is_loudcell($email_address) {
        $ends_with = '@cliffex.com';
        if (strpos($email_address, $ends_with, strlen($email_address) - strlen($ends_with))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}


/**
 * Return Salted Password
 * Generate a SHA-512 password from a string a a salt.
 *
 * @access public
 * @param string $string input string
 * @param string $salt   password salt
 * @return string
 */
if (!function_exists('helper_user_salt_pwd')) {

    function helper_user_salt_pwd($string, $salt) {
        $hashed_string = substr($salt, 0, ceil(strlen($salt) / 2)) . $string . substr($salt, ceil(strlen($salt) / 2), strlen($salt));
        return hash('sha512', $hashed_string);
    }

}



/**
 * Generate a Random Salt
 * Generates a random string suitable as a password salt.
 * @access public
 * @return string
 */
if ( ! function_exists('helper_sec_get_salt') ) {
	function helperGetRandomsalt () {
		return hash('sha512', uniqid(rand(), TRUE));
	}
}



/**
 * Log In User
 *
 * @access public
 * @param $email_address Email address
 * @return bool
 */
if ( ! function_exists ( 'helper_user_audit_log' ) ) {

    function helper_user_audit_log ( $type, $message ) {

        $CI =& get_instance();
        $user_id = $CI->session->userdata('user_id');
        $time = time();

        $CI->load->model('User_model');

        $CI->User_model->audit_log($user_id, $type, $time, $message);
    }
}

/* End of file user_helper.php */
/* Location: ./application/helpers/user_helper.php */