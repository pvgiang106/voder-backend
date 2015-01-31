<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * class verify data login and register
 */
class VerifyLogin extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user', '', TRUE);
        $this->load->helper('third_library');
    }

    /**
     * function run when controller login is active without param
     */
    function index() {
        
        if (!isset($_POST['email'])) {
            //User redirected to login page     
            $data['module'] = 'login';
            $data['view_file'] = 'login_view';
            echo Modules::run('login/layout/render', $data);
        } else {
           
            if ($this->check_database($_POST['email'],$_POST['password']) == TRUE) {
				$cookie_name = 'remember';
				// time cookie will be die
				$cookie_time = 3600*24*30;
				//$session_data = $this->session->userdata('logged_in');
				$session_data = $this->session->userdata('logged_in');
				setcookie('ci-session', 'email='."", time() - 3600);	// Unset cookie of user
				setcookie($cookie_name, 'email='.$session_data['email'].'&role='.$session_data['role'].'&userID='.$session_data['userID'].'&firstName='.$session_data['firstName'].'&lastName='.$session_data['lastName'],time() + $cookie_time);
            
                redirect(base_url().'login/index', 'refresh');
            } else {                 
                //$this->form_validation->set_message('Invalid username or password');
                $data['error'] = 'Invalid username or password';
                $data['module'] = 'login';
                $data['view_file'] = 'login_view';
                echo Modules::run('login/layout/render', $data);
            }
        }
    }
        
    /**
     * function is check email and password is correct
     * @param type $password : password of user
     * @return boolean : return true if email and password is correct
     *                      else return false
     */
    function check_database($email, $password) {
        //query the database
        $result = $this->user->login($email, $password);

        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
				if(!isset($row->role)){
					$role = 2;
					$userID = $row->customerID;
				}else{
					$role = $row->role;
					$userID = $row->partnerID;
				}				
                $sess_array = array(
                    'email' => $row->email,
                    'role' => $role,
                    'userID' => $userID,
					'firstName' => $row->firstName,
					'lastName' => $row->lastName
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * function is handle registation
     * set rule for data input
     */
    function register() {
        if (!isset($_POST['email'])) {
            $data['error'] = '';
            $data['module'] = 'login';
            $data['view_file'] = 'registion_view';
            echo Modules::run('login/layout/render', $data);
        } else {
            if ($this->check_email($_POST['email']) == TRUE) {
                $data_user = array(
                    'firstName' => $_POST['firstName'],
                    'phone' => $_POST['phone'],
                    'password' => md5($_POST['password']),
                    'email' => $_POST['email'],
                );
                $message = 'Welcome website voder!';
                $subject = 'Registation Success !';
                $sendMail = $this->sendmail($_POST['email'], $message, $subject);
                if ($sendMail) {
					if($_POST['userType'] == 'customer'){
						$this->user->insert_customer($data_user);
					}else{
					   $data_user['role'] = 1;
						$this->user->insert_partner($data_user);
					}
				//auto login after register
                    $result = $this->user->login($data_user['email'], $_POST['password']);

                    $sess_array = array();
                    foreach ($result as $row) {
						if(!isset($row->role)){
							$role = 2;
							$userID = $row->customerID;
						}else{
						     $role = $row->role;
						     $userID = $row->partnerID;
						}							
                        $sess_array = array(
                        'userID' => $userID,
                        'firstName' => $row->firstName,
						'lastName' => $row->lastName,
                        'email' => $row->email,
                        'role' => $role
                        );

                        $this->session->set_userdata('logged_in', $sess_array);
                        redirect('/login/index', 'refresh');
                } 
            } else {
                $data['error'] = 'Send email fail.';
                $data['module'] = 'login';
                $data['view_file'] = 'registion_view';
                echo Modules::run('login/layout/render', $data);
            }
        }else{
            $data['error'] = 'Email had been register';
            $data['module'] = 'login';
            $data['view_file'] = 'registion_view';
            echo Modules::run('login/layout/render', $data);
        }
    }
    }

    /**
     * function is check $email is exist in database or not.
     * @param type $email : email you want to check
     * @return boolean : return false if $email is exist in database
     *                   return true if $email is new email in database
     */
    function check_email($email) {
        $result = $this->user->checkemail($email);
        if ($result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * function send mail from server address to $email
     * @param type $email : email you send to
     */
    function sendmail($email, $message, $subject) {
        /**
         * config email
         * send from oderappsun@appsun.com.au
         */
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.appsun.com.au',
            'smtp_port' => '25',
            'smtp_user' => 'voderappsun@appsun.com.au',
            'smtp_pass' => '*vOder123',//Nhớ đánh đúng user và pass nhé
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        // load library email in codeIgniter
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        // create email
        $this->email->from('voderappsun@appsun.com.au', 'vOder Backend');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        //$path = $this->config->item('server_root');
        //$file = $path . '/ciexam/attachments/yourinfo.txt';
        //$this->email->attach($file);

        if ($this->email->send()) {            
            return TRUE;
        } else {
            show_error($this->email->print_debugger());
            return FALSE;
        }
    }

    function resetpass() {
        if (!isset($_POST['email'])) {
            $data['module'] = 'login';
            $data['view_file'] = 'forgot_view';
            echo Modules::run('login/layout/render', $data);
        } else {
            if ($this->check_email($_POST['email']) == FALSE) {
                $this->load->helper('url');
                $result = $this->user->checkemail($_POST['email']);
                $user = $result[0];
				if($user->role == 2){
					$userType = 'customer';
					$userId = $user->customerID;
				}else{
					$userType = 'partner';
					$userId = $user->partnerID;
				}
                $this->load->helper('string');
                $password = random_string('alnum', 6);
                
                $message = ('You have requested the new password, Here is you new password : ' . $password);
                //echo $password;
                $subject = 'Reset Password .';
				$sendMail = $this->sendmail($_POST['email'], $message, $subject);
                if ($sendMail) {
					$this->user->changepass($userId, $password, $userType);				
                    $data['module'] = 'login';
                    $data['view_file'] = 'login_view';
                    echo Modules::run('login/layout/render', $data);
                } else {
                    $data['error'] = 'Send mail fail, Please try again';
                    $data['module'] = 'login';
                    $data['view_file'] = 'forgot_view';
                    echo Modules::run('login/layout/render', $data);
                }
            } else {
                $data['error'] = 'Email not registed';
                $data['module'] = 'login';
                $data['view_file'] = 'forgot_view';
                echo Modules::run('login/layout/render', $data);
            }
        }
    }

}

?>