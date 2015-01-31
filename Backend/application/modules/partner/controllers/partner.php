<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Partner extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
		if(!isset($this->session->userdata['logged_in']['email']) || $this->session->userdata['logged_in']['role'] != 1){
			redirect('/login', 'refresh');
		}
        $this->load->model('mduser', '', TRUE);
        $this->load->model('mdpartner', '', TRUE);
        $this->load->library("pagination");
    }

    function index() {
        // get all user in database
        $user = $this->session->userdata['logged_in'];
		$data['user'] = $user;
		$this->partnerdetail($user['userID']);
    }
    function changepass(){
        $user = $this->session->userdata['logged_in'];
        $data['user'] = $user;
        if(!isset($_POST['new_password'])){            
            $data['partner'] = $this->mdpartner->listPartner();
            $data['module'] = 'partner';
            $data['view_partner'] = 'view_changepass';
            echo Modules::run('partner/layout/render',$data);
        }else{
            if($this->mduser->login($user['email'],$_POST['old_password'])){
                if($_POST['new_password'] == $_POST['confirm_password']){
                    $this->mduser->changepass($user['userID'],$_POST['new_password']);
                    redirect(base_url().'partner');
                }else{
                    $data['module'] = 'partner';
                    $data['error'] = 'Your new password is not match';
                    $data['view_partner'] = 'view_changepass';
                    echo Modules::run('partner/layout/render',$data);
                }
            }else{
                $data['module'] = 'partner';
                $data['error'] = 'Your current password is wrong';
                $data['view_partner'] = 'view_changepass';
                echo Modules::run('partner/layout/render',$data);
            }
        }
    }
    function partnerdetail(){
        $data['user'] = $this->session->userdata['logged_in'];
		$partnerID = $data['user']['userID'];
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
                    
                    if(strstr(strtolower ($listMenu[$j]->groupName),strtolower ($_GET['pa_name_keyword'])) != false){
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
        
        $data['module'] = 'partner';
        $data['view_partner'] = 'view_detail_menu';
        echo Modules::run('partner/layout/render',$data);
    }
    function partnertransaction(){
        $data['user'] = $this->session->userdata['logged_in'];
		$partnerID = $data['user']['userID'];
        $data['partner'] = $this->mdpartner->getInfoPartner($partnerID)[0];   
        $bankInfo = $this->mdpartner->getInfoPartnerBank($partnerID);
        if(sizeof($bankInfo) == 0){
            $data['bankInfo'] = null;
        }else{
            $data['bankInfo'] = $bankInfo[0];
        }$business = $this->mdpartner->getListBusiness($partnerID);
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
                $listItem = $this->mdpartner->getTransactionDetail($transationID);
                $listTransaction[$i]->description = $listItem;
            }
            if(sizeof($listTransaction) == 0){
                $data['listTransaction'] = null;
            }else{
                $data['listTransaction'] = $listTransaction;
            }
        }    
      
        $data['module'] = 'partner';
        $data['view_partner'] = 'view_detail_transaction';
        echo Modules::run('partner/layout/render',$data);
    }

    function additem($businessID){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['partner'] = $this->mdpartner->getPartnerID($businessID);        
        $data['listGroupName'] = $this->mdpartner->getMenu($businessID);
        $data['module'] = 'partner';
        $data['view_partner'] = 'view_add_item';
        echo Modules::run('partner/layout/render',$data);
    }
    function updateitem($itemID){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['itemInfo'] = $this->mdpartner->getItemInfo($itemID)[0];
        $businessID = $this->mdpartner->getBusinessID($itemID)[0]->businessID;
        $data['partner'] = $this->mdpartner->getInfoPartner($data['user']['userID']);        
        $data['listGroupName'] = $this->mdpartner->getMenu($businessID);
        $data['module'] = 'partner';
        $data['view_partner'] = 'view_update_item';
        echo Modules::run('partner/layout/render',$data);
    }
    function addbusiness(){
        $data['user'] = $this->session->userdata['logged_in'];
        $partnerID = $data['user']['userID'];
        $data['partnerInfo'] = $this->mdpartner->getInfoPartner($partnerID)[0];
        $data['module'] = 'partner';
        $data['view_partner'] = 'view_add_business';
        echo Modules::run('partner/layout/render',$data);
    }
    function editpartner(){		
        $data['user'] = $this->session->userdata['logged_in'];
		$partnerID = $data['user']['userID'];
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
    }
}

?>
