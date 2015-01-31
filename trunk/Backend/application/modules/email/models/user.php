<?php

Class User extends CI_Model {

    function email_customer() {
        $this->db->from('customer');
        $this->db->where('isSendEmail', 0);
		$this->db->where('inactive', 0);
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
		
        return false;        
    }
    
    function email_partner() {
        $this->db->from('partner');
        $this->db->where('isSendEmail', 0);
		$this->db->where('inactive', 0);
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
		
        return false;        
    }   
   //update isSendmail
    function update($id,$userType){
		if($userType == 'customer'){
			$this->db->where('customerID',$id);            
			$this->db->update('customer',array('isSendEmail' =>  1));
		}else if($userType == 'partner'){
			$this->db->where('partnerID',$id);
			$this->db->update('partner',array('isSendEmail' =>  1));		
		}        
    }    
}

?>
