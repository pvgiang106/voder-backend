<?php

Class User extends CI_Model {

    function login($email, $password) {
        $this->db->from('customer');
        $this->db->where('email', $email);
        $this->db->where('password',  md5($password));
		$this->db->where('inactive', 0);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
		$this->db->from('partner');
        $this->db->where('email', $email);
        $this->db->where('password',  md5($password));
		$this->db->where('inactive', 0);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
		
        return false;        
    }
    
    function checkemail($email) {
		$result = false;
        $this->db->from('customer');
        $this->db->where('email',$email);
        $this->db->limit(1);
        
        $query = $this->db->get();
        
        if($query->num_rows() == 1){
            $result = $query->result();
			$result[0]->role = 2;
        }
        $this->db->from('partner');
        $this->db->where('email',$email);
        $this->db->limit(1);
        
        $query = $this->db->get();
        
        if($query->num_rows() == 1){
			$result = $query->result();
        }
        return $result;
    }    
    
    function insert_customer($data){
        $this->db->insert('customer',$data);
    }
	function insert_partner($data){
        $this->db->insert('partner',$data);
    }
    // insert data into profile
    function inserttoprofile($dataprofile){
        $this->db->insert('profile',$dataprofile);
    }    
    // change pass for user
    function changepass($id,$pass,$userType){
		if($userType == 'customer'){
            $newPass = md5($pass);
			$this->db->where('customerID',$id);            
			$this->db->update('customer',array('password'=>  $newPass));
		}else if($userType == 'partner'){
            $newPass = md5($pass);
			$this->db->where('partnerID',$id);
			$this->db->update('partner',array('password'=>  $newPass));		
		}        
    }    
}

?>
