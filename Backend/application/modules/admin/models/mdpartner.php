<?php

Class Mdpartner extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("partner");
    }
    
    function listPartner(){
        $this->db->from('partner');
        $this->db->where('role',1);
        $this->db->where('inactive',0);
		$query = $this->db->get();       
        return $query->result();            
    }    
    
    function insertPartner($data){		
        $this->db->insert('partner',$data); 
        return mysql_insert_id();           
    }
    function insertBankInfo($data){		
        $this->db->insert('bank_type',$data);            
    }
    function insertBusiness($data){
        $this->db->insert('business',$data);
        return mysql_insert_id();
    }
    function insertMenuGroupName($data){		
        $this->db->insert('menu',$data);            
    }
   
    function insertItem($data){
        $this->db->insert('item',$data); 
        return mysql_insert_id();
    }
    function insertItemDetail($data){
        $this->db->insert('item_detail',$data); 
    }
	function getInfoPartner($partnerID){
		$this->db->from('partner');
		$this->db->where('partnerID',$partnerID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
    function getPartnerID($businessID){
		$this->db->from('business');
		$this->db->where('businessID',$businessID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
    function getInfoPartnerBank($partnerID){
		$this->db->from('bank_type');
		$this->db->where('partnerID',$partnerID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
    function updateBankInfo($bankTypeID,$data){
		$this->db->where('bankTypeID',$bankTypeID);
		$this->db->update('bank_type',$data);
	}
	function updatePartner($partnerID,$data){
		$this->db->where('partnerID',$partnerID);
		$this->db->update('partner',$data);
	}
    function updateBusiness($businessID,$data){
		$this->db->where('businessID',$businessID);
		$this->db->update('business',$data);
	}
    function updateItem($itemID,$data){
		$this->db->where('itemID',$itemID);
		$this->db->update('item',$data);
	}
    function updateItemGroupName($itemID,$menuID){
        $this->db->where('itemID',$itemID);
		$this->db->update('item_detail',array("menuID" => $menuID));
    }
    function updateMenuGroupName($menuID,$data){
    	$this->db->where('menuID',$menuID);
        $this->db->update('menu',$data);            
    }
	function getListBusiness($partnerID){
		$this->db->from('business');
		$this->db->where('partnerID',$partnerID);
		$query = $this->db->get();
		return $query->result();
	}
    function getBusinessID($itemID){
        $sql = " select businessID from menu where menuID in ( select menuID from item_detail where itemID = $itemID and inactive = 0 ) and inactive = 0 ";
        $result = $this->db->query($sql);
        return $result->result();
    }
	function getMenu($businessID){
		$this->db->from('menu');
		$this->db->where('businessID',$businessID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
	function getItemByKeyWord($menuID,$keyword){
        $sql = " select * from item where title like '%$keyword%' and itemID in ( select itemID from item_detail where menuID = $menuID and inactive = 0) and inactive = 0 ";
        $result = $this->db->query($sql);
        return $result->result();
    }
	function getMenuItemID($menuID){
		$this->db->select('itemID');
		$this->db->from('item_detail');
		$this->db->where('menuID',$menuID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
    function getMenuItem($menuID){
        $sql = " select * from item where itemID in ( select itemID from item_detail where menuID = $menuID and inactive = 0) and inactive = 0 ";
        $result = $this->db->query($sql);
        return $result->result();
    }
    function getItemInfo($itemID){
		$this->db->from('item');
		$this->db->where('itemID',$itemID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
	function getItemDetail($itemID){
		$this->db->from('item_detail');
		$this->db->where('itemID',$itemID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
	function searchListPartner($keyword){
		$this->db->from('partner');
		$this->db->like('firstName',$keyword,'both');
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
	function getListTransactionPartner($businessID){
		$this->db->from('transaction');
		$this->db->where('businessID',$businessID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
    function getListTransactionPartnerByTime($businessID,$time){
		$this->db->from('transaction');
		$this->db->like('dateTime',date('Y-m-d',strtotime($time)),'both');
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
	function getTransactionDetail($transactionID){
		$this->db->from('transaction');
		$this->db->where('transactionID',$transactionID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
	function getTransactionItem($transactionID){
		$this->db->from('transaction_detail');
		$this->db->where('transactionID',$transactionID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
    function inactiveRecord($tableName,$nameID, $ID){
        $this->db->where($nameID,$ID);
 		$this->db->update($tableName,array('inactive'=>1));
    }
    function inactiveItemGroup($itemID){
        $data = array(
            "inactive" => 1
        );
        $this->db->where('itemID',$itemID);
        $this->db->update('item_detail',$data);
    }

}

?>
