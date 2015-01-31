<?php

Class Mduser extends CI_Model {

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
        $this->db->from('customer');
        $this->db->where('email',$email);
        $this->db->limit(1);
        
        $query = $this->db->get();
        
        if($query->num_rows() == 1){
            return $query->result();
        }
		$this->db->select('email');
        $this->db->from('partner');
        $this->db->where('email',$email);
        $this->db->limit(1);
        
        $query = $this->db->get();
        
        if($query->num_rows() == 1){
            return $query->result();
        }
        return false;
    }
    function changepass($id,$pass){
        $newPass = md5($pass);
		$this->db->where('partnerID',$id);
		$this->db->update('partner',array('password'=>  $newPass));		

    }   
  
}

?>
