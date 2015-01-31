<?php

Class Mdcustomer extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("customer");
    }
    
    function listCustomer(){
        $this->db->from('customer');
        $this->db->where('inactive',0);
		$query = $this->db->get();       
        return $query->result();             
    }    
    
    function insertCustomer($data){		
        $this->db->insert('customer',$data);            
    }
	
	function getInfoCustomer($customerID){
		$this->db->from('customer');
		$this->db->where('customerID',$customerID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
    function getInfoCustomerCard($customerID){
		$this->db->from('card_type');
		$this->db->where('customerID',$customerID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
	function searchListCustomer($keyword){
		$this->db->from('customer');
		$this->db->like('firstName',$keyword,'both');
		$this->db->or_like('lastName',$keyword,'both');
		$query = $this->db->get();
		return $query->result();
	}
	function updateCustomer($customerID,$data){
		$this->db->where('customerID',$customerID);
        $this->db->where('inactive',0);
		$this->db->update('customer',$data);
	}
    function insertCardType($data){		
        $this->db->insert('card_type',$data);            
    }
    function updateCardInfo($cardTypeID,$data){
		$this->db->where('cardTypeID',$cardTypeID);
        $this->db->where('inactive',0);
		$this->db->update('card_type',$data);
	}
	function getListTransactionCustomer($customerID){
		$this->db->from('transaction');
		$this->db->where('customerID',$customerID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
    function getListTransactionCustomerByTime($customerID,$time){
		$this->db->from('transaction');
		$this->db->like('dateTime',date('Y-m-d',strtotime($time)),'both');
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
    function getTransactionDetail($transactionID){
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
}

?>
