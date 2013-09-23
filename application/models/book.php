<?php

class Book extends CI_Model {

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

    function getBooks($options = array()) {
    	$options = $this->_default(array('sortDirection' => 'asc'), $options);

    	// Add where clauses to query
    	$qualificationArray = array('uid', 'id', 'title');
    	foreach($qualificationArray as $qualifier)
    	{
       		if(isset($options[$qualifier])) 
        		$this->db->where($qualifier, $options[$qualifier]);
    	}

    	// If limit / offset are declared (usually for pagination) 
    	// then we need to take them into account
    	if(isset($options['limit']) && isset($options['offset'])) 
    		$this->db->limit($options['limit'], $options['offset']);
    	else if(isset($options['limit'])) $this->db->limit($options['limit']);

    	// sort
    	if(isset($options['sortBy'])) 
    		$this->db->order_by($options['sortBy'], $options['sortDirection']);
		$this->db->join('users', 'users.id = books.uid');
		
    	$query = $this->db->get('books');
    	if($query->num_rows() == 0) return false;
   
        return $query->result();

    }
    
	function getcatalog($uid, $bid){
		$query = $this->db->query('select * from catalog where bookid=' . $bid);
		return $query->result();
	}
	
	function addBook($options = array()){
		if(!$this->_required(array('title', 'uid'), $options))	return false;
		
		//var_dump($this->getBooks(array('uid' => $options['uid'], 'title' => $options['title'])));
		//die();
		
		if($this->getBooks(array('uid' => $options['uid'], 'title' => $options['title']))) return false;

		$this->db->set('uid', $options['uid']);
    	$this->db->set('title', $options['title']);
    	$this->db->set('lastmod', date("Y-m-d H:m:s"));
    	
    	$this->db->insert('books');
    	
    	return $this->db->insert_id();
	}
}
