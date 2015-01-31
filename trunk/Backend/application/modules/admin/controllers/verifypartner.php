<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verifypartner extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
		if(!isset($this->session->userdata['logged_in']['email'])){
			redirect('/login', 'refresh');
		}
        $this->load->model('mdpartner', '', TRUE);
        $this->load->model('mdcustomer', '', TRUE);
        $this->load->model('mduser', '', TRUE);
        $this->load->helper('third_library');
    }

    function index() {
        $result = $this->mdpartner->listclinic();
        $this->session->set_userdata('tab', 1);
        $data['result'] = $result;
        $data['module'] = 'admin';
        $data['view_file'] = 'view_manager_clinic';
        echo Modules::run('admin/layout/render', $data);
    }

    function insertpartner() {
        if (!isset($_POST['email'])) {
            redirect(base_url().'admin?tab_active=0');
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
                if($_FILES["image"]["name"] != ''){
                    $target_dir = "image/";
                    $target_tmp = $target_dir . basename($_FILES["image"]["name"]);
                    $imageFileType = pathinfo($target_tmp,PATHINFO_EXTENSION);
                    $target_file = $target_dir.'partner_image_'.$nPartnerID.'.'.$imageFileType;
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if($check) {
                        if( move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                           $this->mdpartner->updatePartner($nPartnerID,array("image"=>$target_file)); 
                        }
                    }
                }
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
                    $dataUpdate = array('isSendEmail' => 1);
                    $this->mdpartner->updatePartner($nPartnerID,$dataUpdate);
                }
                redirect(base_url().'admin?tab_active=0');
            }else{
                $data['error'] = 'This email had been register';
                $data['user'] = $this->session->userdata['logged_in'];
                $data['customer'] = $this->mdcustomer->listCustomer();
                $data['tab_active'] = 1;
                $data['module'] = 'admin';
                $data['view_partner'] = 'view_manager_partner';
                $data['view_customer'] = 'view_add_customer';
                echo Modules::run('admin/layout/render',$data);
            }
        }
    }
 
    function insertbusiness(){
        if(!isset($_POST['partnerID'])){
            redirect(base_url().'admin');
        }else{
            var_dump($_POST);
            $data = array(
                        "partnerID"=>$_POST['partnerID'],
                        "name"=>$_POST['name'],
                        "address"=>$_POST['address'],
                        "longtitude"=>$_POST['longtitude'],
                        "latitude"=>$_POST['latitude']                        
                    );
            $nBusinessID = $this->mdpartner->insertBusiness($data);
            if($_FILES["image"]["name"] != ''){
                    $target_dir = "image/";
                    $target_tmp = $target_dir . basename($_FILES["image"]["name"]);
                    $imageFileType = pathinfo($target_tmp,PATHINFO_EXTENSION);
                    $target_file = $target_dir.'business_image_'.$nBusinessID.'.'.$imageFileType;
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if($check) {
                        if( move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                           $this->mdpartner->updateBusiness($nBusinessID,array("image"=>$target_file)); 
                        }
                    }
                }
            redirect(base_url().'admin/partner/'.$_POST['partnerID']);
        }
    }
    function insertmenugroup(){
        if(!isset($_POST['groupName'])){
            redirect(base_url().'admin?tab_active=0');
        }else{
            $data = array(
                    'businessID' => $_POST['businessID'],
                    'groupName' => $_POST['groupName'],
                    'inactive' => 0
                );
            $this->mdpartner->insertMenuGroupName($data);
            redirect(base_url().'admin/partner/'.$_POST['partnerID']);
        }
    }
    function editmenugroup(){
        if(!isset($_POST['groupName'])){
            redirect(base_url().'admin?tab_active=0');
        }else{
            $data = array(
                    'groupName' => $_POST['groupName']
                );
            $this->mdpartner->updateMenuGroupName($_POST['menuID'],$data);
            redirect(base_url().'admin/partner/'.$_POST['partnerID']);
        }
    }
    function insertitem(){
        if(!isset($_POST['menuID'])){
            redirect(base_url().'admin?tab_active=0');
        }else{            
            $data = array(
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'price' => $_POST['price'],
                    'inactive' => 0
                );
            $itemID = $this->mdpartner->insertItem($data);
            if($_FILES["image"]["name"] != ''){
                $target_dir = "image/";
                $target_tmp = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = pathinfo($target_tmp,PATHINFO_EXTENSION);
                $target_file = $target_dir.'item_image_'.$itemID.'.'.$imageFileType;
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check) {
                    if( move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                       $this->mdpartner->updateItem($itemID,array("image"=>$target_file)); 
                    }
                }
            }
            $date_item_detail = array(
                    'menuID' => $_POST['menuID'],
                    'itemID' => $itemID,
                    'inactive' => 0
            );
            $this->mdpartner->insertItemDetail($date_item_detail);
            redirect(base_url().'admin/partner/'.$_POST['partnerID']);
        }
    }
    function updateitem(){
        if(!isset($_POST['itemID'])){
            redirect(base_url().'admin?tab_active=0');
        }else{
            $itemID = $_POST['itemID'];
            //upload file image
            if($_FILES["image"]["name"] != ''){
                $target_dir = "image/";
                $target_tmp = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = pathinfo($target_tmp,PATHINFO_EXTENSION);
                $target_file = $target_dir.'item_image_'.$_POST['itemID'].'.'.$imageFileType;
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if(!$check) {

                    $data['error'] = "File is not an image.";
                    $data['user'] = $this->session->userdata['logged_in'];
                    $data['itemInfo'] = $this->mdpartner->getItemInfo($itemID)[0];
                    $businessID = $this->mdpartner->getBusinessID($itemID)[0]->businessID;
                    $data['customer'] = $this->mdcustomer->listCustomer();
                    $data['partner'] = $this->mdpartner->getPartnerID($businessID);        
                    $data['listGroupName'] = $this->mdpartner->getMenu($businessID);
                    $data['module'] = 'admin';
                    $data['tab_active'] = 0;
                    $data['view_partner'] = 'view_update_item';
                    $data['view_customer'] = 'view_manager_customer';
                    echo Modules::run('admin/layout/render',$data);
                }else{
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    $data = array(
                            'title' => $_POST['title'],
                            'description' => $_POST['description'],
                            'price' => $_POST['price'],
                            'image' => $target_file
                        );
                    $this->mdpartner->updateItem($_POST['itemID'],$data);
                    $this->mdpartner->updateItemGroupName($_POST['itemID'],$_POST['menuID']);
                    redirect(base_url().'admin/partner/'.$_POST['partnerID']);
                }
            }else{
                $data = array(
                            'title' => $_POST['title'],
                            'description' => $_POST['description'],
                            'price' => $_POST['price']
                        );
                    $this->mdpartner->updateItem($_POST['itemID'],$data);
                    $this->mdpartner->updateItemGroupName($_POST['itemID'],$_POST['menuID']);
                    redirect(base_url().'admin/partner/'.$_POST['partnerID']);
            }   
        }
    }
    function updatepartner($partnerID) {
        if (!isset($_POST['partnerID'])) {
            $data['user'] = $this->session->userdata['logged_in'];
            $data['partnerInfo'] = $this->mdpartner->getInfoPartner($partnerID)[0];
            $data['module'] = 'admin';
            $data['customer'] = $this->mdcustomer->listCustomer();
            $bankInfo = $this->mdpartner->getInfoPartnerBank($partnerID);
            if(sizeof($bankInfo) == 0){
                $data['bankInfo'] = false;
            }else{
                $data['bankInfo'] = $bankInfo[0];
            }
            $data['tab_active'] = 0;
            $data['view_partner'] = 'view_edit_partner';
            $data['view_customer'] = 'view_manager_customer';
            echo Modules::run('admin/layout/render',$data);
        } else {
                $data_user = array(
                    'firstName' => $_POST['firstName'],
					'address' => $_POST['address'],
                    'phone' => $_POST['phone']
                );
                
				$result = $this->mdpartner->updatePartner($partnerID,$data_user);
  //              var_dump($_FILES);
                if($_FILES["image"]["name"] != ''){
                    $target_dir = "image/";
                    $target_tmp = $target_dir . basename($_FILES["image"]["name"]);
                    $imageFileType = pathinfo($target_tmp,PATHINFO_EXTENSION);
                    $target_file = $target_dir.'partner_image_'.$partnerID.'.'.$imageFileType;
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if($check) {
                        if( move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
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
                        $this->mdpartner->insertBankType($data_bank);
                    }               
                }
                redirect(base_url().'admin?tab_active=0');

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
    function deletepartner($partnerID){        
        $tableName = "partner";
        $nameID = "partnerID";
        $ID = $partnerID;
        $this->mdcustomer->inactiveRecord($tableName,$nameID,$ID);
        redirect(base_url().'admin?tab_active=0');
    }
    function deletetransaction($transactionID,$partnerID){        
        $tableName = "transaction";
        $nameID = "transactionID";
        $ID = $transactionID;
        $this->mdcustomer->inactiveRecord($tableName,$nameID,$ID);
        redirect(base_url().'admin/partnertransaction'.$partnerID);
    }
    function deleteitem($itemID,$partnerID){        
        $tableName = "item";
        $nameID = "itemID";
        $ID = $itemID;
        $this->mdpartner->inactiveRecord($tableName,$nameID,$ID);
        $this->mdpartner->inactiveItemGroup($itemID);
        redirect(base_url().'admin/partner/'.$partnerID);
    }
}

?>
