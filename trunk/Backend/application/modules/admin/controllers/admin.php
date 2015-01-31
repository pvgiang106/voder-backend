<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
		if(!isset($this->session->userdata['logged_in']['email']) || $this->session->userdata['logged_in']['role'] != 0){
			redirect('/login', 'refresh');
		}
        $this->load->model('mduser', '', TRUE);
        $this->load->model('mdcustomer', '', TRUE);
        $this->load->model('mdpartner', '', TRUE);
        $this->load->library("pagination");
    }

    function index() {
        // get all user in database
        $data['user'] = $this->session->userdata['logged_in'];
        if(isset($_GET['tab_active'])){
            $data['tab_active'] = $_GET['tab_active'];
        }else{
            $data['tab_active'] = 0;
        }
		if(isset($_GET['cu_keyword']) && $_GET['cu_keyword'] != ''){
            $data['customer'] = $this->mdcustomer->searchListCustomer($_GET['cu_keyword']);
			$data['tab_active'] = 1;
        }else{
            $data['customer'] = $this->mdcustomer->listCustomer();
        }
        if(isset($_GET['pa_keyword']) && $_GET['pa_keyword'] != ''){
            $data['partner'] = $this->mdpartner->searchListPartner($_GET['pa_keyword']);
			$data['tab_active'] = 0;
        }else{
            $data['partner'] = $this->mdpartner->listPartner();
        }        
        $data['module'] = 'admin';
        $data['view_partner'] = 'view_manager_partner';
        $data['view_customer'] = 'view_manager_customer';
        echo Modules::run('admin/layout/render',$data);
    }
    function edituser(){
        
        $data['user'] = $this->session->userdata['logged_in'];
        $partnerID = $data['user']['userID'];
        $data['partnerInfo'] = $this->mdpartner->getInfoPartner($partnerID)[0];
        $data['module'] = 'admin';
        $data['customer'] = $this->mdcustomer->listCustomer();
        $data['tab_active'] = 0;
        $data['view_partner'] = 'view_edit_admin';
        $data['view_customer'] = 'view_manager_customer';
        echo Modules::run('admin/layout/render',$data);
        
    }
    function changepass(){
        if(!isset($_POST['new_password'])){
            $data['user'] = $this->session->userdata['logged_in'];
            if(isset($_GET['tab_active'])){
                $data['tab_active'] = $_GET['tab_active'];
            }else{
                $data['tab_active'] = 0;
            }
            $data['customer'] = $this->mdcustomer->listCustomer();
            $data['partner'] = $this->mdpartner->listPartner();
            $data['module'] = 'admin';
            $data['view_partner'] = 'view_changepass';
            $data['view_customer'] = 'view_changepass';
            echo Modules::run('admin/layout/render',$data);
        }else{
            if($this->mduser->login($this->session->userdata['logged_in']['email'],$_POST['old_password'])){
                if($_POST['new_password'] == $_POST['confirm_password']){
                    $this->mduser->changepass($this->session->userdata['logged_in']['userID'],$_POST['new_password'],'partner');
                    redirect(base_url().'admin');
                }else{
                    $data['user'] = $this->session->userdata['logged_in'];
                    if(isset($_GET['tab_active'])){
                        $data['tab_active'] = $_GET['tab_active'];
                    }else{
                        $data['tab_active'] = 0;
                    }
                    $data['customer'] = $this->mdcustomer->listCustomer();
                    $data['partner'] = $this->mdpartner->listPartner();
                    $data['module'] = 'admin';
                    $data['error'] = 'Your new password is not match';
                    $data['view_partner'] = 'view_changepass';
                    $data['view_customer'] = 'view_changepass';
                    echo Modules::run('admin/layout/render',$data);
                }
            }else{
                $data['user'] = $this->session->userdata['logged_in'];
                if(isset($_GET['tab_active'])){
                    $data['tab_active'] = $_GET['tab_active'];
                }else{
                    $data['tab_active'] = 0;
                }
                $data['customer'] = $this->mdcustomer->listCustomer();
                $data['partner'] = $this->mdpartner->listPartner();
                $data['module'] = 'admin';
                $data['error'] = 'Your current password is wrong';
                $data['view_partner'] = 'view_changepass';
                $data['view_customer'] = 'view_changepass';
                echo Modules::run('admin/layout/render',$data);
            }
        }
    }
    function editTotalTransaction(){
        if(isset($_POST['transactionID']) && isset($_POST['total'])){            
            $this->mduser->changeTotal($_POST['transactionID'],$_POST['total']);
        }
    }
