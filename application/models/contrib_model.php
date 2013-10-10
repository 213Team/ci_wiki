<?php
class Contrib_Model extends CI_Model {

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

    function getContrib($options = array()) {
    	$options = $this->_default(array('sortDirection' => 'asc'), $options);

    	// Add where clauses to query
    	$qualificationArray = array('uid', 'id', 'cid', 'bid');
    	foreach($qualificationArray as $qualifier)
    	{
       		if(isset($options[$qualifier])) 
        		$this->db->where("contrib.".$qualifier, $options[$qualifier]);
    	}

    	// If limit / offset are declared (usually for pagination) 
    	// then we need to take them into account
    	if(isset($options['limit']) && isset($options['offset'])) 
    		$this->db->limit($options['limit'], $options['offset']);
    	else if(isset($options['limit'])) $this->db->limit($options['limit']);

    	// sort
    	if(isset($options['sortBy'])) 
    		$this->db->order_by($options['sortBy'], $options['sortDirection']);
		
		$this->db->select('contrib.id, books.title as btitle, catalog.title as ctitle, contrib.cid, contrib.bid, contrib.uid, users.username');
		
		$this->db->join('books', 'contrib.bid = books.id');
		$this->db->join('catalog', 'catalog.id = contrib.cid');
		$this->db->join('users', 'users.id = books.uid');
		
    	$query = $this->db->get('contrib');
    	if($query->num_rows() == 0) return false;
   
        return $query->result();

    }
	
	function addContrib($options = array()){
	
		if(!$this->_required(array('uid', 'cid', 'bid'), $options))	return false;

		if($this->getContrib(array('uid' => $options['uid'], 'cid' => $options['cid']))) return true;

		$this->db->set('uid', $options['uid']);
    	$this->db->set('cid', $options['cid']);
    	$this->db->set('bid', $options['bid']);
    	
    	$this->db->insert('contrib');
    	
    	return $this->db->insert_id();
	}
}
