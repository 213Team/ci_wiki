<?php
class Pullrequest_Model extends CI_Model {

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

	function getPullrequestsCount($options = array()){

    	$qualificationArray = array('uid', 'id', 'cid', 'puid');
    	foreach($qualificationArray as $qualifier)
    	{
       		if(isset($options[$qualifier])) 
        		$this->db->where($qualifier, $options[$qualifier]);
    	}
    	
		return $this->db->count_all_results('pullrequests');
	}

    function getPullrequests($options = array()) {
    	$options = $this->_default(array('sortDirection' => 'asc'), $options);

    	// Add where clauses to query
    	$qualificationArray = array('uid', 'id', 'cid');
    	foreach($qualificationArray as $qualifier)
    	{
       		if(isset($options[$qualifier])) 
        		$this->db->where('pullrequests.'.$qualifier, $options[$qualifier]);
    	}

    	// If limit / offset are declared (usually for pagination) 
    	// then we need to take them into account
    	if(isset($options['limit']) && isset($options['offset'])) 
    		$this->db->limit($options['limit'], $options['offset']);
    	else if(isset($options['limit'])) $this->db->limit($options['limit']);

    	// sort
    	if(isset($options['sortBy'])) 
    		$this->db->order_by($options['sortBy'], $options['sortDirection']);
		
		$this->db->select('books.title as btitle, catalog.title as ctitle, pullrequests.id as pid, catalog.id as cid, books.id as bid');
		$this->db->select('username, newbody, pullrequests.uid, puid');
		$this->db->join('catalog', 'catalog.bookid = books.id');
		$this->db->join('pullrequests', 'pullrequests.cid = catalog.id');
		$this->db->join('users', 'users.id = pullrequests.puid');
    	$query = $this->db->get('books');
    	if($query->num_rows() == 0) return false;
        return $query->result();

    }
	
	function addPullrequest($options = array()){
		if(!$this->_required(array('cid', 'uid', 'puid', 'newbody'), $options))	return false;

		$this->db->set('uid', $options['uid']);
    	$this->db->set('cid', $options['cid']);
    	$this->db->set('puid', $options['puid']);
    	$this->db->set('newbody', $options['newbody']);
    	
    	$this->db->insert('pullrequests');
    	
    	return $this->db->insert_id();
	}
	
	function deletePullrequest($options = array()){
		if(!$this->_required(array('id'), $options)) return false;

    	$this->db->where('id', $options['id']);
    	$this->db->delete('pullrequests');
    	return true;
	}
}
