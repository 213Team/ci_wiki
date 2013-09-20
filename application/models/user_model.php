<?php
class User_model extends CI_Model {

    var $name = '';
    var $password = '';
    var $email = '';
    var $profile = '';

    function __construct()
    {
        parent::__construct();
    }
    
    function add_user()
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
