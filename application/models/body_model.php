<?php
class Body_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function _required($required, $data){
    	foreach($required as $field) if(!isset($data[$field])) return false;
    	return true;
	}

	function _default($defaults, $options){
    	return array_merge($defaults, $options);
	}

	function _checkAuthor($uid, $cid){
		$this->db->where('catalog.id', $cid);
		$this->db->where('books.uid', $uid);
		$this->db->join('books', 'books.id = catalog.bookid');
		$query = $this->db->get('catalog');
		
		if($query->num_rows() == 0) return false;
		else	return true;
	}

    function getBody($options = array()) {
    	$options = $this->_default(array('sortDirection' => 'asc'), $options);
		
    	// Add where clauses to query
    	$qualificationArray = array('id', 'cid');
    	foreach($qualificationArray as $qualifier)
    	{
       		if(isset($options[$qualifier])) 
        		$this->db->where('body.'.$qualifier, $options[$qualifier]);
    	}

    	// If limit / offset are declared (usually for pagination) 
    	// then we need to take them into account
    	if(isset($options['limit']) && isset($options['offset'])) 
    		$this->db->limit($options['limit'], $options['offset']);
    	else if(isset($options['limit'])) $this->db->limit($options['limit']);

    	// sort
    	if(isset($options['sortBy'])) 
    		$this->db->order_by($options['sortBy'], $options['sortDirection']);
		$this->db->join('body', 'body.cid = catalog.id');
		
    	$query = $this->db->get('catalog');
    	if($query->num_rows() == 0) return false;
   
        return $query->result();

    }
	
	function addBody($options = array()){
		if(!$this->_required(array('body', 'cid', 'uid'), $options))	return false;
		
		//var_dump($this->getBooks(array('uid' => $options['uid'], 'title' => $options['title'])));
		//die();
		if(!$this->_checkAuthor($options['uid'],$options['cid'])) return false;
		if($this->getBody($options))
			return updateBody($options);

		$this->db->set('cid', $options['cid']);
    	$this->db->set('body', $options['body']);
    	$this->db->set('lastmod', date("Y-m-d H:m:s"));
    	
    	$this->db->insert('body');
    	
    	return $this->db->insert_id();
	}
	
	function updateBody($options = array()){
		if(!$this->_required(array('body', 'cid', 'uid'), $options))	return false;
		
		if(!$this->_checkAuthor($options['uid'],$options['cid'])) return false;
		
		if(!$this->getBody($options))
			return $this->addBody($options);
			
		$qualificationArray = array('body');
    	foreach($qualificationArray as $qualifier)
    	{
        	if(isset($options[$qualifier])) 
        		$this->db->set($qualifier, $options[$qualifier]);
	    }
	    
	    $this->db->set('lastmod', date("Y-m-d H:m:s"));
	    $this->db->where('cid', $options['cid']);
	    

    	// Execute the query
    	$this->db->update('body');

    	// Return the number of rows updated, or false if the row could not be inserted
    	return $this->db->affected_rows();
	}
	
	function deleteBody($options = array()){
		if(!$this->_required(array('cid', 'uid'), $options)) return false;
		if(!$this->_checkAuthor($options['uid'],$options['cid'])) return false;

    	$this->db->where('cid', $options['cid']);
    	$this->db->delete('body');
    	return true;
	}
}
