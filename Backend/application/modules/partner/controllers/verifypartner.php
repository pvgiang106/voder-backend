<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verifypartner extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
		if(!isset($this->session->userdata['logged_in']['email']) || $this->session->userdata['logged_in']['role'] != 1 ){
			redirect('/login', 'refresh');
		}
        $this->load->model('mdpartner', '', TRUE);
        $this->load->model('mduser', '', TRUE);
        $this->load->helper('third_library');
    }

    function insertpartner() {
        if (!isset($_POST['email'])) {
            redirect(base_url().'partner?tab_active=0');
        } else {
            if ($this->check_email($_POST['email']) == TRUE) {
                $data_user = array(
                    'firstName' => $_POST['firstName'],
                    'phone' => $_POST['phone'],
                    'password' => md5($_POST['password']),
                    'email' => $_POST['email'],
                    'address' => $_POST['address']
                );

				$nPartnerID = $this->mdpartner->insertPartner($data_user);
                if($_POST['bank_number'] != '' && $_POST['bsb'] != ''){
                $data_bank = array(
                    'name' => $_POST['bank_name'],
					'number' => $_POST['bank_number'],
                    'bsb' => $_POST['bsb'],
                    'partnerID' => $nPartnerID
                );
                $this->mdpartner->insertBankInfo($data_bank);
                }
				                
                $message = 'Welcome website voder!';
                $subject = 'Registation Success !';
                $sendMail = $this->sendmail($_POST['email'], $message, $subject);
                if($sendMail){
                    $dataUpdate = array('isSendMail' => 1);
                    $this->mdpartner->updatePartner($nCustomerID,$dataUpdate);
                }
                redirect(base_url().'partner?tab_active=0');
            }else{
                $data['error'] = 'This email had been register';
                $data['user'] = $this->session->userdata['logged_in'];

                $data['module'] = 'partner';
                $data['view_partner'] = 'view_manager_partner';
                echo Modules::run('partner/layout/render',$data);
            }
        }
    }
    function insertmenugroup(){
        if(!isset($_POST['groupName'])){
            redirect(base_url().'partner');
        }else{
            $data = array(
                    'businessID' => $_POST['businessID'],
                    'groupName' => $_POST['groupName'],
                    'inactive' => 0
                );
            $this->mdpartner->insertMenuGroupName($data);
            redirect(base_url().'partner');
        }
    }
    function editmenugroup(){
        if(!isset($_POST['groupName'])){
            redirect(base_url().'partner');
        }else{
            $data = array(
                    'groupName' => $_POST['groupName']
                );
            $this->mdpartner->updateMenuGroupName($_POST['menuID'],$data);
            redirect(base_url().'partner');
        }
    }
    function insertitem(){
        if(!isset($_POST['menuID'])){
            redirect(base_url().'partner');
        }else{
            $data = array(
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'price' => $_POST['price'],
                    'inactive' => 0
                );
            $itemID = $this->mdpartner->insertItem($data);
            //upload file image
            if($_FILES["image"]["name"] != ''){
                $target_dir = "image/";
                $target_tmp = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = pathinfo($target_tmp,PATHINFO_EXTENSION);
                $target_file = $target_dir.'item_image_'.$_POST['itemID'].'.'.$imageFileType;
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check) {
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                        $this->mdpartner->updateItem($_POST['itemID'],array("image"=>$target_file));
                    }
                }
            }
            $date_item_detail = array(
                    'menuID' => $_POST['menuID'],
                    'itemID' => $itemID,
                    'inactive' => 0
            );
            $this->mdpartner->insertItemDetail($date_item_detail);
            redirect(base_url().'partner');
        }
    }
    function updateitem(){
        if(!isset($_POST['itemID'])){
            redirect(base_url().'partner');
        }else{
            $itemID = $_POST['itemID'];
            $data = array(
                            'title' => $_POST['title'],
                            'description' => $_POST['description'],
                            'price' => $_POST['price']
                        );
            $this->mdpartner->updateItem($_POST['itemID'],$data);
            $this->mdpartner->updateItemGroupName($_POST['itemID'],$_POST['menuID']);
            //upload file image
            if($_FILES["image"]["name"] != ''){
                $target_dir = "image/";
                $target_tmp = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = pathinfo($target_tmp,PATHINFO_EXTENSION);
                $target_file = $target_dir.'item_image_'.$_POST['itemID'].'.'.$imageFileType;
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check) {
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                        $this->mdpartner->updateItem($_POST['itemID'],array("image"=>$target_file));
                    }
                }
            }

             redirect(base_url().'partner');
  
        }
    }
    function insertbusiness(){
        if(!isset($_POST['partnerID'])){
            redirect(base_url().'partner');
        }else{
            $data = array(
                        "partnerID"=>$_POST['partnerID'],
                        "name"=>$_POST['name'],
                        "address"=>$_POST['address'],
                        "longtitude"=>$_POST['longitude'],
                        "latitude"=>$_POST['latitude']                        
                    );
            $this->mdpartner->insertBusiness($data);
            redirect(base_url().'partner');
        }
    }
    function updatepartner() {
		$partnerID = $this->session->userdata['logged_in']['userID'];
        if (!isset($_POST['partnerID'])) {
            $data['user'] = $this->session->userdata['logged_in'];
            $data['partnerInfo'] = $this->mdpartner->getInfoPartner($partnerID)[0];
            $data['module'] = 'partner';
            $bankInfo = $this->mdpartner->getInfoPartnerBank($partnerID);
            if(sizeof($bankInfo) == 0){
                $data['bankInfo'] = false;
            }else{
                $data['bankInfo'] = $bankInfo[0];
            }
            $data['view_partner'] = 'view_edit_partner';
            echo Modules::run('partner/layout/render',$data);
        } else {
                $data_user = array(
                    'firstName' => $_POST['firstName'],
					'address' => $_POST['address'],
                    'phone' => $_POST['phone']
                );

				$result = $this->mdpartner->updatePartner($partnerID,$data_user);
                //upload file image
                if($_FILES["image"]["name"] != ''){
                    $target_dir = "image/";
                    $target_tmp = $target_dir . basename($_FILES["image"]["name"]);
                    $imageFileType = pathinfo($target_tmp,PATHINFO_EXTENSION);
                    $target_file = $target_dir.'partner_image_'.$partnerID.'.'.$imageFileType;
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if($check) {
                        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                            $this->mdpartner->updatePartner($partnerID,array("image"=>$target_file));
                        }
                    }
                }
                if($_POST['bank_number'] != '' && $_POST['bsb'] != ''){
                    $data_bank = array(
                        'name' => $_POST['bank_name'],
    					'number' => $_POST['bank_number'],
                        'bsb' => $_POST['bsb'],
                        'partnerID' => $partnerID
                    );
                    if(isset($_POST['bankTypeID'])){
                         $this->mdpartner->updateBankInfo($_POST['bankTypeID'],$data_bank);
                    }else{
                        $this->mdpartner->insertBankInfo($data_bank);
                    }               
                }
                redirect(base_url().'partner');

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
    function check_email($email) {
        $result = $this->mduser->checkemail($email);

        if ($result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
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
        $this->mdpartner->inactiveRecord($tableName,$nameID,$ID);
        redirect(base_url().'partner/partnertransaction');
    }
    function deleteitem($itemID){        
        $tableName = "item";
        $nameID = "itemID";
        $ID = $itemID;
        $this->mdpartner->inactiveRecord($tableName,$nameID,$ID);
        $this->mdpartner->inactiveItemGroup($itemID);
        redirect(base_url().'partner');
    }
}

?>
