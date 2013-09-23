<?php
class User extends CI_Model {

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
    
    function addUser($options = array())
    {
		$this->username = $_POST['username'];
        $this->password = $_POST['password'];
        $this->email = $_POST['email'];
        $this->profile = $_POST['profile'];
        
        $this->db->insert('users', $this);
	}
	
	function login_check($name, $password)
	{
		$query = $this->db->get_where('users', array('username' => $name, 'password' => $password));
		return $query->row();
	}
}
?>
