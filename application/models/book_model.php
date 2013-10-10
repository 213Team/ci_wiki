<?php
class Book_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('catalog_model');
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
        		$this->db->where('books.'.$qualifier, $options[$qualifier]);
    	}

    	// If limit / offset are declared (usually for pagination) 
    	// then we need to take them into account
    	if(isset($options['limit']) && isset($options['offset'])) 
    		$this->db->limit($options['limit'], $options['offset']);
    	else if(isset($options['limit'])) $this->db->limit($options['limit']);

    	// sort
    	if(isset($options['sortBy'])) 
    		$this->db->order_by($options['sortBy'], $options['sortDirection']);
		$this->db->join('books', 'users.id = books.uid');
		
    	$query = $this->db->get('users');
    	if($query->num_rows() == 0) return false;
   
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
	
	function updateBook($options = array()){
		if(!$this->_required(array('id', 'uid'), $options))	return false;
		if($this->getBooks(array('uid' => $options['uid'], 'id' => $options['id'])) == false) return false;
		
		$qualificationArray = array('title');
    	foreach($qualificationArray as $qualifier)
    	{
        	if(isset($options[$qualifier])) 
        		$this->db->set($qualifier, $options[$qualifier]);
	    }
	    
	    $this->db->set('lastmod', date("Y-m-d H:m:s"));
	    $this->db->where('id', $options['id']);
	    

    	// Execute the query
    	$this->db->update('books');

    	// Return the number of rows updated, or false if the row could not be inserted
    	return $this->db->affected_rows();
	}
	
	function deleteBook($options = array()){
		if(!$this->_required(array('id', 'uid'), $options)) return false;
		if($this->getBooks(array('uid' => $options['uid'], 'id' => $options['id'])) == false) return false;

		$this->catalog_model->deleteCatalog(array('bookid'=>$options['id'], 'uid'=>$options['uid']));
    	$this->db->where('id', $options['id']);
    	$this->db->delete('books');
    	return true;
	}
}
