<?php
// echo
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email extends MX_Controller {
    /*
     * construct the class
     */

    function __construct() {
        parent::__construct();
        $this->load->model('user', '', TRUE);
        $this->load->helper(array('url'));
    }

    /*
     * login
     */
    
            
    function index() {
        $listCustomer = $this->user->email_customer();
        $listPartner = $this->user->email_partner();
        if($listCustomer){
            for($i=0;$i<sizeof($listCustomer);$i++){
                $customer = $listCustomer[$i];
                $email = $customer->email;
                $message = "Welcome to vOder application";
                $subject = "Register vOder";
                $sendmail = $this->sendmail($email,$message,$subject);
                if($sendmail){
                    $this->user->update($customer->customerID,'customer');
                }
            }
        }
        if($listPartner){
            for($i=0;$i<sizeof($listPartner);$i++){
                $partner = $listPartner[$i];
                $email = $partner->email;
                $message = "Welcome to vOder application";
                $subject = "Register vOder";
                $sendmail = $this->sendmail($email,$message,$subject);
                if($sendmail){
                    $this->user->update($partner->partnerID,'partner');
                }
            }
        }
    }
    
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
            'smtp_pass' => '*vOder123',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        // load library email in codeIgniter
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        // create email
        $this->email->from('voderappsun@appsun.com.au', 'Register vOder');
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
}

?>