//==================================Customer=================================>
    function customer($customerID){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['customer'] = $this->mdcustomer->getInfoCustomer($customerID)[0];
        $cardInfo = $this->mdcustomer->getInfoCustomerCard($customerID);
        if(sizeof($cardInfo) == 0){
            $data['cardInfo'] = null;
        }else{
            $data['cardInfo'] = $cardInfo[0];
        }
        if(isset($_GET['cu_tr_keyword']) && $_GET['cu_tr_keyword'] != ''){
            $listTransaction = $this->mdcustomer->getListTransactionCustomerByTime($customerID,$_GET['cu_tr_keyword']);
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
        $data['partner'] = $this->mdpartner->listPartner();         
        $data['module'] = 'admin';
        $data['tab_active'] = 1;
        $data['view_partner'] = 'view_manager_partner';
        $data['view_customer'] = 'view_detail_customer';
        echo Modules::run('admin/layout/render',$data);
    }
    
    function addcustomer(){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['partner'] = $this->mdpartner->listPartner();
        $data['module'] = 'admin';
        $data['tab_active'] = 1;
        $data['view_partner'] = 'view_manager_partner';
        $data['view_customer'] = 'view_add_customer';
        echo Modules::run('admin/layout/render',$data);
    }
    function editcustomer($customerID){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['partner'] = $this->mdpartner->listPartner();
        $data['module'] = 'admin';
        $data['customerInfo'] = $this->mdcustomer->getInfoCustomer($customerID)[0];
        $cardInfo = $this->mdcustomer->getInfoCustomerCard($customerID);
        if(sizeof($cardInfo) == 0){
            $data['cardInfo'] = false;
        }else{
            $data['cardInfo'] = $cardInfo[0];
        }
        $data['tab_active'] = 1;
        $data['view_partner'] = 'view_manager_partner';
        $data['view_customer'] = 'view_edit_customer';
        echo Modules::run('admin/layout/render',$data);
    }
//<===================================Partner==============================>
    function partner($partnerID){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['partner'] = $this->mdpartner->getInfoPartner($partnerID)[0];   
        $bankInfo = $this->mdpartner->getInfoPartnerBank($partnerID);
        if(sizeof($bankInfo) == 0){
            $data['bankInfo'] = null;
        }else{
            $data['bankInfo'] = $bankInfo[0];
        }
        $business = $this->mdpartner->getListBusiness($partnerID);
        if(sizeof($business) == 0){
            $data['business'] = null;
            $data['listMenu'] = null;
        }else{
            $data['business'] = $business[0];
            $listMenu = $this->mdpartner->getMenu($business[0]->businessID);
            $sizeMenu = sizeof($listMenu);
            if(!isset($_GET['pa_name_keyword']) || $_GET['pa_name_keyword'] == ''){
                for($i = 0; $i<$sizeMenu;$i++){
                    $listItem = $this->mdpartner->getMenuItem($listMenu[$i]->menuID);
                    $listMenu[$i]->listItem = $listItem;
                }
            }else{
                for($j = 0; $j<$sizeMenu;$j++){  
                    
                    if(strstr(strtolower($listMenu[$j]->groupName),strtolower($_GET['pa_name_keyword'])) != false){
                        $listItem = $this->mdpartner->getMenuItem($listMenu[$j]->menuID);
                        $listMenu[$j]->listItem = $listItem;
                        
                    }else{                        
                        $listItem = $this->mdpartner->getItemByKeyWord($listMenu[$j]->menuID,$_GET['pa_name_keyword']);
                        if(sizeof($listItem) != 0){
                            $listMenu[$j]->listItem = $listItem;
                        }else{                            
                            unset($listMenu[$j]);
                        }
                    }
                    
                }
            }
           
            if(sizeof($listMenu) == 0){
                $data['listMenu'] = null;
            }else{
                $tmp = array();
               
                foreach($listMenu as $row){                        
                    array_push($tmp,$row);
                }
                $data['listMenu'] = $tmp;
            }
        } 
        
        $data['customer'] =  $this->mdcustomer->listCustomer();     
        $data['module'] = 'admin';
        $data['tab_active'] = 0;
        $data['view_partner'] = 'view_detail_menu';
        $data['view_customer'] = 'view_manager_customer';
        echo Modules::run('admin/layout/render',$data);
    }
    function partnertransaction($partnerID){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['partner'] = $this->mdpartner->getInfoPartner($partnerID)[0];   
        $bankInfo = $this->mdpartner->getInfoPartnerBank($partnerID);
        if(sizeof($bankInfo) == 0){
            $data['bankInfo'] = null;
        }else{
            $data['bankInfo'] = $bankInfo[0];
        }
        $business = $this->mdpartner->getListBusiness($partnerID);
        if(sizeof($business) == 0){
            $data['business'] = null;
            $data['listTransaction'] = null;
        }else{
            $data['business'] = $business[0];
            if(isset($_GET['pa_tr_keyword']) && $_GET['pa_tr_keyword'] != ''){
                $listTransaction = $this->mdpartner->getListTransactionPartnerByTime($business[0]->businessID,$_GET['pa_tr_keyword']);
            }else{
                $listTransaction = $this->mdpartner->getListTransactionPartner($business[0]->businessID);
            }
            
            for($i = 0; $i<sizeof($listTransaction);$i++){
                $transationID = $listTransaction[$i]->transactionID;
                $listItem = $this->mdpartner->getTransactionItem($transationID);
                $listTransaction[$i]->description = $listItem;
            }
            if(sizeof($listTransaction) == 0){
                $data['listTransaction'] = null;
            }else{
                $data['listTransaction'] = $listTransaction;
            }
        }    
        
        $data['customer'] =  $this->mdcustomer->listCustomer();     
        $data['module'] = 'admin';
        $data['tab_active'] = 0;
        $data['view_partner'] = 'view_detail_transaction';
        $data['view_customer'] = 'view_manager_customer';
        echo Modules::run('admin/layout/render',$data);
    }
    function addpartner(){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['customer'] = $this->mdcustomer->listCustomer();
        $data['module'] = 'admin';
        $data['tab_active'] = 0;
        $data['view_partner'] = 'view_add_partner';
        $data['view_customer'] = 'view_manager_customer';
        echo Modules::run('admin/layout/render',$data);
    }
    function addbusiness($partnerID){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['partnerInfo'] = $this->mdpartner->getInfoPartner($partnerID)[0];
        $data['customer'] = $this->mdcustomer->listCustomer();
        $data['module'] = 'admin';
        $data['tab_active'] = 0;
        $data['view_partner'] = 'view_add_business';
        $data['view_customer'] = 'view_manager_customer';
        echo Modules::run('admin/layout/render',$data);
    }
    function additem($businessID){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['customer'] = $this->mdcustomer->listCustomer();
        $data['partner'] = $this->mdpartner->getPartnerID($businessID);        
        $data['listGroupName'] = $this->mdpartner->getMenu($businessID);
        $data['module'] = 'admin';
        $data['tab_active'] = 0;
        $data['view_partner'] = 'view_add_item';
        $data['view_customer'] = 'view_manager_customer';
        echo Modules::run('admin/layout/render',$data);
    }
    function updateitem($itemID){
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
    }
    function editpartner($partnerID){
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
    }
}

?>
