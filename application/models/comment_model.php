<?php
class Comment_model extends CI_Model {

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

	function getComments($options = array()) {
    	$options = $this->_default(array('sortDirection' => 'asc'), $options);

    	// Add where clauses to query
    	$qualificationArray = array('id', 'cid');
    	foreach($qualificationArray as $qualifier)
    	{
       		if(isset($options[$qualifier])) 
        		$this->db->where('comments.'.$qualifier, $options[$qualifier]);
    	}

    	// If limit / offset are declared (usually for pagination) 
    	// then we need to take them into account
    	if(isset($options['limit']) && isset($options['offset'])) 
    		$this->db->limit($options['limit'], $options['offset']);
    	else if(isset($options['limit'])) $this->db->limit($options['limit']);

    	// sort
    	if(isset($options['sortBy'])) 
    		$this->db->order_by($options['sortBy'], $options['sortDirection']);
		
		$this->db->join('users', 'users.id = comments.uid');
    	$query = $this->db->get('comments');
    	if($query->num_rows() == 0) return false;
   
        return $query->result();
	}

	function addComment($options = array()){
		if(!$this->_required(array('cid', 'comment', 'uid'), $options))	return false;

		$this->db->set('uid', $options['uid']);
    	$this->db->set('cid', $options['cid']);
    	$this->db->set('comment', $options['comment']);
    	$this->db->set('lastmod', date("Y-m-d H:i:s"));
    	
    	$this->db->insert('comments');
    	
    	return $this->db->insert_id();
	}
}
?>
