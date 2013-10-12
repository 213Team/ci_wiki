<?php
class Catalog_Model extends CI_Model {

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
	
	function _checkAuthor($uid, $bookid){
		$this->db->where('books.id', $bookid);
		$this->db->where('books.uid', $uid);
		$query = $this->db->get('books');
		if($query->num_rows() == 0) return false;
		else	return true;
	}
    
	function getCatalog($options){
		//if(!$this->_required(array('bookid'), $options))	return false;
	
		$options = $this->_default(array('sortDirection' => 'asc'), $options);
		
		$qualificationArray = array('bookid', 'id');
    	foreach($qualificationArray as $qualifier)
    	{
       		if(isset($options[$qualifier])) 
        		$this->db->where('catalog.'.$qualifier, $options[$qualifier]);
    	}
    	
    	if(isset($options['uid'])) 
	    	$this->db->where('books.uid', $options['uid']);
    	if(isset($options['limit']) && isset($options['offset'])) 
    		$this->db->limit($options['limit'], $options['offset']);
    	else if(isset($options['limit'])) $this->db->limit($options['limit']);
    	if(isset($options['sortBy'])) 
    		$this->db->order_by($options['sortBy'], $options['sortDirection']);
    		
		
		$this->db->join('books', 'books.uid = users.id');
		$this->db->join('catalog', 'books.id = catalog.bookid');
		
		$query = $this->db->get('users');
    	if($query->num_rows() == 0) return false;
		return $query->result();
	}
	
	function addCatalog($options = array()){
		if(!$this->_required(array('title', 'bookid', 'uid'), $options))	return false;
		
		if(!$this->_checkAuthor($options['uid'],$options['bookid'])) return false;
		
		$cata = $this->getCatalog(array('bookid'=>$options['bookid']));
		$orderid = 0;
		
		if($cata){
			foreach($cata as $row){
				if($orderid < $row->orderid)
					$orderid = $row->orderid;
			}
			$orderid++;
		}
		
    	$this->db->set('title', $options['title']);
    	$this->db->set('bookid', $options['bookid']);
    	$this->db->set('fid', -1);
    	$this->db->set('orderid', $orderid);
		$this->db->insert('catalog');
    	return $this->db->insert_id();
	}

	function deleteCatalog($options = array()){
		if(!$this->_required(array('uid'), $options)) return false;
		if((isset($options['bookid']) && !$this->_checkAuthor($options['uid'], $options['bookid']))) return false;
		
		$ci = &get_instance();
		$ci->load->model('body_model');
		
		$cata = $this->getCatalog(array('bookid'=>$options['bookid']));
		foreach($cata as $row){
			$this->body_model->deleteBody(array('cid'=>$row->id, 'uid'=>$options['uid']));
		}
		
		$qualificationArray = array('bookid', 'id');
    	foreach($qualificationArray as $qualifier)
    	{
       		if(isset($options[$qualifier])) 
        		$this->db->where($qualifier, $options[$qualifier]);
    	}

    	$this->db->delete('catalog');
    	return true;
	}

}
