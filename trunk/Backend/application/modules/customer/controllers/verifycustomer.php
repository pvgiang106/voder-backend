<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class VerifyCustomer extends MX_Controller {

    function __construct() {
        parent::__construct();
		if(!isset($this->session->userdata['logged_in']['email']) || $this->session->userdata['logged_in']['role'] != 2 ){
			redirect('/login', 'refresh');
		}
        $this->load->model('mdcustomer', '', TRUE);
        $this->load->model('mduser', '', TRUE);
        $this->load->helper('third_library');
    }

      /**
     * function is handle registation
     * set rule for data input
     */
    function insertcustomer() {
        if (!isset($_POST['email'])) {
            redirect(base_url().'customer');
        } else {
            if ($this->check_email($_POST['email']) == TRUE) {
                $data_user = array(
                    'firstName' => $_POST['firstName'],
					'lastName' => $_POST['lastName'],
                    'phone' => $_POST['phone'],
                    'password' => md5($_POST['password']),
                    'email' => $_POST['email']
                );

				$result = $this->mdcustomer->insertCustomer($data_user);
                $nCustomerID = mysql_insert_id();
                if($_POST['card_number'] != '' && $_POST['ccv'] != ''){
                $data_card = array(
                    'name' => $_POST['card_name'],
					'number' => $_POST['card_number'],
                    'expire_date' => $_POST['expire_date'],
                    'ccv' => $_POST['ccv'],
                    'customerID' => $nCustomerID
                );
                $this->mdcustomer->insertCardTyp($data_card);
                }
				                
                $message = 'Welcome website voder!';
                $subject = 'Registation Success !';
                $sendMail = $this->sendmail($_POST['email'], $message, $subject);
                if($sendMail){
                    $dataUpdate = array('isSendMail' => 1);
                    $this->mdcustomer->updateCustomer($nCustomerID,$dataUpdate);
                }
                redirect(base_url().'customer');

            }else{
                $data['error'] = 'This email had been register';
                $data['user'] = $this->session->userdata['logged_in'];
                $data['module'] = 'customer';
                $data['view_customer'] = 'view_add_customer';
                echo Modules::run('customer/layout/render',$data);
            }
        }
    }
    function updatecustomer() {
		$customerID = $this->session->userdata['logged_in']['userID'];
        if (!isset($_POST['customerID'])) {
            $data['user'] = $this->session->userdata['logged_in'];
            $data['module'] = 'customer';
            $data['customerInfo'] = $this->mdcustomer->getInfoCustomer($customerID)[0];
            $cardInfo = $this->mdcustomer->getInfoCustomerCard($customerID);
            if(sizeof($cardInfo) == 0){
                $data['cardInfo'] = false;
            }else{
                $data['cardInfo'] = $cardInfo[0];
            }
            $data['view_customer'] = 'view_edit_customer';
            echo Modules::run('customer/layout/render',$data);
        } else {
                $data_user = array(
                    'firstName' => $_POST['firstName'],
					'lastName' => $_POST['lastName'],
                    'phone' => $_POST['phone']
                );

				$result = $this->mdcustomer->updateCustomer($customerID,$data_user);
                if($_FILES["image"]["name"] != ''){
                    $target_dir = "image/";
                    $target_tmp = $target_dir . basename($_FILES["image"]["name"]);
                    $imageFileType = pathinfo($target_tmp,PATHINFO_EXTENSION);
                    $target_file = $target_dir.'customer_image'.$customerID.'.'.$imageFileType;
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if($check) {
                        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                            $this->mdcustomer->updateCustomer($customerID,array("image"=>$target_file));
                        }
                    }
                }
                if($_POST['card_number'] != '' && $_POST['ccv'] != ''){
                    $data_card = array(
                        'name' => $_POST['card_name'],
    					'number' => $_POST['card_number'],
                        'expire_date' => $_POST['expire_date'],
                        'ccv' => $_POST['ccv'],
                        'customerID' => $customerID
                    );
                    if(isset($_POST['cardTypeID'])){
                         $this->mdcustomer->updateCardInfo($_POST['cardTypeID'],$data_card);
                    }else{
                        $this->mdcustomer->insertCardType($data_card);
                    }               
                }
                redirect(base_url().'customer');

        }
    }

    /**
     * function is check $email is exist in database or not.
     * @param type $email : email you want to check
     * @return boolean : return false if $email is exist in database
     *                   return true if $email is new email in database
     */
    function check_email($email) {
        $result = $this->mduser->checkemail($email);

        if ($result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function check_database($email, $password) {
        //query the database
        $result = $this->mduser->login($email, $password);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /**
     * function send mail from server address to $email
     * @param type $email : email you send to
     */
    function sendmail($email, $message, $subject) {
        /**
         * config email
         * send from email voderappsun@appsun.com.au
         */
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.appsun.com.au',
            'smtp_port' => '25',
            'smtp_user' => 'voderappsun@appsun.com.au',
            'smtp_pass' => '*vOder123',//Nh? dánh dúng user và pass nhé
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        // load library email in codeIgniter
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        // create email
        $this->email->from('shinichi1691@gmail.com', 'vOder Backend');
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
    function deletetransaction($transactionID){        
        $tableName = "transaction";
        $nameID = "transactionID";
        $ID = $transactionID;
        $this->mdcustomer->inactiveRecord($tableName,$nameID,$ID);
        redirect(base_url().'customer');
    }
}

?>