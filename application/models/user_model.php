<?php
class User_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	function _required($required, $data){
    	foreach($required as $field) if(!isset($data[$field])) return false;
    	return true;
	}

	function _default($defaults, $options){
    	return array_merge($defaults, $options);
	}    
    
    function getUsers($options = array()){
    	// default values
    	$options = $this->_default(array('sortDirection' => 'asc'), $options);

    	// Add where clauses to query
    	$qualificationArray = array('id', 'username', 'email');
    	foreach($qualificationArray as $qualifier)
    	{
        	if(isset($options[$qualifier])) 
        	$this->db->where($qualifier, $options[$qualifier]);
    	}
		
		if(isset($options['password']))
			$this->db->where('password', md5($options['password']));
    	// If limit / offset are declared (usually for pagination) 
    	// then we need to take them into account
    	if(isset($options['limit']) && isset($options['offset'])) 
    		$this->db->limit($options['limit'], $options['offset']);
    	else if(isset($options['limit'])) $this->db->limit($options['limit']);

    	// sort
    	if(isset($options['sortBy'])) 
    		$this->db->order_by($options['sortBy'], $options['sortDirection']);

    	$query = $this->db->get('users');
    	if($query->num_rows() == 0) return false;

        return $query->result();
    }
    
    function addUser($options = array())
    {
		if(!$this->_required(array('username', 'password', 'email', 'profile'), $options)) return false;
		
		if($this->getUsers(array('username' => $options['username'])) 
			|| $this->getUsers(array('email' => $options['email'])))
			return false;
		
        $qualificationArray = array('username', 'email', 'profile');
    	foreach($qualificationArray as $qualifier)
    	{
        	if(isset($options[$qualifier])) 
        	$this->db->set($qualifier, $options[$qualifier]);
    	}
        $this->db->set('password', md5($options['password']));
        
        $this->db->insert('users');
        return $this->db->insert_id();
	}
	
	function updateUser($options = array()){
		if(!$this->_required(array('id', 'password', 'profile'), $options))	return false;
		
		$qualificationArray = array('password', 'profile');
    	foreach($qualificationArray as $qualifier)
    	{
        	if(isset($options[$qualifier])) 
        		$this->db->set($qualifier, $options[$qualifier]);
	    }
	    
	    $this->db->where('id', $options['id']);
	    

    	// Execute the query
    	$this->db->update('users');

    	// Return the number of rows updated, or false if the row could not be inserted
    	return $this->db->affected_rows();
	}
}
?>
