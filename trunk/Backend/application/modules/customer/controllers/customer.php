<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
		if(!isset($this->session->userdata['logged_in']['email']) || $this->session->userdata['logged_in']['role'] != 2){
			redirect(base_url().'login', 'refresh');
		}
        $this->load->model('mduser', '', TRUE);
        $this->load->model('mdcustomer', '', TRUE);
        $this->load->library("pagination");
    }

    function index() {
        // get all user in database
        $user = $this->session->userdata['logged_in'];
		$data['user'] = $user;
		$this->customerdetail($user['userID']);
    }
    function changepass(){
        $user = $this->session->userdata['logged_in'];
        $data['user'] = $user;
        if(!isset($_POST['new_password'])){            
            $data['module'] = 'customer';
            $data['view_customer'] = 'view_changepass';
            echo Modules::run('customer/layout/render',$data);
        }else{
            if($this->mduser->login($user['email'],$_POST['old_password'])){
                if($_POST['new_password'] == $_POST['confirm_password']){
                    $this->mduser->changepass($user['userID'],$_POST['new_password']);
                    redirect(base_url().'customer');
                }else{
                    $data['module'] = 'customer';
                    $data['error'] = 'Your new password is not match';
                    $data['view_customer'] = 'view_changepass';
                    echo Modules::run('customer/layout/render',$data);
                }
            }else{
                $data['module'] = 'customer';
                $data['error'] = 'Your current password is wrong';
                $data['view_customer'] = 'view_changepass';
                echo Modules::run('customer/layout/render',$data);
            }
        }
    }
//==================================Customer=================================>
    function customerdetail(){
        $data['user'] = $this->session->userdata['logged_in'];
		$customerID = $data['user']['userID'];
        $data['customer'] = $this->mdcustomer->getInfoCustomer($customerID)[0];
        $cardInfo = $this->mdcustomer->getInfoCustomerCard($customerID);
        if(sizeof($cardInfo) == 0){
            $data['cardInfo'] = null;
        }else{
            $data['cardInfo'] = $cardInfo[0];
        }
        if(isset($_GET['cu_search']) && $_GET['cu_search'] != ''){
            $listTransaction = $this->mdcustomer->getListTransactionCustomerByTime($customerID,$_GET['cu_search']);
        }else{
            $listTransaction = $this->mdcustomer->getListTransactionCustomer($customerID);
        }
        
        for($i = 0; $i<sizeof($listTransaction);$i++){
            $transationID = $listTransaction[$i]->transactionID;
            $listItem = $this->mdcustomer->getTransactionDetail($transationID);
            $listTransaction[$i]->description = $listItem;
        }
        if(sizeof($listTransaction) == 0){
            $data['listTransaction'] = null;
        }else{
            $data['listTransaction'] = $listTransaction;
        }    
        $data['module'] = 'customer';
        $data['view_customer'] = 'view_detail_customer';
        echo Modules::run('customer/layout/render',$data);
    }
    function editcustomer(){
        $data['user'] = $this->session->userdata['logged_in'];
		$customerID = $data['user']['userID'];
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
    }

}

?>
