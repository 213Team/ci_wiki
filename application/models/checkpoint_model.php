<?php
class Checkpoint_Model extends CI_Model {

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

    function getCheckpoints($options = array()) {
    	$options = $this->_default(array('sortDirection' => 'asc'), $options);

    	// Add where clauses to query
    	$qualificationArray = array('bid', 'id', 'cid');
    	foreach($qualificationArray as $qualifier)
    	{
       		if(isset($options[$qualifier])) 
        		$this->db->where('checkpoints.'.$qualifier, $options[$qualifier]);
    	}

    	// If limit / offset are declared (usually for pagination) 
    	// then we need to take them into account
    	if(isset($options['limit']) && isset($options['offset'])) 
    		$this->db->limit($options['limit'], $options['offset']);
    	else if(isset($options['limit'])) $this->db->limit($options['limit']);

    	// sort
    	if(isset($options['sortBy'])) 
    		$this->db->order_by($options['sortBy'], $options['sortDirection']);

    	$query = $this->db->get('checkpoints');
    	if($query->num_rows() == 0) return false;
   
        return $query->result();

    }
	
	function addCheckpoint($options = array()){
		if(!$this->_required(array('cid', 'bid', 'body'), $options))	return false;

		$this->db->set('bid', $options['bid']);
    	$this->db->set('cid', $options['cid']);
    	$this->db->set('body', $options['body']);
    	$this->db->set('lastmod', date("Y-m-d H:i:s"));
    	
    	$this->db->insert('checkpoints');
    	
    	return $this->db->insert_id();
	}
	
	function deleteCheckpoint($options = array()){
		$qualificationArray = array('bid', 'cid', 'id');
    	foreach($qualificationArray as $qualifier)
    	{
       		if(isset($options[$qualifier])) 
        		$this->db->where('checkpoints.'.$qualifier, $options[$qualifier]);
    	}

    	$this->db->delete('checkpoints');
    	return true;
	}
}
